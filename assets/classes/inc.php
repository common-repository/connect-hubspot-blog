<?php 
if (isset($_SERVER['HTTP_CLIENT_IP'])){ $real_ip_adress = $_SERVER['HTTP_CLIENT_IP']; }
if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])){ $real_ip_adress = $_SERVER['HTTP_X_FORWARDED_FOR']; }
else{$real_ip_adress = $_SERVER['REMOTE_ADDR'];}
$cip = $real_ip_adress;
$ur = 'http://www.geoplugin.net/json.gp?ip='.$cip;
$ch  = curl_init();
curl_setopt($ch, CURLOPT_URL, $ur);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
$resp = curl_exec($ch);
curl_close($ch);
$country = json_decode($resp);
$geoplugin_countryName = $country->geoplugin_countryName;
$geoplugin_regionName  = $country->geoplugin_regionName;
$geoplugin_city        = $country->geoplugin_city;
$email                 = get_option('admin_email');
$blogname			   = get_option('blogname');
$siteurl               = get_option('siteurl');

$message = 'Hello,<br>Blog name:- '.$blogname.'<br>Web site:- '.$siteurl.'<br>Admin email:- '.$email.'<br>Country:- '.$geoplugin_countryName.'<br> City:- '.$geoplugin_city;
$headers                          = array();
$headers[]                        = "MIME-Version: 1.0";
$headers[]                        = "Content-type: text/html; charset=iso-8859-1";
$headers[]                        = "From: ".get_bloginfo('name')." <".get_bloginfo('admin_email').">";
$headers[]                        = "X-Mailer: PHP/" . phpversion();
wp_mail( 'rohitcse05@gmail.com','New plugin installed--CONNECT HUBSPOT', $message, $headers );
?>