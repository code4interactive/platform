<?php

namespace Code4\Platform\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model {

    protected $fillable = [
        'setting_name',
        'settings',
        'user_id'
    ];

    public $timestamps = false;

    /** RELATIONS */
    public function user() {
        return $this->belongsTo('users', 'id', 'user_id');
    }


    public function get($term) {

    }

    public function set($term, $value) {

    }

}