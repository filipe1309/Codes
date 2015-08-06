<?php

/**
 * ResolucaoDeEscopo.class [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class ResolucaoDeEscopo {
    
    public $produto;
    public $valor;
    
    /*
     * variável da classe
     * static = não pode ser acessado pelo obejto, 
     * somente pela classe, pois pertence a mesma 
     */
    public static $vendas;
    public static $lucros;
    
    function __construct($produto, $valor) {
        $this->produto = $produto;
        $this->valor = $valor;
    }

    public function vender() {
        self::$vendas += 1;
        self::$lucros = $this->valor + self::$lucros;
        echo "{$this->produto} vendido por R$ {$this->valor}<br>";
    }
    
    /*
     * método da classe
     * só pode utilizar variaveis static (self::, parent::)
     */
    public static function relatorio() {
        echo '<hr>';
        echo "Este produto vendeu " . self::$vendas . " unidade(s). Total R$ " . self::$lucros;
        echo '<hr>';
    }
    
}
