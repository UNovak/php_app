# PHP TODO APP

### error fixing

after every fix run:

`docker compose restart`

---

Fatal error: Uncaught Error: Call to undefined function mysqli_connect() in /var/www/html/db/db.php:7 Stack trace: #0 /var/www/html/functions/register.php(3): include() #1 {main} thrown in /var/www/html/db/db.php on line 7

in php container run:

```bash
docker-php-ext-install mysqli pdo_mysql && docker-php-ext-enable mysqli
```

---

Fatal error: Uncaught Error: Class "XSLTProcessor" not found in /var/www/html/home.php:27 Stack trace: #0 {main} thrown in /var/www/html/home.php on line 27

in php container run:

```bash
apt-get update && apt-get install -y \
libxslt-dev
```

```bash
docker-php-ext-install xsl
```

---
