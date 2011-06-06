<?php
class UsersController extends AppController{
    function login()
    {
        if ($this->Auth->login()){
            $this->redirect($this->Auth->redirect());	
        }
        //$this->redirect($this->redirect(array('controller' => 'users', 'action' => 'login')));
    }	


    function logout()
    {
            $this->Session->setFlash('Ha salido de su cuenta');
            $this->Session->destroy();
            $this->redirect($this->Auth->logout());
    }
}