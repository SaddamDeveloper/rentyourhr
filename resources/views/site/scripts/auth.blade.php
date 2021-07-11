<script>
$(document).ready(function() {
    $("#validateLogin").on("submit", function(e) {
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
                if (response.data.status === "error") {
                    $("#errorBox").html("").html(response.data.message);
                } else {
                    toastr.success(response.data.message);
                    if (response.data.user.is_complete === 0) {
                        window.location = "{{ route('profile') }}";
                    } else {
                        window.location = "{{ route('welcome') }}";
                    }
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
