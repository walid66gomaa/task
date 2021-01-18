@extends('backend.layouts.app')

@section('title', __('labels.backend.subPackages.title').' | '.app_name())

@section('content')
{{ html()->modelForm($subPackage, 'PATCH', route('admin.subPackages.update', $subPackage->id))->class('form-horizontal')->acceptsFiles()->open() }}

  <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.subPackages.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.subPackages.index') }}"
                   class="btn btn-success">@lang('labels.backend.subPackages.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.subPackages.fields.title'))->class('col-md-2 form-control-label')->for('title') }}

                        <div class="col-md-10">
                            {{ html()->text('title')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.subPackages.fields.title'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->

                   

                    <div class="form-group row">
                     
                        {!! Form::label('slug',  trans('labels.backend.courses.fields.slug'), ['class' => 'col-md-2 form-control-label']) !!}
                        <div class="col-md-10">
                            {{ html()->text('slug')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.subPackages.fields.slug'))
                            ->attribute('maxlength', 191)
                             }}
                           
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                     
                       
                        {!! Form::label('price',  trans('labels.backend.courses.fields.price').' (in '.$appCurrency["symbol"].')', ['class' => 'col-md-2 form-control-label']) !!}
                        
                        <div class="col-md-10">
                           {{
                            html()->number('price')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.subPackages.fields.price'))
                            
                            ->required()
                            }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                     
                       
                        {!! Form::label('duration',  trans('labels.backend.courses.fields.duration').' (in monthes)', ['class' => 'col-md-2 form-control-label']) !!}
                        
                        <div class="col-md-10">
                            {{ html()->number('duration')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.subPackages.fields.duration'))
                            
                            ->required()
                            }}

                          
                        </div><!--col-->
                    </div><!--form-group-->

                

                 

                 

                  


                    <div class="form-group row">
                        {{ html()->label(__('labels.subPackage.description'))->class('col-md-2 form-control-label')->for('description') }}

                        <div class="col-md-10">
                            {{ html()->textarea('description')
                                            ->class('form-control')
                                            ->placeholder(__('labels.subPackage.description')) }}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.teachers.fields.status'))->class('col-md-2 form-control-label')->for('active') }}
                        <div class="col-md-10">
                            {{ html()->label(html()->checkbox('')->name('active')
                                        ->checked(($subPackage->active == 1) ? true : false)->class('switch-input')->value(($subPackage->active == 1) ? 1 : 0)

                                    . '<span class="switch-label"></span><span class="switch-handle"></span>')
                                ->class('switch switch-lg switch-3d switch-primary')
                            }}
                        </div>

                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-4">
                            {{ form_cancel(route('admin.subPackages.index'), __('buttons.general.cancel')) }}
                            {{ form_submit(__('buttons.general.crud.update')) }}
                        </div>
                    </div><!--col-->
                </div>
            </div>
        </div>
    </div>
    {{ html()->form()->close() }}
@endsection
@push('after-scripts')
  
@endpush
