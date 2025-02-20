<?php

namespace App\Http\Resources;

use App\Model\MembershipPackageDetail;
use App\Model\MembershipPackageOtherBenefit;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MembershipPackageBenefitsCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $benefits = MembershipPackageOtherBenefit::where('membership_package_id',$data->id)->first();
                return [
                    'id' => $data->id,
                    'package_name' => getMembershipPackageNameByBnEn($data),
                    'market_strategic' => getYesNoValue($benefits->market_strategic),
                    'rd_facilities' => getYesNoValue($benefits->rd_facilities),
                    'costing_facilities' => getYesNoValue($benefits->costing_facilities),
                    'promotion_facilities' => getYesNoValue($benefits->promotion_facilities),
                    'bank_loan_facilities' => getYesNoValue($benefits->bank_loan_facilities),
                    'customer_acquisition_facilities' => getYesNoValue($benefits->customer_acquisition_facilities),
                    'discount_offers' => getYesNoValue($benefits->discount_offers),
                    'training_facility' => getYesNoValue($benefits->training_facility),
                    'ad_discounts' => getYesNoValue($benefits->ad_discounts),
                    'credit_facilities' => getYesNoValue($benefits->credit_facilities),
                    'loyalty_program' => getYesNoValue($benefits->loyalty_program),
                    'yarn_price_update' => getYesNoValue($benefits->yarn_price_update),
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
