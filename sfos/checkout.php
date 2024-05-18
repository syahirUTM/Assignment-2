<?php 
include_once 'config/Database.php';
include_once 'class/Customer.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

if(!$customer->loggedIn()) {	
	header("Location: login.php");	
}
include('inc/header.php');
?>
<title>phpzag.com : Demo Online Food Ordering System with PHP & MySQL</title>
  <link rel="stylesheet" type = "text/css" href ="css/foods.css">
<?php include('inc/container.php');?>
<div class="content">
	<div class="container-fluid">		
		
		<div class='row'>		
        <?php include('top_menu.php'); ?> 
		</div>
		
		<div class="my-3">
			<div class="card rounded-0 shadow">
				<div class="card-body">
					<div class="container-fluid">
						<?php
						$orderTotal = 0;
						foreach($_SESSION["cart"] as $keys => $values){
							$total = ($values["item_quantity"] * $values["item_price"]);
							$orderTotal = $orderTotal + $total;
						}
						?>
						<div class='row'>
							<div class="col-md-6 lh-1">
								<h3>Delivery Address</h3>
								<?php 
								$addressResult = $customer->getAddress();
								$count=0;
								while ($address = $addressResult->fetch_assoc()) { 
								?>
								<p class="mb-1"><?php echo $address["address"]; ?></p>
								<p class="mb-1"><strong>Phone</strong>:<?php echo $address["phone"]; ?></p>
								<p class="mb-1"><strong>Email</strong>:<?php echo $address["email"]; ?></p>
								<?php
								}
								?>				
							</div>
							<?php 
							$randNumber1 = rand(100000,999999); 
							$randNumber2 = rand(100000,999999); 
							$randNumber3 = rand(100000,999999);
							$orderNumber = $randNumber1.$randNumber2.$randNumber3;
							?>
							<div class="col-md-6 lh-1">
								<h3>Order Summery</h3>
								<p class="mb-1"><strong>Items</strong>: $<?php echo $orderTotal; ?></p>
								<p class="mb-1"><strong>Delivery</strong>: $0</p>
								<p class="mb-1"><strong>Total</strong>: $<?php echo $orderTotal; ?></p>
								<p class="mb-1"><strong>Order Total</strong>: $<?php echo $orderTotal; ?></p>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer py-1">
					<div class="row justify-content-center">
						<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
							<div class="d-grid">
								<a href="process_order.php?order=<?php echo $orderNumber;?>"  class="btn btn-warning rounded-0">Place Order</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		   
    </div>        
		
<?php include('inc/footer.php');?>
