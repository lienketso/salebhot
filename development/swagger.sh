mkdir ../public/swagger
php ../vendor/bin/swagger --bootstrap ./swagger-constants.php --output ../public/swagger ./swagger-v1.php ../module/frontend/src/Http/Controllers
