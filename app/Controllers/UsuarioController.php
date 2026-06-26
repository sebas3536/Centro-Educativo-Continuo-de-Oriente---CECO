<?php
require_once __DIR__ . '/../Models/Usuario.php';

class UsuarioController
{

    public static function findByEmail($email)
    {
        return Usuario::findByEmail($email);
    }
}