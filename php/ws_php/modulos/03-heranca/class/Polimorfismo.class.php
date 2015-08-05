<?php

/**
 * Polimorfismo.class.php [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class Polimorfismo {

    public $produto;
    public $valor;
    public $metodo;
    
    function __construct($produto, $valor) {
        $this->produto = $produto;
        $this->valor = $valor;
        $this->metodo = 'Boleto';
    }
    
    public function pagar() {
        echo "Você pagou {$this->real($this->valor)} por um {$this->produto}<br>";
        echo "<small>Pagamento efetuado via {$this->metodo}</small><hr>";
    }
    
    public function real($valor) {
        return "R$ " . number_format($valor,'2','.',',');
    }

}
