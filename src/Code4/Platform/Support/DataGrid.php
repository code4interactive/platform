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


    public function __construct($dataSrc = null, $dataGridId = null, $columns = array()) {

        $this->dataGridId = $dataGridId;
        $this->dataSrc = $dataSrc;
        $this->setColumns($columns);

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
                    <td colspan="4">No Results</td>
                </tr>
            </tbody>

        </table>';

        return $out;

    }


    public function tools() {

        if (is_callable($this->toolTray)) {

            $t = $this->toolTray;
            return '<div class="pull-left action-buttons">'.$t($this).'</div>';

        }

    }

    public function pageLimits() {


        $out = '<div class="dataTables_length">
            <label>Pokaż
                <select size="1" name="sample-table-2_length" data-perPage data-grid="'.$this->dataGridId.'">';


        foreach($this->perPageLimits as $limit) {

            $selected = $limit == $this->throttle ? 'selected="selected"' : "";

            $out .= '<option value="'. $limit .'" '.$selected.' >'.$limit.'</option>';

        }
        $out .= '</select> </label></div>';


        return $out;

    }


    public function pagination() {

        $out = '
            <div class="dataTables_paginate paging_bootstrap pagination" data-grid="'.$this->dataGridId.'">
                <ul class="pagination">
                    <li class="prev disabled"><a href="#"><i class="icon-double-angle-left"></i></a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li class="next disabled"><a href="#"><i class="icon-double-angle-right"></i></a></li>
                </ul>
            </div>
        ';

        return $out;

    }

    public function search() {

        $out = '
        <form method="post" action="" accept-charset="utf-8" data-search data-grid="'.$this->dataGridId.'">
            <div class="input-append col-sm-6">

                <select name="column" class="hidden-select select2 chosen-select2" >
                    <option value="all">Wszystkie</option>';

                    foreach ($this->columns as $column) {

                        if ($column->searchable())
                            $out .= '<option value="'.$column->getId().'">'.$column->getLabel().'</option>';

                    }
                    $out .= '
                </select>

                <div class="input-group col-sm-6 filter">
                  <input name="filter" autocomplete="off" class="form-control" type="text" placeholder="Filtruj wg...">
                  <div class="input-group-btn btn-group">
                    <button class="btn btn-info search-btn">
                        <span class="icon-search"></span>
                    </button>
                    <button class="btn" data-reset data-grid="'.$this->dataGridId.'">
                        <span class="icon-undo"></span>
                    </button>
                  </div>
                </div>

            </div>
        </form>
        <div class="applied tags col-sm-6" data-grid="'.$this->dataGridId.'">
            <span data-template class="tag">
                [? if column === undefined ?]
                [[ valueLabel ]]
                [? else ?]
                [[ valueLabel ]] in [[ columnLabel ]]
                [? endif ?]
                <button type="button" class="close">×</button>
             </span>
        </div>

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

        ?>

        <div class="dataTables_wrapper" role="grid">
            <div class="row datagrid-search">
                <?php echo $this->search(); ?>
            </div>
            <?php echo $this->table(); ?>
            <div class="table_footer">
                <div class="col-sm-4">
                    <div class="tools"><?php echo $this->tools(); ?></div>
                    <div class="showing pull-left" data-info data-grid="<?php echo $this->dataGridId; ?>">Showing 1 to 10 of 23 entries</div>
                </div>
                <div class="col-sm-4 middle"><?php echo $this->pageLimits(); ?></div>
                <div class="last col-sm-4"><?php echo $this->pagination(); ?></div>
            </div>
            <div class="clearfix"></div>
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