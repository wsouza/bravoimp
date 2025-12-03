<?php

abstract class Conexao {

    private static $con = null;

    public static function getConexao() {
        if (self::$con === null) {
            self::$con = new PDO("pgsql:host=192.168.100.200;port=5433;dbname=aimp_lagoagrande", "postgres", "221122");            self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$con;
    }

}