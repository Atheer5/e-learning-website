<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\UsersModel;

class Users extends BaseController
{

	function __construct()
    {	
       	$this->session = \Config\Services::session();
        $this->session->start();


    }

	public function index()
	{
		
		if (session('login')){
			$obj=new UsersModel();
			$selected_data['Users']=$obj->selectallUsers();
			$this->loadview('admin/Users/index',"Users",$selected_data);
			
	}
		else {

			echo "you cant login to this page";
		}
	}
//______________________________________________________________________________________________________________________________

	public function add(){
		if ( strtolower( $_SERVER['REQUEST_METHOD']) == 'post' ){

			$fname= $this->request->getPost('fname');
			$lname=$this->request->getPost('lname');
			$email= $this->request->getPost('email');
			$password=$this->request->getPost('password');
			$cpassword= $this->request->getPost('cpassword');
			$is_suspend=$this->request->getPost('suspend');
			$epassword=md5($password);
            

			$rules = [
				'fname' =>[
				'label' => 'First name',
				'rules' => 'required|alpha_space'


				],
				'lname' =>[
				'label' => 'Last name',
				'rules' => 'required|alpha_space'

				],
				'email' => [
				'label' => 'E-mail',
				'rules' => 'required|valid_email|is_unique[users.email]'
				],
				'password' => [
				'label' => 'Password',
				'rules' => 'required|min_length[4]|max_length[24]'
				],
				'cpassword' => [
				'label' => 'Confirm Password',
				'rules' => 'required|matches[password]'
			],


			];

			if (!$this->validate($rules)) {
					
				$errors=$this->errors = $this->validator->getErrors();

				echo json_encode($errors);;

			}else{
				$obj=new UsersModel();
				$obj->add($fname, $lname,$email,$epassword,$is_suspend);
				echo true;

			}
		}//end if post
	}
//_________________________________________________________________________________________________________________________


public function getdata(){
	if (strtolower( $_SERVER['REQUEST_METHOD']) == 'post' ) {
		$userid  = $this->request->getPost('uid');
		$obj=new UsersModel();
		$selected_data=$obj->getuserRow($userid);
		echo json_encode($selected_data);
	}
}

//_______________________________________________________________________________________________

	public function edit(){
		
		
		$obj=new UsersModel();
		if ( strtolower( $_SERVER['REQUEST_METHOD']) == 'post' ){	
			$uid= $this->request->getPost('uid');	
			$fname = $this->request->getPost('fname');
			$lname = $this->request->getPost('lname');
			$email = $this->request->getPost('email');
			$password = $this->request->getPost('password');
			$cpassword = $this->request->getPost('cpassword');
			$suspend=$this->request->getPost('suspend');
			if($password==null){
				$selected_data=$obj->getuserRow($uid);
				$epassword=$selected_data["password"];
			}else
			$epassword=md5($password);
			$rules = [
				'fname' => [
				  'label' => 'First name',
				  'rules' => 'required|alpha_space'
		  
		  
				],
				'lname' => [
				  'label' => 'Last name',
				  'rules' => 'required|alpha_space'
		  
				],
				'email' => [
				  'label' => 'E-mail',
				  'rules' => 'required|valid_email|is_unique[users.email,id,'.$uid.']'
				],
				'password' => [
				  'label' => 'Password',
				  'rules' => 'permit_empty|min_length[4]|max_length[24]'
				],
				'cpassword' => [
				  'label' => 'Confirm Password',
				  'rules' => 'permit_empty|matches[password]'
				],
		  
		  
		  
			  ];
		  



			
			if (!$this->validate($rules)) {
				$errors=$this->validator->getErrors();
				
				echo json_encode($errors);;
				
			}
			else{
				$obj->edituser($uid,$fname, $lname,$email,$epassword,$suspend);
					echo true;
				
				}//end else error
			
			}//end if post

	}
}
?>
