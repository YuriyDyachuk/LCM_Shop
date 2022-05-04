<?php


namespace App\View\Composers;

use App\Models\Product\ProductCategory;
use Illuminate\View\View;

class CartComposer
{
    public const MAKEUP_VERSION = 1;
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $cartProducts = json_decode(\Cookie::get('products'),true);
        $view->with('cartProducts', $cartProducts);
    }
}
