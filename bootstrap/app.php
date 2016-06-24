<?php

require_once __DIR__ . '/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__ . '/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__ . '/../')
);

$app->withFacades();

$app->withEloquent();

class_alias('Illuminate\Support\Facades\Mail', 'Mail');
class_alias('Illuminate\Support\Facades\App', 'App');
class_alias('Illuminate\Support\Facades\Request', 'Request');
/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton('authToken', function ($app) {
    $authToken = new App\Models\AuthToken();
    $a = Request::header('Authorization');
    if (!!$a) {
        $authToken = App\Models\AuthToken::where('Id', $a)->first();
    }
    return $authToken;
});

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->middleware([
//    App\Http\Middleware\ExampleMiddleware::class
// ]);

// $app->routeMiddleware([
//     'auth' => App\Http\Middleware\Authenticate::class,
// ]);

$app->routeMiddleware([
    'auth.api' => App\Http\Middleware\AuthMiddleWare::class,
]);


/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\HelperServiceProvider::class);
$app->register(Illuminate\Redis\RedisServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->group(['namespace' => 'App\Http\Controllers'], function ($app) {
    require __DIR__ . '/../app/Http/routes.php';
});

$app->configureMonologUsing(function ($monolog) {
    if (app()->environment('local', 'staging'))
        $monolog->pushHandler(new Monolog\Handler\FirePHPHandler());
    $monolog->pushHandler((new Monolog\Handler\StreamHandler(storage_path('logs/lumen.log'), \Monolog\Logger::DEBUG))
        ->setFormatter(new Monolog\Formatter\LineFormatter(null, null, true, true)));

    return $monolog;
});

DB::listen(function ($query) {
    if (boolval(env('APP_DEBUG')) && boolval(env('LOG_SQL_QUERY'))) {
        Log::addInfo("Sql Executed at " . date("Y-m-d H:i:s"), array(
            "sql" => $query->sql,
            "bindings" => $query->bindings,
            "connectionName" => $query->connectionName,
            "connection" => $query->connection,
            "time" => $query->time
        ));
    }
});

return $app;
