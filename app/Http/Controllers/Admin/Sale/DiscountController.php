<?php

namespace App\Http\Controllers\Admin\Sale;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Sale\DiscountRequest;
use App\Models\Product\Product;
use App\Models\Sale\Discount;
use App\Presenters\Admin\Sale\DiscountPresenter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DiscountController extends Controller
{
    public function index()
    {
        return view('admin.discount.list', [
            'items' => DiscountPresenter::items()
        ]);
    }

    public function create()
    {
        return view('admin.discount.edit', [
            'pageTitle' => 'New Corporate discount',
            'item' => new Discount(['priority' => Discount::PRIORITY_DEFAULT]),
            'applyProducts' => $this->applyProductsToRequestDefault(),
            'rule' => $this->ruleToRequestDefault()
        ] + $this->viewEditInfo());
    }

    public function store(DiscountRequest $request)
    {
        try {

            $this->validation($request);

            DB::beginTransaction();

            $item = new Discount();
            $item->fill($request->all());
            $item->rule = $this->ruleFromRequest($request);
            $item->save();

            $item->applyProducts()->createMany($this->applyProductsFromRequest($request));

            DB::commit();

            session()->flash('success', 'Success!');
        } catch (\Throwable $e)
        {
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return $this->redirect($request, $item->id);
    }

    public function edit(Discount $discount)
    {

        return view('admin.discount.edit', [
            'pageTitle' => 'Edit Corporate discount',
            'item' => $discount,
            'applyProducts' => $this->applyProductsToRequest($discount),
            'rule' => $this->ruleToRequest($discount),
        ] + $this->viewEditInfo());
    }

    public function update(DiscountRequest $request, Discount $discount)
    {
        try {

            $this->validation($request);

            DB::beginTransaction();

            $discount->fill($request->all());
            $discount->rule = $this->ruleFromRequest($request);
            $discount->save();

            $discount->applyProducts()->delete();
            $discount->applyProducts()->createMany($this->applyProductsFromRequest($request));

            DB::commit();

            session()->flash('success', 'Success!');
        } catch (\Throwable $e)
        {
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return $this->redirect($request, $discount->id);
    }

    public function destroy(Discount $discount)
    {
        $isDeleted = $discount->delete() === true;
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

        Discount::whereIn('id', $ids)->delete();

        session()->flash('success', 'Success!');

        return response()->json([
            'success' => 1
        ]);
    }

    public function isActiveUpdate(Request $request, Discount $discount)
    {
        $discount->is_active = (bool) $request->input('is_active', 0);
        $discount->save();

        session()->flash('success', 'Success!');

        return response()->json([
            'success' => 1
        ]);
    }

    private function redirect(Request $request, int $itemId): RedirectResponse
    {
        $isApply = (int) $request->input('is_apply', 0) > 0;
        return $isApply ? redirect()->route('admin.discount.edit', $itemId) :
            redirect()->route('admin.discount.list');
    }

    private function viewEditInfo(): array
    {
        return [
            'products' => Product::all()->pluck('name', 'id')->toArray(),
            'types' => Discount::TYPE_NAMES,
            'typeCodeProductPricePercentage' => Discount::TYPE_CODE_PRODUCT_PRICE_PERCENTAGE,
            'typeCodeProductPriceFixed' => Discount::TYPE_CODE_PRODUCT_PRICE_FIXED,
            'typeCodeProductQuantityBased' => Discount::TYPE_CODE_PRODUCT_QUANTITY_BASED,
            'productApplyTypes' => Discount::PRODUCT_APPLY_TYPE_NAMES,
            'productApplyTypeProductSeveral' => Discount::PRODUCT_APPLY_TYPE_PRODUCT_SEVERAL,
            'productApplyTypeAllProduct' => Discount::PRODUCT_APPLY_TYPE_ALL_PRODUCT,
            'breadcrumbs' => [route('admin.discount.list') => 'Corporate Discounts']
        ];
    }

    private function applyProductsFromRequest(Request $request): array
    {
        $result = [];

        if ($request->input('product_apply_type', '') !== Discount::PRODUCT_APPLY_TYPE_PRODUCT_SEVERAL)
        {
            return $result;
        }

        $productIds = array_filter(array_unique(array_column(
            (array) $request->input('applyProducts', []), 'item_id'
        )));
        if (empty($productIds))
        {
            throw new \InvalidArgumentException('Please select products.');
        }

        foreach ($productIds as $itemId)
        {
            $result[] = [
                'product_id' => (int) $itemId
            ];
        }

        return $result;
    }

    private function applyProductsToRequest(Discount $discount): array
    {
        $result = $this->applyProductsToRequestDefault();

        if ($discount->applyProducts->isEmpty())
        {
            return $result;
        }

        $result = [];
        foreach ($discount->applyProducts as $applyProduct)
        {
            $result[] = ['item_id' => $applyProduct->product_id];
        }

        return $result;
    }

    private function applyProductsToRequestDefault(): array
    {
        return [['item_id' => 0]];
    }

    private function validation(Request $request): void
    {
        $discountProductApplyType = $request->input('product_apply_type', '');
        $discountType = $request->input('type', '');
        if ($discountProductApplyType === Discount::PRODUCT_APPLY_TYPE_ALL_PRODUCT &&
            $discountType === Discount::TYPE_CODE_PRODUCT_PRICE_FIXED
        )
        {
            throw new \InvalidArgumentException('There can be no equal price for all goods.');
        }

    }

    private function ruleFromRequest(Request $request): array
    {
        $discountType = trim($request->input('type', ''));
        $discountRule = $request->input('rule', []);
        if (empty($discountType) || !$request->has('rule.' . $discountType))
        {
            throw new \InvalidArgumentException('Discount rule not found.');
        }

        switch ($discountType)
        {
            case Discount::TYPE_CODE_PRODUCT_PRICE_PERCENTAGE:
            case Discount::TYPE_CODE_PRODUCT_PRICE_FIXED:
            {
                $discountRule[$discountType] = (int) $discountRule[$discountType];
            }
            break;
            case Discount::TYPE_CODE_PRODUCT_QUANTITY_BASED:
            {
                $discountRule[$discountType] = array_map(function ($ruleItem){
                    return array_map(function ($val){
                        return (int) trim($val);
                    }, $ruleItem);
                }, $discountRule[$discountType]);

                $discountRule[$discountType] = array_filter($discountRule[$discountType], function ($ruleItem){
                    return $ruleItem['quantity_min'] > 0 &&
                        $ruleItem['quantity_max'] > 0 &&
                        $ruleItem['quantity_min'] < $ruleItem['quantity_max'] &&
                        $ruleItem['percentage'] > 0;
                });

                if (count($discountRule[$discountType]) !== count((array) $request->rule[$discountType]))
                {
                    throw new \InvalidArgumentException('Fields related to Discount Type are invalid.');
                }
            }
            break;
        }

        if (empty($discountRule[$discountType]))
        {
            throw new \InvalidArgumentException('Fields related to Discount Type are empty.');
        }

        return [$discountType => $discountRule[$discountType]];
    }

    private function ruleToRequest(Discount $discount): array
    {
        $result = $this->ruleToRequestDefault();
        if (empty($discount->ruleApply))
        {
            return $result;
        }

        return array_merge($result, $discount->ruleApply);
    }

    private function ruleToRequestDefault(): array
    {
        return [
            Discount::TYPE_CODE_PRODUCT_PRICE_PERCENTAGE => '',
            Discount::TYPE_CODE_PRODUCT_PRICE_FIXED => '',
            Discount::TYPE_CODE_PRODUCT_QUANTITY_BASED => [[
                'quantity_min' => '',
                'quantity_max' => '',
                'percentage' => '',
            ]]
        ];
    }
}
