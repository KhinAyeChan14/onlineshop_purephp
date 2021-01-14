<?php
	require 'php/frontendheader.php';
	require 'php/dbConnect.php';

	$subcategory_id=$_GET['id'];


	// Subcategory
	$sql="SELECT subcategories.*,categories.name as cname FROM subcategories
		  LEFT JOIN categories
		  ON subcategories.category_id=categories.id
	  	  WHERE subcategories.id=:value1";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$subcategory_id);
	$stmt->execute();
	$subcategory=$stmt->fetch(PDO::FETCH_ASSOC);

	$subcategory_name=$subcategory['name'];
	$category_id=$subcategory['category_id'];
	$category_name=$subcategory['cname'];

	$sql="SELECT * FROM subcategories WHERE category_id=:value3";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value3',$category_id);
	$stmt->execute();
	$subcategories=$stmt->fetchAll();

	// Items
	$sql="SELECT * FROM items WHERE subcategory_id=:value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value2',$subcategory_id);
	$stmt->execute();
	$items=$stmt->fetchAll();
	

?>

<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"><?=$subcategory_name?> </h1>
  		</div>
</div>
	
	<!-- Content -->
	<div class="container">

		<!-- Breadcrumb -->
		<nav aria-label="breadcrumb ">
		  	<ol class="breadcrumb bg-transparent">
		    	<li class="breadcrumb-item">
		    		<a href="../index.php" class="text-decoration-none secondarycolor"> Home </a>
		    	</li>
		    	<li class="breadcrumb-item">
		    		<a href="#" class="text-decoration-none secondarycolor"> <?=$category_name?> </a>
		    	</li>
		    	<li class="breadcrumb-item active" aria-current="page">
					<?=$subcategory_name?>
		    	</li>
		  	</ol>
		</nav>

		<div class="row mt-5">
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
				<ul class="list-group">

					<?php
						foreach ($subcategories as $subcategory){

							$sid=$subcategory['id'];
							$sname=$subcategory['name'];
					?>

				  	<li class="list-group-item <?php if($sid==$subcategory_id) echo active?>">
				  		<a href="subcategory.php?id=<?=$sid?>" class="text-decoration-none secondarycolor"><?=$sname?> </a>
				  	</li>
				  	<?php } ?>
				</ul>
			</div>	


			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">

				<div class="row">

					<?php foreach($items as $item){
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

					?>
					

					<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
						<div class="card pad15 mb-3">
						  	<a href="itemdetail.php?id=<?= $id ?>&name=<?= $name ?>&price=<?= $price ?>&discount=<?= $discount ?>&description=<?= $description ?>&codeno=<?= $codeno ?>&brandid=<?= $brandid ?>&subcategoryid=<?= $subcategoryid ?>&photo=<?= $photo2 ?>"><img src="<?= $photo1 ?>" class="card-img-top" alt="..."></a>
						  	
						  	<div class="card-body text-center">
						    	<h5 class="card-title text-truncate"><?=$name?></h5>
						    	
						    	<p class="item-price">
		                        	<?php 
		                        		if($discount){
		                        	?>
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


				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-end">
					    <li class="page-item disabled">
					      	<a class="page-link" href="#" tabindex="-1" aria-disabled="true"><i class="icofont-rounded-left"></i>
					      	</a>
					    </li>
					    <li class="page-item">
					    	<a class="page-link" href="#">1</a>
					    </li>
					    <li class="page-item active">
					    	<a class="page-link" href="#">2</a>
					    </li>
					    <li class="page-item">
					    	<a class="page-link" href="#">3</a>
					    </li>
					    <li class="page-item">
					      	<a class="page-link" href="#">
					      		<i class="icofont-rounded-right"></i>
					      	</a>
					    </li>
					</ul>
				</nav>

			</div>
		</div>

		
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
