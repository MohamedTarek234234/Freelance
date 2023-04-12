<?php
	session_start();
	
	$pageTitle = 'Home';
	
	require('initialize.php');

	require $temp . ('navbar.php');
?>

	<div id="home" class="start-sections">
		<section class="welcome-section">
			<div class="welcome-text">
				<h1>Welcome,</h1>
				<p>If you landed on this page, chances are you 
					are considering taking the leap into freelancing. 
					Welcome to the world of the entrepreneur! Whether 
					you're motivated by a dream to work for yourself 
					or a desire for more flexibility, it's worth 
					remembering that a freelance life comes with great 
					perks and some challenges.</p>
			</div>
		</section>

		<section id="features" class="features-section">
			<h2>features</h2>
			<div class="container">
				<div class="feature">
					<span class="icon">
						<i class="fa-solid fa-user-tie"></i>
					</span>
					<h3>Client</h3>
					<p>Freelancing is a type of self-employment. Instead 
						of being employed by a company, freelancers tend 
						to work as self-employed, delivering their 
						services on a contract or project basis.</p>
				</div>

				<div class="feature">
					<span class="icon">
						<i class="fa-solid fa-users"></i>
					</span>
					<h3>Freelancer</h3>
					<p>Companies of all types and sizes can hire freelancers 
						to complete a project or a task, but freelancers 
						are responsible for paying their own taxes, 
						health insurance, pension and other personal 
						contributions.</p>
				</div>
			</div>
		</section>

		<section id="about" class="aboutUs-section">
			<h2>About Us</h2>
			<div class="container">
				<div class="aboutUs-text">
					<div class="ask">
						<h4>Looking for a job?</h4>
						<p>If you are searching for a new career opportunity,
							you can search open vacancies and jobs.You can also
							<a href="registration.php">sign up</a> 
							here to be alerted of new jobs by email.</p>
					</div>
					<div class="ask">
						<h4>Are you a recruiter or employer?</h4>
						<p>If you are searching for a new career opportunity,
							you can search open vacancies and jobs.You can also
							<a href="registration.php">sign up</a> 
							here to be alerted of new jobs by email.</p>
					</div>
					<div class="ask">
						<h4>Other question?</h4>
						<p>If you have any another question, please contact us.</p>
					</div>
				</div>
				<div class="image-aboutUs">
					<img src="layout/images/2202.q802.002.S.m009.c10.it specialist illustration flat.jpg" alt="" srcset="">
				</div>
			</div>
		</section>

		<section id="Contact" class="contactUs-section">
			<h2>Contact Us</h2>
			<form action="" method="POST">
				<div class="container">
					<div class="input-field">
						<label for="name">Name</label>
						<input type="text" id="name" name="name" placeholder="Enter Your Name">
					</div>
					<div class="input-field">
						<label for="email">Email</label>
						<input type="email" id="email" name="email" placeholder="example@example.com">
					</div>
					<div class="input-field">
						<label for="phone">Phone Number</label>
						<input type="tel" id="phone" name="phone" placeholder="+20">
					</div>
					<div class="input-field">
						<label for="subject">Subject</label>
						<input type="text" id="subject" name="subject">
					</div>
					<div class="input-field">
						<label for="message">Message</label>
						<textarea name="message" id="message" rows="5"></textarea>
					</div>
					<div class="buttons">
						<input type="submit" value="Send">
						<input type="reset" value="Reset">
					</div>
				</div>
			</form>
		</section>
		<?php require $temp . ('footer.php');?>
	</div>

<?php require $temp . ('end.body.php');?>