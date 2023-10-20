<script>
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
                "title": {
                    required: true,
                    minlength: 10,
                    maxlength: 255
                },
                "content": {
                    required: true,
                    minlength: 20
                },
            },
            messages: {
                "title": {
                    required: 'Title is required.',
                    minlength: 'Title must be at least 10 characters.',
                    maxlength: 'Title maximum 255 characters'
                },
                "content": {
                    required: 'Content is required.',
                    minlength: 'Content must be at least 20 characters.',
                },
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
