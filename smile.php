<?php
date_default_timezone_set('America/Sao_Paulo');
$uid = "1041302";
$email = "agent@smileone.com";
$product = "mobilelegends";
$time = time();
$url = "https://frontsmie.smile.one";
$path = "/smilecoin/api/createorder";

$data = [
    "uid" => $uid,
    "email" => $email,
    "time" => $time,
    "userid" => 17366,
    "zoneid"=> 22001,
    "product" => $product,
    "productid" => 13,
];

$m_key = "7f663422060edd50b326b8a570639dac";
ksort($data);
$str = '';


foreach ($data as $k => $v) {
    $str.=$k.'='.$v.'&';
}

$str = $str.$m_key;
$sign = md5(md5($str));
$data['sign'] = $sign;

$fields = "";
foreach ($data as $key => $value) {
    $fields .= $key . '=' . $value . '&';
}

// echo json_encode($fields);
// echo $fields;

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $url.$path,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $fields,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/x-www-form-urlencoded'
    ),
));

$response = curl_exec($curl);
curl_close($curl);
echo $response;
