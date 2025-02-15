<?php

namespace app\clases;

class Funciones
{
  public static function filtrado(string $datos): string
  {
    $datos = trim($datos);
    $datos = stripslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
  }
  public static function validarNombre(string $nombre): bool
  {
    if (strlen($nombre) > 20 || !preg_match("/^[a-zA-Záéíóú\s]+$/", $nombre)) {
      return false;
    } else {
      return true;
    }
  }

  public static function validarContraseña(string $password): bool
  {
    /* he usado lookheads, se usan para buscar un caracter dentro de la expresion, 
      pero no lo cuenta para el total, de forma que al final hay que contar el total de
      caracteres, se usa para no tener que usar varias expresiones
      Con (?=...)buscamos una coincidencia en la cadena con.* declaramos que puede haber
      cualquier secuencia antes de la que buscamos */
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/", $password)) {
      return false;
    } else {
      return true;
    }
  }
  public static function validarApellidos(string $apellidos): bool
  {
    if (!preg_match("/^[a-zA-Záéíóú\s]+$/", $apellidos)) {
      return false;
    } else {
      return true;
    }
  }
  public static function validarNick(string $nick): bool
  {
    // Permite letras, números y espacios
    if (strlen($nick) > 20 || !preg_match("/^[a-zA-Z0-9áéíóú\s_]+$/", $nick)) {
      return false;
    } else {
      return true;
    }
  }

  public static function fechaValida(string $fecha): bool
  {
    // Dividir la fecha en partes
    list($año, $mes, $dia) = explode('-', $fecha);

    // Verificar si la fecha es una fecha valida pro ejemplo que no sea 31 del febrero
    if (!checkdate(intval($mes), intval($dia), intval($año))) {
      return false;
    } else {
      return true;
    }
  }
  public static function validarEuros(float $cantidad): bool
  {
    if (!filter_var($cantidad, FILTER_VALIDATE_FLOAT)) {
      return false;
    } else {
      return true;
    }
  }

  public static function validarMail(string $email): bool
  {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return false;
    } else
      return true;
  }

  public static function validarRol(string $rol): bool
  {
    if ($rol == 'user' || $rol = 'admin') {
      return true;
    } else
      return false;
  }

  public static function validarAtaque(int $puntos_ataque): bool
  {
    if (!is_numeric($puntos_ataque) || $puntos_ataque < 0 || $puntos_ataque > 100) {
      return false;
    } else {
      return true;
    }
  }

  public static function validarVida(int $nivel_vida): bool
  {
    if (!is_numeric($nivel_vida) || $nivel_vida < 1 || $nivel_vida > 600) {
      return false;
    } else
      return true;
  }

  public static function sanitizarNombreApellidos(string $string): string
  {
    $string = strtolower($string);
    $arrayString = explode(" ", $string);
    foreach ($arrayString as &$palabra) {
      $palabra = ucfirst($palabra);
    }
    unset($palabra); //rompe la referencia con el ultimo elemento https://www.php.net/manual/es/control-structures.foreach.php

    $sanitizedString = implode(" ", $arrayString);
    return $sanitizedString;
  }
}
