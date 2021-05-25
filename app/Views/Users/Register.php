<div class="body-content"> 

<!--_________________________________________________________________________________________________________________________-->
  <?php echo view('Views/shared/Register');?>
<!--_____________________________________________________________________________________________________________________--->

</div>

<!--_________________________________________________________________________________________-->
 
<script>
$(".userRegister").click(function(){
  var x = document.getElementById("edit");
      x.style.display = "none";
  var catId = document.getElementById("userid");
    catId.style.display = "none";
  $('#title').html("Rigister");
  var toggle=document.getElementById("tog");
  toggle.style.display = "none";

});
//_________________________________________________________________________________________________________
//add user same as in admin add without toggle;
//do client validation
//sent email welcom to user 

//________________________________________________________________________________________________

$(".userRegister").click(function(){
  $.validator.addMethod("alphanumeric", function(value, element) {
    var regex = new RegExp(/^[a-zA-Z\s]+$/);
    return value.match(new RegExp(regex));
  });


  $(".registration").validate({
    rules: {
      fname: {required: true,
              alphanumeric: true,
             },
      lname: {required: true,
              alphanumeric: true,
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
              alphanumeric:"The first name must contain alpha characters and space only"
            },
      lname: {required:"Please enter your lastname",
              alphanumeric:"The last name must contain alpha characters and space only"
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
      $.ajax({
          type: 'POST',  
          url:"<?php echo base_url('Admin/Users/add');?>" , 
          data: {
          },
          success: function(issuccess) { 
            
          },              
          error: function(){alert('not sent');},
      });//end ajax

     //___________________________________________ 
    }
  });
});



//_______________________________________________________________________________________________


</script>