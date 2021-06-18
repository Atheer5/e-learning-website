<?php echo view('Views/Admin/adminlayout');?>
<div class="body-content"> 
<!--________________________________________________________________________________________________________________-->
<!-- Button trigger modal for add new category  -->
<a type="button" class="col-12 nav-link text-center nav-custom-link nav-link-bc addcat" data-toggle="modal" addcat data-target="#categorymodal">
  Add new Category
</a>
<!--________________________________________________________________________________________________________________-->
<!--list categories-->
<div class="table-res" >
    <table class="w-100 mt-2">
    <thead class="categories-table-thead">
      <tr>
        <th class="d-none">ID</th>
        <th class="">Name</th>
        <th class="">is show</th>
        <th class="">Edit</th>
        <th class="">Delete</th>
      </tr>
    </thead>
    <tbody >    
      <?php foreach ($Categories as $category) { ?>
        <tr class="categories-table-row" id="<?php echo $category["categoryid"]; ?>">
        <td class="d-none" ><?php echo $category["categoryid"]; ?></td>
        <td class="" ><?php echo $category["category_name"]; ?></td>
        <td class=""><?php if($category["is_show"]==1)echo 'yes'; else echo 'no'; ?></td>
        <td class="">
            <a type="button" class="editcat fas fa-edit nav-link text-center nav-custom-link nav-link-bc" data-toggle="modal" data-target="#categorymodal">
            </a>
        </td>        
        <td class="">
        <a role="button" class=" delete fas fa-trash nav-link  nav-custom-link nav-link-bc" > </a>
        </td>
      </tr>
      <?php }?>
    </tbody>
  </table>
</div>
<!--______________________________________________________________________________________________________________________-->
<div class="modal fade" id="categorymodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="EditNewCategory" aria-hidden="true">   
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content custom-modal ">
      <div id="message" class=" mt-2 text-success text-center message"></div>     
      <div id="name_error"  class="text-danger text-center mt-2 name_error"></div>
      <div class="m-header text-center pt-3">
        <h5 class="modal-title lbl" id="title"></h5>
      </div>        
          <form id="contact_form">
              <div class="m-body p-5 text-center">
                <div class="form-group">  
                  <div class="input-group mb-3">
                    <div class="input-group-prepend lbl">
                      <span class="input-group-text required " id="basic-addon2">Category Name</span>
                    </div>
                        <input type="text" class="form-control catname "placeholder="Category name" name="catname" id="catname">
                  </div>
                </div>
                <div class="form-group">  
                  <div class="input-group mb-3">
                    <div class="custom-control custom-switch ">
                          <input class="form-check-input show" name="catshow" type="checkbox" id="show" >
                          <label class="form-check-label lbl" for="show" >show in public website</label>
                    </div>
                  </div>
                </div> 
                <input type="text" class="form-control catid " id="catid">                        
              </div>
              <div class="m-footer pb-5 text-center">
                <button type="submit"class="btn cls " data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
                <button type="button" class="btn save add" name="add" id="add"  >Save Add</button>
                <button type="button" class="btn save edit" name="edit" id="edit"  >Save edit</button>
              </div>
          </form>
        </div>
      </div>
</div>
<!--__________________________________________________________________________________________________________________-->
<script>
//delet row fromtable and database ................................
    $(".delete").click(function(){
    var catid = $(this).parents("tr").attr("id");
    if(confirm('Are you sure to delete this record ?'))
    {
        $.ajax({
          url:  "<?php echo base_url('Admin/categories/delete'); ?>",
          type: 'post',
          data:{categoryid:catid,},
            error: function() {
              alert('not send');
            },
            success: function(data) {
              if(data){
                $("#"+catid).remove();
                alert("Record removed successfully"); 
              }
              else
              alert("you cant delete this category "); 
                 
            }
        });
    }
    }); 
//__________________________________________________________________________________________________________________
//get data to be edit and hide save button .................................
$(".editcat").click(function(){
     var save = document.getElementById("add");
     save.style.display = "none";

    var catId = document.getElementById("catid");
      catId.style.display = "none";

    $('#title').html("Edit Category");
    var catid = $(this).parents("tr").attr("id");
    $('.modal .catid').val(catid);
    $.ajax({
            url:  "<?php echo base_url('Admin/categories/getdata'); ?>",
            type: 'post',
            data:{categoryid:catid,},
              error: function() {
              alert('error');
              },
              success: function(data) {
                var array = JSON.parse(data)
                $('.modal .catname').val(array["category_name"]);
                if(array["is_show"]!=0)
                $('.modal .show').attr('checked', true)
            
              }
          });
  });
//--------------------------------------------------------------------------------------------------------
$('.edit').click(function() {
    event.preventDefault();  
    var catid=$('.catid').val();
    var catname=$('.catname').val();
    var isHide;
    if($('#show').is(':checked')){
    isHide='on';
    }else 
    isHide='off'
      $.ajax({
          type: 'POST',  
          url:"<?php echo base_url('Admin/categories/edit');?>" , 
          data: {
              categoryid:catid,
              catname:catname,
              catshow:isHide,
          },
          success: function(issuccess) {
          if(issuccess==true){
            $('.message').html("Updated Successfully");
            $('.name_error').html('');            
          }
          else{
              $('.name_error').html(issuccess);
              $('.message').html('');                       
          }
          },              
          error: function(){alert('not sent');},
      });//end ajax
  });//end onclik




//_____________________________________________________________________________________________
//hide edit button when click save button 
$(".addcat").click(function(){
  var x = document.getElementById("edit");
      x.style.display = "none";
  var catId = document.getElementById("catid");
      catId.style.display = "none";

      $('#title').html("Add Category");

});
//--------------------------------------------------------------------------------------------------------
$('.add').click(function() {
    event.preventDefault();   
    var cname=$('.catname').val().trim();
    var isHide;
    if($('.show').is(':checked')){
    isHide='on';
    }else 
    isHide='off'
      $.ajax({
          type: 'POST',  
          url:"<?php echo base_url('Admin/categories/add');?>" , 
          data: {
              catname:cname,
              catshow:isHide,
          },
          success: function(issuccess) {
            if(issuccess==true){
            $('.message').html("Added Successfully ");
            $('.name_error').html('');       
            }
            else{
              $('.name_error').html(issuccess);
              $('.message').html('')                         
            }
          },              
          error: function(){alert('not sent');},
      });//end ajax
  });//end onclik

//_______________________________________________________________________________________________________________________
</script>


