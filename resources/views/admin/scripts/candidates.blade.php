<script>
    $(document).ready(function() {
        $("#candidate-add-frm").on("submit", function(e) {
            e.preventDefault(e);
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: new FormData(this),
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(".form-group").removeClass("has-error");
                    $(".invalid-feedback").remove();
                    loderStart();
                },
                complete: function() {},
                success: function(response) {
                    loderStop();
                    console.log(response);
                    if (response.data.status === "validation_error") {
                        printError(response.data.message);
                    } else if (response.data.status === "duplicate_error") {
                        $("#email").parent().addClass("has-error");
                        $("#email").parent().append('<span class="help-block invalid-feedback"><strong>' + response.data.message + '</strong></span>');
                        $("#mobile").parent().addClass("has-error");
                        $("#mobile").parent().append('<span class="help-block invalid-feedback"><strong>' + response.data.message + '</strong></span>');
                    } else if (response.data.status === "error") {
                        toastr.error(response.data.message);
                    } else {
                        toastr.success(response.data.message);
                        window.location = "{{ route('admin.candidates') }}";
                    }
                },
                error: function(error) {
                    loderStop();
                    console.log(error);
                }
            });
        });

        $("#candidate-edit-frm").on("submit", function(e) {
            e.preventDefault(e);
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: new FormData(this),
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(".form-group").removeClass("has-error");
                    $(".invalid-feedback").remove();
                    loderStart();
                },
                complete: function() {},
                success: function(response) {
                    loderStop();
                    console.log(response);
                    if (response.data.status === "validation_error") {
                        printError(response.data.message);
                    } else if (response.data.status === "duplicate_error") {
                        $("#email").parent().addClass("has-error");
                        $("#email").parent().append('<span class="help-block invalid-feedback"><strong>' + response.data.message + '</strong></span>');
                        $("#mobile").parent().addClass("has-error");
                        $("#mobile").parent().append('<span class="help-block invalid-feedback"><strong>' + response.data.message + '</strong></span>');
                    } else if (response.data.status === "error") {
                        toastr.error(response.data.message);
                    } else {
                        toastr.success(response.data.message);
                        window.location = "{{ route('admin.candidates') }}";
                    }
                },
                error: function(error) {
                    loderStop();
                    console.log(error);
                }
            });
        });

    });
</script>
