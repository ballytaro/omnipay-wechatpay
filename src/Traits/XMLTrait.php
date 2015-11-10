<?php

namespace Omnipay\WechatPay\Traits;

trait XMLTrait{

    /**
     * Extract from Wechat official sdk and modify it
     * 
     * @param   array   $target
     * @return  string
     */
    protected function convertArrayToXml( $target ){

        $xml = "<xml>";
        
        foreach ( $target as $key => $val ){

            if ( is_numeric( $val ) ){

                $xml.="<".$key.">".$val."</".$key.">";
            }
            else{

                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }

        $xml .= "</xml>";

        return $xml; 
    }

    /**
     * Convert xml to array 
     *
     * @param   string  $xml
     * @return  array
     */
    protected function convertXmlToArray( $xml ){

        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }
}
