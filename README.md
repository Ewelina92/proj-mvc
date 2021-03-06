## Build Status
### Scrutinizer CI [![Build Status](https://scrutinizer-ci.com/g/Ewelina92/proj-mvc/badges/build.png?b=main)](https://scrutinizer-ci.com/g/Ewelina92/proj-mvc/build-status/main) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Ewelina92/proj-mvc/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/Ewelina92/proj-mvc/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/Ewelina92/proj-mvc/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/Ewelina92/proj-mvc/?branch=main)
### Travis CI [![Build Status](https://travis-ci.com/Ewelina92/proj-mvc.svg?branch=main)](https://travis-ci.com/Ewelina92/proj-mvc)


## About my project

This is the final project for the course MVC at BTH Spring 2021. It is a simple ToDo-application, where you first have to register in order to log in since you are only granted access to the log in and register pages before authentication. When logged in, you can see all your pending and finished task. You can add new tasks, update current tasks, delete current tasks or mark current tasks as finished. When you're logged in, the option to log out becomes available.

Since this is a final project for school, right now there are two accounts available to provide an easy and quick overlook of the functionality.

## Installation

In order to make this project work after downloading the repository make sure to run composer install to have all necessary dependencies, and make sure you have an .env-file with a database connection. There is a local testing environment connected to the Makefile, look inside it for available command-line commands, but I recommend "make clean-all" for a total nuke of the environment, "make install" for setting it all up again (composer install is integrated in this command) and "make test" for running available tests from e.g. phpunit and phpstan. To make sure you have the correct tables in your database, run "php artisan migrate", or run "php artisan migrate --seed" for also filling the database with example data. Consult Laravels documentation for more helpful terminal commands.

Navigate to the public folder using a webserver of your choice to see the application.

## Screenshot of the application

<p align="center">
<img src="https://raw.githubusercontent.com/Ewelina92/proj-mvc/main/readmeimage.png" alt="screenshot"></a>
</p>

## Project created using Laravel

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

Documentation can be found [here](https://laravel.com/docs), or at [Laracasts](https://laracasts.com).
