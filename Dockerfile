FROM php:apache

# Install PHP extensions
RUN apt-get update && apt-get install -y libxslt1-dev
RUN docker-php-ext-install xsl
RUN docker-php-ext-install mysqli pdo_mysql && docker-php-ext-enable mysqli

# Manually enable extensions:
# in /usr/local/etc/php/php.ini-development uncomment:
# line 948 -> extension=mysqli
# line 971 -> extension=xsl


# in /usr/local/etc/php/php.ini-production uncomment:
# line 950 -> extension=mysqli
# line 973 -> extension=xsl