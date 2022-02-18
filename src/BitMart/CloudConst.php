<?php

namespace BitMart;

class CloudConst
{

    # domain
    const API_URL_PRO = 'https://api-cloud.bitmart.com';
    const WS_URL_PRO = 'ws://ws-manager-compress.bitmart.com/api?protocol=1.1';
    const WS_URL_PRIVATE_PRO = 'wss://ws-manager-compress.bitmart.com/user?protocol=1.1';

    # http header
    const CONTENT_TYPE = 'Content-Type';
    const USER_AGENT = 'User-Agent';
    const X_BM_KEY = 'X-BM-KEY';
    const X_BM_SIGN = 'X-BM-SIGN';
    const X_BM_TIMESTAMP = 'X-BM-TIMESTAMP';

    # http header
    const APPLICATION_JSON = 'application/json';
    const VERSION = 'BitMart-PHP-SDK/1.0.3';

    const GET = "GET";
    const POST = "POST";
    const DELETE = "DELETE";

    # http response header
    const RATE_LIMIT_REMAINING = 'X-BM-RateLimit-Remaining';
    const RATE_LIMIT_LIMIT = 'X-BM-RateLimit-Limit';
    const RATE_LIMIT_RESET = 'X-BM-RateLimit-Reset';


    # system url
    const API_SYSTEM_TIME_URL = '/system/time';
    const API_SYSTEM_SERVICE_URL = '/system/service';

    # account url
    const API_ACCOUNT_CURRENCIES_URL = '/account/v1/currencies';
    const API_ACCOUNT_WALLET_URL = '/account/v1/wallet';
    const API_ACCOUNT_DEPOSIT_ADDRESS_URL = '/account/v1/deposit/address';
    const API_ACCOUNT_WITHDRAW_CHARGE_URL = '/account/v1/withdraw/charge';
    const API_ACCOUNT_WITHDRAW_APPLY_URL = '/account/v1/withdraw/apply';
    const API_ACCOUNT_DEPOSIT_WITHDRAW_HISTORY_URL = '/account/v2/deposit-withdraw/history';
    const API_ACCOUNT_DEPOSIT_WITHDRAW_DETAIL = '/account/v1/deposit-withdraw/detail';

    # spot url
    const API_SPOT_CURRENCIES_URL = '/spot/v1/currencies';
    const API_SPOT_SYMBOLS_URL = '/spot/v1/symbols';
    const API_SPOT_SYMBOLS_DETAILS_URL = '/spot/v1/symbols/details';
    const API_SPOT_TICKER_URL = '/spot/v1/ticker';
    const API_SPOT_STEPS_URL = '/spot/v1/steps';
    const API_SPOT_SYMBOLS_KLINE_URL = '/spot/v1/symbols/kline';
    const API_SPOT_SYMBOLS_BOOK_URL = '/spot/v1/symbols/book';
    const API_SPOT_SYMBOLS_TRADES_URL = '/spot/v1/symbols/trades';
    const API_SPOT_WALLET_URL = '/spot/v1/wallet';
    const API_SPOT_SUBMIT_ORDER_URL = '/spot/v1/submit_order';
    const API_SPOT_SUBMIT_BATCH_ORDER_URL = '/spot/v1/batch_orders';
    const API_SPOT_CANCEL_ORDER_URL = '/spot/v2/cancel_order';
    const API_SPOT_CANCEL_ORDERS_URL = '/spot/v1/cancel_orders';
    const API_SPOT_ORDER_DETAIL_URL = '/spot/v1/order_detail';
    const API_SPOT_ORDERS_URL = '/spot/v2/orders';
    const API_SPOT_TRADES_URL = '/spot/v1/trades';

    # contract url
    const API_CONTRACT_TICKERS_URL = '/contract/v1/tickers';

}

class Auth
{
    const __default = self::NONE;
    const NONE = 1;
    const KEYED = 2;
    const SIGNED = 3;
}