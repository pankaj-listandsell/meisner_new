@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{!empty($recovery) ? __('Recovery') : __("All Gallery")}}</h1>
            <div class="title-actions">
                @if(empty($recovery))
                <a href="{{route('gallery.admin.create')}}" class="btn btn-primary">{{__("Add new gallery")}}</a>
                @endif
            </div>
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                {{-- {{ dd($rows)}} --}}
                @if(!empty($rows))
                    <form method="post" action="{{route('gallery.admin.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                        {{csrf_field()}}
                        <select name="action" class="form-control">
                            <option value="">{{__(" Bulk Actions ")}}</option>

                            @if(!empty($recovery))
                                <option value="recovery">{{__(" Recovery ")}}</option>
                                <option value="permanently_delete">{{__("Permanently delete")}}</option>
                            @else
                                <option value="publish">{{__(" Publish ")}}</option>
                                <option value="draft">{{__(" Move to Draft ")}}</option>
                                <option value="pending">{{__("Move to Pending")}}</option>
                                <option value="clone">{{__(" Clone ")}}</option>
                                <option value="delete">{{__(" Delete ")}}</option>
                            @endif
                        </select>
                        <button data-confirm="{{__("Do you want to delete?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Apply')}}</button>
                    </form>
                @endif
            </div>
            <div class="col-left">
                <form method="get" action="{{ !empty($recovery) ? route('gallery.admin.recovery') : route('gallery.admin.index')}}" class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    <input type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Search by name')}}" class="form-control">
                    <button class="btn-info btn btn-icon btn_search" type="submit">{{__('Search')}}</button>
                </form>
            </div>
        </div>
        <div class="text-right">
            <p><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></p>
        </div>
        <div class="panel">
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="60px"><input type="checkbox" class="check-all"></th>
                            <th> {{ __('Name')}}</th>
                            <th width="100px"> {{ __('Type')}}</th>
                            <th width="100px"> {{ __('Status')}}</th>
                            <th width="100px"> {{ __('Date')}}</th>
                            <th width="100px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($rows->total() > 0)
                            @foreach($rows as $row)
                                <tr class="{{$row->status}}">
                                    <td><input type="checkbox" name="ids[]" class="check-item" value="{{$row->id}}">
                                    </td>
                                    <td class="title">
                                        <a href="{{route('gallery.admin.edit',['id'=>$row->id])}}">{{$row->title}}</a>
                                    </td>
                                    <td>{{ $row->type }}</td>
                                    <td><span class="badge badge-{{ $row->status }}">{{ $row->status }}</span></td>
                                    <td>{{ display_date($row->updated_at)}}</td>
                                    <td>
                                        <a href="{{route('gallery.admin.edit',['id'=>$row->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">{{__("No gallery found")}}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    </div>
                </form>
                {{$rows->appends(request()->query())->links()}}
                <p><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></p>
            </div>
        </div>
    </div>
@endsection