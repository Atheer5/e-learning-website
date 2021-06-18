<?php echo view('Views/Admin/adminlayout');?>
<div class="body-content">
<div class="table-res " >
  <table class="w-100  mt-2 ">
  <thead class="categories-table-thead">
    <tr>
     <th class="d-none">Id</th>
      <th class="">Name</th>
      <th class="">Email</th>
      <th class="">Click to Approve registration</th>
    </tr>
  </thead>
  <tbody >
    <?php foreach ($Users as $User) { ?>
      <tr class="categories-table-row" id="<?php echo $User["id"]; ?>"  em="<?php echo $User["email"]; ?>">
        <td class="d-none"><?php echo $User["id"]; ?></td> 
        <td class=""><?php echo ($User["fname"] ." ".$User["lname"]); ?></td>
        <td class=""  ><?php echo $User["email"]; ?></td>
        <td class="">
          <a type="button" class="fas fa-check-circle nav-link text-center nav-custom-link nav-link-bc approveaccount"></a>
        </td>
      </tr>
    <?php }?>
  </tbody>
</table> 
</div>

</div>

<!--_______________________________________________________________________________________________________________-->
<script>
    $(".approveaccount").click(function(){
    var uid = $(this).parents("tr").attr("id");
    var email = $(this).parents("tr").attr("em");
     
    $.ajax({
            url:  "<?php echo base_url('Admin/Users/approveAccount'); ?>",
            type: 'post',
            data:{uid:uid,
                  email:email,
                  },
            error: function() {
              alert('not send');
              },
            success: function(data) {
                alert("Accout approved successfully");
                window.location.reload();
                
              }
              
          });
});
</script>