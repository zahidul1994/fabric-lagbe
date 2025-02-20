<?php

namespace App\Http\Resources;

use App\Model\Buyer;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class buyerProfileCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $days = \Carbon\Carbon::parse($data->created_at)->diffInDays(\Carbon\Carbon::now());
                $complete_bids = \App\Model\ProductBid::where('sender_user_id', $data->id)->where('bid_status', 1)->count();
                $reviews = \App\Model\Review::where('receiver_user_id', $data->id)->count();
                $buyer = Buyer::where('user_id', $data->id)->first();
                return [
                    //dd($data),

                    'id' => (integer) $data->id,
                    'name' =>(string) getNameByBnEn($data),
                    'email' => (string) $data->email,
                    'avatar_original' => (string) $data->avatar_original,
                    'phone' => [
                        'country_code' => (string) $data->country_code,
                        'phone' => (string) getNumberToBangla($data->phone),
                        'whatsapp_number' => (string)$data->whatsapp_number? getNumberToBangla($data->whatsapp_number):'',
                    ],
                    'localization' => [
                        'language' => 'en',
                        'currency' => 'USD'
                    ],
                    'address' => [
                        'address' => (string) $data->address,
                        'city' => '',
                        'state' => '',
                        'zip' => '',
                    ],
                 
                    'membership' => [
                        'membership_package_id' => (integer) $data->membership_package_id,
                        'membership_package_name' => @$data->membershipPackage->package_name,
                        'membership_activation_date' => (string) @$data->membership_activation_date,
                        'membership_expired_date' => (string) $data->membership_expired_date,
                        'remaining_uploads' => (string) $data->remaining_uploads,
                    ],
                  

                    'created_at' => (string) $data->created_at,
                    'updated_at' => (string) $data->updated_at,
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
