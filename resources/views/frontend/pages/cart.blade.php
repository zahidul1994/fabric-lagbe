@extends('frontend.layouts.master')
@section('title', 'Cart Details')
@section('content')
<div class="full-row">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-12 col-md-12 col-12">
                <form class="woocommerce-cart-form" action="#" method="post">
                    <table class="shop_table cart">
                        <tr>
                            <th class="product-remove">&nbsp;</th>
                            <th class="product-thumbnail">&nbsp;</th>
                            <th class="product-name">Product</th>
                            <th class="product-price">Price</th>
                            <th class="product-price">Quantity</th>
                            {{-- <th class="product-quantity text-center">Plus Or Minus</th> --}}
                            <th class="product-subtotal">Subtotal</th>
                        </tr>
                        @forelse(Cart::content() as $cartData)
                        <tr class="woocommerce-cart-form__cart-item cart_item">
                            <td class="product-remove">
                                <a href="{{ route('product.cart.remove', $cartData->rowId) }}" class="remove"></a>
                            </td>
                            <td class="product-thumbnail">
                                <a href="#"><img src="{{ url($cartData->options->image)}}" alt="Product image"></a>
                            </td>
                            <td class="product-name">
                                <a href="#">{{$cartData->name}}</a>
                                {{-- <dl class="variation">
                                    <dt class="variation-Vendor">Vendor:</dt>
                                    <dd class="variation-Vendor">Cosmetic</dd>
                                </dl> --}}
                            </td>
                            <td class="product-price">
                                <span><bdi>{{ getNumberWithCurrencyByBnEn($cartData->options->unit_vat_price) }}</bdi>
                                </span>
                            </td>
                            <td class="product-price">
                             
                                <span><bdi> {{ $cartData->qty }} {{ $cartData->options->unit }}
                                </bdi>  </span>
                            </td>
                            {{-- <td class="product-quantity">
                                <div class="quantity">
                                    <input type="number" name="quantity" value="1">
                                </div>
                            </td> --}}
                            <td class="product-subtotal">
                                <span><bdi>{{ getNumberWithCurrencyByBnEn($cartData->options->unit_vat_price * $cartData->qty) }}</bdi>
                                </span>
                            </td>
                        </tr>
                        @endforeach

                        {{-- <tr>
                            <td colspan="6" class="actions">
                                <div class="coupon">
                                    <label for="coupon_code">Coupon:</label>
                                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code">
                                    <button type="submit" class="button" name="apply_coupon" value="Apply coupon">Apply coupon</button>
                                </div>
                                <button type="submit" class="button" name="update_cart" value="Update cart" disabled="">Update cart</button>
                            </td>
                        </tr> --}}
                    </table>
                </form>
            </div>
            <div class="col-xl-4 col-lg-12 col-md-12 col-12">
                <div class="cart-collaterals">
                    <div class="cart_totals ">
                        <h2>Cart totals</h2>
                        <table>
                            <tr>
                                <th>Subtotal</th>
                                <td>
                                    <span><bdi>{{ getNumberWithCurrencyByBnEn(Cart::total()) }}</bdi>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Delivery Charge</th>
                                <td>
                                   {{getNumberWithCurrencyByBnEn(50)}}
                                </td>
                            </tr>
                            <tr class="order-total">
                                <th>Total</th>
                                <td><strong><span class="woocommerce-Price-amount amount"><bdi>{{ getNumberWithCurrencyByBnEn(Cart::total() + 50) }}</bdi></span></strong> </td>
                            </tr>
                        </table>
                        <div class="wc-proceed-to-checkout">
                            <a href="{{ route('checkout') }}" class="checkout-button">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection