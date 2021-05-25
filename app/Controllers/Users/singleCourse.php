<?php

namespace App\Controllers;
namespace App\Controllers\Users;
use App\Controllers\BaseController;
use App\Models\coursesModel;

class singleCourse extends BaseController
{
	public function index(){
		$courseid= $this->request->getGet('courseid');
		$coursetitle=$this->request->getGet('coursetitle');
		$categoryid=$this->request->getGet('categoryid');
		$obj=new coursesModel();
		$selected_data['relatedcourse']=$obj->coursesInCategory($categoryid);
		$selected_data['course']=$obj->getCourseRow($courseid);
		$this->loadview('Users/Singlecourse',$coursetitle." and related courses",$selected_data);

	}



	
}
?>