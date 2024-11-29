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
                                <img src="/assests/img/icons/footer-icon-phone.svg">
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
                                <img src="/assests/img/icons/footer-icon-envelope.svg">
                            </div>
                            <div class="f-b-2">
                                <span>E-Mail-Adresse</span>
                                <p>{{ setting_item_with_lang("email") }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="f1-box-4">
                    <a target="_blank" href="https://maps.app.goo.gl/6NvACgavh2TN99RT6">
                        <div class="footer-icons">
                            <div class="f-b-1">
                                <img src="/assests/img/icons/footer-icon-location.svg">
                            </div>
                            <div class="f-b-2">
                                <span>Adresse</span>
                                <p>{{ setting_item_with_lang("address") }}</p>
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
                            <img src="/uploads/0000/1/2024/09/14/proven-expert.webp">
                        </div>
                        <div class="f-2">
                            <img src="/uploads/0000/1/2024/09/14/eco-friendly-seal.webp">
                        </div>
                        <div class="f-3">
                           <img src="/uploads/0000/1/2024/09/14/ssl-sheild.webp">
                        </div>
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
            src="/assests/img/icons/float-phone-icon.svg"> Anruf</a>
    <a href="https://maps.app.goo.gl/6NvACgavh2TN99RT6" rel="noopener noreferrer" target="_blank" class="icons-btns two"><img width="60"
            height="60" class=" lazyloaded" data-src="/assests/img/icons/float-location-icon.svg"
            src="/assests/img/icons/float-location-icon.svg">Anfahrt</a>

            <a href="https://wa.me/4915771443156" rel="noopener noreferrer" target="_blank" class="icons-btns three"><img
            width="38" height="38" class=" lazyloaded" data-src="/assests/img/icons/float-mail-nl.svg"
            src="/uploads/0000/1/2024/09/18/meissner-whatsapp.svg">WhatsApp</a>
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
        <a href="/anfrage" onclick="openMobileAnfrage();">
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
    <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()"><svg xmlns="http://www.w3.org/2000/svg"
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
                            <img src="/uploads/0000/1/2024/08/03/cta-phone-icon.svg">
                        </div>
                        <div>
                            <span>Meissner-Hotline</span>
                            <h4>030 4172 3130</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div id="mynav" class="overlay">
    <!-- Button to close the overlay navigation -->
    <a href="javascript:void(0)" class="closebtn" onclick="closeServiceMenu()"><svg xmlns="http://www.w3.org/2000/svg"
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
      {!! generate_menu_by_slug('Entrümpelung') !!}
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
                            <img src="/uploads/0000/1/2024/08/03/cta-phone-icon.svg">
                        </div>
                        <div>
                            <span>Meissner-Hotline</span>
                            <h4>030 4172 3130</h4>
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