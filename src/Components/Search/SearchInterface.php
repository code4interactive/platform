<?php

namespace Code4\Platform\Components\Search;

interface SearchInterface {

    /**
     * @return string
     */
    public function searchIcon();
    /**
     * @param $string
     * @return array
     */
    public function search($string);

}
