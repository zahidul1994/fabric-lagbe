@extends('frontend.layouts.master')
@section('title','Contact Us')
@section('content')
<style>
    .map-container {
    border: 1px solid #333;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 20px;
}

.map-label {
    display: block;
    font-weight: bold;
    margin-bottom: 10px;
}

.map-container iframe {
    border: none;
    width: 100%;
    height: 450px;
}


    </style>

    <!--==================== Contact Section Start ====================-->
    <div class="full-row">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <h3 class="down-line mb-5">@lang('website.Send Message')</h3>
                    <div class="form-simple mb-5">
                        <form id="contact-form" action="{{route('contact.store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>@lang('website.Full Name'):</label>
                                        <input type="text" class="form-control bg-gray" name="name" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>@lang('website.Your Phone'): (@lang('website.Optional'))</label>
                                        <input type="tel" class="form-control bg-gray" name="phone">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label>@lang('website.Your Email'):</label>
                                        <input type="email" class="form-control bg-gray" name="email" required="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label>@lang('website.Subject'):</label>
                                        <input type="text" class="form-control bg-gray" name="subject" required="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label>@lang('website.Message'):</label>
                                        <textarea class="form-control bg-gray" name="message" rows="8" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary" name="submit" type="submit" disabled>@lang('website.Send Message')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5">
                    <h3 class="down-line mb-5">@lang('website.Contact Us')</h3>
                    <div class="d-flex mb-3">
                        <ul>
                            <li class="mb-3">
                                <strong>@lang('website.Office Address') :</strong><br> House #298 (5th Floor) ,Jamtola moor ,Shahdhonota Shoroni ,North Badda ,Dhaka-1212
                            </li>
                            <li class="mb-3">
                                <strong>@lang('website.Contact Number') :</strong><br> {{getNumberToBangla('09678')}}-{{getNumberToBangla('236236')}}
                            </li>
                            <li class="mb-3">
                                <strong>@lang('Madhobdi Branch office') :</strong><br> House: 85 (Old)
                                Word No: 1
                                Choto Madhabdi Residential area. 
                                Madhabdi, Narshindi
                            </li>
                            <li class="mb-3">
                                <strong>@lang('website.Contact Number') :</strong><br> {{getNumberToBangla('01958')}}-{{getNumberToBangla('651466')}}
                            </li>
                            <li class="mb-3">
                                <strong>Email Address :</strong><br> support@fabriclagbe.com,<br>
                               
                            </li>
                        </ul>
                    </div>
{{--                    <h4 class="mb-2">Career Info</h4>--}}
{{--                    <p>If you’re interested in employment opportunities at Unicoder, please email us:<br> <a href="#">support@unicoderbd.com</a></p>--}}
                </div>
            </div>
        </div>
    </div>
    <!--==================== Contact Section End ====================-->

<!--==================== Map Section Start ====================-->
<div class="full-row p-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="map-container">
                    <span class="map-label">Corporate Office Address</span>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4341.868046138035!2d90.42166477958361!3d23.78083223425712!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c79be3855555%3A0xf7941299777171f0!2sFabric%20Lagbe!5e0!3m2!1sen!2sbd!4v1644664921578!5m2!1sen!2sbd" width="100%" height="450" class="border-1" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
            <div class="col-md-6">
                <div class="map-container">
                    <span class="map-label">Madhobdi Office Address</span>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1290.15129573996!2d90.67349666342794!3d23.850620882347194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3754356d06af1e3b%3A0xee184aa5b9645ac0!2z4Kas4KeN4Kav4Ka-4KaC4KaVIOCmquCmn-CnjeCmn-Cmvywg4Kau4Ka-4Kan4Kas4Kam4KeAfHwgQmFuayBQb3R0aSwgTWFkaGFiZGku!5e0!3m2!1sen!2sbd!4v1696656328543!5m2!1sen!2sbd" width="100%" height="450" style="border:1" allowfullscreen="" loading="lazy" ></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!--==================== Map Section End ====================-->


@endsection
@push('js')

@endpush
