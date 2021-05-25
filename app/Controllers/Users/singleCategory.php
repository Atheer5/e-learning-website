<?php

namespace App\Controllers;
namespace App\Controllers\Users;
use App\Controllers\BaseController;
use App\Models\coursesModel;

class singleCategory extends BaseController
{
	public function index()
	{


			$categoryid= $this->request->getGet('categoryid');

			$categorytitle= $this->request->getGet('categorytitle');

			$limitnum=$this->request->getGet('limitnum');			
			
			$sortorder=$this->request->getGet('sortorder');
			
			$sortby=$this->request->getGet('sortby');

			$offsetval=$this->request->getGet('offsetval');

			if($limitnum==null)$limitnum=10;
			if($sortorder==null)$sortorder='DESC';
			if($sortby==null)$sortby='date';
			if($offsetval==null)$offsetval=0;

			
			$obj=new coursesModel();
			$selected_data['courses']=$obj->scoursesInCategory($categoryid,$limitnum,$sortorder,$sortby,$offsetval);

			$count_of_rows=$obj->countofrowsincategory($categoryid);
			$selected_data['count_of_page']=ceil($count_of_rows/$limitnum);

			$this->loadview('Users/courses',$categorytitle,$selected_data);


	}
}
?>