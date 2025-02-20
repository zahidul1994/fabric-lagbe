@extends('frontend.layouts.master')
@section("title","Accepted Seller Details")
@push('css')
    <style>
        p, p a {
            color: #aaa;
            text-decoration: none;
        }
        p a:hover,
        p a:focus {
            text-decoration: underline;
        }
        p + p { color: #bbb; margin-top: 2em;}
        .detail {position: absolute; text-align: right; right: 5px; bottom: 5px; width: 50%;}

        a[href*="intent"] {
            display:inline-block;
            margin-top: 0.4em;
        }
        /*
   * Rating styles
   */
        .rating {
            width: 226px;
            margin: 0 auto 1em;
            font-size: 45px;
            overflow:hidden;
        }
        .rating input {
            float: right;
            opacity: 0;
            position: absolute;
        }
        .rating a,
        .rating label {
            float:right;
            color: #aaa;
            text-decoration: none;
            -webkit-transition: color .4s;
            -moz-transition: color .4s;
            -o-transition: color .4s;
            transition: color .4s;
        }
        .rating label:hover ~ label,
        .rating input:focus ~ label,
        .rating label:hover,
        .rating a:hover,
        .rating a:hover ~ a,
        .rating a:focus,
        .rating a:focus ~ a		{
            color: orange;
            cursor: pointer;
        }
        .rating2 {
            direction: rtl;
        }
        .rating2 a {
            float:none
        }
        .m_t_30{
            margin-top: -30px;
        }
        .p_t_20{
            padding-top: 20px;
        }
        .see_review{
            background-color: #17a2b8;
            color: white;
        }
        .call_seller{
            background-color: #609b35;
            color: white;
        }
        .for_review{
            background-color: #500f50;
            color: white;
        }
        .font_22{
            font-size: 22px;
        }
        .close_btn{
            background-color: #ab0e0e;
            color: white;
        }
        .submit_btn{
            background-color: #4ce43a;
            color: white;
        }
    </style>
@endpush
@section('content')
    <!-- Main content -->
    <div class="full-row m_t_30">
        <div class="container">
            <div class="row">
                @include('frontend.buyer.buyer_breadcrumb')
                @include('frontend.buyer.buyer_sidebar')
                <div class="col-lg-9">
                    <h3>@lang('website.Seller Information')</h3>
                    @php
                        $days = \Carbon\Carbon::parse($seller->created_at)->diffInDays(\Carbon\Carbon::now());
                     $complete_bids = \App\Model\ProductBid::where('sender_user_id',$seller->id)->where('bid_status',1)->count();
                     $reviews = \App\Model\Review::where('receiver_user_id',$seller->id)->count();
                    @endphp
                    <div>
                        <div class="row">
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{getNumberToBangla($days)}}</h5>
                                        <p>@lang('website.Experience') (@lang('website.Days'))</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{getNumberToBangla($complete_bids)}}</h5>
                                        <p>@lang('website.Completed Bids')</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <a href="{{route('buyer.bidders-review',$seller->id)}}">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">{{getNumberToBangla($reviews)}}</h5>
                                            <p>@lang('website.Reviews')</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{getNumberToBangla(userRating($seller->id))}}</h5>
                                        <p>@lang('website.Ratings')</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                       <div class="p_t_20">
                          <div class="row">
                              <div class="card col-6">
                                  <table class="table">
                                      <tbody>
                                      <tr>
                                          <td>@lang('website.Name'):</td>
                                          <td>{{getNameByBnEn($seller)}}</td>
                                      </tr>
                                      <tr>
                                          <td>@lang('website.Company Name'):</td>
                                          <td>{{getCompanyNameByBnEn($seller->seller)}}</td>
                                      </tr>
                                      <tr>
                                          <td>@lang('website.Company Address'):</td>
                                          <td>{{($seller->address)}}</td>
                                      </tr>
                                      <tr>
                                          <td>@lang('website.Phone Number'):</td>
                                          <td>{{$seller->phone}}</td>
                                      </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                        <div class="row p_t_20">
                            <div class="col-md-3 col-4">
                                <a class="btn see_review" href="{{route('buyer.bidders-review',$seller->id)}}"> @lang('website.See Reviews')</a>
                            </div>
                            <div class="col-md-3 col-4">
                                <a class="btn call_seller" href="tel:{{$seller->phone}}"> @lang('website.Call Seller')</a>
                            </div>
                            @php
                                $reviewCheck = \App\Model\Review::where('product_id',$product_bid->product_id)->where('sender_user_id',Auth::id())->first();
                            @endphp

                            @if(empty($reviewCheck))
                            <div class="col-md-3 col-4">
                                <button type="button" class="btn for_review" data-bs-toggle="modal" data-bs-target="#for_review_modal" >
                                    @lang('website.For Review')
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="for_review_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="staticBackdropLabel">@lang('website.Are you sure?')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('buyer.record-sale-store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="product_bid_id" value="{{$product_bid->id}}">
                        <div>
                            <h5>@lang('website.Did this Sale happen?')</h5>
                            <div class="row">
                                <div class="col-3">
                                    <input type="radio" name="sale_status" data-index="0" id="" value="1" class="shipping_method" checked>
                                    <label class="font_22">@lang('website.Yes')</label>
                                </div>
                                <div class="col-3">
                                    <input type="radio" name="sale_status" data-index="0" id="user_type" value="0" class="shipping_method">
                                    <label class="font_22">@lang('website.No')</label>
                                </div>
                            </div>
                            <div class="p_t_20" >
                                <h5>@lang('website.Transaction Amount')</h5>
                                <p>{{getNumberWithCurrencyByBnEn($product_bid->total_bid_price)}}</p>
                            </div>
                            <div class="p_t_20">
                                <div class="row">
                                    <h5>@lang('website.Rate the Seller')</h5>
                                    <div class="rating">
                                        <input name="rating" id="e5" value="5" type="radio"><label for="e5">☆</label>
                                        <input name="rating" id="e4" value="4" type="radio"><label for="e4">☆</label>
                                        <input name="rating" id="e3" value="3" type="radio"><label for="e3">☆</label>
                                        <input name="rating" id="e2" value="3" type="radio"><label for="e2">☆</label>
                                        <input name="rating" id="e1" value="1" type="radio"><label for="e1">☆</label>
                                    </div>

                                    <div class="">
                                        <label class="text-dark" for="address" >@lang('website.Write a review to the seller') <span class="required">*</span></label>
                                        <textarea class="form-control border border-black bg-gray-light" name="comment" id="comment" rows="3" placeholder="@lang('website.Textarea')" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row p_t_20">
                                <div class="col-md-6">
                                    <button type="button" class="btn close_btn" data-bs-dismiss="modal" >@lang('website.Close')</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn submit_btn">@lang('website.Submit')</button>
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

@endpush
