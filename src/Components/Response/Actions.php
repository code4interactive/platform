<?php

namespace Code4\Platform\Components\Response;

use Illuminate\Support\Collection;

class Actions extends Collection {

    /**
     * Executes passed JS script
     * @param $evalScript
     */
    public function jsEval($evalScript) {
        $this->push(['eval' => $evalScript]);
    }

    /**
     * Sends command to redirect browser to given urk
     * @param $url
     */
    public function redirect($url) {
        $this->push(['redirect' => $url]);
    }

    /**
     * Sends command to reload browser window
     */
    public function reload() {
        $this->push(['reload'=>true]);
    }

    /**
     * Sends command to exit lock screen
     */
    public function exitLockScreen() {
        $this->push(['exitLockout' => true]);
    }

    /**
     * Sends command to DataTable to reload
     * @param string $dataTableName
     */
    public function reloadDataTable($dataTableName) {
        $this->push(['reloadDataTable' => '#dt-'.$dataTableName]);
    }

    /**
     * Casts collection to array
     * @return array
     */
    public function toArray() {
        $items = parent::toArray();
        return ['actions' => $items];
    }


}