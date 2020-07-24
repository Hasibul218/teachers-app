<?php 
	require_once 'dbconnect.php';
	/**
	 * Old Data
	 */

 function oldData($value){
     if(isset($_POST[$value])){
        echo $_POST[$value];
     }
 }
 /**
  * Email Validate
  */
 function emailValidate($email)
 {
 	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
 		return true;
 	}else{
 		return false;
 	}
 }
/**
 * Email Restrict
 */
/*  function emailRestrict($email){

    $email_part =  explode('@', $email);
    $last_mail_part = end($email_part);

    if($last_mail_part == 'aiub.com'){
        return true;
    }else{
        return false;
    }
}*/
/**
 * Age Validate Under Age
 */
function underAge($age, $min){
	if ($age < $min) {
		return false;
	}else{
		return true;
	}
}
function overAge($age, $max){
	if ($age > $max) {
		return false;
	}else{
		return true;
	}
}
/**
 * File uploading system
 */
function fileUpload($file, $location, $file_type = ['jpg', 'png', 'gif', 'jpeg'], $size){
	//file information
	$file_name = $file['name'];
	$file_tmp_name = $file['tmp_name'];
	$file_size = $file['size'] / 1024;

	//file extenstion
	$file_array = explode('.', $file_name);
	$file_extenstion = strtolower(end($file_array));
	//file size check
	if ($file_size >= $size) {
		$file_size_check = false;
	}else{
		$file_size_check = true;
	}

	//Unique name
	$unique = md5(time().rand()). '.' .$file_extenstion;
	//file type check
	if (in_array($file_extenstion, $file_type) == false) {
		$mesg = "<p class='alert alert-danger'>'Invalid file type'<button class='close' data-dismiss='alert'>&times;</button></p>";
	}elseif ($file_size_check == false) {
		$mesg = "<p class='alert alert-danger'>'Invalid file size'<button class='close' data-dismiss='alert'>&times;</button></p>";
	}else{
		move_uploaded_file($file_tmp_name, $location . $unique);
	}
	//return name & error message for outside access
	return [
		'file_name' => $unique,
		'mess' => $mesg,
	];
}

/**
 * Email Existing In DataBase 
 */
function existingEmail($email){
	//database have the mail or not check starts
	global $connection;
	$sql_email = "SELECT email FROM teachers WHERE email='$email'";
	$check_email = $connection -> query($sql_email);
	$num_email = $check_email -> num_rows;
	if ($num_email > 0) {
		return false;
	}else{
		return true;
	}
	//database have the mail or not check ends

}
/**
 * Username Existing In DataBase 
 */
function existingUname($uname){
	global $connection;
	$sql_uname = "SELECT uname FROM teachers WHERE uname='$uname'";
	$check_uname = $connection -> query($sql_uname);
	$num_uname = $check_uname -> num_rows;
	if ($num_uname > 0) {
		return false;
	}else{
		return true;
	}
	
}
/**
 * Cell number Existing in database
 */
function existingCell($cell){
	//database have the cell or not check starts
	global $connection;
	$sql_cell = "SELECT cell FROM teachers WHERE cell='$cell'";
	$check_cell = $connection -> query($sql_cell);
	$num_cell = $check_cell -> num_rows;
	if ($num_cell > 0) {
		return false;
	}else{
		return true;
	}
	//database have the mail or not check ends
}
/**
 * Delete Teacher From database function
 */
$id =" ";
if (isset($_GET['id'])) {
	deleteTeacher($_GET['id']);
	echo $id = $_GET['id'];
}
function deleteTeacher($id){
	global $connection;
	$sql_delete_teacher = "DELETE FROM teachers WHERE id = '$id'";
	$connection -> query($sql_delete_teacher);
	header("location:table.php");
}
 ?>

