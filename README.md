# magento2-course
Magento 2 environment to follow the initiation course

## Steps to install
---

### 1. Docker Compose UP

```
docker-compose up -d
```

### 2. Enter docker php container

```
docker exec -it magento-php-course-2020 bash
```

### 3. Composer install

```
composer install
```

### 4. Install Magento 2

```
bin/magento setup:install \
--base-url=http://curso.magento.local/ \
--db-host=mysql \
--db-name=magento \
--db-user=magento \
--db-password=magento \
--admin-firstname=admin \
--admin-lastname=admin \
--admin-email=admin@admin.com \
--admin-user=admin \
--admin-password=admin123 \
--language=en_US \
--currency=EUR \
--timezone=Europe/Madrid \
--elasticsearch-host elasticsearch \
--elasticsearch-port 9200 \
--use-rewrites=1
```

### 5. Ignore changes in app/etc/env.php (outside the container)

```
git checkout app/etc/env.php
```

### 6. Setting file permissions (inside the container)

```
find var generated vendor pub/static pub/media app/etc -type f -exec chmod g+w {} +
```

```
find var generated vendor pub/static pub/media app/etc -type d -exec chmod g+ws {} +
```
