<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ReviewCollection;
use App\Http\Resources\SeeReviewCollection;
use App\Model\Product;
use App\Model\ProductBid;
use App\Model\Review;
use App\Http\Controllers\Controller;
use App\Model\SaleRecord;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        return new ReviewCollection(Review::where('receiver_user_id',Auth::id())->latest()->get());
    }
    public function seeReview($id){
        return new SeeReviewCollection(Review::where('receiver_user_id',$id)->latest()->get());
    }
    public function seeReviewV2(Request $request,$id){
        $page_size = $request->page_size;
        $orderBy = $request->order_by ?? 'desc';
        $name = $request->search;
        $reviews =Review::join('users','users.id','=','reviews.sender_user_id')
            ->where('reviews.receiver_user_id',$id)
            ->where(function($query) use ($name){
                $query->where('users.name', 'like', '%'.$name.'%')
                    ->orWhere('reviews.rating', 'like', '%'.$name.'%')
                    ->orWhere('reviews.comment', 'like', '%'.$name.'%');
            })
            ->select('reviews.*')
            ->orderBy('reviews.created_at',$orderBy)
            ->paginate($page_size);
        return new SeeReviewCollection($reviews);
    }
    public function checkReview($id){
        $product_bid = ProductBid::find($id);
        $review_check = Review::where('sender_user_id',Auth::id())->where('product_id',$product_bid->product_id)->first();
        if (empty($review_check)){
            return response()->json(['success'=>true,'response' => 'Can review'], 201);
        }else{
            return response()->json(['success'=>false,'response'=>'Can not Review'], 401);
        }
    }
    public function reviewSubmit(Request $request, $id){
        $product_bid = ProductBid::find($id);
        $review_check = Review::where('sender_user_id',Auth::id())->where('product_id',$product_bid->product_id)->first();

        if (empty($review_check)){
            $review = new Review();
            $review->sender_user_id = Auth::id();
            if ($product_bid->product->user->user_type == Auth::user()->user_type){
                $review->receiver_user_id = $product_bid->sender_user_id;
            }else{
                $review->receiver_user_id = $product_bid->receiver_user_id;
            }
            $review->product_id = $product_bid->product_id;
            $review->rating = $request->rating;
            $review->comment = $request->comment;
            $review->save();

            if($review->save()){
                $product = Product::findOrFail($product_bid->product_id);
                if(count(Review::where('product_id', $product->id)->where('status', 1)->get()) > 0){
                    $product->rating = Review::where('product_id', $product->id)->where('status', 1)->sum('rating')/count(Review::where('product_id', $product->id)->where('status', 1)->get());
                }
                else {
                    $product->rating = 0;
                }
                $product->save();
            }
            return response()->json(['success'=>true,'response' => 'Review Submitted Successfully '], 201);

        }else{
            return response()->json(['success'=>false,'response'=>'You have already reviewed this bidder'], 401);
        }
    }
    public function reviewLists($id){
        return new ReviewCollection(Review::where('receiver_user_id',$id)->latest()->get());
    }



    public function getUserReviewsForProduct($product_id)
    {
        $reviews = Review::where('product_id', $product_id)
            ->join('users', 'users.id', '=', 'reviews.receiver_user_id')
            ->select('users.name', 'users.address', 'users.phone','users.avatar_original','reviews.*')
            ->get();
    
        // You can return the data in your desired format, for example, as JSON
        return response()->json($reviews);
    }


    public function productReviewSubmit(Request $request, $productId){
        $product = Product::find($productId);
    
        // Check if the product exists
        if (!$product) {
            return response()->json(['success' => false, 'response' => 'Product not found'], 404);
        }
    
        $review_check = Review::where('sender_user_id', Auth::id())
                              ->where('product_id', $productId)
                              ->first();
    
        if (empty($review_check)) {
            $review = new Review();
            $review->sender_user_id = Auth::id();
            $review->receiver_user_id = $product->user_id; // Assuming user_id is the product owner's ID
            $review->product_id = $productId;
            $review->rating = $request->rating;
            $review->comment = $request->comment;
            $review->save();
    
            if ($review->save()) {
                $product->rating = Review::where('product_id', $productId)
                    ->where('status', 1)
                    ->avg('rating');
                $product->save();
            }
    
            return response()->json(['success' => true, 'response' => 'Review Submitted Successfully'], 201);
        } else {
            return response()->json(['success' => false, 'response' => 'You have already reviewed this product'], 401);
        }
    }
    
}
