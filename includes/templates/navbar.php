<nav class="navbar">

	<a href="main.php">
		<h1 class="site-name">
			freelance
		</h1>
	</a>
	
	<ul>
		
		<li class="search-form">
			<form action="">
				<i class="search-icon fa-solid fa-magnifying-glass"></i>
				<input type="search" placeholder="Search...">
				<input type="submit" value="Search">
			</form>
		</li>
		
		<li class="links-nav">
			<a href="#">Profile
				<i class="fa-solid fa-caret-down"></i>
			</a>

			<div class="dropdown-menu">
				<ul>
					<?php
					if (isset($_SESSION['EMAIL'])) { ?>
						<li class="links-nav">
							<a href="#">My Account
								<span class="icon">
								<i class="fa-solid fa-user"></i>
								</span>
							</a>
						</li>

						<li class="links-nav">
							<a href="logout.php">Logout
								<span class="icon">
									<i class="fa-solid fa-right-from-bracket"></i>
								</span>
							</a>
						</li>
					<?php
					} else { ?>
						<li class="links-nav">
							<a href="registration.php">Sign Up
								<span class="icon">
									<i class="fa-solid fa-user-plus"></i>
								</span>
							</a>
						</li>
						
						<li class="links-nav">
							<a href="login.php">Login
								<span class="icon">
									<i class="fa-solid fa-right-to-bracket"></i>
								</span>
							</a>
						</li>
					<?php
					}
					?>
				</ul>
			</div>
		</li>

		<li class="links-nav"><a href="#">Browse Jobs</a></li>

		<?php
		
		if (isset($_SESSION['EMAIL'])) {
			if ($_SESSION['ACCESS'] == 'Admin' || $_SESSION['ACCESS'] == 'Client') { ?>
				<li class="links-nav">
					<a href="<?php if($_SESSION['ACCESS'] == 'Admin'){echo 'users/dashboard.php';}else{echo 'users/dashboard.php';}?>">
						Dashboard
						<span class="icon">
							<i class="fa-solid fa-caret-down"></i>
						</span>
					</a>
					<div class="dropdown-menu">
						<ul>
							<li class="links-nav">
								<a href="main.php">Home
									<span class="icon">
										<i class="fa-solid fa-house"></i>
									</span>
								</a>
							</li>
							<?php
								if ($_SESSION['ACCESS'] == 'Admin') {
									?>
									<li class="links-nav">
										<a href="users/members.php?do=Manage&userID=<?php echo $_SESSION['ID']?>">Members
											<span class="icon">
												<i class="fa-solid fa-users"></i>
											</span>
										</a>
									</li>
		
									<li class="links-nav">
										<a href="users/category.php">Categories
											<span class="icon">
												<i class="fa-solid fa-file"></i>
											</span>
										</a>
									</li>
									<?php
								}
							?>
							<li class="links-nav">
								<a href="users/jobs.php">jobs
									<span class="icon">
										<i class="fa-solid fa-user-tie"></i>
									</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
			<?php
			}
		}
		
		?>

		
		<li class="links-nav"><a href="#features">Features</a></li>
		
		<li class="links-nav"><a href="#about">About Us</a></li>
		
		<li class="links-nav"><a href="#Contact">Contact Us</a></li>
	</ul>
</nav>