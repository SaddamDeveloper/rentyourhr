<script>
    $(document).ready(function() {
        $("#user-add-frm").on("submit", function(e) {
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
                        $("#user-add-frm").trigger("reset");
                    } else {
                        toastr.success(response.data.message);
                        window.location = "{{ route('admin.users') }}";
                    }
                },
                error: function(error) {
                    loderStop();
                    console.log(error);
                }
            });
        });

        $("#user-edit-frm").on("submit", function(e) {
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

        $(document).on('click', '.make-archive', function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var $this = $(this);
            $.confirm({
                title: 'Archive User',
                content: 'Are you want to archive this user?',
                buttons: {
                    confirm: function () {
                        $.post({
                            type: "PUT",
                            url: "{{ route('admin.user.change_status') }}",
                            data : { "id": $this.data('id'), "status": 0 }
                        }).done(function (data) {
                            if (data.success) {
                                toastr.success(data.success.message);
                                $('.status-col-' + $this.data('id')).html('').html('<button class="btn btn-xs btn-danger make-active" data-id="'+ $this.data('id') + '">Archive</button>');
                                row.remove();
                            }else{
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

        $(document).on('click', '.make-active', function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var $this = $(this);
            $.confirm({
                title: 'Active User',
                content: 'Are you want to activate this user?',
                buttons: {
                    confirm: function () {
                        $.post({
                            type: "PUT",
                            url: "{{ route('admin.user.change_status') }}",
                            data : { "id": $this.data('id'), "status": 1 }
                        }).done(function (data) {
                            if (data.success) {
                                toastr.success(data.success.message);
                                $('.status-col-' + $this.data('id')).html('').html('<button class="btn btn-xs btn-success make-archive" data-id="'+ $this.data('id') + '">Active</button>');
                                row.remove();
                            }else{
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
