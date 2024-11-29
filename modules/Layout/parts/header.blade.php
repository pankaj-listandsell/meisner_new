<div class="container middlebar">
    <div class="header-2">
        <div class="b-box-1">
            <a href="{{ getHomePageUrl() }}">
                @php
                    $logo_id = setting_item('logo_id');
                    if (!empty($row->custom_logo)) {
                        $logo_id = $row->custom_logo;
                    }
                @endphp
                @if ($logo_id)
                    <?php $logo = get_file_url($logo_id, 'full'); ?>
                    <img width="250" height="60" src="{{ $logo }}" alt="{{ setting_item('site_title') }}">
                @endif

            </a>
        </div>
            <div class="b-box-2">
            <a href="tel:{{ setting_item_with_lang('phone_no_link') }}">
                <div class="row head_call">
                    <div class="call-icon">
                        <img src="/assests/img/icons/cta-phone-icon.svg">
                    </div>
                    <div>
                        <span>Meissner-Hotline</span>
                        <h4>{{ setting_item_with_lang('phone_no') }}</h4>
                    </div>
                </div>
                </a>
                <!-- <div class="cta-btn">
                    <a class="cta-btn-n" title="Anfrage" href="/anfrage">Online-Anfrage</a>
                </div> -->
                <div class="cta-btn">
                    <a class="anf_dropdown-button">Online-Anfrage <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="13" height="14" x="0" y="0" viewBox="0 0 451.847 451.847" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M225.923 354.706c-8.098 0-16.195-3.092-22.369-9.263L9.27 151.157c-12.359-12.359-12.359-32.397 0-44.751 12.354-12.354 32.388-12.354 44.748 0l171.905 171.915 171.906-171.909c12.359-12.354 32.391-12.354 44.744 0 12.365 12.354 12.365 32.392 0 44.751L248.292 345.449c-6.177 6.172-14.274 9.257-22.369 9.257z" fill="#ffffff" opacity="1" data-original="#000000"></path></g></svg></a>
                    <div class="anf_dropdown-content">
                        <a href="/umzug-planen/">Umzug planen</a>
                        <a href="/anfrage/">Entrümpelung planen</a>
                    </div>
                </div>
            </div>
        
    </div>
    <div class="sticky_header">
    <div class="header-3">
    <a href="{{ getHomePageUrl() }}" class="sticky_head" style="display:none">

        @if ($logo_id)
            <?php $logo = get_file_url($logo_id, 'full'); ?>
            <img src="{{ $logo }}">
        @endif
        </a>
        {!! generate_primary_menu() !!}
    </div>
    </div>
    
</div>
</header>
<div id="mobile-header">
    <a href="{{ getHomePageUrl() }}" class="mobile-header">

        @if ($logo_id)
            <?php $logo = get_file_url($logo_id, 'full'); ?>
            <img src="{{ $logo }}">
        @endif
    </a>
</div>
