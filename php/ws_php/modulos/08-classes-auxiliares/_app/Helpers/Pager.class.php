<?php

/**
 * Pager.class [ HELPER ]
 * Realiza a gestão e a paginação de resiltados do sistema!
 * 
 * @copyright (c) 2015, Filipe Leuch Bonfim UPINSIDE
 */
class Pager {
    /** DEFINE O PAGER */

    /** A página atual */
    private $page;

    /** Contém a quantidade de resultados que serão exibidos por página */
    private $limit;

    /** Para efetuar a páginação, e iniciar o resultado corretamente */
    private $offset;

    /** REALIZA A LEITURA */
    private $tabela;
    private $termos;

    /** Para efetuar o prepare statements */
    private $places;

    /** DEFINE O PAGINATOR */

    /** Defina a quantidade de linhas por resultado */
    private $rows;

    /** Para personalizar o link da paginação */
    private $link;

    /** Para saber quantos links serão exibidos por página */
    private $maxLinks;

    /** O que será escrito como primeira página */
    private $first;

    /** O que será escrito como última página */
    private $last;

    /** RENDERIZA O PAGINATOR */
    private $paginator;

    function __construct($link, $first = null, $last = null, $maxLinks = null) {
        $this->link = (string) $link;
        $this->maxLinks = ( (int) $maxLinks ? $maxLinks : 5 );
        $this->first = ( (string) $first ? $first : 'Primeira Página' );
        $this->last = ( (string) $last ? $last : 'Última Página' );
    }

    public function exePager($page, $limit) {
        $this->page = ( (int) $page ? $page : 1 );
        $this->limit = (int) $limit;
        $this->offset = ( $this->page * $this->limit ) - $this->limit;
    }

    /**
     * Caso usuário acesse uma página inválida,
     * a página atual é decrementada até alcançar uma
     * página válida, através da execução de vários header Locations
     */
    public function returnPage() {
        if ($this->page > 1):
            $nPage = $this->page - 1;
            header("Location: {$this->link}{$nPage}");
        endif;
    }

    function getPage() {
        return $this->page;
    }

    function getLimit() {
        return $this->limit;
    }

    function getOffset() {
        return $this->offset;
    }

    /**
     * Método responsável pela paginação
     * 
     * @param string $tabela
     * @param string $termos
     * @param string $parseString
     */
    public function exePaginator($tabela, $termos = null, $parseString = null) {
        $this->tabela = (string) $tabela;
        $this->termos = (string) $termos;
        $this->places = (string) $parseString;
        $this->getSyntax();
    }

    public function getPaginator() {
        return $this->paginator;
    }

    //PRIVATE

    private function getSyntax() {
        /** Obtida por composição */
        $read = new Read;
        $read->exeRead($this->tabela, $this->termos, $this->places);
        $this->rows = $read->getRowCount();

        if ($this->rows > $this->limit):
            /** Obtem o total de páginas necessárias */
            $paginas = ceil($this->rows / $this->limit);
            $maxLinks = $this->maxLinks;

            $this->paginator = "<ul class=\"\">";
            $this->paginator .= "<li><a title=\"{$this->first}\" href=\"{$this->link}1\">{$this->first}</a></li>";

            for ($iPag = $this->page - $maxLinks; $iPag <= $this->page - 1; $iPag++):
                if ($iPag >= 1):
                    $this->paginator .= "<li><a title=\"Página {$iPag}\" href=\"{$this->link}{$iPag}\">{$iPag}</a></li>";
                endif;
            endfor;

            $this->paginator .= "<li><span class=\"active\">{$this->page}</span></li>";


            for ($dPag = $this->page + 1; $dPag <= $this->page + $maxLinks; $dPag++):
                if ($dPag <= $paginas):
                    $this->paginator .= "<li><a title=\"Página {$dPag}\" href=\"{$this->link}{$dPag}\">{$dPag}</a></li>";
                endif;
            endfor;

            $this->paginator .= "<li><a title=\"{$this->last}\" href=\"{$this->link}{$paginas}\">{$this->last}</a></li>";
            $this->paginator .= "</ul>";
        endif;
    }

}
