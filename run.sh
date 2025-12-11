#!/bin/bash

# Голоса Единства - Docker Build & Run Script
# ============================================

set -e

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

PROJECT="Голоса Единства"

print_header() {
    echo ""
    echo -e "${BLUE}═══════════════════════════════════════════════════════════${NC}"
    echo -e "${BLUE}  $1${NC}"
    echo -e "${BLUE}═══════════════════════════════════════════════════════════${NC}"
    echo ""
}

print_success() { echo -e "${GREEN}✓ $1${NC}"; }
print_warning() { echo -e "${YELLOW}⚠ $1${NC}"; }
print_error() { echo -e "${RED}✗ $1${NC}"; }

show_help() {
    echo ""
    echo -e "${BLUE}$PROJECT - Docker Management Script${NC}"
    echo ""
    echo "Usage: ./run.sh [command]"
    echo ""
    echo "Commands:"
    echo "  build       - Full build with migrations and seed"
    echo "  rebuild     - Complete rebuild from scratch"
    echo "  start       - Start containers"
    echo "  stop        - Stop containers"
    echo "  restart     - Restart containers"
    echo "  update      - Quick update (migrations + cache clear)"
    echo "  migrate     - Run migrations only"
    echo "  seed        - Run seeders only"
    echo "  fresh       - Fresh migrations with seed"
    echo "  logs        - Show container logs"
    echo "  shell       - Open shell in app container"
    echo "  status      - Show container status"
    echo "  clean       - Remove all containers and volumes"
    echo "  help        - Show this help"
    echo ""
}

check_docker() {
    if ! docker info > /dev/null 2>&1; then
        print_error "Docker is not running. Please start Docker first."
        exit 1
    fi
}

check_ssl() {
    if [ ! -f "./ssl/golosa-edinstva.ru.crt" ] || [ ! -f "./ssl/golosa-edinstva.ru.key" ]; then
        print_error "SSL certificates not found!"
        echo ""
        echo "Please add SSL certificates to the ssl/ folder:"
        echo "  - ssl/golosa-edinstva.ru.crt"
        echo "  - ssl/golosa-edinstva.ru.key"
        echo ""
        exit 1
    fi
    print_success "SSL certificates found"
}

setup_env() {
    print_warning "Setting up .env for Docker..."
    cat > .env << 'ENVEOF'
APP_NAME="Голоса Единства"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://golosa-edinstva.ru

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=golosa_edinstva
DB_USERNAME=golosa
DB_PASSWORD=golosa_secret_2024

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

SESSION_SECURE_COOKIE=true
ENVEOF
    print_success ".env configured for Docker (HTTPS)"
}

build() {
    print_header "🏗️  Building $PROJECT"
    
    check_docker
    check_ssl
    setup_env
    
    echo "Building Docker images..."
    docker-compose build --no-cache
    
    echo "Starting containers..."
    docker-compose up -d
    
    echo "Waiting for PostgreSQL to be ready..."
    sleep 5
    for i in {1..30}; do
        if docker-compose exec -T db pg_isready -U golosa -d golosa_edinstva > /dev/null 2>&1; then
            print_success "PostgreSQL is ready!"
            break
        fi
        echo "Waiting for PostgreSQL... ($i/30)"
        sleep 2
    done
    
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
    docker-compose exec -T app chown -R www-data:www-data /var/www/html/bootstrap/cache
    docker-compose exec -T app chmod -R 775 /var/www/html/bootstrap/cache
    
    echo "Clearing caches..."
    docker-compose exec -T app php artisan config:clear
    docker-compose exec -T app php artisan cache:clear
    docker-compose exec -T app php artisan view:clear
    
    print_header "✅ Build Complete!"
    echo -e "${GREEN}Application (HTTPS):${NC} https://golosa-edinstva.ru"
    echo -e "${GREEN}Application (HTTP):${NC}  http://golosa-edinstva.ru (redirect to HTTPS)"
    echo -e "${GREEN}Adminer (DB):${NC}        http://localhost:8081"
    echo ""
    echo -e "Database credentials:"
    echo -e "  Server: db"
    echo -e "  User: golosa"
    echo -e "  Password: golosa_secret_2024"
    echo -e "  Database: golosa_edinstva"
    echo ""
}

rebuild() {
    print_header "🔄 Rebuilding $PROJECT"
    check_docker
    
    print_warning "This will remove all containers, volumes, and rebuild!"
    read -p "Are you sure? (y/N): " confirm
    [ "$confirm" != "y" ] && [ "$confirm" != "Y" ] && echo "Cancelled." && exit 0
    
    docker-compose down -v --remove-orphans
    docker-compose rm -f
    build
}

update() {
    print_header "⚡ Quick Update"
    check_docker
    
    git pull 2>/dev/null || print_warning "Not a git repo"
    docker-compose exec -T app composer install --no-interaction --prefer-dist --optimize-autoloader
    docker-compose exec -T app php artisan migrate --force
    docker-compose exec -T app php artisan config:clear
    docker-compose exec -T app php artisan cache:clear
    docker-compose exec -T app php artisan view:clear
    
    print_success "Update complete!"
}

start() {
    print_header "▶️  Starting $PROJECT"
    check_docker
    docker-compose up -d
    print_success "Started! https://golosa-edinstva.ru"
}

stop() {
    print_header "⏹️  Stopping $PROJECT"
    check_docker
    docker-compose down
    print_success "Stopped!"
}

restart() {
    print_header "🔄 Restarting $PROJECT"
    check_docker
    docker-compose restart
    print_success "Restarted!"
}

migrate() {
    print_header "📦 Running Migrations"
    check_docker
    docker-compose exec -T app php artisan migrate --force
    print_success "Done!"
}

seed() {
    print_header "🌱 Running Seeders"
    check_docker
    docker-compose exec -T app php artisan db:seed --force
    print_success "Done!"
}

fresh() {
    print_header "🗑️  Fresh Migrations"
    check_docker
    
    print_warning "This will DROP ALL TABLES!"
    read -p "Are you sure? (y/N): " confirm
    [ "$confirm" != "y" ] && [ "$confirm" != "Y" ] && echo "Cancelled." && exit 0
    
    docker-compose exec -T app php artisan migrate:fresh --seed --force
    print_success "Done!"
}

logs() { check_docker; docker-compose logs -f; }
shell() { check_docker; docker-compose exec app bash; }
status() { check_docker; docker-compose ps; }

clean() {
    print_header "🧹 Cleaning $PROJECT"
    check_docker
    
    print_warning "This will remove ALL containers and volumes!"
    read -p "Are you sure? (y/N): " confirm
    [ "$confirm" != "y" ] && [ "$confirm" != "Y" ] && echo "Cancelled." && exit 0
    
    docker-compose down -v --remove-orphans --rmi local
    print_success "Cleaned!"
}

case "${1:-help}" in
    build) build ;;
    rebuild) rebuild ;;
    start) start ;;
    stop) stop ;;
    restart) restart ;;
    update) update ;;
    migrate) migrate ;;
    seed) seed ;;
    fresh) fresh ;;
    logs) logs ;;
    shell) shell ;;
    status) status ;;
    clean) clean ;;
    *) show_help ;;
esac
