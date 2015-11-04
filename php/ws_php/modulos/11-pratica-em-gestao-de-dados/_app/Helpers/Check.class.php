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

    /**
     * Transforma a string name para o formato de uma url amigável
     * @param string $name
     * @return string
     */
    public static function name($name) {
        self::$format = [];
        self::$format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        /** Converte caracteres com acento para caracteres simples, e especiais para espaços */
        self::$data = strtr(utf8_decode($name), utf8_decode(self::$format['a']), self::$format['b']);

        /** Elimina tags html (strip_tags) e espaços nas bordas (trim) */
        self::$data = strip_tags(trim(self::$data));

        /** Substitui espaços por traços, para montar urls amigáveis a partir de uma string */
        self::$data = str_replace(' ', '-', self::$data);
        self::$data = str_replace(['-----', '----', '---', '--'], '-', self::$data);

        return strtolower(utf8_encode(self::$data));
    }

    public static function data($data) {
        self::$format = explode(' ', $data);
        self::$data = explode('/', self::$format[0]);

        if (empty(self::$format[1])):
            self::$format[1] = date('H:i:s');
        endif;

        self::$data = self::$data[2] . '-' . self::$data[1] . '-' . self::$data[0] . ' ' . self::$format[1];

        return self::$data;
    }

    /**
     * Limita o tamanho da string pela quantidade de palavras
     * @param string $string = a string a ser manipulada
     * @param int $limite = o máximo de palavras permitidas
     * @param string $pointer = a string que será inserida no final, caso o tamanho exceda
     */
    public static function words($string, $limite, $pointer = null) {
        self::$data = strip_tags(trim($string));
        self::$format = (int) $limite;

        $arrWords = explode(' ', self::$data);
        $numWords = count($arrWords);

        /** Une o array em uma string (implode), obtendo somente a parte referente ao limite definido (array_slice) */
        $newWords = implode(' ', array_slice($arrWords, 0, self::$format));

        $pointer = (empty($pointer) ? '...' : ' ' . $pointer);
        $result = ( self::$format < $numWords ? $newWords . $pointer : self::$data );

        return $result;

//        var_dump($arrWords, $numWords, $newWords);
    }

    /* Limita por caracteres, utilização: Check::Chars('Olá Mundo!', 10);
     *  public static function Chars($String, $Limite) {
      self::$Data = strip_tags($String);
      self::$Format = $Limite;
      if (strlen(self::$Data) <= self::$Format) {
      return self::$Data;
      } else {
      $subStr = strrpos(substr(self::$Data, 0, self::$Format), ' ');
      return substr(self::$Data, 0, $subStr) . '...';
      }
      }
     */

    /**
     * Obtem o ID da categoria através do nome
     * @param string $categoryName
     */
    public static function catByname($categoryName) {
        $read = new Read;
        $read->exeRead('ws_categories', 'WHERE category_name = :name', "name={$categoryName}");
        if ($read->getRowCount()):
            return $read->getResult()[0]['category_id'];
        else:
            echo "A categoria {$categoryName} não foi encontrada!";
            die;
        endif;
    }

//    ws_siteviews_online
    public static function userOnline() {
        $now = date('Y-m-d H:i:s');

        $deleteUserOnline = new Delete;
        $deleteUserOnline->exeDelete('ws_siteviews_online', 'WHERE online_endview < :now', "now={$now}");

        $readUserOnline = new Read;
        $readUserOnline->exeRead('ws_siteviews_online');
        return $readUserOnline->getRowCount();
    }

    public static function image($imageUrl, $imageDesc, $imageW = null, $imageH = null) {

        //self::$data = 'uploads/' . $imageUrl;
        self::$data = $imageUrl;


        if (file_exists(self::$data) && !is_dir(self::$data)):
            $path = HOME;
            $imagem = self::$data;
//            return $path . $imagem;
            return "<img src=\"{$path}/tim.php?src={$path}/{$imagem}&w={$imageW}&h={$imageH}\" alt=\"{$imageDesc}\" title=\"{$imageDesc}\" />";
        else:
            return false;
        endif;
    }

}
