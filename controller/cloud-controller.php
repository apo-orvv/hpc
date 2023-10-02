
<?php
require_once('model/cloud_model_new.php');
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
			$server_name=$ip_address_dhcp=$flavor=$os_image=$users=$user2=$user3=$user4=$cpu=$mem=$email=$email2=$email3=$email4=$requested_mail_date=$volume_allocated=$remarks=$id = $div=$grp="";
		//echo "inside cloud controller";
		if(   isset($_POST["save"]) || isset($_POST["update"])  ){
				
				$server_name = filter_input(INPUT_POST,'server_name',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$ip_address_dhcp = filter_input(INPUT_POST,'ip_address_dhcp',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$flavor = filter_input(INPUT_POST,'flavor',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$os_image = filter_input(INPUT_POST,'os_image',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$users = filter_input(INPUT_POST,'users',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$user2 = filter_input(INPUT_POST,'user2',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$user3 = filter_input(INPUT_POST,'user3',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$user4 = filter_input(INPUT_POST,'user4',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$email2 = filter_input(INPUT_POST,'email2',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$email3 = filter_input(INPUT_POST,'email3',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$email4 = filter_input(INPUT_POST,'email4',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$cpu = filter_input(INPUT_POST,'cpu',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$mem = filter_input(INPUT_POST,'mem',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$div = filter_input(INPUT_POST,'div',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$grp = filter_input(INPUT_POST,'grp',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$requested_mail_date = filter_input(INPUT_POST,'requested_mail_date',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$volume_allocated = filter_input(INPUT_POST,'volume_allocated',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$remarks = filter_input(INPUT_POST,'remarks',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				//echo $remarks ;
				$this->cloud_model = new Model_cloud;
				if(isset($_POST["save"])){
					$this->cloud_model->store_cloud_server_allotment($server_name,$ip_address_dhcp, $flavor, $os_image, $users,$user2,$user3,$user4,$email, $email2,$email3,$email4,$requested_mail_date, $volume_allocated, $remarks,$cpu,$mem,$div,$grp);
					$clouddata = $this->cloud_model->get_cloud_server_allotment();
					include "view/displaycloudtable.php";
				}else{
					$id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
					$this->cloud_model->update_cloud_server_allotment($server_name,$ip_address_dhcp, $flavor, $os_image, $users,$user2,$user3,$user4,$email, $email2,$email3,$email4,$requested_mail_date, $volume_allocated, $remarks,$cpu,$mem,$div,$grp, $id);
					$clouddata = $this->cloud_model->get_cloud_server_allotment();
					include "view/displaycloudtable.php";
				}
			
			}
			
		else if(  isset($_POST["add"]) || isset($_POST["edit"])  ) {			
			
			if(isset($_POST["edit"])){
				
				if($_POST["id"] == ""){
					echo "Please select at least one Item to Edit";
				}else{
				
				$id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$this->cloud_model = new Model_cloud;
				$data = $this->cloud_model->get_cloud_server_allotment_by_id($id);
			 	include "view/editclouddata.php";
				//var_dump($data);
				}
			}
			
			if( isset($_POST["add"]) ){
			
			 include "view/addclouddata.php";
			}
		}	
		
		
		else if(isset($_POST["delete"])){
			if($_POST["id"] == ""){
					echo "Please select at least one Item to Delete";
				}else{
					$id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
					$this->cloud_model = new Model_cloud;
					$data = $this->cloud_model->get_cloud_server_allotment_by_id($id);
					$server=$data['server_name'];
					$this->cloud_model->delete_cloud_server_allotment($id);
					echo "Deleted cloud server $server";
				}
		}	
		
		else{

		$this->cloud_model = new Model_cloud;
		$row_count=$this->cloud_model->get_number_of_rows();
		$clouddata = $this->cloud_model->get_cloud_server_allotment();
		include "view/displaycloudtable.php";
		}
		
	}
}
?>



