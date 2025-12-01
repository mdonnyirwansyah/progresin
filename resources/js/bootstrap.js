/* Bootstrap core */
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

/* Feather icons */
import feather from 'feather-icons';

/* JQuery */
import $ from 'jquery';
window.$ = window.jQuery = $;

/* Select2 */
import select2 from 'select2'
window.select2 = select2();

/* DataTables (Bootstrap 5 + Responsive) */
import 'datatables.net-bs5';
import 'datatables.net-responsive-bs5';

$(() => {
    feather.replace();

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
});

window.showLoading = () => {
    document.getElementById('loadingOverlay').classList.remove('d-none');
}

window.hideLoading = () => {
    document.getElementById('loadingOverlay').classList.add('d-none');
}
