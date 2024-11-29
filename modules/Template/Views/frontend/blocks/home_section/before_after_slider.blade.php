<?php
    $before_image_url = get_file_url($before_image, 'full');
    $before_image_details = get_file_details($before_image, '#');
?>
<?php
    $after_image_url = get_file_url($after_image, 'full');
    $after_image_details = get_file_details($after_image, '#');
?>
<div class="section before-after-slider">
    <div class="container">
        <div class='img background-img' style="background-image: url({{ $before_image_url }});"></div>
        <div class='img foreground-img' style="background-image: url({{ $after_image_url }});"></div>
        <input type="range" min="1" max="100" value="50" class="slider" name='slider' id="slider">
        <div class='slider-button'></div>
    </div>
</div>