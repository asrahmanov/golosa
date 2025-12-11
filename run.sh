#!/bin/bash

# Голоса Единства - Docker Build & Run Script
# ============================================

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Project name
PROJECT="Голоса Единства"

print_header() {
    echo ""
    echo -e "${BLUE}═══════════════════════════════════════════════════════════${NC}"
    echo -e "${BLUE}  $1${NC}"
    echo -e "${BLUE}═══════════════════════════════════════════════════════════${NC}"
    echo ""
}

print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠ $1${NC}"
}

print_error() {
    echo -e "${RED}✗ $1${NC}"
}

# Show help
show_help() {
    echo ""
    echo -e "${BLUE}$PROJECT - Docker Management Script${NC}"
    echo ""
    echo "Usage: ./run.sh [command]"
    echo ""
    echo "Commands:"
    echo "  build       - Full build with migrations and seed (first time setup)"
    echo "  rebuild     - Complete rebuild (removes volumes, rebuilds images)"
    echo "  start       - Start containers"
    echo "  stop        - Stop containers"
    echo "  restart     - Restart containers"
    echo "  update      - Quick update (pull changes, run migrations)"
    echo "  migrate     - Run migrations only"
    echo "  seed        - Run seeders only"
    echo "  fresh       - Fresh migrations with seed (drops all tables)"
    echo "  logs        - Show container logs"
    echo "  shell       - Open shell in app container"
    echo "  status      - Show container status"
    echo "  clean       - Remove all containers and volumes"
    echo "  help        - Show this help"
    echo ""
}

# Check if Docker is running
check_docker() {
    if ! docker info > /dev/null 2>&1; then
        print_error "Docker is not running. Please start Docker first."
        exit 1
    fi
}

# Create .env file for Docker if not exists
setup_env() {
    if [ ! -f .env ]; then
        print_warning ".env file not found, creating from .env.example..."
        cp .env.example .env
    fi
    
    # Update .env for Docker PostgreSQL
    sed -i.bak 's/DB_CONNECTION=.*/DB_CONNECTION=pgsql/' .env
    sed -i.bak 's/DB_HOST=.*/DB_HOST=db/' .env
    sed -i.bak 's/DB_PORT=.*/DB_PORT=5432/' .env
    sed -i.bak 's/DB_DATABASE=.*/DB_DATABASE=golosa_edinstva/' .env
    sed -i.bak 's/DB_USERNAME=.*/DB_USERNAME=golosa/' .env
    sed -i.bak 's/DB_PASSWORD=.*/DB_PASSWORD=golosa_secret_2024/' .env
    rm -f .env.bak
    
    print_success ".env configured for Docker"
}

# Full build (first time)
build() {
    print_header "🏗️  Building $PROJECT"
    
    check_docker
    setup_env
    
    echo "Building Docker images..."
    docker-compose build --no-cache
    
    echo "Starting containers..."
    docker-compose up -d
    
    echo "Waiting for database to be ready..."
    sleep 10
    
    echo "Installing Composer dependencies..."
    docker-compose exec -T app composer install --no-interaction --prefer-dist --optimize-autoloader
    
    echo "Generating application key..."
    docker-compose exec -T app php artisan key:generate --force
    
    echo "Running migrations..."
    docker-compose exec -T app php artisan migrate --force
    
    echo "Running seeders..."
    docker-compose exec -T app php artisan db:seed --force
    
    echo "Setting permissions..."
    docker-compose exec -T app chown -R www-data:www-data /var/www/html/storage
    docker-compose exec -T app chmod -R 775 /var/www/html/storage
    
    echo "Clearing caches..."
    docker-compose exec -T app php artisan config:clear
    docker-compose exec -T app php artisan cache:clear
    docker-compose exec -T app php artisan view:clear
    
    print_header "✅ Build Complete!"
    echo -e "${GREEN}Application:${NC} http://localhost:8080"
    echo -e "${GREEN}Adminer (DB):${NC} http://localhost:8081"
    echo ""
    echo -e "Database credentials:"
    echo -e "  Server: db"
    echo -e "  User: golosa"
    echo -e "  Password: golosa_secret_2024"
    echo -e "  Database: golosa_edinstva"
    echo ""
}

# Complete rebuild
rebuild() {
    print_header "🔄 Rebuilding $PROJECT"
    
    check_docker
    
    print_warning "This will remove all containers, volumes, and rebuild from scratch!"
    read -p "Are you sure? (y/N): " confirm
    if [ "$confirm" != "y" ] && [ "$confirm" != "Y" ]; then
        echo "Cancelled."
        exit 0
    fi
    
    echo "Stopping containers..."
    docker-compose down -v --remove-orphans
    
    echo "Removing old images..."
    docker-compose rm -f
    
    # Run full build
    build
}

# Quick update
update() {
    print_header "⚡ Quick Update"
    
    check_docker
    
    echo "Pulling latest changes..."
    git pull 2>/dev/null || print_warning "Not a git repository or no remote configured"
    
    echo "Installing/updating Composer dependencies..."
    docker-compose exec -T app composer install --no-interaction --prefer-dist --optimize-autoloader
    
    echo "Running migrations..."
    docker-compose exec -T app php artisan migrate --force
    
    echo "Clearing caches..."
    docker-compose exec -T app php artisan config:clear
    docker-compose exec -T app php artisan cache:clear
    docker-compose exec -T app php artisan view:clear
    
    print_success "Update complete!"
}

# Start containers
start() {
    print_header "▶️  Starting $PROJECT"
    check_docker
    docker-compose up -d
    print_success "Containers started!"
    echo -e "${GREEN}Application:${NC} http://localhost:8080"
}

# Stop containers
stop() {
    print_header "⏹️  Stopping $PROJECT"
    check_docker
    docker-compose down
    print_success "Containers stopped!"
}

# Restart containers
restart() {
    print_header "🔄 Restarting $PROJECT"
    check_docker
    docker-compose restart
    print_success "Containers restarted!"
}

# Run migrations
migrate() {
    print_header "📦 Running Migrations"
    check_docker
    docker-compose exec -T app php artisan migrate --force
    print_success "Migrations complete!"
}

# Run seeders
seed() {
    print_header "🌱 Running Seeders"
    check_docker
    docker-compose exec -T app php artisan db:seed --force
    print_success "Seeding complete!"
}

# Fresh migrations with seed
fresh() {
    print_header "🗑️  Fresh Migrations"
    check_docker
    
    print_warning "This will DROP ALL TABLES and re-run migrations!"
    read -p "Are you sure? (y/N): " confirm
    if [ "$confirm" != "y" ] && [ "$confirm" != "Y" ]; then
        echo "Cancelled."
        exit 0
    fi
    
    docker-compose exec -T app php artisan migrate:fresh --seed --force
    print_success "Fresh migrations complete!"
}

# Show logs
logs() {
    print_header "📋 Container Logs"
    check_docker
    docker-compose logs -f
}

# Open shell
shell() {
    print_header "🐚 Opening Shell"
    check_docker
    docker-compose exec app bash
}

# Show status
status() {
    print_header "📊 Container Status"
    check_docker
    docker-compose ps
}

# Clean everything
clean() {
    print_header "🧹 Cleaning $PROJECT"
    check_docker
    
    print_warning "This will remove ALL containers, volumes, and networks!"
    read -p "Are you sure? (y/N): " confirm
    if [ "$confirm" != "y" ] && [ "$confirm" != "Y" ]; then
        echo "Cancelled."
        exit 0
    fi
    
    docker-compose down -v --remove-orphans --rmi local
    print_success "Cleanup complete!"
}

# Main script
case "${1:-help}" in
    build)
        build
        ;;
    rebuild)
        rebuild
        ;;
    start)
        start
        ;;
    stop)
        stop
        ;;
    restart)
        restart
        ;;
    update)
        update
        ;;
    migrate)
        migrate
        ;;
    seed)
        seed
        ;;
    fresh)
        fresh
        ;;
    logs)
        logs
        ;;
    shell)
        shell
        ;;
    status)
        status
        ;;
    clean)
        clean
        ;;
    help|*)
        show_help
        ;;
esac

