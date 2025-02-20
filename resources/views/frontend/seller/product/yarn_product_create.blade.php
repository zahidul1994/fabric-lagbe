@extends('frontend.layouts.master')
@section("title","Yarn Product Entry")
@push('css')
    {{--    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.min.css')}}">--}}
    <style>
        .required{
            color: red;
        }
    </style>

@endpush
@section('content')
    <!-- Main content -->
    <div class="full-row" style="margin-top: -30px;">
        <div class="container">
            <div class="row">
                @include('frontend.seller.seller_breadcrumb')
                @include('frontend.seller.seller_sidebar')
                <div class="col-lg-9">
                    <form class="woocommerce-form-login" action="{{route('seller.yarn-product.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-5">
                                        <h3 class="card-title float-left">
                                            {{-- @lang('website.Sizing Product Entry') --}}
                                            Yarn Product Entry
                                    </div>
                                    <div style="float: left;width: 15%;">
                                        <input type="radio" name="payment_with" value="BDT" id="bdt" class="CurrencyChange" onchange="currency_changed(this)" @if(currency()->code == 'BDT') checked @endif>
                                        <label for="bdt">@lang('website.BDT')</label>
                                    </div>

                                    <div style="float: right;width: 15%;">
                                        <input type="radio" name="payment_with" value="USD" id="usd" class="CurrencyChange" onchange="currency_changed(this)" @if(currency()->code == 'USD') checked @endif>
                                        <label for="usd">@lang('website.USD')</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                          
                                <div class="row m-2">
                                    <div class="col-md-12">
                                        <h4 class="pl-2 pb-0 mb-2 bg-info"><span style="margin-left: 10px !important;">@lang('website.Product Information') <span class="required">*</span></span></h4>
                                        <div class="row">
                                        <div class="form-group col-md-12" >
                                                <label for="name">Product Type <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="@lang('website.Enter Product Type')"  required>
                                                
                                            </div>
                                            
                                            <br><br><br><hr>
                                            <h1 class="class col-md-12">Cotton Yarn</h1>
                                            <div class="form-group col-md-4" >
                                                <label >Cotton Type <span>*</span></label>
                                                <select name="cotton_type" id="cotton_type" class="form-control ">
                                                    <option value="weaving">Weaving/Woven</option>
                                                    <option value="knit">Knit/Hosiery</option>
                                                    <option value="sweater">Sweater</option>
                                                </select>
                                               
                                                
                                            </div>
                                            <div class="form-group col-md-4" >
                                                <label for="cotton_count">Cotton yarn Count <span>*</span></label>
                                                <input type="number" class="form-control" name="cotton_count" id="cotton_count" placeholder='Enter Count'>
                                            </div>
                                            <div class="form-group col-md-4" >
                                            <label for="cotton_used_for">Used For<span>*</span></label>
                                                <select name="cotton_used_for" id="cotton_used_for" class="form-control ">
                                                    <option value="warp">Warp</option>
                                                    <option value="weft">Weft</option> 
                                                </select> 
                                            </div>

                                            <div class="form-group col-md-4" >
                                            <label for="cotton_quality_type">Quality Type<span>*</span></label>
                                                <select name="cotton_quality_type" id="cotton_quality_type" class="form-control ">
                                                <option value="Combed">Combed</option>
                                                <option value="Carded">Carded</option>
                                                <option value="Virgin">Virgin</option>
                                                <option value="Giza">Giza</option>
                                                <option value="Combed Compact">Combed Compact</option>
                                                <option value="Carded Compact">Carded Compact</option>
                                                </select> 
                                            </div>

                                            <div class="form-group col-md-4" >
                                            <label for="cotton_ring_type">Ring Type<span>*</span></label>
                                                <select name="cotton_ring_type" id="cotton_ring_type" class="form-control ">
                                                <option value="Open End">Open End</option>
                                                <option value="Ring Spun">Ring Spun</option>
                                                <option value="Vortex">Vortex</option>
                                                <option value="Rofon">Rofon</option>
                                                </select> 
                                            </div>
                                            <div class="form-group col-md-4" >
                                                <label for="cotton_fiber">Cotton Yarn Type of fiber <span>*</span></label>
                                                <select name="cotton_fiber" id="cotton_fiber" class="form-control ">
                                                    <option value="Regular">Regular</option>
                                                    <option value="BCI">BCI</option>
                                                    <option value="Spandex">Spandex</option>
                                                    <option value="Dyed">Dyed</option>
                                                    <option value="Imported Cotton">Imported Cotton</option>
                                                    <option value="Organic">Organic</option>
                                                </select> 
                                            </div>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                             <hr>
                                        <h1 class="class col-md-12">Viscose Yarn</h1>
                                           <div class="form-group col-md-4" >
                                               
                                                <label for="viscose_used_for">Used For<span>*</span></label>
                                                <select name="viscose_used_for" id="viscose_used_for" class="form-control ">
                                                    <option value="warp">Warp</option>
                                                    <option value="weft">Weft</option> 
                                                </select> 
                                                
                                            </div>
                                            <div class="form-group col-md-4" >
                                                <label for="viscose_count">Viscose yarn Count <span>*</span></label>
                                                <input type="number" class="form-control " name="viscose_count" id="viscose_count" placeholder='Enter Count'>
                                            </div>
                                          

                                        

                                            <div class="form-group col-md-4" >
                                            <label for="viscose_ring_type">Ring Type<span>*</span></label>
                                                <select name="viscose_ring_type" id="viscose_ring_type" class="form-control ">
                                                <option value="Open End">Open End</option>
                                                <option value="Ring Spun">Ring Spun</option>
                                                <option value="Vortex">Vortex</option>
                                                <option value="Rofon">Rofon</option>
                                                </select> 
                                            </div>

                                            <div class="form-group col-md-4" >
                                                <label for="viscose_fiber">Viscose Yarn Type of fiber <span>*</span></label>
                                                <select name="viscose_fiber" id="viscose_fiber" class="form-control ">
                                                    <option value="Regular">Regular</option>
                                                    <option value="Spandex">Spandex</option>
                                                    <option value="Dyed">Dyed</option>
                                                  
                                                </select> 
                                            </div> 


                                          



            <!-- 0000000000000000000000000000000000000000000000000000000000000000 -->


            <h1 class="class col-md-12">Synthatic Yarn</h1>
                                           <div class="form-group col-md-4" >
                                               
                                           <label >Synthatic Type <span>*</span></label>
                                                <select name="synthatic_type" id="synthatic_type" class="form-control ">
                                                    <option value="PSF">PSF</option>
                                                    <option value="PV">PV</option>
                                                    <option value="PC">PC</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                
                                            </div>

                                            <div class="form-group col-md-4" >
                                                <label for="synthatic_count">Synthatic yarn Count <span>*</span></label>
                                                <input type="number" class="form-control " name="synthatic_count" id="synthatic_count" placeholder='Enter Count'>
                                            </div>


                                            <div class="form-group col-md-4" >
                                                <label for="synthatic_fiber">Synthatic Yarn Type of fiber <span>*</span></label>
                                                <select name="synthatic_fiber" id="synthatic_fiber" class="form-control ">
                                                    <option value="Regular">Regular</option>
                                                    <option value="Spandex">Spandex</option>
                                                    <option value="Dyed">Dyed</option>
                                                  
                                                </select> 
                                            </div> 

                                            <div class="form-group col-md-4" >
                                               
                                               <label for="synthatic_used_for">Used For<span>*</span></label>
                                               <select name="synthatic_used_for" id="synthatic_used_for" class="form-control ">
                                                   <option value="warp">Warp</option>
                                                   <option value="weft">Weft</option> 
                                               </select> 
                                               
                                           </div>

                                            <div class="form-group col-md-4" >
                                            <label for="synthatic_ring_type">Ring Type<span>*</span></label>
                                                <select name="synthatic_ring_type" id="synthatic_ring_type" class="form-control ">
                                                <option value="Open End">Open End</option>
                                                <option value="Ring Spun">Ring Spun</option>
                                                <option value="Vortex">Vortex</option>
                                            
                                                </select> 
                                            </div>


                                          
                                       

{{-- 333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333 --}}

<h1 class="class col-md-12">Fancy Yarn</h1>
                                           <div class="form-group col-md-4" >
                                               
                                           <label >Fancy Type <span>*</span></label>
                                                <select name="fancy_type" id="fancy_type" class="form-control ">
                                                    <option value="PSF">PSF</option>
                                                    <option value="PV">PV</option>
                                                    <option value="PC">PC</option>
                                                    <option value="VSF">VSF</option>
                                                    <option value="Texturised">Texturised</option>
                                                    <option value="Cotton">Cotton</option>
                                                </select>
                                                
                                            </div>

                                            <div class="form-group col-md-4" >
                                                <label for="fancy_count">Fancy yarn Count <span>*</span></label>
                                                <input type="number" class="form-control " name="fancy_count" id="fancy_count" placeholder='Enter Count'>
                                            </div>


                                            <div class="form-group col-md-4" >
                                                <label for="fancy_fiber">Fancy Yarn Type of fiber <span>*</span></label>
                                                <select name="fancy_fiber" id="fancy_fiber" class="form-control ">
                                                    <option value="Slub">Slub</option>
                                                    <option value="Model">Model</option>
                                                    <option value="Excel">Excel</option>
                                                    <option value="Tencel">Tencel</option>
                                                    <option value="Multi Colour">Multi Colour</option>
                                                  
                                                </select> 
                                            </div> 

                                            <div class="form-group col-md-4" >
                                               
                                               <label for="fancy_used_for">Used For<span>*</span></label>
                                               <select name="fancy_used_for" id="fancy_used_for" class="form-control ">
                                                   <option value="regular">Regular</option>
                                                   <option value="dyed">Dyed</option> 
                                               </select> 
                                               
                                           </div>

                                         
{{-- 4444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444--}}

<h1 class="class col-md-12">Texturised Yarn</h1>
                                           <div class="form-group col-md-4" >
                                               
                                           <label >Texturised Type <span>*</span></label>
                                                <select name="texturised_type" id="texturised_type" class="form-control ">
                                                    <option value="Bright">Bright</option>
                                                    <option value="SemiDull">SemiDull</option>
                                                    <option value="Catonic">Catonic</option>
                                                    <option value="FDY">FDY</option>
                                                    <option value="FullDull/Cotlook">FullDull/Cotlook</option>
                                                    <option value="Stretch/Lycra">Stretch/Lycra</option>
                                                    <option value="Airtex/Cooltex">Airtex/Cooltex</option>
                                                    <option value="Black Dope Dyed">Black Dope Dyed</option>
                                                </select>
                                                
                                            </div>


                                            <div class="form-group col-md-4" >
                                               
                                                <label >Texturised Quality Type <span>*</span></label>
                                                     <select name="texturised_quality_type" id="texturised_quality_type" class="form-control ">
                                                         <option value="NIM">NIM</option>
                                                         <option value="GFT">GFT</option>
                                                         <option value="LIM/SIM">LIM/SIM</option>
                                                         <option value="IM/POTO">IM/POTO</option>
                                                         <option value="HIM/ROTO">HIM/ROTO</option>
                                                    
                                                     </select>
                                                     
                                                 </div>


                                            
                                        

                                            <div class="form-group col-md-4" >
                                                <label for="texturised_count">Texturised yarn Count <span>*</span></label>
                                                <input type="number" class="form-control " name="texturised_count" id="texturised_count" placeholder='Enter Count'>
                                            </div>


                                            <div class="form-group col-md-4" >
                                                <label for="texturised_fiber">Texturised Yarn Type of fiber <span>*</span></label>
                                                <select name="texturised_fiber" id="texturised_fiber" class="form-control ">
                                                   
                                                    <option value="regular">Regular</option>
                                                    <option value="dyed">Dyed</option> 
                                                  
                                                </select> 
                                            </div> 

                                            <div class="form-group col-md-4" >
                                               
                                               <label for="texturised_used_for">Used For<span>*</span></label>
                                               <select name="texturised_used_for" id="texturised_used_for" class="form-control ">
                                                <option value="1st ">1st </option>
                                                <option value="PQ">PQ</option>
                                                <option value="CLQ">CLQ</option>
                                                <option value="STD">STD</option>
                                                
                                               </select> 
                                               
                                           </div>


                                           {{-- 555555555555555555555555555555555555555555555555555555555555555555555555 --}}

                                           <h1 class="class col-md-12">Polyester Yarn</h1>
                                           <div class="form-group col-md-4" >
                                               <label >Polyester Type <span>*</span></label>
                                               <select name="polyester_type" id="polyester_type" class="form-control ">
                                                   <option value="weaving">Weaving/Woven</option>
                                                   <option value="knit">Knit/Hosiery</option>
                                                   <option value="sweater">Sweater</option>
                                               </select>
                                              
                                               
                                           </div>
                                           <div class="form-group col-md-4" >
                                               <label for="polyester_count">Polyester yarn Count <span>*</span></label>
                                               <input type="number" class="form-control" name="polyester_count" id="polyester_count" placeholder='Enter Count'>
                                           </div>
                                         

                                           <div class="form-group col-md-4" >
                                           <label for="polyester_quality_type">Quality Type<span>*</span></label>
                                               <select name="polyester_quality_type" id="polyester_quality_type" class="form-control ">
                                               <option value="Combed">Combed</option>
                                               <option value="Carded">Carded</option>
                                               <option value="Virgin">Virgin</option>
                                               <option value="Giza">Giza</option>
                                               <option value="Combed Compact">Combed Compact</option>
                                               <option value="Carded Compact">Carded Compact</option>
                                               </select> 
                                           </div>

                                           <div class="form-group col-md-4" >
                                           <label for="polyester_ring_type">Ring Type<span>*</span></label>
                                               <select name="polyester_ring_type" id="polyester_ring_type" class="form-control ">
                                               <option value="Open End">Open End</option>
                                               <option value="Ring Spun">Ring Spun</option>
                                               <option value="Vortex">Vortex</option>
                                               
                                               </select> 
                                           </div>
                                           <div class="form-group col-md-4" >
                                               <label for="polyester_fiber">Polyester Yarn Type of fiber <span>*</span></label>
                                               <select name="polyester_fiber" id="polyester_fiber" class="form-control ">
                                                   <option value="Regular">Regular</option>
                                                   <option value="BCI">BCI</option>
                                                   <option value="Spandex">Spandex</option>
                                                   <option value="Dyed">Dyed</option>
                                                   <option value="Imported Cotton">Imported Cotton</option>
                                                   <option value="Organic">Organic</option>
                                               </select> 
                                           </div>
                                            
                                            

                                      
                                           
                                            <br>
                                              <b><hr></b>


                                            <div class="form-group col-md-6">
                                                <label for="made_in">@lang('website.Made In')</label>
                                                <select name="made_in" id="made_in" class="form-control demo-select2" required>
                                                    <option >@lang('website.Select')</option>
                                                    @foreach(\App\Model\Countries::all() as $country_of_origin)
                                                        <option value="{{$country_of_origin->country_name}}">{{$country_of_origin->country_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="price_validity">@lang('website.Price Validate Till')</label>
                                                <input type="date" class="form-control" name="price_validity" id="price_validity"  style="background-color: #f3f3f3">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-8" style="padding-top: 20px;">
                                        <!-- general form elements -->
                                        <h4 class="pl-2 pb-0 mb-2 bg-info"><span style="margin-left: 10px !important;">@lang('website.Product Image') <span class="required">*</span></span></h4>
                                        <div class="form-group row">
                                            <label class="control-label ml-3 col-12">@lang('website.Gallery Images') <span class="required">*</span> <small class="text-danger">(Size: 290 * 300px)</small></label>
                                            <div class="ml-3 mr-3 col-md-9">
                                                <div class="row" id="photos"></div>
                                                <div class="row" id="photos_alt"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="https://tinypng.com/" target="_blank" class="btn btn-primary" style="padding: 0 15px;"><i class="fa fa-edit"></i></a> @lang('website.Resize')
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="padding-top: 20px;">
                                        <h4 class="pl-2 pb-0 mb-2 bg-info"><span
                                             style="margin-left: 10px !important;">@lang('Product Video') <span
                                                 class="required">*</span></span></h4>
                                         <div class="col-md-6 form-group">
                                            <label>Select Video:</label>
                                            <input type="file" name="video" class="form-control"/>
                                         </div>
                                        
                                        </div>
                                        <!-- general form elements -->
                                                        <!-- price -->
                                           <h4 class="pl-2 pb-0 mb-2 bg-info"><span
                                                style="margin-left: 10px !important;">@lang('website.Product Price Details') <span
                                                    class="required">*</span></span></h4>
                                        <div class="form-group">
                                            <label for="quantity">@lang('website.Quantity') <span
                                                    class="required">*</span></label>
                                            <input type="number" class="form-control price_summation" name="quantity"
                                                id="quantity" min="1" value=""
                                                placeholder="@lang('website.Quantity must be greater than 0')" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="unit_id">@lang('website.Unit') <span
                                                    class="required">*</span></label>
                                            <select name="unit_id" id="unit_id" class="form-control demo-select2"
                                                required>
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}">{{ getNameByBnEn($unit) }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="currency_id">@lang('website.Currency (Active)')</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ currency()->code == 'BDT' ? 'BDT(৳)' : 'USD($)' }}"
                                                        style="background-color: #f3f3f3" required="" readonly>
                                                    <input type="hidden" name="currency_id" id="currency_id"
                                                        class="form-control" value="{{ currency()->id }}"
                                                        style="background-color: #f3f3f3" required="">

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="unit_price">@lang('website.Unit Price') <span
                                                            class="required">*</span></label>
                                                    <input type="number" value="" step="0.00001" placeholder="0"
                                                        name="unit_price" id="unit_price"
                                                        class="form-control price_summation"
                                                        style="border: 1px solid #dddddd" onkeyup="get_bid_price(this)"
                                                        required="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="unit_price">VAT/LAC <span
                                                            class="required">*</span></label>
                                                    <input type="number" value="" step="0.00001" placeholder="0"
                                                        name="vat" id="vat"
                                                        class="form-control"
                                                        style="border: 1px solid #dddddd" onkeyup="get_vat_price(this)">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="expected_price">@lang('website.Total Price')<span
                                                            class="required">*</span></label>
                                                    <input type="number" value="" step="0.00001"
                                                        name="expected_price" class="form-control" id="expected_price"
                                                        style="background-color: #f3f3f3" required readonly>
                                                </div>
                                            </div>
                                            <br><br><br>
                                           <!-- price -->

                                        <h4 class="pl-2 pb-0 mb-2 bg-info"><span style="margin-left: 10px !important;">@lang('website.Product Price Details') <span class="required">*</span></span></h4>
                                        <div class="form-group">
                                            <label for="description">@lang('website.Product Description') <span class="required">*</span></label>
                                            <textarea name="description" id="description"  class="form-control" style="background-color: #f3f3f3"></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="woocommerce-form-login__submit btn btn-primary rounded-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Submit</button>
                        <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center" id="staticBackdropLabel">@lang('website.Are you sure?')</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div >
                                            <div style="font-size: 16px">
                                                <p>
                                                    1. আমি {{Auth::user()->name}}, ভালোাবে জেনে, বুে, দেখে উপরেল্লিখিত পণ্ের বিজ্ঞাপের তথ্য ( সঠিক মাপ, পরিমা, গুণগত মান, াম, মেয়াদ, পণ্যের অবস্থা সহ অন্যান্ সকল তথ্য ) সিক ও নির্ভু প্রদান করেি এবং ভুল তথ্য ও ভুল পণ্ের জন্য আমি দায়ী থাকিব।
                                                </p>
                                                <p>
                                                    2. আমার প্রেয় পণ্যের বজ্ঞাপন, কোমপানী ও ব্যা্তিগত দেওয়া সমস্ত তথ্য েব্রিক লাগবে কর্তৃপক্ষ বিজ্ঞাপনের ণ্যের বিক্ির সুবিধার্থে কিংবা সরকারী সংস্থার প্রয়োজনে যাাই, বাছাই, সশোধনের এখতিয়ার রাখে এবং আমার এতে কো দ্বি-মত থাকবে না।
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">@lang('website.Close')</button>
                                        <button type="submit" class="btn btn-success">@lang('website.Submit')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
@push('js')
<script src="{{ asset('backend/dist/js/spartan-multi-image-picker-min.js') }}"></script>
    {{--    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script> --}}
    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="{{ asset('backend/plugins/ckeditor/ckeditor.js') }}"></script>

    <script>
        CKEDITOR.replace('description');
        CKEDITOR.replace('description_bn');

        $(document).ready(function() {
            $("#category_two").hide()
            $("#category_three").hide()
            $("#category_four").hide()
            $("#category_five").hide()
            $("#category_six").hide()
            $("#category_seven").hide()
            $("#category_eight").hide()
            $("#category_nine").hide()
            $("#category_ten").hide()
            $('.demo-select2').select2();
            get_subcategories();
        });
            //title to slug make
            $("#name").keyup(function() {
                var name = $("#name").val();
                $.ajax({
                    url: "{{ URL('/seller/products/slug') }}/" + name,
                    method: "get",
                    success: function(data) {
                        $('#slug').val(data.response);
                    }
                });
            })

            $(".price_summation").keyup(function() {
                var quantity = $("#quantity").val();
                var unit_price = $("#unit_price").val();
                if (quantity > 0 && unit_price > 0) {
                    var expected_price = parseFloat(quantity) * parseFloat(unit_price);
                    $('#expected_price').val(expected_price);

                    $.post('{{ route('bid.price.convert') }}', {
                            _token: '{{ csrf_token() }}',
                            bid_price: unit_price,
                            qty: quantity
                        },
                        function(data) {
                            // location.reload();
                            console.log(data);
                            $('#bid_convert_unit_price').val(data.bid_convert_unit_price);
                            $('#bid_convert_total_price').val(data.bid_convert_total_price);
                        });
                } else {
                    $('#expected_price').val('');
                    $('#bid_convert_unit_price').val('');
                    $('#bid_convert_total_price').val('');
                }
            })

            // Get BN EN Name
            function getNameBnEn($name, $name_bn) {
                var lang = $('#lang').val();
                var curr_lang = '';
                if (lang === 'en') {
                    curr_lang = $name;
                } else {
                    curr_lang = $name_bn ? $name_bn : $name;
                }
                return curr_lang;
            }

            function get_subcategories() {
                var category_id = $('#category_id').val();
                //var lang = $('#lang').val();

                console.log(lang)
                $.post('{{ route('products.get_subcategories_by_category') }}', {
                    _token: '{{ csrf_token() }}',
                    category_id: category_id
                }, function(data) {
                    if (data.length > 0) {
                        $('#sub_category_id').html(null);
                        $('#sub_category_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        //console.log(data)
                        for (var i = 0; i < data.length; i++) {
                            $('#sub_category_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                            //$('.demo-select2').select2();
                        }
                    } else {
                        $("#category_two").hide()
                    }
                    get_subsubcategories();
                });
            }

            function get_subsubcategories() {
                var sub_category_id = $('#sub_category_id').val();
                console.log(sub_category_id)
                $.post('{{ route('products.get_subsubcategories_by_subcategory') }}', {
                    _token: '{{ csrf_token() }}',
                    sub_category_id: sub_category_id
                }, function(data) {
                    //console.log(data)
                    if (data.length > 0) {
                        $('#sub_sub_category_id').html(null);
                        $('#sub_sub_category_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#sub_sub_category_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                        }
                        $('.demo-select2').select2();
                    } else {
                        $("#category_three").hide()
                    }
                    get_sub_sub_child_categories();
                });
            }

            function get_sub_sub_child_categories() {
                var sub_sub_category_id = $('#sub_sub_category_id').val();
                console.log(sub_sub_category_id)
                $.post('{{ route('products.get_subsubchildcategories_by_subsubcategory') }}', {
                    _token: '{{ csrf_token() }}',
                    sub_sub_category_id: sub_sub_category_id
                }, function(data) {
                    //console.log(data)
                    if (data.length > 0) {
                        $('#sub_sub_child_category_id').html(null);
                        $('#sub_sub_child_category_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#sub_sub_child_category_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                        }
                        $('.demo-select2').select2();
                    } else {
                        $("#category_four").hide()
                    }
                    get_sub_sub_child_child_categories();

                });
            }

            function get_sub_sub_child_child_categories() {
                var sub_sub_child_category_id = $('#sub_sub_child_category_id').val();
                console.log(sub_sub_category_id)
                $.post('{{ route('products.get_subsubchildchildcategories_by_subsubchildcategory') }}', {
                    _token: '{{ csrf_token() }}',
                    sub_sub_child_category_id: sub_sub_child_category_id
                }, function(data) {
                    //console.log(data)
                    if (data.length > 0) {
                        $('#sub_sub_child_child_category_id').html(null);
                        $('#sub_sub_child_child_category_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#sub_sub_child_child_category_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                        }
                        $('.demo-select2').select2();
                    } else {
                        $("#category_five").hide()
                    }
                    get_category_six();

                });
            }

            function get_category_six() {
                var sub_sub_child_child_category_id = $('#sub_sub_child_child_category_id').val();
                console.log(sub_sub_child_child_category_id)
                $.post('{{ route('products.get_category_six') }}', {
                    _token: '{{ csrf_token() }}',
                    sub_sub_child_child_category_id: sub_sub_child_child_category_id
                }, function(data) {
                    //console.log(data)
                    if (data.length > 0) {
                        $('#category_six_id').html(null);
                        $('#category_six_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#category_six_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                        }
                        $('.demo-select2').select2();
                    } else {
                        $("#category_six").hide()
                    }
                    get_category_seven();

                });
            }

            function get_category_seven() {
                var category_six_id = $('#category_six_id').val();
                console.log(category_six_id)
                $.post('{{ route('products.get_category_seven') }}', {
                    _token: '{{ csrf_token() }}',
                    category_six_id: category_six_id
                }, function(data) {
                    //console.log(data)
                    if (data.length > 0) {
                        $('#category_seven_id').html(null);
                        $('#category_seven_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#category_seven_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                        }
                        $('.demo-select2').select2();
                    } else {
                        $("#category_seven").hide()
                    }
                    get_category_eight();
                });
            }

            function get_category_eight() {
                var category_seven_id = $('#category_seven_id').val();
                console.log(category_seven_id)
                $.post('{{ route('products.get_category_eight') }}', {
                    _token: '{{ csrf_token() }}',
                    category_seven_id: category_seven_id
                }, function(data) {
                    //console.log(data)
                    if (data.length > 0) {
                        $('#category_eight_id').html(null);
                        $('#category_eight_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#category_eight_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                        }
                        $('.demo-select2').select2();
                    } else {
                        $("#category_eight").hide()
                    }
                    get_category_nine()
                });
            }

            function get_category_nine() {
                var category_eight_id = $('#category_eight_id').val();
                console.log(category_eight_id)
                $.post('{{ route('products.get_category_nine') }}', {
                    _token: '{{ csrf_token() }}',
                    category_eight_id: category_eight_id
                }, function(data) {
                    //console.log(data)
                    if (data.length > 0) {
                        $('#category_nine_id').html(null);
                        $('#category_nine_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#category_nine_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                        }
                        $('.demo-select2').select2();
                    } else {
                        $("#category_nine").hide()
                    }
                    get_category_ten()
                });
            }

            function get_category_ten() {
                var category_nine_id = $('#category_nine_id').val();
                console.log(category_eight_id)
                $.post('{{ route('products.get_category_ten') }}', {
                    _token: '{{ csrf_token() }}',
                    category_nine_id: category_nine_id
                }, function(data) {
                    //console.log(data)
                    if (data.length > 0) {
                        $('#category_ten_id').html(null);
                        $('#category_ten_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#category_ten_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                        }
                        $('.demo-select2').select2();
                    } else {
                        $("#category_ten").hide()
                    }

                });
            }

            $('#category_id').on('change', function() {
                var category_id = $('#category_id').val();
                // if(category_id == 4){
                //     toastr.warning( 'For yarn Sell, Please Contact with 09678-236236 or send email : support@fabriclagbe.com');
                //     // alert('For yarn Sell, Please Contact with 09678-236236 or send email : support@fabriclagbe.com');
                //     $('#category_id').val('');
                //     $("#category_two").hide()
                //     return false;
                // }
                if (category_id == 7) {
                    window.location.href = '{{ route('seller.dying-product.create') }}';
                }
                if (category_id == 9) {
                    window.location.href = '{{ route('seller.sizing-product.create') }}';
                }
                if (category_id == 4) {
                    window.location.href = '{{ route('seller.yarn-product.create') }}';
                }
                $("#category_two").show()
                $("#category_three").hide()
                $("#category_four").hide()
                $("#category_five").hide()
                $("#category_six").hide()
                $("#category_seven").hide()
                $("#category_eight").hide()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_subcategories();

            });
            $('#sub_category_id').on('change', function() {
                $("#category_three").show()
                $("#category_four").hide()
                $("#category_five").hide()
                $("#category_six").hide()
                $("#category_seven").hide()
                $("#category_eight").hide()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_subsubcategories();
            });
            $('#sub_sub_category_id').on('change', function() {
                $("#category_four").show()
                $("#category_five").hide()
                $("#category_six").hide()
                $("#category_seven").hide()
                $("#category_eight").hide()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_sub_sub_child_categories();
            });
            $('#sub_sub_child_category_id').on('change', function() {
                $("#category_five").show()
                $("#category_six").hide()
                $("#category_seven").hide()
                $("#category_eight").hide()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_sub_sub_child_child_categories();
            });
            $('#sub_sub_child_child_category_id').on('change', function() {
                $("#category_six").show()
                $("#category_seven").hide()
                $("#category_eight").hide()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_category_six();
            });
            $('#category_six_id').on('change', function() {
                $("#category_seven").show()
                $("#category_eight").hide()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_category_seven();
            });
            $('#category_seven_id').on('change', function() {
                $("#category_eight").show()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_category_eight();
            });
            $('#category_eight_id').on('change', function() {
                $("#category_nine").show()
                $("#category_ten").hide()
                get_category_nine();
            });
            $('#category_nine_id').on('change', function() {
                $("#category_ten").show()
                get_category_ten();
            });


            $("#thumbnail_img").spartanMultiImagePicker({
                fieldName: 'thumbnail_img',
                maxCount: 1,
                rowHeight: '200px',
                groupClassName: 'col-md-4 col-sm-4 col-xs-6',
                maxFileSize: '100000',
                dropFileLabel: "Drop Here",
                onExtensionErr: function(index, file) {
                    console.log(index, file, 'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function(index, file) {
                    console.log(index, file, 'file size too big');
                    alert('Image size too big. Please upload below 100kb');
                },
                onAddRow: function(index) {
                    var altData =
                        '<input type="text" placeholder="Thumbnails Alt" name="thumbnail_img_alt[]" class="form-control" required=""></div>'
                    //var index = index + 1;
                    //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
                    //$('#thumbnail_img_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
                },
                onRemoveRow: function(index) {
                    var index = index + 1;
                    $(`#abc_${index}`).remove()
                },
            });



        $("#photos").spartanMultiImagePicker({
            fieldName: 'photos[]',
            maxCount: 10,
            rowHeight: '100px',
            groupClassName: 'col-md-4 col-sm-4 col-xs-6',
            maxFileSize: '150000',
            dropFileLabel: "Drop Here",
            onExtensionErr: function(index, file) {
                console.log(index, file, 'extension err');
                alert('Please only input png or jpg type file')
            },
            onSizeErr: function(index, file) {
                console.log(index, file, 'file size too big');
                alert('Image size too big. Please upload below 150kb');
            },
            onAddRow: function(index) {
                var altData =
                    '<input type="text" placeholder="Image Alt" name="photos_alt[]" class="form-control" required=""></div>'
                //var index = index + 1;
                //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
                //$('#photos_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
            },
            onRemoveRow: function(index) {
                var index = index + 1;
                $(`#abc_${index}`).remove()
            },
        });

        function get_bid_price(el) {
            var bid_price = el.value;
            var unit_price = $('#unit_price').val();
            var vat = $('#vat').val();
            if (qty == '') {
                alert('Please insert Quantity')
                $('#unit_price').val('');
                $('#expected_price').val('');
                $('#bid_convert_unit_price').val('');
                $('#bid_convert_total_price').val('');
                $('#converted_vat').val('');
                return false;
            }

            if (qty > 0 && bid_price > 0) {
                $.post('{{ route('bid.price.convert') }}', {
                        _token: '{{ csrf_token() }}',
                        bid_price: bid_price,
                        qty: qty,
                        vat: vat
                    },
                    function(data) {
                        // location.reload();
                        console.log(data);
                        $('#bid_convert_unit_price').val(data.bid_convert_unit_price);
                        $('#bid_convert_total_price').val(data.bid_convert_total_price);
                        $('#converted_vat').val(data.converted_vat);
                    });
            } else {
                $('#expected_price').val('');
                $('#bid_convert_unit_price').val('');
                $('#bid_convert_total_price').val('');
                $('#converted_vat').val('');
            }
        }
        function get_vat_price(el){
            var vat = el.value;
            var qty = $('#quantity').val();
            if (qty == '') {
                alert('Quantity must be greater than 0')
                $('#unit_price').val('');
                $('#expected_price').val('');
                $('#bid_convert_unit_price').val('');
                $('#bid_convert_total_price').val('');
                return false;
            }

            if (qty > 0 && bid_price > 0) {
                $.post('{{ route('bid.price.convert') }}', {
                        _token: '{{ csrf_token() }}',
                        bid_price: bid_price,
                        qty: qty,
                        vat: vat
                    },
                    function(data) {
                        // location.reload();
                        console.log(data);
                        $('#bid_convert_unit_price').val(data.bid_convert_unit_price);
                        $('#bid_convert_total_price').val(data.bid_convert_total_price);
                        $('#converted_vat').val(data.converted_vat);
                    });
            } else {
                $('#expected_price').val('');
                $('#bid_convert_unit_price').val('');
                $('#bid_convert_total_price').val('');
                $('#converted_vat').val('');
            }
        }
    </script>
@endpush
