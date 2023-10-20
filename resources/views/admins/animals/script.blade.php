<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#ImdID').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function() {
        $(".create-from").validate({
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
                "name": {
                    required: true,
                    minlength: 3,
                },
                "age": {
                    required: true,
                    numeric: true,
                },
                "type": {
                    required: true,
                },
                "breed": {
                    required: true,
                },
                "gender": {
                    required: true,
                },
                "status": {
                    required: true,
                },
                "description": {
                    required: true,
                },
                'image': {
                    required: true,
                }
            },
            messages: {
                "name": {
                    required: 'name is required.',
                    minlength: 'name must be at least 3 characters.'
                },
                "age": {
                    required: 'Age is required.'
                },
                "type": {
                    required: 'Type is required.'
                },
                "breed": {
                    required: 'Breed is required.',
                },
                "gender": {
                    required: 'Gender is required.',
                },
                "status": {
                    required: 'Status is required.'
                },
                "description": {
                    required: 'Description is required.'
                },
                "image": {
                    required: 'Image is required.'
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
    $(document).ready(function() {
        $('select[name="status"]').on('change', function() {
            // get value input and select
            var statusValue = $(this).val();
            var id = $(this).data('animal-id');
            let url = "{{ route('update-status.animal-case', ['id' => 'id']) }}".replace('id', id);
            // send AJAX request
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'post',
                data: {
                    status: statusValue
                },
                success: function(result) {
                    if (result.message) {
                        toastr.success(result.message);
                    }

                },
                error: function(error) {
                    console.log(url);
                    console.log(error);
                }
            });
        });
    })

    $(document).on('click', '#showButton', function() {
        var dataId = $(this).data('id');
        var modal = $('#showModal');
        let url = "{{ route('show.animal-case', ['id' => 'id']) }}".replace('id', dataId);
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                modal.find('.result-status').text(response.animal.status);
                modal.find('.result-name').text("Name: " + response.animal.name);
                modal.find('.result-description').text(response.animal.description);
                modal.find('.result-breed').text(response.animal.breed);
                modal.find('.result-type').text(response.animal.type);
                modal.find('.result-gender').text(response.animal.gender);
                modal.find('.result-age').text(response.animal.age);
                modal.find('.result-image').attr('src', '{{ asset('storage') }}/' + response.animal
                    .image);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>
