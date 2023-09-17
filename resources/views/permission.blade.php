@extends('template.sidebar')
@section('title', 'Staff')

@section('style')
<link href="{{ asset('asset/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')

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
                                <li class="breadcrumb-item text-dark">Form Izin Cuti</li>
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
                        <div class="d-flex align-items-center position-relative my-1 skeleton-button" id="divSearch">
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                </svg>
                            </span>
                            <input type="text" data-kt-forms-table-filter="search" class="form-control form-control-solid w-250px ps-15 skeleton" placeholder="Cari..." id="inputSearch" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-forms-table-toolbar="base">
                            <button type="button" class="btn btn-primary skeleton skeleton-button" data-bs-toggle="modal" data-bs-target="#modal_add_data">
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
                                <th class="min-w-125px">Tanggal Permohonan</th>
                                <th class="min-w-125px">Dari</th>
                                <th class="min-w-70px">Sampai</th>
                                <th class="min-w-125px">Jumlah Cuti</th>
                                <th class="min-w-125px">Tipe</th>
                                <th class="min-w-125px">Keterangan</th>
                                <th class="min-w-70px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600">
                            @foreach($data as $data)
                            <tr>
                                <td>{{ $data->user->name }}</td>
                                <td>{{ $data->date }}</td>
                                <td>{{ $data->date_from }}</td>
                                <td>{{ $data->date_to }}</td>
                                <td>{{ $data->duration }}</td>
                                <td>
                                    @if ($data->type == 0)
                                    Cuti
                                    @else
                                    Izin
                                    @endif
                                </td>
                                <td>{{ $data->notes }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" id="btnAction">
                                        <i class="bi bi-three-dots-vertical fs-3"></i>
                                    </button>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            <a class="menu-link"  data-bs-toggle="modal" data-bs-target="#modal_update_data_{{$data->id}}" id="optionEdit">
                                                <span class="fas fa-pen fs-3 menu-icon"></span>
                                                <span class="menu-title">Ubah</span>
                                            </a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <form method="POST" action="{{ route('permission-destroy', $data->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')">
                                                        <a href="#" class="menu-link" data-kt-forms-table-filter="delete_row">
                                                            <span class="fas fa-trash fs-3 menu-icon"></span>
                                                            <span class="menu-title">Hapus</span>
                                                        </a>
                                                    </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="modal_update_data_{{$data->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form class="form" action="{{ route('permission-update',$data->id) }}" method="POST" id="modal_add_data_form">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header" id="modal_update_data_header">
                                                <h2 class="fw-bolder">Form Ubah Cuti</h2>
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
                                                <div class="fv-row mb-7">
                                                    <label class="required fs-6 fw-bold mb-2">Nama Staff</label>
                                                    <select class="form-select form-select-solid select-type" name="user_id" data-control="select2" data-hide-search="true" data-placeholder="Pilih user">
                                                    @foreach($user as $u)
                                                        <option value="{{ $u->id }}" {{ $u->id == $data->user_id ? 'selected' : '' }}>{{$u->name}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fs-6 fw-bold mb-2">Tanggal Permohonan</label>
                                                    <input type="date" onfocus="this.showPicker()" class="form-control form-control-solid" value="{{$data->date}}" placeholder="" name="date" autocomplete="off" />
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fs-6 fw-bold mb-2">Tipe</label>
                                                    <select class="form-select form-select-solid select-type" name="type" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Kelamin">
                                                        <option value="1" {{ $data->type ==1 ? 'selected' : '' }}>Cuti</option>
                                                        <option value="0" {{ $data->type ==0 ? 'selected' : '' }}>Tidak Masuk</option>
                                                    </select>
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fs-6 fw-bold mb-2">Dari</label>
                                                    <input type="date" onfocus="this.showPicker()" class="form-control form-control-solid" placeholder="" value="{{$data->date_from}}" name="date_from" autocomplete="off" />
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fs-6 fw-bold mb-2">Sampai</label>
                                                    <input type="date" onfocus="this.showPicker()" class="form-control form-control-solid" placeholder="" value="{{$data->date_to}}" name="date_to" autocomplete="off" />
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fs-6 fw-bold mb-2">Jumlah Cuti</label>
                                                    <input type="text" class="form-control form-control-solid" placeholder="" name="duration" value="{{$data->duration}}" autocomplete="off" oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fs-6 fw-bold mb-2">Keterangan</label>
                                                    <input class="form-control form-control-solid" placeholder="" value="{{$data->notes}}" name="notes" autocomplete="off"></input>
                                                </div>
                                            </div>
                                            <div class="modal-footer flex-center">
                                                <button type="reset" id="modal_update_data_cancel" class="btn btn-light me-3">Batal</button>
                                                <button type="submit" id="modal_update_data_submit" class="btn btn-primary">
                                                    <span class="indicator-label">Simpan</span>
                                                    <span class="indicator-progress">Loading...
                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form" action="{{ route('permission-insert') }}" method="POST" id="modal_add_data_form">
                @csrf
                <div class="modal-header" id="modal_add_data_header">
                    <h2 class="fw-bolder">Form Tambah Cuti</h2>
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
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-bold mb-2">Nama Staff</label>
                        <select class="form-select form-select-solid select-type" name="user_id" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Kelamin">
                            @foreach($user as $user)
                                <option value="{{ $user->id }}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-bold mb-2">Tanggal Permohonan</label>
                        <input type="date" onfocus="this.showPicker()" class="form-control form-control-solid" placeholder="" name="date" autocomplete="off" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-bold mb-2">Tipe</label>
                        <select class="form-select form-select-solid select-type" name="type" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Kelamin">
                            <option value="1">Cuti</option>
                            <option value="0">Tidak Masuk</option>
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-bold mb-2">Dari</label>
                        <input type="date" onfocus="this.showPicker()" class="form-control form-control-solid" placeholder="" name="date_from" autocomplete="off" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-bold mb-2">Sampai</label>
                        <input type="date" onfocus="this.showPicker()" class="form-control form-control-solid" placeholder="" name="date_to" autocomplete="off" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-bold mb-2">Jumlah Cuti</label>
                        <input type="text" class="form-control form-control-solid" placeholder="" name="duration" autocomplete="off" oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-bold mb-2">Keterangan</label>
                        <textarea class="form-control form-control-solid" placeholder="" name="notes" autocomplete="off"></textarea>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="reset" id="modal_add_data_cancel" class="btn btn-light me-3">Batal</button>
                    <button type="submit" id="modal_add_data_submit" class="btn btn-primary">
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

@endsection