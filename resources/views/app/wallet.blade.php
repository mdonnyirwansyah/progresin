@extends('layouts.app')

@section('title', __('Wallet'))

@pushOnce('scripts')
    <script type="module">
        var currency

        $(() => {
            let walletTable = $('#wallet-table').DataTable({
                processing: true,
                serverSide: true,
                orderCellsTop: true,
                responsive: true,
                ajax: {
                    url: '{{ route("wallet.list") }}',
                    type: 'GET'
                },
                language: setLanguageDatatables(`{{ app()->currentLocale() == 'id' ? 'id' : 'en' }}`),
                drawCallback: function () {
                    document
                        .querySelectorAll('#wallet-table [data-bs-toggle="tooltip"]')
                        .forEach(function (el) {
                            bootstrap.Tooltip.getOrCreateInstance(el)
                        })

                    const wrapper = $('#wallet-table_wrapper')
                    const filter  = wrapper.find('.dt-search')

                    filter.empty()

                    filter
                        .addClass('text-end')
                        .append(`
                            <button type="button" class="btn btn-sm btn-outline-primary" id="btn-add-wallet" onclick="walletAdd()">
                                <i class="bi bi-plus-lg"></i>
                                {{ __('Add Wallet') }}
                            </button>
                        `)
                },
                initComplete: function () {
                    $(document).on('keyup', '.column-search', function (e) {
                        if (e.key === 'Enter' || e.keyCode === 13) {
                            let colIndex = $(this).data('column')
                            let value    = $(this).val()

                            walletTable
                                .column(colIndex)
                                .search(value)
                                .draw()
                        }
                    })
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: '40px',
                        responsivePriority: 1
                    },
                    {
                        data: 'name',
                        name: 'name',
                        responsivePriority: 1
                    },
                    {
                        data: 'balance',
                        name: 'balance',
                        responsivePriority: 2,
                        render: function (data, type, row) {
                            return formatCurrency(data)
                        }
                    },
                    {
                        data: 'slug',
                        orderable:false,
                        searchable:false,
                        responsivePriority: 1,
                        render: function (data, type, row) {
                            return `
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="{{ __('Edit') }}" onclick="walletShow(this, '${data}')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete" data-bs-toggle="tooltip" title="{{ __('Delete') }}" onclick="walletDelete(this, '${data}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            `
                        }
                    }
                ]
            })

            $('#wallet-form').on('submit', function(e) {
                e.preventDefault()
                resetValidation('#wallet-form')

                currency.normalize()

                let url = `{{ route('wallet.store') }}`
                let type = 'POST'
                if ($('#wallet-slug').val()) {
                    url = `{{ route('wallet.update', ':slug') }}`
                    url = url.replace(':slug', $('#wallet-slug').val())
                    type = 'PUT'
                }

                $.ajax({
                    url: url,
                    type: type,
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function () {
                        showLoading()
                        $('#wallet-form .button-submit').prop('disabled', true)
                    },
                    success: function() {
                        const modal = bootstrap.Modal.getOrCreateInstance(
                            document.getElementById('wallet-modal')
                        )
                        modal.hide()

                        $('#wallet-form')[0].reset()
                        $('#wallet-table').DataTable().ajax.reload(null, false)

                        showNotification({
                            type: 'success',
                            title: '{{ __("Success") }}',
                            message: '{{ __("Wallet saved successfully") }}'
                        })
                    },
                    error: function(xhr) {
                        handleError(xhr, '#wallet-form')
                    },
                    complete: function() {
                        currency.denormalize()
                        hideLoading()
                        $('#wallet-form .button-submit').prop('disabled', false)
                    }
                })
            })
        })

        window.walletAdd = () => {
            currency = new CurrencyFormat('.currency')
            currency.init()

            $('#wallet-slug').val(null)
            resetValidation('#wallet-form')

            $('#wallet-modal-label').text('{{ __('Add Wallet') }}')
            let modal = new bootstrap.Modal(document.getElementById('wallet-modal'))
            modal.show()
        }

        window.walletShow = (el, slug) => {
            currency = new CurrencyFormat('.currency')
            currency.init()

            let url = `{{ route('wallet.show', ':slug') }}`
                url = url.replace(':slug', slug)

            $.ajax({
                url: url,
                beforeSend: function () {
                    showLoading()
                    $(el).prop('disabled', true)
                },
                success: function(response) {
                    $('#wallet-slug').val(response.data.slug)
                    $('#name').val(response.data.name)
                    $('#balance').val(response.data.balance)

                    $('#wallet-modal-label').text('{{ __('Edit Wallet') }}')
                    let modal = new bootstrap.Modal(document.getElementById('wallet-modal'))
                    modal.show()
                },
                error: function(xhr) {
                    handleError(xhr)
                },
                complete: function() {
                    hideLoading()
                    $(el).prop('disabled', false)
                }
            })
        }

        window.walletDelete = (el, slug) => {
            let url = `{{ route('wallet.destroy', ':slug') }}`
                url = url.replace(':slug', slug)

            showConfirm({
                message: 'Delete this wallet?',
                icon: 'bi-trash',
                color: 'text-danger',
                onConfirm: function () {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function () {
                            showLoading()
                            $(el).prop('disabled', true)
                        },
                        success: function () {
                            showNotification({
                                type: 'success',
                                message: 'Wallet deleted'
                            })
                            $('#wallet-table').DataTable().ajax.reload(null, false)
                        },
                        error: function(xhr) {
                            handleError(xhr)
                        },
                        complete: function() {
                            hideLoading()
                            $(el).prop('disabled', false)
                        }
                    })
                }
            })
        }
    </script>
@endPushOnce

@section('content')
    <table id="wallet-table" class="table table-bordered align-middle nowrap">
        <thead>
            <tr>
                <th style="width: 40px;">{{ __('No') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Balance') }}</th>
                <th style="width:120px">{{ __('Action') }}</th>
            </tr>
            <tr>
                <th></th>
                <th>
                    <input type="text" class="form-control form-control-sm column-search" placeholder="{{ __('Search name') }}" data-column="1">
                </th>
                <th>
                    <input type="text" class="form-control form-control-sm column-search" placeholder="{{ __('Search balance') }}" data-column="2">
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <div class="modal fade" id="wallet-modal" tabindex="-1" aria-labelledby="wallet-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <form id="wallet-form" class="modal-content">
                <input type="hidden" id="wallet-slug">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="wallet-modal-label"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="balance" class="col-sm-2 col-form-label">{{ __('Balance') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control currency" id="balance" name="balance">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-outline-primary">{{ __('Save') }}</button>
                    <button type="reset" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
