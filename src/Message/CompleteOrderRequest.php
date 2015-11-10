<?php

namespace Omnipay\WechatPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class CompleteOrderRequest extends BaseAbstractRequest{

    protected function validateData(){

        $this->validate(
            'key',
            'request_params'
        );

        $this->validateRequestParams();
    }

    public function validateRequestParam(){

        $request_params = $this->getRequestParams();

        foreach (func_get_args() as $key) {

            if ( !array_key_exists( $key, $request_params ) ) {

                throw new InvalidRequestException("The request_params.$key parameter is required");
            }
        }
    }

    public function validateRequestParams(){

        $request_params = $this->getRequestParams();

        $this->validateRequestParam( 'return_code' );

        if ( $request_params['return_code'] == 'SUCCESS' ){

            $this->validateRequestParam(
                'appid',
                'mch_id',
                'nonce_str',
                'sign',
                'result_code',
                'openid',
                'trade_type',
                'bank_type',
                'total_fee',
                'cash_fee',
                'transaction_id',
                'out_trade_no',
                'time_end'
            );
        }
    }

    public function getRequestParam( $key ){

        return $this->getParameter( 'request_params' )[ $key ];
    }

    public function getRequestParams(){

        return $this->getParameter( 'request_params' );
    }

    public function getData(){

        $this->validateData();

        return $this->getParameters();
    }

    public function sendData( $data ){

        return $this->response = new CompleteOrderResponse( $this, $data );
    }
}
