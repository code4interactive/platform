### Working With Result Sets

- [Introduction](#introduction)
- [Generating Results](#generating-results)
- [Sorting Results](#sorting-results)
- [Switching Pages](#switching-pages)
- [Filter Results](#filter-results)
- [Paginating Results](#paginating)

<a name="introduction"></a>
#### Introduction

After instantiating a Data Grid object you have a couple of options to work with the data result sets. Depending on the request provider which you registered with your environment, the implementation of these methods can differ. In the examples below we're going to assume you're using the default `Cartalyst\DataGrid\RequestProviders\NativeProvider` request provider.

You can filter results by sending specific request parameters along with your HTTP request. Your request provider will catch these so your data handler can filter the data based on these request parameters.

<a name="generating-results"></a>
#### Generating Results

You can convert the result set from the Data Grid object to an array or JSON response by calling the `toArray` or `toJson` functions.

	$environment = new Cartalyst\DataGrid\Environment;
	$dataGrid = $environment->make($data, $columns);

	// Retrieve the result set as an array.
	$array = $dataGrid->toArray();

	// Retrieve the result set as a JSON response.
	$json = $dataGrid->toJson();

The returned response would look something like this:

	{
		"total_count": 3,
		"filtered_count": 3,
		"page": 1,
		"pages_count": 1,
		"previous_page": null,
		"next_page": null,
		"per_page": 3,
		"results": [
			{
				"name": "John Doe",
				"age": 22,
				"location": "New York"
			},
			...
		]
	}

The response contains some useful information like the total number of results, the amount of filtered results, the current, previous and next page and a list with all of the results for the current page.

> **Note:** When sending the Data Grid object to the browser, it will be automatically converted to a JSON response. This is very useful, for example, when building APIs.

<a name="sorting-results"></a>
#### Sorting Results

You can sort the result set by sending a request parameter with the `sort` key.

	http://example.com/search?sort=name

This will sort the results by name.

Reverting the sorted results can be done by sending a request parameter with the `direction` key.

	http://example.com/search?sort=name&direction=desc

Now the results will be sorted descended by name.

<a name="switching-pages"></a>
#### Switching Pages

Changing the page in a result set can be done by sending a request parameter with the `page` key.

	http://example.com/search?page=2

This would show the results on the second page of the result set.

<a name="filter-results"></a>
#### Filter Results

You can filter results by sending a request parameter with the `filters` key. The filters request parameter must provide filters based as a key (column) and value (column value) array.

For example:

	http://testing.loc/search?filters[name]=foo&filters[age]=24

This would show only results which have a foo name and an age of 24.

<a name="paginating-results"></a>
#### Paginating Results

There are three request parameters you can use to paginate a result set: `threshold`, `dividend` and `throttle`.

`threshold` is the number of results before pagination is applied to the result set. For example: if you set this to 5 then only when there are more than 5 results, pagination would be applied. The default for this parameter is 100.

`dividend` is the ideal number of pages you want to have for your result set. If you set this, for example, to 5 and the number of results is greater then the `threshold` the data handler will try to create a paginated result set with a maximum of 5 pages. The amount of results / page is calculated by dividing the total results with the `dividend`. the default value for this parameter is 10.

`throttle` is the maximum amount of results you wish to display on a single page. Should the amount of results for each page be greater than this number, a new amount of results / page will be calculated by diving the `threshold` with the `dividend`. This means that the amount of pages can be greater than set by `dividend`. The default value for this parameter is 100.

An example of these request parameters can be:

	http://example.com/search?threshold=5&dividend=10&throttle=100

In this example, the data handler will start paginating the results when there are more than 5 results. When there are less than 100 results, pagination will be created with 10 pages containing a number of results for each page based on dividing the total number of results by 10 (`dividend`). Should there be more than 100 results, the amount of results would be limited by 100 and the amount of results for each page would be calculated by dividing the `throttle` with the `dividend`.
