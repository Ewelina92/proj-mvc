<p align="center">
[![Build Status](https://travis-ci.org/Ewelina92/proj-mvc.svg?branch=main)](https://travis-ci.org/Ewelina92/proj-mvc)
</p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About my project

This is the final project for the course MVC at BTH Spring 2021. It is a simple ToDo-application, where you first have to register in order to log in since you are only granted access to the log in and register pages before authentication. When logged in, you can see all your pending and finished task. You can add new tasks, update current tasks, delete current task or mark current tasks as finished. When you're logged in, the option to log out becomes available.

Since this is a final project for school, right now there are two accounts available to provide an easy and quick overlook of the functionality.

## Installation

In order to make this project work after downloading the repository make sure to run composer install to have all necessary dependencies, and make sure you have an .env-file with a database connection. There is a local testing environment connected to the Makefile, look inside it for available command-line commands, but I recommend "make clean-all" for a total nuke of the environment, "make install" for setting it all up again (composer install is integrated in this command) and "make test" for running available tests from e.g. phpunit and phpstan.

## Project created using Laravel

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

Documentation can be found [here](https://laravel.com/docs), or at [Laracasts](https://laracasts.com).