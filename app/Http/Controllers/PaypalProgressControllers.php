<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalProgressControllers extends Controller
{

    public function paypalPage($msg = null,$modeMsg='info'){
         return view('welcome',[
             'msg'=>$msg,
             'msgMode'=>$modeMsg
         ]);
    }

    public function payment()

    {

        $data = [];

        $data['items'] = [

            [

                'name' => 'ItSolutionStuff.com',

                'price' => 100,

                'desc'  => 'Description for ItSolutionStuff.com',

                'qty' => 1

            ]

        ];

        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = 100;

        $provider = new ExpressCheckout;

        $response = $provider->setExpressCheckout($data);
        $response = $provider->setExpressCheckout($data, true);

        return redirect($response['paypal_link']);

    }
    public function cancel()

    {
        session_destroy();
        ob_clean();
        $this->paypalPage('Your Pay Canceled','warning')       ;

    }
    public function success(Request $request)

    {
        $provider = new ExpressCheckout;

        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return $this->paypalPage('Your payment was successfully','success');
        }

        return $this->paypalPage('here have a Error Message','error');
    }
}
