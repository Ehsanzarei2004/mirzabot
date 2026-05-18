FROM php:7.4-fpm-alpine

# نصب ابزارها و اکستنشن‌های مورد نیاز دیتابیس و ان‌جیناکس
RUN docker-php-ext-install mysqli pdo pdo_mysql \
    && apk add --no-cache nginx

# کپی کردن کل کدهای پروژه به پوشه استاندارد وب‌سرور
COPY . /var/www/html/

# تنظیمات پیش‌فرض و روان ان‌جیناکس برای اجرای مستقیم فایلهای میرزا پنل
RUN mkdir -p /run/nginx \
    && echo 'server { \
        listen 80; \
        root /var/www/html; \
        index index.php index.html install.php; \
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

# تنظیم دسترسی دسترسی فایل‌ها برای جلوگیری از ارورهای دسترسی دیتابیس
RUN chmod -R 777 /var/www/html

WORKDIR /var/www/html

EXPOSE 80

CMD php-fpm -D && nginx -g "daemon off;"
