<div class="modal-dialog  modal-dialog-centered" >
    <div class="modal-content custom-modal ">
      <div class="m-header text-center pt-5">
        <h5 class="modal-title " id="staticBackdropLabel">Login </h5>
      </div> 
            <form id="loginform">
              <div class="m-body p-5 ">              
                  <div class="form-group">
                  <label for="email"class="required">Email</label>
                  <input type="email" class="form-control uemail" id="email" placeholder="email" name="uemail">
                </div>

                <div class="form-group">
                  <label for="pwd" class="required">Passowrd</label>
                  <input type="password" class="form-control upwd" id="pwd" placeholder="password" name="upwd">
                </div>

                <div class="form-group">
                <i>Don't have an account yet?</i>
                <a type="button" class="nav-custom-link userRegister" data-toggle="modal" id="myBtn" data-target="#register" >
                    Sign up
                </a>
                </div>
                
           
              <div class="m-footer pb-5 text-center">
                <button type="button" class="btn cls " data-dismiss="modal">Close</button>
                <button type="button" class="btn save login">login </button>
              </div>
                   
           </form>
    </div>
 </div>
<!--____________________________________________________________________________________________________________-->
<div class="modal fade" id="register" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="users" aria-hidden="true">
    <?php echo view('Views/Users/Register');?>
</div>
<!--_________________________________________________________________________________________________________________________-->
 <script>
$("#myBtn").click(function(){
    $("#login").modal("hide");
  });

  //_______________________________________________________________________________________________

  $(".login").click(function(){
      var user_email=$('.uemail').val().trim();
      var user_pwd=$('.upwd').val().trim();
       $.ajax({
            url:"<?php echo base_url('Home/login');?>",
            type: 'post',
            data:{
                uemail:user_email,
                upwd:user_pwd,
                },
            success: function(data) {
                    var array = JSON.parse(data);
                    if(array==null)                 
                        alert("We couldn't sign you in, Email or password is incorrect");
                   else {
                   if(array["is_admin"]==1){
                    var admin_dashboard  ="<?php echo base_url('Admin/Users');?>";
                    user_email.value=array["id"];
                    document.getElementById("loginform").action = admin_dashboard;
                    document.getElementById("loginform").method ='post';
                    document.getElementById("loginform").submit();
                   }//login as admin 
                   else{
                    var admin_dashboard  ="<?php echo base_url('Home/index');?>";
                    document.getElementById("loginform").action = admin_dashboard;
                    document.getElementById("loginform").method ='post';
                    document.getElementById("loginform").submit();
                   }//login as user
              }
                     
                    
            },            
            error: function() {
                alert('not send');
            },
            });
        
    });
  
</script>

