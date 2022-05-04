<?php


namespace App\View\Composers;

use App\Models\Product\ProductCategory;
use Illuminate\View\View;

class LayoutComposer
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
        $view->with('makeupVer', '?v=' . self::MAKEUP_VERSION);

        $productCategories = ProductCategory::active()
            ->orderBy('name')
            ->get()
            ->pluck('name', 'id')
            ->toArray();
        $view->with('productCategories', $productCategories);
    }
}
