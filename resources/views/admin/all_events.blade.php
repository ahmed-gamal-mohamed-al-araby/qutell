@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{asset('dist/css/datatables.css')}}">
    <link rel="stylesheet" href="{{ asset('dist/jquery-dataTables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/jquery-dataTables/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/jquery-dataTables/css/fixedColumns.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/jquery-dataTables/css/colReorder.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/jquery-dataTables/css/select.dataTables.min.css') }}">
    <style>
        /* Ensure that the demo table scrolls */
        th, td {
            white-space: nowrap;
        }

        div.dataTables_wrapper {
            /*width: 800px;*/
            margin: 0 auto;
        }

        /*div.container {*/
        /*    width: 80%;*/
        /*}*/

        div.ColVis {
            float: right !important;
        }
    </style>

@endsection
@section('content')
    <div class="">
        <div class="card">
            <div class="card-body " >
                <div class="table-responsive">
                    <table id="example" class="table data-table table-hover table-bordered table-h text-center">
                        <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Name</th>
                            <th>Number Registration</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Number People</th>
                            <th>Qr Code</th>
                            <th>Status Qr Code</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all_events as $event)
                            <tr>
                                <td>{{$event->event->name}}</td>
                                <td>{{$event->name}}</td>
                                <td>{{$event->code}}</td>
                                <td>{{$event->email}}</td>
                                <td>{{$event->phone}}</td>
                                <td>{{$event->number_people}}</td>
                                <td class="qr_code" style="width:150px">
                                 {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate(route('event.attend', ['code' => $event->code])) !!}
                                </td>
                                <td>
                             @if($event->attend_event == 0)
                                        <span class="badge badge-danger">لم يتم الحضور</span>
                                    @else
                                        <span class="badge badge-success">تم الحضور</span>
                                    @endif
                                </td>
                                <td>
                                    <button id="" class="btn btn-info scanButton btn-sm">Scan QR Code</button>
                                </td>
                            </tr>
                        @endforeach
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('dist/js/datatables.js')}}"></script>
    <script src="{{ asset('dist/jquery-dataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/jquery-dataTables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dist/jquery-dataTables/js/jszip.min.js') }}"></script>
    <script src="{{ asset('dist/jquery-dataTables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dist/jquery-dataTables/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dist/jquery-dataTables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dist/jquery-dataTables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dist/jquery-dataTables/js/dataTables.fixedColumns.min.js') }}"></script>
    <script src="{{ asset('dist/jquery-dataTables/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('dist/jquery-dataTables/js/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('dist/jquery-dataTables/js/dataTables.select.min.js') }}"></script>
    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'All']],

                "pageLength": 10,
                pagingType: 'full_numbers',
                processing: true,
                serverSide: false,
                searching: true,

                // scrollY: '300px',
                // sScrollY: "200px",

                // scrollX: true,
                // "autoWidth": false,

                colReorder: true,

                columnDefs: [{
                    targets: "hiddenCols",
                    visible: false,
                    // targets: '_all',
                    render: function (data, type, row) {
                        if (type === 'PDF') {
                            return data.split(' ').reverse().join(' ');
                        }
                        return data;
                    }
                }],

                buttons: [
                    {extend: 'colvis'},
                    // {extend: 'copyHtml5', footer: true},
                    {
                        extend: 'excelHtml5', exportOptions: {
                            columns: [':visible']
                        }, footer: true
                    },
                    // {extend: 'csvHtml5', footer: true},
                    {extend: 'pdfHtml5', footer: true},
                    {
                        extend: 'print', exportOptions: {
                            columns: [':visible']
                        }, footer: true
                    },
                    'refresh',
                    // 'pageLength',
                ],
                select: true,
                deferRender: true,
                scrollCollapse: true,
                scroller: true,
                // scrollY: 300,

                fixedHeader: false,
                fixedColumns: {
                    leftColumns: 2
                },
            });
        });
    </script>
    <script>
        $('.scanButton').click(function () {
            // Initialize the QR code scanner
            var codeReader = new ZXing.BrowserQRCodeReader();

            var qrCodeImage = $(this).parent().parent().find('.qr_code').find('svg').get(0);
            if (!qrCodeImage) {
                console.error('No SVG element found within .qr_code:', $(this).get(0));
                return;
            }
            var svgXml = new XMLSerializer().serializeToString(qrCodeImage);
            var dataUrl = 'data:image/svg+xml;base64,' + btoa(svgXml);
            codeReader.decodeFromImageUrl(dataUrl)
                .then(result => {
                    var url = result.text;
                    var lastIndex = url.lastIndexOf("/");
                    var code = url.substring(lastIndex+1);

                    $.ajax({
                        url: '{{ route("check_attendance") }}',
                        data: {
                            code: code,
                        },
                        success: function (data) {
                            if(data == 1) {
                                alert('تم الحضور')
                            } else {
                                alert('لم يتم الحضور');
                            }
                        }
                    });
                })
                .catch(err => {
                    console.error('Error scanning QR code:', err);
                });
        })

    </script>
@endsection
