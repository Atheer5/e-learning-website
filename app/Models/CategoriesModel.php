<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriesModel extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('categories');
        $this->builder2 = $this->db->table('courses');

    }

//_____________________________________________________________________________________________________________________________________________
public function selectallCategories(){
    return $this->builder->get()->getResultArray();
    
}
//_____________________________________________________________________________________________________________________________________________________

    public function add($name,$show){

        if($show =='on')
    { $show=1;}

    else{
        $show=0;
    }



  $array = [
        'category_name' => $name,
       'is_show'=> $show,
    ];


   $this->builder->insert($array);


    }//end add 
//__________________________________________________________________________________________________________________________

public function getCategoryRow($categoryid){
   $this->builder->where('categoryid ', $categoryid);
   $data=$this->builder->get()->getRowArray();
   return $data;
}

//___________________________________________________________________________________________________________________________________________________

public function deleteCategory($categoryid){

   $this->builder2->where('categoryid ', $categoryid);
   $data=$this->builder2->get()->getRowArray();
   if($data==null){
    $this->builder->where('categoryid ', $categoryid);
    if($this->builder->delete())
    return true;

   }
   else{
       return false;
   }
    

}
//__________________________________________________________________________________________________________________________
public function editCategory($cid,$catname,$show){
    if($show =='on')
    { $show=1;}

    else{
        $show=0;
    }

    $array = [
        'categoryid' => $cid,
        'category_name' => $catname,
       'is_show'=> $show,
    ];
    $this->builder->where('categoryid', $cid);
    $this->builder->update($array);


}


//_________________________________________________________________________________________________________________________








}//end class





