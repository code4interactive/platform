<?php

namespace Code4\Platform\Models;

use Code4\Platform\Components\Search\SearchTrait;
use Code4\Platform\Components\Search\SearchInterface;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends EloquentUser implements SearchInterface
{
    use SoftDeletes;
    use SearchTrait;

    protected $fillable = [
        'email',
        'password',
        'last_name',
        'first_name',
        'image',
        'login_hash',
        'job_title',
        'permissions',
    ];

    protected $searchableColumns = ['email','last_name','first_name','job_title','created_at'];

    /**
     * Sprawdza czy przesłany login_hash jest unikalny.
     * @param $uniqueId
     * @return bool
     */
    public static function isThisIdUnique($uniqueId) {
        return static::where('login_hash', '=', $uniqueId)->get() ? true : false;
    }

    /**
     * Sprawdza czy user ma przypisaną rolę
     * @param $roleId
     * @return bool
     */
    public function DO_POPRAWY_hasRole($roleId) {
        return true;
    }

    /**
     * Zwraca gravatar usera
     * @param int $size
     * @param string $class
     * @return string
     */
    public function getAvatar($size = 30, $class = 'img-circle') {
        $gravatar_src = \Gravatar::src($this->email, $size);
        $gravatar = '<img src="' . $gravatar_src . '" alt="' . $this->first_name . ' ' . $this->last_name . '" class="'.$class.'">';
        return $gravatar;
    }

    /**
     * Zwraca imię i nazwisko usera
     * @return string
     */
    public function getFirstAndLastName() {
        return $this->first_name . ' ' . $this->last_name;
    }

    /* QrHash implementation */
    public function getHash(){
        return $this->login_hash;
    }
    /* END QrHash implementation */


    /* SearchInterface Implementation */
    public function search($str) {
        $results = [];
        $result = $this->searchInColumns($str)->get();
        foreach($result as $item) {
            $desc = '<strong>Tytuł / Stanowisko: </strong>'.$item->job_title.', <strong>utworzony: </strong>'.$item->created_at.'';
            $first_line = $item->first_name.' '.$item->last_name.' <small class="text-muted">('.$item->email.')</small>';
            $results[] = prepareSearchResult($str, action('UsersController@index'), $first_line, $desc, "Users", "users");
        }
        return $results;
    }
    public function searchIcon(){
        return 'users';
    }
    /* END SearchInterface Implementation */

    /**
     * Sprawdza czy we wskazanej kolumnie istnieje przesłany wpis - sprawdzanie unikalności
     * @param $column
     * @param $key
     * @return bool
     */
    public static function isUnique($column, $key)
    {
        return count(static::where($column, '=', $key)->get()) == 0 ? true : false;
    }

    public function getDataForAutocomplete($str) {
        $result = $this->searchAllFields($str);
    }

}
