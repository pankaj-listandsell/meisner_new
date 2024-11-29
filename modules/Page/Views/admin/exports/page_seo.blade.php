<table>
    <thead>
    <tr>
        <th>id</th>
        <th>locale</th>
        <th>slug</th>
        <th>url</th>
        <th>seo_title</th>
        <th>seo_desc</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pages as $page)
            <?php
            $isPageTranslation = isset($page->origin_id);
            $meta = \Modules\Core\Models\SEO::where('object_id', $page->id)
                ->where('object_model', $isPageTranslation ? 'page_translation_' . $page->locale : 'page')
                ->first();
            /*if($page->id == 25 && $isPageTranslation) {
                dd($meta->toArray());
            }*/
            ?>
        <tr>
            <td>{{ $page->id }}</td>
            <td>{{ $isPageTranslation ? $page->locale : get_default_lang() }}</td>
            <td>{{ $page->slug }}</td>
            <td>{{ $page->getDetailUrl() }}</td>
            <td>{{ $meta ? $meta->seo_title : '' }}</td>
            <td>{{ $meta ? $meta->seo_desc : '' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>