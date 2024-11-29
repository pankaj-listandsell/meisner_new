@extends('admin.layouts.app')
@section('title','News')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("All Forms")}}</h1>
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
                <form method="get" action="{{route('admin.form.index')}} "
                      class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row"
                      role="search">
                    <select class="form-control" name="form_type">
                        <option value="">Form Type</option>
                        @foreach(\Modules\Form\Enums\FormTypes::all() as $key => $name)
                            <option value="{{ $key }}"
                                    {{ selected($key, request('form_type')) }}
                            >{{ $name }}</option>
                        @endforeach
                    </select>

                    <select class="form-control" name="lang_type" style="margin-left: 15px;">
                        <option value="">Lang</option>
                        @foreach(get_active_languages() as $language)
                            <option value="{{ $language->locale }}"
                                    {{ selected($key, request('lang_type')) }}
                            >
                                {{ $language->name }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn-info btn btn-icon btn_search" type="submit">{{__('Search Form')}}</button>
                </form>
            </div>
        </div>
        <div class="text-right">
            <p><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th width="60px"><input type="checkbox" class="check-all"></th>
                                        <th class="title">{{ __('Type') }}</th>
                                        <th width="130px">{{ __('Lang') }}</th>
                                        <th width="100px">{{ __('Date') }}</th>
                                        <th width="100px">{{ __('Action') }}</th>
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
                                                <td>
                                                    {{ \Modules\Form\Enums\FormTypes::fromName($row->type) }}
                                                </td>
                                                <td>
                                                    <i class="flag-icon flag-icon-{{ $row->lang == 'en' ? 'gb' : $row->lang }}"></i>
                                                </td>
                                                <td>{{ display_date($row->updated_at)}}</td>
                                                <td>
                                                    <a href="{{ route('form.admin.view', ['id' => $row->id]) }}" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-eye"></i> {{__('View')}}
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
                        </form>
                        {{$rows->appends(request()->query())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
