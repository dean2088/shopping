<?php

require_once 'BaseController.php';
require_once APPLICATION_PATH.'/models/Student.php';
require_once APPLICATION_PATH.'/models/Course.php';
require_once APPLICATION_PATH.'/models/Mark.php';

class StudentController extends BaseController
{

//http://localhost/zendf/stusys/public/index/show
    public function indexAction()
    {
        
    	$where='1=1';
    	$order='id';
    	$count=3;
    	$offset=0;//limit 0,3
    	
    	//create table Model
    	
    	$studentModel=new Student();
    	$res=$studentModel->fetchAll($where,$order,$count,$$order)->toArray();
    	
    	print '<pre>';
    	print_r($res);
    	print '</pre>';  	   	
    	
    	//===========use adapter
    	
    	$db=$studentModel->getAdapter();
    	// many where
    	$where=$db->quoteInto("name=?", 'Tom')
    	.$db->quoteInto(" AND sid=?", '588467633');
    	
    	$res=$studentModel->fetchAll($where,$order,$count,$$order)->toArray();
    	print '<pre>';
    	print_r($res);
    	print '</pre>';
    	
    	//===========select name
    	 
    	$db=$studentModel->getAdapter();
    	$sql=$db->quoteInto("select name from student");
    	 
    	$res=$db->query($sql)->fetchAll();
    	print '<pre>';
    	print_r($res);
    	print '</pre>';
    	
    	//===========select name + many where
    	$res=$db->query("select name from student where name=:aa AND sid=:bb"
    			,array(
    					'aa'=>'tom',
    					'bb'=>'588467633'
    				)
    			)->fetchAll();
    	print '<pre>';
    	print_r($res);
    	print '</pre>';
    	
    	//=============increase
    	/*
    	echo "<h1>increase course</h1>";
    	
    	$data=array(
    			'cid'=>'sd1545641',
    			'name'=>'java'
    	);
    	
    	$course=new Course();
    	$course->insert($data);
    	  */	
    	//=============update
    	/*
    	echo "<h1>update course</h1>";
    	 
    	$set=array(
    			'name'=>'tomcat'
    	);
    	 
    	$course=new Course();
    	$where="cid='sd1545641'";
    	$course->update($set, $where);
    	*/
    	//=============delete
    	/*
    	echo "<h1>delete course</h1>";
    	$course=new Course();
    	$where="cid='sd1545641'";
    	$course->delete($where);
    	*/
    	//=============use primary key to find
    	//$stu=$studentModel->find('3')->toArray();
    	$stu=$studentModel->find(array('3','1'))->toArray();
    	print '<pre>';
    	print_r($stu);
    	print '</pre>';
    	
    	//=============return one result
    	echo "<h1>return one result</h1>";
    	$stu=$studentModel->fetchRow(array('id','1'))->toArray();
    	print '<pre>';
    	print_r($stu);
    	print '</pre>';
    	
    	//=============distinct
    	echo "<h1>distinct</h1>";
    	$res=$db->query("select distinct name from student")->fetchAll();
    	print '<pre>';
    	print count($res);
    	print '</pre>';
    	
    	//============exit
    	exit();
    	$this->render('show');
    }

}

?>