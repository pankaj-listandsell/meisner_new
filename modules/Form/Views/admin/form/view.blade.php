@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        @include('admin.message')
        @include('Language::admin.navigation')
        <div class="lang-content-box">
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-title clearfix">
                            <strong class="pull-left">{{ __('Form content')}}</strong>
                            <a class="btn btn-primary pull-right" href="{{ url()->previous() }}">
                                <i class="fa fa-arrow-left"></i> {{__('Back')}}
                            </a>
                        </div>
                        <div class="panel-body">

                            <table class="table table-sm table-striped">
                                <tbody>
                                @foreach($formEntries as $formEntry)
                                    <tr>
                                        <td>{{ $formEntry->label }}</td>
                                        <td>
                                            @if($formEntry->type == \Modules\Form\Enums\FormEntryTypes::image->name)
                                                <a href="{{ asset('storage/forms/'.$formEntry->form_id.'/'.$formEntry->value) }}"
                                                   target="_blank"
                                                >
                                                    <img src="{{ asset('storage/forms/'.$formEntry->form_id.'/'.$formEntry->value) }}"
                                                         alt="{{ $formEntry->value }}"
                                                         height="100px"
                                                    />
                                                </a>
                                            @elseif($formEntry->type == \Modules\Form\Enums\FormEntryTypes::multi_select_image->name || in_array($formEntry->key, ['service', 'extra_service']))
                                                @if(is_array(json_decode($formEntry->value)))
                                                    @foreach(json_decode($formEntry->value) as $entry)
                                                        <span class="badge badge-success">{{ $entry }}</span>
                                                    @endforeach
                                                @endif
                                            @else
                                                @if(is_array($formEntry->value))
                                                    @foreach($formEntry->value as $entry)
                                                        {{ $entry }}
                                                    @endforeach
                                                @elseif(is_string($formEntry->value))
                                                    {{ $formEntry->value }}
                                                @endif
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
                </div>
            </div>
        </div>
    </div>
@endsection
