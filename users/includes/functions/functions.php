
<?php

function pageTitle() {
	global $pageTitle;
	if (isset($pageTitle)) {
		echo $pageTitle;
	} else {
		echo 'Page';
	}
}

/*
	? Function name:
									TODO: messages.
	? Function Parameters:
											! This Function Have Tow Parameters.
											TODO: First Parameter Is $type => This responsible of choose the type of message such as (Info, Success, Warning, Danger).
											TODO: Second Parameter Is $content => This responsible of content of the message.
	? Function Body:
								TODO: The function contains conditions. When any condition is true, the message inside the condition will appear.

*/
// TODO: Start Function messages.
function messages($type, $content){
	if ($type == 'Info') {
		?>
		<div class="items-message m1" id="choose-display">
				<div class="icon-mass"><i class="fa-solid fa-bell"></i></div>
				<p class="message">Info: <?php echo $content;?></p>
				<div class="icon-mess-2"><i class="fa-solid fa-xmark"></i></div>
		</div>
		<?php
	}
	if ($type == 'Success') {
		?>
		<div class="items-message m2" id="choose-display">
				<div class="icon-mass"><i class="fa-solid fa-check"></i></div>
				<p class="message">Success: <?php echo $content;?></p>
				<div class="icon-mess-2"><i class="fa-solid fa-xmark"></i></div>
		</div>
		<?php
	}
	if ($type == 'Warning') {
		?>
		<div class="items-message m3" id="choose-display">
				<div class="icon-mass"><i class="fa-solid fa-triangle-exclamation"></i></div>
				<p class="message">Warning: <?php echo $content;?></p>
				<div class="icon-mess-2"><i class="fa-solid fa-xmark"></i></div>
		</div>
		<?php
	}
	if ($type == 'Denger') {
		?>
		<div class="items-message m4" id="choose-display">
				<div class="icon-mass"><i class="fa-solid fa-xmark"></i></div>
				<p class="message">Danger: <?php echo $content;?></p>
				<div class="icon-mess-2"><i class="fa fa-solid fa-xmark"></i></div>
		</div>
		<?php
	}
}
// TODO: End Function messages.

function counter($table, $where) {
	global $CONDB;
	$c = $CONDB->prepare("SELECT * FROM `$table` $where");
	$c->execute();
	echo $c->rowCount();
}
?>
