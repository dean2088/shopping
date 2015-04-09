<?php
require_once 'BaseController.php';
require_once APPLICATION_PATH.'/models/Mycart.php';

class ShoppingController extends BaseController
{
    public function addproductAction()
    {
        // get book id
        $bookid=$this->getRequest()->getParam('bookid');
        //build mycart model
        $mycart=new Mycart();
        
        session_start();
       
        if ($mycart->addBook($_SESSION['loginuser']['id'], $bookid)) {
        	$this->view->info='add products success';
        	$this->view->gourl='/hall/hallui';
    		$this->_forward('ok','global');
        }else{
        	$this->view->info='add products false';
        	$this->_forward('error','global');
        }		
    }
    
    public function showcartAction()
    {
    	$mycart=new Mycart();
    	session_start();
    	$this->view->books=$mycart->showMyCart($_SESSION['loginuser']['id']); 
    	$this->view->total_price=$mycart->total_price;  	
    	$this->render('mycart');
    }
    
    public function delAction()
    {
    	
    	$bookid=$this->getRequest()->getParam("bookid");
    	$mycart=new Mycart();
    	session_start();
    	
    	if ($mycart->del($_SESSION['loginuser']['id'], $bookid)) {
    		$this->view->info='delete products success';
    		$this->view->gourl='/shopping/showcart';
    		$this->_forward('ok','global');
    	}else{
        	$this->view->info='delete products false';
        	$this->view->gourl='/shopping/showcart';
        	$this->_forward('error','global');
        }	
    }
    
    public function updateAction()
    {
    	 
    	$bookids=$this->getRequest()->getParam('bookids');
    	$booknums=$this->getRequest()->getParam('booknums');
    	session_start();
    	$mycart=new Mycart();
    	$userid=$_SESSION['loginuser']['id'];
    	for ($i=0;$i<count($bookids);$i++){ 
    		$mycart->updateProduct($userid, $bookids[$i], $booknums[$i]);

    	}
    	$this->view->info='update products success';
    	$this->view->gourl='/shopping/showcart';
    	$this->_forward('ok','global');
    }
    
}
?>
