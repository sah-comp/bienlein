Cinnebar
========

Boilerplate for web application development with PHP.

Features
--------

* Multilingual
* Role based access control
* CMS

Installation
------------

Create a database.

Copy the _config.examle.php_ in app/config and name it config.php.

Open it with a text editor and make changes as you fancy, e.g. enter the login information for the database(s) used. Do not forget to choose a install passcode that is not the default one.

In your project directory do:

composer install

Create these folders and make them writeable to PHP:
* public/upload
* app/res/tpl/cache

Point your browser to http://example.com/install and follow the instructions.

Start writing template, models and controllers until you have a shiny new application handy.


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

Do a composer self-update from time to time.

RedBeanPHP
----------

I enjoy [RedBeanPHP](http://redbeanphp.com/) as a ORM.

Note: Cinnebar uses RedBeanPHP Version 3.5.1 for now. The current dev-master will be loaded via composer. The 3.5 version used by cinnebar is required by index.php from /lib/redbean/rb.php.


Tests
-----

Make a copy of _setup.example.php_ in tests/ and name it setup.php. Open that file and edit the login information for a test database. Do _not_ use your production database for testing, because the database will be nuked before testing.

I use [PHPUnit](http://phpunit.de/).

On your command line do this to run all tests:

cd /path/to/project/tests

../vendor/bin/phpunit .

Website
-------

Feel free to visit [sah-company.com](http://sah-company.com). Nothing there, though.

Todo
----

* Write complete documentation for installation