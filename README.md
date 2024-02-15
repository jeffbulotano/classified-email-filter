# Classified email filter

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

## Implementation

1. Prepare a form with two required input fields. One for the list of classified words/phrases and another for the email body.
2. Convert the form values to JSON with the following properties:
   2.1 classified_words_phrases - array of classified words and phrases (NOTE: it's possible to use text here, perhaps a comma separated list. Changes need to be done to the app if so.)
   2.2 email_text
3. On form submit, send a POST request to /api/filter-classified-email endpoint
4. Receive a JSON response with "is_classified" and "censored_text" properties.
5. Process the response accordingly.

ADDITIONAL NOTE: I understand that the API route is overkill for the use case. However, I decided to go this route for demonstration. To implement the solution to an existing system ClassifiedEmailService class can be copied and instantiated accordingly. Or, ClassifiedEmailService@filterClassifiedEmail method can be converted to a helper if needed.

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
