
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Voucher Class
 *
 * @package     Edusol
 * @subpackage  Fee
 * @author      Sabeeh Murtaza
 * @link        http://facebook.com/sabeehking
 */

class api_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }




function send_notification($tokens, $message){
	$url = 'http://fcm.googleapis.com/fcm/send';

	$fields = array(
		'registration_ids' => $tokens,
		'data' => $message
		);

	$headers = array(
		'Authorization:key = AIzaSyBm4J7iY6_4BsIDfEt77srY0U6NwmJYtdM',
		'Content-Type: application/json');

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

	$result = curl_exec($ch);
        if($result === FALSE){
		die('Curl Failed' . curl_error($ch));
	}
	curl_close($ch);

	return $result;

}

}
