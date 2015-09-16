<?php

/**
 * Conn.class [ CONEXÂO ]
 * Classe abstrata de conexão. Padrão Singleton
 * Retorna um objeto PDO pelo método estático getConn();
 * 
 * @copyright (c) 2015, Filipe Leuch Bonfim UPINSIDE
 */
class Conn {
    
    private static $Host = HOST;
    private static $User = USER;
    private static $Pass = PASS;
    private static $Dbsa = DBSA;
    
    /** @var PDO */
    private static $connect = null;
    
    /**
     * Conecta com o banco de dados pattern singleton.
     * Retorna um obejto PDO!
     */
    private static function conectar() {
        try {
            if(self::$connect == null):
                $dsn = 'mysql:host=' . self::$Host . ';dbname=' . self::$Dbsa;
                /** Configurações para o banco trabalhar com UTF-8 */
                $options = [ PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8' ];
                self::$connect = new PDO($dsn, self::$User, self::$Pass, $options);
            endif;
        } catch (PDOException $e) {
            phpErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            die;
        }
        
        self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$connect;
    }
    
    /** Retorna um objeto PDO Singleton Pattern. */
    public static function getConn() {
        return self::conectar();
    }
    
}
