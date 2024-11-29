<div class="location-search">
    <div class="container">
        <img class="l-Search-icon" alt="#" title="#" src="/assests/img/location-search-icon.svg">
        <form>
            <input id="city-search-input" placeholder="Stadtname eingeben" type="text">
            <input type="submit" value="Stadt suchen">
            <div id="city-suggestions"></div>
        </form>
    </div>
</div>
@once
    @push('js')
    <script type="text/javascript">

    $(document).ready(function(){
        $('#city-search-input').on('input', function() {
            let query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: "{{ route('city.search') }}",
                    type: "GET",
                    data: {query: query},
                    success: function(data) {
                        let suggestions = $('#city-suggestions');
                        suggestions.empty().show();
                        if(data.length > 0) {
                            $.each(data, function(index, city) {
                                suggestions.append('<div class="suggestion-item" data-id="'+city.slug+'">'+city.title+'</div>');
                            });
                        } else {
                            $('#city-suggestions').hide();
                        }
                    }
                });
            } else {
                $('#city-suggestions').hide();
            }
        });

        $(document).on('click', '.suggestion-item', function() {
            let cityId = $(this).data('id');
            window.location.href = "{{ url('/') }}/" + cityId;
        });
    });
</script>
@endpush
@endonce
