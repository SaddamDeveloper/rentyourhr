<script>
    $(document).ready(function() {
        $("#package-add-frm").on("submit", function(e) {
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
                    loderStop();
                    if (response.data.status === "validation_error") {
                        printError(response.data.message);
                    } else if (response.data.status === "error") {
                        toastr.error(response.data.message);
                    } else {
                        toastr.success(response.data.message);
                        window.location = "{{ route('admin.packages') }}";
                    }
                },
                error: function(error) {
                    loderStop();
                    console.log(error);
                }
            });
        });

        $("#package-edit-frm").on("submit", function(e) {
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

        $(document).on('click', '.delete-package', function (e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var $this = $(this);
            $.confirm({
                title: 'Delete package',
                content: 'Are you want to delete the package?',
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

        $(document).on('click', '.restore-package', function (e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var $this = $(this);
            $.confirm({
                title: 'Restore package',
                content: 'Are you want to restore the package?',
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
