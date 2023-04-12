<?php

	//! Connection File.
	require ('connection.php');

	//! Routes
	$temp = 'includes/templates/';
	$func = 'includes/functions/';
	$css  = 'layout/css/';
	$js   = 'layout/js/';
	$img   = 'layout/images/';

	//! Include Important Files
	require $func . ('functions.php');
	require $temp . ('header.php');