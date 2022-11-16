<?php
require_once("config.php");
if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cek_email = $app->regex_email($email);
    if ($cek_email) {
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $data_post = array(
            'email' => $email,
            'password' => $pass,
            "ua" => $ua
        );
        $res = $app->curl_post_json("$api_url/user/login", $data_post);
        $res_json = json_decode($res, true);
        if (isset($res_json['status'])) {
            $status = $res_json['status'];
            if ($status == 1) {
                $data = $res_json['data'];
                $token = $data['token'];
                $cookie_name = $x_token;
                setcookie($cookie_name, $token, time() + (86400 * (30 * 12)), "/");
                header("Location: /user/home");
            } else {
                $alert = true;
                $alert_msg = $res_json['error_msg'];
            }
        } else {
            $alert = true;
            $alert_msg = "Gagal menghubungi API";
        }
    } else {
        $alert = true;
        $alert_msg = "Email tidak valid !!";
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("_/head.php");
    ?>
    <title>Login - <?php echo $c_brand ?></title>
</head>

<body class="mbg-primary">
    <div class="flex flex-col justify-between h-full">
        <div>
            <?php require_once("_/header.php")
            ?>
            <div class="w-full md:mt-[200px] mt-[100px]">
                <div class="mt-[100px]"></div>
                <?php
                if (isset($_SESSION['msg']) or isset($alert)) {
                    if (isset($_SESSION['msg'])) {
                        $msg = $_SESSION['msg'];
                    }
                    if (isset($alert)) {
                        $msg = $alert_msg;
                    }
                ?>
                    <div class="md:w-[500px] w-full md:mx-auto p-6 rounded text-red-200 bg-red-500"><?php echo $msg ?></div>
                <?php
                    unset($_SESSION['msg']);
                }
                ?>
                <form method="POST">
                    <div class="md:w-[500px] w-full m-shadow md:px-12 px-6 py-12 rounded-lg mx-auto mt-10 mb-10 flex flex-col gap-4">
                        <div class="w-full ">
                            <label for="email" class="text-white">Email</label>
                            <input type="text" id="email" name="email" placeholder="Email" class="form-input">
                        </div>
                        <div class="w-full ">
                            <label for="password" class="text-white">Password</label>
                            <input type="password" id="password" name="password" placeholder="" class="form-input">
                            <!-- <div class="relative">
                                <input placeholder="" :type="show ? 'password' : 'text'" class="form-input">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">

                                    <p>a</p>

                                </div>
                            </div> -->
                        </div>
                        <button class="btn-me" type="submit">Login</button>
                    </div>
                </form>

                <div class="md:w-[500px] w-full flex flex-col mx-auto my-2 justify-center items-center gap gap-4">
                    <p class="text-white">Belum punya akun ? <a href="/user/register" class="color-fifth">Daftar sekarang</a></p>
                    <p class="text-white">&copy; 2022 <?php echo $c_brand ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("_/general.php") ?>
    <script src="<?php echo $c_url ?>/assets/app.js"></script>
</body>

</html>