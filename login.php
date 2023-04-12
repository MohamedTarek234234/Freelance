<?php

	// Start new or resume existing session.
	session_start();

	// This variable contain name of page.
	$pageTitle = 'Login';

	// initialize.php file contain all routes you need and include important files such as connection file.
	require ('initialize.php');

	// Condition to check if request method is POST or GET.
	// On the login page the method to send data should be POST.
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		// Get the value of the variables from the form.
		$email 		 	= $_POST['email'];
		$password  	= $_POST['password'];
		@$remmberMe = $_POST['remmberMe'];

		/*
		check the values of inputs are empty if:-
																					True: send message.
																					False: continue.
		*/
		if (empty($email) && empty($password)) {
			echo '<div class="messages-in-back">';
				messages('Warning', 'Enter your email and password.');
			echo '</div>';
		}
		else {
			if (empty($email)) {
				echo '<div class="messages-in-back">';
					messages('Warning', 'Enter your email.');
				echo '</div>';
			}
			else {
				if (empty($password)) {
					echo '<div class="messages-in-back">';
						messages('Warning', 'Enter your password.');
					echo '</div>';
				}
				else {
					// Prepares a statement for execution and returns a statement object.
					// The SELECT statement is used to select data from a database.
					$stmt1 = $CONDB->prepare("SELECT * FROM
																									`users`
																						WHERE
																									`Email` = ?
																							AND
																									`Password` = ?
																					LIMIT 1");

					// Executes a prepared statement.
					$stmt1->execute([$email, $password]);

					// Fetch all data.
					$row = $stmt1->fetch();

					// Variable $count will contain the count of rows affected.
					$count = $stmt1->rowCount();

					/*
					Condition to check if the data entered by user is exist:-
																																True: continue.
																																False: send message.
					*/
					if ($count > 0) {
						if ($remmberMe == 1) {
							setcookie('ID', $row['ID'], time() + 60*60*24*30*12, '/');
							setcookie('NAME', $row['Name'], time() + 60*60*24*30*12, '/');
							setcookie('ACCESS', $row['UserRole'], time() + 60*60*24*30*12, '/');
							setcookie('EMAIL', $email, time() + 60*60*24*30*12, '/');
							header('Location: index.php');
							exit();
						}
						else {
							$_SESSION['ID'] 	 	   = $row['ID'];
							$_SESSION['NAME']      = $row['Name'];
							$_SESSION['ACCESS']    = $row['UserRole'];
							$_SESSION['EMAIL'] 	 	 = $email;
							if ($_SESSION['ACCESS'] == 'Admin') {
								header('Location: users/dashboard.php');
								exit();
							}
							else {
								if ($_SESSION['ACCESS'] == 'Client') {
									header('Location: users/dashboard.php');
									exit();
								}
								else {
									header('Location: main.php');
									exit();
								}
							}
						}
					}else {
						echo '<div class="messages-in-back">';
							messages('Warning', 'Check your email and password.');
						echo '</div>';
					}
				}
			}
		}
	}

?>
<div class="login-container">
	
	<div class="login-form">
		<h1 class="page-name">Login | <a href="main.php">Freelance</a></h1>

		<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
			<div class="input-field fields-valid">
				<i class="fa-solid fa-envelope"></i>
				<input type="email" class="email-input" name="email" placeholder="Enter your email">
			</div>
			<div class="input-message-valid">! Email field cannot be empty.</div>
			
			<div class="input-field fields-valid">
				<i class="fa-solid fa-lock"></i>
				<input type="password" class="pass-input" name="password" placeholder="Enter password">
			</div>
			<div class="input-message-valid">! Password field cannot be empty.</div>

			<div class="check-remmber">
				<input id="remmberMe" type="checkbox" name="remmberMe" value="1">
				<label for="remmberMe">Remmber Me</label>
			</div>

			<input class="button-login" type="submit" value=" Login" disabled>
		</form>
		<span>
			Create an account?
			<a href="registration.php">Sign up</a>
		</span>
	</div>

</div>

<?php require $temp . ('end.body.php');?>