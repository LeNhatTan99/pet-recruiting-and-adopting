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
                    const img = $('<img>');
                    img.attr('src', URL.createObjectURL(file));
                    previewItem.append(img);
                } else if (file.type.startsWith('video/')) {
                    const video = $('<video controls></video>');
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
</script>