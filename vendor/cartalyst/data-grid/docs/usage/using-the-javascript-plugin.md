### Using The Javascript Plugin

- [Introduction](#introduction)
- [Requirements](#requirements)
- [Installing](#installing)
- [The HTML](#the-html)
- [The Javascript](#the-javascript)
- [Applying Filters & Sorting](#applying-filters-and-sorting)
- [Adding Search](#adding-search)
- [Resetting](#resetting)
- [Options](#options)

<a name="introduction"></a>
#### Introduction

One of our goals with Data Grid was to leave the front end HTML up to you, and avoid what most plugins do by keeping you within a container. We built a Javascript plugin (`data-grid.js`) that works together with the [Tempo](http://tempojs.com) rendering engine to allow you to easily built flexible data grids.

You can see a working demo of the plugin at [the demo page](http://demo.cartalyst.com/data-grid).

<a name="requirements"></a>
#### Requirements

Using `data-grid.js` requires the following:

- [Tempo](http://tempojs.com) v2.0.0 or later
- [jQuery](http://jquery.com/) v1.9.1 or later

<a name="installing"></a>
#### Installing

Add jQuery, Tempo and `data-grid.js` to the `<head>` section of your page.

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="//raw.github.com/twigkit/tempo/master/tempo.min.js"></script>
	<script src="/vendor/cartalyst/data-grid/src/public/js/data-grid.js"></script>

<a name="the-html"></a>
#### The HTML

Data Grid requires three elements for instantiation: a results container, pagination container and finally an applied filters container. Each of these containers will contain either one or many Tempo templates.

**Results Container**

	<table class="results" data-grid="main" data-source="http://example.com/api/v1/foo">
		<thead>
			<tr>
				<td>City</td>
				<td>Population</td>
			</tr>
		</thead>
		<tbody>
			<tr data-template>
				<td>[[ city ]]</td>
				<td>[[ population ]]</td>
			</tr>
		</tbody>
	</table>

The required `data-grid` attribute will allow you to create multiple Data Grids on a single page and the `results` class will mark it as the results container. The `data-source` attribute contains the API endpoint URI.

You might notice that the `[[ ... ]]` is different from the default Tempo brace syntax. This is needed to allow the use of `[? ... ?]`. You can always change this behaviour by changing the [plugin's options](#options).

**Pagination Container**

	<ul class="pagination" data-grid="main">
		<li data-template data-if-infinite data-page="[[ page ]]">Load More</li>
		<li data-template data-if-throttle data-throttle>[[ label ]]</li>
		<li data-template data-page="[[ page ]]">[[ pageStart ]] - [[ pageLimit ]]</li>
	</ul>

Because we're setting the same `data-grid` attribute, the plugin will know to group it with your results container. We use the `pagination` class to indicate it as the pagination container.

There are three templates that are used inside the pagination container. The `data-if-infinite` template will render only when the pagination type is set to `infinite`. The `data-if-throttle` template will render if a throttle is set and reached. The last template is the template used for the `multiple` pagination type.

As for the other attributes, the `data-page` attribute is where we store the current page. The `data-throttle` attribute is our selector for events to increase the throttle. By default we will use `pageStart` and `pageLimit` in our pagination template to indicate which results are displayed on each page. This would output to 1 - 10, 11 - 20, ...

**Filters Container**

	<ul class="applied" data-grid="main">
		<li data-template>
			[? if column == undefined ?]
				[[ valueLabel ]]
			[? else ?]
				[[ valueLabel ]] in [[ columnLabel ]]
			[? endif ?]
		</li>
	</ul>

We use our custom itteration of Tempo's brace syntax to build if else statements. We check for columns so you can display your filters in a readable manner. If your filter isn't filtering within a column it will just display the filter. If your filtering within a column we show both the filter and column.

<a name="the-javascript"></a>
#### The Javascript

Now that you have all of your templates setup, let's instantiate Data Grid. The first argument within the instantiation is the grid, this is the value of the `data-grid` attribute. This allows us you to have a flexible layout, and multiple Data Grids on a page. Next is the results container for the response, followed by the pagination container and finally the applied filters container.

	<script>
		$(function()
		{
			$.datagrid('main', '.results', '.pagination', '.applied');
		});
	</script>

Should you have placed the `data-source` attribute on the results container, the plugin will automatically know which URI to make it API calls to. You can also set the URI through [the plugin's options](#options).

After applying the plugin, you should get a nicely filled table with all of your data and pagination.

<a name="applying-filters-and-sorting"></a>
#### Applying Filters & Sorting

Lets go over how to set filters and sorts now that you have your Data Grid returning results. We use two attributes for setting filters and sorts, `data-filter` and `data-sort`. Both are done in key/value pairs separated by `, `. **Note the space after the comma, this is needed.** Filters and Sorts can be set on any element within site.

**Some filter examples:**

	<a href="#" data-filter="all:USA" data-grid="main">Filter USA</a>

This will filter the Data Grid of `main`, for anything matching USA.

	<a href="#" data-filter="state:Washington" data-grid="main">Filter Washington</a>

This will filter the Data Grid of `main`, for anything with a state of Washington

	<a href="#" data-filter="all:USA, state:Washington" data-grid="main">Filter USA by Washington State</a>

This will filter the Data Grid of `main`, for anything within the USA, and with a state of Washington.

**Some sort examples:**

	<a href="#" data-sort="city:asc" data-grid="main">Sort By City ASC</a>

This will sort the Data Grid of 'main', by City ASC.

	<a href="#" data-sort="city:desc" data-grid="main">Sort By City DESC</a>

This will sort the Data Grid of 'main', by City DESC.

From time to time, when using filters and sorts you will run into issues when your column names have underscores or something of that nature. Because of this we've created the data-label attribute to help you rewrite this for the user. The `data-label` works just like filters and sorts as in its a key/value pair, separated by `, `. **Again, note the whitespace after the comma.**

Heres a filter with a label fix.

	<a href="#" data-filter="country_code:USA" data-label="country_code:Country Code">Filter by Country Code</a>

<a name="adding-search"></a>
#### Adding Search

Data Grid ships with a few other things to help developers get off the ground faster. If you are looking to search within your data set, all you need to do is create a form and set the `data-grid` attribute and set `data-search`. Make sure the input name is set to filter.

	<form method="post" action="" accept-charset="utf-8" data-search data-grid="main">
		<input name="filter" type="text" placeholder="Filter All">
		<button>Add Filter</button>
	</form>

Now if you are looking for to let users filter within defined columns all you need to do is add a select menu within the form. The select name should be set to 'column' and the value of options set to the column name.

	<form method="post" action="" accept-charset="utf-8" data-search data-grid="main">
		<select name="column" class="input-medium">
			<option value="all">All</option>
			<option value="city">city</option>
			<option value="population">Population</option>
		</select>
		<input name="filter" type="text" placeholder="Filter All">
		<button>Add Filter</button>
	</form>

<a name="resetting"></a>
#### Resetting

If you want to give your users a simple way to reset Data Grid, just create a button, set the attributes `data-grid`  and `data-reset` and your done.

	<button data-reset data-grid="main">Reset</button>

<a name="options"></a>
#### Options

You can add plugin options by adding a fifth object parameter to your plugin instantiation.

	<script>
		$(function()
		{
			$.datagrid('main', '.results', '.pagination', '.applied',
			{
				source: 'http://example.com/api/v1/data-grid',
				sort: {
					column: 'city',
					direction: 'desc'
				},
				...
			});
		});
	</script>

Below is a list with all of the available options.

Option | Type | Description
------ | ---- | -----------
source | string | The API endpoint URI.
sort | object | Set a default column and direction for sorting.
threshold | integer | Minimum amount of results before pagination is applied.
dividend | integer | The maximum amount of pages you wish to have.
throttle | integer | The maxmim amount of results on a single page. Overrides dividend.
type | string | The type of pagination to use. Options are: "single", "multiple" and "infinite".
tempoOptions | object | Changes the surrounding braces. Data Grid's default is set to [[ ... ]].
loader | string | class of id of a loading element to be shown while the ajax request is made.
callback | function | This parameter you can pass a function that will run every time a filter is added, or a sort is applied. This function recives one argument, and gives you access to anyting set within the plugin.
