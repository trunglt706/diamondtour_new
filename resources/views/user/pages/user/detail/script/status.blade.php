<script>
    $(document).on('click', '.update-status', function(e) {
        e.preventDefault();
        if (confirm('Xác nhận thực hiện chức năng này?')) {
            const status = $(this).data('status');
            const id = $(this).data('id');
            $(this).html(`<span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
  <span role="status">Loading...</span>`);
            location.href = "{{ route('admin.admin.updateStatus') }}?id=" + id + "&status=" + status;
        }
    })
</script>
