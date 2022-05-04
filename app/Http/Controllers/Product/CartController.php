<?php

declare(strict_types=1);

namespace App\Http\Controllers\Product;

use App\Factory\CheckoutAddressFactory;
use App\Factory\CustomerAddressFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ShippingAddressRequest;
use App\Models\Product\Product;
use App\Models\Sale\PromoCode;
use App\Models\User;
use App\Services\CheckoutService;
use App\Services\CustomerAddressService;
use App\Services\OrderService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    protected OrderService $orderService;
    protected CheckoutService $checkoutService;
    protected CustomerAddressService $addressService;
    protected CustomerAddressFactory $addressFactory;
    protected CheckoutAddressFactory $checkoutFactory;

    public function __construct(
        OrderService $orderService,
        CheckoutService $checkoutService,
        CustomerAddressFactory $addressFactory,
        CustomerAddressService $addressService,
        CheckoutAddressFactory $checkoutFactory
    ){
        $this->orderService = $orderService;
        $this->addressFactory = $addressFactory;
        $this->addressService = $addressService;
        $this->checkoutService = $checkoutService;
        $this->checkoutFactory = $checkoutFactory;
    }

    public function cart(Request $request){
        $cookie_prod = $request->cookie('products');
        $cookie_prod = json_decode($cookie_prod, true);
        if (!empty($cookie_prod)){
            $sub_total_price = 0;
            foreach ($cookie_prod as $prod){
                $prod_price = intval($prod['price']) * intval($prod['quantity']);
                $sub_total_price = $sub_total_price + $prod_price;
            }
            $cookie_promo = $request->cookie('promo_code');
            if (!empty($cookie_promo)){
                $total =  $sub_total_price - intval($cookie_promo);
                $coupon = $cookie_promo;
            }
            else{
                $total = $sub_total_price;
                $coupon = false;
            }
            $cookie_promo_name = $request->cookie('promo_code_name');
            $promo_name = isset($cookie_promo_name) ? $cookie_promo_name : null;
            $item_count = count($cookie_prod);
        }
        else{
            $item_count = 0;
            $total = 0;
            $coupon = false;
            $promo_name = null;
        }
        return view('cart.cart',compact('item_count', 'cookie_prod','total','sub_total_price','coupon','promo_name'));
    }



    public function qtyUpdate($id, Request $request){
        $cookie_prod = [];
        try {
            $cookie_prod = Cookie::get('products');
            $cookie_prod = json_decode($cookie_prod, true);
        } catch (\Exception $e) {
            $cookie_prod = [];
        }
        $val = 1;
        if(empty($cookie_prod[$id]) ) {
            $item =  Product::active()->find($id);
            if(!$item) {
                return false;
            }

            $data =  [
                'id' => $item->id,
                'name' => $item->name,
                'img'  => $item->image,
                'price' => $item->price,
                'url' => route('product.detail', ['product' => $item->id])
            ];
            $data['total'] = $item->price;
            $data['quantity'] = 1;
        } else {
            $data = $cookie_prod[$id];
            if($request->down && $request->down != 'up')  {
                $val =  intval($data['quantity'] ?? 0);
                $data['quantity'] = $val > 1? $val -1 : 1;
            }
            elseif ($request->down && $request->down == 'up'){
                $data['quantity'] = $data['quantity'] = intval($request->up);
            }
            else {
                $data['quantity'] = intval($data['quantity'] ?? 0) + 1;
            }
            $data['total'] = ($data['price'] ?? 1 ) * $data['quantity'];
            $val =  $data['quantity'];
        }
        $cookie_prod[$id] = $data;

        Cookie::queue('products', json_encode($cookie_prod), 3*24*60*60*1000);
        if($request->ajax()){
             return response()->json(['data' => $data]);
         }
        return redirect(route('product.cart'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function remove(Request $request){
        try {
            $cookie_prod = Cookie::get('products');
            $cookie_prod = json_decode($cookie_prod, true);
        } catch (\Exception $e) {
            $cookie_prod = [];
        }
        if(isset($cookie_prod[$request->remove])) {
            unset($cookie_prod[$request->remove]);
        }
        Cookie::queue('products', json_encode($cookie_prod), 3*24*60*60*1000);
        return redirect()->back();
    }

    /**
     * @return Application|Factory|View
     */
    public function checkout(){
        $cookie_prod = Cookie::get('products');
        $cookie_prod = json_decode($cookie_prod, true);
        if (!empty($cookie_prod)){
            $total = 0;
            foreach ($cookie_prod as $prod){
                $prod_price = intval($prod['price']) * $prod['quantity'];
                $total = $total + $prod_price;
            }
            $cookie_promo = Cookie::get('promo_code');
            if (!empty($cookie_promo)){
                $total_price =  $total - intval($cookie_promo);
            }
            else{
                $total_price = $total;
            }
            $cookie_promo_name = Cookie::get('promo_code_name');
            $promo_name = isset($cookie_promo_name) ? $cookie_promo_name : null;
            $item_count = count($cookie_prod);
        }
        else{
            $item_count = 0;
            $promo_name = null;
        }
        if (auth()->check()){

            $ids = [];
            foreach ($cookie_prod as $k => $item) {
                $ids[$k] = $item['id'];
            }
            $ids = implode(',', $ids);

            $user = User::find(Auth::user()->getAuthIdentifier())->load('checkoutAddress');
            return view('checkout.index',compact('ids','item_count', 'cookie_prod','total_price','total','promo_name','user'));
        }

        $ids = [];
        foreach ($cookie_prod as $k => $item) {
            $ids[$k] = $item['id'];
        }
        $ids = implode(',', $ids);

        return view('checkout.index',compact('ids','item_count', 'cookie_prod','total_price','total','promo_name'));
    }

    public function coupon(Request $request){
        $validate = Validator::make($request->all(),[
           'couponcode' => 'required'
        ]);
        if ($validate->fails()){
            return redirect()->back()->withErrors($validate);
        }

        $coupon_model = PromoCode::where('code',$request->couponcode)
            ->where('is_active', '1')
            ->first();
        if (!empty($coupon_model)){
            $promo = Cookie::get('promo_code_name');
            if (!empty($promo)){
                if ($promo == $request->couponcode){
                    return redirect()->back()->withErrors('Coupon already added. To change, enter a different code.');
                }
            }
            if (isset($coupon_model->expiry_date_at)){
                if ($coupon_model->expiry_date_at > Carbon::now()){
                    Cookie::forget($promo);
                    Cookie::queue('promo_code', $coupon_model->amount, 3*24*60*60*1000);
                    Cookie::queue('promo_code_name', $coupon_model->code, 3*24*60*60*1000);
                }
                else{
                    return redirect()->back()->withErrors('This promo code has expired.');
                }
            }
            else{
                Cookie::forget($promo);
                Cookie::queue('promo_code', $coupon_model->amount, 3*24*60*60*1000);
                Cookie::queue('promo_code_name', $coupon_model->code, 3*24*60*60*1000);
                return redirect()->back();
            }
        }
        return redirect()->back()->withErrors('No promo code found.');
    }

    /**
     * @param ShippingAddressRequest $request
     * @return RedirectResponse
     */
    public function checkoutShipping(ShippingAddressRequest $request): RedirectResponse
    {
        if (isset($request->shipping_address)) {

            /* Save shipping address */
            $checkoutAddressDTO = $this->checkoutFactory->create($request);
            $this->checkoutService->create($checkoutAddressDTO);

            /* Save address user */
            $DTO = $this->addressFactory->create($request);
            $this->addressService->create($DTO);
            /*$this->orderService->store();*/

            return redirect()->route('product.checkout');
        }
        else{
            //TODO add order table addresses
            return false;
        }
    }
}
