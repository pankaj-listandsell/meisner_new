<div class="form-group">
    <label>{{ __('Title')}}</label>
    <input type="text" value="{{ $translation->title ?? 'New Post' }}" placeholder="News title" name="title" class="form-control">
</div>
<div class="form-group">
    <label>{{ __('Slug')}}</label>
    <input type="text" value="{!! clean($translation->slug) !!}" placeholder="Page slug" name="slug" class="form-control"/>
</div>
<div class="form-group">
    <label class="control-label">{{ __('Content')}} </label>
    <div class="">
        <textarea id="jhhgjhg" name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->content}}</textarea>
    </div>
</div>
 