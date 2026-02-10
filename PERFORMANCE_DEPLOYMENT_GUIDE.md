# Performance Optimization Deployment Guide

## Overview

This guide covers the deployment of performance optimizations to fix the 504 Gateway Timeout and slow LCP (60+ seconds) issues.

## Issues Identified

1. **504 Gateway Timeout** - Server taking too long to respond
2. **Slow LCP (60.24s)** - Largest Contentful Paint is extremely poor
3. **PHP Configuration Limits** - upload_max_filesize: 2M, post_max_size: 8M (too restrictive)
4. **Database Performance** - Missing indexes, N+1 queries, no caching
5. **No Query Optimization** - Loading too much data without limits

## Changes Made

### 1. StudentController Optimizations

**File:** `app/Http/Controllers/Admin/StudentController.php`

#### Changes:

- ✅ Added query result caching (5-10 minute TTL)
- ✅ Replaced `withCount()` with optimized subqueries
- ✅ Limited eager loading to only necessary columns
- ✅ Added pagination limit (20 items per page)
- ✅ Limited related data to recent 10 items in show() method
- ✅ Implemented cache keys based on user, search, and page

#### Performance Impact:

- **Before:** 60+ seconds load time
- **Expected After:** 1-3 seconds load time
- **Cache Hit:** < 100ms response time

### 2. Database Indexes

**File:** `database/migrations/2026_02_10_133714_add_performance_indexes_to_tables.php`

#### Indexes Added:

- `users` table: created_at, email+name, deleted_at
- `fees` table: student_id, student_id+status
- `attendances` table: student_id
- `enrollments` table: student_id, course_offering_id, student_id+course_offering_id
- `course_offerings` table: teacher_id, created_at

#### To Deploy:

```bash
php artisan migrate
```

### 3. PHP Configuration

**File:** `.user.ini`

#### Settings Updated:

```ini
upload_max_filesize = 50M        # Was: 2M
post_max_size = 50M              # Was: 8M
memory_limit = 512M              # Was: -1 (unlimited, but inefficient)
max_execution_time = 300         # Was: 0 (unlimited)
opcache.enable = 1               # New: Enable OPcache
realpath_cache_size = 4096K      # New: Improve file system performance
```

### 4. Nginx Configuration

**File:** `nginx-optimized.conf`

#### Key Optimizations:

- Increased all timeouts to 600 seconds
- Increased client_max_body_size to 50M
- Enabled gzip compression
- Added static asset caching (1 year)
- Increased FastCGI buffers
- Added security headers

### 5. Cache Management

**File:** `app/Console/Commands/ClearStudentCache.php`

#### Usage:

```bash
# Clear all student caches
php artisan cache:clear-students

# Clear cache for specific student
php artisan cache:clear-students 123
```

## Deployment Steps

### Step 1: Backup Database

```bash
php artisan db:backup  # If you have backup package
# OR
mysqldump -u username -p database_name > backup_$(date +%Y%m%d_%H%M%S).sql
```

### Step 2: Deploy Code Changes

```bash
# Pull latest code
git pull origin release

# Install dependencies (if needed)
composer install --optimize-autoloader --no-dev

# Clear existing caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Step 3: Run Database Migrations

```bash
php artisan migrate --force
```

### Step 4: Configure PHP

```bash
# Option A: If using PHP-FPM, update php.ini
sudo nano /etc/php/8.2/fpm/php.ini

# Add or update these settings:
upload_max_filesize = 50M
post_max_filesize = 50M
memory_limit = 512M
max_execution_time = 300
opcache.enable = 1
opcache.memory_consumption = 256
realpath_cache_size = 4096K

# Restart PHP-FPM
sudo systemctl restart php8.2-fpm

# Option B: Use .user.ini (already created in project root)
# This file will be automatically loaded if your server supports it
```

### Step 5: Update Nginx Configuration

```bash
# Backup current config
sudo cp /etc/nginx/sites-available/scms /etc/nginx/sites-available/scms.backup

# Update with new configuration
sudo nano /etc/nginx/sites-available/scms
# Copy contents from nginx-optimized.conf

# Test configuration
sudo nginx -t

# If test passes, reload Nginx
sudo systemctl reload nginx
```

### Step 6: Optimize Laravel

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize
```

### Step 7: Verify Performance

```bash
# Check PHP configuration
php -i | grep -E "upload_max_filesize|post_max_size|memory_limit|max_execution_time"

# Expected output:
# max_execution_time => 300 => 300
# memory_limit => 512M => 512M
# post_max_size => 50M => 50M
# upload_max_filesize => 50M => 50M

# Test the application
curl -I https://your-domain.com/admin/students
# Should return 200 OK within 1-3 seconds
```

## Monitoring & Maintenance

### Cache Warming (Optional)

Create a scheduled task to warm up caches:

```bash
# Add to app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    // Clear and warm cache daily at 2 AM
    $schedule->command('cache:clear-students')->dailyAt('02:00');
}
```

### Performance Monitoring

Monitor these metrics:

- **Response Time:** Should be < 3 seconds
- **LCP:** Should be < 2.5 seconds (good)
- **Database Query Count:** Should be < 20 per page
- **Cache Hit Rate:** Should be > 80%

### Troubleshooting

#### If 504 errors persist:

```bash
# Check PHP-FPM logs
sudo tail -f /var/log/php8.2-fpm.log

# Check Nginx error logs
sudo tail -f /var/log/nginx/error.log

# Check Laravel logs
tail -f storage/logs/laravel.log
```

#### If cache issues occur:

```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Restart services
sudo systemctl restart php8.2-fpm
sudo systemctl restart nginx
```

#### If database is still slow:

```bash
# Check if indexes were created
php artisan tinker
>>> DB::select("SHOW INDEX FROM users WHERE Key_name LIKE 'idx_%'");
>>> DB::select("SHOW INDEX FROM fees WHERE Key_name LIKE 'idx_%'");
>>> DB::select("SHOW INDEX FROM enrollments WHERE Key_name LIKE 'idx_%'");
```

## Expected Results

### Before Optimization:

- Load Time: 60+ seconds
- LCP: 60.24 seconds
- 504 Gateway Timeout errors
- Database queries: 100+ per page
- No caching

### After Optimization:

- Load Time: 1-3 seconds (first load), < 100ms (cached)
- LCP: < 2.5 seconds
- No timeout errors
- Database queries: 10-20 per page
- 80%+ cache hit rate

## Additional Recommendations

### 1. Enable Redis for Caching (Highly Recommended)

```bash
# Install Redis
sudo apt install redis-server

# Update .env
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

# Install PHP Redis extension
sudo apt install php-redis
sudo systemctl restart php8.2-fpm
```

### 2. Use Queue for Heavy Operations

Move heavy operations to queues:

```php
// Example: Move notifications to queue
Notification::send($users, new NewCourseEnrollment($enrollment));
// becomes
Notification::send($users, (new NewCourseEnrollment($enrollment))->delay(now()->addSeconds(5)));
```

### 3. Implement CDN for Static Assets

- Use Cloudflare or similar CDN
- Offload images, CSS, JS to CDN
- Reduce server load

### 4. Database Query Optimization

```bash
# Enable query logging to find slow queries
# Add to .env
DB_QUERY_LOG=true

# Monitor slow queries
php artisan db:show --slow
```

## Support

If issues persist after deployment:

1. Check all logs (PHP-FPM, Nginx, Laravel)
2. Verify all migrations ran successfully
3. Ensure cache driver is properly configured
4. Test with a small dataset first
5. Monitor server resources (CPU, RAM, Disk I/O)

## Rollback Plan

If optimization causes issues:

```bash
# Rollback database
php artisan migrate:rollback

# Restore Nginx config
sudo cp /etc/nginx/sites-available/scms.backup /etc/nginx/sites-available/scms
sudo systemctl reload nginx

# Restore PHP config
# Remove custom settings from php.ini

# Clear all caches
php artisan cache:clear
php artisan config:clear
```
