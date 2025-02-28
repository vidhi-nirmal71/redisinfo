<?php 

return [

/*
|--------------------------------------------------------------------------
| Redis Connection
|--------------------------------------------------------------------------
|
| This defines which Redis connection to use from the Laravel database
| configuration file. The default connection can be overridden.
|
*/

'connection' => env('REDIS_CONNECTION', 'default'),

/*
|--------------------------------------------------------------------------
| Redis Database Index
|--------------------------------------------------------------------------
|
| Redis supports multiple databases. You can define which database index
| should be used for fetching statistics and storing data.
|
*/

'database' => env('REDIS_DATABASE', 0),

/*
|--------------------------------------------------------------------------
| Cache Expiration Time (Seconds)
|--------------------------------------------------------------------------
|
| Determines how often the Redis data should be refreshed.
|
*/

'cache_expiration' => env('REDIS_CACHE_EXPIRATION', 60),

/*
|--------------------------------------------------------------------------
| Enable Debug Logging
|--------------------------------------------------------------------------
|
| Set this to true if you want to enable debugging logs for Redis operations.
|
*/

'debug' => env('REDIS_DEBUG', false),

/*
|--------------------------------------------------------------------------
| Keys to Monitor
|--------------------------------------------------------------------------
|
| Specify the keys or patterns you want to monitor in Redis.
|
*/

'monitor_keys' => [
    'cache:*',
    'session:*',
    'queue:*',
],

/*
|--------------------------------------------------------------------------
| Statistics Settings
|--------------------------------------------------------------------------
|
| These settings control the statistics displayed in your Redis dashboard.
|
*/

'statistics' => [
    'show_memory_usage' => true,
    'show_uptime' => true,
    'show_total_commands' => true,
    'show_expired_keys' => true,
],

];
