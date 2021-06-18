<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>





<div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content custom-modal ">
      <div id="" class=" mt-1 text-success text-center message msuccess"></div>     
      <div id=""  class="text-danger text-center mt-2 name_error merror"></div>
      <div class="m-header text-center pt-1">
        <h5 class="modal-title lbl " id="title"></h5>
      </div> 
            <form action="" class="registration">
              <div class="m-body p-3 ">              
                <div class="form-group">
                  <label for="fname" class="required lbl">First name </label>
                  <input type="text" class="form-control fname" id="fname" placeholder="First name" name="fname">
                </div>

                <div class="form-group">
                  <label for="lname" class="required lbl">Last name </label>
                  <input type="text" class="form-control lname" id="lname" placeholder="Last name " name="lname">
                </div>

                <div class="form-group">
                  <label for="email"class="required lbl">Email</label>
                  <input type="email" class="form-control email" id="email" placeholder="email" name="email">
                </div>

                <div class="form-group">
                  <label for="pwd" class="required lbl">Passowrd</label>
                  <input type="password" class="form-control pwd" id="pwd" placeholder="password" name="pwd">
                </div>

                <div class="form-group">
                  <label for="cpwd" class="required lbl ">Confirm Passowrd</label>
                  <input type="password" class="form-control cpassword" id="cpwd" placeholder="confirm passowrd" name="cpwd">
                </div>

                <div class="form-group">  
                  <div class="input-group mb-3">
                    <div class="custom-control custom-switch "id="tog">
                          <input class="form-check-input show" name="catshow" type="checkbox" id="show" >
                          <label class="form-check-label lbl" for="show" >susspend</label>
                    </div>
                  </div>
                </div> 
                <input type="text" class="form-control uid " id="userid">
            
              </div>
              <div class="m-footer pb-1 text-center">
                <button type="button" class="btn cls " data-dismiss="modal" onclick="javascript:window.location.reload()">close</button>
                <button type="submit" class="btn save add" name="add" id="add"  >Register</button>
                <button type="button" class="btn save edit" name="edit" id="edit"  >Save edit</button>
                
              </div>
            </form>
    </div>
 </div>

<!--______________________________________________________________________________________________________----->
<script>
function newUser(byadmin,message){

  $.validator.addMethod("alphaspace", function(value, element) {
    var regex = new RegExp(/^[a-zA-Z\s]+$/);
    return value.match(new RegExp(regex));
  });


  $(".registration").validate({
    rules: {
      fname: {required: true,
              alphaspace: true,
             },
      lname: {required: true,
              alphaspace: true,
             },
    email: {
      required: true,
      email: true
          },
    pwd:{
      required: true,
      minlength:4,
      maxlength:24,

        },
    cpwd: {
      equalTo: ".pwd"

        },
    },
    messages: {      
      fname: {required:"Please enter your firstname",
             alphaspace:"The first name must contain alpha characters and space only"
            },
      lname: {required:"Please enter your lastname",
              alphaspace:"The last name must contain alpha characters and space only"
            },
      email: {required:"Please enter email",
              email:"email not valid ",
            }, 
      pwd: {required:"Please enter password",
            minlength:"must be 4 charachters at least ",
            maxlength:"must be less than 24 charachters ",
            
           },  
      cpwd: {equalTo:"password and confirm password not matches"}      
    },


    submitHandler: function(form) {
      event.preventDefault(); 
    var firstname=$('.fname').val().trim();
    var lastname=$('.lname').val().trim();
    var email=$('.email').val().trim();
    var password=$('.pwd').val().trim();
    var confirmpassword=$('.cpassword').val().trim();
    var isHide;
    if($('.show').is(':checked')){
    isactive='on';
    }else 
    isactive='off';

      $.ajax({
          type: 'POST',  
          url:"<?php echo base_url('Admin/Users/add');?>" , 
          data: {
              fname:firstname,
              lname:lastname,
              email:email,
              password:password,
              cpassword:confirmpassword,
              suspend:isactive,
              add:byadmin,
          },
          success: function(issuccess) {
            if(issuccess==true){
              $('.msuccess').html(message);
              $('.merror').html('');       
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
            $('.msuccess').html('') ;                       
            }
          },              
          error: function(){alert('not sent');},
      });//end ajax

     //___________________________________________ 
    },//end submit handler
  });//end form validate



}

</script>

