/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

function hapus(id) {
    $('#del-' + id).submit();
}

// menu dinamis
var path = location.pathname.split('/');
var url = location.origin + '/' + path[1];
$('ul.sidebar-menu li a').each(function () {
    if ($(this).attr('href') && $(this).attr('href').indexOf(url) !== -1) {
        $(this).parent().addClass('active').parents('li.nav-item.dropdown').addClass('active');
    }
});

// datatables and pagination
$(document).ready(function () {
    if ($('#mytable').length) {
        $('#mytable').DataTable();
    }
});

// ==========================================
// TRANSAKSI DYNAMIC MULTI-ROW JAVASCRIPT
// ==========================================

function Barisbaru() {
    var Nomor = $("#tableLoop tbody tr").length + 1;
    var Baris = '<tr>';
    Baris += '<td class="text-center">' + Nomor + '</td>';
    Baris += '<td>';
    Baris += '<select class="form-control select2-akun" name="kode_akun3[]" required>';
    Baris += '<option value="">-- Pilih Akun --</option>';
    Baris += '</select>';
    Baris += '</td>';
    Baris += '<td><input type="number" step="any" class="form-control debit" name="debit[]" value="0" required></td>';
    Baris += '<td><input type="number" step="any" class="form-control kredit" name="kredit[]" value="0" required></td>';
    Baris += '<td>';
    Baris += '<select class="form-control select2-status" name="id_status[]" required>';
    Baris += '<option value="">-- Status --</option>';
    Baris += '</select>';
    Baris += '</td>';
    Baris += '<td class="text-center">';
    Baris += '<button type="button" class="btn btn-danger btn-sm" id="HapusBaris"><i class="fas fa-trash"></i></button>';
    Baris += '</td>';
    Baris += '</tr>';

    $("#tableLoop tbody").append(Baris);

    // Populate dropdowns for the newly added row
    var lastRow = $("#tableLoop tbody tr").last();
    FormSelectAkun(lastRow.find('.select2-akun'));
    FormSelectStatus(lastRow.find('.select2-status'));
}

var cachedAkun3 = null;
var cachedStatus = null;

function FormSelectAkun(element) {
    if (cachedAkun3 !== null) {
        populateAkun(element, cachedAkun3);
    } else {
        var base = $('meta[name="base-url"]').attr('content') || location.origin + '/aabw/public';
        $.ajax({
            url: base + '/transaksi/akun3',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                cachedAkun3 = data;
                populateAkun(element, cachedAkun3);
            }
        });
    }
}

function populateAkun(element, data) {
    var selected = element.data('selected');
    $.each(data, function (key, value) {
        var isSelected = (selected && selected == value.kode_akun3) ? 'selected' : '';
        element.append('<option value="' + value.kode_akun3 + '" ' + isSelected + '>' + value.kode_akun3 + ' - ' + value.nama_akun3 + '</option>');
    });
}

function FormSelectStatus(element) {
    if (cachedStatus !== null) {
        populateStatus(element, cachedStatus);
    } else {
        var base = $('meta[name="base-url"]').attr('content') || location.origin + '/aabw/public';
        $.ajax({
            url: base + '/transaksi/status',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                cachedStatus = data;
                populateStatus(element, cachedStatus);
            }
        });
    }
}

function populateStatus(element, data) {
    var selected = element.data('selected');
    $.each(data, function (key, value) {
        var isSelected = (selected && selected == value.id_status) ? 'selected' : '';
        element.append('<option value="' + value.id_status + '" ' + isSelected + '>' + value.status + '</option>');
    });
}

$(document).on('click', '#BarisBaru', function (e) {
    e.preventDefault();
    Barisbaru();
});

$(document).on('click', '#HapusBaris', function (e) {
    e.preventDefault();
    $(this).parents('tr').remove();
    $("#tableLoop tbody tr").each(function (index) {
        $(this).find('td:first').text(index + 1);
    });
    hitungTotal();
});

// Auto calculate Debit and Credit Totals
function hitungTotal() {
    var totalDebit = 0;
    var totalKredit = 0;

    $('.debit').each(function () {
        var val = parseFloat($(this).val()) || 0;
        totalDebit += val;
    });

    $('.kredit').each(function () {
        var val = parseFloat($(this).val()) || 0;
        totalKredit += val;
    });

    $('#totalDebit').text(totalDebit.toLocaleString('id-ID'));
    $('#totalKredit').text(totalKredit.toLocaleString('id-ID'));

    if (totalDebit === totalKredit && totalDebit > 0) {
        $('#balanceStatus').html('<span class="badge badge-success"><i class="fas fa-check"></i> Balance</span>');
        $('#btnSubmit').prop('disabled', false);
    } else {
        $('#balanceStatus').html('<span class="badge badge-danger"><i class="fas fa-times"></i> Tidak Balance</span>');
    }
}

$(document).on('keyup change', '.debit, .kredit', function () {
    hitungTotal();
});

// ==========================================
// PENYESUAIAN CALCULATION (Video 13)
// ==========================================
function hitung() {
    var nilai = $('input[name="nilai"]').val();
    var waktu = $('input[name="waktu"]').val();
    if (nilai && waktu && parseFloat(waktu) !== 0) {
        var jumlah = parseFloat(nilai) / parseFloat(waktu);
        $('input[name="jumlah"]').val(Math.round(jumlah));
    }
}

$(document).on('keyup change', 'input[name="nilai"], input[name="waktu"]', function () {
    hitung();
});