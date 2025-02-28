<?php
   
    namespace Itpathsolutions\RedisInfo;
    use Illuminate\Support\ServiceProvider;
    class RedisServiceProvider extends ServiceProvider {
        public function boot(): void
        {
            $this->loadRoutesFrom(__DIR__.'/routes/web.php');
            $this->loadViewsFrom(__DIR__.'/resources/views', 'redisinfo');
            $this->mergeConfigFrom(
                __DIR__.'/Config/config.php', 'redisinfo'
            );
    
            // Publish configuration file to the application's config directory
            $this->publishes([
                __DIR__.'/Config/config.php' => config_path('redisinfo.php'),
            ]);
        }
        public function register()
        {
      }
   }
?>