# Weighter

This is a super simple app that tracks weight, daily–if you wish.

Its been through many iterations over the years, mostly to experiment with different technologies. In the current form, it's a handful of HTML pages with PHP. Very basic.

## Setup

A simple database table is required. A [script for MySQL](create-weights.sql) is included in this repo, but other relational database systems will work too.

A config.php file is required. An example is included. Rename config-example.php to config.php and set the database parameters as needed. See [PHP PDO::__construct](https://www.php.net/manual/en/pdo.construct.php) for a through explanation of the data source name.

There's a simple username/password scheme here. Set them both along with your server's domain in the config file. Logins are saved as cookies for 90 days.