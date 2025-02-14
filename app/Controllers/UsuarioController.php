<?php

namespace App\Controllers;

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
}
