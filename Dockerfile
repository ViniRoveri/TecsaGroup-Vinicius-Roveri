FROM php:apache
RUN docker-php-ext-install mysqli \
&& sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf \
&& a2enmod rewrite \
&& service apache2 restart
