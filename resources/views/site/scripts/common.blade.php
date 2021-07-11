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
    });
    function printError(errorData) {
        $.each(errorData, function(key, value) {
            $("#" + key).addClass("error-feedback");
            $("#" + key).parent().append('<div class="frm-feedback">' + value[0] + '</div>');
        });
    }
@if(Session::has('message'))
  var type = "{{ Session::get('alert-type', 'info') }}";
  switch(type){
    case 'info':
      toastr.info("{{ Session::get('message') }}");
      break;

    case 'warning':
      toastr.warning("{{ Session::get('message') }}");
      break;

    case 'success':
      toastr.success("{{ Session::get('message') }}");
      break;

    case 'error':
      toastr.error("{{ Session::get('message') }}");
      break;
  }
@endif
</script>
