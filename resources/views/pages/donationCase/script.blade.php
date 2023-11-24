<script>
    $(document).ready(function() {
        $(".create-form1").validate({
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
                    $(".submit-form").attr("disabled", true);
                } else {
                    $(".submit-form").attr("disabled", false);
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
                "amount": {
                    required: true,
                    numeric: true
                },
            },
            messages: {
                "amount": {
                    required: 'Amount is required.',
                    numeric: 'Amount is numeric'
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
    })
</script>
