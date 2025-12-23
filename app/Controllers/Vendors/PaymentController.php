<?php

namespace App\Controllers\Vendors;

use App\Controllers\BaseController;
use App\Services\Vendors\PaymentService;

class PaymentController extends BaseController
{
    protected $paymentService;

    public function __construct()
    {
        $this->paymentService = new PaymentService();
        helper('url');
    }
    public function createOrder()
    {
        $post = $this->request->getPost();
        log_message('error', 'POST RECEIVED: ' . json_encode($post));

        $requestUid = $post['request_id'] ?? '';
        $vendorId   = $post['vendor_id'] ?? 0;
        $amount     = (float)($post['amount'] ?? 0.0);
        $gateway    = $post['gateway'] ?? 'razorpay';

        if ($requestUid === '' || $amount <= 0) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => 'Invalid data received.'
            ]);
        }
        log_message('error', "Calling createOrder: vendorId=$vendorId, requestUid=$requestUid, amount=$amount");

        try {
            $res = $this->paymentService->createOrder($requestUid, $vendorId, $amount, $gateway);
            return $this->response->setJSON($res);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function verifyPayment()
    {
        $post = $this->request->getPost();

        $uid = $post['uid'] ?? null;
        if (!$uid) return $this->response->setStatusCode(400)->setJSON(['error' => 'Missing uid']);

        $verified = $this->paymentService->verifyRazorpaySignature($post);
        if ($verified) {
            $gatewayResponse = [
                'gateway_payment_id' => $post['razorpay_payment_id'],
                'gateway_order_id' => $post['razorpay_order_id'],
                'payload' => $post
            ];
            $this->paymentService->markAsPaid($uid, $gatewayResponse);

            return $this->response->setJSON(['status' => 'success']);
        } else {
            $this->paymentService->markAsFailed($uid, ['payload' => $post]);
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid signature']);
        }
    }

    public function paymentStatus($requestId = null)
    {
        if (!$requestId) return $this->response->setStatusCode(400)->setJSON(['error' => 'Missing requestId']);
        $payment = $this->paymentService->getPaymentByRequestId((int)$requestId);
        if (!$payment) return $this->response->setJSON(['status' => 'none']);
        return $this->response->setJSON($payment);
    }
}
