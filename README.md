# Menu MKR API

## Setup the project

Clone the project from github

Install dependencies with docker

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

Copy the configuration

```
cp .env.example .env
```

Run the application with docker

```
sail up
```
