<?php

/**
 * TrabalhoComInterfaces.class [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class TrabalhoComInterfaces implements IAluno {

    public $aluno;
    public $curso;
    public $formacao;

    function __construct($aluno, $curso) {
        $this->aluno = $aluno;
        $this->curso = $curso;
        $this->formacao = [];
    }

    public function matricular($curso) {
        $this->curso = $curso;
        echo "{$this->aluno} foi matriculado no curso {$this->curso}<br>";
    }

    public function formar() {
        $this->formacao[] = $this->curso;
        echo "{$this->aluno} formou-se no curso {$this->curso}<br>";
    }

}
