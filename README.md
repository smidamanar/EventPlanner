git clone https://github.com/smidamanar/EventPlanner.git
cd EventPlanner/EventPlanner
composer install
npm install && npm run build
copy ..\.env.example .env        (Mac/Linux: cp ../.env.example .env)
php artisan key:generate
php artisan migrate --seed
php artisan serve