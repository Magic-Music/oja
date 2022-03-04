Code challenge
==============

Task
----
Implement a user registration page with an appropriate styling that takes the following
details from the user:

• Email (mandatory)

• Password (mandatory, min of 8 characters, must be a combination of uppercase
letter, lowercase letter and a number)

• Name (optional)

• Postcode (optional)

Implement an API in PHP that takes in the user details mentioned above and persists in local
memory.

The PHP service should expose the endpoints to return the details of all the registered users
and a specific user based on some key.

Notes
-----
• Include clear instructions about how to run the application for testing purpose

• Please ensure that your solution is properly tested and is of production quality

• You can either share a repository link with the solution or send a zip file

• Please document any relevant information or assumptions you make along the way


To install, run and test:

• Clone the repository
• Run `composer install`
• Copy `.env.example` to `.env`
• Create a database file `touch database/database.sqlite`
• Set up the database `php artisan migrate --seed`

To run the tests `php artisan test`

To run the web page `php artisan serve` and visit `127.0.0.1:8000` in your browser


Assumes that email address must be unique
