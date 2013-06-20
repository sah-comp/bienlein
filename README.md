Cinnebar
========

Layout for web development using PHPUnit, Flight, RedBeanPHP and Boilerplate stuff.

Todo
----

Write complete documentation for installation:

* Download from github
* Composer
* Database creation
* Setup virtual host
* Install controller


Features
--------

* Multilingual
* Role based access control

Installation
------------

Create a database.

Copy the _config.examle.php_ in app/config and name it config.php.

Open it with a text editor and make changes as you fancy, e.g. enter the login information for the database(s) used. Do not forget to choose a install passcode that is not the default one.

In your project directory do:

composer install

Point your browser to http://example.com/install and follow the instructions.

Start writing template, models and controllers until you have a shiny new application handy.


Docs
----

I have to write documentation and examples about helpers and conventions, maybe:

* Url::build
* Gravatar::src
* Flight::textile


Notes to self
-------------

The following is more of a note to myself.


Composer
--------

I use [Composer](http://getcomposer.org/).

The following requires you to have composer.phar installed and in your $PATH.
There must also already be a composer.json file in your project directory.

On your command line do this to install your project:

cd /path/to/project

composer install

On your command line do this to update your project:

cd /path/to/project

composer update

RedBeanPHP
----------

I enjoy [RedBeanPHP](http://redbeanphp.com/) as a ORM, so it is included as require-dev when you install via composer. Nevertheless the really used RedBeanPHP is in /src/lib/redbean because RedBeans composer does not offer a compiled version. Instead it offers a redbean.inc.php file which does not have all the stuff from the compiled version.


Tests
-----

Make a copy of _setup.example.php_ in tests/ and name it setup.php. Open that file and edit the login information for a test database. Do _not_ use your production database for testing, because the database will be nuked before testing.

I use [PHPUnit](http://phpunit.de/).

On your command line do this to run all tests:

cd /path/to/project/tests

../vendor/bin/phpunit .

Changing Foldernames?
---------------------

How to commit changes in upper-lower case folder- and filenaming?


Website
-------

Feel free to visit [sah-company.com](http://sah-company.com).