@push('styles')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap5.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.2/css/select.dataTables.css">
 @endpush
<style>
    /* body.dt-print-view h1 {
        text-align: center;
        margin: 1em;
    } */

    @media print {

        /* For odd rows */
        table.dataTable tbody tr:nth-child(odd) {
            background-color: rgba(0, 0, 0, 0.02) !important;
        }

        /* For even rows */
        table.dataTable tbody tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0) !important;
        }
    }

    body.dt-print-view table tbody tr td {
        padding: 5px;
    }
</style>
@push('scripts')
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script> --}}

    
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap5.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>

    {{-- Thi sis for Selecting Rows For getting Print --}}
    <script type="text/javascript" src="https://cdn.datatables.net/select/2.0.2/js/dataTables.select.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/2.0.2/js/select.dataTables.js"></script>
    

    {{-- <script type="text/javascript" src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script> --}}
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script> --}}
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script> --}}
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script> --}}
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script> --}}
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script> --}}
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script> --}}
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script> --}}
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/select/2.0.2/js/dataTables.select.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/2.0.2/js/select.dataTables.js"></script> --}}

    <script>
        function initializeDataTable(tableId) {
            // Initialize DataTable with the specified table ID
            new DataTable(tableId, {
                // caption: "A fictional company's staff table.",
                title: 'User Activities',
                layout: {
                    top1Start: {

                        // buttons: ['pageLength', 'copy', 'excel', 'csv', 'pdf', 'print', 'colvis',
                        buttons: ['pageLength', 'colvis',
                            // {
                            //     extend: 'print',
                            //     title: 'User Activities',
                            //     messageTop: 'This print was produced using the Print button for DataTables',
                            //     text: 'Selected Print',
                            //     exportOptions: {
                            //         columns: ':visible',
                            //         modifier: {
                            //             selected: null
                            //         }
                            //     },
                            //     // customize: function(win) {
                            //     //     $(win.document.body).prepend(
                            //     //         '<div class="logo-container"><img src="/build/assets/img/logo/rntu.png" width="200" alt="Logo 1" class="logo"><img src="/build/assets/img/logo/rntu.png" alt="Logo 2" width="200"  class="logo second-logo"></div>'
                            //     //         );
                            //     // }

                            // },
                            {
                                extend: 'pdfHtml5',

                                text: 'Selected PDF',
                                title: 'User Activities',
                                messageTop: 'This print was produced using the Print button for DataTables',
                                exportOptions: {
                                    columns: ':visible'
                                },

                                download: 'open',


                            },
                            // {
                            //     text: 'JSON',
                            //     action: function(e, dt, button, config) {
                            //         var data = dt.buttons.exportData();
                            //         DataTable.fileSave(new Blob([JSON.stringify(data)]), 'Export.json');
                            //     }
                            // },

                            {
                                text: 'Export All',
                                // className: 'btn btn-secondary dropdown-toggle',
                                title: 'User Activities',
                                messageTop: 'This print was produced using the Print button for DataTables',
                                split: ['copy', 'csv', 'excel', 'pdf', 'print', 'json']
                            },

                            {
                                text: 'Export Selected',
                                // className: 'btn btn-secondary dropdown-toggle',
                                split: [{
                                        extend: 'copyHtml5',
                                        text: 'Copy',
                                        exportOptions: {
                                            columns: ':visible'
                                        }
                                    },
                                    {
                                        extend: 'excelHtml5',
                                        text: 'Excel',
                                        exportOptions: {
                                            columns: ':visible'
                                        }
                                    },
                                    {
                                        extend: 'csvHtml5',
                                        text: 'CSV',
                                        exportOptions: {
                                            columns: ':visible'
                                        }
                                    },
                                    {
                                        extend: 'pdfHtml5',
                                        text: 'PDF',
                                        exportOptions: {
                                            columns: ':visible'
                                        }
                                    },
                                    {
                                        extend: 'print',
                                        text: 'Print',
                                        exportOptions: {
                                            columns: ':visible'
                                        }
                                    },
                                    {
                                        text: 'JSON',
                                        action: function(e, dt, button, config) {
                                            var data = dt.buttons.exportData();
                                            DataTable.fileSave(new Blob([JSON.stringify(data)]),
                                                'Export.json');
                                        }
                                    },
                                ]
                            },


                        ]
                        // paging: 'true',
                        // responsive: true,
                    }
                },
                // columnDefs: [{
                //     targets: -2,
                //     visible: false
                // }]
                select: true

            });
        }

        // // Call the function with the desired table ID
        // initializeDataTable('#example');
    </script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    {{-- <script>
        function initializeDataTable(tableId) {
            new DataTable('#example14', {
                layout: {
                    topStart: {
                        buttons: [
                            'copy',
                            'csv',
                            'excel',
                            'pdf',
                            {
                                extend: 'print',
                                text: 'Print all (not just selected)',
                                exportOptions: {
                                    modifier: {
                                        selected: null
                                    }
                                }
                            }
                        ]
                    }
                },
                select: true
            });
        }
    </script> --}}
@endpush
