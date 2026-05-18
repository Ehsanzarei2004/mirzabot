FROM php:7.4-apache

# نصب اکستنشن‌های مورد نیاز دیتابیس
RUN docker-php-ext-install mysqli pdo pdo_mysql

# فعال کردن ماژول ری‌رایت آپاچی
RUN a2enmod rewrite

# کپی کردن کدهای پروژه به پوشه وب‌سرور
COPY . /var/www/html/

# تنظیم دسترسی فایل‌ها
RUN chown -r www-data:www-data /var/www/html/

# پورت پیش‌فرض ریلوای
EXPOSE 80

CMD ["apache2-foreground"]
