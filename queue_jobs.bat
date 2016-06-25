php artisan queue:work redis --queue=email,default --sleep=10 --tries=5 --delay=10 --daemon
