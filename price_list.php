<?php
require_once("config.php");
if (isset($_COOKIE[$x_token])){
    require_once("_helper/helper.php");
    require_once("_helper/user_login.php");
}
if (isset($_POST['act'])) {
    $act = $_POST['act'];
    if ($act == "load_data") {
        $operator_id = abs((int) $_POST['operator_id']);
        $data = array(
            'id_operator' => $operator_id,
            "sort" => "asc"
        );
        $res = $app->curl_post_json("$api_url/produk/list-by-operator", $data);
        $res_api = json_decode($res, true);
        if (isset($res_api['status'])) {
            $status = $res_api['status'];
            if ($status == 1) {
                $data = $res_api['data'];
                $out = array(
                    'status' => 1,
                    'message' => "List produk",
                    'data' => $data
                );
            } else {
                $out = array(
                    'status' => 0,
                    'error_msg' => $res_api['error_msg']
                );
            }
        } else {
            $out = array(
                'status' => 0,
                'error_msg' => "Gagal mendapatkan produk"
            );
        }
        echo json_encode($out);
        exit;
    }
}

$data_op = $app->grab_data("$api_url/operator/list");
$data_op_res = json_decode($data_op, true);

$file_me = "daftar/harga";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("_/head.php");
    ?>
    <title>Price List - <?php echo $c_brand ?></title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

</head>

<body class="mbg-primary min-h-screen flex flex-col">
    <div class="flex flex-col justify-between h-full">
        <div>
            <?php require_once("_/header.php")
            ?>
            <div class=" sm:pt-[160px] pt-[70px]">
                <div class="container-xxl flex flex-col gap-8">
                    <div class="m-shadow p-8 text-white text-left w-full m-auto overflow-y-scroll max-h-fit">
                        <h2 class="font-semibold text-xl mb-20">Daftar harga</h2>
                        <div class="flex flex-row justify-between w-full">
                            <div></div>
                            <div>
                                <select name="operator" id="operator" class="form-input text-black font-semibold">
                                    <option value="0">-- Pilih Operator --</option>
                                    <?php
                                    if (isset($data_op_res['status'])) {
                                        if ($data_op_res['status'] == 1) {
                                            $data = $data_op_res['data'];
                                            foreach ($data as $row) {
                                    ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>

                                    <?php
                                            }
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4 h-full">
                            <table id="example" class="table table-striped text-white  responsive " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("_/general.php") ?>
    <div class="h-[20px]"></div>
    <div class="mt-auto">
    <!-- <div class="fixed inset-x-0 bottom-0"> -->
    <?php //require_once("_/footer.php") ?>
    </div>
    <script src="<?php echo $c_url ?>/assets/app.js?v=<?php echo time() ?>"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var table = $('#example').DataTable({
            lengthMenu: [10, 25, 50, 80, 100],
            order: [
                [0, 'asc']
            ],
            createdRow: function(row, data, dataIndex) {
                if (data[0] == '0') {
                    $('td:eq(0)', row).attr('colspan', 8);
                    $('td:eq(1)', row).css('display', 'none');
                    $('td:eq(2)', row).css('display', 'none');
                    $('td:eq(3)', row).css('display', 'none');
                    this.api().cell($('td:eq(0)', row)).data(data[1]);
                }
            }
        });
        var opertor = $("#operator")

        $(opertor).on('change', function() {
            var operator_id = opertor.val()
            if (operator_id == 0) {

            } else {
            }
            load_data()
        });

        load_data()

        async function load_data() {
            table.clear().draw()
            table.row.add(['<div class="spinner-border loading_spin spinner-border-sm text-primary" role="status" bis_skin_checked="1"> <span class="visually-hidden"></span></div>', "", "", ""]).draw(false)
            try {
                var res = await curl_post('<?php echo $file_me ?>', {
                    act: "load_data",
                    operator_id: opertor.val()
                })
                table.clear().draw()
                console.log(res)
                if (res.status == 1) {
                    var len = res.data.length;
                    var data = res.data;
                    data_list = data;
                    var no = 1
                    for (var i = 0; i < len; i++) {
                        var id = data[i].id
                        var name = data[i].name
                        var price = data[i].price
                        var price_add = data[i].price_add
                        var total = price + price_add
                        var status = data[i].status
                        console.log(name, price, price_add)
                        table.row.add([no,name,formatRupiah(total.toString(), "Rp, "),status_produk(status)]).draw(false);
                        no++
                    }
                } else {
                    table.clear().draw()
                    table.row.add([res.status, res.error_msg, "-", "-"]).draw(false);
                }
            } catch (error) {
                // console.log(error)
                table.clear().draw()
                table.row.add([0, error.responseText, "-", "-"]).draw(false);
            }
        }
    </script>
</body>

</html>