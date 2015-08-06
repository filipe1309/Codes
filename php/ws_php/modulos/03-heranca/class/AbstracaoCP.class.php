<?php

/**
 * AbstracaoCP.class [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
final class AbstracaoCP extends AbstracaoCC {

    public $rendimento;

    function __construct($cliente, $saldo) {
        parent::__construct($cliente, $saldo, 0);
        $this->conta = 'Conta Poupança';
        $this->rendimento = 1.7;
    }

    /* Não pode ser implementados nas classes filhas (nem por overloading ou overriding) */

    final public function depositar($valor) {
        $juro = $valor * ($this->rendimento / 100);
        $deposito = $valor + $juro;
        parent::depositar($deposito);
        echo "<small style='color:#09f'>Valor do depósito {$this->real($valor)} || Rendimentos: {$this->real($juro)}</small><hr>";
    }

}
