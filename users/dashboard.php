<?php

session_start();

$pageTitle = 'Dashboard';

require ('initialize.php');


if (isset($_SESSION) || isset($_COOKIE)) {
	if ($_SESSION['ACCESS'] == 'Admin' || $_SESSION['ACCESS'] == 'Client') {
    ?>
			<div class="dashboard">
				<?php require $temp . ('navbar.php');?>

				
				<!-- <section class="contant"></section> -->

				<?php require $temp . ('footer.php');?>
			</div>
	<?php
	}
	else {
		messages('Denger', 'You can\'t access this page.It will be taken back to the login page after 5 seconds.');
		header('refresh:5,../logout.php');
	}
}
else {
	messages('Denger', 'There was an access error..It will be taken back to the login page after 5 seconds.');
	header('refresh:5,../logout.php');
}

require $temp . ('end.body.php');

?>