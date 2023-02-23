<?php
declare(strict_types=1);

namespace ATF\ExchangeRate\Model;

class ExchangerateManagement implements \ATF\ExchangeRate\Api\ExchangerateManagementInterface
{

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * api token url
     */
    const XML_PATH_API_URL = 'exchangerate/exchangerate/api_url';

    /**
     * api token path
     */
    const XML_PATH_API_TOKEN = 'exchangerate/exchangerate/token';

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function getExchangeRate(){
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $apiUrl =  $this->scopeConfig->getValue(self::XML_PATH_API_URL, $storeScope);
        $token =  $this->scopeConfig->getValue(self::XML_PATH_API_TOKEN, $storeScope);

        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$apiUrl?to=USD&from=EUR&amount=1",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "apikey: $token"
                ),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET"
            ));

            $response = curl_exec($curl);
            curl_close($curl);
        } catch (\Exception $e) {
            $response = json_encode(array('success'=> false,'message'=>'something went wrong.'));
        }
        return $response;
    }
}

