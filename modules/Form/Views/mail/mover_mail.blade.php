<figure>
@php
            $logo_id = setting_item("logo_id");
            if(!empty($row->custom_logo)){
                $logo_id = $row->custom_logo;
            }
        @endphp
        @if($logo_id)
            <?php $logo = get_file_url($logo_id,'full') ?>
            <img src="{{$logo}}"
         alt="Logo"
         height="50px"
    />
        @endif
    
</figure>
<h4>@lang('Dear') {{ $clientName }},</h4>
<div class="main-content">
    <p>
        @lang('This is your summary (as a PDF attached) from our online calculator').
        <br/>
        @lang('We will send you your offer with price details separately').
    </p>
</div>
<div>@lang('Best regards')</div>
<hr/>
<div class="footer-content" style="text-align: center">
    <br/>
    <br/>
    @lang('Meissner Entrümpelung')
    <br/>
    Oranienburgerstr. 47
    <br/>
    13437 Berlin
    <br/>
    <br/>
    @lang('Telephone'): 030 4172 3130
    <br/>
    info@meissner-entruempelung.de
</div>
