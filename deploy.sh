#!/bin/bash

# Script for deploying Laravel application
# Usage: ./deploy.sh [--skip-git] [--skip-build] [--skip-migrate]

set -e  # Exit on any error

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Flags
SKIP_GIT=false
SKIP_BUILD=false
SKIP_MIGRATE=false

# Parse arguments
for arg in "$@"; do
    case $arg in
        --skip-git)
            SKIP_GIT=true
            shift
            ;;
        --skip-build)
            SKIP_BUILD=true
            shift
            ;;
        --skip-migrate)
            SKIP_MIGRATE=true
            shift
            ;;
        *)
            # Unknown option
            ;;
    esac
done

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}Starting Deployment Process${NC}"
echo -e "${GREEN}========================================${NC}"

# Step 1: Pull latest code from Git
if [ "$SKIP_GIT" = false ]; then
    echo -e "\n${YELLOW}[1/7] Pulling latest code from Git...${NC}"
    git pull origin main || {
        echo -e "${RED}Error: Failed to pull from Git${NC}"
        exit 1
    }
    echo -e "${GREEN}✓ Code updated${NC}"
else
    echo -e "\n${YELLOW}[1/7] Skipping Git pull${NC}"
fi

# Step 2: Install/Update Composer dependencies
echo -e "\n${YELLOW}[2/7] Installing Composer dependencies...${NC}"
if command -v composer &> /dev/null; then
    composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev || {
        echo -e "${RED}Error: Composer install failed${NC}"
        exit 1
    }
    echo -e "${GREEN}✓ Composer dependencies installed${NC}"
else
    echo -e "${YELLOW}Warning: Composer not found. Skipping...${NC}"
fi

# Step 3: Install/Update NPM dependencies
if [ "$SKIP_BUILD" = false ]; then
    echo -e "\n${YELLOW}[3/7] Installing NPM dependencies...${NC}"
    if command -v npm &> /dev/null; then
        npm ci || npm install || {
            echo -e "${RED}Error: NPM install failed${NC}"
            exit 1
        }
        echo -e "${GREEN}✓ NPM dependencies installed${NC}"
    else
        echo -e "${YELLOW}Warning: NPM not found. Skipping...${NC}"
    fi
else
    echo -e "\n${YELLOW}[3/7] Skipping NPM install (build skipped)${NC}"
fi

# Step 4: Build assets
if [ "$SKIP_BUILD" = false ]; then
    echo -e "\n${YELLOW}[4/7] Building assets...${NC}"
    if command -v npm &> /dev/null; then
        npm run build || {
            echo -e "${RED}Error: Asset build failed${NC}"
            exit 1
        }
        echo -e "${GREEN}✓ Assets built successfully${NC}"
    else
        echo -e "${YELLOW}Warning: NPM not found. Skipping asset build...${NC}"
    fi
else
    echo -e "\n${YELLOW}[4/7] Skipping asset build${NC}"
fi

# Step 5: Run database migrations
if [ "$SKIP_MIGRATE" = false ]; then
    echo -e "\n${YELLOW}[5/7] Running database migrations...${NC}"
    php artisan migrate --force || {
        echo -e "${RED}Error: Migration failed${NC}"
        exit 1
    }
    echo -e "${GREEN}✓ Migrations completed${NC}"
else
    echo -e "\n${YELLOW}[5/7] Skipping migrations${NC}"
fi

# Step 6: Clear and cache Laravel
echo -e "\n${YELLOW}[6/7] Clearing and optimizing Laravel caches...${NC}"
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true
php artisan route:clear || true

php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo -e "${GREEN}✓ Caches cleared and optimized${NC}"

# Step 7: Set permissions
echo -e "\n${YELLOW}[7/7] Setting proper permissions...${NC}"
chmod -R 775 storage bootstrap/cache || true
chmod -R 775 database || true
echo -e "${GREEN}✓ Permissions set${NC}"

# Step 8: Restart Docker containers (if using Docker)
if command -v docker-compose &> /dev/null || command -v docker &> /dev/null; then
    echo -e "\n${YELLOW}[8/8] Restarting Docker containers...${NC}"
    if [ -f "docker-compose.yml" ]; then
        docker-compose down || true
        docker-compose up -d --build || {
            echo -e "${YELLOW}Warning: Docker restart failed. You may need to restart manually.${NC}"
        }
        echo -e "${GREEN}✓ Docker containers restarted${NC}"
    else
        echo -e "${YELLOW}No docker-compose.yml found. Skipping Docker restart.${NC}"
    fi
else
    echo -e "\n${YELLOW}[8/8] Docker not found. Skipping container restart.${NC}"
fi

echo -e "\n${GREEN}========================================${NC}"
echo -e "${GREEN}Deployment Completed Successfully!${NC}"
echo -e "${GREEN}========================================${NC}"

