<script type="text/javascript">
    $(document).on('change', '.changestatus', function (e) {
        e.preventDefault();
        var $this = $(this);
        var id = $(this).attr('id');
        var staus = $(this).val();
        $.confirm({
            title: 'Order Status Change!',
            content: 'Are you want to change order Status to ' + staus + '?',
            buttons: {
                confirm: function () {
                    loderStart();
                    $.post({
                        type: "POST",
                        url: "{{ route('admin.order.status') }}",
                        data: {
                            'id': id,
                            'status': staus
                        }
                    }).done(function (data) {
                        if (data.success) {
                            toastr.error(data.success.message);
                        } else {
                            toastr.error(data.error.message);
                        }
                        loderStop();
                    });
                },
                cancel: function () {}
            }
        });
    });
</script>
