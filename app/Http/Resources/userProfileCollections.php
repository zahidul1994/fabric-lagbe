<?php

namespace App\Http\Resources;

use App\Model\Seller;
use Illuminate\Http\Resources\Json\ResourceCollection;

class userProfileCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $days = \Carbon\Carbon::parse($data->created_at)->diffInDays(\Carbon\Carbon::now());
                $complete_bids = \App\Model\ProductBid::where('sender_user_id',$data->id)->where('bid_status',1)->count();
                $reviews = \App\Model\Review::where('receiver_user_id',$data->id)->count();

                if ($data->user_type == 'seller'){
                    $seller = Seller::where('user_id',$data->id)->first();
                    return [
                        //dd($data),
                        'id' => $data->id,
                        'name' => (string) $data->name,
                        'email' => (string) $data->email,
                        'avatar_original' => (string) $data->avatar_original,
                        'phone' => [
                            'phone' => (string) $data->phone,
                            'whatsapp_number' => (string) $data->whatsapp_number,
                            'country_code' => (string) $data->country_code,
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
                        'company' => [
                            'company_name' => (string) $seller->company_name,
                            'company_phone' => (string) $seller->company_phone,
                            'company_address' => (string) $seller->company_address,
                        ],
                        'referral_code' =>(string) $data->referral_code? $data->referral_code : '',
                        'verification_status' => $seller->verification_status,
                        'employer_status' => (integer) $seller->employer_status,
                        'multiple_user_types' => $data->multiple_user_types,

                        'membership' => [
                            'membership_package_id' => (integer) $data->membership_package_id,
                            'membership_package_name' => @$data->membershipPackage->package_name,
                            'membership_activation_date' => (string) @$data->membership_activation_date,
                            'membership_expired_date' => (string) $data->membership_expired_date,
                            'remaining_uploads' => (string) $data->remaining_uploads,
                        ],

                        'created_at' =>  $data->created_at,
                        'updated_at' => $data->updated_at,
                        // 'verification_code' => (integer) $data->country_code,
                        'nid_front' => (string) $data->nid_front,
                        'nid_back' => (string) $data->nid_back,
                        // 'banned' => (int) $data->banned,
                        // 'balance' => (double) $data->balance,
                        'trade_licence' => (string) $seller->trade_licence,
                        'nid' => (string) $seller->nid,
                        // 'experience' => (integer) $days,
                        // 'complete_bids' => (integer) $complete_bids,
                        // 'reviews' => (integer) $reviews,
                        // 'ratings' => (float) userRating($data->id),

                    ];
                }else{
                    return [
                        'id' => $data->id,
                        'name' => (string) $data->name,
                        'email' => (string) $data->email,
                        'avatar_original' => (string) $data->avatar_original,
                        'phone' => [
                            'phone' => (string) $data->phone,
                            'whatsapp_number' => (string) $data->whatsapp_number,
                            'country_code' => (string) $data->country_code,
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

                        'referral_code' => (string) $data->referral_code? $data->referral_code : '',
                       
                        'multiple_user_types' => $data->multiple_user_types,

                        'membership' => [
                            'membership_package_id' => (integer) $data->membership_package_id,
                            'membership_package_name' => @$data->membershipPackage->package_name,
                            'membership_activation_date' => (string) @$data->membership_activation_date,
                            'membership_expired_date' => (string) $data->membership_expired_date,
                            'remaining_uploads' => (string) $data->remaining_uploads,
                        ],

                        'created_at' => $data->created_at,
                        'updated_at' => $data->updated_at,
                
                    ];
                }

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
