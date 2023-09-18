@extends('template.sidebar')
@section('title', 'Staff')

@section('style')
<link href="{{ asset('asset/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')

<!-- <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"> -->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Post-->
    <div class="post flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_app_toolbar" class="app-toolbar pb-3 pb-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl">
                <!--begin::Page title-->
                <div class="page-title justify-content-center">
                    <!--begin::Title-->
                    <div class="row flex-stack align-items-center">
                        <!--begin::User-->
                        <div class="col-12 col-md-6">
                            <ol class="breadcrumb text-muted fs-6 fw-bold">
                                <li class="breadcrumb-item text-dark">Staff</li>
                            </ol>
                        </div>
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1" id="divSearch">
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                </svg>
                            </span>
                            <input type="text" data-kt-forms-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Cari..." id="inputSearch" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-forms-table-toolbar="base">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add_data">
                                <i class="fas fa-plus fs-3 me-2"></i>Tambah Data
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_dataTable">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Nama</th>
                                <th class="min-w-125px">TTL</th>
                                <th class="min-w-70px">L / P</th>
                                <th class="min-w-125px">Jabatan</th>
                                <th class="min-w-125px">Status</th>
                                <th class="min-w-125px">Gaji Pokok</th>
                                <th class="min-w-125px">Tunjangan</th>
                                <th class="min-w-125px">BPJS</th>
                                <th class="min-w-125px">Tgl. Masuk</th>
                                <th class="min-w-70px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

<!-- Modal -->
<div class="modal fade" id="modal_add_data" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form" id="modal_add_data_form">

                <div class="modal-header" id="modal_add_data_header">
                    <h2 class="fw-bolder">Tambah Staff</h2>
                    <div id="modal_add_data_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body py-10 px-10">
                    <div class="row">
                        <div class="col-6">
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Nama Staff</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" id="txtNameInsert" autocomplete="off" />
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Email</label>
                                <input type="email" class="form-control form-control-solid" placeholder="" id="txtEmailInsert" autocomplete="off" />
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Password</label>
                                <input type="password" class="form-control form-control-solid" placeholder="" id="txtPasswordInsert" autocomplete="off" />
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Tempat Lahir</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" id="txtPLaceBirthdInsert" autocomplete="off" />
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Tanggal Lahir</label>
                                <input type="date" onfocus="this.showPicker()" class="form-control form-control-solid" placeholder="" id="txtDateBirthdInsert" autocomplete="off" />
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Jenis Kelamin</label>
                                <select class="form-select form-select-solid select-type" id="cbGenderInsert" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Kelamin">
                                    <option value="0">Laki - laki</option>
                                    <option value="1">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Jabatan</label>
                                <select class="form-select form-select-solid select-type" id="cbPositionInsert" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Kelamin">
                                    <option value="Supervisor Payroll">Supervisor Payroll</option>
                                    <option value="Staff Payroll">Staff Payroll</option>
                                </select>
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Status</label>
                                <select class="form-select form-select-solid select-type" id="cbStatusInsert" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Kelamin">
                                    <option value="0">Tetap</option>
                                    <option value="1">Kontrak</option>
                                    <option value="2">HL</option>
                                </select>
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Gaji Pokok</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" id="txtBasicSalaryInsert" autocomplete="off" oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Tunjangan</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" id="txtSubsidyInsert" autocomplete="off" oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">BPJS</label>
                                <select class="form-select form-select-solid select-type" id="cbBpjsInsert" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Kelamin">
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Tanggal Masuk</label>
                                <input type="date" onfocus="this.showPicker()" class="form-control form-control-solid" placeholder="" id="txtDateJoinInsert" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="reset" id="modal_add_data_cancel" class="btn btn-light me-3">Batal</button>
                    <button type="button" id="modal_add_data_submit" class="btn btn-primary">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Loading...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_update_data" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form" action="#" id="modal_update_data_form">
                <div class="modal-header" id="modal_update_data_header">
                    <h2 class="fw-bolder">Tambah Staff</h2>
                    <div id="modal_update_data_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body py-10 px-10">
                    <div class="row">
                        <div class="col-6">
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Nama Staff</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" id="txtNameUpdate" autocomplete="off" />
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Email</label>
                                <input type="email" class="form-control form-control-solid" placeholder="" id="txtEmailUpdate" autocomplete="off" />
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Tempat Lahir</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" id="txtPLaceBirthdUpdate" autocomplete="off" />
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Tanggal Lahir</label>
                                <input type="date" onfocus="this.showPicker()" class="form-control form-control-solid" placeholder="" id="txtDateBirthdUpdate" autocomplete="off" />
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Jenis Kelamin</label>
                                <select class="form-select form-select-solid select-type" id="cbGenderUpdate" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Kelamin">
                                    <option value="0">Laki - laki</option>
                                    <option value="1">Perempuan</option>
                                </select>
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Jabatan</label>
                                <select class="form-select form-select-solid select-type" id="cbPositionUpdate" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Kelamin">
                                    <option value="Supervisor Payroll">Supervisor Payroll</option>
                                    <option value="Staff Payroll">Staff Payroll</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Status</label>
                                <select class="form-select form-select-solid select-type" id="cbStatusUpdate" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Kelamin">
                                    <option value="0">Tetap</option>
                                    <option value="1">Kontrak</option>
                                    <option value="2">HL</option>
                                </select>
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Gaji Pokok</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" id="txtBasicSalaryUpdate" autocomplete="off" oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Tunjangan</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" id="txtSubsidyUpdate" autocomplete="off" oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">BPJS</label>
                                <select class="form-select form-select-solid select-type" id="cbBpjsUpdate" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Kelamin">
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-bold mb-2">Tanggal Masuk</label>
                                <input type="date" onfocus="this.showPicker()" class="form-control form-control-solid" placeholder="" id="txtDateJoinUpdate" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="reset" id="modal_update_data_cancel" class="btn btn-light me-3">Batal</button>
                    <button type="button" id="modal_update_data_submit" class="btn btn-primary">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Loading...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="{{ asset('asset/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('asset/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('asset/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<script>
    "use strict";

    // var resultData = [{
    //         code: "1",
    //         name: "Muhammad Teguh",
    //         place_birth: "Gresik",
    //         date_birth: "2000-01-30",
    //         gender: "L",
    //         position: "Supervisor",
    //         status: "1",
    //         basic_salary: "7000000",
    //         subsidy: "3000000",
    //         bpjs: "1",
    //         date_join: "2020-03-03",
    //     },
    //     {
    //         code: "2",
    //         name: "Shindi Purnama",
    //         place_birth: "Surabaya",
    //         date_birth: "2000-03-03",
    //         gender: "P",
    //         position: "Staff",
    //         status: "2",
    //         basic_salary: "5000000",
    //         subsidy: "1000000",
    //         bpjs: "0",
    //         date_join: "2021-09-05",
    //     },
    // ]
    var resultData = []
    var table, code
    var csrfToken = $('meta[name="csrf-token"]').attr('content')

    // INSERT
    $("#modal_add_data_submit").click(function() {
        var name = $("#txtNameInsert").val()
        var email = $("#txtEmailInsert").val()
        var password = $("#txtPasswordInsert").val()
        var place_birthd = $("#txtPLaceBirthdInsert").val()
        var date_birthd = $("#txtDateBirthdInsert").val()
        var gender = $("#cbGenderInsert").val()
        var position = $("#cbPositionInsert").val()
        var status = $("#cbStatusInsert").val()
        var basic_salary = $("#txtBasicSalaryInsert").val().split('.').join('')
        var subsidi = $("#txtSubsidyInsert").val().split('.').join('')
        var bpjs = $("#cbBpjsInsert").val()
        var date_join = $("#txtDateJoinInsert").val()

        Swal.fire({
            title: 'Proses!',
            html: "Tambah data",
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            },
        })

        $.ajax({
            url: "/staff/insert",
            method: 'GET',
            data: {
                name: name,
                email: email,
                password: password,
                place_birthd: place_birthd,
                date_birthd: date_birthd,
                gender: gender,
                position: position,
                status: status,
                basic_salary: basic_salary,
                subsidi: subsidi,
                bpjs: bpjs,
                date_join: date_join
            },
            success: function(result) {
                var result = result;
                console.log(result)

                Swal.fire({
                    title: "Sukses",
                    html: "Berhasil tambah data",
                    icon: "success",
                    timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: false
                }).then(getData());

                $("input").val("")
                $("#modal_add_data").modal("hide")
            }
        });
    })


    // UPDATE
    $("#modal_update_data_submit").click(function() {
        var name = $("#txtNameUpdate").val()
        var email = $("#txtEmailUpdate").val()
        var place_birthd = $("#txtPLaceBirthdUpdate").val()
        var date_birthd = $("#txtDateBirthdUpdate").val()
        var gender = $("#cbGenderUpdate").val()
        var position = $("#cbPositionUpdate").val()
        var status = $("#cbStatusUpdate").val()
        var basic_salary = $("#txtBasicSalaryUpdate").val().split('.').join('')
        var subsidi = $("#txtSubsidyUpdate").val().split('.').join('')
        var bpjs = $("#cbBpjsUpdate").val()
        var date_join = $("#txtDateJoinUpdate").val()

        Swal.fire({
            title: 'Proses!',
            html: "Ubah data",
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            },
        })

        $.ajax({
            url: "/staff/update/" + code,
            method: 'GET',
            data: {
                name: name,
                email: email,
                place_birthd: place_birthd,
                date_birthd: date_birthd,
                gender: gender,
                position: position,
                status: status,
                basic_salary: basic_salary,
                subsidi: subsidi,
                bpjs: bpjs,
                date_join: date_join
            },
            success: function(result) {
                var result = result;
                console.log(result)

                Swal.fire({
                    title: "Sukses",
                    html: "Berhasil ubah data",
                    icon: "success",
                    timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: false
                }).then(getData());

                $("input").val("")
                $("#modal_update_data").modal("hide")
            }
        });
    })


    $("#txtBasicSalaryInsert, #txtSubsidyInsert, #txtBasicSalaryUpdate, #txtSubsidyUpdate").keyup(function() {
        var value = $(this).val();
        var result = autoNumeric(value);
        //   rawValue = parseInt(result.split('.').join(''));

        $(this).val(result);
    });

    $("#txtBasicSalaryInsert, #txtSubsidyInsert, #txtBasicSalaryUpdate, #txtSubsidyUpdate").keydown(function(event) {
        var value = $(this).val();
        if (value[0] == 0) {
            value = value.replace(0, '')
        }
        $(this).val(value);

        if (checkNumericInputWithZero(event.keyCode, value)) {
            return true;
        } else {
            return false;
        }
    });

    function getData() {
        $.ajax({
            url: "/staff/get",
            method: 'GET',
            success: function(result) {
                var result = result;

                if (result) {
                    resultData = [];
                    resultData = result;
                    showDataTable()
                }
            }
        });
    }

    function showDataTable() {
        table = $("#kt_dataTable").DataTable({
            "searchDelay": 500,
            "processing": true,
            "destroy": true,
            "order": [
                [8, 'desc']
            ],
            "data": resultData,
            "columns": [{
                    data: 'name'
                },
                {
                    data: 'place_birth'
                },
                {
                    data: 'gender'
                },
                {
                    data: 'position'
                },
                {
                    data: 'status'
                },
                {
                    data: 'basic_salary'
                },
                {
                    data: 'subsidi'
                },
                {
                    data: 'bpjs'
                },
                {
                    data: 'date_join'
                },
                {
                    data: 'code'
                },
            ],
            "columnDefs": [{
                    targets: 1,
                    render: function(data, type, row) {
                        return `<span>${data}, ${moment(row.date_birth).format('DD MMM YYYY')}</span>`
                    }
                },
                {
                    targets: 2,
                    render: function(data, type, row) {
                        if (data == 0) return 'L'
                        else return 'P'
                    }
                },
                {
                    targets: 8,
                    render: function(data, type, row) {
                        return `<span>${moment(data).format('DD MMM YYYY')}</span>`
                    }
                },
                {
                    targets: 5,
                    render: function(data, type, row) {
                        return `<span>${number_format(parseInt(data), 0, ',', '.')}</span>`
                    }
                },
                {
                    targets: 6,
                    render: function(data, type, row) {
                        return `<span>${number_format(parseInt(data), 0, ',', '.')}</span>`
                    }
                },
                {
                    targets: 7,
                    render: function(data, type, row) {
                        if (data == 1) return `<span>Ya</span>`
                        else return `<span>Tidak</span>`
                    }
                },
                {
                    targets: 4,
                    render: function(data, type, row) {
                        if (data == 0) return `<span>Tetap</span>`
                        else if (data == 1) return `<span>Kontrak</span>`
                        else return `<span>HL</span>`
                    }
                },
                {
                    targets: -1,
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function(data, type, row) {
                        return `
                        <button type="button" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" id="btnAction">
                            <i class="bi bi-three-dots-vertical fs-3"></i>
                        </button>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a class="menu-link" data-row="${btoa(JSON.stringify(row))}" id="optionEdit">
                                    <span class="fas fa-pen fs-3 menu-icon"></span>
                                    <span class="menu-title">Ubah</span>
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link" data-kt-forms-table-filter="delete_row" data-code="${row.id}" >
                                    <span class="fas fa-trash fs-3 menu-icon"></span>
                                    <span class="menu-title">Hapus</span>
                                </a>
                            </div>
                        </div>
                    `;
                    },
                }
            ],
        })

        table.on('draw', function() {
            console.log('drawed')
            KTMenu.createInstances();
            handleDeleteRows()
        });
        KTMenu.createInstances();
        handleDeleteRows()
    }

    var handleSearchDatatable = function() {
        const filterSearch = document.querySelector('[data-kt-forms-table-filter="search"]');
        filterSearch.addEventListener('keyup', function(e) {
            table.search(e.target.value).draw();
        });
    }

    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-forms-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function(e) {
                var code = $(this).data('code')
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const ListName = parent.querySelectorAll('td')[1].childNodes[0].textContent;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    title: "Hapus",
                    text: "Apakah Anda yakin? Anda tidak dapat mengembalikan data yang terhapus.",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    },
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {
                        Swal.fire({
                            title: 'Proses!',
                            html: "Menghapus data",
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading()
                            },
                        })

                        $.ajax({
                            url: "staff/delete/" + code,
                            method: 'GET',
                            success: function(result) {

                                Swal.fire({
                                    title: "Sukses",
                                    html: "Berhasil hapus data",
                                    icon: "success",
                                    timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                }).then(getData());

                            }
                        });
                    }
                });
            })
        });
    }

    KTUtil.onDOMContentLoaded(function() {
        getData()
        handleSearchDatatable()
        handleDeleteRows()
    })

    $(document).ready(function() {
        $(document).on("click", "#optionEdit", function(e) {
            e.preventDefault()
            var row = JSON.parse(atob($(this).data('row')));
            code = row.id

            $("#txtNameUpdate").val(row.name)
            $("#txtEmailUpdate").val(row.email)
            $("#txtPLaceBirthdUpdate").val(row.place_birth)
            $("#txtDateBirthdUpdate").val(row.date_birth)
            $("#cbGenderUpdate").val(row.gender).change()
            $("#cbPositionUpdate").val(row.position).change()
            $("#cbStatusUpdate").val(row.status).change()
            $("#txtBasicSalaryUpdate").val(number_format(parseInt(row.basic_salary), 0, ',', '.'))
            $("#txtSubsidyUpdate").val(number_format(parseInt(row.subsidi), 0, ',', '.'))
            $("#cbBpjsUpdate").val(row.bpjs).change()
            $("#txtDateJoinUpdate").val(row.date_join)
            $("#modal_update_data").modal("show")
        })
    })
</script>

@endsection