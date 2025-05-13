
<script src="https://cdn.tiny.cloud/1/enj6vwjkaod8my9vbjwxfphgvru2cmiw98p4fks6xqp9jgpn/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
<script>
    var editorHandlerTimeout;
    function my_switch_tinymce_p_br( $settings ) {
        $settings['forced_root_block'] = 'br';
        return $settings;
    }
    tinymce.init({
        selector: '#description',
        plugins: 'anchor autolink charmap codesample image link lists media searchreplace table visualblocks wordcount linkchecker pagebreak code imagetools',
        toolbar: 'styleselect undo redo | link table | pagebreak code | bold italic underline | bullist numlist outdent indent | removeformat visualblocks h1 h2 h3 h4| image',
        tinycomments_author: 'Jens',
        pagebreak_split_block: true,
        tiny_mce_before_init: my_switch_tinymce_p_br,
        images_upload_url: '{{route("upload")}}',
        images_upload_base_path: '{{ url('')}}',
        typography_default_lang: 'de',
        convert_urls: false,
        images_file_types: 'jpeg,jpg,jpe,jfi,jif,jfif,png,gif,bmp,webp,heic',
        image_caption: true,
        height: 1200,
        entity_encoding: "raw",
        extended_valid_elements: [
            'em[class|name|id]',
            'i[class|name|id]',
            'table[class=table]',
            'h2[class]'
        ],
        style_formats: [
            { title: 'H2 Groß', selector: 'h2', classes: 'font-bold text-5xl pb-11' },
            { title: 'H2 Normal', selector: 'h2', classes: 'font-bold text-3xl pb-11' }
        ],
        valid_children: "+body[style], +style[type]",
        apply_source_formatting: false,
        table_default_attributes: {
            border: '0'
        },
        verify_html: false
    });


</script>
