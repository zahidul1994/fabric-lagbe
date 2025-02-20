<?php

namespace App\Http\Resources;

use App\Model\MembershipPackageDetail;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MembershipPackageDetailsCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $details = MembershipPackageDetail::where('membership_package_id',$data->id)->first();
                return [
                    'id' => $data->id,
                    'package_name' =>(string) getMembershipPackageNameByBnEn($data),
                    'price_bdt' =>(string) getNumberToBangla($data->price),
                    'price_usd' =>(string) getNumberToBangla(convert_to_usd($data->price)),
                    'validation' =>(string) getNumberToBangla($data->validation),
                    'buy' =>(string) getYesNoValue($details->buy),
                    'sell' =>(string) getYesNoValue($details->sell),
                    'commission' =>(string) getNumberToBangla($details->commission),
                    'job' =>(string) getYesNoValue($details->job),
                    'free_sms' =>(string) getNumberToBangla($details->free_sms),
                    'work_order' =>(string) getYesNoValue($details->work_order),
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
