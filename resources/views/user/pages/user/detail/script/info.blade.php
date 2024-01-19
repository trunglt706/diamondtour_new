@include('admin::admin.detail.script.status')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {

        initSelect2('.filter-role_id', "-- Chọn --", 'admin_roles');
        initSelect2('.filter-group_id', "-- Chọn --", 'admin_groups');

        $(document).on('click', '.add-new', function(e) {
            e.preventDefault();
            const modal = $(this).data('modal');
            $('#' + modal).modal('show');
        })

        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            "setDate": new Date(),
            "autoclose": true,
            todayHighlight: true
        });

        const form_create_group = $("form#form-create-group");
        if (form_create_group) {
            const action = form_create_group.attr("action");
            form_create_group.submit(function(e) {
                e.preventDefault();
                $("#form-create-group .btn-create").html(
                    `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status"> Loading...</span>`
                );
                const data = new FormData($(this)[0]);
                $.ajax({
                    url: action,
                    data: data,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    success: function(rs) {
                        $("#form-create-group .btn-create").html(
                            `<i class="fas fa-plus"></i> Tạo mới`);
                        $("#form-create-role button[type=submit]").removeAttr("disabled");
                        if (rs.status == 200) {
                            $(".btn-close").click();
                            form_create_group[0].reset();
                            // add new data to group option
                            const {
                                id,
                                name
                            } = rs?.data;
                            const newOption = new Option(name, id, false, false);
                            $('.filter-group_id').append(newOption).val(id).trigger(
                                'change');
                        }
                        Toast.fire({
                            icon: rs?.type,
                            title: rs?.message
                        });
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        var err = eval("(" + XMLHttpRequest.responseText + ")");
                        $("#form-create-group .btn-create").html(
                            `<i class="fas fa-plus"></i> Tạo mới`);
                        $("#form-create-group button[type=submit]").removeAttr("disabled");
                        Toast.fire({
                            icon: "error",
                            title: err?.message ?
                                err?.message.split("!")[0] : "Tạo mới lỗi!",
                        });
                    },
                });
            });
        }

        const form_create_role = $("form#form-create-role");
        if (form_create_role) {
            const action = form_create_role.attr("action");
            form_create_role.submit(function(e) {
                e.preventDefault();
                $("#form-create-role .btn-create").html(
                    `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status"> Loading...</span>`
                );
                const data = new FormData($(this)[0]);
                $.ajax({
                    url: action,
                    data: data,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    success: function(rs) {
                        $("#form-create-role .btn-create").html(
                            `<i class="fas fa-plus"></i> Tạo mới`);
                        $("#form-create-role button[type=submit]").removeAttr("disabled");
                        if (rs.status == 200) {
                            $(".btn-close").click();
                            form_create_role[0].reset();
                            // add new data to role option
                            const {
                                id,
                                name
                            } = rs?.data;
                            const newOption = new Option(name, id, false, false);
                            $('.filter-role_id').append(newOption).val(id).trigger(
                                'change');
                        }
                        Toast.fire({
                            icon: rs?.type,
                            title: rs?.message
                        });
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        var err = eval("(" + XMLHttpRequest.responseText + ")");
                        $("#form-create-role .btn-create").html(
                            `<i class="fas fa-plus"></i> Tạo mới`);
                        $("#form-create-role button[type=submit]").removeAttr("disabled");
                        Toast.fire({
                            icon: "error",
                            title: err?.message ?
                                err?.message.split("!")[0] : "Tạo mới lỗi!",
                        });
                    },
                });
            });
        }
    })
</script>
