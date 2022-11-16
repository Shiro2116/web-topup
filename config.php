<?php
session_start();
$api_url = "http://127.0.0.1:9001/v1";
$c_desc = "Top up Game &amp; Voucher termurah, aman, dan terpercaya. legal 100% open 24 Jam dengan metode pembayaran terlengkap Indonesia";
$c_brand = "Kipling Store";
$c_desc_simple = "$c_brand - Top Up Game Termurah Buka 24 Jam";
require_once("core/app.class.php");
$app = new App();
$c_url = "http://192.168.43.2:8082";
$kontak = "https://api.whatsapp.com/send/?phone=6283187188999&text=Halo kak $c_brand&type=phone_number&app_absent=0";
$captcha_secret = "6LcARcUiAAAAADO7kiuEgqCIJ4nhZF8_C4rHUj_P";
$captcha_site_key = "6LcARcUiAAAAAEHie3viJXshh1VId9dvGJfbYAkg";
$x_token = "x-token";
define("KATEGORI_SALDO", "3");