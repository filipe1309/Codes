<?php

/**
 * PolimorfismoCartao.class [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class PolimorfismoCartao extends Polimorfismo {
    
    public $juros;
    public $encargos;
    public $parcela;
    public $numParcelas;
    
    function __construct($produto, $valor) {
        parent::__construct($produto, $valor);
        $this->juros = 1.17;
        $this->metodo = 'Cartão de Crédito';
    }
    
    public function pagar($numParcelas = null) {
        $this->setNumParcelas($numParcelas);
        $this->setEncargos();
        
        $this->valor += $this->encargos;
        $this->parcela = $this->valor / $this->numParcelas;
        
        echo "Você pagou {$this->real($this->valor)} por um {$this->produto}<br>";
        echo "<small>Pagamento efetuado via {$this->metodo} em {$this->numParcelas}x iguais de {$this->real($this->parcela)}</small><hr><br>";
    }


    /** para 5,5% informe 5.5 */
    function setJuros($juros) {
        $this->juros = $juros;
    }

    function setEncargos() {
        $this->encargos = ($this->valor * ($this->juros / 100)) * $this->numParcelas;
    }

    function setNumParcelas($numParcelas) {
        $this->numParcelas = ((int) $numParcelas >= 1 ? $numParcelas : 1);
    }


}
