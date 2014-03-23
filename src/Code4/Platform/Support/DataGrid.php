<?php
/**
 * Created by CODE4Interactive.
 * User: Artur Bartczak
 * Date: 24.08.13
 * Time: 23:30
 */

namespace Code4\Platform\Support;


class DataGrid {

    protected $dataGridId = 'default';
    protected $dataSrc = null;
    protected $columns = array();
    protected $threshold = 1;
    protected $throttle = 10;  //perPage
    protected $perPageLimits = array(5,10,50,100,200,500);
    protected $paginationCount = 5;

    protected $toolTray = null;

    protected $tableHeader = "Tabela";
    protected $tableHeaderIcon = "fa-table";
    protected $tableHeaderColor = null;


    public function __construct($dataSrc = null, $dataGridId = null, $columns = array()) {

        $this->dataGridId = $dataGridId;
        $this->dataSrc = $dataSrc;
        $this->setColumns($columns);

    }

    public function setHeader($tableHeader, $tableHeaderIcon=null, $tableHeaderColor=null) {
        $this->tableHeader = $tableHeader;
        $this->tableHeaderColor = $tableHeaderColor;
        $this->tableHeaderIcon = $tableHeaderIcon;
    }




    public function setColumns($columns = array()) {

        foreach($columns as $column) {

            if (!is_array($column)) $this->columns[] = new DataGridColumn($this->dataGridId, array('id'=>$column, 'label'=>$column));
            else {

                $this->columns[] = new DataGridColumn($this->dataGridId, $column);

            }
        }
    }

    public function table() {

        $out = '
        <table id="table_report" class="table table-striped table-bordered table-hover dataTable results " data-grid="'.$this->dataGridId.'" data-source="'.$this->dataSrc.'">
            <thead>
                <tr>';

            foreach($this->columns as $column) {

                $out .= $column->renderHeader();

            }
            $out .= '</tr>
            </thead>

            <tbody>
                <tr data-template>';

                foreach($this->columns as $column) {

                    $out .= $column->renderBody();

                }
            $out .= '</tr>
                <tr data-results-fallback style="display:none;">
                    <td colspan="4">Brak wyników</td>
                </tr>
            </tbody>

        </table>';

        return $out;

    }


    public function tools() {


        $a = '<div class="col-sm-2 tools">';

        $a .= '<div class="btn-group">
                <span class="btn btn-no-button txt-color-white bg-color-blue">
                   <i class="fa fa-long-arrow-up"></i>&nbsp;&nbsp; zaznaczone:
                </span>
                <button class="btn dropdown-toggle bg-color-blue txt-color-white" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="javascript:void(0);">Action</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">Another action</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">Something else here</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);">Separated link</a>
                    </li>
                </ul>
            </div>';



        //$a .= '<div class="btn-group">
        //                            <button class="btn bg-color-blueDark txt-color-white">
        //                                <i class="fa fa-gear"></i> z zaznaczeniem
        //                            </button>
        //                            <button class="btn btn-primary dropdown-toggle">
        //                                <span class="caret"></span>
        //                            </button>
        //                        </div>';
        //$a .= '<i class="fa fa-lg fa-caret-square-o-up"></i>';
        //$a .= '<button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
        //           <i class="fa fa-lg fa-caret-square-o-up"></i> Action <span class="caret"></span>
        //       </button>';
        $a .= '</div>';
        return $a; 

        if (is_callable($this->toolTray)) {

            $t = $this->toolTray;
            return '<div class="pull-left action-buttons">'.$t($this).'</div>';

        }

    }

    public function pageLimits() {


        $out = '<div class="dataTables_length">
            <label>Pokaż
                <select size="1" name="sample-table-2_length" data-perpage data-grid="'.$this->dataGridId.'">';


        foreach($this->perPageLimits as $limit) {

            $selected = $limit == $this->throttle ? 'selected="selected"' : "";

            $out .= '<option value="'. $limit .'" '.$selected.' >'.$limit.'</option>';

        }
        $out .= '</select> </label></div>';



        $out  = '<div id="dt_basic_length" class="dataTables_length">';
        $out .= '    <span class="smart-form">';
        $out .= '        <label class="select" style="width:60px">';
        $out .= '            <select size="1" name="dt_basic_length" aria-controls="dt_basic" data-perpage data-grid="'.$this->dataGridId.'">';

        foreach($this->perPageLimits as $limit) {
            $selected = $limit == $this->throttle ? 'selected="selected"' : "";

            $out .= '               <option value="'. $limit .'" '.$selected.' >'.$limit.'</option>';

        }

        $out .= '            </select>';
        $out .= '            <i></i>';
        $out .= '        </label>';
        $out .= '    </span>';
        $out .= '</div>';


        return $out;

    }


    public function pagination() {

        $out = '
            <div class="dataTables_paginate paging_bootstrap pagination" data-grid="'.$this->dataGridId.'">
                <ul class="pagination">
                    <li class="prev disabled"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li class="next disabled"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                </ul>
            </div>
        ';

        return $out;

    }

    public function search() {

        $out = '

        <form class="smart-form no_ajax" method="post" action="" accept-charset="utf-8" data-search data-grid="'.$this->dataGridId.'">

        <div class="row filters-row">
            <div class="col col-2 filter">
                <select name="column" class="hidden-select select2" >
                    <option value="all">Wszystkie</option>';
                    foreach ($this->columns as $column) {
                        if ($column->searchable())
                            $out .= '<option value="'.$column->getId().'">'.$column->getLabel().'</option>';
                    }
                    $out .= '
                </select>
            </div>

            <div class="col col-6 filter">
                <label class="input datagrid_filter"><input  name="filter" type="text" placeholder="Filtruj wg..."></label>
                <div class=" btn-group">
                    <button class="btn btn-primary btn-lg search-btn">
                        <i class="fa fa-search"></i>
                    </button>
                    <button class="btn btn-primary btn-lg" data-reset data-grid="'.$this->dataGridId.'">
                        <i class="fa fa-undo"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="widget-body-toolbar tags-row">
                <div class="applied tags" data-grid="'.$this->dataGridId.'">
                    <button data-template class="btn btn-primary btn-xs">
                     [? if column === undefined ?]
                        [[ valueLabel ]]
                        [? else ?]
                        [[ valueLabel ]] w [[ columnLabel ]]
                        [? endif ?]
                     <span class="fa fa-times"></span></button>
                </div>
        </div>

        
        </form>

        ';

        return $out;

    }


    public function script() {

        $sorted = "";
        foreach ($this->columns as $column) {

            if ($column->getSorted()) {

                $sorted = "
                    column: '".$column->getId()."',
                    direction: '";
                $sorted .= $column->getSortDir() == "asc" ? "sorting_asc" : "sorting_desc";
                $sorted .= "'";

            }

        }


        $out = "
            <script>
            $(function()
            {
                $.datagrid('{$this->dataGridId}', '.results', '.pagination', '.applied', {
                loader: code4Loading,
                sort: {
                    ". $sorted ."
                },
                throttle: ". $this->throttle .",
                middlePages: ". $this->paginationCount .",
                callback: function(obj){

                        //Leverage the Callback to show total counts or filtered count
                        // $('#filtered').val(obj.filterCount);
                        // $('#total').val(obj.totalCount);

                }
                });
            });
        </script>
        ";
        return $out;

    }

    public function render() {

        ?>        <div class="jarviswidget <?php echo $this->tableHeaderColor; ?>" id="widget-<?php echo $this->dataGridId; ?>"
            data-widget-sortable="true"
            data-widget-togglebutton="false" 
            data-widget-editbutton="false" 
            data-widget-colorbutton="false" 
            data-widget-deletebutton="false"  >

            <header role="heading"> 
                <?php if ($this->tableHeaderIcon) { ?><span class="widget-icon"> <i class="fa <?php echo $this->tableHeaderIcon; ?>"></i> </span><?php } ?>
                <h2><?php echo $this->tableHeader; ?></h2>
            </header>
            <div role="content">
                <div class="widget-body no-padding">
                    <div class="widget-body-toolbar"></div>
                    <div class="dataTables_wrapper form-inline" role="grid">
                        <div class="dt-top-row">
                            <?php echo $this->search(); ?>
                        </div>
                        <div class="dt-wrapper">
                            <?php echo $this->table(); ?>
                        </div>
                        <div class="dt-row dt-bottom-row">
                            <div class="row">
                                    <?php echo $this->tools(); ?>
                                <div class="col-sm-4">
                                    <?php echo $this->pageLimits(); ?>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <?php echo $this->pagination(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

        <?php

        echo $this->script();

    }

    public function setTools(\Closure $tools) {

        $this->toolTray = $tools;

    }

    public function __call($name, $arguments) {

        $column = $this->findColumn($name);

        if ($column !== null) return $column;

        $options = count($arguments)>0 ? $arguments[0] : array();
        $column = new DataGridColumn($this->dataGridId, $options);
        $column->setId($name);
        $this->columns[] = $column;
        return $this->columns[count($this->columns)-1];

    }

    public function __get($name) {

        $column = $this->findColumn($name);

        if ($column !== null) return $column;

        $column = new DataGridColumn($this->dataGridId);
        $column->setId($name);
        $this->columns[] = $column;
        return $this->columns[count($this->columns)-1];

    }


    private function findColumn($id) {

        foreach($this->columns as $column) {

            if ($column->getId() == $id) return $column;

        }

        return null;

    }

    public function setThrottle($throttle)
    {
        $this->throttle = $throttle;
    }

    public function getThrottle()
    {
        return $this->throttle;
    }

    public function setPerPageLimits($perPageLimits)
    {
        $this->perPageLimits = $perPageLimits;
    }

    public function getPerPageLimits()
    {
        return $this->perPageLimits;
    }

    public function setDataSrc($dataSrc)
    {
        $this->dataSrc = $dataSrc;
    }

    public function getDataSrc()
    {
        return $this->dataSrc;
    }

    public function setDataGridId($dataGridId)
    {
        $this->dataGridId = $dataGridId;

        for($lp=0; $lp<count($this->columns); $lp++) {

            $this->columns[$lp]->setDataGridId($dataGridId);

        }
    }

    public function setPaginationCount($paginationCount)
    {
        $this->paginationCount = $paginationCount;
    }

    public function getPaginationCount()
    {
        return $this->paginationCount;
    }



    public function getDataGridId()
    {
        return $this->dataGridId;
    }


    /** GETTERS & SETTERS **/


}