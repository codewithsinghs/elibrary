@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.2/css/select.dataTables.css">
@endpush

@push('script')
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/2.0.2/js/dataTables.select.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/2.0.2/js/select.dataTables.js"></script>
@endpush

<script>
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
</script>
