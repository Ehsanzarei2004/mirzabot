FROM php:7.4-fpm-alpine

# نصب اکستنشن‌های مورد نیاز دیتابیس و خود وب‌سرور Nginx
RUN docker-php-ext-install mysqli pdo pdo_mysql \
    && apk add --no-cache nginx

# کپی کردن کدهای پروژه به پوشه وب‌سرور
COPY . /var/www/html/

# تنظیم تنظیمات پایه ان‌جیناکس برای اجرای PHP
RUN mkdir -p /run/nginx \
    && echo 'server { \
        listen 80; \
        root /var/www/html; \
        index index.php index.html; \
        location / { \
            try_files $uri $uri/ /index.php?$query_string; \
        } \
        location ~ \.php$ { \
            fastcgi_pass 127.0.0.1:9000; \
            fastcgi_index index.php; \
            include fastcgi_params; \
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; \
        } \
    }' > /etc/nginx/http.d/default.conf

WORKDIR /var/www/html

# پورت پیش‌فرض
EXPOSE 80

# استارت همزمان PHP-FPM و Nginx
CMD php-fpm -D && nginx -g "daemon off;"
