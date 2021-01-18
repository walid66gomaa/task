@extends('backend.layouts.app')

@section('title', __('labels.backend.subPackages.title').' | '.app_name())

@section('content')

    {{ html()->form('POST', route('admin.subPackages.store'))->acceptsFiles()->class('form-horizontal')->open() }}
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
                     
                        {!! Form::label('slug',  trans('slug'), ['class' => 'col-md-2 form-control-label']) !!}
                        <div class="col-md-10">
                            {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' =>  trans('labels.backend.courses.slug_placeholder')]) !!}
        
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                     
                       
                        {!! Form::label('price',  trans('labels.backend.courses.fields.price').' (in $)', ['class' => 'col-md-2 form-control-label']) !!}
                        
                        <div class="col-md-10">
                            {!! Form::number('price', old('price'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.courses.fields.price'),'step' => 'any', 'pattern' => "[0-9]"]) !!}
                           
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                     
                       
                        {!! Form::label('duration',  trans('labels.backend.subPackages.fields.duration').' (in monthes)', ['class' => 'col-md-2 form-control-label']) !!}
                        
                        <div class="col-md-10">
                            {!! Form::number('duration', old('duration'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.subPackages.fields.duration'),'step' => 'any', 'pattern' => "[0-9]"]) !!}
                           
                        </div><!--col-->
                    </div><!--form-group-->

                

                 

                 

                  


                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.subPackages.fields.description'))->class('col-md-2 form-control-label')->for('description') }}

                        <div class="col-md-10">
                            {{ html()->textarea('description')
                                            ->class('form-control')
                                            ->placeholder(__('labels.backend.subPackages.fields.description')) }}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.subPackages.fields.status'))->class('col-md-2 form-control-label')->for('active') }}
                        <div class="col-md-10">
                            {{ html()->label(html()->checkbox('')->name('active')
                                        ->checked(true)->class('switch-input')->value(1)

                                    . '<span class="switch-label"></span><span class="switch-handle"></span>')
                                ->class('switch switch-lg switch-3d switch-primary')
                            }}
                        </div>

                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-4">
                            {{ form_cancel(route('admin.subPackages.index'), __('buttons.general.cancel')) }}
                            {{ form_submit(__('buttons.general.crud.create')) }}
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
