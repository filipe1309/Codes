<?php

/**
 * Abstracao.class [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
abstract class Abstracao {

    public $cliente;
    public $conta;
    public $saldo;

    function __construct($cliente, $saldo) {
        $this->cliente = $cliente;
        $this->saldo = $saldo;
    }

    public function depositar($valor) {
        $this->saldo += (float) $valor;
        echo "<span style='color:green'><b>{$this->conta}:</b> Depósito de {$this->real($valor)} efetuado com sucesso!</span><br>";
    }

    public function sacar($valor) {
        $this->saldo -= (float) $valor;
        echo "<span style='color:red'><b>{$this->conta}:</b> Saque de {$this->real($valor)} efetuado com sucesso!</span><br>";
    }

    /** @param Abstracao $destino */
    public function transferir($valor, $destino) {
        if ($this === $destino) :
            echo "Você não pode trandferir valores para a mesma conta!<br>";
        else:
            echo '<hr>';
            $this->sacar($valor);
            $destino->depositar($valor);
            echo "<span style='color:blue'><b>{$this->conta}:</b> Transferencia de {$this->real($valor)} efetuado com sucesso de {$this->cliente} para {$destino->cliente}!</span><br>";
            echo '<hr>';
        endif;
    }

    public function extrato() {
        echo "<hr><hr> Olá {$this->cliente}. Seu saldo em {$this->conta} é de {$this->real($this->saldo)}<hr>";
    }

    public function real($valor) {
        return "R$ " . number_format($valor, '2', '.', ',');
    }
    
    /** métodos abstract devem ser implementados nas classes filhas */
    abstract public function verSaldo();

}
