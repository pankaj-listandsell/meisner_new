@if (!empty($list_item))
    <div class="row sec6-2">
        @foreach ($list_item as $item)
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="count-box">
                    <h4>{{ $item['title'] }}</h4>
                    <p>{{ $item['sub_title'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endif
</div>
</div>
