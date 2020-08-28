FROM php:latest

RUN apt-get update && apt-get install -y libzip-dev zlib1g-dev chromium && docker-php-ext-install zip
ENV PANTHER_NO_SANDBOX 1
# Not mandatory, but recommended
ENV PANTHER_CHROME_ARGUMENTS='--disable-dev-shm-usage'