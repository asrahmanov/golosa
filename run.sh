#!/bin/bash

# Голоса Единства - Docker Build & Run Script
# ============================================
# Using Quay.io images (NO Docker Hub rate limits!)

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

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

setup_env() {
    print_warning "Setting up .env for Docker..."
    cat > .env << 'ENVEOF'
APP_NAME="Голоса Единства"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8080

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=golosa_edinstva
DB_USERNAME=golosa
DB_PASSWORD=golosa_secret_2024

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
ENVEOF
    print_success ".env configured for Docker"
}

# Execute artisan command in container
artisan() {
    docker-compose exec -T app php /var/www/html/artisan "$@" 2>/dev/null || \
    docker-compose exec -T app bash -c "cd /var/www/html && php artisan $*"
}

build() {
    print_header "🏗️  Building $PROJECT"
    
    check_docker
    setup_env
    
    echo "Pulling images from Quay.io (no rate limits)..."
    docker-compose pull db 2>/dev/null || true
    
    echo "Building application container..."
    docker-compose build --no-cache
    
    echo "Starting containers..."
    docker-compose up -d
    
    echo "Waiting for PostgreSQL to be ready..."
    sleep 10
    for i in {1..30}; do
        if docker-compose exec -T db pg_isready -U golosa -d golosa_edinstva > /dev/null 2>&1; then
            print_success "PostgreSQL is ready!"
            break
        fi
        echo "Waiting for PostgreSQL... ($i/30)"
        sleep 2
    done
    
    echo "Installing Composer dependencies..."
    docker-compose exec -T app bash -c "cd /var/www/html && composer install --no-interaction --prefer-dist --optimize-autoloader"
    
    echo "Generating application key..."
    artisan key:generate --force
    
    echo "Running migrations..."
    artisan migrate --force
    
    echo "Running seeders..."
    artisan db:seed --force
    
    echo "Clearing caches..."
    artisan config:clear || true
    artisan cache:clear || true
    artisan view:clear || true
    
    print_header "✅ Build Complete!"
    echo -e "${GREEN}Application:${NC} http://localhost:8080"
    echo ""
    echo -e "Database credentials:"
    echo -e "  Host: localhost:5432"
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
    build
}

update() {
    print_header "⚡ Quick Update"
    check_docker
    
    git pull 2>/dev/null || print_warning "Not a git repo"
    docker-compose exec -T app bash -c "cd /var/www/html && composer install --no-interaction"
    artisan migrate --force
    artisan config:clear || true
    artisan cache:clear || true
    artisan view:clear || true
    
    print_success "Update complete!"
}

start() {
    print_header "▶️  Starting $PROJECT"
    check_docker
    docker-compose up -d
    print_success "Started! http://localhost:8080"
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
    artisan migrate --force
    print_success "Done!"
}

seed() {
    print_header "🌱 Running Seeders"
    check_docker
    artisan db:seed --force
    print_success "Done!"
}

fresh() {
    print_header "🗑️  Fresh Migrations"
    check_docker
    
    print_warning "This will DROP ALL TABLES!"
    read -p "Are you sure? (y/N): " confirm
    [ "$confirm" != "y" ] && [ "$confirm" != "Y" ] && echo "Cancelled." && exit 0
    
    artisan migrate:fresh --seed --force
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
