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
  newUser(2,"Youre regustration will be approved soon ");
});



//_______________________________________________________________________________________________


</script>