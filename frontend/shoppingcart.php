<?php
	require 'php/dbConnect.php';
	require 'php/frontendheader.php';

?>

<div class="jumbotron jumbotron-fluid subtitle">
	<div class="container">
		<h1 class="text-center text-white"> Your Shopping Cart </h1>
	</div>
</div>

<div class="container mt-5">
		
		<!-- Shopping Cart Div -->
		<!-- <div class="row mt-5 shoppingcart_div">
			<div class="col-12">
				<a href="../index.php" class="btn mainfullbtncolor btn-secondary float-right px-3" > 
					<i class="icofont-shopping-cart"></i>
					Continue Shopping 
				</a>
			</div>
		</div>
 -->



		<div class="row mt-5 shoppingcart_div"  id="isitem">

			<div class="col-12 my-5" >
				<a href="../index.php" class="btn mainfullbtncolor btn-secondary float-right px-3" > 
					<i class="icofont-shopping-cart"></i>
					Continue Shopping 
				</a>
			</div>

			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th colspan="3"> Product </th>
							<th colspan="3"> Qty </th>
							<th> Price </th>
							<th> Total </th>
						</tr>
					</thead>
					<tbody id="shoppingcart_table">
						

					</tbody>
					<tfoot id="shoppingcart_tfoot">
						
						<tr> 
							<td colspan="5"> 
								<textarea class="form-control" id="notes" placeholder="Any Request..."></textarea>
							</td>
							<td colspan="3">

								<?php
									if(isset($_SESSION['login_user'])){
								?>
								<a href="javascript:void(0)" class="btn btn-secondary btn-block mainfullbtncolor checkoutBtn"> 
									Check Out 
								</a>

								<?php
									}else{
								?>

								<a href="login.php" class="btn btn-secondary btn-block mainfullbtncolor"> 
									Check Out </a>
								<?php }?>
									
								
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>


		<!-- NO ITEMS -->
		<div class="row mt-5 noneshoppingcart_div text-center" id="noitem">
			
			<div class="col-12">
				<h5 class="text-center"> There are no items in this cart </h5>
			</div>

			<div class="col-12 mt-5 ">
				<a href="../index.php" class="btn btn-secondary mainfullbtncolor px-3" > 
					<i class="icofont-shopping-cart"></i>
					Continue Shopping 
				</a>
			</div>

		</div>




</div>
<?php
	require 'php/frontendfooter.php';
?>

<script type="text/javascript">
	
	$("#noitem").hide();

	$(document).ready(function(){


		function showItem(){

			itemList=localStorage.getItem("item");

			if(itemList){
				itemArray=JSON.parse(itemList);
				var html="";
				var number=0;
				var total=0;
				var subtotal=0;

				itemArray.forEach(function(v,i){
					number+=1;

					if(v.discount==""){
						total=parseInt(v.price*v.qty);
						
						// console.log(subtotal);
						html+=`<tr>
						<td><button class="btn btn-outline-danger btnRemove btn-sm" style="border-radius: 50%"> 
						<i class="icofont-close-line"></i> </button> </td>
						<td> <img src="../${v.photo}" width="100" height="100"></td>
						<td>
						<p> ${v.name}</p>
						<p>${v.code}</p>
						</td>
						<td colspan="3"><button class="btnIncrease" data-id="${i}">&nbsp;+&nbsp;</button>&nbsp;&nbsp;${v.qty}&nbsp;&nbsp;<button class="btnDecrease" data-id="${i}">&nbsp;-&nbsp;&nbsp;</button></td>
						<td><p> ${v.price} Ks</p></td>
						<td>${total} Ks</td>
						</tr>`

					}
					else{
						total=parseInt(v.discount*v.qty);
						
						html+=`<tr>
						<td><button class="btn btn-outline-danger btnRemove btn-sm" style="border-radius: 50%"> 
						<i class="icofont-close-line"></i> </button> </td>
						<td> <img src="../${v.photo}" width="100" height="100"></td>
						<td>
						<p> ${v.name}</p>
						<p>${v.code}</p>
						</td>
						<td colspan="3"><button class="btnIncrease" data-id="${i}">&nbsp;+&nbsp;</button>&nbsp;&nbsp;${v.qty}&nbsp;&nbsp;<button class="btnDecrease" data-id="${i}">&nbsp;-&nbsp;&nbsp;</button></td>
						<td>
						<p class="text-danger">${v.discount} Ks</p>
						<p> <del> ${v.price} Ks</del></p>
						</td>
						<td>${total} Ks</total>
						</tr>`
					}
					subtotal+=total;
					

				});
				
				html+=`<tr>
							<td colspan="8">
								<h3 class="text-right">Total: ${subtotal} Ks</h3>
							</td>
						</tr>`
				$('tbody').html(html);
				
				
			}
			
		}

		showItem();

		$("tbody").on('click','.btnIncrease',function(){
			var id=$(this).data('id');

			var itemList=localStorage.getItem("item");
			if(itemList){
				var itemArray=JSON.parse(itemList);

				itemArray.forEach( function(v, i) {

					if(i==id){
						v.qty++;
					}
				});

				var itemstring=JSON.stringify(itemArray);
				localStorage.setItem("item",itemstring);
				showItem();

			}
		})


		$("tbody").on('click','.btnDecrease',function(){

			var id=$(this).data('id');

			var itemList=localStorage.getItem("item");
			if(itemList){
				var itemArray=JSON.parse(itemList);

				itemArray.forEach( function(v, i) {

					if(i==id){
						v.qty--;
						if(v.qty==0){
							itemArray.splice(id, 1);
						}
					}
				});
				var itemstring=JSON.stringify(itemArray);
				localStorage.setItem("item",itemstring);
				showItem();

			}
		})


		$("tbody").on('click','.btnRemove',function(){

			var id=$(this).data('id');

			var itemList=localStorage.getItem("item");
			if(itemList){
				var itemArray=JSON.parse(itemList);
				itemArray.splice(id, 1);

				if(itemArray.length==0){
					 localStorage.clear();
					 $(".cartNoti").html('0');
					 $('.total').html(" ");
				}
				
				else{

				var itemstring=JSON.stringify(itemArray);
				localStorage.setItem("item",itemstring);
				showItem();

			}


			}
		})

		});

</script>


