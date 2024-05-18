<?php
class Customer {	
   
	private $customerTable = 'food_customer';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function login(){
		if($this->email && $this->password) {
			$sqlQuery = "
				SELECT * FROM ".$this->customerTable." 
				WHERE email = ? AND password = ?";			
			$stmt = $this->conn->prepare($sqlQuery);
			$password = md5($this->password);
			$stmt->bind_param("ss", $this->email, $password);	
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				$user = $result->fetch_assoc();
				$_SESSION["userid"] = $user['id'];				
				$_SESSION["name"] = $user['name'];					
				return 1;		
			} else {
				return 0;		
			}			
		} else {
			return 0;
		}
	}

	public function register(){
		$sql = "INSERT into `food_customer` (`name`, `email`, `password`, `phone`, `address`) VALUES (?, ?, ?, ?, ?)";
		$stmt = $this->conn->prepare($sql);
		$name = htmlspecialchars($this->name);
		$phone = htmlspecialchars($this->phone);
		$address = htmlspecialchars($this->address);
		$email = htmlspecialchars($this->email);
		$password = htmlspecialchars(md5($this->password));
		$stmt->bind_param('sssss', $name, $email, $password, $phone, $address);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	public function loggedIn (){
		if(!empty($_SESSION["userid"])) {
			return 1;
		} else {
			return 0;
		}
	}
	
	function getAddress(){
		if($_SESSION["userid"]) {
			$stmt = $this->conn->prepare("
				SELECT email, phone, address 
				FROM ".$this->customerTable." 
				WHERE id = '".$_SESSION["userid"]."'");				
			$stmt->execute();			
			$result = $stmt->get_result();		
			return $result;	
		}
	}
}
?>