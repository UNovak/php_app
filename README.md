# PHP TODO APP

### error fixing

Fatal error: Uncaught Error: Call to undefined function mysqli_connect() in /var/www/html/db/db.php:7 Stack trace: #0 /var/www/html/functions/register.php(3): include() #1 {main} thrown in /var/www/html/db/db.php on line 7

```bash
  docker-php-ext-install mysqli pdo_mysql && docker-php-ext-enable mysqli
```