<?php
$pageTitle = 'Sign Up';
require('initialize.php');

// If Condition To Check The Request Method Is POST Or GET.
// NOTE: When You click submit In This Website Should Be Requested Method Is POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST'){

	// trim() --> Built in function remove all spaces around the string or number.
	// Get Values From Inputs And Put It In Variables.
	$name 						= trim($_POST['name']);
	$email 						= trim($_POST['email']);
	$password 				= trim($_POST['password']);
	$retypePassword 	= trim($_POST['retypePassword']);
	$userRole 				= $_POST['userRole'];
	$phoneNumber 			= trim($_POST['phoneNumber']);

	// A variable that contains an array of uppercase letters.
	$upperCase 				= str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');

	// An empty array but we will put errors in it.
	$formErrors = [];

	// If Password Is Not Empty.
	if (!empty($password)){

		// First letter of the password should be capital.
		if (!in_array($password[0], $upperCase)) {
			$formErrors[] = 'First letter of the password should be capital.';
		}

		// strpos — Find the position of the first occurrence of a substring in a string.
		for ($i=0; $i<strlen($password); $i++) {
			// If Password Not Have Special Character The Variable $count Will Be value 0 else The Value Will Be 1.
			if (!strpos('~!@#$%&*+=|?', $password[$i]) !== false) {
				$count1 = 0;
			}else {
				$count1 = 1;
				break;
			}
		}
		if ($count1 === 0) {
			$formErrors[] = 'Password must contain a special character (~, !, @, #, $, %, &, *, +, =, |, ?).';
		}
		if (strlen($password) < 8) {
			$formErrors[] = 'Password length must be greater than 8 characters';
		}if ($password !== $retypePassword) {
			$formErrors[] = 'Incorrect password confirmation';
		}
	}

	if (empty($name) || empty($email) || empty($password) || empty($retypePassword)) {
		$formErrors[] = 'All fields are required.';
	}
	else {
		if ($userRole == 'Freelancer' && empty($phoneNumber)) {
				$formErrors[] = 'Phone number is required';
	}
	}
	
	if (!empty($formErrors)) {
		echo '<div class="messages-in-back">';
			foreach ($formErrors as $error) {
				messages('Warning', $error);
			}
		echo '</div>';
	}
	
	
	else {
		// Prepared Statements(SELECT).
		$stmt = $CONDB->prepare("SELECT
																		`Email`
																FROM 
																		`users`
																WHERE
																		`Email` = ?");
		
		// Execute Query.
		$stmt->execute([$email]);

		// rowCount — Returns the number of rows affected by the last SQL statement.
    // This Variable Will Use To Check If Email Is Exist Or Not Exist.
		// If Email Is Not Exist The Variable $count2 Will Be Contain 0 Value.
		$count2 = $stmt->rowCount();
		
		// If Variable $count2 Is Contain Value 0 Will Insert Data In DataBase.
		if ($count2 === 0){

			// Prepared Statements(Insert).
			$stmt2 = $CONDB->prepare("INSERT INTO
																					`users`(`Name`, `Email`, `Password`, `UserRole`, `PhoneNumber`)
																		VALUES
																					(:name, :email, :password, :userRole, :phoneNumber)");
			// Execute Query.
			$stmt2->execute([
											':name' 			 => $name,
											':email' 			 => $email,
											':password' 	 => $password,
											':userRole' 	 => $userRole,
											':phoneNumber' => $phoneNumber
											]);
			
			// This Variable Will Use To Check If Data Was Inserted In DataBase Or Not.
			$count3 = $stmt2->rowCount();
			
			// If Data Inserted In DataBase The Variable $count Will Contain Value 1.
			// And Use Function messages() To Show The Message.
			if ($count3 === 1){
				messages('Success', 'The account has been created. You will be directed to the login page.');
				header('refresh:5;url=login.php');
				exit();
			}else {
				messages('Denger', 'An error occurred, try again.');
			}}
			else {
				messages('Warning', 'The account you entered already exists.');
			}
		}
}

?>

<!-- Start Registration Form -->
<div class="registration-container">

	<div class="registration-form">

		<h1 class="page-name">Sign up | <a href="main.php">Freelance</a></h1>

		<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">

			<div class="input-field">
				<i class="fa fa-solid fa-user"></i>
				<input type="text" name="name" placeholder="Enter your name">
			</div>

			<div class="input-field">
				<i class="fa fa-solid fa-envelope"></i>
				<input type="email" name="email" placeholder="Enter your email">
			</div>
				
			<div class="input-field">
				<i class="fa fa-solid fa-lock"></i>
				<input type="password" name="password" placeholder="Enter password">
			</div>
			
			<div class="input-field">
				<i class="fa fa-solid fa-lock"></i>
				<input type="password" name="retypePassword" placeholder="Confirm password">
			</div>
			
			<div class="radio-group">
					<label class="radio" for="client">
						<input type="radio" id="client" name="userRole" value="Client" onclick="displayDiv('hide')">
						Client
					</label>
					<label class="radio" for="freelancer">
						<input type="radio" id="freelancer" name="userRole" value="Freelancer" checked onclick="displayDiv('show')">
						Freelancer
					</label>
			</div>
			
			<div class="input-field" id="choose-display">
				<i class="fa fa-solid fa-phone"></i>
				<input type="tel" name="phoneNumber" placeholder="+20 Phone Number">
			</div>
		
			<input type="submit" value=" Register">
			<input type="reset" value="Reset">
		
		</form>

		<span>
			Alrady have an account?
			<a href="login.php">login</a>
		</span>
	</div>
</div>
<!-- End Registration Form -->

<!-- Include Footer -->
<?php require $temp . ('end.body.php'); ?>

