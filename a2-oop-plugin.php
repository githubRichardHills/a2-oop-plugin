<?php declare(strict_types=1);
/**
 * @package a2-oop-plugin
 * @version 1.0
 */
/*
Plugin Name: A2 OOP Plugin
Description: A learning project
Author: Richard Hills
Version: 1.1
*/


function a2oopp() {
	require_once 'wp-content/plugins/a2-oop-plugin/app/init.php'; ###this requires once Dbh.php and Controller.php
	$controller=new Controller(); ##This creates a new instance of the Controller class which invokes the __construct() method and boots the whole application
}

add_shortcode( 'a2oopproject', 'a2oopp' );