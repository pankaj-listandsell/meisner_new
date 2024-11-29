<div class="section location-section3">
    <div class="container">
        <h2>{{ $title }}</h2>
        {!! $content !!}
        <div class="row">
            <div class="col-lg-12">
                <ul>
                    @foreach($rows as $row)
                    <li><a href="{{$row->getDetailUrl(request()->query('lang'))}}" alert="{{ $row['title'] }}">{{ $row['title'] }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
