<?php namespace Code4\Platform;

class View {

    protected $crumbs = array();

    public function addCrumb($crumb, $link) {

        $this->crumbs[] = array("crumb"=>$crumb, "link"=>$link);

    }

    public function getBreadcrumbs() {

        return \View::make('platform::platform._breadcrumbs')->with("breadcrumbs", $this->crumbs);

    }

}