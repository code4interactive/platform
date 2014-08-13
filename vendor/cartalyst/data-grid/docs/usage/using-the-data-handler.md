### Using The Data Handler

- [Introduction](#introduction)
- [Retrieving Results](#retrieving-results)
- [Other Methods](#other-methods)

<a name="introduction"></a>
#### Introduction

The data handler is the class that handles and filters the data you passed along. In the examples below we'll go over the basic functionality for a data handler.

Accessing the registered data handler can be done by calling the `getDataHandler` method on the Data Grid object.

	$handler = $dataGrid->getDataHandler();

<a name="retrieving-results"></a>
#### Retrieving Results

You can retrieve the result set by calling the `getResults` method on the data handler.

	$results = $handler->getResults();

This will return an array with the result set after all the request parameters have been applied.

<a name="other-methods"></a>
#### Other Methods

Get the total amount of results.

	$totalCount = $handler->getTotalCount();

Get the total amount of filtered results.

	$filteredCount = $handler->getFilteredCount();

Get the current page.

	$page = $handler->getPage();

Get the number of pages.

	$pagesCount = $handler->getPagesCount();

Get the previous page.

	$previousPage = $handler->getPreviousPage();

Get the next page.

	$nextPage = $handler->getNextPage();

Get the number of results per page.

	$perPage = $handler->getPerPage();
