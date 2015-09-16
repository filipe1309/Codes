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

    public function file(array $file, $name = null, $folder = null, $maxFileSize = null) {
        $this->file = $file;
        $this->name = ((string) $name ? $name : substr($file['name'], 0, strrpos($file['name'], '.')) );
        $this->folder = ((string) $folder ? $folder : 'files');
        $maxFileSize = ( (int) $maxFileSize ? $maxFileSize : 2 );

        $fileAccept = [
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "application/pdf"
        ];

        if ($this->file['size'] > ($maxFileSize * (1024 * 1024))):
            $this->result = false;
            $this->error = "Arquivo muito grande, tamanho máximo permitido de {$maxFileSize}mb";

        elseif (!in_array($this->file['type'], $fileAccept)):
            $this->result = false;
            $this->error = 'Tipo de arquivo não suportado. Envie .PDF ou .DOCX!';
        else:
            $this->checkFolder($this->folder);
            $this->setFileName();
            $this->moveFile();
        endif;
    }

    public function media(array $media, $name = null, $folder = null, $maxFileSize = null) {
        $this->file = $media;
        $this->name = ((string) $name ? $name : substr($media['name'], 0, strrpos($media['name'], '.')) );
        $this->folder = ((string) $folder ? $folder : 'medias');
        $maxFileSize = ( (int) $maxFileSize ? $maxFileSize : 40 );

        $fileAccept = [
            "audio/mp3",
            "video/mp4"
        ];

        if ($this->file['size'] > ($maxFileSize * (1024 * 1024))):
            $this->result = false;
            $this->error = "Arquivo muito grande, tamanho máximo permitido de {$maxFileSize}mb";

        elseif (!in_array($this->file['type'], $fileAccept)):
            $this->result = false;
            $this->error = 'Tipo de arquivo não suportado. Envie audio MP3 ou video MP4!';
        else:
            $this->checkFolder($this->folder);
            $this->setFileName();
            $this->moveFile();
        endif;
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

    // ENVIA ARQUIVOS E MIDIAS
    private function moveFile() {
        if (move_uploaded_file($this->file['tmp_name'], self::$baseDir . $this->send . $this->name)):
            $this->result = $this->send . $this->name;
            $this->error = NULL;
        else:
            $this->result = false;
            $this->error = 'Erro ao mover o arquivo. Favor tente mais tarde!';
        endif;
    }

}
