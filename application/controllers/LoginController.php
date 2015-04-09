<?php

require_once 'BaseController.php';
require_once APPLICATION_PATH.'/models/Users.php';

class LoginController extends BaseController
{


    public function loginAction()
    {
        // action body
		$userModel=new Users();
		//get userid and pwd
		$name=$this->getRequest()->getParam("name","");
		$pwd=$this->getRequest()->getParam("pwd","");
		
		$db=$userModel->getAdapter();
		$where=$db->quoteInto("name=?", $name).$db->quoteInto(" AND pwd=?", $pwd);
		
		
		$loginuser=$userModel->fetchAll($where)->toArray();
		
		if (count($loginuser)==1) {
			//get the user data and save it into season
			session_start();
			$_SESSION['loginuser']=$loginuser[0];
			$this->_forward('hallui','hall');
			
		}else{			
			$this->view->err="wrong input";
			$this->_forward('index','index');
		}
		
    }
    
    public function logoutAction()
    {
    	// action body
    
    }


}
?>
