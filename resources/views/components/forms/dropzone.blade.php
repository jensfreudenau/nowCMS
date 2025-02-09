<script type="module">
    const uploadedImagesMap = {};
    const uploadedGpxMap = {};
    Dropzone.options.imagesDropzone = {
        maxFilesize: 40, // MB
        url: "{{route('journey.storeMedia')}}",
        addRemoveLinks: true,
        acceptedFiles: 'image/*',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
            uploadedImagesMap[file.name] = response.name
        },
        removedfile: function (file) {
            file.previewElement.remove()
            let name = '';
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedImagesMap[file.name]
            }
            $('form').find('input[name="images[]"][value="' + name + '"]').remove()
        },
        init: function () {
            @if(isset($journey) && $journey->images)
            const files = {!! json_encode($journey->images) !!}
            for( const i in files )
            {
                const file = files[i];
                this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
            }
            @endif
        }
    }
    Dropzone.options.gpxDropzone = {
        maxFilesize: 40, // MB
        url: "{{route('journey.storeMedia')}}",
        addRemoveLinks: true,
        acceptedFiles: '.gpx',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="gpx[]" value="' + response.name + '">')
            uploadedGpxMap[file.name] = response.name
        },
        removedfile: function (file) {
            file.previewElement.remove()
            let name = '';
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedGpxMap[file.name]
            }
            $('form').find('input[name="gpx[]"][value="' + name + '"]').remove()
        },
        init: function () {
            @if(isset($journey) && $journey->gpx)
            const files = {!! json_encode($journey->gpx) !!}
            for( const i in files )
            {
                const file = files[i];
                this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="gpx[]" value="' + file.file_name + '">')
            }
            @endif
        }
    }
    $('.button_delete_media').click(function () {
        let id = $(this).data("id");
        let token = $(this).data("token");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: '/journey/deleteMedia/' + id,
            type: "DELETE",
            dataType: "JSON",
            data: {
                "id": id,
                "slug": $(this).data('journey'),
                "type": $(this).data('type'),
                "_method": 'DELETE',
                "_token": token,
            },
            success: function () {
                $('#list_' + id).hide();
                $('#image_list_' + id).hide();
            },
            error: function (xhr) {
                console.log(xhr.responseText); // this line will save you tons of hours while debugging
            }
        });
    });
</script>
