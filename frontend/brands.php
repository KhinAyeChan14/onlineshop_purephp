<?php
	require 'php/frontendheader.php';

	require 'php/dbConnect.php';

	$brandid=$_GET['id'];

	$sql="SELECT * FROM brands WHERE brands.id=:value1";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$brandid);
	$stmt->execute();
	$brands=$stmt->fetch(PDO::FETCH_ASSOC);
	$brand_name=$brands['name'];

	$sql="SELECT * FROM items WHERE brand_id=:value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value2',$brandid);
	$stmt->execute();
	$items=$stmt->fetchAll();

	



?>

<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> <?=$brand_name?></h1>
  		</div>
	</div>


	<div class="container mt-5">	
		<div class="row mt-5">
			<div class="col">

				<nav aria-label="breadcrumb ">
					<ol class="breadcrumb bg-transparent">
						<li class="breadcrumb-item">
							<a href="../index.php" class="text-decoration-none secondarycolor"> Home </a>
						</li>
							</li>
							<li class="breadcrumb-item active" aria-current="page">
					       Brands
		    	        </li>
						<li class="breadcrumb-item active" aria-current="page">
					        <?=$brand_name?>
		    	        </li>
		    	<!-- <li class="breadcrumb-item">
		    		<a href="#" class="text-decoration-none secondarycolor"> <?=$subcategoryname?> </a>
		    	</li>
		    	<li class="breadcrumb-item active" aria-current="page">
					<?=$brandname?>
				</li> -->
			</ol>
		</nav>

				<div class="bbb_viewed_title_container">
					<h3 class="bbb_viewed_title"> <?=$brand_name?> Brand Items</h3>
					<div class="bbb_viewed_nav_container">
						<div class="bbb_viewed_nav bbb_viewed_prev"><i class="icofont-rounded-left"></i></div>
						<div class="bbb_viewed_nav bbb_viewed_next"><i class="icofont-rounded-right"></i></div>
					</div>
				</div>


				<div class="bbb_viewed_slider_container">
					<div class="owl-carousel owl-theme bbb_viewed_slider">

						<?php 

						foreach ($items as $item) {

							$id = $item['id'];
							$name = $item['name'];
							$price = $item['price'];
							$discount = $item['discount'];	
							$photo1 = $item['photo'];
							$photo2=substr($photo1, 3);
							$description=$item['description'];
							$codeno = $item['codeno'];
							$brandid=$item['brand_id'];
							$subcategoryid=$item['subcategory_id'];

       //              		$sql="SELECT * FROM subcategories WHERE id=:value2";
							// $stmt=$conn->prepare($sql);
							// $stmt->bindParam(':value2',$subcategoryid);
							// $stmt->execute();
							// $subcategories=$stmt->fetch(PDO::FETCH_ASSOC);
							// $subcategoryname=$subcategories['name'];

							?>

							<div class="owl-item">

								<div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
									<div class="pad15">
										<a href="itemdetail.php?id=<?= $id ?>"><img src="<?= $photo1 ?>" class="img-fluid"></a>
										<p class="text-truncate"><?=$name?></p>
										<p class="item-price">

											<?php if($discount){ ?>
												<strike> <?= $price ?> Ks </strike> 
												<span class="d-block"> <?= $discount ?> Ks</span>
											<?php } else{ ?>
												<span class="d-block"> <?= $price ?> Ks</span>
											<?php } ?>
										</p>

										<div class="star-rating">
											<ul class="list-inline">
												<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
												<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
												<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
												<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
												<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
											</ul>
										</div>

										<button type="button" class="btn btn-outline-danger btn-sm cartButton" data-id="<?= $id ?>" data-code="<?= $codeno ?>"  data-name="<?= $name ?>" data-price="<?= $price ?>" data-discount="<?= $discount ?>" data-photo="<?= $photo2 ?>">ADD TO CART</button>
									</div>
								</div>
							</div>
						<?php } ?>

					</div>
				</div>

			</div>
		</div>
	

		<!-- Brand Store Item -->

		<div class="row mt-5">
			<h1> Top Brand Stores </h1>
		</div>

		<section class="customer-logos slider mt-5">
			<?php 
			$sql = "SELECT * FROM brands";
			$stmt = $conn->prepare($sql);
			$stmt->execute();

			$brands = $stmt->fetchAll();

			foreach ($brands as $brand) {

				$b_id = $brand['id'];
				$b_name = $brand['name'];
				$b_photo = $brand['photo'];
				$b_photo=substr($b_photo, 3);
				?>

				<div class="slide">
					<a href="">
						<img src="../<?= $b_photo ?>">
					</a>
				</div>
				
			<?php } ?>
		</section>

		<div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>
	</div>

<?php
	require 'php/frontendfooter.php';
?>

<script type="text/javascript">
	
	$(document).ready(function(){
		$(document).on('click','.cartButton',function(){

			var item_id=$(this).data('id');
			var item_codeno=$(this).data('code');
			var item_name=$(this).data('name');
			var item_price=$(this).data('price');
			var item_discount=$(this).data('discount');	
			var item_photo=$(this).data('photo');

			var item={
				id:item_id,
				code:item_codeno,
				name:item_name,
				price:item_price,
				discount:item_discount,
				photo:item_photo,
				qty:1,
			}

			var itemList=localStorage.getItem("item");
			var itemArray;

			if(itemList==null){
				itemArray=[]
			}
			else{
				itemArray=JSON.parse(itemList);

			}

			var status=true;

			itemArray.forEach(function(v,i){
				if(v.id==item_id){
					v.qty++;
					status=false;
				}
			})

			if(status){
				itemArray.push(item);
			}

			stringItem=JSON.stringify(itemArray);
			localStorage.setItem("item",stringItem);

		});
	});
</script>