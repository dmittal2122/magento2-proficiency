<?php
declare(strict_types=1);

namespace ATF\ExchangeRate\Api;

interface ExchangerateManagementInterface
{

    /**
     * GET for exchangerate api
     * @param string $param
     * @return string
     */
    public function getExchangerate();
}

