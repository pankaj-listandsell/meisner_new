<div class="form-group">
    <label> {{ __('Name')}}</label>
    <input type="text" value="{{$translation->name}}" placeholder="Category name" name="name" class="form-control">
</div>
<div class="form-group">
    <label> {{ __('Slug')}}</label>
    <input type="text" value="{{$translation->slug}}" placeholder="Category slug" name="slug" class="form-control">
</div>
@if(is_default_lang())
<div class="panel">
    <div class="panel-body">
        <h3 class="panel-body-title"> {{ __('Feature Image')}}</h3>
        <div class="form-group">
            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
        </div>
    </div>
</div>
@endif
{{-- @if(is_default_lang())
<div class="form-group">
    <label> {{ __('Parent')}}</label>
    <select name="parent_id" class="form-control">
        <option value=""> {{ __('-- Please Select --')}}</option>
        <?php
        $traverse = function ($categories, $prefix = '') use (&$traverse, $row) {
            foreach ($categories as $category) {
                if ($category->id == $row->id) {
                    continue;
                }
                $selected = '';
                if ($row->parent_id == $category->id)
                    $selected = 'selected';
                printf("<option value='%s' %s>%s</option>", $category->id, $selected, $prefix . ' ' . $category->name);
                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($parents);
        ?>
    </select>
</div>
@endif --}}
{{--<div class="form-group">--}}
    {{--<label class="control-label"> {{ __('Description')}}</label>--}}
    {{--<textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->content}}</textarea>--}}
{{--</div>--}}
