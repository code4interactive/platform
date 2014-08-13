### Install & Configure in Laravel 4

> **Note:** To use Cartalyst's Data Grid package you need to have a valid Cartalyst.com subscription.
Click [here](https://www.cartalyst.com/pricing) to obtain your subscription.

1. [Composer](#composer)
2. [Service Provider](#service-provider)
3. [Alias](#alias)
4. [Configuration](#configuration)

<a name="composer"></a>
#### 1. Composer

Open your `composer.json` file and add the following lines:

	{
		"require": {
			"cartalyst/data-grid": "1.0.*"
		},
		"repositories": [
			{
				"type": "composer",
				"url": "http://packages.cartalyst.com"
			}
		],
		"minimum-stability": "dev"
	}

> **Note:** The minimum-stability key is needed so that you can use the package (which isn't marked as stable, yet).

Run a composer update from the command line.

	php composer.phar update

<a name="service-provider"></a>
#### 2. Service Provider

Add the following to the list of service providers in `app/config/app.php`.

	'Cartalyst\DataGrid\DataGridServiceProvider',

<a name="alias"></a>
#### 3. Alias

Add the following to the to the list of class aliases in `app/config/app.php`.

	'DataGrid' => 'Cartalyst\DataGrid\Facades\DataGrid',

<a name="configuration"></a>
#### 4. Configuration

After installing, you can publish the package's configuration file into you application by running the following command:

	php artisan config:publish cartalyst/data-grid

This will publish the config file to `app/config/packages/cartalyst/data-grid/config.php` where you can modify the package configuration.
