<?php echo view('Views/Admin/adminlayout');?>
<div class="body-content "> 
<!--________________________________________________________________________________________________________________-->
<!-- Button trigger modal for add new user  -->
<a type="button" class="col-12 nav-link text-center nav-custom-link nav-link-bc adduser" data-toggle="modal" data-target="#Usersmodal">
  Add new User
</a>
<!--________________________________________________________________________________________________________________-->
<!--list user-->
 
<div class="table-res " >
  <table class="w-100  mt-2 ">
  <thead class="categories-table-thead">
    <tr>
     <th class="d-none">Id</th>
      <th class="">Name</th>
      <th class="">Email</th>
      <th class="">Is suspend</th>
      <th class="">Edit</th>
    </tr>
  </thead>
  <tbody >
    <?php foreach ($Users as $User) { ?>
      <tr class="categories-table-row" id="<?php echo $User["id"]; ?>">
        <td class="d-none"><?php echo $User["id"]; ?></td> 
        <td class=""><?php echo ($User["fname"] ." ".$User["lname"]); ?></td>
        <td class=""><?php echo $User["email"]; ?></td>
        <td class=""><?php if($User["is_suspend"]==1)echo 'yes'; else echo 'no'; ?></td>
        <td class="">
          <a type="button" class="fas fa-edit nav-link text-center nav-custom-link nav-link-bc edituser" data-toggle="modal" data-target="#Usersmodal"></a>
        </td>
      </tr>
    <?php }?>
  </tbody>
</table> 
</div>
</div>
<!--_________________________________________________________________________________________________________________________-->
 
<div class="modal fade" id="Usersmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="users" aria-hidden="true">
    <?php echo view('Views/shared/Register');?>
</div>

<!--_____________________________________________________________________________________________________________________--->
<script>

//hide edit button when click save button 
$(".adduser").click(function(){
  var x = document.getElementById("edit");
      x.style.display = "none";
  var catId = document.getElementById("userid");
    catId.style.display = "none";
  $('#title').html("Add users");

});
//-----------------------------------------------------------------------
$('.add').click(function() {
  newUser(1,"Added Successfully ");
});//end add 
//__________________________________________________________________________________________________________________________

//_______________________________________________________________________________________________________________________________
//hide add button when click edit button and get data
$(".edituser").click(function(){
  var x = document.getElementById("add");
      x.style.display = "none";
  var catId = document.getElementById("userid");
    catId.style.display = "none";
  $('#title').html("Edit users");
    var uid = $(this).parents("tr").attr("id");
    $('.modal .uid').val(uid);    
    $.ajax({
            url:  "<?php echo base_url('Admin/Users/getdata'); ?>",
            type: 'post',
            data:{uid:uid,},
            error: function() {
              alert('error');
              },
            success: function(data) {
                var array = JSON.parse(data);
                $('.modal .fname').val(array["fname"]);
                $('.modal .lname').val(array["lname"]);
                $('.modal .email').val(array["email"]);
               if(array["is_suspend"]!=0)
                $('.modal .show').attr('checked', true);
                
              }
              
          });
});
//---------------------------------------------------------

$('.edit').click(function() {
    event.preventDefault();  
    var uid=$('.uid').val();
    var fname=$('.fname').val();
    var lname=$('.lname').val();
    var email=$('.email').val();
    var password=$('.pwd').val();
    var cpassword=$('.cpassword').val();
    var suspend=$('#show').is(':checked') ;
    var issuspend;
    if(suspend){
      issuspend='on';
    }else 
    issuspend='off';
      $.ajax({
          type: 'POST',  
          url:"<?php echo base_url('Admin/Users/edit');?>" , 
          data: {
              uid:uid,
              fname:fname,
              lname:lname,
              email:email,
              password:password,
              cpassword:cpassword,
              suspend:issuspend,
          },
          success: function(issuccess) {
          if(issuccess==true){
            $('.message').html("Updated Successfully");
            $('.name_error').html('');           
          }
          else{
            var array = JSON.parse(issuccess)
            var errors='';
            if(array['fname']!=null)
              errors=array['fname']+"<br>";
            if(array['lname']!=null)
              errors=errors+array['lname']+"<br>";
            if(array["email"]!=null)
              errors=errors+array["email"]+"<br>";
            if(array["password"]!=null)
              errors=errors+array["password"]+"<br>";
            if(array["cpassword"]!=null)
              errors=errors+array["cpassword"]+"<br>";
            $('.merror').html(errors);
            $('.success').html('') ;                       
            }
          },              
          error: function(){alert('not sent');},
      });//end ajax
  });//end onclik



  function welcomeUser(){
    var login=document.getElementById("log");
    login.style.display="red";
  }

  window.onload=welcomeUser();

//________________________________________________________________________________________________________________________________
</script>










































      