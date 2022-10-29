<?php
include "library/phpqrcode/qrlib.php";
if (!isset($_GET['qr'])){
    exit;
}
$qr = $_GET['qr'];
QRcode::png($qr);