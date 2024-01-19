@include('admin::admin.detail.script.status')
<script>
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        "setDate": new Date(),
        "autoclose": true,
        todayHighlight: true
    });

    $('.datepicker').on('change', function() {
        $('#form-filter').submit();
    });

    const routeList = "{{ route('admin.log_action.list') }}";
    filterTable();

    function filterTable(currentPage = 1) {
        loadTable(routeList, currentPage);
    };
</script>
