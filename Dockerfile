# ------------------------------
# Stage 1: Frontend Build (Node)
# ------------------------------
FROM node:20-alpine as frontend
WORKDIR /app
COPY package*.json vite.config.js ./
RUN npm ci
COPY resources ./resources
# Build assets (output goes to public/build)
RUN npm run build

# ------------------------------
# Stage 2: Backend Dependencies
# ------------------------------
FROM composer:2 as backend
WORKDIR /app
COPY composer.json composer.lock ./
# Install dependencies (no dev tools, optimized)
RUN composer install --no-dev --ignore-platform-reqs --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# ------------------------------
# Stage 3: Final Production Image
# ------------------------------
FROM webdevops/php-nginx:8.2
WORKDIR /app

# Environment variables for the image
ENV WEB_DOCUMENT_ROOT=/app/public
ENV PHP_DISPLAY_ERRORS=0
ENV PHP_MEMORY_LIMIT=512M
ENV PHP_MAX_EXECUTION_TIME=300

# Copy backend dependencies
COPY --from=backend /app/vendor /app/vendor

# Copy frontend assets
COPY --from=frontend /app/public/build /app/public/build

# Copy application code (excluding ignored files via .dockerignore)
COPY . /app

# Create the startup script
COPY docker-start.sh /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container

# Fix permissions initially (for static files)
RUN chown -R application:application /app

EXPOSE 80

# Use our custom start script
CMD ["/usr/local/bin/start-container"]