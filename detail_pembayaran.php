<?php
require_once("config.php");
include "library/phpqrcode/qrlib.php";

if (!isset($_GET['trx_id'])) {
    echo "need trx id";
    exit;
}
$trx_id = $_GET['trx_id'];
$fetch_trx = $app->grab_data("$api_url/trx/detail/$trx_id");
$data_trx = json_decode($fetch_trx, true);
// var_dump($data_trx);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("_/head.php");
    ?>
    <title>Order #<?php echo $trx_id ?></title>
</head>

<body class="mbg-primary">
    <div class="flex flex-col justify-between h-full">
        <div>
            <?php require_once("_/header.php") ?>
            <div class=" sm:pt-[160px] pt-[70px]">
                <div class="container-xxl flex flex-col gap-8">
                    <div class="m-shadow p-8 text-white text-center ">
                        <div class="md:w-[50%] w-full m-auto">
                            <?php
                            if (isset($data_trx['status'])) {
                                if ($data_trx['status'] == 1) {
                                    $data = $data_trx['data'];
                                    $id_trx = $data['id'];
                                    $status_pay = $data['status_pembayaran'];
                            ?>
                                    <table class="table-auto w-full">
                                        <tbody class="divide-y divide-gray-300 align-center">
                                            <tr class="items-center">
                                                <td class="px-6 py-4 text-[13px] font-semibold" colspan="2">Detail pembayaran</td>
                                            </tr>
                                            <tr class="group">
                                                <td class="item-table text-right ">
                                                    Tagihan ID :
                                                </td>
                                                <td class="item-table text-left">
                                                    <div class="text-sm " onclick="copy_text('<?php echo $trx_id ?>')">
                                                        #<?php echo $trx_id ?>&nbsp; <i class="fa-solid fa-copy text-white"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="group">
                                                <td class="item-table text-right">
                                                    Tujuan :
                                                </td>
                                                <td class="item-table text-left">
                                                    <div class="text-sm ">
                                                        <?php echo $data['tujuan'] ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="group">
                                                <td class="item-table text-right">
                                                    Produk :
                                                </td>
                                                <td class="item-table text-left">
                                                    <div class="text-sm ">
                                                        <?php echo $data['operator_name'] ?>

                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="group">
                                                <td class="item-table text-right">
                                                    Item :
                                                </td>
                                                <td class="item-table text-left">
                                                    <div class="text-sm ">
                                                        <?php echo $data['produk_name'] ?>

                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="group">
                                                <td class="item-table text-right">
                                                    Metode pembayaran :
                                                </td>
                                                <td class="item-table text-left">
                                                    <div class="text-sm ">
                                                        <?php echo $data['metode_topup_name'] ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="group">
                                                <td class="item-table text-right">
                                                   Total bayar :
                                                </td>
                                                <td class="item-table text-left">
                                                    <div class="text-sm ">
                                                        <?php echo $app->idr($data['price_sell']) ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="group">
                                                <td class="item-table text-right">
                                                    Status pembayaran :
                                                </td>
                                                <td class="item-table text-left">
                                                    <div class="text-sm ">
                                                        <?php echo $data['status_pembayaran'] ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="group">
                                                <td class="item-table text-right">
                                                    Status Transaksi :
                                                </td>
                                                <td class="item-table text-left">
                                                    <div class="text-sm ">
                                                    <?php echo $data['status'] ?>

                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="group">
                                                <td class="item-table text-right">
                                                    SN :
                                                </td>
                                                <td class="item-table text-left">
                                                    <div class="text-sm ">
                                                    <?php echo $data['sn'] ?>

                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php
                                } else {
                                    $msg = $data_trx['error_msg'];
                                ?>
                                    <h2 class="text-white"><?php echo $msg ?></h2>
                            <?php
                                }
                            }
                            if (isset($id_trx, $status_pay)){
                                //grab payment
                                if ($status_pay == "Pending"){
                                    $grab_pay = $app->grab_data("$api_url/trx/get-payment/$trx_id");
                                    $data_pay = json_decode($grab_pay, true);
                                    // var_dump($data_pay);
                                    if (isset($data_pay['status'])){
                                        if ($data_pay['status']==1){
                                            $data = $data_pay['data'];
                                            $tipe = $data['tipe'];
                                            $link = $data['link'];
                                            $va = $data['va'];
                                            $qr = $data['qr'];
                                            if ($tipe == "qr"){
                                                //QRcode::png($qr);
                                                ?>
                                                <div class="flex mt-20 flex-col gap-4 items-center">
                                                <img src="<?php echo "$c_url/qr.php?qr=$qr" ?>" alt="">
                                                <h2 class="text-white">Silahkan scan QR ini</h2>
                                                <?php
                                                    if ($link != ""){
                                                        echo '<a target="_blank" class="px-4 py-2 bg-sky-600 text-white font-semibold rounded-lg" href="'.$link.'">Petunjuk Scan Qr</a>';
                                                    }
                                                ?>
                                                </div>
                                                <?php
                                            }else if ($tipe == "link"){
                                                ?>
                                                    <div class="flex mt-2 flex-col gap-4 items-center">
                                                     <a target="_blank" class="px-4 py-2 mt-20 bg-sky-600 text-white font-semibold rounded-lg" href="<?php echo $link ?>">Bayar</a>
                                                    </div>
                                                <?php
                                            }else if ($tipe == "va"){
                                                // echo '<div  class="px-4 py-2 mt-20 bg-sky-600 text-white font-semibold rounded-lg" href="">'.$va.'</div>';
                                                ?>
                                                    <div class="flex mt-2 flex-col gap-4 items-center">
                                                        <div>
                                                            <div target="_blank" class="px-4 py-2 mt-20 bg-sky-600 text-white font-semibold rounded-lg"><?php echo $va ?></div>
                                                        <small>Kode Virtual Account</small>
                                                        </div>
                                                        <a target="_blank" class="px-4 py-2 mt-2 bg-sky-600 text-white font-semibold rounded-lg" href="<?php echo $link ?>">Petunjuk Pembayaran</a>
                                                    </div>
                                                <?php
                                            }else{
                                                ?>
                                                <h2 class="text-white mt-20">Tipe pembayaran belum di dukung !!</h2>
                                            <?php
                                            }
                                        }else{
                                            $msg = $data_pay['error_msg'];
                                            ?>
                                                <h2 class="text-white mt-20"><?php echo $msg ?></h2>
                                            <?php
                                        }
                                    }else{
                                        $msg = "Gagal menghubungi payment gateway";
                                        ?>
                                        <h2 class="text-white mt-20"><?php echo $msg ?></h2>
                                    <?php
                                    }
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-[100px]"></div>
        <?php require_once("_/footer.php") ?>
        <?php require_once("_/general.php") ?>
    </div>

    <script src="<?php echo $c_url ?>/assets/app.js?v=<?php echo rand() ?>"></script>


</body>