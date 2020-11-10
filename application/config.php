<?php
/**
 * Author: Matthew McGee
 * Date: 11/9/2020
 * File: config.php
 *Description:
 */

//error reporting level: 0 to turn off all error reporting; E_ALL to report all
error_reporting(E_ALL);

//local time zone
date_default_timezone_set('America/New_York');

//base url of the application
define("BASE_URL", "http://localhost/I211/Final");

/*************************************************************************************
 *                       settings for vehicles                                       *
 ************************************************************************************/

//define default path for media images
define("Vehicle_img", "www/img/vehicles/");


///*************************************************************************************
// *                       settings for books                                         *
// ************************************************************************************/
//
////define default path for media images
//define("BOOK_IMG", "www/img/vehicles/");