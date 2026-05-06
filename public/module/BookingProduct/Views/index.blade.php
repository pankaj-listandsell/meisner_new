@extends('layouts.app')
@push('css')
	<style type="text/css">
		.bravo-contact-block .section{
			padding: 80px 0 !important;
		}
	</style>
@endpush
@section('content')
<div id="bravo_content-wrapper">
	<div class="bravo-contact-block">
		<div class="container-fluid contact-banner-wrapper" @if($bg = get_file_url(setting_item("page_contact_image"),"full")) style="background-image: linear-gradient(0deg,rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)),url('{{$bg}}') !important"  @endif>
			<div class="row section">

				<div class="info col-lg-12">
					<a href="{{url(app_get_locale(false,'/'))}}" class="bravo-logo">
						@php
							$logo_id = setting_item("logo_id");
                            if(!empty($row->custom_logo)){
                                $logo_id = $row->custom_logo;
                            }
						@endphp
						@if($logo_id)
								<?php $logo = get_file_url($logo_id,'full') ?>
							<img src="{{$logo}}" alt="{{setting_item("site_title")}}">
						@endif
					</a>
					<div class="desc">{!! setting_item_with_lang("page_contact_desc") !!}</div>
					<div class="btn-group">
						<a href="#googlemap" class="btn-primary">{{__('Map')}}</a>
						<a href="#contactform" class="btn-secondary">{{__('Contact')}}</a>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			@include("Booking::frontend.blocks.contact.index")
		</div>

		<div id="googlemap" class="container-fluid no-padding">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7902.390551106202!2d98.309381!3d7.978758!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30503758b3805131%3A0xf7175309031bb3c8!2sGreen%20Elephant%20Sanctuary%20Park!5e0!3m2!1sen!2sch!4v1663671917425!5m2!1sen!2sch" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>

	</div>
</div>
@endsection
