@extends('platform::template.layout')

@section('header')
    <i class="icon-sitemap"></i>
404
    <small> Page Not Found</small>
@stop

@section('content')


<div class="row-fluid">
    <!--PAGE CONTENT BEGINS HERE-->

    <div class="error-container">
        <div class="well">
            <h1 class="grey lighter smaller">
                <span class="blue bigger-125">
                    <i class="icon-sitemap"></i>
                    404
                </span>
                Page Not Found
            </h1>

            <hr>
            <h3 class="lighter smaller">We looked everywhere but we couldn't find it!</h3>

            <div>
            <div class="row-fluid">
                <div class="center">
                    <a href="#" class="btn btn-grey">
                        <i class="icon-arrow-left"></i>
                        Go Back
                    </a>

                    <a href="#" class="btn btn-primary">
                        <i class="icon-dashboard"></i>
                        Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--PAGE CONTENT ENDS HERE-->
</div>

@stop


@section('footer-scripts')
@stop