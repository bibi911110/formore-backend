/*
 *  Document   : tablesDatatables.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Tables Datatables page
 */

var TablesDatatables = function() {

    return {
        init: function() {
            /* Initialize Bootstrap Datatables Integration */
            App.datatables();

            /* Initialize Datatables */
            $('#example-datatable').dataTable({
                columnDefs: [ { orderable: false, targets: [ 1, 4 ] } ],
                pageLength: 10,
                lengthMenu: [[10, 20, 30, -1], [10, 20, 30, 'All']]
            });

            /* Add placeholder attribute to the search input */
            $('.dataTables_filter input').attr('placeholder', 'Search');
        }
    };
}();


var RoleTablesDatatables = function() {

    return {
        init: function() {
            /* Initialize Bootstrap Datatables Integration */
            App.datatables();

            /* Initialize Datatables */
            $('#role-datatable').dataTable({
                columnDefs: [ { orderable: false, targets: [ 1, 2 ] } ],
                pageLength: 10,
                lengthMenu: [[10, 20, 30, -1], [10, 20, 30, 'All']]
            });

            /* Add placeholder attribute to the search input */
            $('.dataTables_filter input').attr('placeholder', 'Search');
        }
    };
}();

var oneTablesDatatables = function() {

    return {
        init: function() {
            /* Initialize Bootstrap Datatables Integration */
            App.datatables();

            /* Initialize Datatables */
            $('#role-datatable').dataTable({
                columnDefs: [ { orderable: false, targets: [ 1, 1 ] } ],
                pageLength: 10,
                lengthMenu: [[10, 20, 30, -1], [10, 20, 30, 'All']]
            });

            /* Add placeholder attribute to the search input */
            $('.dataTables_filter input').attr('placeholder', 'Search');
        }
    };
}();
var AbooutUsTablesDatatables = function() {

    return {
        init: function() {
            / Initialize Bootstrap Datatables Integration /
            App.datatables();

            / Initialize Datatables /
            $('#example-datatable').dataTable({
                columnDefs: [ { orderable: false, targets: [ 1, 3 ] } ],
                pageLength: 10,
                lengthMenu: [[10, 20, 30, -1], [10, 20, 30, 'All']]
            });

            / Add placeholder attribute to the search input /
            $('.dataTables_filter input').attr('placeholder', 'Search');
        }
    };
}();

var OfferTablesDatatables = function() {

    return {
        init: function() {
            / Initialize Bootstrap Datatables Integration /
            App.datatables();

            / Initialize Datatables /
            $('#example-datatable').dataTable({
                columnDefs: [ { orderable: false, targets: [ 1, 2 ] } ],
                pageLength: 10,
                lengthMenu: [[10, 20, 30, -1], [10, 20, 30, 'All']]
            });

            / Add placeholder attribute to the search input /
            $('.dataTables_filter input').attr('placeholder', 'Search');
        }
    };
}();