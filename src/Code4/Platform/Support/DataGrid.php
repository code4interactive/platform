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
                <ul>
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
            <div class="input-append">
                <select name="column" class="hidden-select chosen-select2" >
                    <option value="all">Wszystkie</option>';

                    foreach ($this->columns as $column) {

                        if ($column->searchable())
                            $out .= '<option value="'.$column->getId().'">'.$column->getLabel().'</option>';

                    }
                    $out .= '
                </select>

                <input name="filter" autocomplete="off" type="text" placeholder="Filtruj wg...">

                <button class="btn btn-info search-btn">
                    <i class="icon-search bigger-110"></i>
                    Filtruj
                </button>

                <button class="btn" data-reset data-grid="'.$this->dataGridId.'">
                    <i class="icon-undo bigger-110"></i>
                    Reset
                </button>

            </div>
        </form>
        <div class="applied tags" data-grid="'.$this->dataGridId.'">
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

        $out = "
            <script>
            $(function()
            {
                $.datagrid('{$this->dataGridId}', '.results', '.pagination', '.applied', {
                loader: code4Loading,
                sort: {
                    column: 'id',
                    direction: 'sorting_asc'
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
            <div class="row-fluid datagrid-search">
                <div class="span12">
                    <?php echo $this->search(); ?>
                </div>
            </div>
            <?php echo $this->table(); ?>
            <table class="table_footer">
                <tr>
                    <td><?php echo $this->tools(); ?></td>
                    <td>
                        <div data-info data-grid="<?php echo $this->dataGridId; ?>">Showing 1 to 10 of 23 entries</div>
                        <?php echo $this->pageLimits(); ?>
                    </td>
                    <td><?php echo $this->pagination(); ?></td>
                </tr>
            </table>
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