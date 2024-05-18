<?php 
include_once 'config/Database.php';
include_once 'class/Customer.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

if($customer->loggedIn()) {	
	header("Location: index.php");
    exit();
}

$loginMessage = '';
if(!empty($_POST["create"])) {	
	$customer->name = $_POST["name"];
	$customer->email = $_POST["email"];
	$customer->password = $_POST["password"];	
	$customer->phone = $_POST["phone"];
	$customer->address = $_POST["address"];	
	if($customer->register()) {
        $_SESSION['success'] = "Your account was successfully created.";

        //Regenerate session ID to prevent session fixation
        session_regenerate_id(true);

        //set secure session cookie attributes
        ini_set('session.cookie_httponly', 1);
        ini_set('session.cookie_secure', 1); //ensure we use hhtps
        ini_set('session.use_strict_mode', 1);

		header("Location: index.php");	
        exit();	
	} else {
		$loginMessage = 'Invalid login! Please try again.';
	}
}
include('inc/header.php');
?>
<?php include('inc/container.php');?>
<style>
html,
body,
body>.container {
    height: 98%;
    width: 100%;
}
</style>
<div class="content h-100 d-flex w-100 justify-content-center align-items-center">
    <div class="col-lg-4 col-md-5 col-sm-10 col-xs-12">
        <div class="card card-info rounded-0">
            <div class="card-header">
                <div class="card-title h4 mb-0 fw-bold text-center">Sign Up</div>
            </div>
            <div style="" class="card-body">
                <?php if ($loginMessage != '') { ?>
                <div id="login-alert" class="alert alert-danger col-sm-12 rounded-0 py-1"><?php echo $loginMessage; ?></div>
                <?php } ?>
                <form id="loginform" class="form-horizontal" role="form" method="POST" action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?php if(!empty($_POST["name"])) { echo $_POST["name"]; } ?>" placeholder="Fullname" required>
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="<?php if(!empty($_POST["phone"])) { echo $_POST["phone"]; } ?>" placeholder="Phone #" required>
                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="address" name="address"
                            value="<?php if(!empty($_POST["address"])) { echo $_POST["address"]; } ?>" placeholder="Address" required>
                        <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?php if(!empty($_POST["email"])) { echo $_POST["email"]; } ?>" placeholder="Email" required>
                        <span class="input-group-text"><i class="fa fa-at"></i></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password"
                            value="<?php if(!empty($_POST["password"])) { echo $_POST["password"]; } ?>" placeholder="Password" required>
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <div class="text-center">
                        <div class="col-sm-12 controls">
                            <input type="submit" name="create" value="Create Account" class="btn btn-primary rounded-0">
                        </div>
                    </div>
                    <div class="text-center">
                    <a href="./login.php" class="text-decoration-none">Already have an account?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('inc/footer.php');?>