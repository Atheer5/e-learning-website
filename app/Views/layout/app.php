<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>E-Learning</title>
    <link href="<?php echo base_url('assets/css/elearning.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/css/elearningadminnnnnnnnn.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/css/fontawesome.min.css'); ?>" rel="stylesheet" />
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/elogo.png'); ?>" />
    <script src="<?php echo base_url('assets/js/jquery-3.6.0.min.js'); ?>" crossorigin="anonymous"></script>
    <?php if ($css) : ?>
        <link rel="stylesheet" href="<?php echo base_url($css); ?>">
    <?php endif; ?>

</head>

<body class="light-b"> 
        <nav class="col-12 navbar navbar-expand-md navbar-light nav-bc fixed-top">
            <a class="navbar-brand  text-left p-0  h-100  " href="<?php echo base_url('Home'); ?>">
                <img  class=" h-100 " src="<?php echo base_url('assets/images/enavlogo.png'); ?>">
            </a>
            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto   ">
                <?php if (!session('adminlayout')) : ?>
                    <li class="nav-item"><a class="nav-link nav-custom-link set-item-center" href="<?php echo base_url('Home'); ?>">Home</a></li>
                    <?php $limitnum = "10" ;$sortorder='DESC';$sortby='date';?>
                    <li class="nav-item"><a class="nav-link nav-custom-link set-item-center courselink ">Courses</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle nav-custom-link set-item-center " id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                            <div class="dropdown-menu dropdown-menu-right drop-down-list" aria-labelledby="userDropdown">
                            <?php foreach ($Categories as $category) { ?>
                                <?php $catid=$category["categoryid"]; $cattitle=$category["category_name"];?>
                                <a class="dropdown-item nav-custom-link drop-down-list-item categorylink" catid="<?php echo $catid; ?>" cattitle="<?php echo $cattitle; ?>" > <?php echo $category["category_name"]; ?></a>
                                <?php }?><!--pass category id to single category page -->
                            </div>
                    </li>
                <?php endif; ?> 
                    <?php if (!session('login')) : ?>
                        <li class="nav-item">
                            <a type="button" class="nav-link nav-custom-link set-item-center" data-toggle="modal" data-target="#login" id="log" >
                                login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a type="button" class="nav-link text-center nav-custom-link nav-link-bc set-item-center userRegister"  data-toggle="modal" data-target="#register" id="reg">
                                Sign up
                            </a>
                        </li>                  
                    <?php endif; ?>

                    <?php if (session('login')) : ?>
                    <li class="bg-secondary">   
                        <a type="button" class="nav-link  nav-custom-link text-dark set-item-center" >                   
                             <?php echo session('uname');?>
                        </a>   
                    </li>

                    <li class="bg-secondary">  
                        <a class="nav-link  dropdown-toggle nav-custom-link set-item-center text-dark " id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i></a>
                            <div class="dropdown-menu dropdown-menu-right drop-down-list" aria-labelledby="userDropdown"> 
                                <a class="dropdown-item nav-custom-link drop-down-list-item text-dark" >                   
                                    <i class="fas fa-user"></i> profile  
                                </a> 
                                <a class="dropdown-item nav-custom-link drop-down-list-item text-dark" href="<?php echo base_url('Home/logout'); ?>">                  
                                <i class="fas fa-sign-out-alt"></i>  logout 
                                </a>
                            </div>  
                    </li>
                    <?php endif; ?>

                    
                </ul>
            </div>
        </nav>
        <!--________________________________________________________________________________________-->
        <!-- Navbar Search-->
    <?php if (!session('adminlayout')) : ?>
        <div class="row d-flex justify-content-center search-bar pb-3 mr-0 ml-0" >
            <div class="col-4 pr-0 pt-3"id="search">
                <form class="">
                    <div class="input-group w-100" >
                        <input class="form-control search-form searchin"type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />                                         
                        <div class="input-group-append w-25 ">
                            <button type="button" class=" btn   w-100 ml-auto  search-btn searchbtn" type="button" id="searchbtn"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
        <!--end navbarsearch-->
    <?php endif; ?>   
         <!--end topnav-->  
            <main class="mb-5">           
                <div class="container-fluid ">
                    <div class="row">
                        <div class="col-12 text-center pagetitle">
                            <h1 class="my-4 c-blue"><?php echo $page_title; ?></h1>                           
                              
                        </div>
                    </div>

                    <?php echo view($view_file, $controller_data); ?>

                </div>

            </main>


            <footer class="py-4 dark-blue mt-5  mt-5 ">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-center small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer> 
    <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('assets/js/admin.js'); ?>"></script>
    <?php if ($js) : ?>
        <script src="<?php echo base_url($js); ?>"></script>
    <?php endif; ?>




<!--____________________________________________________________________________________________________________-->
<div class="modal fade" id="register" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="users" aria-hidden="true">
    <?php echo view('Views/Users/Register');?>
</div>
<!--_________________________________________________________________________________________________________________________-->
<div class="modal fade" id="login" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="users" aria-hidden="true">
    <?php echo view('Views/shared/login');?>
</div>
 

 <!--_________________________________________________________________________________________________________---->

 
 </body>
</html>
 
<!--__________________________________________________________________________________________________________--->
 <script>
     $(".searchbtn").click(function(){
        var coursetitle=$('.searchin').val().trim();        
            $.ajax({
            url:"<?php echo base_url('Home/search');?>",
            type: 'post',
            data:{
                    title:coursetitle,
                },
            success: function(data) {
                    var array = JSON.parse(data);
                    if(array==null)                 
                        alert("Your search did not match any course title. Please make sure that all words are spelled correctly .");
                    else {
                    window.location.href ="http://e-learning.test/Users/singleCourse/index?courseid="+array["course_id"]+"&coursetitle="+array["title"]+"&categoryid="+array["categoryid"];
              }
                     
                    
            },            
            error: function() {
                alert('not send');
            },
            });
        
    }); 
//___________________________________________________________________________________________________________________
    
    $(".courselink").click(function(){
        localStorage.setItem('fromcategory',1);
        localStorage.setItem('pagenum',1);
        localStorage.setItem('limitnum',10);
        localStorage.setItem('sortby','date');
        localStorage.setItem('sortype','DESC');
        localStorage.setItem('limitval',2);
        localStorage.setItem('sorttype',3);
        seturl()
        
    });


function seturl(){
    var selectedlimit=localStorage.getItem('limitnum');
    var pagenum =localStorage.getItem('pagenum')
    var selectedsortby=localStorage.getItem('sortby');
    var selectedsorttype=localStorage.getItem('sortype');pagenum
    if(selectedlimit==null){selectedlimit=10};
    if(selectedsortby==null)selectedsortby='date';
    if(selectedsorttype==null)selectedsorttype='DESC';
    if(pagenum==null){offset=0;}
    else{
        if(selectedlimit==null) offset=0;
        else offset=selectedlimit*(pagenum-1);} 


    window.location.href ="http://e-learning.test/Users/courses/index?limitnum="+selectedlimit+"&sortby="+selectedsortby+"&sortorder="+selectedsorttype+"&offsetval="+offset;

}
//____________________________________________________________________________________________________________________________

$(".categorylink").click(function(){
        localStorage.setItem('fromcategory',2);
        localStorage.setItem('pagenum',1);
        localStorage.setItem('limitnum',1);
        localStorage.setItem('sortby','date');
        localStorage.setItem('sortype','DESC');
        localStorage.setItem('limitval',2);
        localStorage.setItem('sorttype',3);
        var cattitle=$(this).attr("cattitle");
        var catid=$(this).attr("catid");
        localStorage.setItem('catid',catid);
        localStorage.setItem('cattitle',cattitle);
        setcategoryurl(catid,cattitle);
   });



function setcategoryurl(catid,cattitle){
    var selectedlimit=localStorage.getItem('limitnum');
    var pagenum =localStorage.getItem('pagenum')
    var selectedsortby=localStorage.getItem('sortby');
    var selectedsorttype=localStorage.getItem('sortype');pagenum
    if(selectedlimit==null){selectedlimit=10};
    if(selectedsortby==null)selectedsortby='date';
    if(selectedsorttype==null)selectedsorttype='DESC';
    if(pagenum==null){offset=0;}
    else{
        if(selectedlimit==null) offset=0;
        else offset=selectedlimit*(pagenum-1);
    } 
    window.location.href ="http://e-learning.test/Users/singleCategory/index?limitnum="+selectedlimit+"&sortby="+selectedsortby+"&sortorder="+selectedsorttype+"&offsetval="+offset+"&categoryid="+catid+"&categorytitle="+cattitle;

}
//________________________________________________________________________________________________________________
 </script>

        
