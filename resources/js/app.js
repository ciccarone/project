import './bootstrap';
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';

document.addEventListener('DOMContentLoaded', function () {
    tippy('[data-tippy-content]');
});

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


