<?php
declare(strict_types=1);

namespace ATF\FreeGeoIp\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Country extends AbstractHelper
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * api token url
     */
    const XML_PATH_API_URL = 'geoip/geoip/api_url';

    /**
     * api token path
     */
    const XML_PATH_API_TOKEN = 'geoip/geoip/token';

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $apiUrl =  $this->scopeConfig->getValue(self::XML_PATH_API_URL, $storeScope);
        $token =  $this->scopeConfig->getValue(self::XML_PATH_API_TOKEN, $storeScope);

        try {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$apiUrl/49.36.235.33",
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
            $data = json_decode($response,true);
            $country = isset($data['country_name']) ? $data['country_name'] :'';
            return $country;
        } catch (\Exception $e) {
            $country = '';
        }
        return $country;
    }
}

