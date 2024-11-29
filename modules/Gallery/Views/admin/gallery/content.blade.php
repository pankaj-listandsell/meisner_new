<div class="panel">
    <div class="panel-title"><strong>{{__("Gallery Content")}}</strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label>{{__("Title")}}</label>
            <input type="text" value="{!! clean($translation->title) !!}" placeholder="{{__("Gallery title")}}" name="title" class="form-control">
        </div>
        <div class="form-group @if(!is_default_lang()) d-none @endif ">
            <label class="control-label">
                {{__("Type")}}
            </label>
            <select name="type" class="form-control">
                <option value="gallery">{{__("Gallery")}}</option>
                <option value="carousel">{{__("Carousel")}}</option>
            </select>
        </div>
        @if(is_default_lang())
            <div class="form-group">
                <label class="control-label">{{__("Gallery")}}</label>
                {!! \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery) !!}
            </div>
        @endif
    </div>
</div>


@push('js')
    <style>
        .sortable-g-img .image-item {
            cursor: move; /* fallback if grab cursor is unsupported */
            cursor: grab;
            cursor: -moz-grab;
            cursor: -webkit-grab;
        }
    </style>
    <script src="{{ asset('js/jquery-sortable.js') }}"></script>
    <script>

        jQuery(document).ready(function ($) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var group = $(".sortable-g-img").sortable({
                group: 'serialization',
                containerSelector: '.attach-demo',
                itemSelector: '.image-item',
                placeholder: '<div class="image-item">' +
                    '<div class="image-item">' +
                    '<div class="inner">' +
                    '<img src="{{ asset('images/_blank.jpg') }}" class="image-responsive image-preview">' +
                    '</div>' +
                    '</div>' +
                    '</div>',
                onDrop: function ($item, container, _super) {
                    var data = group.sortable("serialize").get();

                    var image_ids = data[0].map(function (item) {
                        return item.id;
                    });

                    var imageIdsInString = image_ids.join(',');

                    $('input[name="gallery"]').val(imageIdsInString);

                    /*$.ajax({
                        url: '{{ route('gallery.admin.sort_images') }}',
                        type: 'POST',
                        data: {
                            image_ids: image_ids,
                            gallery_id: {{ $row->id }}
                        },
                        success: function (data,status,xhr) {   // success callback function
                            //console.log(data, status);
                        },
                        error: function (jqXhr, textStatus, errorMessage) { // error callback
                            //console.log(textStatus, errorMessage);
                        }
                    });*/

                    _super($item, container);
                }
            });
        });
    </script>
@endpush
