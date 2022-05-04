<?php

namespace App\Http\Controllers\Admin\Sale;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Sale\PromoCodeRequest;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Sale\PromoCode;
use App\Presenters\Admin\Sale\PromoCodePresenter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PromoCodeController extends Controller
{
    public function index()
    {
        return view('admin.promo-code.list', [
            'items' => PromoCodePresenter::items()
        ]);
    }

    public function create()
    {
        //todo
        $couponCodeDefault = uniqid();

        return view('admin.promo-code.edit', [
            'pageTitle' => 'New Promo code',
            'item' => new PromoCode(['code' => $couponCodeDefault]),
            'applies' => $this->appliesToRequestDefault()
        ] + $this->viewEditInfo());
    }

    public function store(PromoCodeRequest $request)
    {
        try {

            DB::beginTransaction();

            $item = new PromoCode();
            $item->fill($request->all());
            $item->save();

            $item->applies()->createMany($this->appliesFromRequest($request));

            DB::commit();

            session()->flash('success', 'Success!');
        } catch (\Throwable $e)
        {
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return $this->redirect($request, $item->id);
    }

    public function edit(PromoCode $coupon)
    {

        return view('admin.promo-code.edit', [
            'pageTitle' => 'Edit Promo code',
            'item' => $coupon,
            'applies' => $this->appliesToRequest($coupon)
        ] + $this->viewEditInfo());
    }

    public function update(PromoCodeRequest $request, PromoCode $coupon)
    {
        try {

            DB::beginTransaction();

            $coupon->applies()->delete();
            
            $coupon->fill($request->all());
            $coupon->save();

            $coupon->applies()->createMany($this->appliesFromRequest($request));

            DB::commit();

            session()->flash('success', 'Success!');
        } catch (\Throwable $e)
        {
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return $this->redirect($request, $coupon->id);
    }

    public function destroy(PromoCode $coupon)
    {
        $isDeleted = $coupon->delete() === true;
        $isDeleted ? session()->flash('success', 'Success!') :
            session()->flash('mistakes', ['Deletion error']);

        return response()->json([
            'success' => 1
        ]);
    }

    public function bulkDestroy(Request $request)
    {
        $ids = array_filter(array_unique(
            (array)$request->input('ids', [])
        ));

        PromoCode::whereIn('id', $ids)->delete();

        session()->flash('success', 'Success!');

        return response()->json([
            'success' => 1
        ]);
    }

    private function redirect(Request $request, int $itemId): RedirectResponse
    {
        $isApply = (int) $request->input('is_apply', 0) > 0;
        return $isApply ? redirect()->route('admin.promo-code.edit', $itemId) :
            redirect()->route('admin.promo-code.list');
    }

    private function viewEditInfo(): array
    {
        return [
            'applyTypes' => PromoCode::APPLY_TYPE_NAMES,
            'applyTypeCategories' => PromoCode::APPLY_TYPE_PRODUCT_CATEGORIES,
            'applyTypeProducts' => PromoCode::APPLY_TYPE_PRODUCTS,
            'productCategories' => ProductCategory::all()->pluck('name', 'id')->toArray(),
            'products' => Product::all()->pluck('name', 'id')->toArray(),
            'breadcrumbs' => [route('admin.promo-code.list') => 'Promo codes']
        ];
    }

    private function appliesFromRequest(Request $request): array
    {
        $result = [];

        $applyType = $request->input('apply_type', '');
        $applyIds = (array) $request->input('applies', []);
        if (empty($applyType) || empty($applyIds[$applyType]))
        {
            return $result;
        }

        $applyIds = array_filter(array_unique(array_column($applyIds[$applyType], 'item_id')));
        if (empty($applyIds))
        {
            throw new \InvalidArgumentException('The list of values for the Apply to field cannot be empty.');
        }

        foreach ($applyIds as $itemId)
        {
            $result[] = [
                'applicable_type' => $applyType,
                'applicable_id' => (int) $itemId
            ];
        }

        return $result;
    }

    private function appliesToRequest(PromoCode $coupon): array
    {
        $result = $this->appliesToRequestDefault();

        if ($coupon->applies->isEmpty())
        {
            return $result;
        }

        $result[$coupon->apply_type] = [];
        foreach ($coupon->applies as $apply)
        {
            $result[$coupon->apply_type][] = ['item_id' => $apply->applicable_id];
        }

        return $result;
    }

    private function appliesToRequestDefault(): array
    {
        return [
            PromoCode::APPLY_TYPE_PRODUCT_CATEGORIES => [['item_id' => 0]],
            PromoCode::APPLY_TYPE_PRODUCTS => [['item_id' => 0]]
        ];
    }

}
