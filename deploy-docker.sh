#!/bin/bash

# Docker-specific deployment script
# This script runs inside the Docker container or via docker-compose exec

set -e  # Exit on any error

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}Starting Docker Deployment${NC}"
echo -e "${GREEN}========================================${NC}"

# Step 1: Install/Update Composer dependencies
echo -e "\n${YELLOW}[1/5] Installing Composer dependencies...${NC}"
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev || {
    echo -e "${RED}Error: Composer install failed${NC}"
    exit 1
}
echo -e "${GREEN}✓ Composer dependencies installed${NC}"

# Step 2: Run database migrations
echo -e "\n${YELLOW}[2/5] Running database migrations...${NC}"
php artisan migrate --force || {
    echo -e "${RED}Error: Migration failed${NC}"
    exit 1
}
echo -e "${GREEN}✓ Migrations completed${NC}"

# Step 3: Clear and cache Laravel
echo -e "\n${YELLOW}[3/5] Clearing and optimizing Laravel caches...${NC}"
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true
php artisan route:clear || true

php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo -e "${GREEN}✓ Caches cleared and optimized${NC}"

# Step 4: Set permissions
echo -e "\n${YELLOW}[4/5] Setting proper permissions...${NC}"
chown -R www-data:www-data storage bootstrap/cache database || true
chmod -R 775 storage bootstrap/cache database || true
echo -e "${GREEN}✓ Permissions set${NC}"

# Step 5: Ensure database file exists
echo -e "\n${YELLOW}[5/5] Ensuring database file exists...${NC}"
mkdir -p database
touch database/database.sqlite
chmod 664 database/database.sqlite
chown www-data:www-data database/database.sqlite
echo -e "${GREEN}✓ Database file ready${NC}"

echo -e "\n${GREEN}========================================${NC}"
echo -e "${GREEN}Docker Deployment Completed!${NC}"
echo -e "${GREEN}========================================${NC}"

