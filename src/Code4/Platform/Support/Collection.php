<?php namespace Code4\Platform\Support;

use Illuminate\Support\Collection as BaseCollection;

class Collection extends BaseCollection {



    public function add($item, $key=null) {
        if ($key == null) {

        }

        if (is_object($item));

    }

    /**
     * Tries to find item by provided key value pair;
     *
     * @param $key
     * @param $value
     * @return item
     */
    public function getByKey($key, $value) {

        foreach ($this->all() as $item){

            if (is_array($item) && array_key_exists($key, $item)) {
                if ($item[$key] == $value) return $item;
            }

            if (is_object($item)) {
                $getter = 'get'.ucfirst($key);
                if (method_exists($item, $getter)) {
                    if ($item->$getter == $value)return $item;
                }

                if (method_exists($item, "get")) {
                    if ($item->get($key) == $value) return $item;
                }
            };
        }

        return null;
    }

}