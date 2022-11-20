<?php
//need config
define("X_TOKEN",$x_token);
define("API_URL",$api_url);

function get_user($app){
    $x_token = $_COOKIE[X_TOKEN];
    $url = API_URL."/user/";
    $res = $app->grab_data_auth($url,$x_token);
    return $res;
}

function my_token(){
    $x_token = $_COOKIE[X_TOKEN];
    $x_token = "I5Pqp4Gsxhn_TT1bhmFZN7QQGwJpKHbWrOE8uy3khV25e9MfeGL30TnAKOsh5pg7r5LDyzD7i5T98MrFbSwajcK3LkDR3x6hK7qzVSPnomrNuIjsOLJy_7312uD6UxNCCVzklKL2ElwuqfXzrg4u92Yk7bBEScPniqStJ6xWIvVdLgiSerUSEEk2WAMM7jLpMdE3kf2LGQs2aBKKQesgnwm2phPBrpO2ulR3uYXpxF_8FjkjAo59yB0PN3Rt9oyACHgcVKihh80Z_lvXKcNsmqU";
    return $x_token;
}