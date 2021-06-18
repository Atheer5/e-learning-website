<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');

    }
//_____________________________________________________________________________________________________________________________________________
public function selectallUsers(){
    $this->builder->where('is_admin',0);
    return $this->builder->get()->getResultArray();
    
}
//_____________________________________________________________________________________________________________________________________________________
public function add($fname,$lname,$email,$pwd,$suspend,$admin,$not_approveed){

    if($suspend =='on')
        { $suspend=1;}
    else{$suspend=0;}

    
    



$array = [
    'email' => $email,
    'fname' => $fname,
    'is_admin' => $admin,
    'is_suspend' => $suspend,
    'lname ' => $lname,
    'password' => $pwd,
    'not_approved' => $not_approveed, 
];


$this->builder->insert($array);


}//end add 
///____________________________________________________________________________________________________________________

public function getuserRow($uid){
   $this->builder->where('id', $uid);
   $data=$this->builder->get()->getRowArray();
    return $data;
 }

 //___________________________________________________________________________
 public function edituser($uid,$fname, $lname,$email,$password,$suspend){
    if($suspend =='on')
    { $suspend=1;}

    else{
        $suspend=0;
    }

    $array = [
        'id' => $uid,
        'fname' => $fname,
        'lname' => $lname,
        'email' => $email,
        'password' => $password,
        'is_suspend' => $suspend,

    ];
    $this->builder->where('id', $uid);
    $this->builder->update($array);


}
//__________________________________________________________________________________________________

public function login($user_email,$user_pwd){
    $this->builder->where('email', $user_email);
    if($this->builder->get()->getRowArray()){
        $this->builder->where('email', $user_email);
        $epassword=md5($user_pwd);
        $this->builder->where('password', $epassword);
        if($this->builder->get()->getRowArray()){
            $this->builder->where('email', $user_email);
            $epassword=md5($user_pwd);
            $this->builder->where('password', $epassword);
            $this->builder->where('is_suspend', 0);
            if($this->builder->get()->getRowArray()){
                $this->builder->where('email', $user_email);
                $epassword=md5($user_pwd);
                $this->builder->where('password', $epassword);
                $this->builder->where('is_suspend', 0);
                $data=$this->builder->get()->getRowArray();
                $data["err"]=0;
                return $data;
                //success login
                }
                else{
                    //is suspend
                    $data["err"]=1;
                     return $data;
                }

        }else{//error in pwd
            $data["err"]=2;
            return $data;
        }
    }else{//error in email
        $data["err"]=3;
        return $data;
    }


}
//___________________________________________________________________________________________________
public function selectnewusers(){
    $this->builder->where('not_approved',1);
    return $this->builder->get()->getResultArray();

}
//____________________________________________________________________________________________
public function approveAccount($uid){
   $this->builder->set('is_suspend',"0");
   $this->builder->set('not_approved',"0");
   $this->builder->where('id', $uid);
   return $this->builder->update();

   //send welcome message;

}
//_______________________________________________________________________________________________
}

?>