<?php
	require 'backendheader.php';
	require 'dbConnect.php';
	$id=$_GET['id'];
	
	$sql="SELECT * FROM items where id=:value";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value',$id);
	$stmt->execute();

	$items=$stmt->fetch(PDO::FETCH_ASSOC);
	$id = $items['id'];
	$codeno = $items['codeno'];
	$name = $items['name'];
	$photo = $items['photo'];
	$price = $items['price'];
	$discount = $items['discount'];
	$description = $items['description'];
	$brand_id = $items['brand_id'];
	$subcategory_id = $items['subcategory_id'];


?>
<?php

require 'dbConnect.php';

$sql="SELECT * FROM subcategories ORDER BY id DESC";
$stmt=$conn->prepare($sql);
$stmt->execute();
$subcategories=$stmt->fetchAll();

$sql="SELECT * FROM brands ORDER BY id DESC";
$stmt=$conn->prepare($sql);
$stmt->execute();
$brands=$stmt->fetchAll();


?>

<div class="app-title">
	<div>
		<h1> <i class="icofont-list"></i> Item Edit Form </h1>
	</div>
	<ul class="app-breadcrumb breadcrumb side">
		<a href="" class="btn btn-outline-primary">
			<i class="icofont-double-left"></i>
		</a>
	</ul>
</div>

<main class="app-content">


	<div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Item Form </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="subcategory_list.php" class="btn btn-outline-primary">
                        <i class="icofont-reply"></i>
                    </a>
                </ul>
            </div>

	<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<div class="tile-body">
				<form action="itemUpdate.php" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?=$id?>">
					<input type="hidden" name="oldphoto" value="<?=$photo?>">
					<div class="form-group row">
						<label for="name_id" class="col-sm-2 col-form-label"> Code </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="code_id" name="code" value="<?=$codeno?>">
							
						</div>
					</div>

					<div class="form-group row">
						<label for="name_id" class="col-sm-2 col-form-label"> Name </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name_id" name="name" value="<?=$name?>">
						</div>
					</div>		


					<div class="form-group row">
						<label for="photo_id" class="col-sm-2 col-form-label"> Photo </label>
						<div class="col-sm-10">
							<input type="file" id="photo_id" name="photo">
							<img class="img-fluid" id="oldphoto" width="100px" src="<?=$photo?>">
						</div>
					</div>		

					<div class="form-group row">
						<label for="name_id" class="col-sm-2 col-form-label"> Price </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="price_id" name="price" value="<?=$price?>">
						</div>
					</div>

					<div class="form-group row">
						<label for="name_id" class="col-sm-2 col-form-label"> Discount </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="discount_id" name="discount" value="<?=$discount?>">
						</div>
					</div>

					<div class="form-group row">
						<label for="name_id" class="col-sm-2 col-form-label"> Description </label>
						<div class="col-sm-10">
							<textarea  type="text" class="form-control" id="description_id" name="description" ><?=$description?></textarea>
						</div>
					</div>




					<div class="form-group row">
						<label for="photo_id" class="col-sm-2 col-form-label"> Brand </label>
						<div class="col-sm-10">
							
							<select class="form-control" name="brandid">
								<?php foreach($brands as $brand){
									$bid=$brand['id'];
									$bname=$brand['name'];
									if ($brand_id==$bid) {
										$selected='selected';
									} else {
										$selected='';
									}
								?>
									<option value="<?= $bid; ?>" <?= $selected ?> ><?= $bname; ?></option>
								<?php } ?>
								
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="photo_id" class="col-sm-2 col-form-label"> Subategory </label>
						<div class="col-sm-10">
							
							<select class="form-control" name="subcategoryid">
								<?php foreach($subcategories as $subcategory){
									$sid=$subcategory['id'];
									$sname=$subcategory['name'];//selected
									if ($subcategory_id==$sid) {
										$selected='selected';
									} else {
										$selected='';
									}
								?>
									<option value="<?= $sid; ?>" <?= $selected; ?> ><?= $sname; ?></option>
								<?php } ?>
								
							</select>

						</div>
					</div>


					<div class="form-group row">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-primary">
								<i class="icofont-save"></i>
								Save
							</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
</main>

<?php
require 'backendfooter.php'
?>

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('change',"input[name='photo']",function(){
			var myVal = URL.createObjectURL(event.target.files[0]);
			$('#oldphoto').attr('src',myVal);
		})		
	})
</script>