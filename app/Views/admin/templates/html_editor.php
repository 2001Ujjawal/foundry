<!-- Content Editor (TinyMCE) -->

<script src="<?= base_url('tinymce/tinymce.min.js') ?>"></script>

<script>
    tinymce.init({
        selector: '.documentTextEditor',
        plugins: 'lists',
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
        height: 350,
        setup: function(editor) {
            editor.on('change', function() {
                editor.save(); 
            });
        }
    });
</script>