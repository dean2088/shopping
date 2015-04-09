<?php

;
require_once 'BaseController.php';
require_once APPLICATION_PATH.'/models/Book.php';

class HallController extends BaseController
{


    public function halluiAction()
    {
        // action body
		$bookModel=new Book();
		session_start();
		$this->view->books=$bookModel->fetchAll()->toArray();
		
		$this->view->loginuser=$_SESSION['loginuser'];
		
    }


}
?>
