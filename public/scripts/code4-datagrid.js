/*{"total_count":114895,
    "filtered_count":114895,"page":1,"pages_count":1149,"previous_page":null,"next_page":2,"per_page":100,"results":[{"konto":"\ufeff01","opis":"DOTACJE\r","id":"1"},{}]}
*/

;(function($, window, document, undefined){

    'use strict';

    var defaults = {
        source: null,
        threshold: 100,
        throttle: 100,
        type: 'multiple',
        loader: undefined,
        sort: {},
        tempoOptions: {
            var_braces: '\\[\\[\\]\\]',
            tag_braces: '\\[\\?\\?\\]',
            escape: true
        },
        searchThreshold: 100,
        callback: undefined
    };

    var helpers = {
        appliedFilters: [],
        tmpl: {},
        pageIdx: 1,
        nextIdx: null,
        prevIdx: null,
        totalPages: null,
        isActive: false,
        pagiThrottle: null,
        totalCount: null,
        filterCount: null
    };


    function DataGrid(grid, results, pagination, filters, options){

        this.opt = $.extend({}, defaults, options, helpers);

        //Binding Key
        this.grid = '[data-grid='+grid+']';

        //Cache Our Selectors
        this.$results = $(results + this.grid);
        this.$pagination = $(pagination + this.grid);
        this.$filters = $(filters + this.grid);
        this.$body = $(document.body);

        //Get Our Source
        this.opt.source = this.$results.data('source') || this.opt.source;

        //Default Throttle
        this.opt.pagiThrottle = this.opt.throttle;

        this._init();
    }

    DataGrid.prototype = {

        _init: function(){

            this._prepTemplates();

            this._events();

            if(!$.isEmptyObject(this.opt.sort)){

                this.$body.find('[data-sort='+this.opt.sort.column+']'+this.grid).addClass(this.opt.sort.direction);

            }

            this._ajaxFetch();
        },

        _prepTemplates: function(){

            this.opt.tmpl.results = Tempo.prepare(this.$results, this.opt.tempoOptions);

        },

        _events: function(){

            var self = this;

            this.$body.on('click', '[data-sort]'+this.grid, function(e){

                self._setSortDirection($(this));
                self._setSort($(this).data('sort'));
                //self._clearResults();
                //self._ajaxFetch();

            });

        },

        _setSort: function(sort){

            var arr = sort.split(':'),
                direction = typeof arr[1] !== 'undefined' ? arr[1] : 'asc';

            if(arr[0] === this.opt.sort.column){

                this.opt.sort.direction = (this.opt.sort.direction === 'asc') ? 'desc' : 'asc';

            }else{

                this.opt.sort.column = arr[0];
                this.opt.sort.direction = direction;

            }

        },

        _setSortDirection: function(el){

            $('[data-sort]'+this.grid).not(el).removeClass('sorting_desc sorting_asc sorting');

            if(el.hasClass('sorting_asc')){
                el.removeClass('sorting_asc').addClass('sorting_desc');
            }else{
                el.removeClass('sorting_desc').addClass('sorting_asc');
            }

        }
    };

    $.datagrid = function(grid, results, pagination, filters, options){
        return new DataGrid(grid, results, pagination, filters, options);
    };

})(window.jQuery, window, document);