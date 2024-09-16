## Installation and usage

#### Create a database
create a db and import this file into it:
```shell
./docs/menu_api.sql
```

#### Config db
in this file:
```shell
./app/core/config.php
```
please enter the db connection info:
```php
define('DBNAME', 'menu_api');
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBDRIVER', '');
```

#### Run the app
```shell
php -S localhost:8000
```

#### Import postman collection
import this file into the postman and start working with api's !
```shell
./docs/menu_api.postman_collection.json
```