@extends ('layouts.app')
@section ('content')
    @include('Layout::parts.bc')
    <div class="page-template-content">

        @if($row->template_id)
            <div class="page-template-content">
                {!! $translation->getProcessedContent() !!}
            </div>
        @else
            <div class="page-content">
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

@push('css')
    @if(is_array($translation->gjs_data) && isset($translation->gjs_data['css']))
        <style>
            {{ $translation->gjs_data['css'] }}
        </style>
    @endif
@endpush
