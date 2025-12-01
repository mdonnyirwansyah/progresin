@extends('layouts.guest')

@section('title', 'Example')

@pushOnce('scripts')
    <script type="module">
        $(() => {
            $('.table').DataTable({
                responsive: true,
            })
            $('#select2').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Open this select menu',
                allowClear: true
            })
            $('#select2-multiple').select2({
                multiple: true,
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Open this select menu',
                allowClear: true
            })

            const alertPlaceholder = document.getElementById('liveAlertPlaceholder')

            const alert = (message, type) => {
                const wrapper = document.createElement('div')
                wrapper.innerHTML = [
                    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                    `   <div>${message}</div>`,
                    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                    '</div>'
                ].join('')

                alertPlaceholder.append(wrapper)
            }

            const alertTrigger = document.getElementById('liveAlertBtn')
            if (alertTrigger) {
                alertTrigger.addEventListener('click', () => {
                    alert('Nice, you triggered this alert message!', 'success')
                })
            }

            const toastTrigger = document.getElementById('liveToastBtn')
            const toastLiveExample = document.getElementById('liveToast')
            if (toastTrigger) {
                toastTrigger.addEventListener('click', () => {
                    const toastElList = document.querySelectorAll('.toast')
                    const toastList = [...toastElList].map((toastEl) => {
                        const toast = new bootstrap.Toast(toastEl)

                        toast.show()
                    })
                })
            }

            window.showLoadingExample = function () {
                document.getElementById('loadingOverlayExample').classList.remove('d-none')
                setTimeout(() => {
                    hideLoadingExample()
                }, 3000);
            }

            window.hideLoadingExample = function () {
                document.getElementById('loadingOverlayExample').classList.add('d-none')
            }
        })
    </script>
@endPushOnce

@section('content')
    <h2>Datatables</h2>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>First</th>
                <th>Last</th>
                <th>Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
        </tbody>
    </table>

    <br>

    <h2 class="mt-5">Form</h2>

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>

    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword">
        </div>
    </div>

    <div class="mb-3">
        <label for="formFile" class="form-label">Default file input example</label>
        <input class="form-control" type="file" id="formFile">
    </div>

    <div class="mb-3">
        <label for="formFileMultiple" class="form-label">Multiple files input example</label>
        <input class="form-control" type="file" id="formFileMultiple" multiple>
    </div>

    <select class="mb-3 form-select" aria-label="Default select example">
        <option selected>Open this select menu</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
    </select>

    <div class="mb-3 row">
        <label for="select2" class="col-sm-2 col-form-label">Select2</label>
        <div class="col-sm-10">
            <select id="select2" class="form-select">
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="select2-multiple" class="col-sm-2 col-form-label">Select2 Multiple</label>
        <div class="col-sm-10">
            <select id="select2-multiple" class="form-select" multiple>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
    </div>

    <label for="exampleDataList" class="form-label">Datalist example</label>
    <input class="form-control mb-3" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
    <datalist id="datalistOptions">
        <option value="San Francisco">
        <option value="New York">
        <option value="Seattle">
        <option value="Los Angeles">
        <option value="Chicago">
    </datalist>

    <label for="exampleColorInput" class="form-label">Color picker</label>
    <input type="color" class="form-control form-control-color" id="exampleColorInput" value="#563d7c"
        title="Choose your color">

    <br>

    <h2 class="mt-5">Alerts</h2>

    <div id="liveAlertPlaceholder"></div>
    <button type="button" class="btn btn-primary" id="liveAlertBtn">Show live alert</button>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bi bi-info-circle me-2"></i>
                <strong class="me-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>

    <div class="toast-container p-3 position-fixed top-50 start-50 translate-middle">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
            <div class="toast-header d-flex justify-content-center">
                <i class="bi bi-info-circle text-warning fs-1"></i>
            </div>
            <div class="toast-body text-center">
                <p class="fs-2">Are you sure?</p>
                <div class="mt-2 pt-2 d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-primary btn-sm">Take action</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Close</button>
                </div>
            </div>
        </div>
    </div>

    <br>

    <h2 class="mt-5">Tooltips</h2>

    <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-title="Tooltip on top">
        Tooltip on top
    </button>

    <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-html="true"
        data-bs-title="<em>Tooltip</em> <u>with</u> <b>HTML</b>">
        Tooltip with HTML
    </button>

    <br>

    <h2 class="mt-5">Spinners</h2>

    <div class="d-flex justify-content-center">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="d-flex align-items-center">
        <strong>Loading...</strong>
        <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
    </div>
    <div id="loadingOverlayExample" class="loading-overlay d-none">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="spinner-border text-light" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <button class="btn btn-primary" onclick="showLoadingExample()">Tampilkan Loading</button>

    <br>

    <h2 class="mt-5">Modal</h2>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>
                </div>
            </div>
        </div>
    </div>

@endsection
