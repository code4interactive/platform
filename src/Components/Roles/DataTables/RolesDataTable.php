<?php

namespace Code4\Platform\Components\Roles\DataTables;

use Code4\DataTable\DataTable;
use Code4\Platform\Models\Role;
use Carbon\Carbon;

class RolesDataTable extends DataTable
{
    protected $name = "roleList";

    protected $columns = [
        'id' => 'Id',
        'name' => ['title' => 'Nazwa', 'sort' => 'asc'],
        'slug' => 'Slug',
        'created_at' => 'Utworzony',
        'updated_at' => 'Ostatnio modyfikowany',
        'actions'  => ['title' => 'Akcje', 'orderable' => false, 'searchable' => false, 'width' => '60px']
    ];

    protected $cellDecorators = [
        'created_at' => ['FormatDateDecorator'],
        'updated_at' => ['FormatDateDecorator'],
        'actions' => ['buttons']
    ];

    protected $url = '/administration/roles/index';

    protected function getData($start, $length, $search, $orderCol, $orderDir) {

        return Role::where('name', 'like', '%'.$search.'%')
            ->orWhere('slug', 'like', '%'.$search.'%')
            ->skip($start)
            ->take($length)
            ->orderBy($orderCol, $orderDir)
            ->get();

    }

    protected function countAll() {
        return Role::count();
    }

    protected function buttonsDecorator($cell, $row) {
        return '<div class="pull-right">'.
                '<a href="/administration/roles/'.$row['id'].'/edit" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>&nbsp;'.
                '<a href="/administration/roles/'.$row['id'].'/delete" class="btn btn-xs btn-danger confirmDelete" data-name="'.$row['name'].'"><i class="fa fa-trash"></i></a>'.
               '</div>';
    }

    public function FormatDateDecorator($cell, $row) {
        $carbon = new Carbon($cell);
        return $carbon->toFormattedDateString();
    }

}