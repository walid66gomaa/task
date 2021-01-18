@extends('backend.layouts.app')

@section('title', __('labels.backend.subPackages.title').' | '.app_name())
@push('after-styles')
    <style>
        table th {
            width: 20%;
        }
    </style>
@endpush
@section('content')

    <div class="card">

        <div class="card-header">
            <h3 class="page-title d-inline mb-0">@lang('labels.backend.subPackages.title')</h3>
            <div class="float-right">
                <a href="{{ route('admin.subPackages.index') }}"
                   class="btn btn-success">@lang('labels.backend.subPackages.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('labels.backend.access.users.tabs.content.overview.avatar')</th>
                            <td><img height="100px" src="{{ $subPackage->picture }}" class="user-profile-image" alt=""/></td>
                        </tr>

                        <tr>
                            <th>@lang('labels.backend.access.users.tabs.content.overview.title')</th>
                            <td>{{ $subPackage->title }}</td>
                        </tr>

                        <tr>
                            <th>@lang('labels.backend.access.users.tabs.content.overview.slug')</th>
                            <td>{{ $subPackage->slug }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.access.users.tabs.content.overview.status')</th>
                            <td>{!! $subPackage->active !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.general_settings.user_registration_settings.fields.duration')</th>
                            <td>{!! $subPackage->duration !!}</td>
                        </tr>
                    
                      
                    
                    </table>
                </div>
            </div><!-- Nav tabs -->
        </div>
    </div>
@stop
