<footer>
    <div class="footer-1">
        <div class="container">
            <div class="row">
                <div class="f1-box-1">
                    <a href="{{ getHomePageUrl() }}">
                        @php
                      $logo_id = setting_item("footer_logo_id");
                      if(!empty($row->custom_logo)){
                        $logo_id = $row->custom_logo;
                      }
                    @endphp
                      @if($logo_id)
                      <?php $logo = get_file_url($logo_id,'full') ?>
                      <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                      @endif
                    </a>
                </div>
                <div class="f1-box-2">
                    <a href="tel:{{ setting_item_with_lang("phone_no_link") }}" alt="{{ setting_item_with_lang("phone_no") }}">
                        <div class="footer-icons">
                            <div class="f-b-1">
                                <img src="/assests/img/icons/footer-icon-phone.svg" alt="Telefon">
                            </div>
                            <div class="f-b-2">
                                <span>Telefon</span>
                                <p>{{ setting_item_with_lang("phone_no") }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="f1-box-3">
                    <a href="mailto:{{ setting_item_with_lang("email") }}" alt="{{ setting_item_with_lang("email") }}">
                        <div class="footer-icons">
                            <div class="f-b-1">
                                <img src="/assests/img/icons/footer-icon-envelope.svg" alt="E-mail">
                            </div>
                            <div class="f-b-2">
                                <span>E-Mail-Adresse</span>
                                <p>{{ setting_item_with_lang("email") }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="f1-box-4">
                    <a target="_blank" href="{{ setting_item_with_lang("address_link") }}">
                        <div class="footer-icons">
                            <div class="f-b-1">
                                <img src="/assests/img/icons/footer-icon-location.svg" alt="Adresse">
                            </div>
                            <div class="f-b-2">
                                <span>Adresse</span>
                                <address>{{ setting_item_with_lang("address") }}</address>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-2">
        <div class="container">
            <div class="row">
                <div class="footer-box-1">
                    <p class="f-title">Meissner Entrümpelung</p>
                    <p class="f-text">Professionell, zuverlässig und umweltfreundlich – Wir entsorgen Ihre Altgeräte, Möbel und mehr. Kontaktieren Sie uns für ein unverbindliches Angebot.</p>
                    <div class="share-icon">
                        <div class="f-1">
                            <a href="https://www.provenexpert.com/de-de/meissner-entruempelung/" target="_blank">
                                <img src="/uploads/0000/1/2024/09/14/proven-expert.webp" alt="Meissner Entrümpelung Bewertungen auf ProvenExpert" srcset="">
                            </a>
                        </div>
                        <div class="f-2">
                            <img src="/uploads/0000/1/2024/09/14/eco-friendly-seal.webp" alt="Siegel für umweltfreundliche Entsorgung">
                        </div>
                        <div class="f-3">
                           <img src="/uploads/0000/1/2024/09/14/ssl-sheild.webp" alt="Meissner Entrümpelung Bewertungen auf SSL">
                        </div>                       
                        <div class="f-4">
                             <a href="https://www.google.com/search?sca_esv=46e9a135ed8bd27b&sxsrf=ANbL-n68BX9l2RSMuyvm1sB0rVW4ONE8lQ:1776075675579&si=AL3DRZEsmMGCryMMFSHJ3StBhOdZ2-6yYkXd_doETEE1OR-qOWJl6N3M7ntI6eUQTSsbH7Jd2yAHK224ifJ8K3z6hd1vaRJ5H-YxhlgB4z7caXbeZ-v-MzDrvSMVL8slB-d61Fdobxi099aq4Bjxvpnf4uU02BURl4PieOJJgJ2c6Z3W6UV1ULgg1Fun-KDhdqrYngoWhNWm&q=Meissner+Entr%C3%BCmpelung+-+Wohnungsaufl%C3%B6sung+%26+Entsorgung+Reviews&sa=X&ved=2ahUKEwj0t_K9zeqTAxXsTWwGHYltCrgQ0bkNegQIMhAH&biw=1707&bih=772&dpr=1.25" target="_blank">
                                <img src="/uploads/0000/14/2026/10/22/meissner-google-review.webp" alt="Meissner Entrümpelung Bewertungen auf Google" srcset="">
                            </a>
                        </div> 
                        <div class="f-5">
                            <a href="https://de.trustpilot.com/review/meissner-entruempelung.de"  target="_blank">
                                <img src="/uploads/0000/14/2026/04/14/trustpilot-lgo-150.png" alt="Meissner Entrümpelung Bewertungen auf Trustpilot" srcset="">
                            </a>
                        </div>

                    </div>
                    <div class="ps-cta ps-cta--footer" data-ps-schliessbar="1" style="display:flex;align-items:center;justify-content:flex-start;gap:10px;flex-wrap:wrap;position:static;margin:14px 0 16px;padding:0;border:0;background:none;font-family:Helvetica,Arial,sans-serif">
                      <a class="ps-btn" style="display:inline-flex;align-items:center;gap:10px;min-height:44px;padding:11px 16px;border:1px solid #d4d8d8;border-radius:10px;background:#fff;color:#1f1d20;font:700 13.5px/1.3 Helvetica,Arial,sans-serif;text-decoration:none;box-shadow:0 1px 2px rgba(20,15,10,.07);max-width:100%"
                         href="https://www.google.com/preferences/source?q=meissner-entruempelung.de&hl=de"
                         target="_blank" rel="noopener nofollow"
                         aria-label="Als bevorzugte Quelle speichern: Meissner Entrümpelung bei Google als bevorzugte Quelle hinterlegen - oeffnet Google in einem neuen Tab">
                        <svg class="ps-g" style="width:19px;height:19px;flex-shrink:0;display:block" viewBox="0 0 48 48" aria-hidden="true" focusable="false">
                          <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                          <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                          <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                          <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                        </svg>
                        <span>Als bevorzugte Quelle speichern</span>
                        <svg class="ps-ext" style="width:13px;height:13px;flex-shrink:0;fill:#8d8e91;display:block" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                          <path d="M14 3h7v7h-2V6.41l-9.29 9.3-1.42-1.42 9.3-9.29H14V3zM5 5h5v2H7v10h10v-3h2v5H5V5z"></path>
                        </svg>
                      </a>
                    </div>
                </div>
                <div class="footer-box-2 footer_list">
                    <p class="f-title">Wichtige Links</p>
                    {!! generate_menu_by_slug('useful') !!}
                </div>
                <div class="footer-box-3 footer_list">
                    <p class="f-title">Unsere Dienstleistungen</p>
                    {!! generate_menu_by_slug('our-services') !!}
                </div>
                <div class="footer-box-4 footer_list">
                    <p class="f-title">Rechtliches</p>
                    {!! generate_menu_by_slug('Rechtliches') !!}
                    <div class="footer-office-hours">
                        <p class="f-title">Öffnungszeiten</p>
                        @include('Layout::parts.office-hours')
                    </div>
                    <div class="footer-social">
                        <p class="f-title">Folgen Sie uns</p>
                        {{-- SVGs are inlined rather than <img src="...svg"> so the colour can be
                             driven by CSS: an external SVG in an <img> is an opaque image and
                             cannot be restyled from the page. fill="currentColor" lets the
                             white -> lime hover live in general.css. --}}
                        <div class="footer-social-icons">
                            <a href="https://www.linkedin.com/company/meissner-entruempelung/" target="_blank" rel="noopener noreferrer" aria-label="Meissner Entrümpelung auf LinkedIn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" fill="currentColor"/>
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/meissner.ent?stkn=azJiMzh4dHNzY2Fy" target="_blank" rel="noopener noreferrer" aria-label="Meissner Entrümpelung auf Instagram">
                                <svg width="21" height="20" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                                    <path d="M18.962 0H7.03795C3.15716 0 0 3.03573 0 6.76726V18.2329C0 21.9642 3.15716 25 7.03795 25H18.9622C22.8428 25 26 21.9642 26 18.2329V6.76726C26 3.03573 22.8428 0 18.962 0ZM24.4757 18.2329C24.4757 21.1561 22.0023 23.5343 18.962 23.5343H7.03795C3.99763 23.5343 1.52423 21.1561 1.52423 18.2329V6.76726C1.52423 3.84387 3.99763 1.4656 7.03795 1.4656H18.9622C22.0023 1.4656 24.4757 3.84387 24.4757 6.76726V18.2329Z" fill="currentColor"/>
                                    <path d="M13 5.66431C9.07997 5.66431 5.89087 8.73074 5.89087 12.5C5.89087 16.2693 9.07997 19.3358 13 19.3358C16.9201 19.3358 20.1092 16.2693 20.1092 12.5C20.1092 8.73074 16.9201 5.66431 13 5.66431ZM13 17.8702C9.92063 17.8702 7.4151 15.4612 7.4151 12.5C7.4151 9.53908 9.92063 7.12991 13 7.12991C16.0796 7.12991 18.585 9.53908 18.585 12.5C18.585 15.4612 16.0796 17.8702 13 17.8702Z" fill="currentColor"/>
                                    <path d="M20.2791 3.23633C19.1207 3.23633 18.1785 4.14251 18.1785 5.25621C18.1785 6.3701 19.1207 7.27628 20.2791 7.27628C21.4376 7.27628 22.38 6.3701 22.38 5.25621C22.38 4.14232 21.4376 3.23633 20.2791 3.23633ZM20.2791 5.81048C19.9614 5.81048 19.7027 5.56176 19.7027 5.25621C19.7027 4.95046 19.9614 4.70193 20.2791 4.70193C20.5971 4.70193 20.8558 4.95046 20.8558 5.25621C20.8558 5.56176 20.5971 5.81048 20.2791 5.81048Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-3">
        <div class="container">
            <div class="f3-d">
                <p>© <span id="yearFooter">2024</span> Meissner Entrumpelung – Alle Rechte vorbehalten</p>
                <p><a class="heart" style="" title="Webdesign" href="https://listandsell.de/" target="_blank" rel="noreferrer noopener"> Webdesign mit ❤ von List &amp; Sell GmbH</a></p>
            </div>
        </div>
    </div>
</footer>

<div class="float-container-btns" style="">
    <a onclick="opencallb();" href="#" class="icons-btns one" data-bs-toggle="modal"
        data-bs-target="#ruckruf"><img width="60" height="60" class=" lazyloaded"
            data-src="/assests/img/icons/float-phone-icon.svg"
            src="/assests/img/icons/float-phone-icon.svg" alt="Anruf"> Anruf</a>
    <a href="https://maps.app.goo.gl/ZjYeoRMyambFWavz5" rel="noopener noreferrer" target="_blank" class="icons-btns two"><img width="60"
            height="60" class=" lazyloaded" data-src="/assests/img/icons/float-location-icon.svg"
            src="/assests/img/icons/float-location-icon.svg" alt="Anfahrt">Anfahrt</a>

            <a href="https://wa.me/4915771443156" rel="noopener noreferrer" target="_blank" class="icons-btns three"><img
            width="38" height="38" class=" lazyloaded" data-src="/assests/img/icons/float-mail-nl.svg"
            src="/uploads/0000/1/2024/09/18/meissner-whatsapp.svg" alt="Whatsapp">WhatsApp</a>
    <!-- <a href="mailto:{{ setting_item_with_lang("email") }}" rel="noopener noreferrer" target="_blank" class="icons-btns three"><img
            width="60" height="60" class=" lazyloaded" data-src="/assests/img/icons/float-mail-nl.svg"
            src="/assests/img/icons/float-mail-nl.svg"> {{ setting_item_with_lang("email") }}</a> -->
</div>


<span><a href="#" class="topbutton">
        <div class="back-top-icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512"
                height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
                xml:space="preserve" class="">
                <g>
                    <path clip-rule="evenodd"
                        d="m466.789 512v-143.559l-210.789-154.306-210.789 154.306v143.559l210.789-154.306zm0-214.135-210.789-154.306-210.789 154.306v-143.559l210.789-154.306 210.789 154.306z"
                        fill-rule="evenodd" fill="#2A343F" data-original="#000000" class=""></path>
                </g>
            </svg></div>
    </a></span>
<div class="mobile_footer">
    <div class="col">
        <a href="/">
            <span class="img"><img src="/assests/img/icons/f-home-icon.svg" alt="Startseite"
                    width="28" height="28"></span>
            <span class="text">
                Startseite </span>
        </a>
    </div>
    <div class="col">
        <a href="#" onclick="openServiceMenu();">
            <span class="img"><img src="/assests/img/icons/f-recycle-bin.svg" alt="Leistungen"
                    width="28" height="28"></span>
            <span class="text">
                Leistungen
            </span>
        </a>
    </div>
    <div class="col">
        <a href="/anfrage/" onclick="openMobileAnfrage();">
            <span class="img"><img src="/assests/img/icons/f-web-icon.svg" alt="Anfrage"
                    width="28" height="28"></span>
            <span class="text">Anfrage</span>
        </a>
    </div>
    <div class="col">
        <a href="tel:00493041723130">
            <span class="img"><img src="/assests/img/icons/f-telephone-icon.svg" alt="Anruf"
                    width="28" height="28"></span>
            <span class="text">
                Anruf </span>
        </a>
    </div>
    <div class="col">
        <a href="#" onclick="openMenu();">
            <span class="img"><img src="/assests/img/icons/f-menu-icon.svg" alt="Menu"
                    width="28" height="28"></span>
            <span class="text">
                Menü
            </span>
        </a>
    </div>
</div>

<div class="callb fade rd-show" id="ruckruf" tabindex="-1" aria-bs-labelledby="callback" aria-hidden="true">
    <div class="callb-dialog  callb-dialog-centered">
        <div class="callb-content">
            <div class="callb-header">
                <button onclick="closeCallb()" type="button" class="close ruckruf-close" data-bs-dismiss="callb"
                    aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="callb-body">
                <x-popup-contact-form></x-popup-contact-form>
            </div>
        </div>
    </div>
</div>


<!--pop up out home--->

<div class="callb fade rd-show" id="popup-f" tabindex="-1" aria-bs-labelledby="callback" aria-hidden="true" >
  <div class="callb-dialog  callb-dialog-centered">
    <div class="callb-content">
      <div class="callb-header">
        <button onclick="closeCallp()" type="button" class="close ruckruf-close" data-bs-dismiss="callb" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="callb-body">
      <div class="popup-contact-form">
    <div class="contact-desc pof-h">
        <h2>Möchten Sie schon gehen?</h2>
       <p>Sichern Sie sich jetzt einen exklusiven <span class="offer_text">Rabatt von 10%</span> auf unsere Entrümpelungs-<br> und Umzugsdienstleistungen.</p>  <br> 
       <span>Haben Sie Fragen?</span>
       <p> Füllen Sie unser Online-Anfrageformular aus, und wir kümmern uns um den Rest! </p>  
        <div class="popup-cta-r">
            <a class="pop-btn-n" title="Anfrage" href="/anfrage">Online-Anfrage</a>
                    
        </div>
        <img src="/uploads/0000/1/2024/09/16/recycle-sign.svg" class="rec-img">
        </div>
     </div>

      </div>
    </div>
  </div>
</div>


<!--side menu--->
<div id="mymenu" class="overlay">
    <!-- Button to close the overlay navigation -->
    <a href="#" class="closebtn" onclick="closeMenu()" aria-label="Menü schließen"><svg xmlns="http://www.w3.org/2000/svg"
            version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35" x="0" y="0"
            viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
            <g>
                <path
                    d="M12 1a11 11 0 1 0 11 11A11.013 11.013 0 0 0 12 1zm4.242 13.829a1 1 0 1 1-1.414 1.414L12 13.414l-2.828 2.829a1 1 0 0 1-1.414-1.414L10.586 12 7.758 9.171a1 1 0 1 1 1.414-1.414L12 10.586l2.828-2.829a1 1 0 1 1 1.414 1.414L13.414 12z"
                    data-name="Layer 2" fill="#2a343f" opacity="1" data-original="#000000" class="">
                </path>
            </g>
        </svg></a>
    <style></style>
    <div class="kb-row-layout-wrap kb-row-layout-id987_7df90f-9e alignnone wp-block-kadence-rowlayout">
        <div
            class="kt-row-column-wrap kt-has-1-columns kt-row-layout-equal kt-tab-layout-inherit kt-mobile-layout-row kt-row-valign-top kt-inner-column-height-full">
            <style></style>
            <div class="">
                <div class="kt-inside-inner-col">
                    <div class="mobile-logo">
                        <figure class="aligncenter"><a href="/" class="kb-advanced-image-link"><img
                                    decoding="async" alt="mobile-logo" src="/uploads/0000/1/2024/08/03/logo-site1.svg"></a></figure>
                    </div>


                    <style></style>
                    <div class="alignnone menu-list mobile">
                        {!! generate_menu_by_slug('mobile-menu') !!}
                    </div>
                </div>
                <a href="tel:00493041723130">
                    <div class="row popup-call">
                        <div class="call-icon">
                            <img src="/uploads/0000/1/2024/08/03/cta-phone-icon.svg" alt="">
                        </div>
                        <div>
                            <span>Meissner-Hotline</span>
                            <p class="phone_no">030 4172 3130</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div id="mynav" class="overlay">
    <!-- Button to close the overlay navigation -->
    <a href="#" class="closebtn" onclick="closeServiceMenu()" aria-label="Menü schließen"><svg xmlns="http://www.w3.org/2000/svg"
            version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35" x="0" y="0"
            viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
            <g>
                <path
                    d="M12 1a11 11 0 1 0 11 11A11.013 11.013 0 0 0 12 1zm4.242 13.829a1 1 0 1 1-1.414 1.414L12 13.414l-2.828 2.829a1 1 0 0 1-1.414-1.414L10.586 12 7.758 9.171a1 1 0 1 1 1.414-1.414L12 10.586l2.828-2.829a1 1 0 1 1 1.414 1.414L13.414 12z"
                    data-name="Layer 2" fill="#2a343f" opacity="1" data-original="#000000" class="">
                </path>
            </g>
        </svg></a>
    <style></style>
    <div class="kb-row-layout-wrap kb-row-layout-id987_7df90f-9e alignnone wp-block-kadence-rowlayout">
        <div
            class="kt-row-column-wrap kt-has-1-columns kt-row-layout-equal kt-tab-layout-inherit kt-mobile-layout-row kt-row-valign-top kt-inner-column-height-full">
            <style></style>
            <div class="">
                <div class="kt-inside-inner-col">
                    <div class="mobile-logo">
                        <figure class="aligncenter"><a href="/" class="kb-advanced-image-link"><img
                                    decoding="async" alt="mobile-logo"  src="/uploads/0000/1/2024/08/03/logo-site1.svg"></a></figure>
                    </div>
                    <div class="service_list">
  <ul class="serviceul">
    <li class="box">
      <div class="drop_title">
        <p class="question__text">
        Entrümpelung </p>
        <img src="/uploads/0000/1/2024/08/30/down-chevron.svg" alt="miss-arrow-bottom.svg" style="transition: 0.5s linear; transform: rotate(0deg);" class="icon_m">
      </div>
      <div class="drop_body">
      {!! generate_menu_by_slug('entrumpelung') !!}
      </div>
    </li>
    <li class="box">
      <div class="drop_title">
        <p class="question__text">
        Entsorgung </p>
        <img src="/uploads/0000/1/2024/08/30/down-chevron.svg" alt="miss-arrow-bottom.svg" style="transform: rotate(0deg); transition: 0.5s linear;" class="icon_m">
      </div>
      <div class="drop_body">
      {!! generate_menu_by_slug('Entsorgung') !!}
      </div>
    </li>
    <li class="box">
      <div class="drop_title">
        <p class="question__text">
        Umzüge   
        </p>
        <img src="/uploads/0000/1/2024/08/30/down-chevron.svg" alt="miss-arrow-bottom.svg" style="transform: rotate(0deg); transition: 0.5s linear;" class="icon_m">
      </div>
      <div class="drop_body">
      {!! generate_menu_by_slug('Umzugsdienste') !!}
      </div>
    </li>
    <li class="box">
      <div class="drop_title">
        <p class="question__text">
        Zusatzservice 
        </p>
        <img src="/uploads/0000/1/2024/08/30/down-chevron.svg" alt="miss-arrow-bottom.svg" style="transform: rotate(0deg);" class="icon_m">
      </div>
      <div class="drop_body">
      {!! generate_menu_by_slug('Zusatzservice') !!}
      </div>
    </li>
  </ul>
    </div>
    <a href="tel:00493041723130">
                    <div class="row popup-call">
                        <div class="call-icon">
                            <img src="/uploads/0000/1/2024/08/03/cta-phone-icon.svg" alt="">
                        </div>
                        <div>
                            <span>Meissner-Hotline</span>
                            <p class="phone_no">030 4172 3130</p>
                        </div>
                    </div>
                </a>
                </div>
            </div>

        </div>
    </div>
</div>

<script>

 const questions = document.querySelectorAll(".drop_title");

questions.forEach((element) => {
  element.addEventListener("click", () => {
    const nextBox = element.nextElementSibling;
    const icons = element.querySelector(".icon_m");

    icons.style.transition = "0.5s linear";

    if (nextBox.classList.contains("active")) {
      nextBox.classList.remove("active");
      icons.style.transform = "rotate(0deg)";
    } else {
      document
        .querySelectorAll(".drop_body.active")
        .forEach((nextBox) => nextBox.classList.remove("active"));
      document
        .querySelectorAll(".icon_m")
        .forEach((normal) => (normal.style.transform = "rotate(0deg)"));

      icons.style.transform = "rotate(180deg)";
      nextBox.classList.add("active");
    }
  });
});
           
</script>

<script async src="/libs/lazy-load/lazysizes.min.js"></script>
<script async src="/libs/lazy-load/plugins/unveilhooks/ls.unveilhooks.js"></script>