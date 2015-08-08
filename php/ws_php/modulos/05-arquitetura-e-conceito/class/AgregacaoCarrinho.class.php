<?php

/**
 * AgregacaoCarrinho [ TIPO ]
 * Descricao
 * @copyright (c) 2015, Filipe Leuch Bonfim UPINSIDE
 */
class AgregacaoCarrinho {

    private $cliente;
    private $produtos;
    private $total;
    
    /* Aqui ocorre a agregação, pois o construtor obriga 
     * q o objeto recebido seja da classe AssociacaoCliente
     */
    function __construct(AssociacaoCliente $cliente) {
        $this->cliente = $cliente;
        $this->produtos = [];
    }
    
    public function add(AgregacaoProduto $produto) {
        $this->produtos[$produto->getProduto()] = $produto;
        $this->total += $produto->getValor();
        $this->verCarrinho($produto, 'adicionou');
    }
    
    public function remove(AgregacaoProduto $produto) {
        unset($this->produtos[$produto->getProduto()]);
        $this->total -= $produto->getValor();
        $this->verCarrinho($produto, 'removeu');
    }
    
    public function verCarrinho(AgregacaoProduto $produto, $action) {
        echo "Você {$action} um {$produto->getNome()} em seu carrinho. Valor R$ {$this->total}<hr>";
    }
    
}
