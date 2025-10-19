# Laravel Sail Makefile
# Usage: make setup

.PHONY: setup

setup:
	@echo "Starting complete project setup..."
	@echo "Stopping and removing existing containers..."
	@./vendor/bin/sail down -v 2>/dev/null || echo "No containers to stop"
	@echo "Copying environment files..."
	@cp .env.example .env 2>/dev/null || echo ".env already exists"
	@cp .env.testing.example .env.testing 2>/dev/null || echo ".env.testing already exists"
	@echo "Installing PHP dependencies..."
	@composer install
	@echo "Starting Docker containers..."
	@./vendor/bin/sail up -d
	@echo "Waiting for database to be ready..."
	@sleep 15
	@echo "Generating application key..."
	@./vendor/bin/sail artisan key:generate --force
	@echo "Running database migrations and seeding..."
	@./vendor/bin/sail artisan migrate --seed --force
	@echo "Setting up testing database..."
	@./vendor/bin/sail artisan migrate --env=testing --force
	@echo "Installing Node.js dependencies..."
	@./vendor/bin/sail npm install
	@echo "Building frontend assets..."
	@./vendor/bin/sail npm run build
	@echo "Setup complete! Your application is ready."
	@echo "Application URL: http://test-task-devigma.test"
