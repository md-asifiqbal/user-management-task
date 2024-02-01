#REQUIREMENTS
Must be installed mongodb driver in local system
#INSTALLATION
```
git clone https://github.com/md-asifiqbal/user-management-task.git
cd user-management-task
composer install
cp .env.example .env
php artisan key:generate
#set database connection in .env file
php artisan migrate --seed
php artisan serve
```
#USAGE
```
http://localhost:8000
```
