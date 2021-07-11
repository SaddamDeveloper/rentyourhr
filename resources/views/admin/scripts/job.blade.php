<script>
    $(document).ready(function() {
        $("#job-add-frm").on("submit", function(e) {
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
                        window.location = "{{ route('admin.jobs') }}";
                    }
                },
                error: function(error) {
                    loderStop();
                    console.log(error);
                }
            });
        });

        $("#job-update-frm").on("submit", function(e) {
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

        $(document).on('click', '.delete-job', function (e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var $this = $(this);
            $.confirm({
                title: 'Delete Job Profile',
                content: 'Are you want to delete the Job Profile?',
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

        $(document).on('click', '.restore-job', function (e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var $this = $(this);
            $.confirm({
                title: 'Restore Job Profile',
                content: 'Are you want to restore the Job Profile?',
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

        $(document).on('click', '.view-package', function (e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: $(this).attr("href"),
                dataType: "json",
                beforeSend: function() {
                    loderStart();
                },
                complete: function() {},
                success: function(response) {
                    loderStop();
                    if (response.data.status === "success") {
                        $('#package-view').html('').html(response.data.html);
                    } else {
                        console.log(error);
                    }
                },
                error: function(error) {
                    loderStop();
                    console.log(error);
                }
            });
        });

        $(document).on('keydown', '#minimum' , function(e){
        chkFloat(e);
        })

        $(document).on('keydown', '#maximum' , function(e){
            chkFloat(e);
        })

        function chkFloat(e) {
        // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||  (e.keyCode >= 35 && e.keyCode <= 39)){
            return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        }

    });
</script>
