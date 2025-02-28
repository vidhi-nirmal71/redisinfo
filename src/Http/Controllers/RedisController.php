<?php

namespace Itpathsolutions\RedisInfo\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    public function index(){
        $redisInstalled = false;
        $header = '';
        $message = '';
        $redisDetails = [];

        try {
            Redis::ping();
            $redisInstalled = true;
            $header = '✅ Redis Installed';
            $message = 'Redis is installed and working!';
            
            // Get Redis server details
            $info = Redis::connection()->client()->info();
            $dbSize = Redis::dbsize();
            $keys = Redis::connection()->keys('*');
            $redisPrefix = config('database.redis.options.prefix');

            $keyDetails = [];
            foreach ($keys as $key) {
                $realKey = $redisPrefix ? str_replace($redisPrefix, '', $key) : $key;
                $dumpSize = Redis::connection()->client()->executeRaw(['DUMP', $realKey]);

                $type = Redis::type($realKey);
                $size = $dumpSize ? strlen($dumpSize) . ' B' : '0 B';
                $value = Redis::get($realKey);

                $keyDetails[] = [
                    'key' => $realKey,
                    'type' => method_exists($type, 'getPayload') ? $type->getPayload() : (string) $type,
                    'size' => $size,
                    'value' => $value
                ];
            }

            $redisDetails = [
                'total_keys' => $dbSize,
                'last_refresh' => now()->format('Y-m-d H:i:s'),
                'redis_version' => $info['Server']['redis_version'] ?? 'Unknown',
                'os' => $info['Server']['os'] ?? 'Unknown',
                'uptime_days' => $info['Server']['uptime_in_days'] ?? 'Unknown',
                'uptime_seconds' => $info['Server']['uptime_in_seconds'] ?? 'Unknown',
                'used_memory' => $info['Memory']['used_memory_human'] ?? 'Unknown',
                'connected_clients' => $info['connected_clients'] ?? 'Unknown',
                'redis_connection' => config('database.redis.default'),
                'total_commands_processed' => $info['Stats']['total_commands_processed'] ?? 0, 
                'total_connections' => $info['Stats']['total_connections_received'] ?? 0, 
                'expired_keys' => $info['Stats']['expired_keys'] ?? 0,
                'evicted_keys' => $info['Stats']['evicted_keys'] ?? 0,
                'cpu_usage' => $info['CPU']['used_cpu_sys'] ?? 0,            
                'keyDetails' => $keyDetails,
            ];

        } catch (\Throwable $e) {
            $redisInstalled = false;
            if (str_contains($e->getMessage(), 'Connection refused')) {
                $header = '⚠️ Redis Not Running';
                $message = 'Redis is NOT running. Please start the Redis server.';
            } elseif (str_contains($e->getMessage(), 'Call to undefined method')) {
                $header = '❌ Redis Misconfigured';
                $message = 'Redis is not properly configured in Laravel. Check your `.env` and `config/database.php`.';
            } else {
                $header = '⚠️ Redis Error';
                $message = 'Something went wrong: ' . $e->getMessage();
            }
        }

        return view('redisinfo::index', compact('redisInstalled', 'header', 'message', 'redisDetails'));
    }
}
