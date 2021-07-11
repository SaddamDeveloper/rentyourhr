<script>
    $(document).ready(function () {
        showHide();
        $(document).on('change', "input[name='permission_type']", function (event) {
            showHide();
        });

        function showHide() {
            var option = $("input[name='permission_type']:checked").val();
            if (option === 'basic') {
                $("#basic_option_box").show();
                $("#curd_option_box").hide();
            }
            if (option === 'curd') {
                $("#curd_option_box").show();
                $("#basic_option_box").hide();
            }
        }

        $('#permission-create-form').on('submit', function (e) {
            e.preventDefault(e);
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $(".form-group").removeClass("has-error");
                    $(".invalid-feedback").remove();
                    loderStart();
                },
                complete: function () {},
                success: function (response) {
                    loderStop();
                    if (response.data.status === 'validation_error') {
                        printError(response.data.message);
                    } else if (response.data.status === 'error') {
                        toastr.error(response.data.message);
                        $('#permission-create-form').trigger("reset");
                    } else {
                        toastr.success(response.data.message);
                        $('#permission-create-form').trigger("reset");
                    }
                },
                error: function (error) {
                    loderStop();
                    console.log(error);
                },
            })
        });

        $('#permission-edit-form').on('submit', function (e) {
            e.preventDefault(e);
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $(".form-group").removeClass("has-error");
                    $(".invalid-feedback").remove();
                    loderStart();
                },
                complete: function () {},
                success: function (response) {
                    loderStop();
                    if (response.data.status === 'validation_error') {
                        printError(response.data.message);
                    } else if (response.data.status === 'error') {
                        toastr.error(response.data.message);
                    } else {
                        toastr.success(response.data.message);
                    }
                },
                error: function (error) {
                    loderStop();
                    printErrorMsg(error);
                },
            })
        });

        $(document).on('click', '.delete-permission', function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var $this = $(this);
            $.confirm({
                title: 'Delete Permission',
                content: 'Are you want to Delete this Permission?',
                buttons: {
                    confirm: function () {
                        $.post({
                            type: $this.data('method'),
                            url: $this.attr('href'),
                        }).done(function (data) {
                            if (data.success) {
                                toastr.success(data.success.message);
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
