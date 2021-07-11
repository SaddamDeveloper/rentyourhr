<script>
$(document).ready(function() {
     $("#jobCartOrderFrm").on("submit", function(e) {
        e.preventDefault(e);
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $(".single-input").removeClass("has-error");
                $(".frm-feedback").remove();
                loderStart();
            },
            complete: function() {},
            success: function(response) {
                loderStop();
                if (response.data.status === "validation_error") {
                    printError(response.data.message);
                } else if (response.data.status === "error") {
                    toastr.error(response.data.message);
                } else {
                    toastr.success(response.data.message);
                    window.location = "{{ route('un.paid.invoice') }}";
                }
            },
            error: function(error) {
                loderStop();
                console.log(error);
            }
        });
    });

    $(document).on('click', '.delete-job', function (e) {
        e.preventDefault();
        var row = $(this).closest('tr');
        var $this = $(this);
        $.confirm({
            title: 'Delete job profile',
            content: 'Are you want to delete the job profile?',
            buttons: {
                confirm: function () {
                    loderStart();
                    $.post({
                        type: $this.data('method'),
                        url: $this.attr('href')
                    }).done(function (data) {
                        loderStop();
                        if (data.success) {
                            toastr.success(data.success.message);
                            row.remove();
                        } else {
                            toastr.error(data.error.message);
                        }
                    });
                },
                cancel: function () {
                    $.alert('Canceled!');
                }
            }
        });
    });
});
</script>
