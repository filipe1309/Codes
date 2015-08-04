<?php

/**
 * <b> DocumentacaoDeClasse:</b>
 * Essa classe foi criada para mostrar a interação de objetos. Logo depois replicamos ela para ver sobre
 * a documentação de classe com PHPDoc.
 * 
 * @copyright (c) 2015, Filipe Leuch Bonfim UPINSIDE
 */
class DocumentacaoDeClasse {

    /** @var string Nome da empresa */
    public $empresa;
    /**
     * Esse atributo é autogerido pela classe e incrementa o número de funcionários! 
     * @var int Número de funcionarios */
    public $setores;
    
    /** @var InteracaoClasse Objeto vinda da classe InteracaoClasse */
    public $funcionario;
    
    // Constrói a classe requisitando o nome da empresa (comentário não será documentado)
    function __construct($empresa) {
        $this->empresa = $empresa;
        $this->setores = 0;
    }
    
    /**
     * <b> Contratar Funcionário: </b> Informe um objeto da classe InteracaoClasse, o cargo e o salário do
     * funcionário a ser contratado!
     * @param object $funcionario = Objeto da classe InteracaoClasse
     * @param string $cargo = Profissão ou cargo a ocupar
     * @param float $salario = Salário do funcionário
     */
    public  function contratar($funcionario, $cargo, $salario) {
        $this->funcionario = (object) $funcionario;
        $this->funcionario->trabalhar($this->empresa, $salario, $cargo);
        $this->setores += 1;
    }
    
    /**
     * <b>Pagar e obter salário:</b> Ao executar esse método o salário do funcionário será pago. Você ainda 
     * poderá dar um echo neste mesmo para vizualizar o salário!
     * @return flaot Retorna o salário do contratado:
     */
    public function pagar() {
        $this->funcionario->receber($this->funcionario->salario);
        return $this->funcionario->salario;
    }
    
    public function promover($cargo, $salario = null) {
        $this->funcionario->profissao = $cargo;
        if($salario) {
            $this->funcionario->salario = $salario;
        }
    }
    
    public function funcionarios($funcionario) {
        $this->funcionario = (object) $funcionario;
    }
    
    public function demitir($recisao) {
        $this->funcionario->receber($recisao);
        $this->funcionario->empresa = null;
        $this->funcionario->salario = null;
        $this->setores -= 1;
    }
}
