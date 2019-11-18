<?php
/**
 * @package EasyBook Add-Ons
 * @description A custom plugin for EasyBook - Hotel & Tour Booking WordPress Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date 03-10-2019
 * @version 1.1.7
 * @copyright Copyright ( C ) 2014 - 2019 cththemes.com . All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE
 */



// Include the class
require_once 'ipinfo.inc.php';

/*
add_action( 'wp_enqueue_scripts', function(){

	// // Include the class
	// require_once 'ipinfo.inc.php';

	// Get the API key, you could set this anywhere..
	// require_once 'key.key.php';



	// var_dump( $_COOKIE['cth_geolocation'] );

	//Set cth cookie
	if (!isset($_COOKIE['cth_geolocation'])) {
		// Create a new instance
		$ipInfo = new ipInfo('dcd25ab720ab60e4172ebaaa884bfd1e8ad36e57096898ba79de2cff7e11fc31', 'json');

		$userIP = $ipInfo->getIPAddress();

		// var_dump($userIP);

		// $result = $ipInfo->getCountry($userIP);
		$result = $ipInfo->getCity('42.114.94.34');

		// var_dump($ipInfo->getCity($userIP));
		// var_dump($result);

		$result = json_decode($result, true);

		// var_dump($json);

		if ($result !== null && $result['statusCode'] === 'OK') {
			$data = base64_encode(serialize($result));
			// $data = base64_encode($result);
			setcookie('cth_geolocation', $data, time() + 3600 * 24 * 7); // Set cookie for 1 week

			// var_dump($data);
			
			// add_action( 'init', function($data){ var_dump($data); setcookie('cth_geolocation', $data, time() + 3600 * 24 * 7);  } );

		}



		// $result = $ipinfodb->getCountry($_SERVER['REMOTE_ADDR']);

		// if ($result['statusCode'] == 'OK') {
		// 	$data = base64_encode(serialize($result));
		// 	setcookie('cth_geolocation', $data, time() + 3600 * 24 * 7); // Set cookie for 1 week
		// }
	} else {
		$result = unserialize(base64_decode($_COOKIE['cth_geolocation']));
		// $result = base64_decode($_COOKIE['cth_geolocation']);

		// var_dump($result);
	}

	wp_localize_script( 'easybook-addons', '_easybook_add_ons_geolocation', $result );

} );

*/


function easybook_addons_set_geolocation(){

	// var_dump( $_COOKIE['cth_geolocation'] );

	//Set cth cookie
	if (!isset($_COOKIE['cth_geolocation'])) {
		// Create a new instance
		$ipInfo = new ipInfo('dcd25ab720ab60e4172ebaaa884bfd1e8ad36e57096898ba79de2cff7e11fc31', 'json');

		$userIP = $ipInfo->getIPAddress();

		// var_dump($userIP);

		// $result = $ipInfo->getCountry($userIP);
		$result = $ipInfo->getCity('42.114.94.34');

		// var_dump($ipInfo->getCity($userIP));
		// var_dump($result);

		$result = json_decode($result, true);

		// var_dump($json);

		if ($result !== null && $result['statusCode'] === 'OK') {
			$data = base64_encode(serialize($result));
			// $data = base64_encode($result);
			setcookie('cth_geolocation', $data, time() + 3600 * 24 * 7); // Set cookie for 1 week

			// var_dump($data);
			
			// add_action( 'init', function($data){ var_dump($data); setcookie('cth_geolocation', $data, time() + 3600 * 24 * 7);  } );

		}



		// $result = $ipinfodb->getCountry($_SERVER['REMOTE_ADDR']);

		// if ($result['statusCode'] == 'OK') {
		// 	$data = base64_encode(serialize($result));
		// 	setcookie('cth_geolocation', $data, time() + 3600 * 24 * 7); // Set cookie for 1 week
		// }
	} else {
		$result = unserialize(base64_decode($_COOKIE['cth_geolocation']));
		// $result = base64_decode($_COOKIE['cth_geolocation']);

		// var_dump($result);
	}

	// var_dump($result);

	add_action( 'wp_enqueue_scripts', function() use ($result){

		// var_dump($result);

		wp_localize_script( 'easybook-addons', '_easybook_add_ons_geolocation', $result );

	} );
}
add_action( 'init', 'easybook_addons_set_geolocation' );








// // Enable full error reporting
// // error_reporting(-1);

// // Include the class
// require_once 'ipinfo.inc.php';

// // Get the API key, you could set this anywhere..
// // require_once 'key.key.php';



// // var_dump( $_COOKIE['cth_geolocation'] );

// //Set cth cookie
// if (!isset($_COOKIE['cth_geolocation'])) {
// 	// Create a new instance
// 	$ipInfo = new ipInfo('dcd25ab720ab60e4172ebaaa884bfd1e8ad36e57096898ba79de2cff7e11fc31', 'json');

// 	$userIP = $ipInfo->getIPAddress();

// 	// var_dump($userIP);

// 	// $result = $ipInfo->getCountry($userIP);
// 	$result = $ipInfo->getCity('42.114.94.34');

// 	// var_dump($ipInfo->getCity($userIP));
// 	// var_dump($result);

// 	$json = json_decode($result, true);

// 	// var_dump($json);

// 	if ($json !== null && $json['statusCode'] === 'OK') {
// 		$data = base64_encode(serialize($result));
// 		// $data = base64_encode($result);
// 		// setcookie('cth_geolocation', $data, time() + 3600 * 24 * 7); // Set cookie for 1 week

// 		var_dump($data);
		
// 		add_action( 'init', function($data){ var_dump($data); setcookie('cth_geolocation', $data, time() + 3600 * 24 * 7);  } );

// 	}



// 	// $result = $ipinfodb->getCountry($_SERVER['REMOTE_ADDR']);

// 	// if ($result['statusCode'] == 'OK') {
// 	// 	$data = base64_encode(serialize($result));
// 	// 	setcookie('cth_geolocation', $data, time() + 3600 * 24 * 7); // Set cookie for 1 week
// 	// }
// } else {
// 	$result = unserialize(base64_decode($_COOKIE['cth_geolocation']));
// 	// $result = base64_decode($_COOKIE['cth_geolocation']);

// 	// var_dump($result);
// }

// // var_dump($result);

// add_action( 'wp_enqueue_scripts', function($result){

// 	var_dump($result);

// 	wp_localize_script( 'easybook-addons', '_easybook_add_ons_geolocation', $result );

// } );

// function easybook_addons_set_user_cookie() {

//     setcookie('cth_geolocation', $data, time() + 3600 * 24 * 7); // Set cookie for 1 week
// }
// add_action( 'init', 'easybook_addons_set_user_cookie');
