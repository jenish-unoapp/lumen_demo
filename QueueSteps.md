# Steps to follow when jobs failed 

-   push all failed jobs in que

```
    php artisan queue:retry all
```

-   send Queue restart signal 

```
    php artisan queue:restart
```

-   Restart Queue in shell

```
    php artisan queue:work redis --queue=email,default --sleep=10 --tries=5 --delay=10 --daemon
```