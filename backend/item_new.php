<?php
require 'backendheader.php';
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
				<form action="itemAdd.php" method="POST" enctype="multipart/form-data">

					<div class="form-group row">
						<label for="name_id" class="col-sm-2 col-form-label"> Code </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="code_id" name="code">
						</div>
					</div>

					<div class="form-group row">
						<label for="name_id" class="col-sm-2 col-form-label"> Name </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name_id" name="name">
						</div>
					</div>


					<div class="form-group row">
						<label for="photo_id" class="col-sm-2 col-form-label"> Photo </label>
						<div class="col-sm-10">
							<input type="file" id="photo_id" name="photo">
						</div>
					</div>



					<div class="form-group row">
						<label for="price" class="col-sm-2 col-form-label"> Price </label>
						<div class="col-sm-10">
							<!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="price-tab" data-toggle="tab" href="#unitprice" role="tab" aria-controls="unitprice" aria-selected="true">Unit Price </a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="discount-tab" data-toggle="tab" href="#discount" role="tab" aria-controls="discount" aria-selected="false"> Discount</a>
								</li>
							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane" id="unitprice" role="tabpanel" aria-labelledby="price-tab">
									<input type="text" class="form-control" id="unitprice" name="unitprice">
								</div>					
								<div class="tab-pane fade" id="discount" role="tabpanel" aria-labelledby="discount-tab">
									<input type="text" class="form-control" id="discount" name="discount">
								</div>				
							</div>		 -->
						

					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#unitprice" role="tab" aria-controls="nav-home" aria-selected="true">Unit Price</a>
							<a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#discount" role="tab" aria-controls="nav-profile" aria-selected="false">Discount</a>

						</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="unitprice" role="tabpanel" aria-labelledby="nav-home-tab">
							<input type="text" class="form-control" name="unitprice">
						</div>

						<div class="tab-pane fade" id="discount" role="tabpanel" aria-labelledby="nav-profile-tab">
							<input type="text" class="form-control" name="discount">
							
						</div>
						
					</div>

				</div>
					</div>




					<div class="form-group row">
						<label for="name_id" class="col-sm-2 col-form-label"> Description </label>
						<div class="col-sm-10">
							<textarea  type="text" class="form-control" id="description_id" name="description" ></textarea>
						</div>
					</div>




					<div class="form-group row">
						<label for="photo_id" class="col-sm-2 col-form-label"> Brand </label>
						<div class="col-sm-10">
							
							<select class="form-control" name="brandid">
								<?php foreach($brands as $brand){
									$bid=$brand['id'];
									$bname=$brand['name'];
								?>
									<option value="<?= $bid; ?>"><?= $bname; ?></option>
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
									$sname=$subcategory['name'];
								?>
									<option value="<?= $sid; ?>"><?= $sname; ?></option>
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