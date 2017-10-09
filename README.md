# twitter-birthday
[![Build Status](https://api.travis-ci.org/kokororin/twitter-birthday.svg)](https://travis-ci.org/kokororin/twitter-birthday)
[![Packagist](https://img.shields.io/packagist/dt/kokororin/twitter-birthday.svg?maxAge=2592000)](https://packagist.org/packages/kokororin/twitter-birthday)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg)](https://php.net/)

The Twitter API doesn't show user birthdays, but we can scrape the user profile page and parse out the birthday info.

## Installation
```bash
$ composer require kokororin/twitter-birthday:dev-master
```

## Usage
```php
$birthday = new TwitterBirthday('pile_eric');
echo $birthday['month']; // 5
echo $birthday['day']; // 2
```

## License

The MIT License (MIT).
