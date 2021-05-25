<?php

namespace App\Controllers;
use App\Models\coursesModel;
use App\Models\UsersModel;
class Home extends BaseController
{

	function __construct()
    {	
       	$this->session = \Config\Services::session();
        $this->session->start();


    }

	
	public function index()
	{

		$obj=new coursesModel();
		$selected_data['courses']=$obj->newestCourses();		
		$this->loadview('shared/home',"",$selected_data);

	}
	public function search(){
		if (strtolower( $_SERVER['REQUEST_METHOD']) == 'post' ) {
			$course_title  = $this->request->getPost('title');
			$obj=new coursesModel();
	        echo json_encode($obj->searchBytitle($course_title));

		}


	}

//________________________________________________________________________________________________________________
	public function login(){
		if (strtolower( $_SERVER['REQUEST_METHOD']) == 'post' ) {
			$user_email  = $this->request->getPost('uemail');
			$user_pwd  = $this->request->getPost('upwd');
			$obj=new UsersModel();
			
			if($obj->login($user_email,$user_pwd)){
				$data=$obj->login($user_email,$user_pwd);
			    $this->session->set('login',true);
			    $name="Welcome ".$data["fname"];
				$this->session->set('uname',$name);
				if($data["is_admin"]==1)
				{
					$this->session->set('adminlayout',true);
				}	
		}
	        echo json_encode($obj->login($user_email,$user_pwd));
			

		}


	}
//_______________________________________________________________________________________________
	public function logout(){
		$this->session->destroy();
		return redirect()->to(base_url('Home/index'));


	}
//___________________________________________________________________________________________________________
}
?>