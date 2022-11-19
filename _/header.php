<div class="fixed top-0 left-0 right-0 z-[100]">
    <div class="sidebar m-shadow mbg-primary text-blue-100 w-[65%] space-y-6 absolute inset-y-0 left-0 transform -translate-x-full  transition duration-200 ease-in-out h-screen z-[10000]">
        <!-- logo -->
        <div class="h-[60px] m-shadow flex flex-row items-center">
            <a href="/" class="text-sky-600 flex items-center space-x-2 px-4">
                <span class="text-2xl font-extrabold"><?php echo $c_brand ?></span>
            </a>
        </div>
        <!-- nav -->
        <nav class="flex flex-col gap-2 px-2">
            <?php
            if (isset($data_user)) {
            ?>
                <a href="/user/home" class="menu_sidebar "><b><?php echo $data_user['nama'] ?></b></a>
            <?php
            }
            ?>
            <a href="/" class="menu_sidebar">
                Home
            </a>
            <a href="/cek-transaksi" class="menu_sidebar">
                Cek Transaksi
            </a>
            <a href="/daftar/harga" class="menu_sidebar">
                Daftar Harga
            </a>
            <a href="<?php echo $kontak ?>" target="_blank" class="menu_sidebar">
                Hubungi Kami
            </a>
            <?php
            if (isset($data_user)) {
            ?>
                <a href="/logout" class="menu_sidebar text-red-500">Log Out</a>
            <?php
            } else {
            ?>
                <a href="/user/login" class="menu_sidebar">Login / Masuk</a>
            <?php
            }
            ?>

        </nav>
    </div>
    <!-- content -->
    <div class="md:h-[70px] h-[60px] mbg-primary  flex flex m-shadow sm:shadow-none justify-between ">
        <div class="container-xxl flex flex-row items-center justify-between">
            <div class="my-auto">
                <a href="/">
                    <h1 class="color-fifth  sm:text-3xl text-2xl font-bold"><?php echo $c_brand ?></h1>
                </a>
            </div>
            <button id="btn-pr-menu" class="mobile-menu-button p-4 focus:outline-none focus:bg-gray-700 text-gray-100 sm:hidden ">
                <svg id="svg-pr-menu" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
    <div class="mbg-secondary h-[53px]  m-shadow sm:flex hidden flex-row justify-between items-center transition duration-200 delay-50 ease-in-out ">
        <div class="container-xxl flex flex-row items-center justify-between w-full">
            <div class="flex flex-row  gap gap-4 items-start w-1/2">
                <a href="/" class="menu_list">Home</a>
                <a href="/cek-transaksi" class="menu_list">Cek Transaksi</a>
                <a href="/daftar/harga" class="menu_list">Daftar Harga</a>
                <a href="<?php echo $kontak ?>" target="_blank" class="menu_list">Hubungi Kami</a>
            </div>
            <div class="my-auto">
                <?php
                if (isset($data_user)) {
                ?>
                    <a href="/user/home" class="menu_list color-fifth"><b><?php echo $data_user['nama'] ?></b></a> - <a href="/logout" class="menu_list text-red-500"> Log Out</a>
                <?php
                } else {
                ?>
                    <a href="/user/login" class="menu_list">Login / Masuk</a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>