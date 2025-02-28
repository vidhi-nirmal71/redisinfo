# 🚀 Redis Info - Laravel Redis Monitoring & Insights  

The **Redis Info** package provides detailed monitoring and insights into your Redis database for Laravel applications. It helps track Redis usage, cache performance, and key management, making it an essential tool for **debugging, optimizing, and monitoring Redis-based operations**.  

## **⚠️ Important Notice: Install Redis Before Using This Package**  
Before using this package, ensure that Redis is installed and running on your server. Without Redis, this package will not function correctly.  

Refer to the official Redis installation guide for setup instructions:  
🔗 **[Redis System Installation Guide](https://redis.io/docs/getting-started/installation/)**  

🔗 **[Laravel Redis Package Installation Guide](https://packagist.org/packages/predis/predis)**  


## **⚠️ Security Warning**
This package does not include any built-in security measures and is intended for admin use only. It exposes sensitive redis details which could pose a security risk if accessed by unauthorized users.Ensure that this package is only used in a secure environment and not exposed to public or unauthorized access.  

<p>🏷️  
<a href="https://packagist.org/search/?tags=redis" target="_blank" rel="noopener noreferrer">#Redis</a>&nbsp;  
<a href="https://packagist.org/search/?tags=caching" target="_blank" rel="noopener noreferrer">#Caching</a>&nbsp;  
<a href="https://packagist.org/search/?tags=laravel" target="_blank" rel="noopener noreferrer">#Laravel</a>&nbsp;  
<a href="https://packagist.org/search/?tags=php" target="_blank" rel="noopener noreferrer">#PHP</a>&nbsp;  
<a href="https://packagist.org/search/?tags=performance" target="_blank" rel="noopener noreferrer">#Performance</a>&nbsp;  
<a href="https://packagist.org/search/?tags=optimization" target="_blank" rel="noopener noreferrer">#Optimization</a>&nbsp;  
<a href="https://packagist.org/search/?tags=monitoring" target="_blank" rel="noopener noreferrer">#Monitoring</a>  
</p>  

## Documentation  
- [Features](#features)  
- [Supported Versions](#supported-versions)  
- [Installation](#installation)  
- [Commands](#commands)
        - [Vendor Publish](#vendor-publish)
        - [Environment Configuration](#environment-configuration)  
        - [Accessing the Plugin](#accessing-the-plugin)
- [FAQs](#faqs)  
- [Contributing](#contributing)  
- [Security Vulnerabilities](#security-vulnerabilities)  
- [License](#license)  
- [Testing](#testing)  
- [Support](#get-support)  

## **Features**  
**Monitor Redis usage** in Laravel applications.  
**Track cache and database performance.**  
**View real-time Redis statistics** (memory, uptime, commands).  
**Filter and search Redis keys dynamically.**  
**Supports Laravel 9, 10, and 11** with **PHP 8+ compatibility**.  
**Lightweight and optimized for fast responses.**  
**Easy setup with vendor publish and migration commands.**  
**Detailed analytics for cache and session keys.**  

## **Supported Versions**  
- **PHP:** ^8.0  
- **Illuminate Support:** ^9.0 | ^10.0 | ^11.0  

## **Installation**  
To install the package, open the terminal and run the following command:  
```bash
composer require itpathsolutions/redisinfo
```    

### **Vendor Publish**  
Run the following command to publish the vendor files:  
<pre><code class="language-bash">php artisan vendor:publish --provider="Itpathsolutions\RedisInfo\RedisServiceProvider"</code></pre>   


## **Environment Configuration**  
After installing, add the following settings to your `.env` file:  
```bash
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
REDIS_CLIENT=predis
REDIS_HOST=your_redis_host   # Default: 127.0.0.1
REDIS_PASSWORD=your_redis_password   # Leave empty if no password
REDIS_PORT=your_redis_port   # Default: 6379
```  
**⚠️ Important:** Ensure Redis is installed and running. If any of these values are missing, Laravel may throw errors.

Once done, clear the cache to apply changes:  
```bash
php artisan config:clear
```  

## **Accessing the Plugin**  
Once installed, you can use the following route to access Redis insights:  
```bash
localhost:8000/redis-info
```  
This route displays **memory usage, uptime, key stats, and database info** in a user-friendly dashboard.  

## **FAQs**  

### 1. What does this package do?  
🔍 The **Redis Info** package provides an **insightful dashboard** to monitor Redis **memory, keys, and performance statistics** in Laravel applications.  

### 2. How do I install the package?  
📦 Run the following command in your terminal:  
```bash
composer require itpathsolutions/redisinfo
```  

### 3. Which Laravel versions are supported?  
This package supports **Laravel 9, 10, and 11** with **PHP 8+** compatibility.   

### 4. How do I access the Redis Info dashboard?  
You can access the dashboard via:  
👉 `localhost:8000/redis-info`  

### 5. How do I update the package to the latest version?  
Run the following command to update:  
```bash
composer update itpathsolutions/redisinfo
```  

### 6. Can I contribute to this package?  
🤝 Absolutely! Contributions are welcome. See the [CONTRIBUTING](https://github.com/vidhi-nirmal71/redisinfo/blob/main/CONTRIBUTING.md) guidelines for details.  

### 7. Where can I get support?  
For any support or queries, contact us via [IT Path Solutions](https://www.itpathsolutions.com/contact-us/).  

## **Contributing**  
We welcome contributions from the community! Feel free to **Fork** the repository and contribute to this module. You can also create a pull request, and we will merge your changes into the main branch. See [CONTRIBUTING](https://github.com/vidhi-nirmal71/redisinfo/blob/main/CONTRIBUTING.md) for details.  

## **Security Vulnerabilities**  
Please review our [Security Policy](https://github.com/vidhi-nirmal71/redisinfo/security/policy) on how to report security vulnerabilities.  

## **License**  
This package is open-source and available under the MIT License. See the [LICENSE](https://github.com/vidhi-nirmal71/redisinfo/blob/main/LICENSE) file for details.  

## **Testing**  
To test this package, run the following command:  
```bash
composer test
```  

## **Get Support**  
- Feel free to [contact us](https://www.itpathsolutions.com/contact-us/) if you have any questions.  
- If you find this project helpful, please give us a ⭐ [Star](https://github.com/vidhi-nirmal71/redisinfo/stargazers).  

## **You may also find our other useful packages:**  
- [MySQL Info Package 🚀](https://packagist.org/packages/itpathsolutions/mysqlinfo)  
- [PHP Info Package 🚀](https://packagist.org/packages/itpathsolutions/phpinfo)  
- [Role Wise Session Manager Package 🚀](https://packagist.org/packages/itpathsolutions/role-wise-session-manager)  
- [Authinfo - User Login Tracker 🚀](https://packagist.org/packages/itpathsolutions/authinfo)  