### Basics

- [Introduction](#introduction)
- [Loading An Environment](#loading-an-environment)
- [Registering Data Handlers](#registering-data-handlers)
- [Default Data Handlers](#default-data-handlers)
- [Creating Custom Data Handlers](#creating-custom-data-handlers)
- [Creating A Data Grid Object](#creating-a-data-grid-object)
- [Catching Unsupported Data Types]()

<a name="introduction"></a>
#### Introduction

Cartalyst's Data Grid package provides a couple of ways to interact with. The most basic way is to instantiate a new environment with the `Cartalyst\DataGrid\Environment` class and use Cartalyst's default built-in `Cartalyst\DataGrid\DataHandlers\CollectionHandler` for data handling.

After creating a Data Grid object you can use the registered data handler to interact with your result set.

<a name="loading-an-environment"></a>
#### Loading An Environment

Before you can use the Data Grid package you need to load a new environment first. This environment will determine which request provider it needs to instantiate for you to interact with. Natively it will load an instance of `Cartalyst\DataGrid\RequestProviders\NativeProvider`.

	$environment = new Cartalyst\DataGrid\Environment;

From here on out you can start working with the Data Grid package.

You can register your custom request provider by sending it along when instantiating a new environment.

	$provider = new CustomProvider;

	$environment = new Cartalyst\DataGrid\Environment($provider);

> **Note:** Make sure that your request provider implements `Cartalyst\DataGrid\RequestProviders\ProviderInterface`.

<a name="registering-data-handlers"></a>
#### Registering Data Handlers

Data handlers are essentially drivers which manipulate a data source and return the required data. You can register data handlers with your environment by using the `addDataHandlerMapping` function.

	$environment->addDataHandlerMapping('FooDataHandler', function($data)
	{
		return ($data instanceof FooData);
	});

Now whenever you pass along data which is an instance of `FooData` when instantiating the Data Grid, the package will know to use the `FooDataHandler` to handle the data.

Alternatively you can register your data handlers when loading an environment.

	$handlers => array(

		'FooDataHandler' => function($data)
		{
			return ($data instanceof FooData);
		},

		'BarDataHandler' => function($data)
		{
			return ($data instanceof BarData);
		},

	);

	$environment = new Cartalyst\DataGrid\Environment(null, $handlers);

<a name="default-data-handlers"></a>
#### Default Data Handlers

 Cartalyst's Data Grid package provides two data handlers by default. One of them is the `Cartalyst\DataGrid\DataHandlers\CollectionHandler` which provides support for arrays and `Illuminate\Support\Collection` objects.

If you'd like to use the `CollectionHandler` data handler you need to register it to your Data Grid environment.

	$environment->addDataHandlerMapping('Cartalyst\DataGrid\DataHandlers\CollectionHandler', function($data)
	{
		return (
			$data instanceof Illuminate\Support\Collection or
			is_array($data)
		);
	});

Now whenever you pass along an array of data or an `Illuminate\Support\Collection` object when instantiating the Data Grid, the package will know to use the `CollectionHandler` to handle the data.

> **Note:** When we're using examples in the documentation for Data Grid, we're going to assume you have registered the `CollectionHandler` data handler.

<a name="creating-custom-data-handlers"></a>
#### Creating Custom Data Handlers

In addition to register the default data handlers provided by the package, you can create your own custom data handlers as well. All data handlers need to extend the abstract `Cartalyst\DataGrid\DataHandlers\BaseHandler` class.

	use Cartalyst\DataGrid\DataHandlers\BaseHandler;
	use Cartalyst\DataGrid\DataHandlers\HandlerInterface;

	class CustomHandler extends BaseHandler implements HandlerInterface {

	}

Specific handlers can be created to handle specific sets of data like framework specific result sets or a certain service's API result responses.

<a name="creating-a-data-grid-object"></a>
#### Creating A Data-Grid Object

Creating a Data Grid object can be done by calling the `make` function on the Data Grid environment.

	$dataGrid = $environment->make($data, $columns);

Calling the `make` function will send back an instance of `Cartalyst\DataGrid\DataGrid`. The `$data` variable must contain all of the data you want to filter. This can be any sort of data type as long as it can be handled by your data handlers. The `$columns` variable must contain an array of all the columns for each data object to include in the result set.

The data provided can hold data objects of the following types:

- An array
- An object which is an instance of or extends the `stdClass` object
- An object which implements the `Illuminate\Support\ArrayableInterface` interface

A basic example of creating a Data Grid object could be:

	$object = new StdClass;
	$object->title = 'foo';
	$object->age = 20;

	$data = array(
		array(
			'title' => 'bar',
			'age'   => 34,
		),
		$object,
	);

	$dataGrid = $environment->make($data, array(
		'title',
		'age',
	));

Because we send in the data wrapped in an array, the Data Grid object will handle the data with the registered `CollectionHandler` Data Handler.

> **Note:** If a data object in the `$data` set doesn't has a column set in the `$columns` array, it will return `null` in the result set for that column.

You can also rename columns by defining them as a key/value pair with the originial name being the key and the new name being the value.

	$dataGrid = $environment->make($data, array(
		'title' => 'new_title_column_name',
		'age'   => 'new_age_column_name',
	));

<a name="creating-a-data-grid-instance"></a>
#### Catching Unsupported Data Types

When the Data Grid package can't find a Data Handler for the provided data, it will throw a `RuntimeException`[^1]. You can catch it by doing the following:

	try {
		$dataGrid = $environment->make($data, $columns);
	}
	catch (\RuntimeException $exception)
	{
		echo $exception->getMessage();
	}

[^1]: [PHP manual on the RuntimeException class](http://php.net/manual/en/class.runtimeexception.php)