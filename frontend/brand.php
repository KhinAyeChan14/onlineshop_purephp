<?php
	require 'php/dbConnect.php';
	require 'php/frontendheader.php';

	$sql = "SELECT * FROM brands";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$brands = $stmt->fetchAll(); // it get a object

?>
	<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> Brand Name </h1>
  		</div>
	</div>
	
	<!-- Content -->
	<div class="container mt-5">
		<div class="row mt-5">
            <div class="col">
                <div class="bbb_viewed_title_container">
                    <h3 class="bbb_viewed_title"> Brand Category Name  </h3>
                    <div class="bbb_viewed_nav_container">
                        <div class="bbb_viewed_nav bbb_viewed_prev"><i class="icofont-rounded-left"></i></div>
                        <div class="bbb_viewed_nav bbb_viewed_next"><i class="icofont-rounded-right"></i></div>
                    </div>
                </div>
                <div class="bbb_viewed_slider_container">
                    <div class="owl-carousel owl-theme bbb_viewed_slider">

                    	<?php 
                    		foreach ($brands as $brand) {
                      			$photo = $brand['photo'];
                    			$name = $brand['name'];
                    			
                    	?>
					    <div class="owl-item">
					        <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
					            <div class="pad15">
					        		<img src=" <?= $photo ?> " class="img-fluid">
					            	<p class="text-truncate"> <?= $name ?> </p>
					                <div class="star-rating">
										<ul class="list-inline">
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
										</ul>
									</div>

									<a href="#" class="addtocartBtn text-decoration-none">Add to Cart</a>
					        	</div>
					        </div>
					    </div>
						<?php }  ?>

					</div>
                </div>
            </div>
        </div>
	</div>



<?php
	require 'php/frontendfooter.php';
?>
