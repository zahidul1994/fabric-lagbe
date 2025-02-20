

<input type="hidden" id="cartCount" value="{{ Cart::content()->count() }}" style="display: none;">
<div class="">
    <ul class="cart_list product_list_widget ">
        @forelse(Cart::content() as $cartData)
              {{-- logic for variable price and quantity --}}
    @if($cartData->options->var_price_qty)
      @php
      $jsonData = json_decode($cartData->options->var_price_qty,true);
      ['var_price'=>$var_price, 'var_quantity'=>$var_quantity] = $jsonData;
      $cart_quantity  = (int)$cartData->qty;
      
      
      $index = -1 ;
      for($i=0; $i < count($var_quantity) ; $i++)
      {
         if(($cart_quantity) <= $var_quantity[$i])
         {
          $index = $i ;
          break;
         }
     }

     if($index === -1)
     {
         $index = end($var_quantity);
     }

      $price_calculated_from_table = $var_price[$index];
      $total_calculated_from_table = $price_calculated_from_table *  $cart_quantity ;

 @endphp 

{{-- <h4>{{gettype($cartData->qty)}}</h4> --}}
      {{-- <h4>{{($total_calculated_from_table)}}</h4> --}}
@endif
{{-- logic for variable price and quantity --}}
            <li class="mini-cart-item">
                <a href="{{ route('product.cart.remove', $cartData->rowId) }}" class="remove" title="Remove this item"><i
                        class="fas fa-times"></i></a>
                <a href="#" class="product-image bg-light">
                    <img src="{{ url($cartData->options->image) }}"
                        class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="Cart product"
                        style="height: 55px; width: 100%;">
                </a>
                <a href="#" class="product-name">{{ Str::limit($cartData->name, 30) }}</a>
                <div class="cart-item-quantity">
                    <span class="woocommerce-Price-amount amount">
                    <bdi>
                        @if($cartData->options->var_price_qty)
                        <span class="woocommerce-Price-currencySymbol"></span>{{ getNumberWithCurrencyByBnEn($price_calculated_from_table) }}
                        @else
                        <span class="woocommerce-Price-currencySymbol"></span>{{ getNumberWithCurrencyByBnEn($cartData->options->unit_vat_price) }}
                        @endif
                        
                        
                           
                           
                      
                          
                            <span>* {{ $cartData->qty }} {{ $cartData->options->unit }}</span>



                            
                           

                            @if($cartData->options->var_price_qty)
                            <span>= {{ getNumberWithCurrencyByBnEn($total_calculated_from_table) }}</span> 
                            @else
                            <span>= {{ getNumberWithCurrencyByBnEn($cartData->options->unit_vat_price * $cartData->qty) }}</span> 
                            @endif

                        </bdi>   
                    </span>              
                     <hr>
                            <span class="inline" title="You Can't Add To Cart More Than Total Quantity"> 
                            <button id="decrementBtn" pid="{{$cartData->id}}" class="btn btn-sm btn-danger" style="line-height:39px ;border-radius: 7px;
                                margin-right: 4px;"><i class="fa fa-minus"></i></button><input style="text-align: center; width: 100px" type="number" min="1" onblur="updateCartQuantity({{$cartData->id}});" title="You Can't Add To Cart More Than Total Quantity"  id="quantity_{{ $cartData->id }}" value="{{ $cartData->qty }}"><button id="incrementBtn" pid="{{$cartData->id}}"class="btn btn-sm btn-success" style="line-height:37px;border-radius: 7px;margin-left: 4px;margin-top: -4px"><i class="fa fa-plus"></i></button>
                            </span>
                     
                   
                </div>
            </li>
        @empty
            <img src="{{ asset('frontend/assets/img/empty-cart.gif') }}" alt="">
            <div class="text-center mt-1">
                <h5 class="p-0 m-0">Cart Empty!!</h5>
            </div>
        @endforelse
    </ul>
    @if (Cart::count() > 0)
        <div class="total-cart">
            <div class="title">Total: </div>
            <div class="price"><span class="woocommerce-Price-amount amount"><span
                        class="woocommerce-Price-currencySymbol"></span>{{ getNumberWithCurrencyByBnEn(Cart::total()) }}</span>
            </div>
        </div>
        <div class="buttons">
            <a href="{{ route('shopping-cart') }}" class="btn btn-primary rounded-0 view-cart text-white">View cart</a>
            <a href="{{ route('checkout') }}" class="btn btn-secondary rounded-0 checkout text-white">Check out</a>
        </div>
    @endif
</div>

