## How to install

```php
composer install
cp .env.example .env
php artisan key:generate

php artisan cache:clear


php artisan config:cache
php artisan route:cache

php artisan migrate
php artisan db:seed
```

```bash
sudo chown -R www-data:www-data /var/www/website-website/vendor/
sudo chown -R www-data:www-data /var/www/website-website/storage/
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
```

### Helpful commands

```php
composer dump-autoload
php artisan migrate:fresh
php artisan db:seed
php artisan config:cache
php artisan route:cache
php artisan route:clear
php artisan optimize

After deploy
php artisan config:cache
php artisan migrate:refresh --seed
```

# Tests

### Run Manualy

```bash
php ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests
```

### Pre-push hook

In directory `.git/hooks/` create file pre-push with permission `chmod a+x .git/hooks/pre-push`

```php
#!/usr/bin/php
<?php
$projectName = basename(getcwd()); // get the name of your app
echo PHP_EOL;
echo '+ Starting unit tests'.PHP_EOL;
exec('php ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests', $output, $returnCode); // command to run tests with any testing framework you like
if ($returnCode !== 0) {
  $testSummary = $output;
  printf("%s Test Summary: ", $projectName);
  echo PHP_EOL;
  printf("( %s ) %s%2\$s", $testSummary[14], PHP_EOL);
  printf("ABORTING COMMIT!\n");
  exit(1); // git halts
}
exit(0); // git continues with push event
```

# Deploy

Run from root directory

```bash
envoy run deploy
envoy run deploy --env=stage
```

```
ssh root@178.128.75.84
/usr/local/bin:/usr/bin:/bin:/usr/sbin:/sbin:~/.composer/vendor/bin
sudo apt-get install php-gd php-xml php7.2-mbstring
apt install zip unzip php7.0-zip
```
