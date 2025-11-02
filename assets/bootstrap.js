// assets/bootstrap.js

// Importa o jQuery e o Bootstrap
import $ from 'jquery';
import 'bootstrap';

// Garante que o Bootstrap Toggle (se você for usar) funcione corretamente
import 'bootstrap4-toggle/js/bootstrap4-toggle.min.js';
import 'bootstrap4-toggle/css/bootstrap4-toggle.min.css';

// Exemplo opcional: aplicar tooltips automaticamente
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});