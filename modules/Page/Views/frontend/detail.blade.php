@extends ('layouts.app')
@section ('content')
    @include('Layout::parts.bc')
    @if(Auth::check())
        <a class="edit_page_url" target="_blank" href="{{ route('page.admin.edit', $row->id) }}">edit</a>
    @endif
    <div class="page-template-content">
        @if($row->template_id)
            <div class="page-template-content">
                {!! $translation->getProcessedContent() !!}
            </div>
        @else
            <div class="container " style="padding-top: 40px;padding-bottom: 40px;">
                <h1>{!! clean($translation->title) !!}</h1>
                <div class="blog-content">
                    @if($row->has_shortcode)
                        <?php include getShortcodeContentPath(isset($page_slug) ? $page_slug : 'home', $translation->content); ?>
                    @else
                        {!! $translation->content !!}
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection

{{-- @push('css')
    <link href="{{ asset('new_custom.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
@endpush
--}}