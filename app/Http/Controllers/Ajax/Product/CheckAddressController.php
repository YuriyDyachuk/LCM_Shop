<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ajax\Product;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class CheckAddressController extends Controller
{
    public function checkAddress(int $id): JsonResponse
    {
        if (request()->ajax()) {

            $myAddress = request()->user()->checkoutAddress()->where(['id' => $id])->first();

            return response()->json(['data' => $myAddress]);
        }
    }

}