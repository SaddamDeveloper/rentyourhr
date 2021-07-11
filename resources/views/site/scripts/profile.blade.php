<script>
$(document).ready(function() {
    $(document).on('submit', '#profileFrm', function (e) {
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
                    window.location = "{{ route('profile') }}";
                }
            },
            error: function(error) {
                loderStop();
                console.log(error);
            }
        });
    });

    $('.city').select2({
        placeholder: "Select City",
        theme : "bootstrap"
    });
    $('.state').select2({
        placeholder: "Select State",
        theme : "bootstrap"
    });
    $(document).on('change', '.state', function () {
        var state_id = $(this).select2('data')[0].element.attributes[1].value;
        $.ajax({
            type: "GET",
            url: "{{ env('APP_URL') }}"+"/get_cities/" + state_id,
            dataType: 'json',
            beforeSend: function () {
                $('.city').html('');
                loderStart();
            },
            success: function (response) {
                loderStop();
                var data = response.cities;
                if ($.isEmptyObject(data)) {
                    $('.city').select2({
                        placeholder: "No City Found",
                        theme : "bootstrap"
                    });
                } else {
                    var city_html = '<option></option>';
                    $.each(data, function (i, e) {
                        city_html += '<option value="' + e.name + '" data-city="' + e.id + '">' + e.name + '</option>';
                    });
                    $('.city').html(city_html);
                    $('.city').select2({
                        placeholder: "Select City",
                        theme : "bootstrap"
                    });
                }
            }
        })
    });
    $(document).on('submit', '#userAddressFrm', function (e) {
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
                    $('#name').val("");
                    $('#address').val("");
                    $('#zip').val("");
                    $('#state').val("");
                    $('#city').val("");
                    toastr.success(response.data.message);
                    $("#user-address-table").append(response.data.html);
                }
            },
            error: function(error) {
                loderStop();
                console.log(error);
            }
        });
    });

    $(document).on('click', '.delete-address', function (e) {
        e.preventDefault();
        var row = $(this).closest('tr');
        var $this = $(this);
        $.confirm({
            title: 'Delete address',
            content: 'Are you want to delete the address?',
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
