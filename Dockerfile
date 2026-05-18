FROM php:7.4-apache

# غیرفعال کردن MPM اضافی برای حل خطای سرور
RUN a2dismod mpm_event && a2enmod mpm_prefork

# نصب اکستنشن‌های مورد نیاز دیتابیس
RUN docker-php-ext-install mysqli pdo pdo_mysql

# فعال کردن ماژول ری‌رایت آپاچی
RUN a2enmod rewrite

# کپی کردن کدهای پروژه به پوشه وب‌سرور
COPY . /var/www/html/

# تنظیم دسترسی فایل‌ها
RUN chown -R www-data:www-data /var/www/html/

# پورت پیش‌فرض
EXPOSE 80

CMD ["apache2-foreground"]
