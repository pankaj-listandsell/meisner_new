<div class="counter-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="count-box">
                    <div class="count-img">
                        <?php
                          $image_url = get_file_url(setting_item('first_counter_icon'), 'full');
                          $image_details = get_file_details(setting_item('first_counter_icon'), '#');
                        ?>
                        <img title="{{ isset($image_details['title'])?$image_details['title']:'#' }}" alt="{{ isset($image_details['alt'])?$image_details['alt']:'#' }}" src="{{ $image_url }}">
                    </div>
                    <div>
                        <h4>{{setting_item('first_counter_title') ?? ''}}</h4>
                        <p>{{setting_item('first_counter_subtitle') ?? ''}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="count-box">
                    <div class="count-img">
                        <?php
                        $image_url = get_file_url(setting_item('second_counter_icon'), 'full');
                        $image_details = get_file_details(setting_item('second_counter_icon'), '#');
                        ?>
                        <img title="{{ isset($image_details['title'])?$image_details['title']:'#' }}" alt="{{ isset($image_details['alt'])?$image_details['alt']:'#' }}" src="{{ $image_url }}">
                    </div>
                    <div>
                        <h4>{{setting_item('second_counter_title') ?? ''}}</h4>
                        <p>{{setting_item('second_counter_subtitle') ?? ''}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="count-box">
                    <div class="count-img">
                        <?php $image_url = get_file_url(setting_item('third_counter_icon'), 'full');
                          $image_details = get_file_details(setting_item('third_counter_icon'), '#');
                        ?>
                        <img title="{{ isset($image_details['title'])?$image_details['title']:'#' }}" alt="{{ isset($image_details['alt'])?$image_details['alt']:'#' }}" src="{{ $image_url }}">
                    </div>
                    <div>
                        <h4>{{setting_item('third_counter_title') ?? ''}}</h4>
                        <p>{{setting_item('third_counter_subtitle') ?? ''}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="count-box">
                    <div class="count-img">
                        <?php $image_url = get_file_url(setting_item('fourth_counter_icon'), 'full');
                        $image_details = get_file_details(setting_item('fourth_counter_icon'), '#');?>
                        <img title="{{ isset($image_details['title'])?$image_details['title']:'#' }}" alt="{{ isset($image_details['alt'])?$image_details['alt']:'#' }}" src="{{ $image_url }}">
                    </div>
                    <div>
                        <h4>{{setting_item('fourth_counter_title') ?? ''}}</h4>
                        <p>{{setting_item('fourth_counter_subtitle') ?? ''}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
