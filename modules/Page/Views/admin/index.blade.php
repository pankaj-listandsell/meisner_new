@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __('All Pages')}}</h1>
            <div class="title-actions">
                <a href="{{route('page.admin.create')}}" class="btn btn-primary">{{ __('Add new page')}}</a>
            </div>
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                @if(!empty($rows))
                <form method="post" action="{{route('page.admin.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                    {{csrf_field()}}
                    <select name="action" class="form-control">
                        <option value="">{{__(" Bulk Actions ")}}</option>
                        <option value="publish">{{__(" Publish ")}}</option>
                        <option value="draft">{{__(" Move to Draft ")}}</option>
                        <option value="delete">{{__(" Delete ")}}</option>
                    </select>
                    <button data-confirm="{{__("Do you want to delete?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Apply')}}</button>
                </form>
               @endif
            </div>
            <div class="col-left">
               <form method="get" action="{{route('page.admin.index')}} " class="filter-form filter-form-right d-flex justify-content-end" role="search">
                    <input  type="text" name="page_name" value="{{ Request()->page_name }}" placeholder="{{__('Search by name')}}" class="form-control">
                    <button class="btn-info btn btn-icon btn_search"  type="submit">{{__('Search Page')}}</button>
                </form>
            </div>
        </div>
        <div class="clearfix">
            <div class="pull-right"><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></div>
        </div>
        <div class="panel">
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="60px"><input type="checkbox" class="check-all"></th>
                                <th >{{ __('Title')}}</th>
                                <th width="130px">{{ __('Author')}} </th>
                                <th width="100px">
                                    <a style="color:#212529;" href="{{ route('page.admin.index', array_merge(request()->query(), ['sort_by' => 'date', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}">
                                        {{__('Date')}}
                                        @if(request('sort_by') === 'date')
                                            @if(request('order') === 'asc')
                                                <i class="fa fa-arrow-up"></i>
                                            @else
                                                <i class="fa fa-arrow-down"></i>
                                            @endif
                                        @endif
                                    </a>
                                </th>
                                <th width="100px">{{__('Status')}} </th>
                                <th width="100px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($rows->total() > 0)
                                @foreach($rows as $row)
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" class="check-item" value="{{$row->id}}"></td>
                                        <td class="title">
                                            <a href="{{route('page.admin.edit',['id'=>$row->id])}}"> {{$row->title}}  </a>
                                        </td>
                                        <td class="author">
                                            @if(!empty($row->getAuthor))
                                                {{$row->getAuthor->getDisplayName()}}
                                            @else
                                                {{__("[Author Deleted]")}}
                                            @endif
                                        </td>
                                        <td class="date">{{ display_date($row->updated_at)}}</td>
                                        <td> <span class="badge badge-{{ $row->status }}">{{ $row->status }}</span> </td>
                                        <td>
                                            <a href="{{route('page.admin.edit',['id'=>$row->id])}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> </a>
                                            <a href="{{$row->getDetailUrl(request()->query('lang'))}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> </a>
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
                </form>
                {{$rows->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection
