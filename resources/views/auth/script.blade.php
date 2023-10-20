<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const togglePasswordButton = document.getElementById('togglePassword');       
        togglePasswordButton.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                togglePasswordButton.textContent = 'Hide Password';
            } else {
                passwordInput.type = 'password';
                togglePasswordButton.textContent = 'Show Password';
            }
        });
    });
    $(document).ready(function () {
        $(".create-form").validate({
            onfocusout: function (element, event) {
                var val = $(element).val().trim()
                $(element).val(val)
                $(element).valid();
            },
            submitHandler: function (form) {
                form.submit();
            },
            showErrors: function (errorMap, errorList) {
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
            invalidHandler: function (event, validator) {
                var errors = validator.numberOfInvalids();
            },      
            rules: {
                "username": {
                    required: true,
                    minlength: 3,
                },
                "first_name": {
                    required: true,
                },
                "last_name": {
                    required: true,
                },
                "email": {
                    required: true,
                    email: true,
                },
                "address": {
                    required: true,
                },
                "phone_number": {
                    required: true,
                    minlength: 10,
                    maxlength: 16,
                },
                "password": {
                    minlength: 6,
                    required: true
                },
            },
            messages: {
                "username": {
                    required: 'Username is required.',
                    minlength: 'Username must be at least 3 characters.'
                },
                "first_name": {
                    required: 'First name is required.'
                },
                "last_name": {
                    required: 'Last name is required.'
                },
                "email": {
                    required: 'Email is required.',
                    email: 'Incorrect email format.'
                },
                "phone": {
                    required: 'Phone number is required.',
                    minlength: 'Phone number must be at least 10 characters.',
                    maxlength: 'Phone number maximum 16 characters'
                },
                "address": {
                    required: 'Address is required.'
                },
                "password": {
                    minlength: 'Password must be at least 6 characters.',
                    required: 'Password is required.'
                }
            },
            errorElement: 'p',
            errorPlacement: function (error, element) {
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