<?php

/**
 * Session.class [ HELPER ]
 * Responsável pela estatísticas, sessões e atualizações de tráfego do sistema;
 * 
 * @copyright (c) 2015, Filipe Leuch Bonfim UPINSIDE
 */
class Session {

    private $date;
    private $cache;
    private $traffic;
    private $browser;

    function __construct($cache = null) {
        session_start();
        $this->checkSession($cache);
    }

    // Verifica e executa todos os métodos da classe!
    private function checkSession($cache = null) {
        $this->date = date('Y-m-d');
        $this->cache = ( (int) $cache ? $cache : 20 ); // 20 minutos de duração


        if (empty($_SESSION['useronline'])):
            $this->setTraffic();
            $this->setSession();
            $this->checkBrowser();
            $this->setUsuario();

            $this->browserUpdate();
        else:
            //$this->setSession();
            //$this->setTraffic();
            $this->trafficUpdate();
            $this->sessionUpdate();
            $this->checkBrowser();
            $this->usuarioUpdate();
        endif;

        $this->date = null;
    }

    /*
     * **************************************************
     * **********      SESSÂO DO USUÁRIO       **********
     * **************************************************
     */

    // Inicia a sessão do usuário
    private function setSession() {
        $_SESSION['useronline'] = [
            'online_session' => session_id(),
            'online_startview' => date('Y-m-d H:i:s'),
            'online_endview' => date('Y-m-d H:i:s', strtotime("+{$this->cache}minutes")),
            'online_ip' => filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP),
            'online_url' => filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT),
            'online_agent' => filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_DEFAULT)
        ];
    }

    // Atualiza sessão do usuario
    private function sessionUpdate() {
        $_SESSION['useronline']['online_endview'] = date('Y-m-d H:i:s', strtotime("+{$this->cache}minutes"));
        $_SESSION['useronline']['online_url'] = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT);
    }

    /*
     * **************************************************
     * ******** USUÁRIOS, VISITAS, ATUALIZAÇÕES *********
     * **************************************************
     */

    // Verifica e insere o tráfego na tabela
    private function setTraffic() {
        $this->getTraffic();
        if (!$this->traffic):
            $arrSiteViews = ['siteviews_date' => $this->date, 'siteviews_users' => 1, 'siteviews_views' => 1, 'siteviews_pages' => 1];
            $createSiteViews = new Create;
            $createSiteViews->exeCreate('ws_siteviews', $arrSiteViews);
        else:
            if (!$this->getCookie()):
                $arrSiteViews = ['siteviews_users' => $this->traffic['siteviews_users'] + 1, 'siteviews_views' => $this->traffic['siteviews_views'] + 1, 'siteviews_pages' => $this->traffic['siteviews_pages'] + 1];
            else:
                $arrSiteViews = ['siteviews_views' => $this->traffic['siteviews_views'] + 1, 'siteviews_pages' => $this->traffic['siteviews_pages'] + 1];
            endif;

            $updateSiteViews = new Update;
            $updateSiteViews->exeUpdate('ws_siteviews', $arrSiteViews, 'WHERE siteviews_date = :date', "date={$this->date}");

        endif;
    }

    // Verifica e atualiza os pageviews
    private function trafficUpdate() {
        $this->getTraffic();
        $arrSiteViews = ['siteviews_pages' => $this->traffic['siteviews_pages'] + 1];
        $updatePageViews = new Update;
        $updatePageViews->exeUpdate('ws_siteviews', $arrSiteViews, 'WHERE siteviews_date = :date', "date={$this->date}");

        $this->traffic = null;
    }

    // Obtem dados da tabela [ HELPER TRAFFIC ]
    //ws_siteviews
    private function getTraffic() {
        $readSiteViews = new Read;
        $readSiteViews->exeRead('ws_siteviews', "WHERE siteviews_date = :date", "date={$this->date}");
        if ($readSiteViews->getRowCount()):
            $this->traffic = $readSiteViews->getResult()[0];
        endif;
    }

    // Verifica, cria e atualiza o cookie do usuário [ HELPER TRAFFIC ]
    private function getCookie() {
        $cookie = filter_input(INPUT_COOKIE, 'useronline', FILTER_DEFAULT);
        setcookie('useronline', base64_encode('upinside'), time() + 86400); // 1 dia

        if (!$cookie):
            return false;
        else:
            return true;
        endif;
    }

    /*
     * **************************************************
     * ********      NAVEGADORES DE ACESSO      *********
     * **************************************************
     */

    // Identifica navegador do usuário!
    private function checkBrowser() {
        $this->browser = $_SESSION['useronline']['online_agent'];
        if (strpos($this->browser, 'Chrome')):
            $this->browser = 'Chrome';
        elseif (strpos($this->browser, 'Firefox')):
            $this->browser = 'Firefox';
        elseif (strpos($this->browser, 'MSIE') || strpos($this->browser, 'Trident/')):
            $this->browser = 'IE';
        else:
            $this->browser = 'Outros';
        endif;
    }

    // Atualiza tabela com dados de navegadores
    private function browserUpdate() {
        $readAgent = new Read;
        $readAgent->exeRead('ws_siteviews_agent', 'WHERE agent_name = :agent', "agent={$this->browser}");
        if (!$readAgent->getResult()):
            $ArrAgent = ['agent_name' => $this->browser, 'agent_views' => 1];
            $createAgent = new Create;
            $createAgent->exeCreate('ws_siteviews_agent', $ArrAgent);
        else:
            $ArrAgent = ['agent_views' => $readAgent->getResult()[0]['agent_views'] + 1];
            $updateAgent = new Update;
            $updateAgent->exeUpdate('ws_siteviews_agent', $ArrAgent, 'WHERE agent_name = :name', "name={$this->browser}");
        endif;
    }

    /*
     * **************************************************
     * ********          USUÁRIOS ONLINE        *********
     * **************************************************
     */

    // Cadastra usuário online na tabela
    private function setUsuario() {
        $sesOnline = $_SESSION['useronline'];
        $sesOnline['agent_name'] = $this->browser;

        //var_dump($sesOnline);

        $userCreate = new Create;
        $userCreate->exeCreate('ws_siteviews_online', $sesOnline);
    }

    // Atualiza navegação do usuário online
    private function usuarioUpdate() {
        $arrOnline = [
            'online_endview' => $_SESSION['useronline']['online_endview'],
            'online_url' => $_SESSION['useronline']['online_url'],
        ];


        $userUpdate = new Update;
        $userUpdate->exeUpdate('ws_siteviews_online', $arrOnline, 'WHERE online_session = :ses', "ses={$_SESSION['useronline']['online_session']}");

        if (!$userUpdate->getRowCount()):
            $readSes = new Read;
            $readSes->exeRead('ws_siteviews_online', 'WHERE online_session = :onses', "onses={$_SESSION['useronline']['online_session']}");
            if (!$readSes->getRowCount()):
                $this->setUsuario();
            endif;
        endif;

        var_dump($arrOnline);
    }

}
