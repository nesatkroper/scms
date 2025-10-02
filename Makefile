DEV_COMMAND := ./node_modules/.bin/concurrently --kill-others-on-fail -n "B,F" -c "blue,green" "php artisan serve --port=8102" "npm run dev" "bash -c 'while true; do sleep 1; done'"

.PHONY: dev git clear migrate m-seed

dev:
	@echo "================================================="
	@echo "🚀 Starting Development Environment..."
	@echo "-------------------------------------------------"
	@echo "--- 1. Starting PHP Artisan Server on port 8101 (B)..."
	@echo "--- 2. Starting Vite/NPM Dev Server (F)..."
	@echo "--- 3. Running concurrently..."
	@$(DEV_COMMAND)

git:
	@echo "================================================="
	@echo "💾 Running Git Workflow..."
	@echo "-------------------------------------------------"
	@echo "--- 1. Adding all changed and untracked files (git add .)..."
	git add .
	@echo "--- 2. Committing changes with message 'modified nun'..."
	git commit -m 'modified nun'
	@echo "--- 3. Pushing committed changes to remote repository (git push)..."
	git push
	@echo "================================================="
	@echo "✅ Git Workflow Complete."

clear:
	@echo "================================================="
	@echo "🚀 Clearing Laravel logs, cache, and fixing permissions..."
	@echo "-------------------------------------------------"
	@echo "--- 1. Running 'php artisan optimize:clear'..."
	@php artisan optimize:clear
	@echo "--- 2. Removing old log files..."
	@sudo rm -f storage/logs/*.log
	@echo "--- 3. Removing bootstrap cache files..."
	@sudo rm -rf bootstrap/cache/*.php
	@echo "--- 4. Changing ownership of storage/cache directories to $(USER)..."
	@sudo chown -R $(USER): storage bootstrap/cache
	@echo "--- 5. Setting read/write permissions (775) on storage/cache directories..."
	@sudo chmod -R 775 storage bootstrap/cache
	@echo "================================================="
	@echo "✅ Clear and Permissions Fix Complete."

migrate:
	@echo "================================================="
	@echo "🏗️  Running Migrations..."
	@php artisan migrate
	@echo "✅ Database Migrations Complete."

m-seed:
	@echo "================================================="
	@echo "🏗️  Running Migrations, Permissions, and Database Seeding..."
	@echo "-------------------------------------------------"
	@echo "--- 1. Running Database Migrations..."
	@php artisan migrate
	@echo "--- 2. Generating Permissions..."
	@php artisan permissions:generate
	@echo "--- 3. Seeding the Database..."
	@php artisan db:seed
	@echo "================================================="
	@echo "✅ Database Setup Complete."
