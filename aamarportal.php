<?php



function aamarportal_config() {

    $configarray = array(

     "FriendlyName" => array("Type" => "System", "Value"=>"AamarPortal"),

     "username" => array("FriendlyName" => "Merchant ID", "Type" => "text", "Size" => "20", ),

     "transmethod" => array("FriendlyName" => "Signature Key", "Type" => "text", "Size" => "30", ),

     "additional_per_fee" => array("FriendlyName" => "Additional Service Charge %", "Type" => "text", "Size" => "30", "Description" => "<br>If You Want to add Additional Service Charge Then Enter The Ratio in Integer Format. Like for 3% input value will be 3 and For No Additional Charge input Value 0", ),

     "additional_fixed_fee" => array("FriendlyName" => "Additional Service Charge", "Type" => "text", "Size" => "30", "Description" => "<br>If You Want to add Additional Service Charge Then Enter The Fixed Amount in Integer Format. Like for 20. and For No Additional Charge input Value 0", ),

     "testmode" => array("FriendlyName" => "Test Mode", "Type" => "yesno", "Description" => "Tick this to Run on test MODE", ),

    );

	return $configarray;

}





function aamarportal_link($params) {







	# Gateway Specific Variables



	$gatewayusername = $params['username'];



	$gatewaytransmethod = $params['transmethod'];





	# Invoice Variables



	$invoiceid = $params['invoiceid'];



	$description = $params["description"];



    $amount = $params['amount']; # Format: ##.##



    $currency = $params['currency']; # Currency Code





# Additional Charge Calculation



$additional_per_fee= $params['additional_per_fee'];

$additional_fixed_fee= $params['additional_fixed_fee'];



$additonal_service = ($amount*$additional_per_fee)/100;

$total_amount = $amount+$additonal_service;

	# Client Variables



	$firstname = $params['clientdetails']['firstname'];



	$lastname = $params['clientdetails']['lastname'];



	$email = $params['clientdetails']['email'];



	$address1 = $params['clientdetails']['address1'];



	$address2 = $params['clientdetails']['address2'];



	$city = $params['clientdetails']['city'];



	$state = $params['clientdetails']['state'];



	$postcode = $params['clientdetails']['postcode'];



	$country = $params['clientdetails']['country'];



	$phone = $params['clientdetails']['phonenumber'];







	# System Variables



	$companyname = $params['companyname'];



	$systemurl = $params['systemurl'];



	$currency = $params['currency'];

        $basecurrencyamount = $params['basecurrencyamount'];

        $basecurrency = $params['basecurrency'];
    
// var_dump($currency);
// echo $basecurrency;
// die();
//echo '<pre>';

//print_r($params);

//echo '</pre>';



	# Enter your code submit to the gateway...





	$cus_name = $firstname.' '.$lastname;

	$success_url  = $params['systemurl'].'modules/gateways/callback/aamarportal.php';

	$failed_url  = $params['systemurl'].'modules/gateways/callback/aamarportal.php';

	$cancel_url  =  $params['systemurl'].'/viewinvoice.php?id='.$invoiceid;
    // var_dump($cancel_url);
    // die();


// add this line by ashikur rahaman


$webaddr = "https://merchant.aamarportal.com/getdata";

//close connection



$code .= '<form action="'.$webaddr.'" method="post">';

$code .='<input type="hidden" name="merchant_id" value="'.$gatewayusername.'">';
//$code .='<input type="hidden" name="store_id" value="aamarportal">';


$code .='<input type="hidden" name="m_tranid" value="'.$invoiceid.'">';

$code .='<input type="hidden" name="amount" value="'.$total_amount.'" >';

$code .='<input type="hidden" name="s_url"  value="'.$success_url.'" >';

$code .= '<input type="hidden" name="f_url" value="'.$success_url.'" >';

$code .= '<input type="hidden" name="c_url" value="'.$cancel_url.'" >';

$code .='<input type="hidden" name="currency" value="'.$currency.'" >';
$code .='<input type="hidden" name="cus_name" value="'.$firstname.' '.$lastname.'">';

$code .='<input type="hidden" name="cus_add1" value="'.$address1.'" >';

$code .= '<input type="hidden" name="cus_add2" value="'.$address2.'" >';

$code .= '<input type="hidden" name="cus_city" value="'.$city.'" >';

$code .= '<input type="hidden" name="cus_state" value="'.$state.'">';

$code .= '<input type="hidden" name="cus_postcode" value="'.$postcode.'">';



$code .= '<input type="hidden" name="cus_country" value="'.$country.'">';

$code .= '<input type="hidden" name="cus_phone" value="'.$phone.'" >';

$code .= '<input type="hidden" name="cus_email" value="'.$email.'" >';

$code .= '<input type="hidden" name="ship_name" value="'.$companyname.'" >';

$code .= '<input type="hidden" name="ship_add1" value="'.$systemurl.'" >';

$code .='<input type="hidden" name="signature_key" value="'.$gatewaytransmethod.'">';
// $code .='<input type="hidden" name="signature_key" value="28c78bb1f45112f5d40b956fe104645a">';

$code .= '<input type="hidden" name="opt_a" value="'.$amount.'">'; 

$code .= '<input type="hidden" name="opt_b" value="'.$currency.'">';

$code .= '<input type="hidden" name="desc" value="'.$description.'">';	

$code .= '<input type="submit" class="btn btn-success" value="Pay Now" />



</form>';







	return $code;



}















?>