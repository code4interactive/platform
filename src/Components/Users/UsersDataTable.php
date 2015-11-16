<?php
namespace Code4\Platform\Components\Users;

use Code4\Platform\Models\User;
use Carbon\Carbon;
use Code4\DataTable\DataTable;
use Thomaswelton\LaravelGravatar\Facades\Gravatar;

class UsersDataTable extends DataTable {

    protected $name = "usersList";

    protected $columns = [
        'id'         => 'Id',
        'image'      => 'Zdjęcie',
        'email'      => 'Email',
        'roles'      => 'Role',
        'last_name'  => 'Imię i nazwisko',
        'job_title'  => 'Stanowisko',
        'created_at' => 'Utworzony',
        'updated_at' => 'Ostatnio modyfikowany',
        'actions'    => ['title' => 'Akcje', 'orderable' => false, 'searchable' => false, 'width' => '100px']
    ];

    protected $noSorting = ['actions'];

    protected $cellDecorators = [
        'created_at' => ['FormatDataDecorator'],
        'updated_at' => ['FormatDataDecorator'],
        'roles'      => ['getRoles'],
        'actions'    => ['buttons'],
        'last_name'  => ['imieINazwisko'],
        'image'      => ['images']
    ];

    protected $url = '/administration/users/index';

    protected function getData($start, $length, $search, $orderCol, $orderDir)
    {
        $user = new User();
        return $user->getDataForDataTable($start, $length, $search, $orderCol, $orderDir);
    }

    protected function countAll()
    {
        return User::count();
    }

    protected function getRolesDecorator($cell, $row)
    {
        $user = \Sentinel::findById($row['id']);
        $roles = $user->roles;
        $r = '';
        foreach ($roles as $role)
        {
            $r .= '<span class="badge">' . $role->name . '</span> ';
        }

        return $r;
    }

    protected function imagesDecorator($cell, $row)
    {

        //$gravatar = Gravatar::image($row['email'], $row['first_name'].' '.$row['last_name'], array('width' => 30, 'height' => 30, 'class' => 'img-circle'));
        $gravatar_src = Gravatar::src($row['email'], 30);
        $gravatar = '<img src="' . $gravatar_src . '" alt="' . $row['first_name'] . ' ' . $row['last_name'] . '" class="img-circle">';

        return $gravatar;

        //$inicjaly = substr($row['first_name'], 0, 1) . substr($row['last_name'], 0, 1);

        return '<button class="btn btn-circle">' . strtoupper($inicjaly) . '</button>';
    }

    protected function imieINazwiskoDecorator($cell, $row)
    {
        return $row['last_name'] . ' <strong>' . $row['first_name'] . '</strong>';
    }

    protected function buttonsDecorator($cell, $row)
    {
        return '<div class="pull-right">' .
        '<a href="/administration/users/' . $row['id'] . '/generateBadge" class="btn btn-xs btn-info generateQr"><i class="fa fa-qrcode"></i></a>&nbsp;' .
        '<a href="/administration/users/' . $row['id'] . '/edit" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>&nbsp;' .
        '<a href="/administration/users/' . $row['id'] . '/delete" class="btn btn-xs btn-danger confirmDelete" data-name="' . $row['email'] . '"><i class="fa fa-trash"></i></a>' .
        '</div>';
    }

    public function FormatDateDecorator($cell, $row)
    {
        $carbon = new Carbon($cell);

        return $carbon->toFormattedDateString();
    }

}