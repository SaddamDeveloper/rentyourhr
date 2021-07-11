<script>
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    function loderStart() {
        $("body").loadingModal({
            position: "auto",
            text: "Loading",
            color: "#fff",
            opacity: "0.7",
            backgroundColor: "rgb(0,0,0)",
            animation: "doubleBounce"
        });
    }
    function loderStop() {
        $("body").loadingModal("destroy");
    }
    $(document).ready(function() {
        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: false,
            progressBar: true,
            positionClass: "toast-top-right",
            preventDuplicates: false,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            timeOut: "5000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })
    });
    function printError(errorData) {
        $.each(errorData, function(key, value) {
            if (key === 'roles') {
                $('.' + key).closest(".form-group").addClass("has-error");
                $('.' + key).closest(".form-group").append('<span class="help-block invalid-feedback"><strong>' + value[0] + '</strong></span>');
            } else if(key === 'permissions'){
                $('.' + key).closest(".form-group").addClass("has-error");
                $('.' + key).closest(".form-group").append('<span class="help-block invalid-feedback"><strong>' + value[0] + '</strong></span>');
            }else if (key === 'permission_type') {
                $('.' + key).closest(".form-group").addClass("has-error");
                $('.' + key).closest(".form-group").append('<span class="help-block invalid-feedback"><strong>' + value[0] + '</strong></span>');
            } else if (key === 'curd_selected') {
                $('.' + key).closest(".form-group").addClass("has-error");
                $('.' + key).closest(".form-group").append('<span class="help-block invalid-feedback"><strong>' + value[0] + '</strong></span>');
            } else {
                $("#" + key).parent().addClass("has-error");
                $("#" + key).parent().append('<span class="help-block invalid-feedback"><strong>' + value[0] + '</strong></span>');
            }
        });
    }

</script>
