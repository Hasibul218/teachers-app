<?php 
	
	require_once 'dbconnect.php';
	include_once 'functions.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add new teachers</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	<?php 
		/**
		 * Student Data Collect
		 */
		if (isset($_POST['submit'])) {
			$has = false;
			$name = $_POST['name'];
			$uname = $_POST['uname'];
			$email = $_POST['email'];
			$cell = $_POST['cell'];
			$age = $_POST['age'];
			$location = $_POST['location'];
			$course = $_POST['course'];
			$status = $_POST['status'];

			/**
			 * Name Empty Check
			 */
			if (empty($name)) {
				$mesg = "<p class='alert alert-danger'>*Name requeired<button class='close' data-dismiss='alert'>&times;</button></p>";
				$has = true;
			}
			/**
			 * Username Empty Check
			 */
			if (empty($uname)) {
				$mesg = "<p class='alert alert-danger'>*Username requeired<button class='close' data-dismiss='alert'>&times;</button></p>";
				$has = true;
			}elseif (existingUname($uname) == false) {
				$mesg = "<p class='alert alert-danger'>*Username have been used<button class='close' data-dismiss='alert'>&times;</button></p>";
				$has = true;
			}
			/**
			 * Gender Empty Check
			 */
			if (isset($gender)) {
				$gender = $_POST['gender'];
			}
			/**
			 * Email Empty Check With Validate
			 */

			
			if (empty($email)) {
				$mesg = "<p class='alert alert-danger'>*Email requeired<button class='close' data-dismiss='alert'>&times;</button></p>";
				$has = true;
			}elseif (emailValidate($email) == false) {
				$mesg = "<p class='alert alert-danger'>*Unvalid email<button class='close' data-dismiss='alert'>&times;</button></p>";
				$has = true;
			}/*elseif (emailRestrict($email) == false) {
				$mesg = "<p class='alert alert-danger'>Only for aiub.com<button class='close' data-dismiss='alert'>&times;</button></p>";
				$has = true;
			}*/elseif (existingEmail($email) == false) {
				$mesg = "<p class='alert alert-danger'>Email have been used<button class='close' data-dismiss='alert'>&times;</button></p>";
				$has = true;
			}
			/**
			 * Cell No. Empty Check With Validate
			 */
			if (empty($cell)) {
				$mesg = "<p class='alert alert-danger'>*Cell no. requeired<button class='close' data-dismiss='alert'>&times;</button></p>";
				$has = true;
			}elseif (existingCell($cell) == false) {
				$mesg = "<p class='alert alert-danger'>Cell have been used<button class='close' data-dismiss='alert'>&times;</button></p>";
				$has = true;
			}
			/**
			 * Age Empty Check With Validate
			 */
			if (empty($age)) {
				$mesg = "<p class='alert alert-danger'>*Age requeired<button class='close' data-dismiss='alert'>&times;</button></p>";
				$has = true;
			}elseif (underAge($age, 22) == false) {
				$mesg = "<p class='alert alert-danger'>You are under age<button class='close' data-dismiss='alert'>&times;</button></p>";
				$has = true;
			}elseif (overAge($age, 40) == false) {
				$mesg = "<p class='alert alert-danger'>You are over age<button class='close' data-dismiss='alert'>&times;</button></p>";
				$has = true;
			}


			

			/**
			 * Insert into database name "awd416"
			 */
			if ($has == false) {
				//files upload
			$file_data = fileUpload($_FILES['file'], 'assets/img/',['jpg', 'png', 'jpeg', 'gif'], 1024);
			$file_name = $file_data['file_name'];
			$file_mess = $file_data['mess'];

			if (!empty($file_mess)) {
				$mesg = $file_mess;
			}else{

				$sql = "INSERT INTO teachers (name, uname, email, cell,course, age, location, gender,photo, status) VALUES ('$name', '$uname', '$email', '$cell','$course', '$age', '$location', '$gender','$file_name', '$status')";
				$connection -> query($sql);
				 header ('Location:table.php');
				}
			}
		}
			
	 ?>
	<div class="wrap shadow">
	<a class="btn btn-sm btn-info" href="table.php">View Teachers</a>
		<div class="card">
			<div class="card-body">
				<h2>Add Teacher</h2>
				<?php 
				/**
				 * Error message show
				 */
					if (isset($mesg)) {
						echo $mesg;
					}
				 ?>
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">Teacher Name</label>
						<input name="name" class="form-control" type="text" placeholder="Name" value="<?php oldData('name') ?>">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input name="uname" class="form-control" type="text" placeholder="Username" value="<?php oldData('uname') ?>">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input name="email" class="form-control" type="text" placeholder="Email" value="<?php oldData('email') ?>">
					</div>
					<div class="form-group">
						<label for="">Cell</label>
						<input name="cell" class="form-control" type="text" placeholder="Cell no." value="<?php oldData('cell') ?>">
					</div>
					<div class="form-group">
						<label for="">Course</label>
						<select name="course" id="" class="form-control">
							<option value="">-Select-</option>
							<option value="Bangla">Bangla</option>
							<option value="English">English</option>
							<option value="Mathametics">Mathametics</option>
							<option value="Biology">Biology</option>
							<option value="Social Science">Social Science</option>
						</select>
					</div>
					<div class="form-group">
						<label for="">Age</label>
						<input name="age" class="form-control" type="text" placeholder="Age" value="<?php oldData('age') ?>">
					</div>
					<div class="form-group">
						<label for="">Location</label>
						<select name="location" id="" class="form-control">
							<option value="">-Select-</option>
							<option value="Mirpur">Mirpur</option>
							<option value="Dhanmondi">Dhanmondi</option>
							<option value="Khilkhet">Khilkhet</option>
							<option value="Nikunja">Nikunja</option>
							<option value="Banani">Banani</option>
						</select>
					</div>
					<div class="form-group">
						<label for="">Gender</label>
						<br>
						<input name="gender" type="radio" value="Male" id="male"><label for="male">&nbsp Male</label>
						<input name="gender" type="radio" value="Female" id="female"><label for="female">&nbsp Female</label>
					</div>
					<div class="form-group">
						<label for="">Photo</label>
						<br>
						<input type="file" name="file" class="form-control">
					</div>
					<div class="form-group">
						<input type="checkbox" checked id="publish" name="status" value="Published"><label for="publish">&nbsp Published</label>
					</div>
					<div class="form-group">
						<input name="submit" class="btn btn-primary" type="submit" value="Add Teacher">
					</div>
				</form>
			</div>
		</div>
	</div>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>