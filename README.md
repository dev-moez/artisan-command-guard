<p align="center">
<img style="margin-left: auto; margin-right: auto" height="120" src="https://raw.githubusercontent.com/dev-moez/artisan-command-guard/main/assets/icons/icon.png">

<h1 align="center">Artisan Command Guard</h1>
<h4 align="center">  
 🛡️ Artisan command guard laravel package </h4>
</p>

## Table of contents
- <a href="#introduction">:book: Introduction</a>
- <a href="#installation">:toolbox: Installation</a>
- <a href="#configuration">:gear: Configuration</a>

## :book: Introduction
Artisan Command Guard is a Laravel package that prevents critical artisan commands to be run in production environment.

## :toolbox: Installation

You can install the package via composer:

```
composer require dev-moez/artisan-command-guard
```

The package will automatically register itself.

And to publish the config and the migration files needed for the package, run the following artisan command:
```
php artisan artisan-command-guard:install
```

Or Manually:


You can publish the config file using the following command:
```
php artisan vendor:publish --tag="artisan-command-guard-config"
```
This is the contents of the published config file:

```php
<?php

/**
 * An array of environments with the commands that you want to prevent running on
 */ 
return [
	'production' => [
		'migrate:refresh',
		'migrate:fresh',
		'migrate:reset',
	],
];


```


## :gear: Configuration

In the configuration file of the package `artisan-command-guard.php` you will find an array with production environment and the commands that you would like to prevent from running on production. Initially you will find three commands that I find dangerous to run on production:
- migrate:fresh
- migrate:refrest
- migrate:reset

You can add more commands or custom commands that you don't want to run in production env.
Also, you can set another environment and assign the commands that you would like to prevent from running - like done with `production`.

## Updating
Want to update to the latest version?
```
composer update dev-moez/artisan-command-guard
```

## Uninstallation
```
composer remove dev-moez/artisan-command-guard
```

## License

The MIT License (MIT).


## Contributing

Contributions are welcome! If you would like to contribute to the package with a new feature or any other enhancement, please fork the repository and submit a pull request.

1. Fork the Project
2. Create your feature branch (git checkout -b feature/new-feature-name)
3. Commit your changes (git commit -m 'Add and extra feature')
4. Push to the branch (git push origin feature/new-feature-name)
5. Open a pull request

And be sure that any contributions or comments you make are highly appreciated.


## Contact
Abdelrahman Moez (aka Moez) - abdelrahman.moez@icloud.com