### Usage In Laravel 4

- [Introduction](#introduction)
- [Creating A Data Grid object](#creating-a-data-grid-object)
- [Working With The Query Builder](#working-with-the-query-builder)
- [Working With Eloquent](#working-with-eloquent)
- [Using Data Grid With Routes](#using-data-grid-with-routes)
- [Using Data Grid In Views](#using-data-grid-in-views)
- [Using With The Javascript Plugin](#using-with-the-javascript-plugin)

<a name="introduction"></a>
#### Introduction

Using Data Grid in Laravel 4 provides a much easier way of interaction. For instance, you don't need to load an environment, Laravel will load one for you. The default request provider that's being loaded in Laravel is the `Cartalyst\DataGrid\RequestProviders\IlluminateProvider` class. This class will use the `Illuminate\Http\Request` class to catch your request parameters.

By default, the package will register two built-in data handlers with Laravel, the `Cartalyst\DataGrid\DataHandlers\CollectionHandler` and the `Cartalyst\DataGrid\DataHandlers\DatabaseHandler`.

With these two data handlers you can send use the follow types of data.

**CollectionHandler**

- Illuminate Collection objects
- Arrays with data objects which could be:
	- An array
	- An object which is an instance of or extends the `stdClass` object
	- An object which implements the `Illuminate\Support\ArrayableInterface` interface

**DatabaseHandler**

- Queries
- Query results
- Eloquent Models & Relationships

> **Note:** You can register more data handlers by publishing and editing the config file. Read more about publishing the config file [here](/data-grid/installation/laravel-4).

<a name="creating-a-data-grid-object"></a>
#### Creating A Data Grid object

Creating a Data Grid object in Laravel 4 can be done in the same way as you do in native PHP except that you make use of the `DataGrid` alias.

	$dataGrid = DataGrid::make($data, $columns);

<a name="working-with-the-query-builder"></a>
#### Working With The Query Builder

Thanks to the default built-in database data handler, Cartalyst's Data Grid package can work with instances of many different database objects. One of them is `Illuminate\Database\Query\Builder`. You can pass along an instance of this class as a data source for your Data Grid and the data handler will extract the data from the query and prepares it as a result set.

For instance, if you'd like to use the data from the `users` table as a data source for your Data Grid.
	
	$query = DB::table('users')->where('age', '>', 20);

	$dataGrid = DataGrid::make($query, array(
		'name',
		'email',
		'address',
	));

This will create a Data Grid object with all of the users and the selected columns in the result set.

You can also pass along a query result set.

	$users = DB::table('users')->get();

	$dataGrid = DataGrid::make($users, array(
		'name',
		'email',
		'address',
	));

<a name="working-with-eloquent"></a>
#### Working With Eloquent

The built-in database data handler also enables you to pass along Eloquent objects as a data source.

- [Eloquent Models](#eloquent-models)
- [Eloquent Query Builder](#eloquent-query-builder)
- [Eloquent Results](#eloquent-results)
- [Eloquent Relationships](#eloquent-relationships)

<a name="eloquent-models"></a>
**Eloquent Models**

You can pass along an Eloquent model as a data source.

	$user = new User;

	$dataGrid = DataGrid::make($user, array(
		'name',
		'email',
		'address',
	));

This would retrieve all of the users and create a result set with them in the DataGrid object.

<a name="eloquent-query-builder"></a>
**Eloquent Query Builder**

You can also pass along an instance of the Eloquent query builder:

	$query = with(new User)->newQuery();

	$dataGrid = DataGrid::make($query, array(
		'name',
		'email',
		'address',
	));

<a name="eloquent-results"></a>
**Eloquent Results**

Besides models and the query builder, the `DatabaseHandler` data handler also accepts Eloquent results.

	$users = User::where('age', '>', 20)->get();

	$dataGrid = DataGrid::make($users, array(
		'name',
		'email',
		'address',
	));

<a name="eloquent-relationships"></a>
**Eloquent Relationships**

Eloquent relationships are also supported. Don't forget to call the relationship method instead of the property.

	$roles = User::find(1)->roles();

	$dataGrid = DataGrid::make($roles, array(
		'title',
		'level',
		'created_at',
	));

<a name="joining-tables"></a>
#### Joining Tables

Because we can pass along database query objects, we can also join tables together and get a combined result set from multiple tables. If you have duplicate column names after joining the tables you can create aliases for them in the columns array.

	$query = DB::query('cars')
		->join('manufacturers', 'cars.manufacturer_id', '=', 'manufacturers.id')
		->select('cars.*', 'manufacturers.name');

	$dataGrid = DataGrid::make($query, array(
		'manufacturers.name' => 'manufacturer_name',
		'name' => 'car_name',
		'year',
		'price',
	));

<a name="using-data-grid-with-routes"></a>
#### Using Data Grid With Routes

Because the Data Grid object will render the result set as a JSON response, you can use it to make API routes in your application. 

	Route::get('users', function()
	{
		$query = DB::table('users');

		return DataGrid::make($query, array(
			'name',
			'email',
			'address',
		));
	});

You can see at how a Data Grid result set looks like [here](/data-grid/usage/working-with-result-sets#generating-results).

<a name="using-data-grid-in-views"></a>
#### Using Data Grid In Views

Besides outputting the Data Grid object as JSON responses to work with APIs, you can also use them to build tabular data views for your application. Let's look at an extensive example.

First we'll register the route.

	Route::get('posts', function()
	{
		// Get all the posts from the database.
		$posts = Post::all();

		// Create a data grid object to list all posts
		// with their id, title and creation date.
		$dataGrid = DataGrid::make($posts, array('id', 'title', 'created_at'));

		// Get the data handler.
		$dataHandler = $dataGrid->getDataHandler();

		// If there are results, let's build the tabular data view.
		if ($results = $dataHandler->getResults())
		{
			// Get the amount of pages.
			$pagesCount = $dataHandler->getPagesCount();

			// Calculate the per page.
			$perPage = floor(count($posts) / $pagesCount);

			// Manually create pagination.
			$paginator = Paginator::make($results, count($posts), $perPage);

			// Build and output the view.
			return View::make('posts', compact('results', 'paginator'));
		}

		return 'No posts found.';
	});

Now let's create the `posts` view.

	<table>
		<thead>
			<tr>
				<th>#</th>
				<th>Title</th>
				<th>Created at</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($results as $result)
			<tr>
				@foreach ($result as $value)
				<td>{{ $value }}</td>
				@endforeach
			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $paginator->links() }}

This will build you a nice overview table with your tabular data. Notice that we've manually created an instance of the `Paginator` class with the data from our data handler. If you change the pages on the paginator, the table should page through the list of records automatically because your request provider will catch the `page` request parameter.

<a name="using-with-the-javascript-plugin"></a>
#### Using With The Javascript Plugin

Before you can use the Javascript plugin you have to publish the package's assets first.

	php artisan asset:publish cartalyst/data-grid

This will publish Data Grid's assets into `public/packages/cartalyst/data-grid` so you can link to them in your views.

You can read more about installing and using the Javascript plugin [here](/data-grid/usage/using-the-javascript-plugin).
