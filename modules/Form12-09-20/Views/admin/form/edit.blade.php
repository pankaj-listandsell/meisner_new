@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        @include('admin.message')
        @include('Language::admin.navigation')
        <div class="lang-content-box">
            <form action="{{ route('admin.form.update', ['id' => $form->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="form_id" value="{{ $form->id }}"/>
                <input type="hidden" name="form_type" value="{{ $form->type }}"/>
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="panel-title clearfix">
                                <strong class="pull-left">{{ __('Form Edit')}}</strong>
                                <a class="btn btn-primary pull-right" href="{{ url()->previous() }}">
                                    <i class="fa fa-arrow-left"></i> {{__('Back')}}
                                </a>
                            </div>
                            <div class="section-form-edit">
                                <table class="table table-sm table-striped">
                                        <tbody>
                                        @foreach($formEntries as $formEntry)
                                            <tr class="row-label">
                                                <td>{{ $formEntry->label }}</td>
                                            </tr>
                                            <tr class="row-option">
                                                <td>
                                                    @if($formEntry->type == \Modules\Form\Enums\FormEntryTypes::select->name)
                                                        <select name="{{ $formEntry->key }}" class="form-control input-sm">
                                                            {!! getOptionFromSchema($schema, $formEntry->key, $formEntry->value) !!}
                                                        </select>
                                                    @endif
                                                    @if($formEntry->type == \Modules\Form\Enums\FormEntryTypes::radio_image->name)
                                                        <select name="{{ $formEntry->key }}" class="form-control input-sm">
                                                            {!! getRadioImageOptionFromSchema($schema, $formEntry->key, $formEntry->value) !!}
                                                        </select>
                                                    @endif
                                                    @if($formEntry->type == \Modules\Form\Enums\FormEntryTypes::multi_select_image->name)
                                                        <select name="{{ $formEntry->key }}[]" multiple class="form-control input-sm dungdt-select2-field select2-hidden-accessible">
                                                            @if(is_array(json_decode($formEntry->value)))
                                                                {!! getMultiSelectImageOptionFromSchema($schema, $formEntry->key, json_decode($formEntry->value)) !!}
                                                            @endif
                                                        </select>
                                                    @endif
                                                    @if($formEntry->type == \Modules\Form\Enums\FormEntryTypes::date->name)
                                                        <input type="text"
                                                               name="{{ $formEntry->key }}"
                                                               class="has-datepicker form-control input-sm"
                                                               value="{{ date('d.m.Y', strtotime($formEntry->value)) }}"
                                                        />
                                                    @endif
                                                    @if($formEntry->type == \Modules\Form\Enums\FormEntryTypes::text->name)
                                                        <input type="text"
                                                               name="{{ $formEntry->key }}"
                                                               class="form-control input-sm"
                                                               value="{{ $formEntry->value }}"
                                                        />
                                                    @endif
                                                    @if($formEntry->type == \Modules\Form\Enums\FormEntryTypes::number->name)
                                                        <input type="number"
                                                               name="{{ $formEntry->key }}"
                                                               class="form-control input-sm"
                                                               value="{{ $formEntry->value }}"
                                                        />
                                                    @endif
                                                    @if($formEntry->type == \Modules\Form\Enums\FormEntryTypes::radio->name)
                                                        {!! getRadioOptionFromSchema($schema, $formEntry->key, $formEntry->value) !!}
                                                    @endif
                                                    @if($formEntry->type == \Modules\Form\Enums\FormEntryTypes::textarea->name)
                                                        <textarea class="form-control input-sm"
                                                                  rows="4"
                                                                  name="{{ $formEntry->key }}"
                                                        >{{ $formEntry->value }}</textarea>
                                                    @endif
                                                    @if($formEntry->type == \Modules\Form\Enums\FormEntryTypes::image->name)
                                                        <a href="{{ asset('storage/forms/'.$formEntry->form_id.'/'.$formEntry->value) }}"
                                                           target="_blank"
                                                        >
                                                            <img src="{{ asset('storage/forms/'.$formEntry->form_id.'/'.$formEntry->value) }}"
                                                                 alt="{{ $formEntry->value }}"
                                                                 height="100px"
                                                            />
                                                        </a>
                                                        <input type="file"
                                                               name="{{ $formEntry->key }}"
                                                               value="{{ $formEntry->value }}"
                                                        />
                                                    @endif
                                                    @if($formEntry->type == \Modules\Form\Enums\FormEntryTypes::checkbox->name)
                                                        <input type="checkbox"
                                                               name="{{ $formEntry->key }}"
                                                               class="mr-15"
                                                                {{ $formEntry->value ? 'checked' : '' }}
                                                        />
                                                        {{ getFormPlaceholder($schema, $formEntry->key) }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-body">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{__('Save Changes')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
