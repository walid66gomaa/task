@extends('backend.layouts.app')
@section('title', __('labels.backend.subPackages.title').' | '.app_name())
@push('after-styles')
    <link rel="stylesheet" href="{{asset('assets/css/colors/switch.css')}}">
@endpush
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.subPackages.title')</h3>
            @can('course_create')
                <div class="float-right">
                    <a href="{{ route('admin.subPackages.create') }}"
                       class="btn btn-success">@lang('strings.backend.general.app_add_new')</a>

                </div>
            @endcan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <div class="d-block">
                        
                        </div>


                        <table id="myTable"
                               class="table table-bordered table-striped @if(auth()->user()->isAdmin()) @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                            <thead>
                            <tr>

                                @can('category_delete')
                                    @if ( request('show_deleted') != 1 )
                                        <th style="text-align:center;">
                                            <input type="checkbox" class="mass" id="select-all"/>
                                        </th>
                                    @endif
                                @endcan

                                <th>#</th>
                                <th>ID</th>
                                <th>@lang('labels.backend.subPackages.fields.title')</th>
                                <th>@lang('labels.backend.subPackages.fields.slug')</th>
                                <th>@lang('labels.backend.subPackages.fields.price')</th>
                                <th>@lang('labels.backend.subPackages.fields.duration')</th>
                                @if( request('show_deleted') == 1 )
                                    <th>@lang('strings.backend.general.actions')</th>
                                @else
                                    <th>@lang('strings.backend.general.actions')</th>
                                @endif
                            </tr>
                            </thead>

                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('after-scripts')
    <script>

        $(document).ready(function () {

            var route = '{{route('admin.subPackages.get_data')}}';

            @if(request('show_deleted') == 1)
                route = '{{route('admin.subPackages.get_data',['show_deleted' => 1])}}';
                    @endif

            var table = $('#myTable').DataTable({
                    processing: true,
                    serverSide: true,
                    iDisplayLength: 10,
                    retrieve: true,
                    dom: 'lfBrtip<"actions">',
                    buttons: [
                        {
                            extend: 'csv',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5],
                            }
                        },
                        'colvis'
                    ],
                    ajax: route,
                    columns: [
                            @if(request('show_deleted') != 1)
                        {
                            "data": function (data) {
                                return '<input type="checkbox" class="single" name="id[]" value="' + data.id + '" />';
                            }, "orderable": false, "searchable": false, "name": "id"
                        },
                            @endif
                        {
                            data: "DT_RowIndex", name: 'DT_RowIndex', searchable: false, orderable: false
                        },
                        {data: "id", name: 'id'},
                        {data: "title", name: 'title'},
                        {data: "slug", name: 'slug'},
                        {data: "price", name: 'price'},
                        {data: "duration", name: 'duration'},
                        {data: "actions", name: 'actions'}
                    ],
                        @if(request('show_deleted') != 1)
                        columnDefs: [
                            {"width": "5%", "targets": 0},
                            {"className": "text-center", "targets": [0]}
                        ],
                        @endif

                        createdRow: function (row, data, dataIndex) {
                            $(row).attr('data-entry-id', data.id);
                        },
                    language: {
                        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/english.json",
                        buttons: {
                            colvis: '{{trans("datatable.colvis")}}',
                            pdf: '{{trans("datatable.pdf")}}',
                            csv: '{{trans("datatable.csv")}}',
                        }
                    }

                });
            
        });

      

    </script>

@endpush