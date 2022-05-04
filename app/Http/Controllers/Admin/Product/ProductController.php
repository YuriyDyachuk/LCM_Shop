<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\ProductRequest;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Presenters\Admin\Product\ProductPresenter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.list', [
            'items' => ProductPresenter::items(),
            'categories' => ProductCategory::all()->pluck('name', 'id')->toArray()
        ]);
    }

    public function create()
    {
        //todo
        $skuDefault = uniqid('#SK');

        return view('admin.product.edit', [
            'pageTitle' => 'New product',
            'item' => new Product(['sku' => $skuDefault]),
            'categories' => ProductCategory::all()->pluck('name', 'id')->toArray(),
            'breadcrumbs' => [route('admin.product.list') => 'Products']
        ]);
    }

    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();

            $item = new Product();
            $item->fill($request->all());
            $item->save();

            $item->storeFileFromRequest('image', $request);

            $item->seo()->create($request->input('seo', []));

            DB::commit();

            session()->flash('success', 'Success!');
        } catch (\Throwable $e)
        {
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return $this->redirect($request, $item->id);
    }

    public function edit(Product $product)
    {

        return view('admin.product.edit', [
            'pageTitle' => 'Edit product',
            'item' => $product,
            'categories' => ProductCategory::all()->pluck('name', 'id')->toArray(),
            'breadcrumbs' => [route('admin.product.list') => 'Products']
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();

            $product->fill($request->all());
            $product->save();

            $product->storeFileFromRequest('image', $request);

            $product->seo->fill($request->input('seo', []));
            $product->seo->save();

            DB::commit();

            session()->flash('success', 'Success!');
        } catch (\Throwable $e)
        {
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return $this->redirect($request, $product->id);
    }

    public function destroy(Product $product)
    {
        $isDeleted = $product->delete() === true;
        $isDeleted ? session()->flash('success', 'Success!') :
            session()->flash('mistakes', ['Deletion error']);

        return response()->json([
            'success' => 1
        ]);
    }

    public function inStockUpdate(Request $request, Product $product)
    {
        $product->in_stock = (bool) $request->input('in_stock', 0);
        $product->save();

        session()->flash('success', 'Success!');

        return response()->json([
            'success' => 1
        ]);
    }

    public function bulkInStockUpdate(Request $request)
    {
        $ids = array_filter(array_unique(
            (array)$request->input('ids', [])
        ));
        $inStock = (bool) $request->input('in_stock', 0);

        Product::whereIn('id', $ids)->update(['in_stock' => $inStock]);

        session()->flash('success', 'Success!');

        return response()->json([
            'success' => 1
        ]);
    }

    public function bulkDestroy(Request $request)
    {
        $ids = array_filter(array_unique(
            (array)$request->input('ids', [])
        ));

        Product::whereIn('id', $ids)->delete();

        session()->flash('success', 'Success!');

        return response()->json([
            'success' => 1
        ]);
    }

    private function redirect(Request $request, int $itemId): RedirectResponse
    {
        $isApply = (int) $request->input('is_apply', 0) > 0;
        return $isApply ? redirect()->route('admin.product.edit', $itemId) :
            redirect()->route('admin.product.list');
    }

}
