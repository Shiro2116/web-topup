const btn = document.querySelector(".mobile-menu-button");
const sidebar = document.querySelector(".sidebar");
let isSidebarOpen = false;

// add our event listener for the click
var is_open = false;
btn.addEventListener("click", () => {
  console.log("open");
  is_open = true;
  sidebar.classList.toggle("-translate-x-full");
});

function curl_post(url, data) {
    const result = $.ajax({
        url: url,
        method: "POST",
        dataType: "JSON",
        data: data,
        success: function(res) {},
    });
    return result;
}


// close sidebar if user clicks outside of the sidebar
document.addEventListener("click", (event) => {
//   console.log(event);
  // const isButtonClick = btn === event.target && btn.contains(event.target);
  const isOutsideClick =
    sidebar !== event.target && !sidebar.contains(event.target);

  // bail out if sidebar isnt open
  // if (sidebar.classList.contains("-translate-x-full")) return;

  // if the user clicks the button, then toggle the class
  // if (isButtonClick) {
  //     console.log("does not contain");
  //     sidebar.classList.toggle("-translate-x-full");
  //     return;
  // }
  // console.log(event.target)
  if (isOutsideClick) {
    console.log("outside")
    var tr = event.target;
    if (tr.id != "svg-pr-menu" && tr.id != "btn-pr-menu") {
      if (is_open) {
        sidebar.classList.add("-translate-x-full");
        is_open = false;
      }
    }
    // return;
  }

  // check to see if user clicks outside the sidebar
  // if (!isButtonClick && isOutsideClick) {
  //     console.log("outside click");
  //     sidebar.classList.add("-translate-x-full");
  //     return;
  // }
});

function toast(msg) {
    console.log("toast");
    // Get the snackbar DIV
    var x = document.getElementById("toast");
    // console.log(x)
    var body = $(".toast-body");
    body.html(msg);
    // Add the "show" class to DIV
    // x.className = "show";
    x.classList.add("show");

    // After 3 seconds, remove the show class from DIV
    setTimeout(function() {
        x.className = x.className.replace("show", "");
    }, 3000);
}

function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

function loading_btn(id){
    id.html("Proses..")
    id.attr("disabled", true);
}

function release_btn(id, name="Submit"){
    id.html(name)
    id.attr("disabled", false);
}

function copy_text(value) {
    // Get the text field
    // var copyText = document.getElementById("myInput");

    // Select the text field
    // copyText.select();
    // copyText.setSelectionRange(0, 99999); // For mobile devices

     // Copy the text inside the text field
    navigator.clipboard.writeText(value);

    // Alert the copied text
    toast("Berhasil menyalin "+value)
  }