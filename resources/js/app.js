import './bootstrap';
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';

import tinymce from 'tinymce/tinymce';

// Import TinyMCE plugins and themes
import 'tinymce/themes/silver';
import 'tinymce/plugins/link';
import 'tinymce/plugins/image';
import 'tinymce/plugins/code';

// Initialize TinyMCE
document.addEventListener('DOMContentLoaded', function () {
    tinymce.init({
        selector: 'textarea.wysiwyg-editor',
        plugins: 'link image code',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code'
    });
});

document.addEventListener('DOMContentLoaded', function () {
    tippy('[data-tippy-content]');
});

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


