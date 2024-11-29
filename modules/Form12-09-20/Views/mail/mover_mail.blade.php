<figure>
    <img src="{{ !$isTesting ? $message->embed(public_path('/dist/frontend/images/logo.png')) : asset('/dist/frontend/images/logo.png') }}"
         alt="company logo"
         height="50px"
    />
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
    @lang('AFLEX Dienstleistungen')
    <br/>
    Romain-Rolland-Strasse 55
    <br/>
    13089 Berlin
    <br/>
    <br/>
    @lang('Telephone'): 030 / 2393 1002
    <br/>
    info@aflex.de
</div>
