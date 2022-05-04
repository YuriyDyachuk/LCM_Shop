<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\CustomerRequest;
use App\Models\State;
use App\Models\User;
use App\Presenters\Admin\Customer\CustomerPresenter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class CustomerController extends Controller
{
    public function index()
    {
        return view('admin.customer.list', [
            'items' => CustomerPresenter::items()
        ]);
    }

    public function create()
    {

        return view('admin.customer.edit', [
            'pageTitle' => 'New customer',
            'item' => new User(),
            'states' => State::list(),
            'breadcrumbs' => [route('admin.customer.list') => 'Customers']
        ]);
    }

    public function store(CustomerRequest $request)
    {
        try {
            DB::beginTransaction();

            $item = new User();
            $item->fill($request->except(['password']));
            $item->password = Hash::make($request->input('password'));
            $item->save();

            $item->address()->create($request->input('address', []));

            DB::commit();

            session()->flash('success', 'Success!');
        } catch (\Throwable $e)
        {
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return $this->redirect($request, $item->id);
    }

    public function edit(User $customer)
    {

        return view('admin.customer.edit', [
            'pageTitle' => 'Edit customer',
            'item' => $customer,
            'states' => State::list(),
            'breadcrumbs' => [route('admin.customer.list') => 'Customers']
        ]);
    }

    public function update(CustomerRequest $request, User $customer)
    {
        try {

            DB::beginTransaction();

            $customer->fill($request->except(['password']));
            if ($request->filled('password'))
            {
                $customer->password = Hash::make($request->input('password'));
            }
            $customer->save();

            $customer->address->fill($request->input('address', []));
            $customer->address->save();

            DB::commit();

            session()->flash('success', 'Success!');
        } catch (\Throwable $e)
        {
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return $this->redirect($request, $customer->id);
    }

    public function destroy(User $customer)
    {
        $isDeleted = $customer->delete() === true;
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

        User::whereIn('id', $ids)->delete();

        session()->flash('success', 'Success!');

        return response()->json([
            'success' => 1
        ]);
    }

    private function redirect(Request $request, int $itemId): RedirectResponse
    {
        $isApply = (int) $request->input('is_apply', 0) > 0;
        return $isApply ? redirect()->route('admin.customer.edit', $itemId) :
            redirect()->route('admin.customer.list');
    }

}
