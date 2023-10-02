<?php
require_once 'dbclass.php';
class Model_cloud{	
	public function __construct(){
	}	
	public function get_number_of_rows(){
		$db=new Db();
		$dbh = $db->getInstance("cloud");
		$sql = "SELECT count(id) as count FROM cloud_server_allotment";
		$sql1 = $dbh->query($sql);
		$s = $sql1->fetch();
		return $s;
	}
	
	public function get_cloud_server_allotment_by_id($id){
		$db=new Db();
		$dbh = $db->getInstance("cloud");
		$sql = "SELECT * FROM cloud_server_allotment WHERE id = ".$id;
		$sql1 = $dbh->query($sql);
		$s = $sql1->fetch();
		return $s;
	}
	
	
	
	
	
	
	public function get_cloud_server_allotment($page_first_row){
		$db=new Db();
		$dbh = $db->getInstance("cloud");
		$sql = "SELECT *, date_format(requested_mail_date,'%d-%m-%Y') as requested_mail_date
				FROM cloud_server_allotment Limit ".$page_first_row.", 10";
		$sql1 = $dbh->query($sql);
		$s = $sql1->fetchAll();
		return $s;
	}
	
	
	public function store_cloud_server_allotment($server_name,$ip_address_dhcp, $flavor, $os_image, $users,
	$email, $requested_mail_date, $volume_allocated, $remarks){
		echo $server_name;		
		$db=new Db();
		$dbh = $db->getInstance("cloud");
		$sql = "INSERT INTO cloud_server_allotment
		(id, server_name,ip_address_dhcp, flavor, os_image, users, email, requested_mail_date, volume_allocated, remarks)
		VALUES(NULL,:server_name,:ip_address_dhcp, :flavor, :os_image, :users, :email,
		:requested_mail_date, :volume_allocated, :remarks )";
		$stmt = $dbh->prepare($sql);
		$stmt->bindparam(':server_name', $server_name);
		$stmt->bindparam(':ip_address_dhcp', $ip_address_dhcp);
		$stmt->bindparam(':flavor', $flavor);
		$stmt->bindparam(':os_image', $os_image);
		$stmt->bindparam(':users', $users);
		$stmt->bindparam(':email', $email);
		$stmt->bindparam(':requested_mail_date', $requested_mail_date);
		$stmt->bindparam(':volume_allocated', $volume_allocated);
		$stmt->bindparam(':remarks', $remarks);				
		$stmt->execute();
		
	}
	

	public function update_cloud_server_allotment($server_name,$ip_address_dhcp, $flavor, $os_image, $users,
	$email, $requested_mail_date, $volume_allocated, $remarks, $id){			
		$db=new Db();
		$dbh = $db->getInstance("cloud");
		$sql = "UPDATE cloud_server_allotment
		SET server_name = :server_name,ip_address_dhcp = :ip_address_dhcp, flavor = :flavor,
		os_image = :os_image, users = :users, email = :email, requested_mail_date = :requested_mail_date,
		volume_allocated = :volume_allocated, remarks = :remarks WHERE id = :id";			
		$stmt = $dbh->prepare($sql);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->bindparam(':server_name', $server_name, PDO::PARAM_STR);
		$stmt->bindparam(':ip_address_dhcp', $ip_address_dhcp, PDO::PARAM_STR);
		$stmt->bindparam(':flavor', $flavor, PDO::PARAM_STR);
		$stmt->bindparam(':os_image', $os_image, PDO::PARAM_STR);
		$stmt->bindparam(':users', $users, PDO::PARAM_STR);
		$stmt->bindparam(':email', $email, PDO::PARAM_STR);
		$stmt->bindparam(':requested_mail_date', $requested_mail_date, PDO::PARAM_STR);
		$stmt->bindparam(':volume_allocated', $volume_allocated, PDO::PARAM_STR);
		$stmt->bindparam(':remarks', $remarks, PDO::PARAM_STR);				
		$stmt->execute();
		
	}
	
	public function delete_cloud_server_allotment($id){			
		$db=new Db();
		$dbh = $db->getInstance("cloud");
		$sql = "DELETE FROM cloud_server_allotment WHERE id = :id";			
		$stmt = $dbh->prepare($sql);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);			
		$stmt->execute();
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

}
?>