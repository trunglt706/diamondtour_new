@include('user.pages.user.detail.script.status')
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            "setDate": new Date(),
            "autoclose": true,
            todayHighlight: true
        });
    })
</script>
