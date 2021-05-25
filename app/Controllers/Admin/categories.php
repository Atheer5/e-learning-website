<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoriesModel;
use CodeIgniter\HTTP\Response;

class Categories extends BaseController
{
	


	function __construct()
    {	
       	$this->session = \Config\Services::session();
        $this->session->start();


    }

	
	 
	public function index()
	{
		
		if (session('login')){
		$obj=new CategoriesModel();
	    $selected_data['Categories']=$obj->selectallCategories();
		$this->loadview('admin/categories/index','Categories',$selected_data);
	}
		else {
			echo "you cant login to this page";
		}
	}
//_____________________________________________________________________________________________________________________________
	public function add()
	{	

		if ( strtolower( $_SERVER['REQUEST_METHOD']) == 'post' ){
			
		
		$cat_name = $this->request->getPost('catname');
		$is_show=$this->request->getPost('catshow');
		
		$rules = [
			'catname'=> [
			   'label' => 'category name',
			   'rules' => 'required|trim|is_unique[categories.category_name]|alpha_numeric_space|max_length[100]'
			],
		 
		];
		
		if (!$this->validate($rules)) {
			$cat_errors=$this->validator->getErrors();
			foreach ($cat_errors as $error) :
					 $isfail=$error;
				 endforeach;
			echo "$isfail...";
		}
		else{
				$obj=new CategoriesModel();
				$obj->add($cat_name, $is_show);
				echo true;
			
			}//end else error
		
		}//end if post
   }

//______________________________________________________________________________________________________________________________________	

	public function edit(){

		
		if ( strtolower( $_SERVER['REQUEST_METHOD']) == 'post' ){	
			$catid= $this->request->getPost('categoryid');	
			$catname = $this->request->getPost('catname');
			$is_show=$this->request->getPost('catshow');
            $rules = [
				'catname'=> [
				   'label' => 'category name',
				   'rules' => "required|trim|alpha_numeric_space|max_length[100]|is_unique[categories.category_name,categoryid,$catid]",
				],
			 
			];
			
			if (!$this->validate($rules)) {
				$cat_errors=$this->validator->getErrors();
				foreach ($cat_errors as $error) :
						 $isfail=$error;
					 endforeach;
				echo "$isfail";
				
			}
			else{
					$obj=new CategoriesModel();
					$obj->editCategory($catid,$catname, $is_show);
					echo true;
				
				}//end else error
			
			}//end if post
			}
//________________________________________________________________________________________________________________________

public function getdata(){
	if (strtolower( $_SERVER['REQUEST_METHOD']) == 'post' ) {
		$categoryid  = $this->request->getPost('categoryid');
		$obj=new CategoriesModel();
		$selected_data=$obj->getCategoryRow($categoryid);
		echo json_encode($selected_data);;
	}
}
//_________________________________________________________________________________________________________________________________________
public function delete(){

	if (strtolower( $_SERVER['REQUEST_METHOD']) == 'post' ) {
	$catname  = $this->request->getPost('categoryid');
	$obj=new CategoriesModel();
  	$data=$obj->deleteCategory($catname);
	echo $data;

	}
}
//____________________________________________________________________________________________________________________________
	
}
?>