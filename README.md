# twitter-birthday

The Twitter API doesn't show user birthdays, but we can scrape the user profile page and parse out the birthday info.

## Installation
```bash
$ composer require kokororin/twitter-birthday:dev-master
```

## Usage
```php
$birthday = getTwitterBirthday('pile_eric');
echo $birthday->month; // 5
echo $birthday->day; // 2
```

## API

### getTwitterBirthday($screenName)

**Returns Object.**

## License

The MIT License (MIT).
