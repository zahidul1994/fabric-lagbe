<?php

namespace App\Http\Resources;

use App\User;
use App\Model\Review;
use App\Model\BusinessSetting;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductDetailCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $review_count = Review::where('receiver_user_id',$data->user_id)->count();
                $unit_price_bdt = $data->unit_vat_price;
                $total_price_bdt = $data->expected_price;
                $unit_price_usd = convert_to_usd($data->unit_price);
                $total_price_usd = convert_to_usd($data->expected_price);
                if($data->user_id){
                    $seller_buyer_user_name = getNameByBnEn(User::where('id',$data->user_id)->first());
                    $user_id = User::where('id',$data->user_id)->first();
                    $user_image = $user_id->avatar_original;
                }else{
                    $seller_buyer_user_name = '';
                }

                return [
                    'id' => (integer) $data->id,
                    'name' => getNameByBnEn($data),
//                    'categories' => allCategoryPrint($data),

                    'category_list' => allCategoryForApi($data),
                    'photos' => json_decode($data->photos),
                    'thumbnail_image' => $data->thumbnail_img,
                    'quantity' =>(string) getNumberToBangla($data->quantity),
                    'unit_id' => (integer) $data->unit_id,
                    'unit_name' =>(string) $data->unit ? getNameByBnEn($data->unit): null,
                    'unit_price_bdt' =>(string) getNumberToBangla($unit_price_bdt),
                    'total_price_bdt' =>(string) getNumberToBangla($total_price_bdt),
                    'unit_price_usd' => (string) getNumberToBangla($unit_price_usd),
                    'total_price_usd' =>(string) getNumberToBangla($total_price_usd),
                    'currency_id' =>(integer) $data->currency_id,
                    'currency_name' => $data->currency->code,
                    'rating' =>(string) getNumberToBangla( $data->rating),
                    'review_count' =>(string) getNumberToBangla($review_count) ,
                    'price_validity' =>(string) $data->price_validity,
                    'made_in' =>(string) $data->made_in,
                    'description' =>(string) strip_tags($data->description),
                    'date' =>(string) getDateConvertByBnEn($data->created_at),
                    'seller_buyer_user_name' => $seller_buyer_user_name,
                    'user_image' => $user_image,
                    'user_id' => $user_id->id,
                    'user_name' => $user_id->name,
                    'user_name_bn' => $user_id->name_bn,
                    'user_image' => $user_id->avatar_original,
                    
                    'links' => [
                        'reviews' => route('reviews', $data->user_id),
                        'bidder_list' => route('bidderList.index', $data->id),
                    ]
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

    protected function convertToChoiceOptions($data){
        $result = array();
        foreach ($data as $key => $choice) {
            $item['name'] = $choice->attribute_id;
            $item['title'] = Attribute::find($choice->attribute_id)->name;
            $item['options'] = $choice->values;
            array_push($result, $item);
        }
        return $result;
    }
}
