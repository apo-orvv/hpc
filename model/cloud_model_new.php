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
	
	
	
	
	
	
	public function get_cloud_server_allotment(){
		$db=new Db();
		$dbh = $db->getInstance("cloud");
		$sql = "SELECT *, date_format(requested_mail_date,'%d-%m-%Y') as requested_mail_date
				FROM cloud_server_allotment ";
		$sql1 = $dbh->query($sql);
		$s = $sql1->fetchAll();
		return $s;
	}
	
	
	public function store_cloud_server_allotment($server_name,$ip_address_dhcp, $flavor, $os_image, $users,$user2,$user3,$user4,$email, $email2,$email3,$email4,$requested_mail_date, $volume_allocated, $remarks,$cpu,$mem,$div,$grp){

		$db=new Db();
		$dbh = $db->getInstance("cloud");
		$sql = "INSERT INTO cloud_server_allotment
		(id, server_name,ip_address_dhcp, flavor, os_image, users, user2,user3,user4,email,email2,email3,email4, requested_mail_date, volume_allocated, remarks,CPU,Memory,division,groupname)
		VALUES(NULL,:server_name,:ip_address_dhcp, :flavor, :os_image, :users,:user2,:user3,:user4, :email,:email2,:email3,:email4,:requested_mail_date, :volume_allocated, :remarks, :CPU, :Memory, :div, :grp )";
		$stmt = $dbh->prepare($sql);
		$stmt->bindparam(':server_name', $server_name);
		$stmt->bindparam(':ip_address_dhcp', $ip_address_dhcp);
		$stmt->bindparam(':flavor', $flavor);
		$stmt->bindparam(':os_image', $os_image);
		$stmt->bindparam(':users', $users);
		$stmt->bindparam(':user2', $user2);
		$stmt->bindparam(':user3', $user3);
		$stmt->bindparam(':user4', $user4);
		$stmt->bindparam(':email', $email);
		$stmt->bindparam(':email2', $email2);
		$stmt->bindparam(':email3', $email3);
		$stmt->bindparam(':email4', $email4);
		$stmt->bindparam(':requested_mail_date', $requested_mail_date);
		$stmt->bindparam(':volume_allocated', $volume_allocated);
		$stmt->bindparam(':remarks', $remarks);				
		$stmt->bindparam(':CPU', $cpu);				
		$stmt->bindparam(':Memory', $mem);				
		$stmt->bindparam(':div', $div);				
		$stmt->bindparam(':grp', $grp);				
		$stmt->execute();
		
	}
	

	public function update_cloud_server_allotment($server_name,$ip_address_dhcp, $flavor, $os_image, $users,$user2,$user3,$user4,$email, $email2,$email3,$email4,$requested_mail_date, $volume_allocated, $remarks,$cpu,$mem,$div,$grp, $id){			
		$db=new Db();
		$dbh = $db->getInstance("cloud");
		$sql = "UPDATE cloud_server_allotment
		SET server_name = :server_name,ip_address_dhcp = :ip_address_dhcp, flavor = :flavor,
		os_image = :os_image, users = :users,user2= :user2,user3= :user3,user4= :user4, email = :email,  email2 = :email2, email3 = :email3, email4 = :email4,requested_mail_date = :requested_mail_date,volume_allocated = :volume_allocated, remarks = :remarks, CPU= :cpu, Memory= :memory, division= :div, groupname= :grp WHERE id = :id";			
		$stmt = $dbh->prepare($sql);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);
		$stmt->bindparam(':server_name', $server_name, PDO::PARAM_STR);
		$stmt->bindparam(':ip_address_dhcp', $ip_address_dhcp, PDO::PARAM_STR);
		$stmt->bindparam(':flavor', $flavor, PDO::PARAM_STR);
		$stmt->bindparam(':os_image', $os_image, PDO::PARAM_STR);
		$stmt->bindparam(':users', $users, PDO::PARAM_STR);
		$stmt->bindparam(':user2', $user2,PDO::PARAM_STR);
		$stmt->bindparam(':user3', $user3,PDO::PARAM_STR);
		$stmt->bindparam(':user4', $user4,PDO::PARAM_STR);
		$stmt->bindparam(':email', $email,PDO::PARAM_STR);
		$stmt->bindparam(':email2', $email2,PDO::PARAM_STR);
		$stmt->bindparam(':email3', $email3,PDO::PARAM_STR);
		$stmt->bindparam(':email4', $email4,PDO::PARAM_STR);
		$stmt->bindparam(':requested_mail_date', $requested_mail_date, PDO::PARAM_STR);
		$stmt->bindparam(':volume_allocated', $volume_allocated, PDO::PARAM_STR);
		$stmt->bindparam(':remarks', $remarks, PDO::PARAM_STR);				
		$stmt->bindparam(':cpu', $cpu,PDO::PARAM_STR);
		$stmt->bindparam(':memory', $mem,PDO::PARAM_STR);
		$stmt->bindparam(':div', $div,PDO::PARAM_STR);
		$stmt->bindparam(':grp', $grp,PDO::PARAM_STR);
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
