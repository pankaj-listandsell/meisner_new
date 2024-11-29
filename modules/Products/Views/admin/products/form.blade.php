<div class="form-group">
    <label>{{ __('Title')}}</label>
    <input type="text" value="{{ $translation->title ?? 'New Product' }}" placeholder="Product title" name="title" class="form-control">
</div>
<div class="form-group">
    <label>{{ __('Slug')}}</label>
    <input type="text" value="{!! clean($translation->slug) !!}" placeholder="product slug" name="slug" class="form-control"/>
</div>

<div class="form-group">
    <label class="control-label">{{ __('Price')}} </label>
    <div class="">
        <input type="number" value="{!! clean($row->price) !!}" placeholder="product price" name="price" class="form-control"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label">{{ __('Content')}} </label>
    <div class="">
        <textarea id="jhhgjhg" name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->content}}</textarea>
    </div>
</div>
