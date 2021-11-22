**Install project**
```
git clone https://github.com/konpaa/estimation.git
```
**Route to project**
```
cd estimation
```
**Create env**
```
cp .env.example .env
```
**Generate application key**
```
php artisan key:generate
```
**Install packages**
```
composer install
```
**Up docker containers**
```
docker-compose up -d
```
**Migrate schema and seed to docker db**
```
php artisan migrate --seed
```
**Test application**
```
make test
```
