@extends('platform::layout')

@section('header')
Lista użytkowników
@stop

@section('content')

<form method="post" action="" accept-charset="utf-8" data-search data-grid="main">
    <input name="filter" type="text" placeholder="Filter All">
    <select name="column" class="hidden-select"> <option value="all">All</option> <option value="subdivision">Subdivision</option> <option value="city">City</option> </select>
    <button>Add Filter</button>
</form>


<div class="pagination" data-grid="main">

    <a data-template data-if-infinite href="#" class="goto-page" data-page="[[ page ]]">
        Load More
    </a>
    <a data-template data-if-throttle href="#" class="goto-page throttle" data-throttle>
        More
    </a>
    <a data-template href="#" data-page="[[ page ]]" class="goto-page [? if active ?]active[? endif ?]">
        [[ pageStart ]] - [[ pageLimit ]]
    </a>
</div>

<ul class="pagination" data-grid="main">
    <li data-template data-if-infinite data-page="[[ page ]]">Load More</li>
    <li data-template data-if-throttle data-throttle>[[ label ]]</li>
    <li data-template data-page="[[ page ]]">[[ pageStart ]] - [[ pageLimit ]]</li>
    <li data-template data-page="[[ page ]]" >[[ nextPage ]]</li>
</ul>



<ul class="applied" data-grid="main">
    <li data-template>
        [? if column === undefined ?]
        [[ valueLabel ]]
        [? else ?]
        [[ valueLabel ]] in [[ columnLabel ]]
        [? endif ?]
    </li>
</ul>



<div class="row-fluid">
    <h3 class="header smaller lighter blue"></h3>
    <div class="table-header">
        Results for "Latest Registered Domains"
    </div>

    <div class="row-fluid">
        <div class="span6">
            <div id="table_report_length" class="dataTables_length">
                <label>Display
                    <select size="1" name="table_report_length" aria-controls="table_report">
                        <option value="10" selected="selected">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select> records</label>
            </div>
        </div>
        <div class="span6">
            <div class="dataTables_filter" id="table_report_filter">
                <label>Search: <input type="text" aria-controls="table_report"></label>
            </div>
        </div>
    </div>

    <table id="table_report" class="table table-striped table-bordered table-hover results" data-grid="main" data-source="/dataSrc">
        <thead>
        <tr>
            <th data-sort="id" data-grid="main" class="sortable sorting">Id</th>
            <th data-sort="konto" data-grid="main" class="sortable">Konto</th>
            <th data-sort="opis" data-grid="main" class="sortable">Opis</th>
            <th></th>
        </tr>
        </thead>


        <tbody>
        <tr data-template>
            <td>[[ id ]]</td>
            <td>[[ konto ]]</td>
            <td>[[ opis ]]</td>
            <td class="td-actions">
                <div class="hidden-phone visible-desktop btn-group">
                    <button class="btn btn-mini btn-success">
                        <i class="icon-ok bigger-120"></i>
                    </button>

                    <button class="btn btn-mini btn-info">
                        <i class="icon-edit bigger-120"></i>
                    </button>

                    <button class="btn btn-mini btn-danger">
                        <i class="icon-trash bigger-120"></i>
                    </button>

                    <button class="btn btn-mini btn-warning">
                        <i class="icon-flag bigger-120"></i>
                    </button>
                </div>

                <div class="hidden-desktop visible-phone">
                    <div class="inline position-relative">
                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-caret-down icon-only bigger-120"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
                            <li>
                                <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit" data-placement="left">
																<span class="green">
																	<i class="icon-edit"></i>
																</span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="tooltip-warning" data-rel="tooltip" title="Flag" data-placement="left">
																<span class="blue">
																	<i class="icon-flag"></i>
																</span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete" data-placement="left">
																<span class="red">
																	<i class="icon-trash"></i>
																</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>

        <tr data-results-fallback style="display:none;">
            <td colspan="4">No Results</td>
        </tr>

        </tbody>
    </table>
    <div class="row-fluid">
        <div class="span6">
            <div class="dataTables_info" id="table_report_info" >Showing [[ pageStart ]] to [[ pageLimit ]] of [[ throttle ]] entries</div>
        </div>
        <div class="span6">



            <div class="dataTables_paginate paging_bootstrap pagination">
                <ul class="pagination" data-grid="main">
                    <li class="prev disabled"><a href="#"><i class="icon-double-angle-left"></i></a></li>

                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>

                    <li class="next"><a href="#"><i class="icon-double-angle-right"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>



@stop

@section('footer-scripts')

<script>
    $(function()
    {
        $.datagrid('main', '.results', '.pagination', '.applied', {
        loader: code4Loading,
        /*  sort: {
            column: 'city',
                direction: 'asc'
        },*/
        callback: function(obj){

            //Leverage the Callback to show total counts or filtered count
           // $('#filtered').val(obj.filterCount);
           // $('#total').val(obj.totalCount);

        }
    });
    });
</script>

@stop