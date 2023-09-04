<?php

require_once("model/manualmodel.php");
class manualController{

	private $smdetailsmodel;
	public function  __construct(){
		$this->manualmodel=new manualModel();
	}
	
		
	public function addmanualnote($username){
		if(isset($_POST['submitnote']) ){

			$manualtext=$_POST['content'];	

			 $desc = filter_input(INPUT_POST,'description',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			 $indented = filter_input(INPUT_POST,'indented',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $category = filter_input(INPUT_POST,'category',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$myid=$this->manualmodel->addmanualnote($manualtext,$desc,$indented,$username,$category);	

			include "view/manualadded.php";
		}
		else{
			include "view/addmanualnote.php";
		}
	
	}
	public function editmanualnote($username){

		if(isset($_POST['editnote']) ){

			$manualtext=$_POST['content'];	

		 $manualid = filter_input(INPUT_POST,'manualid',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			 $desc = filter_input(INPUT_POST,'description',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			 $indented = filter_input(INPUT_POST,'indented',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$rows=$this->manualmodel->updatemanualnote($manualtext,$desc,$indented,$username,$manualid);	

			if(is_numeric($rows)){

			include "view/manualedited.php";
			}
			else{
			$myerrmsg="Editting this note failed";
            		include "view/manualuploaderror.php";
			}
		}
		else{
		 	$manualid = filter_input(INPUT_GET,'manualid',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$type='note';
			list($fileloc,$desc,$indented)=$this->manualmodel->editmanual($username,$manualid,$type);
			if($fileloc){
			include "view/editmanualnote.php";
			}
			else{
			$myerrmsg="You are not permitted to edit this note";
            		include "view/manualuploaderror.php";
			}
		}
	
	}
	public function editmanualfile($username){

		if(isset($_POST['editfile']) ){
		 	$manualid = filter_input(INPUT_POST,'manualid',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			 $desc = filter_input(INPUT_POST,'description',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			 $indented = filter_input(INPUT_POST,'indented',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$uploadok=1;
    			if ($_FILES["manualfile"]["error"] > 0) {
        			if($_FILES["manualfile"]["error"]==4){
					$myerrmsg="No File Uploaded";
            				include "view/manualuploaderror.php";
				$rows=$this->manualmodel->updatemanualfile($manualid,"NOFILE",$filetype,$desc,$indented,$username);	
				include "view/manualedited.php";
        			}
        			else{
					$myerrmsg=$_FILES["manualfile"]["error"];
            				include "view/manualuploaderror.php";
				}
				$uploadok=0;
        		}

			else{
				$filesize=$_FILES["manualfile"]["size"];	
				$filetype=$_FILES["manualfile"]["type"];	
				$filename=$_FILES["manualfile"]["name"];

				$fileloc="manuals/$filename";
				if($filesize > 100000000){
					$myerrmsg="File size is greater than 100MB";
            				include "view/manualuploaderror.php";
					$uploadok=0;
				}
				$fileext=strtolower(pathinfo($filename,PATHINFO_EXTENSION));

				$allowedexts=array("pdf","txt","gif","png","jpg","jpeg","doc","docx","ppt","pptx");
				if(!(in_array($fileext,$allowedexts))){
					$myerrmsg="$fileext extension not allowed:Only upload pdf/doc/ppt/txt/gif/png/jpg files";
            				include "view/manualuploaderror.php";
					$uploadok=0;

				}
				if($uploadok==1){
            			if(move_uploaded_file($_FILES["manualfile"]["tmp_name"], $fileloc)){
					
				$rows=$this->manualmodel->updatemanualfile($manualid,$fileloc,$filetype,$desc,$indented,$username);	
				include "view/manualedited.php";
				}
				else{
					$myerrmsg="File copy to $fileloc failed..Try Again";
            				include "view/manualuploaderror.php";
				}
				}
				}//file upload
			}//if post
			else{
		 	$manualid = filter_input(INPUT_GET,'manualid',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$type='file';
			list($fileloc,$desc,$indented)=$this->manualmodel->editmanual($username,$manualid,$type);
			if($fileloc){
			include "view/editmanualfile.php";
			}
			else{
			$myerrmsg="You are not permitted to edit this note";
            		include "view/manualuploaderror.php";
			}
		}
	}//function

	public function addmanualfile($username){
		if(isset($_POST['submitfile']) ){

			$uploadok=1;
			$desc = filter_input(INPUT_POST,'description',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$indented = filter_input(INPUT_POST,'indented',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $category = filter_input(INPUT_POST,'category',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    			if ($_FILES["manualfile"]["error"] > 0) {
        			if($_FILES["manualfile"]["error"]==4){
					$myerrmsg="No File Uploaded";
            				include "view/manualuploaderror.php";
        			}
        			else{
					$myerrmsg=$_FILES["manualfile"]["error"];
            				include "view/manualuploaderror.php";
				}
				$uploadok=0;
        		}

			else{

				$filesize=$_FILES["manualfile"]["size"];	
				$filetype=$_FILES["manualfile"]["type"];	
				$filename=$_FILES["manualfile"]["name"];

				$fileloc="manuals/$filename";
				if($filesize > 100000000){
					$myerrmsg="File size is greater than 100MB";
            				include "view/manualuploaderror.php";
					$uploadok=0;
				}
				if(file_exists($fileloc)){
					$myerrmsg="$filename already exists,choose another name";
            				include "view/manualuploaderror.php";
					$uploadok=0;
            			}
				$fileext=strtolower(pathinfo($filename,PATHINFO_EXTENSION));

				$allowedexts=array("pdf","txt","gif","png","jpg","jpeg","doc","docx","ppt","pptx","xlsx","xls");
				if(!(in_array($fileext,$allowedexts))){
					$myerrmsg="$fileext extension not allowed:Only upload pdf/doc/ppt/txt/gif/png/jpg files";
            				include "view/manualuploaderror.php";
					$uploadok=0;

				}
				if($uploadok==1){
            			if(move_uploaded_file($_FILES["manualfile"]["tmp_name"], $fileloc)){
					
				$myid=$this->manualmodel->addmanualfile($fileloc,$filetype,$desc,$indented,$username,$category);	
				include "view/manualfileadded.php";
				}
				else{
					$myerrmsg="File copy to $fileloc failed..Try Again";
            				include "view/manualuploaderror.php";

				}
				}
				}//else
		}//if post
		else{
			include "view/addmanualfile.php";
		}
	
	}
	public function deletemanualnote($username){

		if(isset($_POST['deletenote']) ){

		 $manualid = filter_input(INPUT_POST,'manualid',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$rows=$this->manualmodel->deletemanualnote($manualid,$username);	

			if(is_numeric($rows)){

			include "view/manualdeleted.php";
			}
			else{
			$myerrmsg="Deleting note failed";
            		include "view/manualuploaderror.php";
			}
		}
		else{
		 	$manualid = filter_input(INPUT_GET,'manualid',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$type='note';
			list($fileloc,$desc,$indented)=$this->manualmodel->editmanual($username,$manualid,$type);
			if($fileloc){
			include "view/deletemanualnote.php";
			}
			else{
			$myerrmsg="You are not permitted to delete this note";
            		include "view/manualuploaderror.php";
			}
		}
	}

	public function deletemanualfile($username){

                if(isset($_POST['deletefile']) ){

                 $manualid = filter_input(INPUT_POST,'manualid',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $rows=$this->manualmodel->deletemanualfile($manualid,$username);

                        if(is_numeric($rows)){

                        include "view/manualdeleted.php";
                        }
                        else{
                        $myerrmsg="Deleting File failed";
                        include "view/manualuploaderror.php";
                        }
                }
                else{
                        $manualid = filter_input(INPUT_GET,'manualid',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $type='file';
                        list($fileloc,$desc,$indented)=$this->manualmodel->editmanual($username,$manualid,$type);
                        if($fileloc){
                        include "view/deletemanualfile.php";
                        }
                        else{
                        $myerrmsg="You are not permitted to delete this file";
                        include "view/manualuploaderror.php";
                        }
                }
        }

	public function viewmanual($usertype,$username){
    $mymanualcat='HPC';
		$mymanuals=$this->manualmodel->viewmanual($usertype,$mymanualcat);
    
		include "view/manualdisplay.php";
	}

public function viewmanualvdi($usertype,$username){
    $mymanualcat='VDI';
		$mymanuals=$this->manualmodel->viewmanual($usertype,$mymanualcat);
		include "view/manualdisplay.php";
	}

public function viewmanualgen($usertype,$username){
    $mymanualcat='GEN';
		$mymanuals=$this->manualmodel->viewmanual($usertype,$mymanualcat);
		include "view/manualdisplay.php";
	}

public function viewmanualIR($usertype,$username){
    $mymanualcat='IR';
		$mymanuals=$this->manualmodel->viewmanual($usertype,$mymanualcat);
		include "view/manualdisplay.php";
	}

}
?>
