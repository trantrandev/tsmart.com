'use strict';
$(document).ready(function() {
    $('#zero-configuration').DataTable();
    $('#key-act-button').DataTable({
        dom: 'Bfrtip',
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
    });
    $('#col-reorder').DataTable({
        colReorder: true
    });
    $('#fixed-columns-left').DataTable({
        scrollY: "300px",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        fixedColumns: true,
    });
    $('#fixed-columns-left-right').DataTable({
        scrollY: "300px",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        fixedColumns: true,
        fixedColumns: {
            leftColumns: 1,
            rightColumns: 1
        }
    });
    $('#fixed-header').DataTable({
        header: true,
        footer: true
    });
    $('#scrolling-table').DataTable({
        scrollY: 300,
        paging: false,
        keys: true
    });

    $('#responsive-table').DataTable({});
    $('#responsive-table-model').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function(row) {
                        var data = row.data();
                        return 'Details for ' + data[0] + ' ' + data[1];
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        }
    });
});