<?php

namespace App\Models;

use CodeIgniter\Model;

class coursesModel extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('courses');
        $this->builder2 = $this->db->table('categories');

    }
//______________________________________________________________________
//use by admin course page to select all category 
public function selectcourses(){
    $this->builder->join('categories', 'courses.categoryid = categories.categoryid');
    return $this->builder->get()->getResultArray();
    
}
//__________________________________________________________________________________________________
//use in user page to view courses  
public function selectallcourses($limit_num,$sortorder,$sortby,$offsetval){
    $this->builder->where('is_hide ',1);
    $this->builder->join('categories', 'courses.categoryid = categories.categoryid');
    $this->builder->orderBy($sortby,$sortorder);
    return $this->builder->limit($limit_num,$offsetval)->get()->getResultArray();
    
}
//_____________________________________________________________________________________________________________________________________________________

public function add($title,$desc,$vlink,$Ilink,$pdffile,$coursecat,$isHide,$date,$number_of_enrolment){
    
    if($isHide =='on')
        { $isHide=1;}
    else{$isHide=0;}

    $this->builder2->where('category_name',$coursecat);
	$category=$this->builder2->get()->getRowArray();
	$categoruId=$category['categoryid'];




$array = [
    'categoryid' => $categoruId,
    'description' => $desc,
    'img_path' => $Ilink,
    'is_hide' => $isHide, 
    'pdf_path' => $pdffile,
    'title' => $title,
    'video_link' => $vlink,
    'date' => $date,
    'number_of_enrolment' => $number_of_enrolment,
 
];


$this->builder->insert($array);
//return("$categoruId,10,$desc,$Ilink,$isHide,$pdffile,$title,$vlink");
 
}

//_______________________________________________________________________________________

public function deleteCourse($id){

   
    $this->builder->where('course_id', $id);
    if($this->builder->delete())
    return true;

   
}
//______________________________________________________________________________________________
public function getCourseRow($courseid){
    $this->builder->where('courses.course_id', $courseid);
    $this->builder->join('categories', 'courses.categoryid = categories.categoryid');
    $data=$this->builder->get()->getRowArray();
   return $data;

}
//_____________________________________________________________________________________
public function coursesInCategory($categoryid){
    $this->builder->where('is_hide ',1);
    $this->builder->where('categories.categoryid', $categoryid);
    $this->builder->join('categories', 'courses.categoryid = categories.categoryid');
    return $this->builder->get()->getResultArray();
} 
//________________________________________________________________________________________

public function edit($title,$desc,$vlink,$Ilink,$save_path,$coursecat,$isHide,$date,$cid){

    if($isHide =='on')
    { $isHide=1;}

    else{
        $isHide=0;
    }
    $this->builder2->where('category_name',$coursecat);
	$category=$this->builder2->get()->getRowArray();
	$categoruId=$category['categoryid'];

    $array = [
    'categoryid' => $categoruId,
    'description' => $desc,
    'img_path' => $Ilink,
    'is_hide' => $isHide, 
    'pdf_path' => $save_path,
    'title' => $title,
    'video_link' => $vlink,
    'date' => $date,
    ];
    $this->builder->where('course_id', $cid);
    $this->builder->update($array);


}


//____________________________________________________________________________________________
public function newestCourses(){

    
    $this->builder->orderBy('date','DESC');
    return $this->builder->limit(20,0)->get()->getResultArray();


}
//____________________________________________________________________________________________
public function searchBytitle($title){
    $this->builder->where('title', $title);
    $data=$this->builder->get()->getRowArray();
    return $data;
}
//_________________________________________________________________________________________________
//use for user category page 
public function scoursesInCategory($categoryid,$limitnum,$sortorder,$sortby,$offsetval){
    $this->builder->where('is_hide ',1);
    $this->builder->where('categories.categoryid', $categoryid);
    $this->builder->join('categories', 'courses.categoryid = categories.categoryid');
    $this->builder->orderBy($sortby,$sortorder);
    return $this->builder->limit($limitnum,$offsetval)->get()->getResultArray();
} 

//_____________________________________________________________________________________________________
public function countofrows(){
    $this->builder->where('is_hide ',1);
    return $this->builder->countAllResults();
     
}
//________________________________________________________________________
public function countofrowsincategory($categoryid){
    $this->builder->where('categories.categoryid', $categoryid);
    $this->builder->join('categories', 'courses.categoryid = categories.categoryid');
    return $this->builder->countAllResults();

}
    




}?>