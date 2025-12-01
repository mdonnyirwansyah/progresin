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

window.setLanguageDatatables = (lang) => {
    let language;

    switch (lang) {
        case 'id':
            language = idLanguageDatatables;
            break

        default:
            language = enLanguageDatatables;
            break
    }

    return language;
}

const idLanguageDatatables = {
    "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
    "infoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
    "lengthMenu": "Tampilkan _MENU_ entri",
    "loadingRecords": "Sedang memuat...",
    "processing": "Sedang memproses...",
    "search": "Cari:",
    "zeroRecords": "Tidak ditemukan data yang sesuai",
    "paginate": {
        "first": "Pertama",
        "last": "Terakhir",
        "next": "Selanjutnya",
        "previous": "Sebelumnya"
    },
    "aria": {
        "sortAscending": ": aktifkan untuk mengurutkan kolom ke atas",
        "sortDescending": ": aktifkan untuk mengurutkan kolom menurun"
    },
    "autoFill": {
        "fill": "Isi semua sel dengan <i>%d<\/i>",
        "fillHorizontal": "Isi sel secara horizontal",
        "fillVertical": "Isi sel secara vertikal",
        "cancel": "Batal",
        "info": "Info"
    },
    "buttons": {
        "collection": "Kumpulan <span class='ui-button-icon-primary ui-icon ui-icon-triangle-1-s'\/>",
        "colvis": "Visibilitas Kolom",
        "colvisRestore": "Kembalikan visibilitas",
        "copy": "Salin",
        "copySuccess": {
            "_": "%d baris disalin ke papan klip",
            "1": "satu baris disalin ke papan klip"
        },
        "copyTitle": "Salin ke Papan klip",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Tampilkan semua baris",
            "_": "Tampilkan %d baris",
            "1": "Tampilkan satu baris"
        },
        "pdf": "PDF",
        "print": "Cetak",
        "copyKeys": "Tekan ctrl atau u2318 + C untuk menyalin tabel ke papan klip.<br \/><br \/>Untuk membatalkan, klik pesan ini atau tekan esc.",
        "createState": "Tambahkan Data",
        "removeAllStates": "Hapus Semua Data",
        "removeState": "Hapus Data",
        "renameState": "Rubah Nama",
        "savedStates": "SImpan Data",
        "stateRestore": "Publihkan Data",
        "updateState": "Perbaharui data"
    },
    "searchBuilder": {
        "add": "Tambah Kondisi",
        "button": {
            "0": "Cari Builder",
            "_": "Cari Builder (%d)"
        },
        "clearAll": "Bersihkan Semua",
        "condition": "Kondisi",
        "data": "Data",
        "deleteTitle": "Hapus filter",
        "leftTitle": "Ke Kiri",
        "logicAnd": "Dan",
        "logicOr": "Atau",
        "rightTitle": "Ke Kanan",
        "title": {
            "0": "Cari Builder",
            "_": "Cari Builder (%d)"
        },
        "value": "Nilai",
        "conditions": {
            "date": {
                "after": "Setelah",
                "before": "Sebelum",
                "between": "Diantara",
                "empty": "Kosong",
                "equals": "Sama dengan",
                "not": "Tidak sama",
                "notBetween": "Tidak diantara",
                "notEmpty": "Tidak kosong"
            },
            "number": {
                "empty": "Kosong",
                "equals": "Sama dengan",
                "gt": "Lebih besar dari",
                "gte": "Lebih besar atau sama dengan",
                "lt": "Lebih kecil dari",
                "lte": "Lebih kecil atau sama dengan",
                "not": "Tidak sama",
                "notEmpty": "Tidak kosong",
                "between": "Di antara",
                "notBetween": "Tidak di antara"
            },
            "string": {
                "contains": "Berisi",
                "empty": "Kosong",
                "endsWith": "Diakhiri dengan",
                "not": "Tidak sama",
                "notEmpty": "Tidak kosong",
                "startsWith": "Diawali dengan",
                "equals": "Sama dengan",
                "notContains": "Tidak Berisi",
                "notStartsWith": "Tidak diawali Dengan",
                "notEndsWith": "Tidak diakhiri Dengan"
            },
            "array": {
                "equals": "Sama dengan",
                "empty": "Kosong",
                "contains": "Berisi",
                "not": "Tidak",
                "notEmpty": "Tidak kosong",
                "without": "Tanpa"
            }
        }
    },
    "searchPanes": {
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "collapse": {
            "0": "Panel Pencarian",
            "_": "Panel Pencarian (%d)"
        },
        "emptyPanes": "Tidak Ada Panel Pencarian",
        "loadMessage": "Memuat Panel Pencarian",
        "clearMessage": "Bersihkan",
        "title": "Saringan Aktif - %d",
        "showMessage": "Tampilkan",
        "collapseMessage": "Ciutkan"
    },
    "infoThousands": ",",
    "datetime": {
        "previous": "Sebelumnya",
        "next": "Selanjutnya",
        "hours": "Jam",
        "minutes": "Menit",
        "seconds": "Detik",
        "unknown": "-",
        "amPm": [
            "am",
            "pm"
        ],
        "weekdays": [
            "Min",
            "Sen",
            "Sel",
            "Rab",
            "Kam",
            "Jum",
            "Sab"
        ],
        "months": [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ]
    },
    "editor": {
        "close": "Tutup",
        "create": {
            "button": "Tambah",
            "submit": "Tambah",
            "title": "Tambah inputan baru"
        },
        "remove": {
            "button": "Hapus",
            "submit": "Hapus",
            "confirm": {
                "_": "Apakah Anda yakin untuk menghapus %d baris?",
                "1": "Apakah Anda yakin untuk menghapus 1 baris?"
            },
            "title": "Hapus inputan"
        },
        "multi": {
            "title": "Beberapa Nilai",
            "info": "Item yang dipilih berisi nilai yang berbeda untuk input ini. Untuk mengedit dan mengatur semua item untuk input ini ke nilai yang sama, klik atau tekan di sini, jika tidak maka akan mempertahankan nilai masing-masing.",
            "restore": "Batalkan Perubahan",
            "noMulti": "Masukan ini dapat diubah satu per satu, tetapi bukan bagian dari grup."
        },
        "edit": {
            "title": "Edit inputan",
            "submit": "Edit",
            "button": "Edit"
        },
        "error": {
            "system": "Terjadi kesalahan pada system. (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Informasi Selebihnya<\/a>)."
        }
    },
    "stateRestore": {
        "creationModal": {
            "button": "Buat",
            "columns": {
                "search": "Pencarian Kolom",
                "visible": "Visibilitas Kolom"
            },
            "name": "Nama:",
            "order": "Penyortiran",
            "search": "Pencarian",
            "select": "Pemilihan",
            "title": "Buat State Baru",
            "toggleLabel": "Termasuk:",
            "paging": "Nomor Halaman",
            "scroller": "Posisi Skrol",
            "searchBuilder": "Cari Builder"
        },
        "emptyError": "Nama tidak boleh kosong.",
        "removeConfirm": "Apakah Anda yakin ingin menghapus %s?",
        "removeJoiner": "dan",
        "removeSubmit": "Hapus",
        "renameButton": "Ganti Nama",
        "renameLabel": "Nama Baru untuk %s:",
        "duplicateError": "Nama State ini sudah ada.",
        "emptyStates": "Tidak ada State yang disimpan.",
        "removeError": "Gagal menghapus State.",
        "removeTitle": "Penghapusan State",
        "renameTitle": "Ganti nama State"
    },
    "decimal": ",",
    "searchPlaceholder": "kata kunci pencarian",
    "select": {
        "cells": {
            "1": "1 sel dipilih",
            "_": "%d sel dipilih"
        },
        "columns": {
            "1": "1 kolom dirpilih",
            "_": "%d kolom dipilih"
        },
        "rows": {
            "1": "1 baris dipilih",
            "_": "%d baris dipilih"
        }
    },
    "thousands": "."
}

const enLanguageDatatables = {
    "emptyTable": "No data available in table",
    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
    "infoEmpty": "Showing 0 to 0 of 0 entries",
    "infoFiltered": "(filtered from _MAX_ total entries)",
    "infoThousands": ",",
    "lengthMenu": "Show _MENU_ entries",
    "loadingRecords": "Loading...",
    "processing": "Processing...",
    "search": "Search:",
    "zeroRecords": "No matching records found",
    "thousands": ",",
    "paginate": {
        "first": "First",
        "last": "Last",
        "next": "Next",
        "previous": "Previous"
    },
    "aria": {
        "sortAscending": ": activate to sort column ascending",
        "sortDescending": ": activate to sort column descending"
    },
    "autoFill": {
        "cancel": "Cancel",
        "fill": "Fill all cells with <i>%d<\/i>",
        "fillHorizontal": "Fill cells horizontally",
        "fillVertical": "Fill cells vertically"
    },
    "buttons": {
        "collection": "Collection <span class='ui-button-icon-primary ui-icon ui-icon-triangle-1-s'\/>",
        "colvis": "Column Visibility",
        "colvisRestore": "Restore visibility",
        "copy": "Copy",
        "copyKeys": "Press ctrl or u2318 + C to copy the table data to your system clipboard.<br><br>To cancel, click this message or press escape.",
        "copySuccess": {
            "1": "Copied 1 row to clipboard",
            "_": "Copied %d rows to clipboard"
        },
        "copyTitle": "Copy to Clipboard",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Show all rows",
            "_": "Show %d rows"
        },
        "pdf": "PDF",
        "print": "Print",
        "updateState": "Update",
        "stateRestore": "State %d",
        "savedStates": "Saved States",
        "renameState": "Rename",
        "removeState": "Remove",
        "removeAllStates": "Remove All States",
        "createState": "Create State"
    },
    "searchBuilder": {
        "add": "Add Condition",
        "button": {
            "0": "Search Builder",
            "_": "Search Builder (%d)"
        },
        "clearAll": "Clear All",
        "condition": "Condition",
        "conditions": {
            "date": {
                "after": "After",
                "before": "Before",
                "between": "Between",
                "empty": "Empty",
                "equals": "Equals",
                "not": "Not",
                "notBetween": "Not Between",
                "notEmpty": "Not Empty"
            },
            "number": {
                "between": "Between",
                "empty": "Empty",
                "equals": "Equals",
                "gt": "Greater Than",
                "gte": "Greater Than Equal To",
                "lt": "Less Than",
                "lte": "Less Than Equal To",
                "not": "Not",
                "notBetween": "Not Between",
                "notEmpty": "Not Empty"
            },
            "string": {
                "contains": "Contains",
                "empty": "Empty",
                "endsWith": "Ends With",
                "equals": "Equals",
                "not": "Not",
                "notEmpty": "Not Empty",
                "startsWith": "Starts With",
                "notContains": "Does Not Contain",
                "notStartsWith": "Does Not Start With",
                "notEndsWith": "Does Not End With"
            },
            "array": {
                "without": "Without",
                "notEmpty": "Not Empty",
                "not": "Not",
                "contains": "Contains",
                "empty": "Empty",
                "equals": "Equals"
            }
        },
        "data": "Data",
        "deleteTitle": "Delete filtering rule",
        "leftTitle": "Outdent Criteria",
        "logicAnd": "And",
        "logicOr": "Or",
        "rightTitle": "Indent Criteria",
        "title": {
            "0": "Search Builder",
            "_": "Search Builder (%d)"
        },
        "value": "Value"
    },
    "searchPanes": {
        "clearMessage": "Clear All",
        "collapse": {
            "0": "SearchPanes",
            "_": "SearchPanes (%d)"
        },
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "No SearchPanes",
        "loadMessage": "Loading SearchPanes",
        "title": "Filters Active - %d",
        "showMessage": "Show All",
        "collapseMessage": "Collapse All"
    },
    "select": {
        "cells": {
            "1": "1 cell selected",
            "_": "%d cells selected"
        },
        "columns": {
            "1": "1 column selected",
            "_": "%d columns selected"
        },
        "rows": {
            "1": "1 row selected",
            "_": "%d rows selected"
        }
    },
    "datetime": {
        "previous": "Previous",
        "next": "Next",
        "hours": "Hour",
        "minutes": "Minute",
        "seconds": "Second",
        "unknown": "-",
        "amPm": [
            "am",
            "pm"
        ],
        "weekdays": [
            "Sun",
            "Mon",
            "Tue",
            "Wed",
            "Thu",
            "Fri",
            "Sat"
        ],
        "months": [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ]
    },
    "editor": {
        "close": "Close",
        "create": {
            "button": "New",
            "title": "Create new entry",
            "submit": "Create"
        },
        "edit": {
            "button": "Edit",
            "title": "Edit Entry",
            "submit": "Update"
        },
        "remove": {
            "button": "Delete",
            "title": "Delete",
            "submit": "Delete",
            "confirm": {
                "_": "Are you sure you wish to delete %d rows?",
                "1": "Are you sure you wish to delete 1 row?"
            }
        },
        "error": {
            "system": "A system error has occurred (<a target=\"\\\" rel=\"nofollow\" href=\"\\\">More information<\/a>)."
        },
        "multi": {
            "title": "Multiple Values",
            "info": "The selected items contain different values for this input. To edit and set all items for this input to the same value, click or tap here, otherwise they will retain their individual values.",
            "restore": "Undo Changes",
            "noMulti": "This input can be edited individually, but not part of a group. "
        }
    },
    "stateRestore": {
        "renameTitle": "Rename State",
        "renameLabel": "New Name for %s:",
        "renameButton": "Rename",
        "removeTitle": "Remove State",
        "removeSubmit": "Remove",
        "removeJoiner": " and ",
        "removeError": "Failed to remove state.",
        "removeConfirm": "Are you sure you want to remove %s?",
        "emptyStates": "No saved states",
        "emptyError": "Name cannot be empty.",
        "duplicateError": "A state with this name already exists.",
        "creationModal": {
            "toggleLabel": "Includes:",
            "title": "Create New State",
            "select": "Select",
            "searchBuilder": "SearchBuilder",
            "search": "Search",
            "scroller": "Scroll Position",
            "paging": "Paging",
            "order": "Sorting",
            "name": "Name:",
            "columns": {
                "visible": "Column Visibility",
                "search": "Column Search"
            },
            "button": "Create"
        }
    }
}

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

window.handleError = (xhr, formId = null) => {
    if (xhr.status === 422) {
        validationErrors(formId, xhr.responseJSON.errors)
    } else {
        window.alert(xhr.responseJSON?.message || 'Server Error')
    }
}

const validationErrors = (formSelector, errors) => {
    $(`${formSelector} .is-invalid`).removeClass('is-invalid')
    $(`${formSelector} .invalid-feedback`).text('')

    Object.keys(errors).forEach(function (field) {
        const messages = errors[field].join(', ')

        let $input = $(`${formSelector} [name="${field}"]`)

        if (!$input.length) {
            $input = $(`${formSelector} [name="${field}[]"]`)
        }

        if ($input.attr('type') === 'radio' || $input.attr('type') === 'checkbox') {
            $input.addClass('is-invalid')

            $input.closest('.form-group, .mb-3, .row')
                .find('.invalid-feedback')
                .first()
                .html(messages)
                .show()
        } else {
            $input.addClass('is-invalid')
            $input.next('.invalid-feedback').html(messages)
        }
    })
}

window.resetValidation = (formSelector) => {
    $(`${formSelector} .is-invalid`).removeClass('is-invalid')
    $(`${formSelector} .invalid-feedback`).text('')
}

class Resource {
    constructor(inputs = [], parent = null) {
        this.inputs = inputs;
        this.parent = parent
    }

    toArray(parent = null) {
        var elements;

        if (parent) {
            elements = (parent.querySelectorAll(this.inputs[0]));
        }else {
            elements = (document.querySelectorAll(this.inputs[0]));
        }

        var arr = [];

        for (var i = 0; i < elements.length; i++) {
            arr.push({});
        }

        this.inputs.forEach((el) => {
            var inputEl;

            if (parent) {
                inputEl = parent.querySelectorAll(el);
            }else {
                inputEl = document.querySelectorAll(el);
            }

            for (var i = 0; i < inputEl.length; i++) {
                arr[i][inputEl[i].dataset.name] = inputEl[i].value
            }
        });

        return arr;
    }

    useParent() {
        var parents_dom = document.querySelectorAll(this.parent)
        var parents = []

        for (var i = 0; i < parents_dom.length; i++) {
            parents.push({
                details: null
            });
        }

        parents_dom.forEach((item, key) => {
            parents[key].details = this.toArray(item)
        })

        return parents;
    }
}

window.Resource = Resource

window.rupiah = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' });

class CurrencyFormat {
    constructor(element) {
        this.input = document.querySelectorAll(element)
    }

    formatValue(node) {
        var number = node.value === "" ? 0 : parseFloat(node.value.replace(/,/g, ''))
        var formattedNumber = number.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')

        return formattedNumber
    }

    init() {
        var formatValue = this.formatValue

        this.input.forEach(function (node) {
            var formattedNumber = formatValue(node)
            node.value = formattedNumber
            node.addEventListener('change', function () {
                var formattedNumber = formatValue(this)
                this.value = formattedNumber
            })
        })
    }

    normalize() {
        this.input.forEach(function (node) {
            var number = node.value === "" ? 0 : parseFloat(node.value.replace(/,/g, ''))
            node.value = number
        })
    }

    denormalize() {
        var formatValue = this.formatValue

        this.input.forEach(function (node) {
            var number = node.value === "" ? 0 : parseFloat(node.value.replace(/,/g, ''))
            var formattedNumber = number.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
            node.value = formattedNumber
        })
    }
}

window.CurrencyFormat = CurrencyFormat

window.formatCurrency = (value) => {
    value = value.toString()
    var number = value === "" ? 0 : parseFloat(value.replace(/,/g, ''))
    var formattedNumber = number.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')

    return formattedNumber
}

window.showNotification = ({ type = 'success', title = 'Success', message = '', delay = 3000 }) => {
    const iconMap = {
        success: 'bi-check-circle text-success',
        error:   'bi-x-circle text-danger',
        warning: 'bi-exclamation-triangle text-warning',
        info:    'bi-info-circle text-primary'
    }

    const toastEl   = document.getElementById('app-toast')
    const iconEl    = document.getElementById('toast-icon')
    const titleEl   = document.getElementById('toast-title')
    const messageEl = document.getElementById('toast-message')
    const timeEl    = document.getElementById('toast-time')

    iconEl.className = `bi ${iconMap[type]}`

    titleEl.textContent   = title || type.toUpperCase()
    messageEl.innerHTML   = message
    timeEl.textContent    = 'now'

    const toast = bootstrap.Toast.getOrCreateInstance(toastEl, { delay })
    toast.show()
}

window.showConfirm = ({
    message  = 'Are you sure?',
    icon     = 'bi-question-circle',
    color    = 'text-warning',
    onConfirm = function(){},
    onCancel  = function(){},
}) => {
    const toastEl   = document.getElementById('confirm-toast')
    const iconEl    = document.getElementById('confirm-icon')
    const messageEl = document.getElementById('confirm-message')
    const yesBtn    = document.getElementById('confirm-yes')
    const noBtn     = document.getElementById('confirm-no')

    iconEl.className = `bi ${icon} fs-1 ${color}`
    messageEl.textContent = message

    yesBtn.replaceWith(yesBtn.cloneNode(true))
    noBtn.replaceWith(noBtn.cloneNode(true))

    const newYes = document.getElementById('confirm-yes')
    const newNo  = document.getElementById('confirm-no')

    newYes.addEventListener('click', () => {
        bootstrap.Toast.getOrCreateInstance(toastEl).hide()
        onConfirm()
    })

    newNo.addEventListener('click', () => {
        bootstrap.Toast.getOrCreateInstance(toastEl).hide()
        onCancel()
    })

    bootstrap.Toast.getOrCreateInstance(toastEl).show()
}
