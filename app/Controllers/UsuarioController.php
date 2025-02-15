<?php

namespace App\Controllers;

use app\clases\Funciones;
use App\Models\UsuarioModel;

class UsuarioController extends Controller
{
    public function table()
    {
        return $this->view('usuario.table');
    }

    public function createTable()
    {

        $columnas = [
            'id INT PRIMARY KEY AUTO_INCREMENT',
            'nombre TEXT NOT NULL',
            'apellidos TEXT NOT NULL',
            'nick TEXT NOT NULL',
            'email VARCHAR(100) UNIQUE',
            'fecha_nacimiento DATE NOT NULL',
            'password TEXT NOT NULL',
            'rol TEXT NOT NULL',
            'puntos_ataque int NOT NULL',
            'nivel_vida int NOT NULL'
        ];
        $nombres = [
            "Carlos",
            "María",
            "Juan",
            "Sofía",
            "Luis",
            "Ana",
            "Jorge",
            "Camila",
            "Pedro",
            "Lucía",
            "Miguel",
            "Isabel",
            "Fernando",
            "Laura",
            "Diego",
            "Elena",
            "Antonio",
            "Valeria",
            "Daniel",
            "Paula"
        ];
        $apellido = [
            "García",
            "Martínez",
            "López",
            "Hernández",
            "González",
            "Pérez",
            "Rodríguez",
            "Sánchez",
            "Ramírez",
            "Torres",
            "Flores",
            "Vargas",
            "Rivera",
            "Díaz",
            "Morales",
            "Ortega",
            "Castro",
            "Ramos",
            "Mendoza",
            "Cruz"
        ];
        $usuarioModel = new UsuarioModel();
        try {
            $usuarioModel->createTable($columnas);
            for ($i = 1; $i <= 100; $i++) {
                $nombre = $nombres[rand(0, 19)];
                $apellidos = $apellido[rand(0, 19)] . ' ' . $apellido[rand(0, 19)];
                $nick = $nombre . '_' . $i;
                $email = $nick . '@gmail.com';
                $fecha_nacimiento = date('Y/m/d', rand(155499523, 1165342723));
                $password = password_hash('Aa12345!', PASSWORD_BCRYPT);
                if ($i % 10 == 0) {
                    $rol = 'admin';
                } else {
                    $rol = 'user';
                }
                $usuarioModel->create(
                    [
                        'nombre' => $nombre,
                        'apellidos' => $apellidos,
                        'nick' => $nick,
                        'email' => $email,
                        'fecha_nacimiento' => $fecha_nacimiento,
                        'password' => $password,
                        'rol' => $rol,
                        'puntos_ataque' => rand(0, 100),
                        'nivel_vida' => rand(1, 600)
                    ]
                );
            }
            return $this->view('usuario.table');
        } catch (\Exception $e) {
            return $this->view('usuario.table', ['error' => 'Error al crear la tabla: ' . $e->getMessage()]);
        }
    }
    public function create()
    {
        return $this->view('usuario.create');
    }

    public function store()
    {
        if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = Funciones::filtrado($_POST["nombre"]);

            if (empty($nombre)) {
                $errores['nombre'] = "Nombre no introducido.";
            } elseif (Funciones::validarNombre($nombre)) {
                $datos['nombre'] = Funciones::sanitizarNombreApellidos($nombre);
            } else {
                $errores['nombre'] = "Formato nombre incorrecto";
            }
            $apellidos = Funciones::filtrado($_POST["apellidos"]);

            if (empty($apellidos)) {
                $errores['apellidos'] = "Apellidos no introducido.";
            } elseif (Funciones::validarApellidos($apellidos)) {
                $datos['apellidos'] = Funciones::sanitizarNombreApellidos($apellidos);
            } else {
                $errores['apellidos'] = "Formato apellidos incorrecto";
            }
            $nick = Funciones::filtrado($_POST["nick"]);

            if (empty($nick)) {
                $errores['nick'] = "Nick no introducido.";
            } elseif (Funciones::validarNick($nick)) {
                $datos['nick'] = $nick;
            } else {
                $errores['nick'] = "Formato nick incorrecto";
            }
            $email = Funciones::filtrado($_POST["email"]);

            if (empty($email)) {
                $errores['email'] = "Email no introducido";
            } elseif (Funciones::validarMail($email)) {
                $datos['email'] = $email;
            } else {
                $errores['email'] = "Email no valido";
            }
            $fecha_nacimiento = Funciones::filtrado($_POST["fecha_nacimiento"]);

            if (empty($fecha_nacimiento)) {
                $errores['fecha_nacimiento'] = "Fecha no introducida";
            } elseif (Funciones::fechaValida($fecha_nacimiento)) {
                $datos['fecha_nacimiento'] = $fecha_nacimiento;
            } else {
                $errores['fecha_nacimiento'] = "fecha no valida";
            }
            $password = Funciones::filtrado($_POST["password"]);

            if (empty($password)) {
                $errores['password'] = "Contraseña no introducida";
            } elseif (Funciones::validarContraseña($password)) {
                $datos['password'] = password_hash($password, PASSWORD_BCRYPT);
            } else {
                $errores['password'] = "Contraseña no valida";
            }


            $rol = Funciones::filtrado($_POST["rol"]);

            if (empty($rol)) {
                $errores['rol'] = "Rol no introducido";
            } elseif (Funciones::validarRol($rol)) {
                $datos['rol'] = $rol;
            } else {
                $errores['rol'] = $rol;
            }

            $puntos_ataque = Funciones::filtrado($_POST["puntos_ataque"]);

            if (empty($puntos_ataque)) {
                $errores['puntos_ataque'] = "Ataque no introducido";
            } elseif (Funciones::validarAtaque($puntos_ataque)) {
                $datos['puntos_ataque'] = $puntos_ataque;
            } else {
                $errores['puntos_ataque'] = "El ataque no esta dentro de los parametros permitidos";
            }

            $nivel_vida = Funciones::filtrado($_POST["nivel_vida"]);

            if (empty($nivel_vida)) {
                $errores['nivel_vida'] = "Vida no introducida";
            } elseif (Funciones::validarVida($nivel_vida)) {
                $datos['nivel_vida'] = $nivel_vida;
            } else {
                $errores['nivel_vida'] = "La vida no esta dentro de los parametros permitidos";
            }

            if (empty($errores)) {
                $usuarioModel = new UsuarioModel();
                try {
                    $usuarioModel->create($datos);
                    return $this->redirect('/usuario/login');
                } catch (\PDOException $e) {
                    // Manejar el error
                    $errores['mensaje'] = "Error en la consulta: " . $e->getMessage();
                    return $this->view('usuarios.create', $errores);
                }
            } else {
                return $this->view('usuario.create', $errores);
            }
        }
    }

    public function login()
    {
        return $this->view('usuario.login');
    }

    public function loginUser()
    {
        if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
            $nick = Funciones::filtrado($_POST["nick"]);

            if (empty($nick)) {
                $errores['nick'] = "Nick no introducido";
            } elseif (Funciones::validarNick($nick)) {
                $datos['nick'] = $nick;
            } else {
                $errores['nick'] = "Nick no valido";
            }

            $password = Funciones::filtrado($_POST["password"]);

            if (empty($password)) {
                $errores['password'] = "Contraseña no introducida";
            } elseif (Funciones::validarContraseña($password)) {
                $datos['password'] = $password;
            } else {
                $errores['password'] = "Contraseña no valida";
            }
            if (empty($errores)) {
                $usuarioModel = new UsuarioModel();
                $usuario = $usuarioModel->where('nick', '=', $datos['nick'])->getFetchAssoc();
                if ($usuario) {
                    if (password_verify($datos['password'], $usuario['password'])) {
                        $_SESSION['nick'] = $datos['nick'];
                        $_SESSION['id'] = $usuario['id'];
                        $_SESSION['rol'] = $usuario['rol'];
                        return $this->redirect('/usuario/' . $usuario['id']);
                    } else {
                        $errores['mensaje'] = "La contraseña no es correcta";
                        return $this->view('usuario.login', $errores);
                    }
                } else {
                    $errores['mensaje'] = "El usuario no existe";
                    return $this->view('usuario.login', $errores);
                }
            }
        }
    }

    public function show($id)
    {
        if ($id == $_SESSION['id']) {
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->find($id);
            return $this->view('usuario.show', $usuario);
        } else {
            return $this->redirect($_SESSION['id']);
        }
    }

    public function update()
    {
        if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = Funciones::filtrado($_POST["nombre"]);

            if (empty($nombre)) {
                $_SESSION['errores']['nombre'] = "Nombre no introducido.";
            } elseif (Funciones::validarNombre($nombre)) {
                $datos['nombre'] = Funciones::sanitizarNombreApellidos($nombre);
            } else {
                $_SESSION['errores']['nombre'] = "Formato nombre incorrecto";
            }
            $apellidos = Funciones::filtrado($_POST["apellidos"]);

            if (empty($apellidos)) {
                $_SESSION['errores']['apellidos'] = "Apellidos no introducido.";
            } elseif (Funciones::validarApellidos($apellidos)) {
                $datos['apellidos'] = Funciones::sanitizarNombreApellidos($apellidos);
            } else {
                $_SESSION['errores']['apellidos'] = "Formato apellidos incorrecto";
            }
            $nick = Funciones::filtrado($_POST["nick"]);

            if (empty($nick)) {
                $_SESSION['errores']['nick'] = "Nick no introducido.";
            } elseif (Funciones::validarNick($nick)) {
                $datos['nick'] = $nick;
            } else {
                $_SESSION['errores']['nick'] = "Formato nick incorrecto";
            }
            $fecha_nacimiento = Funciones::filtrado($_POST["fecha_nacimiento"]);
            if (empty($fecha_nacimiento)) {
                $_SESSION['errores']['fecha_nacimiento'] = "Fecha no introducida";
            } elseif (Funciones::fechaValida($fecha_nacimiento)) {
                $datos['fecha_nacimiento'] = $fecha_nacimiento;
            } else {
                $_SESSION['errores']['fecha_nacimiento'] = "fecha no valida";
            }

            $rol = Funciones::filtrado($_POST["rol"]);

            if (empty($rol)) {
                $errores['rol'] = "Rol no introducido";
            } elseif (Funciones::validarRol($rol)) {
                $datos['rol'] = $rol;
            } else {
                $errores['rol'] = $rol;
            }
            $id = $_POST['id'];
            if (empty($errores)) {
                $usuarioModel = new UsuarioModel();
                try {
                    $usuarioModel->update($id, $datos);
                    return $this->redirect($id);
                } catch (\PDOException $e) {
                    // Manejar el error
                    $_SESSION['errores']['mensaje'] = "Error en la consulta: " . $e->getMessage();
                    return $this->view('usuarios.show');
                }
            } else {
                return $this->redirect($_SESSION['id']);
            }
        }
    }
}
