<?php

/**
 * ResolucaoDeEscopoDigital.class [ TIPO ]
 * Descricao
 * @copyright (c) year, Filipe Leuch Bonfim UPINSIDE
 */
class ResolucaoDeEscopoDigital extends ResolucaoDeEscopo {

    public static $digital;
    
    function __construct($produto, $valor) {
        parent::__construct($produto, $valor);
    }
    
    /*Polimorfismo -> overriding*/
    public function vender() {
        self::$digital += 1;
        parent::vender();
    }
    
}
