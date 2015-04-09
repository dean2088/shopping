<?php

/**
 * @author blog.anchen8.net
 * @copyright 2014
 */
class Mycart extends Zend_Db_Table{
    
    protected $_name="mycart";//table name
    var $total_price=0;
    //add item to the cart
    function addBook($userid,$bookid,$num=1){
    	
    	
    	$res=$this->fetchAll("userid=$userid AND bookid=$bookid")->toArray();
    	
    	

//======means the client has bought this kind of products before
	    	if (count($res)>0) {  				
	    		$data=array(
	    			'nums'=>$res[0]['nums']+1
	    		);
	    		$where="userid=$userid AND bookid=$bookid";
	    		$this->update($data, $where);
	    		return true;
	    	}else{
//========means the client buy this kind of products first time
		    	$date=time();
		    	$data=array(
		    			'userid'=>$userid,
		    			'bookid'=>$bookid,
		    			'nums'=>$num, 
		    			'date'=>$date
		    	);
		    	
		    	if ($this->insert($data)>0) {
		    		
		    		return true;
		    	}else{
		    		return false;
		    	}
	    	}
    	
    }
    //=============get specific data from many tables====
    function showMyCart($userid){
    	 
    	 $sql="select b.id, b.name, b.price, m.nums from book b, mycart m where b.id=m.bookid and m.userid=$userid";
    	 $db=$this->getAdapter();
    	 $res= $db->query($sql)->fetchAll();
    	 
    	 
    	 for ($i=0;$i<count($res);$i++){
    	 	$bookinfo=$res[$i];
    	 	$this->total_price+=$bookinfo['price']*$bookinfo['nums'];
    	 }
    	 
    	 return $res;
    }
    
    function del($userid, $bookid){
    	if ($this->delete("userid=$userid AND bookid=$bookid")>0) {
    		return true;
    	}else{
    		return false;
    	}
    }
    
    function updateProduct($userid, $bookid, $nums){
    	
    	$set=array(
    			'nums'=>$nums
    	);
    	$where="userid=$userid AND bookid=$bookid";
    	$this->update($set, $where);
    }
    
} 


?>