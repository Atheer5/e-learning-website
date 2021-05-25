<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\coursesModel;
use App\Models\CategoriesModel;

class Courses extends BaseController
{

	function __construct()
    {	
       	$this->session = \Config\Services::session();
        $this->session->start();


    }

	
	public function index(){
		if (session('login')){
		$obj=new coursesModel();
		$selected_data['courses']=$obj->selectcourses();
		$obj=new CategoriesModel();
	    $selected_data['Categories']=$obj->selectallCategories();
		$this->loadview('admin/courses/index','Courses',$selected_data);}
		else {
			echo "you cant login to this page";
		}
		
	}

//________________________________________________________________________________________________________________________	
	public function add(){
		if ( strtolower( $_SERVER['REQUEST_METHOD']) == 'post' ){

			$title= $this->request->getPost('title');
			$desc=$this->request->getPost('desc');
			$vlink= $this->request->getPost('vlink');
			$Ilink=$this->request->getPost('Ilink');
			$file= $this->request->getPost('pdffile');//'c:\fakepath\filename.pdf
			$coursecat=$this->request->getPost('coursecat');
			$isHide=$this->request->getPost('isHide');

			$date=date("Y-m-d h:i:s");

			$number_of_enrolment=0;
			
			$rules = [
				'title' =>[
				'label' => 'title',
				'rules' => 'required|alpha_space|is_unique[courses.title]'


				],
				'desc' =>[
				'label' => 'description',
				'rules' => 'required'

				],
				'vlink' => [
				'label' => 'video link',
				'rules' => 'required'
				],
				'Ilink' => [
				'label' => 'course image link',
				'rules' => 'required'
				],
				'pdffile' => [
				'label' => 'pdf file',
				'rules' => 'required'
			],


			];

			if (!$this->validate($rules)) {
					
				$errors=$this->errors = $this->validator->getErrors();

				echo json_encode($errors);;

			}else{
				$uploade_file=$_FILES["file"]["name"];
			    $filedest='public/uploads/' . $uploade_file;
			    move_uploaded_file($_FILES["file"]["tmp_name"], "../public/uploads/" .$_FILES["file"]["name"]);

				$save_path="C:/wamp64/www/e_learning/" . $filedest;
				$obj=new coursesModel();
			    $obj->add($title,$desc,$vlink,$Ilink,$uploade_file,$coursecat,$isHide,$date,$number_of_enrolment);
				echo true;

			}
		}//end if post


	}
//________________________________________________________________________________________________________________________
	public function edit(){


		if ( strtolower( $_SERVER['REQUEST_METHOD']) == 'post' ){

			$cid= $this->request->getPost('cid');
			$title= $this->request->getPost('title');
			$desc=$this->request->getPost('desc');
			$vlink= $this->request->getPost('vlink');
			$Ilink=$this->request->getPost('Ilink');
			$file= $this->request->getPost('pdffile');
			$coursecat=$this->request->getPost('coursecat');
			$isHide=$this->request->getPost('isHide');

			$date=date("Y-m-d h:i:s");			
			$rules = [
				'title' =>[
				'label' => 'title',
				'rules' => 'required|alpha_space|is_unique[courses.title,course_id,'.$cid.']'


				],
				'desc' =>[
				'label' => 'description',
				'rules' => 'required'

				],
				'vlink' => [
				'label' => 'video link',
				'rules' => 'required'
				],
				'Ilink' => [
				'label' => 'course image link',
				'rules' => 'required'
				],
			];

			

			if (!$this->validate($rules)) {
					
				$errors=$this->errors = $this->validator->getErrors();

				echo json_encode($errors);;

			}else{
				$obj=new coursesModel();
				if($file==null){
					$selected_data=$obj->getCourseRow($cid);
					$uploade_file=$selected_data["pdf_path"];
				}
				else{
				$uploade_file=$_FILES["file"]["name"];
			    $filedest='public/uploads/' . $uploade_file;
			    move_uploaded_file($_FILES["file"]["tmp_name"], "../public/uploads/" .$_FILES["file"]["name"]);
				$save_path="C:/wamp64/www/e_learning/" . $filedest;
			    }//end else 

			    $obj->edit($title,$desc,$vlink,$Ilink,$uploade_file,$coursecat,$isHide,$date,$cid);
				echo true;
			}
		}//end if post



	}
//_____________________________________________________________________________________________________________________________


public function delete(){
	if (strtolower( $_SERVER['REQUEST_METHOD']) == 'post' ) {
		$id  = $this->request->getPost('id');
	    $obj=new coursesModel();
        $data=$obj->deleteCourse($id);
        echo $data;

	}
}

//_______________________________________________________________________________________________________
public function getdata(){
	if (strtolower( $_SERVER['REQUEST_METHOD']) == 'post' ) {
		$courseid  = $this->request->getPost('cid');
		$obj=new coursesModel();
		$selected_data=$obj->getCourseRow($courseid);
		echo json_encode($selected_data);;
	}
}



}
?>