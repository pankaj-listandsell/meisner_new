@extends('admin.layouts.app')
@section('title','News')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("Mover Form")}}</h1>
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                @if(!empty($rows))
                    <form method="post" action="{{route('form.admin.bulkEdit')}}"
                          class="filter-form filter-form-left d-flex justify-content-start">
                        {{csrf_field()}}
                        <select name="action" class="form-control">
                            <option value="">{{__(" Bulk Actions ")}}</option>
                            <option value="delete">{{__(" Delete")}}</option>
                            <option value="read">{{__(" Mark as read")}}</option>
                            <option value="unread">{{__(" Mark as unread")}}</option>
                        </select>
                        <button data-confirm="{{__("Do you want to delete?")}}"
                                class="btn-info btn btn-icon dungdt-apply-form-btn"
                                type="button">{{__('Apply')}}</button>
                    </form>
                @endif
            </div>
            <div class="col-left">
                <form method="get" action="{{route('admin.form.mover')}} "
                      class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row"
                >
                    @if(request()->has('read'))
                        <input type="hidden" name="read" value="{{ request()->get('read') }}"/>
                    @endif

                    <input type="text" class="form-control" name="name" value="{{ request('name') }}"
                           placeholder="{{ trans('Enter name') }}"/>

                    <input type="text" class="form-control" name="email" value="{{ request('email') }}"
                           placeholder="{{ trans('Enter email') }}"/>

                        <input type="text" class="form-control has-daterangepicker"
                               name="form_dates"
                               value="{{ request('form_dates') }}"
                               placeholder="{{ trans('Select date') }}"
                        />

                    <select class="form-control clang-filter" name="lang_type">
                        <option value="">@lang('Lang')</option>
                        @foreach(get_active_languages() as $language)
                            <option value="{{ $language->locale }}"
                                    {{ selected($language->locale, request('lang_type')) }}
                            >
                                {{ $language->name }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn-info btn btn-icon btn_search" type="submit">{{__('Search Form')}}</button>
                </form>
            </div>
        </div>
        <div class="clearfix">
            <div class="pull-left">
                <a href="{{ route('admin.form.mover') }}">@lang('All') ({{ $countAll }})</a> |
                <a href="{{ route('admin.form.mover', ['read' => 0]) }}">@lang('Unread') ({{ $countUnread }})</a>
            </div>
            <div class="pull-right"><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="table-responsive bravo-form-item">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="60px"><input type="checkbox" class="check-all"></th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Lang') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($rows->total() > 0)
                                    @foreach($rows as $row)
                                        <tr>
                                            <td class="col-indicator">
                                                <input type="checkbox" class="check-item" name="ids[]"
                                                       value="{{$row->id}}">
                                                <a href="{{ route('form.admin.update_read_status', ['id' => $row->id, 'read' => $row->read ? 0 : 1]) }}"
                                                   class="indicator-link"
                                                   title="Mark as {{ $row->read ? 'unread' : 'read'}}"
                                                >
                                                    <i class="indicator {{ $row->read ? 'read' : 'unread' }}"></i>
                                                </a>
                                            </td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ display_date($row->created_at)}}</td>
                                            <td>
                                                <i class="flag-icon flag-icon-{{ $row->lang == 'en' ? 'gb' : $row->lang }}"></i>
                                            </td>
                                            <td>
                                                <a href="{{ route('form.admin.view', ['id' => $row->id]) }}"
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.form.edit', ['id' => $row->id]) }}"
                                                   class="btn btn-sm btn-info">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#"
                                                   data-action="{{ route('form.admin.bulkEdit') }}"
                                                   data-id="{{ $row->id }}"
                                                   data-confirm="{{__("Do you want to delete?")}}"
                                                   class="btn btn-sm btn-danger dungdt-btn-delete"
                                                ><i class="fa fa-trash"></i></a>
                                                <a href="{{ route('admin.form.download_mover_file', ['id' => $row->id]) }}"
                                                   class="btn btn-sm btn-info">
                                                    <i class="fa fa-file-pdf-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">{{__("No data")}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        {{$rows->appends(request()->query())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form class="actionable-form" method="post">
        @csrf
        <input type="hidden" name="action" value=""/>
    </form>
@endsection

@include('Form::admin.form.__additional_js')