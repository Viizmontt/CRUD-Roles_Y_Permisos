@section('js')

    <script type="importmap">
        {
        "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.1/"
            }
        }
    </script>

    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Paragraph,
            Bold,
            Italic,
            Font
        } from 'ckeditor5';
    
        // Función para crear un editor CKEditor
        function createEditor(selector) {
            return ClassicEditor
                .create( document.querySelector( selector ), {
                    plugins: [ Essentials, Paragraph, Bold, Italic, Font ],
                    toolbar: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                    ]
                } )
                .then( editor => {
                    window.editor = editor;
                } )
                .catch( error => {
                    console.error( error );
                } );
        }
    
        // Crear los editores para los elementos con ID #editor1 y #editor2
        Promise.all([
            createEditor('#editor1'),
            createEditor('#editor2')
        ]).then(() => {
            console.log('Both editors initialized.');
        }).catch(error => {
            console.error('Error initializing editors:', error);
        });
    </script>
    

    <script>
        window.onload = function() {
            if ( window.location.protocol === 'file:' ) {
                alert( 'This sample requires an HTTP server. Please serve this file with a web server.' );
            }
        };
    </script>
@endsection