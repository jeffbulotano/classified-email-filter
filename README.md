# Shorturl

Classified Email Filter is a web application built with Laravel. It is developed as an API microservice. It's main use is to detect and mask any classified words and phrases in an email body.

## Installation

Clone the repo and enter the directory:

```
git clone git@github.com:jeffbulotano/classified-email-filter.git classified-email-filter

cd classified-email-filter
```

Install packages:

```
composer install
```

or if you don't need dev dependencies:

```
composer install --no-dev
```

Copy sample environment file:

```
cp .env.example .env
```

Create an app key:

```
php artisan key:generate
```

Your app is now ready!

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
