<?php

/**
 * PolimorfismoDeposito.class.php [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class PolimorfismoDeposito extends Polimorfismo {

   public $desconto;
   
   function __construct($produto, $valor) {
       parent::__construct($produto, $valor);
       $this->desconto = 15;
       $this->metodo = 'Deposito';
   }

   function setDesconto($desconto) {
       $this->desconto = $desconto;
   }

   // overriding
   public function pagar() {
       $this->valor = ($this->valor / 100) * (100 - $this->desconto); // 1% * 85
       parent::pagar();
   }

}
