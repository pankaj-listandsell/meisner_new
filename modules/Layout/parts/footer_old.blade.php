@if(!is_api())
	<div class="bravo_footer">
		<div class="main-footer">
    <svg viewBox="0 0 1000 100" preserveAspectRatio="none"><path d="M0,40c0,0 120.077,-38.076 250,-38c129.923,0.076 345.105,78 500,78c154.895,0 250,-30 250,-30l0,50l-1000,0l0,-60Z"></path><path d="M0,40c0,0 120.077,-38.076 250,-38c129.923,0.076 345.105,73 500,73c154.895,0 250,-45 250,-45l0,70l-1000,0l0,-60Z" style="opacity: 0.4"></path><path d="M0,40c0,0 120.077,-38.076 250,-38c129.923,0.076 345.105,68 500,68c154.895,0 250,-65 250,-65l0,95l-1000,0l0,-60Z" style="opacity: 0.4"></path></svg>
			<div class="container">
                <div class="mycustom_footer">
                    <div class="logo">
                    @php
                      $logo_id = setting_item("logo_id");
                      if(!empty($row->custom_logo)){
                        $logo_id = $row->custom_logo;
                      }
                    @endphp
                      @if($logo_id)
                      <?php $logo = get_file_url($logo_id,'full') ?>
                      <img id="foot-logo" height="108" width="71" src="{{$logo}}" alt="{{setting_item("site_title")}}">
                      @endif
                    </div>
                    <p class="foot_about">
                      <?php 
                      if(get_current_lang() == 'de'){
                        echo "Seit vielen Jahren sind die Aflex Ihr kompetenter und zuverlässiger Partner, wenn es um die schnelle, fachgerechte und günstige Entrümpelung und Entsorgunggeht.";
                      }
                      else{
                        echo "For many years, Aflex has been your competent and reliable partner when it comes to quick, professional and affordable clearing out and disposal.";
                      } 
                      ?>   
                    </p>
                    <div class="ff_seals" style="text-align: center"> 
                      <!-- ProvenExpert Bewertungssiegel -->
                      <a href="https://www.provenexpert.com/aflex-entruempelung-wohnungsaufloesung-berlin/" target="_blank"><img src="https://aflex.de/uploads/0000/1/2024/01/19/proven-expert-aflex.webp"></a>
                      <!-- ProvenExpert Bewertungssiegel -->
                      <a href="https://www.google.com/search?hl=en-AE&gl=ae&q=AFLEX+-+Entr%C3%BCmpelungen,+Umz%C3%BCge+%26+Malerarbeiten,+Romain-Rolland-Stra%C3%9Fe+55,+13089+Berlin,+Germany&ludocid=13905636771818148638&lsig=AB86z5VkY4AZVXslJd8cg2paowfM#lrd=0x47a85025309c3451:0xc0fabef7ffd4931e,1,,,," target="_blank"><img src="https://aflex.de/uploads/0000/1/2024/01/19/aflex-kundenreviews.webp"></a>
                    </div>
                  <div class="menu_foot">
                  <ul class="foot_list">
                    <li id="en_menu"><?php
                    if(get_current_lang() == 'de'){
                      echo "Entrümpelung";
                    }
                    else{
                      echo "Clearing Out";
                    }
                    ?> <span class="icon">+</span></li>
                    <li id="et_menu"><?php
                    if(get_current_lang() == 'de'){
                      echo "Entsorgung";
                    }
                    else{
                      echo "Disposal";
                    }
                    ?> <span class="icon">+</span></li>
                    <li id="um_menu"><?php
                    if(get_current_lang() == 'de'){
                      echo "Umzug";
                    }
                    else{
                      echo "Mover";
                    }
                    ?> <span class="icon">+</span></li>
                    <li id="mal_menu"><?php
                    if(get_current_lang() == 'de'){
                      echo "Maler";
                    }
                    else{
                      echo "Painting";
                    }
                    ?> <span class="icon">+</span></li>
                    <li id="ma_menu" class="link"><a href="/blog/">Blog</a></li>
                  </ul>
                </div>
                <div class="fmenu_content">
                </div>
                <ul class="kontakt_details">
                  <!-- <li class="address"><a target="_blank" href="https://www.google.com/maps/place/AFLEX+-+Entr%C3%BCmpelungen,+Malerarbeiten+%26+Umz%C3%BCge/@52.5669,13.4400601,17z/data=!3m1!4b1!4m6!3m5!1s0x47a85025309c3451:0xc0fabef7ffd4931e!8m2!3d52.5669!4d13.4400601!16s%2Fg%2F11b6hgdh5t?source=g.page.share&shorturl=1">
                    <img src="/uploads/0000/1/2023/10/09/location.png" width="32" height="28"> Romain-Rolland-Straße 55, 13089 Berlin</a></li> -->
                  <li class="tel"><a href="tel:00493023931002"><img src="/uploads/0000/1/2023/10/09/call.png" width="32" height="22"> 030 2393 1002</a></li>
                  <li class="whats"><a href="https://wa.me/4917623878600"><img src="https://aflex.de/uploads/0000/1/2024/01/19/whatsapp-aflex.png" width="22" height="22"> 0176 2387 8600</a></li>
                  <li class="email"><a href="mailto:info@aflex.de"><img src="/uploads/0000/1/2023/10/09/email.png" width="32" height="16.50"> info@aflex.de</a></li>
                  </ul>
                  <ul class="legal_pages">
                      <li><a href="/impressum/">Impressum</a></li>
                      <li><a href="/datenschutz/">Datenschutz</a></li>
                  </ul>
                </div>
                
                </div>
			</div>
		</div>
		<div class="copy-right">
			<div class="container context">
				<div class="row">
					<div class="col-md-12">
						{!! clean(setting_item_with_lang("footer_text_left"))  !!}
						<div class="f-visa">
							{!! clean(setting_item_with_lang("footer_text_right"))  !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endif

@include('Layout::parts.login-register-modal')

@if(Auth::check())
	@include('Media::browser')
@endif

<?php
    $isBookingPage = isset($is_booking_page) && $is_booking_page;
?>

{!! \App\Helpers\Assets::css(true) !!}
<?php //!isOnProduction()
	$version = rand(1,10000);
 ?>
<script src="{{ asset('libs/jquery-3.3.1.min.js?version='.$version) }}"></script>
@if(true)
	<script async src="{{asset('libs/lazy-load/lazysizes.min.js?version='.$version)}}"></script>
	<script defer src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js?version='.$version) }}"></script>
	@if(!$isBookingPage)
		<!-- <script defer src="{{ asset('libs/carousel-2/owl.carousel.min.js?version='.$version) }}"></script> -->
	@endif
	<script defer src="{{ asset('js/jquery.scrollUp.min.js?version='.$version) }}"></script>
	<script defer src="{{ asset('js/home.js?version='.$version) }}"></script>
	<script defer src="{{ asset('libs/carousel-2/owl.carousel.min.js?version='.$version) }}"></script>
@else
	<script defer src="{{ asset('js/combined-app.js?version='.$version) }}"></script>
@endif

@if(!empty($is_user_page))
	<script defer src="{{ asset('module/user/js/user.js?_ver='.config('app.asset_version')) }}"></script>
@endif
@if(setting_item('cookie_agreement_enable')==1 and request()->cookie('booking_cookie_agreement_enable') !=1 and !is_api()  and !isset($_COOKIE['booking_cookie_agreement_enable']))
	<div class="booking_cookie_agreement p-3 d-flex fixed-bottom">
		<div class="content-cookie">{!! clean(setting_item_with_lang('cookie_agreement_content')) !!}</div>
		<button class="btn save-cookie">{!! clean(setting_item_with_lang('cookie_agreement_button_text')) !!}</button>
	</div>
	<script>
        var save_cookie_url = '{{route('core.cookie.check')}}';
	</script>
	<script src="{{ asset('js/cookie.js?_ver='.config('app.asset_version')) }}"></script>
@endif

{!! \App\Helpers\Assets::js(true) !!}

@php \App\Helpers\ReCaptchaEngine::scripts() @endphp

@stack('js')

@stack('carousel-scripts')
<!-- mobile-menu-popup -->
<div class="modal-outer">
    <div id="mobile-menu" class="sidemenu">
        <a href="javascript:void(0)" class="closeSideMenu" onclick="closeMobileMenu()">&times;</a>
        <img height="108" width="71" src="/uploads/0000/1/2023/10/10/aflex-logo.webp" alt="Aflex">
        <div class="extra_menu">
        <ul class="main-menu menu-generated"><li class=" depth-0"><a target="" href="/blog">Blog</a></li><li class=" depth-0"><a target="" href="/impressum/">Impressum</a></li><li class=" depth-0"><a target="" href="/datenschutz/">Datenschutz</a></li></ul>
        </div>
        <div class="side-menu-icons">
            <div class="form_cta">
                <div class="ph cta_box">
                    <span class="icon"><a href="tel:00493023931002"><img style="width:23px; height:23px;"
                                src="https://aflex.de/uploads/0000/1/2023/10/09/call.png"></a></span>
                    <span class="number">Hotline<a href="tel:00493023931002">030 2393 1002</a></span>
                </div>
                <div class="em cta_box">
                    <span class="icon"><a href="mailto:info@aflex.de"><img
                                src="https://aflex.de/uploads/0000/1/2023/10/09/email.png"
                                style="width:25px; height:18px;"></a></span>
                    <span class="number">Email<a href="mailto:info@aflex.de">info@aflex.de</a></span>
                </div>
            </div>
        </div>
    </div>

  <!-- Service Mobile Menu -->
	<div id="sidemenu" class="sidemenu">
        <a href="javascript:void(0)" class="closeSideMenu" onclick="closeSideMenu()">&times;</a>
        <img height="108" width="71" src="/uploads/0000/1/2023/10/10/aflex-logo.webp" alt="Aflex">
        <?php

        ?>
		<div class="service_list">
  <ul class="serviceul">
    <li class="box">
      <div class="drop_title">
        <p class="question__text">
        <?php 
            if(get_current_lang() == 'de'){
              echo "Entrümpelung";
            }
            else{
              echo "Clearing Out";
            } 
            ?> </p>
        <i class="fa-solid fa-caret-down icon"></i>
      </div>
      <div class="drop_body">
          {!! generate_menu_by_slug('entruempelungen') !!}
      </div>
    </li>
    <li class="box">
      <div class="drop_title">
        <p class="question__text">
        <?php 
            if(get_current_lang() == 'de'){
              echo "Entsorgung";
            }
            else{
              echo "Disposal";
            } 
            ?> </p>
        <i class="fa-solid fa-caret-down icon"></i>
      </div>
      <div class="drop_body">
          {!! generate_menu_by_slug('Entsorgung') !!}
      </div>
    </li>
    <li class="box">
      <div class="drop_title">
        <p class="question__text">
        <?php 
            if(get_current_lang() == 'de'){
              echo "Umzüge";
            }
            else{
              echo "Movers";
            } 
            ?>   
        </p>
        <i class="fa-solid fa-caret-down icon"></i>
      </div>
      <div class="drop_body">
          {!! generate_menu_by_slug('umzug') !!}
      </div>
    </li>
    <li class="box">
      <div class="drop_title">
        <p class="question__text">
        <?php 
            if(get_current_lang() == 'de'){
              echo "Maler";
            }
            else{
              echo "Painting";
            } 
            ?> 
        </p>
        <i class="fa-solid fa-caret-down icon"></i>
      </div>
      <div class="drop_body">
          {!! generate_menu_by_slug('Maler') !!}
      </div>
    </li>
    <li class="box">
      <div class="drop_title">
        <p class="question__text">
        <?php 
            if(get_current_lang() == 'de'){
              echo "Unternehmen";
            }
            else{
              echo "Organization";
            } 
            ?> 
        </p>
        <i class="fa-solid fa-caret-down icon"></i>
      </div>
      <div class="drop_body">
          {!! generate_menu_by_slug('Unternehmen') !!}
      </div>
    </li>
  </ul>

    </div>
        <div class="side-menu-icons">
            <div class="form_cta">
                <div class="ph cta_box">
                    <span class="icon"><a href="tel:00493023931002"><img style="width:23px; height:23px;"
                                src="https://aflex.de/uploads/0000/1/2023/10/09/call.png"></a></span>
                    <span class="number">Hotline<a href="tel:00493023931002">030 2393 1002</a></span>
                </div>
                <div class="em cta_box">
                    <span class="icon"><a href="mailto:info@aflex.de"><img
                                src="https://aflex.de/uploads/0000/1/2023/10/09/email.png"
                                style="width:25px; height:18px;"></a></span>
                    <span class="number">Email<a href="mailto:info@aflex.de">info@aflex.de</a></span>
                </div>
            </div>
        </div>
    </div>
    <div id="mobile-anfrage" class="sidemenu">
        <a href="javascript:void(0)" class="closeSideMenu" onclick="closeMobileAnfrage()">&times;</a>
            <div class="title">Online Anfrage </div>
        {!! generate_menu_by_slug('Forms') !!}
    </div>
</div>

<!-- Mobile Footer -->
<div class="mobile_footer">
	<div class="col">
		<a href="/">
			<span class="img"><img src="/uploads/0000/1/2023/10/19/home.png" alt="Startseite" width="25" height="25"></span>
			<span class="text">
      <?php 
      if(get_current_lang() == 'de'){
        echo "Startseite";
      }
      else{
        echo "Home";
      } 
      ?>
      </span>
		</a>
	</div>
	<div class="col">
	<a href="#" onclick="openSideMenu();">
		<span class="img"><img src="/uploads/0000/1/2023/10/19/box.png" alt="Leistungen" width="25" height="25"></span>
		<span class="text">
    <?php 
      if(get_current_lang() == 'de'){
        echo "Leistungen";
      }
      else{
        echo "Services";
      } 
      ?>  
    </span>
	</a>
	</div>
	<div class="col">
	<a href="#" onclick="openMobileAnfrage();">
		<span class="img"><img src="/uploads/0000/1/2023/10/19/form.png" alt="Anfrage" width="25" height="25"></span>
	</a>
	</div>
	<div class="col">
	<a href="tel:00493023931002">
		<span class="img"><img src="/uploads/0000/1/2023/10/19/aflex-call.png" alt="Aflex Anruf" width="25" height="25"></span>
		<span class="text">
    <?php 
      if(get_current_lang() == 'de'){
        echo "Anruf";
      }
      else{
        echo "Call";
      } 
      ?>
    </span>
	</a>
	</div>
	<div class="col">
	<a href="#" onclick="openMobileMenu();">
		<span class="img"><img src="/uploads/0000/1/2023/10/19/categories.png" alt="Menu" width="25" height="25"></span>
		<span class="text">
    <?php 
      if(get_current_lang() == 'de'){
        echo "Menü";
      }
      else{
        echo "Menu";
      } 
      ?>  
    </span>
	</a>
	</div>
</div>

<!-- Scroll To Top Button -->
<span><a href="#" class="topbutton"><div class="back-top-icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path clip-rule="evenodd" d="m466.789 512v-143.559l-210.789-154.306-210.789 154.306v143.559l210.789-154.306zm0-214.135-210.789-154.306-210.789 154.306v-143.559l210.789-154.306 210.789 154.306z" fill-rule="evenodd" fill="#ffffff" data-original="#000000" class=""></path></g></svg></div></a></span>

<!-- ======= FLOATING BTNS ====== -->
<div class="float-container-btns" style="display: none">
<a onclick="opencallb();" href="#" class="icons-btns one" data-bs-toggle="modal" data-bs-target="#ruckruf"><img width="60" height="60" class="lazyload" data-src="/uploads/0000/1/2023/11/18/call-back.png"> <?php 
  if(get_current_lang() == 'de'){
    echo "Anruf";
  }
   else{
    echo "Request Callback";
  } 
  ?></a>
<a href="https://wa.me/4917623878600" rel="noopener noreferrer" target="_blank" class="icons-btns two"><img width="60" height="60" class="lazyload" data-src="/uploads/0000/1/2023/11/18/whatsapp.png"> 0176 2387 8600</a>
<a href="mailto:info@aflex.de" rel="noopener noreferrer" target="_blank" class="icons-btns three"><img width="60" height="60" class="lazyload" data-src="/uploads/0000/1/2024/01/20/mail.png"> <?php 
if(get_current_lang() == 'de'){
  echo "info@aflex.de";
}
 else{
  echo "info@aflex.de";
}  ?></a>
</div>

<div class="callb fade" id="ruckruf" tabindex="-1" aria-bs-labelledby="callback" aria-hidden="true" style="display: none">
  <div class="callb-dialog  callb-dialog-centered">
    <div class="callb-content">
      <div class="callb-header">
        <button onclick="closeCallb()" type="button" class="close ruckruf-close" data-bs-dismiss="callb" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="callb-body">
      <x-popup-contact-form></x-popup-contact-form>
      </div>
    </div>
  </div>
</div>


<!-- ======== FLOATING BTNS ENDS ======= -->
<div class="ba-we-love-subscribers-wrap">
	<div class="ba-we-love-subscribers popup-ani">
		<header>
			<h6>Aflex-Hotline</h6>
		</header>
		<p class="cta-float"><?php 
    
        echo "Rufen Sie jetzt an. Wir freuen uns auf Sie.";

      ?></p>
		<div class="phone-number"><a href="tel:00493023931002"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="15" height="15" x="0" y="0" viewBox="0 0 322 322" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M275.445 135.123c.387-45.398-38.279-87.016-86.192-92.771-.953-.113-1.991-.285-3.09-.467-2.372-.393-4.825-.797-7.3-.797-9.82 0-12.445 6.898-13.136 11.012-.672 4-.031 7.359 1.902 9.988 3.252 4.422 8.974 5.207 13.57 5.836 1.347.186 2.618.359 3.682.598 43.048 9.619 57.543 24.742 64.627 67.424.173 1.043.251 2.328.334 3.691.309 5.102.953 15.717 12.365 15.717h.001c.95 0 1.971-.082 3.034-.244 10.627-1.615 10.294-11.318 10.134-15.98-.045-1.313-.088-2.555.023-3.381.03-.208.045-.417.046-.626z" fill="#2C486B" data-original="#000000" class=""></path><path d="M176.077 25.688c1.275.092 2.482.18 3.487.334 70.689 10.871 103.198 44.363 112.207 115.605.153 1.211.177 2.688.202 4.252.09 5.566.275 17.145 12.71 17.385l.386.004c3.9 0 7.002-1.176 9.221-3.498 3.871-4.049 3.601-10.064 3.383-14.898-.053-1.186-.104-2.303-.091-3.281.899-72.862-62.171-138.933-134.968-141.39-.302-.01-.59.006-.881.047a6.09 6.09 0 0 1-.862.047c-.726 0-1.619-.063-2.566-.127C177.16.09 175.862 0 174.546 0c-11.593 0-13.797 8.24-14.079 13.152-.65 11.352 10.332 12.151 15.61 12.536zM288.36 233.703a224.924 224.924 0 0 1-4.512-3.508c-7.718-6.211-15.929-11.936-23.87-17.473a1800.92 1800.92 0 0 1-4.938-3.449c-10.172-7.145-19.317-10.617-27.957-10.617-11.637 0-21.783 6.43-30.157 19.109-3.71 5.621-8.211 8.354-13.758 8.354-3.28 0-7.007-.936-11.076-2.783-32.833-14.889-56.278-37.717-69.685-67.85-6.481-14.564-4.38-24.084 7.026-31.832 6.477-4.396 18.533-12.58 17.679-28.252-.967-17.797-40.235-71.346-56.78-77.428-7.005-2.576-14.365-2.6-21.915-.06-19.02 6.394-32.669 17.623-39.475 32.471-6.577 14.347-6.28 31.193.859 48.717 20.638 50.666 49.654 94.84 86.245 131.293 35.816 35.684 79.837 64.914 130.839 86.875 4.597 1.978 9.419 3.057 12.94 3.844 1.2.27 2.236.5 2.991.707.415.113.843.174 1.272.178l.403.002h.002c23.988 0 52.791-21.92 61.637-46.91 7.75-21.882-6.4-32.698-17.77-41.388zM186.687 83.564c-4.107.104-12.654.316-15.653 9.021-1.403 4.068-1.235 7.6.5 10.498 2.546 4.252 7.424 5.555 11.861 6.27 16.091 2.582 24.355 11.48 26.008 28 .768 7.703 5.955 13.082 12.615 13.082h.001c.492 0 .995-.029 1.496-.09 8.01-.953 11.893-6.838 11.542-17.49.128-11.117-5.69-23.738-15.585-33.791-9.929-10.084-21.898-15.763-32.785-15.5z" fill="#2C486B" data-original="#000000" class=""></path></g></svg> 030 2393 1002</a></div>
	</div>
	<div class="ba-we-love-subscribers-fab">
		<div class="wrap">
			<div class="img-call"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="22" height="22" x="0" y="0" viewBox="0 0 322 322" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M275.445 135.123c.387-45.398-38.279-87.016-86.192-92.771-.953-.113-1.991-.285-3.09-.467-2.372-.393-4.825-.797-7.3-.797-9.82 0-12.445 6.898-13.136 11.012-.672 4-.031 7.359 1.902 9.988 3.252 4.422 8.974 5.207 13.57 5.836 1.347.186 2.618.359 3.682.598 43.048 9.619 57.543 24.742 64.627 67.424.173 1.043.251 2.328.334 3.691.309 5.102.953 15.717 12.365 15.717h.001c.95 0 1.971-.082 3.034-.244 10.627-1.615 10.294-11.318 10.134-15.98-.045-1.313-.088-2.555.023-3.381.03-.208.045-.417.046-.626z" fill="#ffffff" data-original="#000000" class=""></path><path d="M176.077 25.688c1.275.092 2.482.18 3.487.334 70.689 10.871 103.198 44.363 112.207 115.605.153 1.211.177 2.688.202 4.252.09 5.566.275 17.145 12.71 17.385l.386.004c3.9 0 7.002-1.176 9.221-3.498 3.871-4.049 3.601-10.064 3.383-14.898-.053-1.186-.104-2.303-.091-3.281.899-72.862-62.171-138.933-134.968-141.39-.302-.01-.59.006-.881.047a6.09 6.09 0 0 1-.862.047c-.726 0-1.619-.063-2.566-.127C177.16.09 175.862 0 174.546 0c-11.593 0-13.797 8.24-14.079 13.152-.65 11.352 10.332 12.151 15.61 12.536zM288.36 233.703a224.924 224.924 0 0 1-4.512-3.508c-7.718-6.211-15.929-11.936-23.87-17.473a1800.92 1800.92 0 0 1-4.938-3.449c-10.172-7.145-19.317-10.617-27.957-10.617-11.637 0-21.783 6.43-30.157 19.109-3.71 5.621-8.211 8.354-13.758 8.354-3.28 0-7.007-.936-11.076-2.783-32.833-14.889-56.278-37.717-69.685-67.85-6.481-14.564-4.38-24.084 7.026-31.832 6.477-4.396 18.533-12.58 17.679-28.252-.967-17.797-40.235-71.346-56.78-77.428-7.005-2.576-14.365-2.6-21.915-.06-19.02 6.394-32.669 17.623-39.475 32.471-6.577 14.347-6.28 31.193.859 48.717 20.638 50.666 49.654 94.84 86.245 131.293 35.816 35.684 79.837 64.914 130.839 86.875 4.597 1.978 9.419 3.057 12.94 3.844 1.2.27 2.236.5 2.991.707.415.113.843.174 1.272.178l.403.002h.002c23.988 0 52.791-21.92 61.637-46.91 7.75-21.882-6.4-32.698-17.77-41.388zM186.687 83.564c-4.107.104-12.654.316-15.653 9.021-1.403 4.068-1.235 7.6.5 10.498 2.546 4.252 7.424 5.555 11.861 6.27 16.091 2.582 24.355 11.48 26.008 28 .768 7.703 5.955 13.082 12.615 13.082h.001c.492 0 .995-.029 1.496-.09 8.01-.953 11.893-6.838 11.542-17.49.128-11.117-5.69-23.738-15.585-33.791-9.929-10.084-21.898-15.763-32.785-15.5z" fill="#ffffff" data-original="#000000" class=""></path></g></svg></div>
		</div>
	</div>
</div>

<script>
// call back from
function opencallb() {
  document.querySelector("#ruckruf").style.display = "block";
  document.querySelector("body").style.height = "100vh";
  document.querySelector("body").style.overflowY = "hidden";
}
function closeCallb() {
  document.querySelector("#ruckruf").style.display = "none";
  document.querySelector("body").style.height = "auto";
  document.querySelector("body").style.overflowY = "visible";
  
}

// mobile-menu
function openMobileMenu() {
  if(window.screen.width>768){
    document.getElementById("mobile-menu").style.width = "400px";
  }else{
    document.getElementById("mobile-menu").style.width = "100vw";
  }
  document.querySelector(".modal-outer").style.width = "100vw";
  document.querySelector("body").style.height = "100vh";
  document.querySelector("body").style.overflowY = "hidden";
}

function closeMobileMenu() {
  document.getElementById("mobile-menu").style.width = "0";
  document.querySelector(".modal-outer").style.width = "0";
  document.querySelector("body").style.height = "auto";
  document.querySelector("body").style.overflowY = "visible";
  
}

// desk top side menu
function openSideMenu() {
  if(window.screen.width>768){
    document.getElementById("sidemenu").style.width = "400px";
  }else{
    document.getElementById("sidemenu").style.width = "100vw";
  }
  document.querySelector(".modal-outer").style.width = "100vw";
  document.querySelector("body").style.height = "100vh";
  document.querySelector("body").style.overflowY = "hidden";  
}

function closeSideMenu() {
  document.getElementById("sidemenu").style.width = "0";
  document.querySelector(".modal-outer").style.width = "0";
  document.querySelector("body").style.height = "auto";
  document.querySelector("body").style.overflowY = "visible";
}

// mobile-anfrage
function openMobileAnfrage() {
  if(window.screen.width>768){
    document.getElementById("mobile-anfrage").style.height = "320px";
  }else{
    document.getElementById("mobile-anfrage").style.height = "320px";
  }
  document.querySelector(".modal-outer").style.height = "100vh";
  document.querySelector("body").style.height = "100vh";
  document.querySelector("body").style.overflowY = "hidden";
}

function closeMobileAnfrage() {
  document.getElementById("mobile-anfrage").style.height = "0";
  document.querySelector(".modal-outer").style.height = "0";
  document.querySelector("body").style.height = "auto";
  document.querySelector("body").style.overflowY = "visible";
}

function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  } 
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
var defaultOpen = document.getElementById("defaultOpen");
if (defaultOpen != null) {
  defaultOpen.click();
}

jQuery(document).ready(function($){
 var offset = 500;
 var speed = 250;
 var duration = 500;
 $(window).scroll(function(){
if (jQuery(this).scrollTop() < offset) {
		 $('.topbutton, .float-container-btns').fadeOut(duration);
 			} else {
 		$('.topbutton, .float-container-btns').fadeIn(duration);
 		}
 });
 jQuery('.topbutton').on('click', function(){
	jQuery('html, body').animate({scrollTop:0}, speed);
 		return false;
  	});
 });

 const questions = document.querySelectorAll(".drop_title");

questions.forEach((element) => {
  element.addEventListener("click", () => {
    const nextBox = element.nextElementSibling;
    const icons = element.querySelector(".icon");

    icons.style.transition = "0.5s linear";

    if (nextBox.classList.contains("active")) {
      nextBox.classList.remove("active");
      icons.style.transform = "rotate(0deg)";
    } else {
      document
        .querySelectorAll(".drop_body.active")
        .forEach((nextBox) => nextBox.classList.remove("active"));
      document
        .querySelectorAll(".icon")
        .forEach((normal) => (normal.style.transform = "rotate(0deg)"));

      icons.style.transform = "rotate(180deg)";
      nextBox.classList.add("active");
    }
  });
});

// ==== CALL FLOATING BTNS ======
jQuery(document).ready(function($){
jQuery(".ba-we-love-subscribers-fab").click(function() {
  jQuery('.ba-we-love-subscribers-fab .wrap').toggleClass("ani");
  jQuery('.ba-we-love-subscribers').toggleClass("open");
  jQuery('.img-call').toggleClass("close");
});
});

$(document).ready(function(){
						   
               //----------Select the first tab and div by default
               
               $('#vertical_tab_nav > ul > li > a').eq(0).addClass( "selected" );
               $('#vertical_tab_nav > div > .tab_content').eq(0).css('display','block');
           
           
               //---------- This assigns an onclick event to each tab link("a" tag) and passes a parameter to the showHideTab() function
                       
                   $('#vertical_tab_nav > ul').click(function(e){
                       
                 if($(e.target).is("a")){
                 
                   /*Handle Tab Nav*/
                   $('#vertical_tab_nav > ul > li > a').removeClass( "selected");
                   $(e.target).addClass( "selected");
                   
                   /*Handles Tab Content*/
                   var clicked_index = $("a",this).index(e.target);
                   $('#vertical_tab_nav > div > .tab_content').css('display','none');
                   $('#vertical_tab_nav > div > .tab_content').eq(clicked_index).fadeIn();
                   
                 }
                 
                   $(this).blur();
                   return false;
                 
                   });

                                              //----------Select the first tab and div by default
                           
                           $('#vertical_tab_nav2 > ul > li > a').eq(0).addClass( "selected" );
                           $('#vertical_tab_nav2 > div > .tab_content').eq(0).css('display','block');
                       
                       
                           //---------- This assigns an onclick event to each tab link("a" tag) and passes a parameter to the showHideTab() function
                                   
                               $('#vertical_tab_nav2 > ul').click(function(e){
                                   
                             if($(e.target).is("a")){
                             
                               /*Handle Tab Nav*/
                               $('#vertical_tab_nav2 > ul > li > a').removeClass( "selected");
                               $(e.target).addClass( "selected");
                               
                               /*Handles Tab Content*/
                               var clicked_index = $("a",this).index(e.target);
                               $('#vertical_tab_nav2 > div > .tab_content').css('display','none');
                               $('#vertical_tab_nav2 > div > .tab_content').eq(clicked_index).fadeIn();
                               
                             }
                             
                               $(this).blur();
                               return false;
                             
                               });

                                                                             //----------Select the first tab and div by default
                           
                           $('#vertical_tab_nav3 > ul > li > a').eq(0).addClass( "selected" );
                           $('#vertical_tab_nav3 > div > .tab_content').eq(0).css('display','block');
                       
                       
                           //---------- This assigns an onclick event to each tab link("a" tag) and passes a parameter to the showHideTab() function
                                   
                               $('#vertical_tab_nav3 > ul').click(function(e){
                                   
                             if($(e.target).is("a")){
                             
                               /*Handle Tab Nav*/
                               $('#vertical_tab_nav3 > ul > li > a').removeClass( "selected");
                               $(e.target).addClass( "selected");
                               
                               /*Handles Tab Content*/
                               var clicked_index = $("a",this).index(e.target);
                               $('#vertical_tab_nav3 > div > .tab_content').css('display','none');
                               $('#vertical_tab_nav3 > div > .tab_content').eq(clicked_index).fadeIn();
                               
                             }
                             
                               $(this).blur();
                               return false;
                             
                               });

                                                                             //----------Select the first tab and div by default
                           
                           $('#vertical_tab_nav4 > ul > li > a').eq(0).addClass( "selected" );
                           $('#vertical_tab_nav4 > div > .tab_content').eq(0).css('display','block');
                       
                       
                           //---------- This assigns an onclick event to each tab link("a" tag) and passes a parameter to the showHideTab() function
                                   
                               $('#vertical_tab_nav4 > ul').click(function(e){
                                   
                             if($(e.target).is("a")){
                             
                               /*Handle Tab Nav*/
                               $('#vertical_tab_nav4 > ul > li > a').removeClass( "selected");
                               $(e.target).addClass( "selected");
                               
                               /*Handles Tab Content*/
                               var clicked_index = $("a",this).index(e.target);
                               $('#vertical_tab_nav4 > div > .tab_content').css('display','none');
                               $('#vertical_tab_nav4 > div > .tab_content').eq(clicked_index).fadeIn();
                               
                             }
                             
                               $(this).blur();
                               return false;
                             
                               });
                               
                            
                   
                
           });//end ready	

           
</script>