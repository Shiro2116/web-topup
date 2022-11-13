<?php
require_once("config.php");
require_once("_helper/user.php");
$res_user = get_user($app);
$res_user_json = json_decode($res_user, true);
if (isset($res_user_json['status'])) {
    $status = $res_user_json['status'];
    if ($status == 1) {
        $rc = $res_user_json['rc'];
        if ($rc == "401") {
            $msg = $res_user_json['message'];
            $_SESSION['msg'] = $msg;
            header("Location: /user/login?c=1");
            exit;
        } else {
            $data_user = $res_user_json['data'];
        }
    } else {
        $msg = $res_user_json['error_msg'];
        $_SESSION['msg'] = $msg;
        header("Location: /user/login?c=1");
        exit;
    }
} else {
    $_SESSION['msg'] = "Gagal mendapatkan data user. Silahkan login kembali";
    header("Location: /user/login?c=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("_/head.php");
    ?>
    <title>Transaksi - <?php echo $c_brand ?></title>
</head>

<body class="mbg-primary">
    <div class="flex flex-col justify-between h-full">
        <div>
            <?php require_once("_/header.php")
            ?>
            <div class="w-full mt-[200px] container-xxl ">
                <div class="w-full flex md:flex-row flex-col gap-8 ">
                    <?php require_once("_home/user.php") ?>
                    <div class="w-full ">
                        <div class="h-max">
                            <div class="flex flex-row gap gap-4">
                                <?php
                                $path = "Transaksi";
                                require_once("_home/menu.php");
                                ?>
                            </div>
                            <div class="mt-4">
                                <div class="text-lg text-gray-300 p-4 rounded-lg bg-fifth text-sky-100">Selamat datang di <?php echo $c_brand ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once("_/general.php") ?>

    <script src="<?php echo $c_url ?>/assets/app.js"></script>
</body>

</html>