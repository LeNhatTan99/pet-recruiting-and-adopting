<script>
    var route = $('#myForm').attr("action");
    var isSubmitting = false;
    function performSearch() {
        if (isSubmitting) {
            return;
        }
        isSubmitting = true;
        // get value input and select
        var nameValue = $('input[name=name]').val();
        var typeValue = $('#selectInputType').val();
        var breedValue = $('#selectInputBreed').val();
        var genderValues = [];
        var agesValues = [];
        $('input[name="genders[]"]:checked').each(function() {
            genderValues.push($(this).val());
        });

        $('input[name="ages[]"]:checked').each(function() {
            agesValues.push($(this).val());
        });

        // create URL search
        let url = route + '?name=' + nameValue + '&type=' + typeValue + '&breed=' + breedValue;
        if (genderValues.length) {
            url = url + '&genders%5B%5D=' + genderValues.join('&genders%5B%5D=');
        }
        if (agesValues.length) {
            url = url + '&ages%5B%5D=' + agesValues.join('&ages%5B%5D=');
        }
        // send AJAX request
        $.ajax({
            url: url,
            method: 'get',
            success: function(result) {
                $('.antialiased').html(result);
                isSubmitting = false;
            },
            error: function(error) {
                console.log(error);
                isSubmitting = false;
            }
        });
    }
    $('input[name="name"], #selectInputType, #selectInputBreed, #checkboxInputGender, #checkboxInputAge').on('change',
        function() {
            performSearch();
        });

$(document).ready(function() {
    $(".create-form").validate({
        onfocusout: function(element, event) {
            var val = $(element).val().trim()
            $(element).val(val)
            $(element).valid();
        },
        submitHandler: function(form) {
            form.submit();
        },
        showErrors: function(errorMap, errorList) {
            var errorForm = this.numberOfInvalids();
            if (errorForm >= 1) {
                $(".btn-adopt").attr("disabled", true);
            } else {
                $(".btn-adopt").attr("disabled", false);
            }
            var $errorDiv = $("#errordiv").empty().show();
            this.defaultShowErrors();
            var errorsCombined = "";
            for (var el in errorMap) {
                errorsCombined += "<b>" + el + "</b>" + errorMap[el] + "<br/>";
            }
            $errorDiv.append(errorsCombined);
        },
        invalidHandler: function(event, validator) {
            var errors = validator.numberOfInvalids();
        },

        rules: {
            "reason": {
                required: true,
                minlength: 10,
            }
        },
        messages: {
            "reason": {
                required: 'Reason is required.',
                minlength: 'Reason must be at least 10 characters.'
            }
        },
        errorElement: 'p',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                element.parent().after(error);
                $(element).closest('.form-group').find('.error-commit').focusout().hide();
            }
        }
    });


    $('.btn-adoption').click(function() {
        // Retrieve the 'data-id' value from the clicked button
        var adoptionId = $(this).data('id');
        // Create a new URL based on the 'adoptionId'
        var newAction = "{{ route('user.adopt', 'id') }}".replace('id', adoptionId);
        // Set the 'action' attribute for the form
        $('.create-form').attr('action', newAction);
    });
    $('.btn-adopt').click(function(e) {
        e.preventDefault();
        // Obtain the URL from the form's 'action' attribute
        var url = $('.create-form').attr('action');
        // Retrieve the 'reason' from the input field
        var reason = $('input[name="reason"]').val();
        // Perform an AJAX request to submit the form
        $.ajax({
            url: url,
            data: {
                reason: reason
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            success: function(result) {
                // Handle success response
                if (result.success && result.message) {
                    toastr.success(result.message);
                } else {
                    toastr.error(result.message);
                }
                $('#showModal').hide();
                $('.modal-backdrop').hide();
            },
            error: function(error) {
                // Handle errors
                console.log(error);
                if (error.statusText && error.statusText === 'Unauthorized') {
                    toastr.error('You must be logged in to perform this function');
                }else if (error.status == 422) {
                    toastr.error(error.responseJSON.errors.reason);
                } else {
                    toastr.error('An error occurred, please try again');
                }
                $('#showModal').hide();
                $('.modal-backdrop').hide();
            },
        });
    });
})
</script>
