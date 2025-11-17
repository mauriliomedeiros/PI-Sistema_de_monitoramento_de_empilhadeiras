/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';



// start the Stimulus application
import './bootstrap';
import 'bootstrap4-toggle/js/bootstrap4-toggle.min.js';
import 'bootstrap4-toggle/css/bootstrap4-toggle.min.css';
import 'bootstrap-toggle/js/bootstrap-toggle.min.js';
import 'bootstrap-toggle/css/bootstrap-toggle.min.css';
import $ from 'jquery';
window.$ = $;
window.jQuery = $;
global.$ = global.jQuery = $;

$(function () {
    $('[data-toggle="toggle"]').bootstrapToggle();
});

$(function () {
   $('input[type="checkbox"][data-toggle="toggle"]').each(function () {
       $(this).bootstrapToggle();
   })
});
