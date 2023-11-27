<script>
    $(document).ready(function() {
        let selectedFiles = [];
        $('#file-input').on('change', function(event) {
            const previewContainer = $('#preview-container');
            previewContainer.empty();
            const files = event.target.files;
            selectedFiles = [...files];
            for (const file of files) {
                const previewItem = $('<div class="preview-item"></div>');
                if (file.type.startsWith('image/')) {
                    const img = $('<img class="mx-auto d-block">');
                    img.attr('src', URL.createObjectURL(file));
                    previewItem.append(img);
                } else if (file.type.startsWith('video/')) {
                    const video = $('<video class="mx-auto d-block" controls></video>');
                    video.attr('src', URL.createObjectURL(file));
                    previewItem.append(video);
                }
                previewContainer.append(previewItem);
            }
        });

        var deletedMediaIds = [];
        $('.btn-delete-media').on('click', function () {
            var mediaId = $(this).data('media-id');
            var index = deletedMediaIds.indexOf(mediaId);
            if (index === -1) {
                deletedMediaIds.push(mediaId);
            } else {
                deletedMediaIds.splice(index, 1);
            }
            $('#delete_media_ids').val(JSON.stringify(deletedMediaIds));

            $(this).closest('.preview-item-edit').parent().hide();
        });
    });

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
                'media[]': {
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
                "media[]": {
                    required: 'Images/Video is required.'
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
                var mediaInfo = JSON.parse(response.animal.media_info);

                modal.find('.about-avatar').empty();
                // Loop through each media item
                mediaInfo.forEach(function(media) {
                    if (media.type === 'image') {
                        // Handle image
                        modal.find('.about-avatar').append('<img class="result-image" src="{{ asset('storage') }}/' + media.url + '" alt="image"  style="max-width: 100%">');
                    } else if (media.type === 'video') {
                        // Handle video
                        modal.find('.about-avatar').append('<video style="max-width: 100%; height: 300px" class="result-video" controls><source src="{{ asset('storage') }}/' + media.url + '" type="video/mp4">Your browser does not support the video tag.</video>');
                    }
                });
                
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>
