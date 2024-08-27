@push('styles')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> --}}
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css">
    <!-- DataTables Responsive CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
    <!-- DataTables Buttons CSS -->
    <link href="https://cdn.datatables.net/buttons/2.2.9/css/buttons.bootstrap5.min.css" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css"> --}}


    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- DataTables Buttons CSS -->
    <link href="https://cdn.datatables.net/buttons/2.2.9/css/buttons.bootstrap5.min.css" rel="stylesheet"> --}}
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

    /* body.dt-print-view table tbody tr td {
        padding: 5px;
    } */
</style>
@push('scripts')


    <script type="text/javascript"
        src="    https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>
    <!-- DataTables Buttons JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script> 




    {{-- <script type="text/javascript" src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script> --}}

   

{{-- 
    <script>
        function initializeDataTable(tableId) {
            // Initialize DataTable with the specified table ID
            new DataTable(tableId, {
                title: 'User Activities',
                layout: {
                    topStart: {
                        buttons: ['copy', 'excel', 'csv', 'pdf', 'print', 'colvis',
                            {
                                extend: 'print',
                                title: 'User Activities',
                                messageTop: 'This print was produced using the Print button for DataTables',
                                text: 'Selected Print',
                                exportOptions: {
                                    columns: ':visible',
                                    modifier: {
                                        selected: null
                                    }
                                },
                                // customize: function(win) {
                                //     $(win.document.body).prepend(
                                //         '<div class="logo-container"><img src="/build/assets/img/logo/rntu.png" width="200" alt="Logo 1" class="logo"><img src="/build/assets/img/logo/rntu.png" alt="Logo 2" width="200"  class="logo second-logo"></div>'
                                //         );
                                // }

                            },
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
                            {
                                text: 'JSON',
                                action: function(e, dt, button, config) {
                                    var data = dt.buttons.exportData();
                                    DataTable.fileSave(new Blob([JSON.stringify(data)]), 'Export.json');
                                }
                            },

                            // {
                            //     extend: 'csv',
                            //     title: 'User Activities',
                            //     exportOptions: {
                            //         columns: ':visible'
                            //     },
                            //     split: ['copy', 'excel', 'csv', 'pdf', 'print']
                            // },

                        ]
                    }
                },
                // columnDefs: [{
                //     targets: -2,
                //     visible: false
                // }]
                responsive: true,
                select: true,

            });
        }

        // // Call the function with the desired table ID
        // initializeDataTable('#example');
    </script> --}}

    {{-- <script>
        new DataTable('#example', {
            responsive: true
        });
    </script> --}}
@endpush
