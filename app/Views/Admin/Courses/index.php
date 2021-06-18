<?php echo view('Views/Admin/adminlayout');?>

<!--for dashboard content___________________________________________________________________________________________-->

<div class="body-content">
<!--________________________________________________________________________________________________________________-->
<!-- Button trigger modal for add new course  -->
<a type="button" class="col-12 nav-link text-center nav-custom-link nav-link-bc addcourse" data-toggle="modal" data-target="#coursemodal">
  Add new Course
</a>
<!--________________________________________________________________________________________________________________-->
<!--list courses--> 
<div class="table-res" > 
  <table class="w-100 mt-2">
  <thead class="categories-table-thead">
    <tr>
     <th class="d-none">Id</th>
      <th class="">title</th>
      <th class="">Description</th>
      <th class="">category</th>
      <th class="">Is show</th>
      <th class="">Edit</th>
      <th class="">Delete</th>
    </tr>
  </thead>
  <tbody >
    <?php foreach ($courses as $course) { ?>
      <tr class="categories-table-row"id="<?php echo $course["course_id"]; ?>">
        <td class="d-none" ><?php echo $course["course_id"]; ?></td> 
        <td class=""><?php echo $course["title"]; ?></td> 
        <td class=""><?php echo $course["description"]; ?></td>
        <td class=""><?php echo $course["category_name"]; ?></td>
        <td class=""><?php if($course["is_hide"]==1)echo 'yes'; else echo 'no'; ?></td>
        <td class=""><a type="button" class="nav-link  nav-custom-link nav-link-bc fas fa-edit editcourse" data-toggle="modal" data-target="#coursemodal"></a></td>
        <td class=""><a href="#"class="delete fas fa-trash nav-link  nav-custom-link nav-link-bc "> </a></td>
      </tr>
      <?php }?>
  </tbody>
</table>
</div>

<!--_________________________________________________________________________________________________________________________-->
 <!-- Add course Modal -->
<div class="modal fade" id="coursemodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="AddNewCategory" aria-hidden="true">
<div class="modal-dialog  modal-dialog-centered">
  <div class="modal-content custom-modal ">
      <div id="" class=" mt-1 text-success text-center message msuccess"></div>     
      <div id=""  class="text-danger text-center mt-2 name_error merror"></div>
    <div class="m-header text-center pt-1">
      <h5 class="modal-title lbl" id="title"></h5>
    </div>
      <form  enctype="multipart/form-data">
        <div class="m-body p-3 ">
          <div class="form-group">
            <label for="coursetitle" class="required lbl">Course Title</label>
            <input type="text" class="form-control title" id="coursetitle" placeholder="Course title">
          </div>

          <div class="form-group" >
            <label for="coursedesc" class="required lbl">Course description</label>
            <textarea class="form-control desc" id="coursedesc" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="coursecat"class="required catname lbl">Course category</label>
            <select class="form-control coursecat" id="coursecat">
            <?php foreach ($Categories as $category) { ?>
              <option><?php echo $category["category_name"]; ?></option>
            <?php }?>
            </select>
          </div>

          <div class="form-group">
            <label for="coursevl"class="required lbl">video link</label>
            <input type="text" class="form-control vlink" id="coursevl" placeholder="video link">
          </div>
          <div class="form-group">
            <label for="courseIl"class="required lbl">image link</label>
            <input type="text" class="form-control Ilink" id="courseIl" placeholder="Image link">
          </div>
          <div class="form-group">
            <label for="coursefile" class="required lbl">pdf file</label>
            <input type="file" name="file" accept=".pdf" class="form-control-file pdffile" id="file">
            <span class="fileuploaded"> </span>
          </div>
          <div class="form-group">  
             <div class="input-group mb-3">
                <div class="custom-control custom-switch ">
                    <input class="form-check-input show" name="catshow" type="checkbox" id="show" >
                     <label class="form-check-label show lbl" for="show" >show in public website</label>
                 </div>
              </div>
           </div> 
          <input type="text" class="form-control  courseid" id="courseid">
        
        <div class="m-footer pb-1 pt-1  text-center">
          <button type="submit" class="btn cls " data-dismiss="modal"  onclick="javascript:window.location.reload()">Close</button>
          <button type="submit" class="btn save add" name="add" id="add"  >Save Add</button>
          <button type="submit" class="btn save edit" name="edit" id="edit"  >Save edit</button>
        </div>
      </form>
    </div>
 </div>
</div>
</div>
<!--________________________________________________________________________________________________________-->
<script>
//_____________________________________________________________________________________________
//hide edit button when click save button 
$(".addcourse").click(function(){
  var x = document.getElementById("edit");
      x.style.display = "none";
  var courseId = document.getElementById("courseid");
      courseId.style.display = "none";

      $('#title').html("Add Course");
});
//--------------------------------------------------------------------------------------------------------
$('.add').click(function() {
    event.preventDefault();

    var title=$('.title').val().trim();
    var desc=$('.desc').val().trim();
    var vlink=$('.vlink').val().trim();
    var Ilink=$('.Ilink').val().trim();
   var pdffile=$('.pdffile').val().trim();
    var coursecat=$('.coursecat').val().trim();
    var isHide;
    if($('#show').is(':checked')){
    isHide='on';
    }else 
    isHide='off';


    var fd = new FormData();
    var files = $('.pdffile')[0].files;
fd.append('title',title);
fd.append('desc',desc);
fd.append( 'vlink',vlink);
fd.append('Ilink',Ilink,);
fd.append('coursecat',coursecat);
fd.append('isHide',isHide);
fd.append('pdffile',pdffile);
    if(files.length > 0 ){
    fd.append('file',files[0]);}
      $.ajax({  
          url:"<?php echo base_url('Admin/courses/add');?>" , 
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(issuccess) {
            if(issuccess==true){
              $('.msuccess').html("Added Successfully ");
              $('.merror').html('');       
            }
            else{
            var array = JSON.parse(issuccess)
            var errors='';
            if(array['title']!=null)
              errors=array['title']+"<br>";
            if(array['desc']!=null)
              errors=errors+array['desc']+"<br>";
            if(array["vlink"]!=null)
              errors=errors+array["vlink"]+"<br>";
            if(array["Ilink"]!=null)
              errors=errors+array["Ilink"]+"<br>";
            if(array["pdffile"]!=null)
              errors=errors+array["pdffile"]+"<br>";
            $('.merror').html(errors);
            $('.success').html('') ;                       
            }
          },               
          error: function(){alert('not sent');},
      });//end ajax
    

  });//end onclik


//____________________________________________________________________________________________________________________
$(".editcourse").click(function(){
     var save = document.getElementById("add");
     save.style.display = "none";

    var courseid = document.getElementById("courseid");
    courseid.style.display = "none";

    $('#title').html("Edit Course");

    var cid = $(this).parents("tr").attr("id");
    $('#courseid').val(cid);
    $.ajax({
            url:  "<?php echo base_url('Admin/courses/getdata'); ?>",
            type: 'post',
            data:{cid:cid,},
            error: function() {
              alert('not sent');
              },
            success: function(data) {
                var array = JSON.parse(data);
                $('.modal .title').val(array["title"]);
                $('.modal .desc').val(array["description"]);
                $('.modal .vlink').val(array["video_link"]);
                $('.modal .Ilink').val(array["img_path"]);
                $('.modal .coursecat').val(array["category_name"]);
              //  $('.modal .fileuploaded').html(array["pdf_path"]);
               if(array["is_hide"]!=0)
                $('.modal .show').attr('checked', true);
                
              }
              
          });
  });

//-----------------------------------------------------------------------------------------------------------------

$('.edit').click(function() {
  event.preventDefault();
var cid=$('.courseid').val().trim();
var title=$('.title').val().trim();
var desc=$('.desc').val().trim();
var vlink=$('.vlink').val().trim();
var Ilink=$('.Ilink').val().trim();
var pdffile=$('.pdffile').val().trim();
var coursecat=$('.coursecat').val().trim();
var isHide;
if($('#show').is(':checked')){
isHide='on';
}else 
isHide='off';

var fd = new FormData();
var files = $('.pdffile')[0].files;
fd.append('title',title);
fd.append('desc',desc);
fd.append( 'vlink',vlink);
fd.append('Ilink',Ilink,);
fd.append('coursecat',coursecat);
fd.append('isHide',isHide);
fd.append('pdffile',pdffile);
fd.append('cid',cid);
if(files.length > 0 ){
fd.append('file',files[0]);}

  $.ajax({  
      url:"<?php echo base_url('Admin/courses/edit');?>" , 
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(issuccess) {
        if(issuccess==true){
          $('.msuccess').html("Added Successfully ");
          $('.merror').html('');       
        }
        else{
        var array = JSON.parse(issuccess)
        var errors='';
        if(array['title']!=null)
          errors=array['title']+"<br>";
        if(array['desc']!=null)
          errors=errors+array['desc']+"<br>";
        if(array["vlink"]!=null)
          errors=errors+array["vlink"]+"<br>";
        if(array["Ilink"]!=null)
          errors=errors+array["Ilink"]+"<br>";
        $('.merror').html(errors);
        $('.success').html('') ;                       
        }
      },               
      error: function(){alert('not sent');},
  });//end ajax


  });//end onclik










//__________________________________________________________________________________________________________________________

 $(".delete").click(function(){
 var id = $(this).parents("tr").attr("id");
 if(confirm('Are you sure to delete this course ?'))
 {
     $.ajax({
     url:"<?php echo base_url('Admin/courses/delete');?>",
     type: 'post',
       data:{
            id:id
           },
     success: function(data) {
         if(data)
            { $("#"+id).remove();
             alert("Course deleted successfully"); 
             window.location.reload() ; }
             else
             alert("there is an error"); 
     },
     
     error: function() {
         alert('not send');
     },
     });
 }
}); 
        
           

//_________________________________________________________________________________________________________
</script>
