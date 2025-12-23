<?php

namespace App\Services\Vendors;

use App\Models\Vendors\PaymentModel;

class PaymentService
{
    protected $paymentModel;
    protected $razorpayKey;
    protected $razorpaySecret;

    public function __construct()
    {
        $this->paymentModel = new PaymentModel();
        $this->razorpayKey = getenv('RAZORPAY_KEY');
        $this->razorpaySecret = getenv('RAZORPAY_SECRET');
    }

    /**
     * createOrder - called by controller to create gateway order and db record
     *
     * @param int $requestId
     * @param  $vendorId
     * @param float $amount
     * @param string $gateway
     * @return array 
     */
    public function createOrder(string $requestUid,  $vendorId, float $amount, string $gateway = 'razorpay')
    {
        $uid = bin2hex(random_bytes(8));
        $data = [
            'uid' => $uid,
            'request_id' => $requestUid,
            'vendor_id' => $vendorId,
            'amount' => $amount,
            'currency' => 'INR',
            'gateway' => $gateway,
            'status' => 'created'
        ];
        $this->paymentModel->createPayment($data);
        $payment = $this->paymentModel->findByUid($uid);


        if ($gateway === 'razorpay') {
            $order = $this->createRazorpayOrder($uid, $amount);
            $this->paymentModel->updateByUid($uid, ['gateway_order_id' => $order['id'], 'status' => 'pending']);
            return ['payment' => $payment, 'gateway_order' => $order];
        }


        return ['payment' => $payment];
    }

    protected function createRazorpayOrder($merchantOrderUid, $amount)
    {
        // Razorpay expects amount in paise
        $postData = [
            'amount' => intval($amount * 100),
            'currency' => 'INR',
            'receipt' => $merchantOrderUid,
            'payment_capture' => 1
        ];
        $ch = curl_init('https://api.razorpay.com/v1/orders');
        curl_setopt($ch, CURLOPT_USERPWD, $this->razorpayKey . ':' . $this->razorpaySecret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $res = curl_exec($ch);
        $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($http !== 200 && $http !== 201) {
            throw new \Exception("Razorpay order create failed: " . $res);
        }
        return json_decode($res, true);
    }



    public function verifyRazorpaySignature(array $post)
    {
        $orderId = $post['razorpay_order_id'] ?? null;
        $paymentId = $post['razorpay_payment_id'] ?? null;
        $signature = $post['razorpay_signature'] ?? null;
        if (!$orderId || !$paymentId || !$signature) return false;

        $data = $orderId . '|' . $paymentId;
        $expectedSignature = hash_hmac('sha256', $data, $this->razorpaySecret);
        return hash_equals($expectedSignature, $signature);
    }


    public function markAsPaid(string $uid, array $gatewayResponse)
    {
        $this->paymentModel->updateByUid($uid, [
            'gateway_payment_id' => $gatewayResponse['gateway_payment_id'] ?? null,
            'status' => 'success',
            'meta' => json_encode($gatewayResponse)
        ]);
    }

    public function markAsFailed(string $uid, array $meta = [])
    {
        $this->paymentModel->updateByUid($uid, [
            'status' => 'failed',
            'meta' => json_encode($meta)
        ]);
    }

    public function getPaymentByRequestId($requestUId)
    {
        return $this->paymentModel->findByRequestId($requestUId);
    }
}
