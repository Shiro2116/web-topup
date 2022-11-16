<?php
require_once("config.php");
$url = "$api_url/operator/list/full";
$operator = $app->grab_data($url);
$data_op = json_decode($operator, true);
$banner = $app->grab_data("$api_url/banner/list");
$data_banner = json_decode($banner, true);

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
    <title><?php echo $c_desc_simple ?></title>
</head>

<body class="mbg-primary">
    <div class="flex flex-col justify-between h-full">
        <div>
            <?php require_once("_/header.php") ?>
            <div class=" sm:pt-[120px] pt-[70px]">
                <!-- banner  -->
                <div class="container-xxl  max-h-[450px] ">
                    <div class="row hidden">
                        <div class="col w-full">
                            <img class="h-full min-w-full h-[90%] sm:h-full object-cover" src="https://bangjeff.com/assets/img/banner-bangjeff.webp" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <?php
                            $is_banner = false;
                            if (isset($data_banner['status'])){
                                if ($data_banner['status']==1){
                                    $data = $data_banner['data'];
                                    $is_banner = true;
                                }
                            }
                        ?>
                        <div class="col <?php echo $is_banner ? 'flex' : 'hidden' ?>">
                            <div id="carouselExampleCrossfade" class="carousel slide carousel-fade relative w-full" data-bs-ride="carousel">
                                <!-- <div class="carousel-indicators absolute right-0 bottom-0 left-0 flex justify-center p-0 mb-4">
                                    <button type="button" data-bs-target="#carouselExampleCrossfade" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleCrossfade" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleCrossfade" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div> -->
                                <div class="carousel-inner relative w-full overflow-hidden">
                                    <?php
                                        if ($is_banner){
                                            $no=1;
                                            foreach ($data as $row){
                                                ?>
                                                 <div class="carousel-item <?php echo $no == 1 ? 'active' : 'hidden' ?> float-left w-full">
                                                    <img src="<?php echo $row['image'] ?>" class="block w-full" alt="" />
                                                </div>
                                                <?php
                                                $no++;
                                            }
                                        }
                                    ?>
                                </div>
                                <button class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0" type="button" data-bs-target="#carouselExampleCrossfade" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0" type="button" data-bs-target="#carouselExampleCrossfade" data-bs-slide="next">
                                    <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end banner  -->

                <!-- produk  -->
                <div class="container-xxl sm:mt-[80px] mt-[20px]">
                    <div class="row">
                        <div class="col">
                            <?php
                            if (isset($data_op['status'])) {
                                $data = $data_op['data'];
                                if ($data_op['status'] == 1) {
                                    foreach ($data as $row) {
                                        $kategori = $row['kategori'];
                                        $op_list = $row['operator'];
                            ?>
                                        <div class="mb-[40px]">
                                            <h1 class="text-white sm:text-[20px] text-[14px] font-bold "><?php echo $kategori['name'] ?></h1>
                                            <div class="w-full sm:mt-8 m-2">
                                                <div class="grid grid-cols-3 md:grid-cols-6 gap-4">
                                                    <?php
                                                    if (is_array($op_list) && count($op_list) > 0) {
                                                        foreach ($op_list as $row_list) {
                                                    ?>
                                                            <div class="col col-md-2 mb-2 sm:p-4 p-2 w-full">
                                                                <div class="animate-scale  bg-transparent border-0 h-100 text-center" bis_skin_checked="1">
                                                                    <a href="/topup/<?php echo $row_list['slug'] ?>">
                                                                        <img src="<?php echo $row_list['image'] ?>" class="rounded-[30%]">
                                                                    </a>
                                                                    <h1 class="text-white text-[12px] sm:text-[14px] pt-2 leading-5 sm:font-semibold font-normal text-center transition delay-150 duration-300 ease-in-out mt-[5px]"><?php echo $row_list['name'] ?></h1>
                                                                </div>
                                                            </div>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                } else {
                                    $msg = $data_op['error_msg'];
                                    ?>
                                    <div class="p-6 bg-red-100 text-white">
                                        <?php echo $msg; ?>
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <div class="p-6  text-white">
                                    <?php echo "Server down !!"; ?>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <!-- end produk  -->
            </div>
        </div>
        <div class="h-[40px]"></div>
        <?php require_once("_/general.php") ?>
        <?php require_once("_/footer.php") ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?php echo $c_url ?>/assets/app.js"></script>
    <script>
        // grab everything we need
    </script>
</body>

</html>