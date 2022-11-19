<?php
require_once("config.php");
if (isset($_COOKIE[$x_token])){
    require_once("_helper/helper.php");
    require_once("_helper/user_login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("_/head.php");
    ?>
    <title>Cek Transaksi</title>
</head>

<body class="mbg-primary">
    <div class="flex flex-col justify-between h-full">
        <div>
            <?php require_once("_/header.php") ?>
            <div class=" sm:pt-[160px] pt-[70px]">
                <div class="container-xxl flex flex-col gap-8">
                    <div class="m-shadow p-8 text-white text-center md:w-[40%] w-full m-auto">
                        <div class="">
                            <div class="w-full flex flex-col items-start">
                                <label for="" class="text-white">Nomor Invoice</label>
                                <input type="text" id="trx_id" placeholder="Nomor Invoice" class="form-input text-slate-800">
                                <button onclick="cek()"  class="px-4 py-2 mt-2 bg-sky-600 text-white font-semibold rounded-lg">Cek Invoice</button>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-[100px]"></div>
        <?php require_once("_/footer.php") ?>
    </div>

    <script src="<?php echo $c_url ?>/assets/app.js?v=<?php echo rand() ?>"></script>
    <script>
        var trx_id = $("#trx_id")
        function cek(){
            window.location.replace("/order/"+trx_id.val());
        }
    </script>
</body>