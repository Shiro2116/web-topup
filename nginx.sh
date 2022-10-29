server {
    listen 8082 default_server;
    server_name localhost 192.168.43.2;
    root "D:/2022/Project/web topup game/web-topup";

    index index.html index.htm index.php;

    # Access Restrictions
    allow       127.0.0.1;
    #deny        all;

    include "C:/laragon/etc/nginx/alias/*.conf";

    location / {
        #try_files $uri $uri/ =404;
        #try_files $uri $uri/ /index.php?$query_string;
        rewrite topup/([A-Za-z0-9-]+)$ /topup.php?slug=$1;
        rewrite order/([A-Za-z0-9]+)$ /detail_pembayaran.php?trx_id=$1;
        rewrite qr /qr.php;
        rewrite cek-transaksi /cek_transaksi.php;
		autoindex on;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass php_upstream;
        #fastcgi_pass unix:/run/php/php7.0-fpm.sock;
    }


    charset utf-8;

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
    location ~ /\.ht {
        deny all;
    }

}
