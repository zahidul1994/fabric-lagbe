<?php

namespace App\Http\Resources;

use App\Model\Shop;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BidderListCollection extends ResourceCollection
{
    public function toArray($request)
    {
        //return 'products collections';

        return [
            'data' => $this->collection->map(function($data) {
                $bidder = Bidder($data->sender_user_id);
                $bid_check = \App\Model\ProductBid::where('product_id',$data->product_id)->where('bid_status',1)->first();
                if($data->bid_status == 1){
                    $bid_status = 'Accepted';
                }
                elseif(!empty($bid_check)){
                    $bid_status = 'Rejected';
                }
                else{
                    $bid_status = 'Pending';
                }

                    $unit_bid_price_bdt = $data->unit_bid_price;
                    $total_bid_price_bdt = $data->total_bid_price;
                    $unit_bid_price_usd = convert_to_usd($data->unit_bid_price);
                    $total_bid_price_usd = convert_to_usd($data->total_bid_price);

                return [
                    'currency' => [
                        'id' => $data->product->currency->id,
                        'name' => $data->product->currency->name,
                        'symbol' => $data->product->currency->symbol,
                        'exchange_rate' => $data->product->currency->exchange_rate,
                        'status' => $data->product->currency->status,
                        'code' => $data->product->currency->code,
                        'created_at' => $data->product->currency->created_at,
                        'updated_at' => $data->product->currency->updated_at,
                    ],
                    'id' => (int) $data->id,
                    'quantity' =>(string) getNumberToBangla($data->product->quantity),
                    'bid_status' => $bid_status,
                    'delivery_status' => 'pending',
                    'date' =>(string) getDateConvertByBnEn($data->created_at),
                    'rating' =>(string) getNumberToBangla(userRating($data->product->user_id)),
                    'price' => [
                        'unit_bid_price_bdt' => getNumberToBangla($data->unit_bid_price),
                        'total_bid_price_bdt' => getNumberToBangla($data->total_bid_price),
                        'unit_bid_price_usd' => getNumberToBangla(convert_to_usd($data->unit_bid_price)),
                        'total_bid_price_usd' => getNumberToBangla(convert_to_usd($data->total_bid_price)),
                        'currency_name' => $data->product->currency->code,
                        
                    ],
                    'bidder' => [
                        'bidder_id' => $data->sender_user_id,
                        'bidder_name' => $bidder->name,
                        'bidder_image' => $bidder ? $bidder->avatar_original : null,
                    ],
                    'seller' => [
                        'user_id' => $data->receiver_user_id,
                        // 'user_name' => $data->name,
                        // 'user_image' => $data->avatar_original,
                    ],
                    'product' => [
                        'product_id' => $data->product->id,
                        'product_name' => (string) getNameByBnEn($data->product),
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
