<?php
require_once 'dbclass.php';
class manualModel{

        public function __construct(){

        }

	public function addmanualnote($manualtext,$desc,$indented,$username,$category){
		 $db=new Db();
      
     
        	$dbcon=$db->getInstance("hpcweb");

        	$req=$dbcon->prepare("SELECT max(manualid) as manualID from Manuals  ");

        	$req->execute();

		$type="note";

		$ids=$req->fetch();

		$myid=$ids['manualID'];

		if($myid >= 1){
		$myid++;
		$filename="manual_".$myid.".html";
		}
		else{
		$filename="manual_1.html";

		}
		$fileloc="manuals/$filename";

		$myfile=fopen($fileloc,"w");
		if(!($myfile)){
			return 0;
		}


		fwrite($myfile,$manualtext);
		fclose($myfile);

		$req=$dbcon->prepare("insert into Manuals (indented,type, filename, description, uploaded,category) values (:indented,:type,:file,:desc,:name,:category)");

		$req->execute(array('indented'=>$indented,'type' => $type,'file'=>$fileloc,'desc'=>$desc,'name'=>$username,'category'=>$category));

		$id=$dbcon->lastInsertId();
		$dbcon=null;
		
		return $id;

	}
	public function addmanualfile($fileloc,$filetype,$desc,$indented,$username,$category){
		 $db=new Db();
        	$dbcon=$db->getInstance("hpcweb");

		$type="file";

		$req=$dbcon->prepare("insert into Manuals (indented,type, filename, description, uploaded,category) values (:indented,:type,:file,:desc,:name,:category)");

		$req->execute(array('indented'=>$indented,'type' => $type,'file'=>$fileloc,'desc'=>$desc,'name'=>$username,'category'=>$category));

		$id=$dbcon->lastInsertId();
		$dbcon=null;
		
		return $id;
	}

	public function editmanual($username,$manualid,$type){
		 $db=new Db();
        	$dbcon=$db->getInstance("hpcweb");

		$req=$dbcon->prepare("select * from Manuals where manualid= :mid and uploaded =:name and type=:type");
		$req->execute(array('mid'=>$manualid,'name'=>$username,'type'=>$type));
		$manual=$req->fetchall();
		if(count($manual) <1){
			$dbcon=null;
			return null;
		}
		
		$fileloc=$manual[0]['filename'];
		$desc=$manual[0]['description'];
		$indented=$manual[0]['indented'];
		$dbcon=null;
		return array($fileloc,$desc,$indented);
	}

	public function updatemanualnote($manualtext,$desc,$indented,$username,$manualid){

		 $db=new Db();
        	$dbcon=$db->getInstance("hpcweb");
		$req=$dbcon->prepare("select * from Manuals where manualid= :mid and uploaded =:name and type='note'");
		$req->execute(array('mid'=>$manualid,'name'=>$username));
		$manual=$req->fetchall();
		if(count($manual) <1){
			$dbcon=null;
			return null;
		}
		
		$fileloc=$manual[0]['filename'];

		if(!(file_exists($fileloc))){
		$fileloc="manuals/manual_".$manualid.".html";
		}

		$type="note";

		$myfile=fopen($fileloc,"w");
		if(!($myfile)){
			$dbcon=null;
			return null;
		}

		fwrite($myfile,$manualtext);
		fclose($myfile);

		$req=$dbcon->prepare("update Manuals set indented= :indented,filename= :filename, type = :type,description=:desc, uploaded =:name where manualid= :mid");

		$req->execute(array('indented'=>$indented,'type' => $type,'filename'=>$fileloc,'desc'=>$desc,'name'=>$username,'mid'=>$manualid));

                $rows=$req->rowCount();
                $dbcon=null;

                return $rows;
	}

	public function updatemanualfile($manualid,$fileloc,$filetype,$desc,$indented,$username){
		 $db=new Db();
        	$dbcon=$db->getInstance("hpcweb");
		$req=$dbcon->prepare("select * from Manuals where manualid= :mid and uploaded =:name and type='file'");
		$req->execute(array('mid'=>$manualid,'name'=>$username));
		$manual=$req->fetchall();
		if(count($manual) <1){
			$dbcon=null;
			return null;
		}
		
		$type="file";

		if(strcmp($fileloc,"NOFILE")==0){
		$req=$dbcon->prepare("update Manuals set indented= :indented, type = :type,description=:desc, uploaded =:name where manualid= :mid");

		$req->execute(array('indented'=>$indented,'type' => $type,'desc'=>$desc,'name'=>$username,'mid'=>$manualid));

                $rows=$req->rowCount();
                $dbcon=null;

                return $rows;

		}
		$req=$dbcon->prepare("update Manuals set indented= :indented,filename= :filename, type = :type,description=:desc, uploaded =:name where manualid= :mid");

		$req->execute(array('indented'=>$indented,'type' => $type,'filename'=>$fileloc,'desc'=>$desc,'name'=>$username,'mid'=>$manualid));

                $rows=$req->rowCount();
                $dbcon=null;

                return $rows;
	}

	public function deletemanualnote($manualid,$username){
		 $db=new Db();
        	$dbcon=$db->getInstance("hpcweb");
		$req=$dbcon->prepare("select * from Manuals where manualid= :mid and uploaded =:name and type='note'");
		$req->execute(array('mid'=>$manualid,'name'=>$username));
		$manual=$req->fetchall();
		if(count($manual) <1){
			$dbcon=null;
			return null;
		}
		
		$fileloc=$manual[0]['filename'];

		if(file_exists($fileloc)){
			unlink($fileloc);	
		}

		$req=$dbcon->prepare("Delete from  Manuals where manualid= :mid and uploaded=:name and type='note'");
		$req->execute(array('mid'=>$manualid,'name'=>$username));

                $rows=$req->rowCount();
                $dbcon=null;
                return $rows;
	}	
	public function deletemanualfile($manualid,$username){
		 $db=new Db();
        	$dbcon=$db->getInstance("hpcweb");
		$req=$dbcon->prepare("select * from Manuals where manualid= :mid and uploaded =:name and type='file'");
		$req->execute(array('mid'=>$manualid,'name'=>$username));
		$manual=$req->fetchall();
		if(count($manual) <1){
			$dbcon=null;
			return null;
		}
		
		$fileloc=$manual[0]['filename'];

		if(file_exists($fileloc)){
			unlink($fileloc);	
		}

		$req=$dbcon->prepare("Delete from  Manuals where manualid= :mid and uploaded=:name and type='file'");
		$req->execute(array('mid'=>$manualid,'name'=>$username));

                $rows=$req->rowCount();
                $dbcon=null;
		return $rows;

	}
	public function viewmanual($usertype,$cat){
 
 
		 $db=new Db();
        	$dbcon=$db->getInstance("hpcweb");

		if(($usertype == 'A')||($usertype == 'AI')||($usertype == 'AS')||($usertype == 'AD')){
			$querystr="indented='AOU' or indented='AO' or indented='A'";
		}
		if($usertype=='O'){
			$querystr="indented='AOU' or indented='AO' ";
		}
		if($usertype=='U'){
			$querystr=" indented='AOU' ";
		}
		
   
        	$req=$dbcon->prepare("SELECT * from Manuals where ($querystr) and category='$cat'");
        	$req->execute();

		$mymanuals=array();
		$i=0;
		foreach($req->fetchAll() as $manual){

			$mymanuals[$i]=array($manual['manualid'],$manual['indented'],$manual['type'],$manual['filename'],$manual['description'],$manual['uploaded']);
			$i++;
		}	
		$dbcon=null;

		return $mymanuals;

	}

	public function getmanualfile($usertype,$manualid){
		 $db=new Db();
        	$dbcon=$db->getInstance("hpcweb");
		if(($usertype == 'A')||($usertype == 'AI')||($usertype == 'AS')||($usertype == 'AD')){
                        $querystr="(indented='AOU' or indented='AO' or indented='A')";
                }
                if($usertype=='O'){
                        $querystr="(indented='AOU' or indented='AO') ";
                }

		if($usertype=='U'){
			$querystr="indented='AOU'";
		}
		$req=$dbcon->prepare("select * from Manuals where manualid= :myid and $querystr");
		$req->execute(array('myid'=>$manualid));


		$manual=$req->fetchall();
		if(count($manual) <1){
			$dbcon=null;
			return null;
		}
		
		$fileloc=$manual[0]['filename'];
		$dbcon=null;
		return $fileloc;
	}	
}
?>
