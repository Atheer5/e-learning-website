<div class="body-content ">
<div class="row d-flex justify-content-evenly">
    
<div class="w-100 mb-3">
    <div class="col-lg-4 col-md-12  float-right">
        <div class="form-group input-group input-group-sm my-auto">
            <label class="input-group-prepend" for="sort">
                <span class="input-group-text">Sort By:</span>
            </label>
            <select id="sort" class="form-control sort" >
                <option value="1">Course title (A-Z)</option>
                <option value="2">Course title (Z-A)</option>
                <option value="3"selected="selected">Date (new-old)</option>
                <option value="4">Date  (old-new)</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="form-group input-group input-group-sm my-auto">
            <label class="input-group-prepend" for="limit">
                <span class="input-group-text">number of item in page</span>
            </label>
            <select id="limit" class="form-control">
                <option value="1" >5</option>
                <option value="2"selected="selected">10</option>
                <option value="3">15</option>
                <option value="4">20</option>
                <option value="5">25</option>
                <option value="6"30>30</option>
            </select>
        </div>
    </div>
</div>

    <?php foreach ($courses as $course) { ?>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2 align-items-stretch card ml-4 mr-3 mb-5">
            <img src="<?php echo $course["img_path"]; ?>" class="mt-2 card-img-top img-thumbnail cardimage" alt="<?php echo $course["title"]; ?>">
            <div class="card-body">
                <div class="card-title p-0 p-lg-3"> <p class="font-weight-bold"><?php echo $course["title"]; ?></p></div>
                <div class="card-content p-0 p-lg-3"><p class=""><?php echo $course["description"]; ?></p></div>
            </div>    
            <?php $courseid=$course["course_id"]; $coursetitle=$course["title"];$categoryid=$course["categoryid"]?>
            <div class=" text-center link_to_course pb-2"><a class="" href="<?php echo base_url("Users/singleCourse/index/?courseid=$courseid&coursetitle=$coursetitle&categoryid=$categoryid");?>">Go To Course</a></div>
        </div>
           
    <?php }?>
</div>

<div class="d-flex justify-content-center">
    <nav  >
        <ul class="pagination pagination-lg col-6">
            <?php for($pagenum=1;$pagenum<=$count_of_page;$pagenum++):?>
                <li class="page-item"id=<?php echo $pagenum;?>><button  class="page-link paginationbtn"><?php echo $pagenum?></button></li>
            <?php endfor?>
        </ul>
    </nav>
</div>
    
    




</div>
<!--_________________________________________________________________________--->
<script>
//save selected value from sort select in localstorage 
var selected = localStorage.getItem('sorttype');
if (selected) {
  $("#sort").val(selected);//rest  value by selected value 
}
$("#sort").change(function() {
        localStorage.setItem('sorttype', $(this).val());//return 1 2 3 4 => title a-z,z-a,date new-old,date old-new
        switch($(this).val()) {
    case '1':
        {   localStorage.setItem('sortype','ASC');
            localStorage.setItem('sortby','title');
        }
        break;
    case '2':
        {   localStorage.setItem('sortype','DESC');
            localStorage.setItem('sortby','title');
        }
        break;
    case '3':
        {   localStorage.setItem('sortype','DESC');
            localStorage.setItem('sortby','date');
        }
        break;
    case '4':
        {   localStorage.setItem('sortype','ASC');
            localStorage.setItem('sortby','date');
        }
        break;
    }
    if(localStorage.getItem('fromcategory')==2){
        var catid=localStorage.getItem('catid');
        var cattitle=localStorage.getItem('cattitle')
        setcategoryurl(catid,cattitle);
    }
    else{
        seturl();
        }

});
//____________________________________________________________________________________
var limited = localStorage.getItem('limitval');
if (limited) {
  $("#limit").val(limited);

  }//end if 


$("#limit").change(function() {
    localStorage.setItem('limitval', $(this).val());
    switch($(this).val()) {
        case '1': 
            {   localStorage.setItem('limitnum',5);}
            break;
        case '2':
            {   localStorage.setItem('limitnum',10);}
            break;
        case '3':
            {   localStorage.setItem('limitnum',15);}
            break;
        case '4':
            {   localStorage.setItem('limitnum',20);}
            break;
        case '5':
            {   localStorage.setItem('limitnum',25);}
            break; 
        case '6':
            {   localStorage.setItem('limitnum',30);}
            break;  
    }
    if(localStorage.getItem('fromcategory')==2){
        var catid=localStorage.getItem('catid');
        var cattitle=localStorage.getItem('cattitle')
        setcategoryurl(catid,cattitle);
    }
    else{
        seturl();
        }
   
});

//______________________________________________________________________
$(".paginationbtn").click(function(){
    var pagenumber=$(this).parent("li").attr("id");
    localStorage.setItem('pagenum',pagenumber);
    
    
    if(localStorage.getItem('fromcategory')==2){
        var catid=localStorage.getItem('catid');
        var cattitle=localStorage.getItem('cattitle')
        setcategoryurl(catid,cattitle);
    }
    else{
        seturl();
        }

});

</script>
