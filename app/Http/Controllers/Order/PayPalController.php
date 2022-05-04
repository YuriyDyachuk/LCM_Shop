<?php

declare(strict_types=1);

namespace App\Http\Controllers\Order;

use App\Services\OrderProductService;
use Illuminate\Http\Request;
use App\Factory\OrderFactory;
use App\Services\OrderService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    protected OrderService $orderService;
    protected OrderFactory $orderFactory;
    protected OrderProductService $orderProductService;

    public function __construct(
        OrderService $orderService,
        OrderFactory $orderFactory,
        OrderProductService $orderProductService
    ){
        $this->orderService = $orderService;
        $this->orderFactory = $orderFactory;
        $this->orderProductService = $orderProductService;
    }

    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction()
    {
        return redirect()->route('home.index');
    }

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => config('paypal.intent'),
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount"=> [
                        "currency_code"=> config('paypal.currency'),
                        "value"=> $request->input('total_sum')
                    ],
                    'description' => $request->input('description')
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            /* Redirect to approve href */
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {

                    DB::beginTransaction();
                    try {
                        $DTO = $this->orderFactory->create($response['id']);
                        $order = $this->orderService->store($DTO);

                        // TODO save with orderProduct relation
                        $this->orderProductService->attachProduct($order->id, explode(',',$request->input('ids')));

                        DB::commit();

                        return redirect()->away($links['href']);
                    }catch (\Throwable $exception) {
                        Log::info($exception->getMessage());
                        DB::rollBack();

                        return redirect()
                                    ->back()
                                    ->with('error', $exception->getMessage() ?? 'Something went wrong.');
                    }
                }
            }

            return redirect()
                        ->route('createTransaction')
                        ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                        ->route('createTransaction')
                        ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        try {
            DB::beginTransaction();
            if (isset($response['status']) && $response['status'] == 'COMPLETED') {

                Log::info('Init ======= success');
                $order = $this->orderService->findTransactionById($response['id']);

                if (!$this->orderService->exists($order->id)) {
                    return redirect()
                                ->route('createTransaction')
                                ->with('error', 'This order is not exists! Try again.');
                }

                $this->orderService->changeStatus($order->id);
                DB::commit();

                return redirect()
                            ->route('createTransaction')
                            ->with('success', 'Transaction complete.');
            }
        } catch (\Throwable $exception) {
            DB::rollBack();

            return redirect()
                        ->route('createTransaction')
                        ->with('error', $exception->getMessage() ?? 'Something went wrong.');
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction()
    {
        return redirect()
                    ->route('createTransaction')
                    ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
