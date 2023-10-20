<script> 
    $(document).ready(function () {
        $(".form-edit").validate({
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
                    $("#saveButton").attr("disabled", true);
                } else {
                    $("#saveButton").attr("disabled", false);
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
                    minlength: 'Password must be at least 6 characters.'
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
        $("#saveButton").click(function () {
            // Lấy dữ liệu từ trường nhập
            const username = $("input[name='username']").val();
            const firstName = $("input[name='first_name']").val();
            const lastName = $("input[name='last_name']").val();
            const email = $("input[name='email']").val();
            const phoneNumber = $("input[name='phone_number']").val();
            const address = $("input[name='address']").val();
            const password = $("input[name='password']").val();
            
            // Gửi AJAX Request
            $.ajax({
                method: "POST",
                url: "{{ route('edit.profile', ['username' => 'username']) }}".replace('username', username),
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                data: {
                        username: username,
                        first_name: firstName,
                        last_name: lastName,
                        email: email,
                        phone_number: phoneNumber,
                        address: address,
                        password: password,
                },
                success: function (response) {              
                    if (response.success) {
                        // update interface
                        toastr.success(response.message);
                        $("#username").text(username);
                        $("#fullname").text(firstName + ' ' + lastName);
                        $("#phone-number").text(phoneNumber);
                        $("#email").text(email);
                        $("#address").text(address);
    
                    } else {
                        //show toast failed
                        toastr.error('Failed to update profile');
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error(error.responseJSON.message);
                }
            });
        });
    });
    </script>