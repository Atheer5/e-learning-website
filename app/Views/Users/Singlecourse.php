<div class="body-content">
<div class="coursematerial p-0 p-md-5">
    <div class="col-12 mb-5 text-center " ><h2><?php echo $course["title"]?></h2></div>
    <div class="mt-5 row">
        <div class="col-12 col-md-6">
            <div>Course Description:</div>
            <div><?php echo $course["description"]?></div>
        </div>
        <div class="col-6 col-md-6"><img class="courseimg img-thumbnail"src="<?php echo $course["img_path"];?>"></div>
    </div>
    <?php if (session('login')) : ?>
    <div class="mt-5 row ">
        <div class="col-12 col-md-6">
            <div>pdf materials:</div>
            <div>
              <a download  href="<?php echo base_url('uploads/'.$course["pdf_path"]) ?>"><i class="fas fa-file-pdf"></i>open and download pdf</a></div>
        </div>
        <div class="col-12 col-md-6">
            <iframe class=" coursevideo img-thumbnail"src=<?php echo $course["video_link"]?>></iframe>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!session('login')) : ?>
    <div class="mt-5 row ">
        <div class="col-12 col-md-6">
            <div>pdf and video materials:</div>
            <div class="text-secondary"><i class="fas fa-file-pdf"></i> ...hide...</div>
        </div>
    </div>
    <?php endif; ?>

    <div class="col-12 text-muted"><?php echo $course["date"]?></div>
</div>

<div id="carouselExampleControls" class="carousel slide " data-ride="carousel">
  <div class="carousel-inner slider">
    <div class="carousel-item active ">
      <img src="https://miami.asa.edu/wp-content/uploads/2019/09/ab45136d-828f-44e3-bbf5-5f04173c8cd9.jpg" class="img-thumbnail slidercourseImage rounded mx-auto d-block mt-5 mb-5" alt="Welcome">    
    </div>
    <?php foreach ($relatedcourse as $course) { ?>
    <div class="carousel-item text-center">        
        <?php $courseid=$course["course_id"]; $coursetitle=$course["title"]; $categoryid=$course["categoryid"];?>
            <a  class="nav-link nav-custom-link set-item-center"href="<?php echo base_url("Users/singleCourse/index/?courseid=$courseid&coursetitle=$coursetitle&categoryid=$categoryid");?>">     
                <span class="mb-5 "><?php echo $course["title"]; ?></span>  
                <img src="<?php echo $course["img_path"]; ?>" class=" img-thumbnail slidercourseImage rounded mx-auto d-block mb-3" alt="<?php echo $course["title"]; ?>" >   
            </a>
    </div>
    <?php }?> 
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
 
</div>