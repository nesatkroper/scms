#!/bin/bash

# Performance Testing Script for SCMS
# This script tests the performance improvements

echo "======================================"
echo "SCMS Performance Testing Script"
echo "======================================"
echo ""

# Colors for output
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Test 1: Check PHP Configuration
echo -e "${YELLOW}Test 1: Checking PHP Configuration...${NC}"
echo "--------------------------------------"
php -i | grep -E "upload_max_filesize|post_max_size|memory_limit|max_execution_time"
echo ""

# Test 2: Check Database Indexes
echo -e "${YELLOW}Test 2: Checking Database Indexes...${NC}"
echo "--------------------------------------"
php artisan tinker --execute="
echo 'Users table indexes:';
\$indexes = DB::select(\"SHOW INDEX FROM users WHERE Key_name LIKE 'idx_%'\");
echo count(\$indexes) . ' custom indexes found';
echo PHP_EOL;

echo 'Fees table indexes:';
\$indexes = DB::select(\"SHOW INDEX FROM fees WHERE Key_name LIKE 'idx_%'\");
echo count(\$indexes) . ' custom indexes found';
echo PHP_EOL;

echo 'Enrollments table indexes:';
\$indexes = DB::select(\"SHOW INDEX FROM enrollments WHERE Key_name LIKE 'idx_%'\");
echo count(\$indexes) . ' custom indexes found';
"
echo ""

# Test 3: Test Response Time
echo -e "${YELLOW}Test 3: Testing Response Time...${NC}"
echo "--------------------------------------"
echo "Testing /admin/students endpoint..."

# Warm up cache
curl -s -o /dev/null -w "Warm-up request: %{time_total}s\n" http://localhost/admin/students

# Test actual performance
RESPONSE_TIME=$(curl -s -o /dev/null -w "%{time_total}" http://localhost/admin/students)
echo "Response time: ${RESPONSE_TIME}s"

if (( $(echo "$RESPONSE_TIME < 3.0" | bc -l) )); then
    echo -e "${GREEN}✓ PASS: Response time is good (< 3 seconds)${NC}"
else
    echo -e "${RED}✗ FAIL: Response time is slow (> 3 seconds)${NC}"
fi
echo ""

# Test 4: Cache Test
echo -e "${YELLOW}Test 4: Testing Cache Performance...${NC}"
echo "--------------------------------------"
echo "First request (cache miss):"
TIME1=$(curl -s -o /dev/null -w "%{time_total}" http://localhost/admin/students)
echo "Time: ${TIME1}s"

echo "Second request (cache hit):"
TIME2=$(curl -s -o /dev/null -w "%{time_total}" http://localhost/admin/students)
echo "Time: ${TIME2}s"

if (( $(echo "$TIME2 < $TIME1" | bc -l) )); then
    echo -e "${GREEN}✓ PASS: Cache is working (second request faster)${NC}"
else
    echo -e "${YELLOW}⚠ WARNING: Cache might not be working properly${NC}"
fi
echo ""

# Test 5: Database Query Count
echo -e "${YELLOW}Test 5: Checking Database Query Count...${NC}"
echo "--------------------------------------"
echo "Enable query logging in .env with DB_QUERY_LOG=true to see query counts"
echo ""

# Test 6: OPcache Status
echo -e "${YELLOW}Test 6: Checking OPcache Status...${NC}"
echo "--------------------------------------"
php -r "
\$opcache = opcache_get_status();
if (\$opcache) {
    echo 'OPcache: ENABLED' . PHP_EOL;
    echo 'Memory Usage: ' . round(\$opcache['memory_usage']['used_memory'] / 1024 / 1024, 2) . ' MB' . PHP_EOL;
    echo 'Hit Rate: ' . round(\$opcache['opcache_statistics']['opcache_hit_rate'], 2) . '%' . PHP_EOL;
} else {
    echo 'OPcache: DISABLED (Consider enabling for better performance)' . PHP_EOL;
}
"
echo ""

# Summary
echo "======================================"
echo -e "${GREEN}Performance Test Complete!${NC}"
echo "======================================"
echo ""
echo "Next Steps:"
echo "1. If response time > 3s, check server resources (CPU, RAM)"
echo "2. If cache not working, verify CACHE_DRIVER in .env"
echo "3. If indexes missing, run: php artisan migrate"
echo "4. Monitor production with: tail -f storage/logs/laravel.log"
echo ""
