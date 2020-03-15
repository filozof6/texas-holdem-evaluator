Texas Hold'em Poker
===============

A Symfony project created on March 13, 2020, 5:13 pm.


## Installation

```
cd /path/to/project/root

composer install
php bin/console doctrine:database:create
php bin/console doctrine:schema:create
```


## Usage
Password for commands: `123456`

### Import data to database
```
cd /path/to/project/root
php bin/console app:upload-rounds /path/to/file/hands.txt
```

### Get total wins by player id
```
cd /path/to/project/root
php bin/console app:show-wins 1
```

### Running tests
```
cd /path/to/project/root
vendor/bin/phpunit --bootstrap vendor/autoload.php tests/AppBundle/Services/Poker
```