import './bootstrap';
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';


document.addEventListener('DOMContentLoaded', function () {
    tippy('[data-tippy-content]');
});

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    var editors = document.querySelectorAll('.wysiwyg-editor');
    editors.forEach(function(editor) {
        var quill = new Quill(editor, {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    ['link', 'image'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }]
                ]
            }
        });

        // Set initial content
        var hiddenInput = editor.nextElementSibling;
        quill.root.innerHTML = hiddenInput.value;

        // Ensure the content is submitted with the form
        var form = editor.closest('form');
        form.onsubmit = function() {
            hiddenInput.value = quill.root.innerHTML;
        };
    });
});
