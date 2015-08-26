<?php

/**
 * Upload.class [ HELPER ]
 * Responsável por executar upload de imagens, arquivos e mídias no sistema!
 * 
 * @copyright (c) 2015, Filipe Leuch Bonfim UPINSIDE
 */
class Upload {

    private $file;
    private $name;
    private $send;

    /** IMAGE UPLOAD */
    private $width;
    private $image;

    /** RESULT SET */
    private $result;
    private $error;

    /** DIRETORIOS */
    private $folder;
    private static $baseDir;

    function __construct($baseDir = null) {
        self::$baseDir = ( (string) $baseDir ? $baseDir : '../uploads/');
        if (!file_exists(self::$baseDir) && !is_dir(self::$baseDir)):
            mkdir(self::$baseDir, 0777);
        endif;
    }

    public function image(array $image, $name = null, $width = null, $folder = null) {
        $this->file = $image;
        $this->name = ((string) $name ? $name : substr($image['name'], 0, strrpos($image['name'], '.')) );
        $this->width = ((int) $width ? $width : 1024);
        $this->folder = ((string) $folder ? $folder : 'images');

        $this->checkFolder($this->folder);
        $this->setFileName();
    }

    function getResult() {
        return $this->result;
    }

    function getError() {
        return $this->error;
    }

    // PRIVATES
    private function checkFolder($folder) {
        list($y, $m) = explode('/', date('Y/m'));
        $this->createFolder("{$folder}");
        $this->createFolder("{$folder}/{$y}");
        $this->createFolder("{$folder}/{$y}/{$m}/");

        $this->send = "{$folder}/{$y}/{$m}/";
    }

    private function createFolder($folder) {
        if (!file_exists(self::$baseDir . $folder) && !is_dir(self::$baseDir . $folder)):
            mkdir(self::$baseDir . $folder, 0777);
        endif;
    }

    private function setFileName() {
        // strrchr encontra a ultima ocorrencia de um caracter em uma string, neste caso é utilzado para descobrir a extensão
        $fileName = Check::name($this->name) . strrchr($this->file['name'], '.');
        //echo $fileName;
        if (file_exists(self::$baseDir . $this->send . $fileName)):
            $fileName = Check::name($this->name) . '-' . time() . strrchr($this->file['name'], '.');
        endif;
        
        $this->name = $fileName;
    }

}
