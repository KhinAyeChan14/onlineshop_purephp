<?php
	require 'php/frontendheader.php';

	require 'php/dbConnect.php';

	$id=$_GET['id'];

	$sql="SELECT * FROM items WHERE id=:value";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value',$id);
	$stmt->execute();
	$item=$stmt->fetch(PDO::FETCH_ASSOC);

	$name=$item['name'];
	$price=$item['price'];
	$description=$item['description'];
	$discount=$item['discount'];
	$price=$item['price'];
	if($discount==""){
		$currentprice=$price;
	}
	else{
		$currentprice=$discount;
	}
	$codeno=$item['codeno'];
	$brandid=$item['brand_id'];
	$subcategoryid=$item['subcategory_id'];
	$photo=$item['photo'];
	
	$sql="SELECT * FROM brands WHERE id=:value";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value',$brandid);
	$stmt->execute();
	$brands=$stmt->fetch(PDO::FETCH_ASSOC);
	$brandname=$brands['name'];

	$sql="SELECT * FROM items WHERE  subcategory_id=:value1 AND id!=:value2 ORDER BY rand()  LIMIT 4 ";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$subcategoryid);
	$stmt->bindParam(':value2',$id);
	$stmt->execute();
	$items=$stmt->fetchAll();

	$sql="SELECT * FROM subcategories WHERE id=:value";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value',$subcategoryid);
	$stmt->execute();
	$subcategories=$stmt->fetch(PDO::FETCH_ASSOC);
	$subcategoryname=$subcategories['name'];
	$categoryid=$subcategories['category_id'];

	$sql="SELECT * FROM categories WHERE id=:value";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value',$categoryid);
	$stmt->execute();
	$categories=$stmt->fetch(PDO::FETCH_ASSOC);
	$categoryname=$categories['name'];
	

?>
<div class="jumbotron jumbotron-fluid subtitle">
	<div class="container">
		<h1 class="text-center text-white"> <?= $codeno ?> </h1>
	</div>
</div>

<div class="container">

		<nav aria-label="breadcrumb ">
		  	<ol class="breadcrumb bg-transparent">
		    	<li class="breadcrumb-item">
		    		<a href="../index.php" class="text-decoration-none secondarycolor"> Home </a>
		    	</li>
		    </li>
		    <li class="breadcrumb-item active" aria-current="page">
		    	<?=$categoryname?>
		    </li>
		    <li class="breadcrumb-item active" aria-current="page">
		    	<?=$subcategoryname?>
		    </li>
		    	<li class="breadcrumb-item active" aria-current="page">
					<?=$brandname?>
		    	</li>
		  	</ol>
		</nav>

		<div class="row mt-5">
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
				<img src="<?=$photo?>" class="img-fluid">
			</div>	


			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
				
				<h4> <?=$name?></h4>

				<div class="star-rating">
					<ul class="list-inline">
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
					</ul>
				</div>

				<p>
					<?=$description?>
				</p>

				<p> 
					<span class="text-uppercase "> Current Price : </span>
					<span class="maincolor ml-3 font-weight-bolder"> <?=$currentprice?> Ks </span>
				</p>

				<p> 
					<span class="text-uppercase "> Brand : </span>
					<span class="ml-3"> <a href="" class="text-decoration-none text-muted"><?=$brandname?></a> </span>
				</p>


				<button type="button" class="btn btn-outline-danger btn-sm cartButton" data-id="<?= $id ?>" data-name="<?= $name ?>"  data-price="<?= $price ?>" data-description="<?= $description ?>" data-discount="<?= $discount ?>" data-price="<?= $price ?>" data-code="<?= $codeno ?>" data-photo="<?= $photo ?>">ADD TO CART</button>
				
			</div>
		</div>

		<div class="row mt-5">
			<div class="col-12">
				<h3> Related Item </h3>
				<hr>
			</div>
			
			<?php

				foreach($items as $item){

				$photo=$item['photo'];
				$photo1=substr($photo, 3);
				$id = $item['id'];
				$name = $item['name'];
				$price = $item['price'];
				$discount = $item['discount'];	
				$description=$item['description'];
				$codeno = $item['codeno'];
				$brandid=$item['brand_id'];
				$subcategoryid=$item['subcategory_id'];
			?>
			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
				<a href="itemdetail.php?id=<?= $id ?>">
					<img src="<?=$photo?>" class="img-fluid">
				</a>
			</div>

			<?php } ?>
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


