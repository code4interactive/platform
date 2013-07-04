<?php
/**
 * Created by CODE4 Interactive.
 * User: Artur Bartczak
 * Date: 27.06.13
 * Time: 17:36
 */

namespace Code4\Platform\Menu;

use Symfony\Component\Yaml\Parser;

class Menu {

    protected $menu;

    public function __construct() {

        $this->menu = \Config::get('platform::menu');

        $this->buildMenu();

    }


    public function addToMenu($str) {

        if (!is_array($this->menu)) $this->menu = array();

        $this->menu[] = $str;

    }

    /**
     * @param $menuConfig
     */
    public function add($menuConfig) {



    }

    public function buildMenu() {

        $topMenuView = \View::make('platform::platform._topMenu')->with('menu', $this->menu);
        $leftMenuView = \View::make('platform::platform._leftMenu')->with('menu', $this->menu);

        \View::composer('platform::templates.ace.dashboard', function($view) use ($topMenuView, $leftMenuView) {
            $view->with('menu',$topMenuView)->with('leftMenu', $leftMenuView);
        });

    }

    public function getMenu() {
        return $this->menu;
    }

}