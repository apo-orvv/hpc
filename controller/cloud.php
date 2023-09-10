
<?php
require_once('model/cloud_model.php');
class Controller_cloud{	
public $cloud_model;
public function __counstruc(){	
}
	public function invoke(){
		echo '<html><head><script>
		function confirm_delete(){
			alert("are you sure want to Delete?");
		}
		</script></head><body>';
		//echo "inside cloud controller";
		if(   isset($_POST["save"]) || isset($_POST["update"])  ){
				
				$server_name = $_POST["server_name"];
				$ip_address_dhcp = $_POST["ip_address_dhcp"];
				$flavor = $_POST["flavor"];
				$os_image = $_POST["os_image"];
				$users = $_POST["users"];
				$email = $_POST["email"];
				$requested_mail_date = $_POST["requested_mail_date"];
				$volume_allocated = $_POST["volume_allocated"];
				$remarks = $_POST["remarks"];				
				//echo $remarks ;
				$this->cloud_model = new Model_cloud;
				if(isset($_POST["save"])){
					$this->cloud_model->store_cloud_server_allotment($server_name,$ip_address_dhcp, $flavor, $os_image, $users,
					$email, $requested_mail_date, $volume_allocated, $remarks);
				}else{
					$id = $_POST["id"];
					$this->cloud_model->update_cloud_server_allotment($server_name,$ip_address_dhcp, $flavor, $os_image, $users,
					$email, $requested_mail_date, $volume_allocated, $remarks, $id);
				}
			
			}
			
			$server_name=$ip_address_dhcp=$flavor=$os_image=$users=
			$email=$requested_mail_date=$volume_allocated=$remarks=$id = "";
		
				
		if(  isset($_POST["add"]) || isset($_POST["edit"])  ) {			
			
			if(isset($_POST["edit"])){
				
				if($_POST["id"] == ""){
					echo "Please select at least one Item to Edit";
				}else{
				
				$id = $_POST["id"];
				$this->cloud_model = new Model_cloud;
				$data = $this->cloud_model->get_cloud_server_allotment_by_id($id);
				//var_dump($data);
				}
			
			}
			
			if($_POST["id"] != "" || isset($_POST["add"]) ){
			
			echo'<form method = "POST" action = ""><table border = 1>
			
			<tr>			
			<th>Server Name:</br><input type="hidden" name="id" value="'.$data["id"].'">
			<input required type="text" name="server_name" value="'.$data["server_name"].'"></th>
			<th>IP Address(DHCP):</br><input  required type="text" name="ip_address_dhcp" value="'.$data["ip_address_dhcp"].'"></th>
			<th>Flavor:</br><input type="text" name="flavor" value="'.$data["flavor"].'"></th>
			<th>OS Image:</br><input type="text" name="os_image" value="'.$data["os_image"].'"></th>
			<th>Users:</br><input required type=text"" name="users" value="'.$data["users"].'"></th>
			</tr>			
			<tr>
			<th>Email:</br><input required type="text" name="email" value="'.$data["email"].'"></th>
			<th>Volume Allocated:</br><input type="text" name="volume_allocated" value="'.$data["volume_allocated"].'"></th>
			<th>Requested Mail Date:</br><input type="date" name="requested_mail_date" value="'.$data["requested_mail_date"].'"></th>
			<th>Remarks:</br><textarea name="remarks" value="'.$data["remarks"].'" placeholder = "'.$data["remarks"].'"></textarea></th>
			<th>';
			if(isset($_POST["add"])){
			echo '</br><input type="submit" style = "background-color:green;border:none;font-weight: bold;padding: 7px 20px;color:white" name="save" value="Save">';
			}
			if(isset($_POST["edit"])){
			echo '</br><input type="submit" style = "background-color:green;border:none;font-weight: bold;padding: 7px 20px;color:white" name="update" value="Update">';
			}
			echo '</th></tr></table></form>';		
			
			}
			
		}
		
		
		
		
		if(isset($_POST["delete"])){
			if($_POST["id"] == ""){
					echo "Please select at least one Item to Delete";
				}else{
					$id = $_POST["id"];
					$this->cloud_model = new Model_cloud;
					$data = $this->cloud_model->delete_cloud_server_allotment($id);
				}
		}	
		//echo $id;


		
		if(isset($_GET["page"])){
			$page = $_GET["page"];
		}else{
			$page = 1;
		}
		//echo $page;
		$page_first_row = ($page - 1) * 10;
		//echo $page_first_row;
		
		$this->cloud_model = new Model_cloud;
		$row_count=$this->cloud_model->get_number_of_rows();
		$model = $this->cloud_model->get_cloud_server_allotment($page_first_row);
		//var_dump($model);
		$rows = $row_count["count"];		
		$pages = ceil($rows/10);
		//$model = $this->cloud_model->get_cloud_server_allotments();
		//print_r($model);
		//echo $pages;
		echo '<h3 align = "center">Cloud Server Allotment Details</h3>
		<div align = "right"><form method ="POST" action = "">
		<input type="hidden" name="hpcpage" value = "cloud_allotment">
		<input type = "submit" name="add" style = "background-color:green;border:none;font-weight: bold;padding: 7px 20px;color:white" value = "Add">
		<input type = "submit" name="edit" style = "background-color:blue;border:none;font-weight: bold;padding: 7px 20px;color:white" value = "Edit">
		<input type = "submit" onclick="confirm_delete()" name="delete" style = "background-color:red;border:none;font-weight: bold;padding: 7px 20px;color:white" value = "Delete">
		</div>
		
		
		<table  style="width:100%;table-layout:fixed" align="center" class="display" cellpadding="1" cellspacing="0"  id ="mtab" >
    <thead> <tr  valign ="top" align="center" >
		<th>Server Name</th>
		<th>IP Address(DHCP)</th>
		<th>Flavor</th>
		<th>OS Image</th>
		<th>Users</th>
		<th>Email</th>
		<th>Volume Allocated</th>
		<th>Requested Mail Date</th>
		<th>Remarks</th>
		<th>Select</th>		
		</tr></thead>';
		foreach($model as $data){
			
			echo '<tr>			
			<td>'.$data["server_name"].'</td>
			<td>'.$data["ip_address_dhcp"].'</td>
			<td>'.$data["flavor"].'</td>
			<td>'.$data["os_image"].'</td>
			<td>'.$data["users"].'</td>
			<td>'.$data["email"].'</td>
			<td>'.$data["volume_allocated"].'</td>			
			<td>'.$data["requested_mail_date"].'</td>
			<td>'.$data["remarks"].'</td>
			<td><input type="radio" name="id" value="'.$data["id"].'"></td>
			</tr>';
		}
		
		echo '</table></body></html>';	
		
		
		echo '<div align = "right"><form method = "GET" action = "">
			  <input type="hidden" name="hpcpage" value = "cloud_allotment">';
		for($i = 1; $i<=$pages; $i++){
			echo '<input type = "submit" name = "page" value = "'.$i.'">';
		}
		echo '</form></div>';
		
		
	}
	
}
?>



