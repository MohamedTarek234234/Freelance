<?php
	session_start();
	$pageTitle = 'Memebers';
	require ('initialize.php');

	?>
	<div class="dashboard">
		<?php require $temp . ('navbar.php');?>

		<section class="container">
			<?php

				if (isset($_SESSION['NAME'])) {

					$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

					if ($do == 'Manage') {

						$usersArray = ['Admin', 'Client', 'Freelancer'];
						if (isset($_GET['users']) && in_array($_GET['users'], $usersArray)) {
							if ($_GET['users'] == 'Client') {
								$whereStmt = "`UserRole` = 'Client'";
							}
							else {
								if ($_GET['users'] == 'Freelancer') {
									$whereStmt = "`UserRole` = 'Freelancer'";
								}
								else {
									$whereStmt = "`UserRole` = 'Admin'";
								}
							}
							$stmt = $CONDB->prepare("SELECT * FROM `users` WHERE $whereStmt");
							$stmt->execute();
							$rows = $stmt->fetchAll();
						}
						else {
							if (isset($_GET['submit'])) {
								$email = $_GET['searchUser'];
								$stmt = $CONDB->prepare("SELECT * FROM `users` WHERE `Email` = ?");
								$stmt->execute([$email]);
								$count = $stmt->rowCount();
								if ($count == 1) {
									$rows = $stmt->fetchAll();
								}
								else {
									messages('Warning', 'There is no email you entered.');
									$stmt = $CONDB->prepare("SELECT * FROM `users`");
									$stmt->execute();
									$rows = $stmt->fetchAll();
								}
							}
							else {
								$stmt = $CONDB->prepare("SELECT * FROM `users`");
								$stmt->execute();
								$rows = $stmt->fetchAll();
							}
						}
						?>

						<div class="details">
							<div class="box">
								<a href="members.php?do=Manage&userID=<?php echo $_SESSION['ID']?>">
									<span class="icon"><i class="fa-solid fa-users"></i></span>
									<p class="num"><?php counter('users', "");;?></p>
									<p class="box-name">All Users</p>
								</a>
							</div>

							<div class="box">
								<a href="?users=Admin">
									<span class="icon"><i class="fa-solid fa-user-secret"></i></span>
									<p class="num"><?php counter('users', "WHERE `userRole` = 'Admin'"); ?></p>
									<p class="box-name">Admin</p>
								</a>
							</div>

							<div class="box">
								<a href="?users=Client">
									<span class="icon"><i class="fa-solid fa-user-tie"></i></span>
									<p class="num"><?php counter('users', "WHERE `userRole` = 'Client'"); ?></p>
									<p  class="box-name">Client</p>
								</a>
							</div>

							<div class="box">
								<a href="?users=Freelancer">
									<span class="icon"><i class="fa-solid fa-user"></i></span>
									<p class="num"><?php counter('users', "WHERE `userRole` = 'Freelancer'"); ?></p>
									<p class="box-name">Freelancer</p>
								</a>
							</div>

							<div class="box">
								<a href="add-member">
									<span class="icon"><i class="fa-solid fa-user-plus"></i></span>
									<p class="box-name">Add New Member</p>
								</a>
							</div>
						</div>

						<div class="search-users">
							<form action="<?php $_SERVER['PHP_SELF']?>" method="GET">
								<i class="search-icon fa-solid fa-magnifying-glass"></i>
								<input type="search" name="searchUser" placeholder="Enter email of any member...">
								<input type="submit" name="submit" value="Search">
							</form>
						</div>

						<div class="table-members">
							<table>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Email</th>
									<th>User Role</th>
									<th>Phone Number</th>
									<th>Controle</th>
								</tr>
								<?php
									foreach ($rows as $row) {
										echo '<tr>';
											echo '<td>' . $row['ID'] 		   . '</td>';
											echo '<td>' . $row['Name']     . '</td>';
											echo '<td>' . $row['Email']    . '</td>';
											echo '<td>' . $row['UserRole'] . '</td>';
											if($row['UserRole'] == 'Freelancer') {
												echo '<td>+20' . $row['PhoneNumber'] . '</td>';
											}
											else {
												echo '<td>NULL</td>';
											}
											echo '<td> 
															<div class="table-btn">
																<a href="" class="edit-btn">Edit</a>
																<a href="members.php?do=Delete&userID='.$row['ID'].'" class="del-btn">Delete</a>
															</div>
														</td>';
											echo '</tr>';
									}
								?>
							</table>
						</div>
						<?php
					}

					elseif ($do == 'Delete') {
						
						// isset() 			=> Determines if a variable is declared other than NULL.
						// is_numeric() => Finds whether a variable is a number or a numeric string
						// intval() 		=> The numerical value is converted to an integer.
						$userID = isset($_GET['userID']) && is_numeric($_GET['userID']) ? intval($_GET['userID']) : 0;

						$stmt = $CONDB->prepare("SELECT * FROM `users` WHERE ID = ?");
						$stmt->execute([$userID]);
						$count = $stmt->rowCount();

						if ($count == 1) {
							$stmt = $CONDB->prepare("DELETE FROM `users` WHERE ID = ?");
							$stmt->execute([$userID]);
							$count = $stmt->rowCount();
							if ($count == 1) {
								messages('Success', 'You have now deleted the user.');
								header('refresh:0.00000005,members.php?do=Manage&userID='.$_SESSION["ID"].'');

							}
							else {
								messages('Denger', 'This user cannot be deleted.');
							}
						}
						else {
							messages('Denger', 'THIS ID IS NOT EXIST.');
						}
					}


				}
				else {

					messages('Denger','There is an ERROR.');
				}

			?>
		</section>

		<?php require $temp . ('footer.php');?>
	</div>
	<?php

	require $temp . ('end.body.php');

?>