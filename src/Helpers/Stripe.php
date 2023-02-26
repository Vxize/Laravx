<?php

namespace Vxize\Lavx\Helpers;

use Illuminate\Support\Facades\Http;

class Stripe
{
    const API_BASE_URL = 'https://api.stripe.com';
    protected $private_key;

    public function construct($private_key)
    {
        $this->$private_key = $private_key;
    }

    public function createPaymentIntent($payment_data)
    {
        $response = Http::withToken($this->private_key)->post(
            self::API_BASE_URL.'/v1/payment_intents',
            $payment_data
        )->throw()->json();
    }

}
