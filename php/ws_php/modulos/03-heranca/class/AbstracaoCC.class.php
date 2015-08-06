<?php

/**
 * AbstracaoCC [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class AbstracaoCC extends Abstracao {

    public $limite;

    function __construct($cliente, $saldo, $limite) {
        parent::__construct($cliente, $saldo);
        $this->conta = 'Conta Corrente';
        $this->limite = (float) $limite;
    }

    /**
     * Overriding.
     * Não pode ser implementados nas classes filhas (nem por overloading ou overriding)
     * @param float $valor
     * 
     */
    final public function sacar($valor) {
        if ($this->saldo + $this->limite >= (float) $valor):
            parent::sacar($valor);
        else:
            echo "<span style='color:red'><b>{$this->conta}:</b> Erro ao sacar {$this->real($valor)}, saldo indisponível!</span><br>";
        endif;
    }

    /**
     * Overriding.
     * Não pode ser implementados nas classes filhas (nem por overloading ou overriding)
     * @param Abstração $destino 
     */
    final public function transferir($valor, $destino) {
        if ($this->saldo + $this->limite >= (float) $valor):
            parent::transferir($valor, $destino);
        else:
            echo "<span style='color:red'><b>{$this->conta}:</b> Erro ao transferir {$this->real($valor)}, saldo indisponível!</span><br>";
        endif;
    }

    public function verSaldo() {
        parent::extrato();
    }

}
