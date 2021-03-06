<?php

require_once('Framework/Controller.php');
require_once('Model/Account.php');

//CLASSE CONTROLEUR ABSTRAITE POUR PAGES SECURISEES
abstract class SecurityController extends Controller {

    protected $account;
    protected $info;

    //ANALYSE DE SESSION ET RENVOI D'ACTION CLASSIQUE / REDIRECTION
    public function executeAction($action) {
        if ($this->request->getSession()->isAttribute('pseudo')) {
            $this->account = new Account();
            $pseudo = $this->request->getSession()->getAttribute('pseudo');
            $this->info = $this->account->getAccount($pseudo)->fetch();
            parent::executeAction($action);
        }
        else {
            $this->redirect('Connection');
        }
    }

}
