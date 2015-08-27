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
        $this->uploadImage();
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

    // Realiza o upload de imagens redimensionando a mesma
    private function uploadImage() {


        switch ($this->file['type']):
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->image = imagecreatefromjpeg($this->file['tmp_name']);
                break;
            case 'image/png':
            case 'image/x-png':
                $this->image = imagecreatefrompng($this->file['tmp_name']);
                break;
        endswitch;

        if (!$this->image):
            $this->result = false;
            $this->error = 'Tipo de arquivo inválido, envie imagens JPG ou PNG!';
        else:
            $x = imagesx($this->image);
            $y = imagesy($this->image);
            $imageW = ($this->width < $x ? $this->width : $x);
            $imageH = ($imageW * $y) / $x;

            $newImage = imagecreatetruecolor($imageW, $imageH);
            /** Salva imagem com fundo transparente */
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            /** Envia copia da imagem para o servidor */
            imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $imageW, $imageH, $x, $y);

            switch ($this->file['type']):
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/pjpeg':
                    imagejpeg($newImage, self::$baseDir . $this->send . $this->name);
                    break;
                case 'image/png':
                case 'image/x-png':
                    imagepng($newImage, self::$baseDir . $this->send . $this->name);
                    break;
            endswitch;

            if (!$newImage):
                $this->result = false;
                $this->error = 'Tipo de arquivo inválido, envie imagens JPG ou PNG!';
            else:
                $this->result = $this->send . $this->name;
                $this->error = null;
            endif;
            
            imagedestroy($this->image);
            imagedestroy($newImage);

        endif;
    }

}
