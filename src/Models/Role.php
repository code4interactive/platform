<?php

namespace Code4\Platform\Models;

use Code4\Platform\Components\Search\SearchInterface;
use Cartalyst\Sentinel\Roles\EloquentRole;

class Role extends EloquentRole implements SearchInterface
{
    /**
     * Sprawdza czy rola jest permanentna. Powinna istnieć przynajmniej jedna permanentna rola aby nie zablokować dostępu.
     * @return bool
     */
    public function isPermanent() {
        return $this->permanent == '1' ? true : false;
    }

    /**
     * Nadpisana metoda delete uwzględnia sprawdzenie czy rola jest permanentna!
     * @return bool
     */
    public function delete() {
        if ($this->isPermanent()) {
            \Alert::warning('Nie można usunąć tej roli!');
            return false;
        }
        return parent::delete();
    }

    /**
     * @param $str
     * @return array
     */
    public function search($str) {
        $results = [];
        $result = $this->where('name', 'like', '%'.$str.'%')
            ->orwhere('slug', 'like', '%'.$str.'%')
            ->orwhere('created_at', 'like', '%'.$str.'%')
            ->get();

        foreach($result as $item) {
            //prepare result
            $desc = 'slug: <strong>'.$item->slug.'</strong>, utworzony: <strong>'.$item->created_at.'</strong>';
            $results[] = prepareSearchResult($str, action('RolesController@index'), $item->name, $desc, "Role", "lock");
        }
        return $results;
    }

    /**
     * @return string
     */
    public function searchIcon(){
        return 'lock';
    }
}
