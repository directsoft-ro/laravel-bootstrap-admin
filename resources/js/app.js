import $ from "jquery";
import "bootstrap";
import axios from "axios";
import {createApp} from 'vue/dist/vue.esm-bundler';
import {Tooltip} from "bootstrap";
import "bootstrap-datepicker/dist/js/bootstrap-datepicker.js";

// TinyMCE Editor
import "tinymce/tinymce";
import 'tinymce/icons/default/icons';
import 'tinymce/themes/silver/theme';
import 'tinymce/models/dom/model';
import 'tinymce/plugins/anchor';
import 'tinymce/plugins/autolink';
import 'tinymce/plugins/charmap';
import 'tinymce/plugins/codesample';
import 'tinymce/plugins/image';
import 'tinymce/plugins/link';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/media';
import 'tinymce/plugins/searchreplace';
import 'tinymce/plugins/table';
import 'tinymce/plugins/visualblocks';
import 'tinymce/plugins/wordcount';
import 'tinymce/plugins/code';

class Sidebar {
    constructor(config) {
        this.options = {
            selector: '#main-sidebar',
            btnToggleSelector: '.btn-toggle-sidebar',
            backSelector: '.sidebar-back',
            menuSelector: '.sidebar-menu', ...config
        };
    }

    init() {
        const elementSidebar = document.querySelector(this.options.selector);
        if (!elementSidebar) {
            return undefined;
        }

        const elementBtnToggle = document.querySelector(this.options.btnToggleSelector);
        if (!elementBtnToggle) {
            return undefined;
        }

        const elementBack = document.querySelector(this.options.backSelector);
        if (!elementBack) {
            return undefined;
        }

        elementBtnToggle.addEventListener('click', () => {
            if (window.innerWidth <= 1000) {
                document.body.classList.toggle('sidebar-opened');
            } else {
                document.body.classList.toggle('sidebar-collapsed');
            }
        });

        elementBack.addEventListener('click', () => {
            document.body.classList.remove('sidebar-opened');
        });

        const submenuItems = document.querySelectorAll(this.options.menuSelector + ' .has-submenu');
        Array.from(submenuItems).forEach((submenuItem) => {
            const anchor = submenuItem.querySelector('a[href="#"]');
            anchor.addEventListener('click', e => {
                e.preventDefault();
                submenuItem.classList.toggle('submenu-opened');
            });
        });
    }
}

window.axios = axios;
window.$ = $;

$(document).ready(function () {
    $('.datepicker').datepicker({
        autoclose: true, clearBtn: true, format: 'yyyy-mm-dd', todayBtn: true, todayHighlight: true, weekStart: 1,
    });
    tinymce.init({
        selector: '.editor',
        menubar: false,
        skin: false,
        content_css: false,
        content_style: 'body { font-family: "Open Sans", sans-serif; }',
        plugins: 'anchor autolink charmap codesample image link lists media searchreplace table visualblocks wordcount code',
        toolbar: 'blocks fontsize | bold italic underline strikethrough | link image | align | numlist bullist indent outdent | removeformat | code',
    });
});

const app = createApp({});

// Vue components
// app.component('example', Example);

app.mount('#app');

window.addEventListener('load', () => {
    (new Sidebar('#main-sidebar', '.btn-toggle-sidebar', '.sidebar-back')).init();
    // Activate bootstrap tooltip
    Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map((item) => {
        new Tooltip(item);
    });
});
