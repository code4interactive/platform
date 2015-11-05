<?php

namespace Code4\Platform\Components\Search;

class Search
{
    protected $providers;

    public function __construct() {
        $config = \Config::get('search');
        $this->providers = $config['registeredProviders'];
    }

    /**
     * @param $providers
     */
    public function setProviders($providers) {
        $this->providers = (array) $providers;
    }

    public function makeSearch($str) {
        $result = "";
        foreach($this->providers as $provider) {
            $o = new $provider;
            if ($o instanceof SearchInterface) {
                $itemResults = $o->search($str);
                $icon = $o->searchIcon();
                if (!count($itemResults)) { continue; }

               $result .= view('platform::components.search.searchResult', compact('itemResults','icon'));
            }
        }
        return $result;
    }
}