<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class WillingToBuy extends Model
{
    public static function ajaxBuyerList($start_date,$end_date)
    {
        if ($start_date && $end_date){
            $query = DB::table('users')
                ->join('buyers','user_id','=','users.id')
                ->whereBetween('users.created_at', [$start_date." 00:00:00", $end_date ." 23:59:59"])
                ->select('users.*','buyers.selected_category_v2')
                ->orderBy('users.created_at','desc')
                ->get();
        }else{
            $query = DB::table('users')
                ->join('buyers','user_id','=','users.id')
                ->select('users.*','buyers.selected_category_v2')
                ->orderBy('users.created_at','desc')
                ->get();
        }

        return DataTables::of($query)
            ->editColumn('created_at', function ($model) {
                return date('dS M, Y H:i:s a',strtotime($model->created_at));
//                return "testing";
            })
            ->editColumn('selected_category_v2', function ($model) {
                return $model->selected_category_v2;
            })
            ->rawColumns([
                'selected_category_v2',
            ])
            ->toJson();
    }
    public static function ajaxSellerList($start_date,$end_date) {
        if ($start_date && $end_date){
            $query = DB::table('users')
                ->join('sellers','user_id','=','users.id')
                ->where('sellers.verification_status','=',1)
                ->whereBetween('users.created_at', [$start_date." 00:00:00", $end_date ." 23:59:59"])
                ->select('users.*','sellers.selected_category_v2')
                ->orderBy('users.created_at','desc')
                ->get();
        }else{
            $query = DB::table('users')
                ->join('sellers','user_id','=','users.id')
                ->where('sellers.verification_status','=',1)
                ->select('users.*','sellers.selected_category_v2')
                ->orderBy('users.created_at','desc')
                ->get();
        }
        return DataTables::of($query)
            ->editColumn('created_at', function ($model) {
                return date('dS M, Y H:i:s a',strtotime($model->created_at));
            })
            ->editColumn('selected_category_v2', function ($model) {
                return $model->selected_category_v2;

            })
            ->rawColumns([
                'created_at',
                'selected_category_v2',
            ])
            ->toJson();
    }
}
