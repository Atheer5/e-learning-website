<?php

namespace App\Controllers;
namespace App\Controllers\Users;
use App\Controllers\BaseController;
use App\Models\coursesModel;

class courses extends BaseController
{
	function __construct()
    {	
		
     	$this->session = \Config\Services::session();
        $this->session->start();


    }
	//_______________________________________________________________
	public function index()
	{

		
		
		
		    
			$limitnum=$this->request->getGet('limitnum');			
			
			$sortorder=$this->request->getGet('sortorder');
			
			$sortby=$this->request->getGet('sortby');

			$offsetval=$this->request->getGet('offsetval');

			if($limitnum==null)$limitnum=10;
			if($sortorder==null)$sortorder='DESC';
			if($sortby==null)$sortby='date';
			if($offsetval==null)$offsetval=0;



			
			$obj=new coursesModel();
			$selected_data['courses']=$obj->selectallcourses($limitnum,$sortorder,$sortby,$offsetval);

			$count_of_rows=$obj->countofrows();
			$selected_data['count_of_page']=ceil($count_of_rows/$limitnum);
			$this->loadview('Users/courses',"All course ",$selected_data);

		

	}


	
}
?>