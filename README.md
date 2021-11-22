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
**Install packages**
```
composer install
```
**Generate application key**
```
php artisan key:generate
```
**Up docker containers**
```
docker-compose up -d
```
**Exec bash to container app**
```
make bash
```
**Migrate schema and seed to docker db**
```
make fresh
```
**Test application**
```
make test
```
