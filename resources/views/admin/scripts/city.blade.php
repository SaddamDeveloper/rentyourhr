<script>
    $(document).ready(function() {
        $("#city-add-frm").on("submit", function(e) {
            e.preventDefault(e);
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $(".form-group").removeClass("has-error");
                    $(".invalid-feedback").remove();
                    loderStart();
                },
                complete: function() {},
                success: function(response) {
                    $("#btn-submit").attr("disabled", true);
                    loderStop();
                    if (response.data.status === "validation_error") {
                        printError(response.data.message);
                    } else if (response.data.status === "error") {
                        toastr.error(response.data.message);
                        $("#city-add-frm").trigger("reset");
                    } else {
                        toastr.success(response.data.message);
                        window.location = "{{ route('admin.cities') }}";
                    }
                },
                error: function(error) {
                    loderStop();
                    console.log(error);
                }
            });
        });

        $("#city-edit-frm").on("submit", function(e) {
            e.preventDefault(e);
            $.ajax({
                type: "PATCH",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $(".form-group").removeClass("has-error");
                    $(".invalid-feedback").remove();
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
                    }
                },
                error: function(error) {
                    loderStop();
                    console.log(error);
                }
            });
        });

        $(document).on('click', '.delete-city', function (e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var $this = $(this);
            $.confirm({
                title: 'Delete city',
                content: 'Are you want to delete the city?',
                buttons: {
                    confirm: function () {
                        $.post({
                            type: $this.data('method'),
                            url: $this.attr('href')
                        }).done(function (data) {
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
