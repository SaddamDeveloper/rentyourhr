
<script>
$(document).ready(function() {

    $(document).on('click', '#adToCart', function (e) {
        e.preventDefault(e);
        $.ajax({
            type: "POST",
            url: $("#jobCartAddFrm").attr("action"),
            data: $("#jobCartAddFrm").serialize(),
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
                    window.location = "{{ route('products') }}";
                }
            },
            error: function(error) {
                loderStop();
                console.log(error);
            }
        });
    });

    $(document).on('click', '#buyNow', function (e) {
        e.preventDefault(e);
        $.ajax({
            type: "POST",
            url: $("#jobCartAddFrm").attr("action"),
            data: $("#jobCartAddFrm").serialize(),
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
                    window.location = "{{ route('job.checkout.list') }}";
                }
            },
            error: function(error) {
                loderStop();
                console.log(error);
            }
        });
    });

    onPageload();
    function onPageload(){
        get_state_list('.state');
        get_position_list('.job_profile_id');
        $('.city').select2({
            placeholder: "Select City",
            theme : "bootstrap"
        });
        $('.package_id').select2({
            placeholder: "Select Package",
            theme : "bootstrap"
        });
    }

    function get_state_list(stateTag) {
        $.ajax({
            type: "GET",
            url: "{{ env("APP_URL") }}"+"/get_states/",
            dataType: 'json',
            beforeSend: function () {
                $(stateTag).html('');
                loderStart();
            },
            success: function (response) {
                loderStop();
                var data = response.states;
                if ($.isEmptyObject(data)) {
                    $(stateTag).select2({
                        placeholder: "No State Found",
                        theme : "bootstrap"
                    });
                } else {
                    var state_html = '<option></option>';
                    $.each(data, function (i, e) {
                        state_html += '<option value="' + e.name + '" data-state="' + e.id + '">' + e.name + '</option>';
                    });
                    $(stateTag).html(state_html);
                    $('.state').select2({
                        placeholder: "Select State",
                        theme : "bootstrap"
                    });
                }
            }
        })
    }

    function get_position_list(positionTag) {
        $.ajax({
            type: "GET",
            url: "{{ env("APP_URL") }}"+"/get_position/",
            dataType: 'json',
            beforeSend: function () {
                $(positionTag).html('');
                loderStart();
            },
            success: function (response) {
                loderStop();
                var data = response.profiles;
                if ($.isEmptyObject(data)) {
                    $(positionTag).select2({
                        placeholder: "No Position Found"
                    });
                } else {
                    var position_html = '<option></option>';
                    $.each(data, function (i, e) {
                        position_html += '<option value="' + e.id + '" data-position="' + e.id + '">' + e.job_name + ' @ ('+e.minimum +' - '+e.maximum+') / Month'+ '</option>';
                    });
                    $(positionTag).html(position_html);
                    $('.job_profile_id').select2({
                        placeholder: "Select Position",
                        theme : "bootstrap"
                    });
                }
            }
        })
    }

    $(document).on('change', '.state', function () {
        get_city_list('.state', '.city');
    });

    function get_city_list(stateTag, cityTag) {
        var state_id = $(stateTag).select2('data')[0].element.attributes[1].value;
        $.ajax({
            type: "GET",
            url: "{{ env("APP_URL") }}"+"/get_cities/" + state_id,
            dataType: 'json',
            beforeSend: function () {
                $(cityTag).html('');
                loderStart();
            },
            success: function (response) {
                loderStop();
                var data = response.cities;
                if ($.isEmptyObject(data)) {
                    $(cityTag).select2({
                        placeholder: "No City Found",
                        theme : "bootstrap"
                    });
                } else {
                    var city_html = '<option></option>';
                    $.each(data, function (i, e) {
                        city_html += '<option value="' + e.name + '" data-city="' + e.id + '">' + e.name + '</option>';
                    });
                    $(cityTag).html(city_html);
                    $('.city').select2({
                        placeholder: "Select City",
                        theme : "bootstrap"
                    });
                }
            }
        })
    }

    $(document).on('change', '.job_profile_id', function () {
        get_package_list('.job_profile_id', '.package_id');
    });

    function get_package_list(positionTag, packageTag) {
        var profile_id = $(positionTag).select2('data')[0].element.attributes[1].value;
        $.ajax({
            type: "GET",
            url: "{{ env("APP_URL") }}"+"/get_package/" + profile_id,
            dataType: 'json',
            beforeSend: function () {
                $(packageTag).html('');
                loderStart();
            },
            success: function (response) {
                loderStop();
                var data = response.packages;
                if ($.isEmptyObject(data)) {
                    $(packageTag).select2({
                        placeholder: "No Package Found",
                        theme: "bootstrap"
                    });
                } else {
                    var package_html = '<option></option>';
                    $.each(data, function (i, e) {
                        package_html += '<option value="' + e.id + '" data-amount="' + e.amount + '">' + e.replace_day + ' Days Replacement @ ' + e.amount + '</option>';
                    });
                    $(packageTag).html(package_html);
                    $('.package_id').select2({
                        placeholder: "Select Package",
                        theme: "bootstrap"
                    });
                }
            }
        })
    }

    /** ======== Calculation*/
    $(document).on('change', '.package_id', function () {
        var amount = $(this).select2('data')[0].element.attributes[1].value;
        var quantity = $('#quantity').val();
        if (quantity>0) {
            var total = parseFloat(amount * quantity);
        } else {
            $('#quantity').val(1);
            var total = parseFloat(amount * 1);
        }
        $('#total').val(total);
    });

    $(document).on('change', '#quantity', function () {
        var amount = $('.package_id').select2('data')[0].element.attributes[1].value;
        var quantity = $(this).val();
        if (quantity>0) {
            var total = parseFloat(amount * quantity);
        } else {
            $('#quantity').val(1);
            var total = parseFloat(amount * 1);
        }
        $('#total').val(total);
    });

    $(document).on('keydown', '#quantity' , function(e){
        chkInt(e);
    })
    $(document).on('keydown', '#min_salary' , function(e){
        chkFloat(e);
    })
    $(document).on('keydown', '#max_salary' , function(e){
        chkFloat(e);
    })

    function chkInt(e){
        // Allow: backspace, delete, tab, escape, enter
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||  (e.keyCode >= 35 && e.keyCode <= 39)){
        return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    }

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
