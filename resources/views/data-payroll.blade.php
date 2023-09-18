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
                                <li class="breadcrumb-item text-dark">Data Penggajian</li>
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
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_dataTable">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Nama</th>
                                <th class="min-w-125px">Periode</th>
                                <th class="min-w-125px">Jabatan</th>
                                <th class="min-w-125px">Status Pekerja</th>
                                <th class="min-w-125px">Total Gaji</th>
                                <th class="min-w-125px">Status</th>
                                <th class="min-w-70px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600">
                            @foreach($penggajian as $p)
                            <tr>
                                <td>{{ $p->user->name }}</td>
                                <td>{{ $p->date }}</td>
                                <td>{{ $p->user->position }}</td>
                                <td>
                                    @if($p->user->status == 0)
                                    Tetap
                                    @elseif($p->user->status == 1)
                                    Kontrak
                                    @else
                                    HL
                                    @endif
                                </td>
                                <td>{{ number_format($p->paid_amount, 0, '.', '.') }}</td>
                                <td>
                                    @if($p->status == 0)
                                    <span class="badge badge-light-warning fs-8 fw-bolder">Draft</span>
                                    @else
                                    <span class="badge badge-light-success fs-8 fw-bolder">Approve</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" id="btnAction">
                                        <i class="bi bi-three-dots-vertical fs-3"></i>
                                    </button>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            <a class="menu-link" data-bs-toggle="modal" data-bs-target="#modal_detail_{{$p->id}}">
                                                <span class="fas fa-info fs-3 menu-icon"></span>
                                                <span class="menu-title">Detail</span>
                                            </a>
                                        </div>
                                        @if( auth()->user()->position === 'Supervisor Payroll' && $p->status == 0)
                                        <div class="menu-item px-3">
                                            <form method="POST" style="margin-bottom: 0px;" action="{{ route('payroll-approve', $p->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="menu-link" style="border: none; background-color: white;" onclick="return confirm('Are you sure you want to approve this post?')">
                                                    <span class="fas fa-pen fs-3 menu-icon"></span>
                                                    <span class="menu-title">Approve</span>
                                                </button>
                                            </form>
                                        </div>
                                        @endif

                                        <div class="menu-item px-3">
                                            <button type="button" class="menu-link" onclick="downloadPdf('{{$p}}')" data-row="{{$p}}" style="border: none; background-color: white;">
                                                <span class="fas fa-file-pdf fs-3 menu-icon"></span>
                                                <span class="menu-title">Print</span>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="modal_detail_{{$p->id}}" tabindex="-1" aria-modal="true" role="dialog">
                                <div class="modal-dialog mw-650px">
                                    <div class="modal-content">
                                        <div class="modal-header pb-0 border-0 justify-content-end">
                                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                <span class="svg-icon svg-icon-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                                            <div class="text-center mb-13">
                                                <h3 class="fw-bold mb-1" id="txtPeriod">{{$p->date}}</h3>
                                                <h1 class="mb-1" id="txtName">{{$p->user->name}}</h1>
                                                <div class="text-muted fw-bold fs-5" id="txtPosition">{{$p->user->position}} @if($p->user->status == 0) Tetap @elseif($p->user->status == 1) Kontrak @else HL @endif</div>
                                            </div>
                                            <div class="d-flex flex-stack p-2">
                                                <span class="text-gray-400 fs-5 fw-bolder lh-0">Gaji Pokok</span>
                                                <span class="text-gray-400 fw-bold" id="txtSalary">{{number_format($p->work_paid, 0, '.', '.')}}</span>
                                            </div>
                                            <div class="separator separator-dashed my-4"></div>
                                            <div class="d-flex flex-stack p-2">
                                                <span class="text-gray-400 fs-5 fw-bolder lh-0">Izin</span>
                                                <span class="text-gray-400 fw-bold" id="txtPermission">({{$p->izin_duration}}) {{number_format($p->izin_charge, 0, '.', '.')}}</span>
                                            </div>
                                            <div class="separator separator-dashed my-4"></div>
                                            <div class="d-flex flex-stack p-2">
                                                <span class="text-gray-400 fs-5 fw-bolder lh-0">Lembur</span>
                                                <span class="text-gray-400 fw-bold" id="txtOvertime">{{number_format($p->overtime_paid, 0, '.', '.')}}</span>
                                            </div>
                                            <div class="separator separator-dashed my-4"></div>
                                            <div class="d-flex flex-stack p-2">
                                                <span class="text-gray-400 fs-5 fw-bolder lh-0">Tunjangan</span>
                                                <span class="text-gray-400 fw-bold" id="txtSubsidy">{{number_format($p->tunjangan, 0, '.', '.')}}</span>
                                            </div>
                                            <div class="separator separator-dashed my-4"></div>
                                            <div class="d-flex flex-stack p-2">
                                                <span class="text-gray-400 fs-5 fw-bolder lh-0">BPJS</span>
                                                <span class="text-gray-400 fw-bold" id="txtBpjs">{{number_format($p->bpjs, 0, '.', '.')}}</span>
                                            </div>
                                            <div class="separator separator-dashed my-4"></div>
                                            <div class="d-flex flex-stack p-2">
                                                <span class="text-gray-400 fs-5 fw-bolder lh-0">Intensif</span>
                                                <span class="text-gray-400 fw-bold" id="txtIntensif">{{number_format($p->intensif, 0, '.', '.')}}</span>
                                            </div>
                                            <div class="separator separator-dashed my-4"></div>
                                            <div class="d-flex flex-stack p-2">
                                                <span class="text-gray-800 fs-5 fw-bolder">Total Gaji</span>
                                                <span class="text-gray-800 fs-5 fw-bolder" id="txtTotalSalary">{{number_format($p->paid_amount, 0, '.', '.')}}</span>
                                            </div>
                                        </div>
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


<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="{{ asset('asset/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('asset/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('asset/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="https://unpkg.com/jspdf-autotable@3.5.13/dist/jspdf.plugin.autotable.js"></script>

<script>
    "use strict";

    var resultData = []
    var table

    function downloadPdf(row) {
        var data = JSON.parse(row)
        var status = data.user.status == 0 ? "Tetap" : data.user.status == 1 ? "Kontrak" : "HL"
        console.log(data)
        // Set New PDF
        const doc = new jsPDF({
            orientation: "potrait",
            unit: "cm",
            format: 'a4'
        });

        // Set Header PDF
        doc.setFont('helvetica');
        doc.setFontType('bold');
        doc.text("Laporan Gaji", 10, 2, 'center');
        doc.text(data.user.name, 10, 2.8, 'center')

        doc.setFontType('normal');
        doc.setFontSize(14);
        doc.text(moment(data.date).format("MMMM YYYY"), 10, 3.8, 'center');
        doc.text(data.user.position + " (" + status + ")", 10, 4.4, 'center');

        var body = [
            ['Gaji Pokok', number_format(parseInt(data.work_paid), 0, ',', '.')],
            ['Izin', "("+data.izin_duration+") "+number_format(parseInt(data.izin_charge), 0, ',', '.')],
            ['Lembur', number_format(parseInt(data.overtime_paid), 0, ',', '.')],
            ['Tunjangan', number_format(parseInt(data.tunjangan), 0, ',', '.')],
            ['BPJS', number_format(parseInt(data.bpjs), 0, ',', '.')],
            ['Intensif', number_format(parseInt(data.intensif), 0, ',', '.')],
            ['Total Gaji', number_format(parseInt(data.paid_amount), 0, ',', '.')]
        ];

        var docTable = doc.autoTable({
            startY: 6,
            tableWidth: "wrap",
            body: body,
            columnStyles: {
                0: {
                    halign: 'left',
                    cellWidth: 8.8,
                    fillColor: [255, 255, 255],
                    // fillColor: [220, 220, 220],
                },
                1: {
                    halign: 'right',
                    cellWidth: 8.8,
                    fillColor: [255, 255, 255],
                    // fillColor: [220, 220, 220],
                }
            },
            didParseCell: function(data) {
                data.cell.styles.fontStyle = 'bold';
                data.cell.styles.fontSize = 13;
                // data.cell.styles.cellPadding = [0, 1, 1, 2];
            }
        });

        doc.save(`[${data.user.name}] Laporan Gaji (${data.date}).pdf`);
    }
</script>

@endsection