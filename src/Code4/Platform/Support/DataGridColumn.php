<?php
/**
 * Created by CODE4Interactive.
 * User: Artur Bartczak
 * Date: 24.08.13
 * Time: 23:38
 */

namespace Code4\Platform\Support;

use Illuminate\Support\Contracts\RenderableInterface;

class DataGridColumn implements RenderableInterface {

    protected $id;
    protected $dataGridId;
    protected $label;

    protected $headerDecorator;
    protected $decorator;

    protected $sortable = true;
    protected $sorted = false;      //is datagrid actually sorted by this column at render time
    protected $sortDirection = 'asc';

    protected $width = null;

    protected $searchable = true;  //tells javascript to search in this column and adds it to filters

    public function __construct($dataGridId, $options = array()) {

        $this->dataGridId = $dataGridId;

        if (count($options)) $this->set($options);

    }

    /**
     * Returns information is this column should be included in search
     * @return bool
     */
    public function searchable() {

        return (bool)$this->searchable;

    }

    public function renderHeader() {


        $width = !is_null($this->width) ? 'style="width: '. $this->width .'"' : '';
        $datasort = $this->sortable ? 'data-sort="'.$this->id.'" class="sortable sorting"' : '';


        if(is_callable($this->headerDecorator))
        {
            $d = $this->headerDecorator;
            return '<th '.$width.' data-grid="'.$this->dataGridId.'" '.$datasort.' >'. $d($this) .'</th>'.PHP_EOL;
        }

        return '<th '.$width.' data-grid="'.$this->dataGridId.'" '.$datasort.' >'. $this->label .'</th>'.PHP_EOL;

    }

    public function renderBody() {

        if(is_callable($this->decorator))
        {
            $d = $this->decorator;
            return '<td>'. $d($this) .'</td>'.PHP_EOL;
        }

        return '<td>[[ '. $this->id .' ]]</td>'.PHP_EOL;

    }

    public function render() {


    }


    public function setDecorator(\Closure $decorator) {

        $this->decorator = $decorator;

    }

    public function setHeaderDecorator(\Closure $decorator) {

        $this->headerDecorator = $decorator;

    }




    /** GETTERS and SETTERS **/

    public function set($options=array()) {

        foreach($options as $key => $value) {

            switch($key) {

                case 'id':
                    $this->id = $value;
                    break;
                case 'label':
                    $this->label = $value;
                    break;
                case 'sortable':
                    $this->sortable = $value;
                    break;
                case 'sorted':
                    $this->sorted = $value;
                    break;
                case 'sortDirection':
                    $this->sortDirection = $value;
                    break;
                case 'searchable':
                    $this->searchable = $value;
                    break;
                case 'width':
                    $this->width = $value;
                    break;

            }

        }

    }

    public function setDataGridId($dataGridId)
    {
        $this->dataGridId = $dataGridId;
        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setSearchable($searchable)
    {
        $this->searchable = $searchable;
        return $this;
    }

    public function getSearchable()
    {
        return $this->searchable;
    }

    public function setSortDir($sort_dir)
    {
        $this->sort_dir = $sort_dir;
        return $this;
    }

    public function getSortDir()
    {
        return $this->sort_dir;
    }

    public function setSortable($sortable)
    {
        $this->sortable = $sortable;
        return $this;
    }

    public function getSortable()
    {
        return $this->sortable;
    }

    public function setSorted($sorted)
    {
        $this->sorted = $sorted;
        return $this;
    }

    public function getSorted()
    {
        return $this->sorted;
    }






}