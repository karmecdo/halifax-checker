# Halifax Online Banking Automation

`This is currently a work in progress`

# Installation

Clone the repository and run `composer install`

Add login information to the .env
```
HALIFAX_USERNAME=jsmith
HALIFAX_PASSWORD=CorrectHorseBatteryStaple
HALIFAX_MEMORABLE_INFORMATION=Hogwarts
```

# Usage

Run `php artisan dusk`

A screen shot of the My Accounts page will be saved in `tests/Browser/screenshots/HomePage.png`
