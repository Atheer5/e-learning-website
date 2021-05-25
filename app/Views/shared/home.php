
<div class="body-content " >
<div id="carouselExampleControls" class="carousel slide " data-ride="carousel">
  <div class="carousel-inner slider">
  <div class="carousel-item active ">
      <img src="https://voice.lifewest.edu/wp-content/uploads/2021/04/welcome.jpg" class="img-thumbnail sliderImage rounded mx-auto d-block mt-3 mb-3" alt="Welcome">    
    </div>

   <?php foreach ($courses as $course) { ?>
    <div class="carousel-item text-center">

    <?php $courseid=$course["course_id"]; $coursetitle=$course["title"]; $categoryid=$course["categoryid"];?>
              <a  class="nav-link nav-custom-link set-item-center"href="<?php echo base_url("Users/singleCourse/index/?courseid=$courseid&coursetitle=$coursetitle&categoryid=$categoryid");?>">       
                <span class="mb-5 "><?php echo $course["title"]; ?></span>  
                <img src="<?php echo $course["img_path"]; ?>" class=" img-thumbnail sliderImage rounded mx-auto d-block mb-3" alt="<?php echo $course["title"]; ?>" >   
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


