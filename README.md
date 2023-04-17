# Menu MKR API

## Set up the project

Clone the project

```
git clone git@github.com:mpont91/menumkr-api.git
```

Go to project directory

```
cd menumkr-api
```

Install dependencies with docker

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

Copy the configuration

```
cp .env.example .env
```

Run the application with docker sail

```
sail up
```
