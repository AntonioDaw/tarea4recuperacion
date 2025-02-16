<?php

declare(strict_types=1);

namespace App\Models;

use PDO;
use PDOException;

/**
 * Gestiona la conexión de la base de datos e incluye un esquema para
 * un Query Builder. Los return son ejemplo en caso de consultar la tabla
 * usuarios.
 */
require_once '../vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable('..');
$dotenv->load();

class Model
{

    private $connection;

    private $query; // Consulta a ejecutar

    private $select = '*';
    private $where, $values = [];
    private $limit;
    private $orderBy;
    protected $table;

    public function __construct()
    {

        $this->connection();
    }

    private function connection(): void
    {
        $dbHost = $_ENV['DB_HOST'];
        $dbName = $_ENV['DB_NAME'];
        $dbUser = $_ENV['DB_USER'];
        $dbPass = $_ENV['DB_PASS'];
        try {
            $dsn = "mysql:host={$dbHost};dbname={$dbName}";
            $this->connection = new \PDO($dsn, $dbUser, $dbPass);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // QUERY BUILDER
    // Consultas: 

    // Recibe la cadena de consulta y la ejecuta
    private function query(string $sql, array $data = []): object
    {


        // Si hay $data se lanzará una consulta preparada, en otro caso una normal
        if ($data) {

            $stmp = $this->connection->prepare($sql);

            // Vincular los parámetros dinámicamente
            foreach ($data as $key => $value) {

                $stmp->bindValue($key + 1, $value);
            }

            $stmp->execute();
        } else {
            $this->query = $this->connection->query($sql);
        }


        return $this;
    }

    public function select(string ...$columns): object
    {
        // Separamos el array en una cadena con ,
        $this->select = implode(', ', $columns);

        return $this;
    }

    // Devuelve todos los registros de una tabla
    public function all(): array
    {
        // La consulta
        $sql = "SELECT * FROM {$this->table}";
        // Preparar y ejecutar la consulta
        $this->query = $this->connection->prepare($sql);
        $this->query->setFetchMode(PDO::FETCH_OBJ);
        $this->query->execute();
        return $this->query->fetchall();
    }

    // Consulta base a la que se irán añadiendo partes
    public function getFetchClass(string $className): array
    {
        if (empty($this->query)) {
            $sql = "SELECT {$this->select} FROM {$this->table}";

            // Se comprueban si están definidos para añadirlos a la cadena $sql
            if ($this->where) {
                $sql .= " WHERE {$this->where}";
            }
            if ($this->limit) {
                $sql .= " LIMIT {$this->limit}";
            }

            if ($this->orderBy) {
                $sql .= " ORDER BY {$this->orderBy}";
            }

            $this->query = $this->connection->prepare($sql);
            $this->query->setFetchMode(\PDO::FETCH_CLASS, $className);
            $this->query->execute($this->values);
            //para obtener los datos del select
            return $this->query->fetchall();
        }
    }

    public function getFetchAll(): array
    {
        if (empty($this->query)) {
            $sql = "SELECT {$this->select} FROM {$this->table}";

            // Se comprueban si están definidos para añadirlos a la cadena $sql
            if ($this->where) {
                $sql .= " WHERE {$this->where}";
            }
            if ($this->limit) {
                $sql .= " LIMIT {$this->limit}";
            }

            if ($this->orderBy) {
                $sql .= " ORDER BY {$this->orderBy}";
            }

            $this->query = $this->connection->prepare($sql);
            $this->query->setFetchMode(PDO::FETCH_OBJ);
            $this->query->execute($this->values);
            //para obtener los datos del select
            return $this->query->fetchall();
        }
    }
    // Consulta base a la que se irán añadiendo partes
    public function getFetchAssoc(): array|bool
    {
        if (empty($this->query)) {
            $sql = "SELECT {$this->select} FROM {$this->table}";

            // Se comprueban si están definidos para añadirlos a la cadena $sql
            if ($this->where) {
                $sql .= " WHERE {$this->where}";
            }

            if ($this->orderBy) {
                $sql .= " ORDER BY {$this->orderBy}";
            }

            $this->query = $this->connection->prepare($sql);
            $this->query->execute($this->values);
            //para obtener los datos del select
            return $this->query->fetch(\PDO::FETCH_ASSOC);
        }
    }

    // public function find(int $id, string $className): object
    // {
    //     $sql = "SELECT * FROM {$this->table} WHERE id = ?";

    //     $this->query = $this->connection->prepare($sql);
    //     $this->query->setFetchMode(\PDO::FETCH_CLASS, $className);
    //     $this->query->execute([$id]);
    //     return $this->query->fetch();
    // }
    public function find(int $id): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";

        $this->query = $this->connection->prepare($sql);
        $this->query->fetch(\PDO::FETCH_ASSOC);
        $this->query->execute([$id]);
        return $this->query->fetch();
    }

    // Se añade where a la sentencia con operador específico
    public function where(string $column, string $operator, string $value = null, string $chainType = 'AND'): object
    {
        if ($value == null) { // Si no se pasa operador, por defecto =
            $value = $operator;
            $operator = '=';
        }

        // Si ya había algo de antes 
        if ($this->where) {
            $this->where .= " {$chainType} {$column} {$operator} ?";
        } else {
            $this->where = "{$column} {$operator} ?";
        }

        $this->values[] = $value;

        return $this;
    }

    public function orWhere(string $column, string $operator, string $value = null, string $chainType = 'OR'): object
    {
        if ($value == null) { // Si no se pasa operador, por defecto =
            $value = $operator;
            $operator = '=';
        }

        // Si ya había algo de antes 
        if ($this->where) {
            $this->where .= " {$chainType} {$column} {$operator} ?";
        } else {
            $this->where = "{$column} {$operator} ?";
        }

        $this->values[] = $value;

        return $this;
    }



    // Se añade orderBy a la sentencia
    public function orderBy(string $column, string $order = 'ASC'): object
    {
        if ($this->orderBy) {
            $this->orderBy .= ", {$column} {$order}";
        } else {
            $this->orderBy = "{$column} {$order}";
        }

        return $this;
    }

    // Insertar, recibimos un $_GET o $_POST en $data
    public function create(array $data): object
    {
        $columns = array_keys($data); // array de claves del array
        $columns = implode(', ', $columns); // y creamos una cadena separada por ,

        $values = array_values($data); // array de los valores

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES (?" . str_repeat(', ? ', count($values) - 1) . ")";

        $this->query($sql, $values);

        return $this;
    }

    public function update(int $id, array $data): object
    {
        $fields = [];

        foreach ($data as $key => $value) {
            $fields[] = "{$key} = ?";
        }

        $fields = implode(', ', $fields);

        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = ?";

        $values = array_values($data);
        $values[] = $id;

        $this->query($sql, $values);
        return $this;
    }

    public function delete(int $id): void
    //delete se realizara en la tabla uno solamente ya que las siguiente se borraría en cascada.
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";

        $this->query($sql, [$id], 'i');
    }

    public function createTable(array $campos): object
    {
        $columnas = implode(', ', $campos);
        $sql = "CREATE TABLE {$this->table}($columnas)";
        $this->query($sql);

        return $this;
    }

    public function transferenciaUpdate($id, $nick, $cantidad)
    {
        try {
            // Conexión a la base de datos

            // IDs de los usuarios y cantidad a transferir
            $usuario_origen = $id;
            $usuario_destino = $nick;
            $cantidad = $cantidad; // Cantidad a transferir

            // Iniciar la transacción
            $this->connection->beginTransaction();

            // Restar saldo al usuario origen
            $sql_restar = "UPDATE usuarios SET saldo_inicial = saldo_inicial - :cantidad WHERE id = :usuario AND saldo_inicial >= :cantidad";
            $this->query = $this->connection->prepare($sql_restar);
            $this->query->execute([
                ':cantidad' => $cantidad,
                ':usuario' => $usuario_origen
            ]);

            // Verificar si se afectó alguna fila
            if ($this->query->rowCount() === 0) {
                throw new PDOException("El usuario origen no tiene suficiente saldo o no existe.");
            }

            // Sumar saldo al usuario destino
            $sql_sumar = "UPDATE usuarios SET saldo_inicial = saldo_inicial + :cantidad WHERE nick = :usuario";
            $this->query = $this->connection->prepare($sql_sumar);
            $this->query->execute([
                ':cantidad' => $cantidad,
                ':usuario' => $usuario_destino
            ]);

            // Verificar si se afectó alguna fila
            if ($this->query->rowCount() === 0) {
                throw new PDOException("El usuario destino no existe.");
            }

            // Confirmar la transacción
            $this->connection->commit();
            echo "La transacción se realizó correctamente.";
        } catch (\Exception $e) {
            // deshacemos la transacción 
            $this->connection->rollback();
            $error = "Error en el registro" . $e->getMessage();
            return $error;
        }
    }

    public function ataque($daño, $objetivos)
    {
        try {
            $this->connection->beginTransaction();
            $usuarios_muertos = [];  // Guardamos los usuarios que quedan con 0 o menos de salud

            // Actualizar la salud de cada usuario atacado
            foreach ($objetivos as $id_objetivo) {
                // Obtener el usuario atacado

                $usuario = $this->find(intval($id_objetivo));
                if ($usuario['nivel_vida'] - $daño <= 0) {
                    $salud = 0;
                } else {
                    $salud = $usuario['nivel_vida'] - $daño;
                }


                $sql_restar = "UPDATE usuarios SET nivel_vida = $salud WHERE id = :id";
                $this->query = $this->connection->prepare($sql_restar);
                $this->query->execute([
                    ':id' => $id_objetivo,
                ]);

                // Verificar si la salud llegó a 0
                if ($salud == 0) {
                    $usuarios_muertos[] = $usuario['nombre'];  // Guardamos el nombre de los usuarios caídos
                }
            }

            // Si todo se ha ejecutado correctamente, hacemos commit
            $this->connection->commit();

            // Mostrar el informe con los usuarios cuya salud ha llegado a 0
            if (count($usuarios_muertos) > 0) {
                return "Usuarios cuya salud ha llegado a 0: " . implode(", ", $usuarios_muertos);
            } else {
                return  "Ningún usuario ha llegado a 0 de salud.";
            }
        } catch (\Exception $e) {
            // deshacemos la transacción 
            $this->connection->rollback();
            $error = "Error en el registro" . $e->getMessage();
            return $error;
        }
    }

    public function listado(string $criterio, int $registros, int $inicio, string $className): array
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY {$criterio} ASC LIMIT {$registros} OFFSET {$inicio}";
        $this->query = $this->connection->prepare($sql);
        $this->query->setFetchMode(\PDO::FETCH_CLASS, $className);
        $this->query->execute();
        return $this->query->fetchall();
    }
    public function countRegistros()
    {
        $sql = "SELECT COUNT(*) AS total FROM {$this->table}";
        $this->query = $this->connection->prepare($sql);
        $this->query->execute();
        return $this->query->fetch(\PDO::FETCH_ASSOC);
    }

    public function limit(string $registros, string $inicio): object
    {

        $this->limit = " {$registros} OFFSET {$inicio}";


        return $this;
    }
}
