server {
    listen 80;
    #listen 443 ssl;
    ssl_certificate    /home/ssl/ssl.pem;
    ssl_certificate_key    /home/ssl/ssl.key;
    server_name kiplingstorediamon.com www.kiplingstorediamon.com;
    root /var/www/kipling/client;
    index index.html index.htm index.php;
        #return 301 https://$host$request_uri;
    access_log  /var/log/nginx/access_client.log;
    error_log  /var/log/nginx/error_client_log;

    location / {
        try_files $uri $uri/ =404;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
     }

    location ~ /\.ht {
        deny all;
    }
}