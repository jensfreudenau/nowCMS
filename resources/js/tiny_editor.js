tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample image link lists media searchreplace table visualblocks wordcount linkchecker pagebreak code',
    toolbar: 'undo redo | link image media table | pagebreak code | bold italic underline | bullist numlist outdent indent | removeformat visualblocks h2 h3 h4',
    tinycomments_author: 'Jens',
    pagebreak_split_block: true,
    images_upload_url: '/media_upload',
    images_upload_base_path: '/',
    typography_default_lang: 'de',
    convert_urls: false,
    images_file_types: 'jpeg,jpg,jpe,jfi,jif,jfif,png,gif,bmp,webp,heic',
    image_caption: true,
    height: 600,
    entity_encoding: "raw",
    extended_valid_elements: [
        'em[class|name|id]',
        'i[class|name|id]',
        'table[class=table]'
    ],
    valid_children: "+body[style], +style[type]",
    apply_source_formatting: false,
    table_default_attributes: {
        border: '0'
    },               //added option
    verify_html: false,
    image_class_list: [
        {title: 'None', value: 'me-4 mb-4 img-fluid'},
        {title: 'float left', value: 'float-start me-4 mb-4 img-fluid'},
        {title: 'float none', value: 'float-none me-4 mb-4 img-fluid'},
    ],
    mergetags_list: [
        {value: 'First.Name', title: 'First Name'},
        {value: 'Email', title: 'Email'},
    ]
});
