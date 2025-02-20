<?php

namespace App\Http\Resources;

use App\User;
use App\Model\Shop;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductMyBidCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            
            'data' => $this->collection->map(function($data) {
                $unit_bid_price_bdt = $data->unit_bid_price;
                $total_bid_price_bdt = $data->total_bid_price;
                $unit_bid_price_usd = convert_to_usd($data->unit_bid_price);
                $total_bid_price_usd = convert_to_usd($data->total_bid_price);

                $bidder = User::where('id', $data->receiver_user_id)->first();

                
                return [

                    'id'=>$data->id,
                    
                    'currency' => $data->product->currency,
                    
                   
                    'quantity' =>(string) getNumberToBangla($data->product->quantity),
                    'bid_status' =>$data->product->bid_status,
                    'delivery_status' => $data->product->delivery_status,
                    
                    
                    'date' =>(string) getDateConvertByBnEn($data->created_at),
                    'rating' =>(string) getNumberToBangla(userRating($data->product->user_id)),
                    // 'data' => $data,

                    'price' => 
                    [
                        'unit_bid_price_bdt' =>(string) getNumberToBangla($unit_bid_price_bdt),
                        'total_bid_price_bdt' =>(string) getNumberToBangla($total_bid_price_bdt),
                        'unit_bid_price_usd' =>(string) getNumberToBangla($unit_bid_price_usd),
                        'total_bid_price_usd' =>(string) getNumberToBangla($total_bid_price_usd),
                        'currency_name' => $data->product->currency->code,
                    ],
                    
                    'product' => 
                    
                    [
                        'product_id' => $data->product->id,
                        'thumbnail_image' => $data->product->thumbnail_img,
                        'unit_name' =>(string) $data->product->unit ? getNameByBnEn($data->product->unit) : null,
                       
                        

                    ],

                    'bidder' => 
                    [
                        
                        'bidder_id' => $data->receiver_user_id,
                        'bidder_name' => $bidder->name,
                        'bidder_image' => $bidder ? $bidder->avatar_original : null,
                        'bidder_address' => $bidder->address,

                    ],    

                    'seller'=>[

                        'user_id' => $data->sender_user_id,
                        'user_name' => $data->name,
                        'user_image' => $data->avatar_original,
                       
                    ],

                    'product'=>

                    [
                    'id'=>$data->product->id,
                    'product_name' =>(string) getNameByBnEn($data->product),
                    'photo' => $data->product->thumbnail_img,
                    
                    ],
                    

                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
