<?php

/**
 * Check.class.php [ HELPER ]
 * Classe responsável por manipular e validar dados do sistema
 * 
 * @copyright (c) 2015, Filipe Leuch Bonfim UPINSIDE
 */
class Check {

    private static $data;
    private static $format;

    public static function email($email) {

        self::$data = (string) $email;
        self::$format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

        if (preg_match(self::$format, self::$data)):
            return true;
        else:
            return false;
        endif;
    }

    public static function name($name) {
        self::$format = [];
        self::$format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';
    
        /** Converte caracteres com acento para caracteres simples, e especiais para espaços*/
        self::$data = strtr(utf8_decode($name), utf8_decode(self::$format['a']), self::$format['b']);
        
        /** Elimina tags html (strip_tags) e espaços nas bordas (trim)*/
        self::$data = strip_tags(trim(self::$data));
        
        /** Substitui espaços por traços, para montar urls amigáveis a partir de uma string */
        self::$data = str_replace(' ', '-', self::$data);
        self::$data = str_replace(['-----','----','---','--'], '-', self::$data);
        
        return strtolower(utf8_encode(self::$data));
    }
    
    public static function data($data) {
        self::$format = explode(' ', $data);
        self::$data = explode('/', self::$format[0]);
        
        if(empty(self::$format[1])):
            self::$format[1] = date('H:i:s');
        endif;
        
        self::$data = self::$data[2] . '-' . self::$data[1] .'-' . self::$data[0] . ' ' . self::$format[1];
        
        return self::$data;
    }

}
