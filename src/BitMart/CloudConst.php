<?php

namespace BitMart;

class CloudConst
{

    # domain
    const API_URL_PRO = 'https://api-cloud.bitmart.com';
    const WS_SPOT_PUBLIC_URL_PRO = 'wss://ws-manager-compress.bitmart.com/api?protocol=1.1';
    const WS_SPOT_PRIVATE_URL_PRO = 'wss://ws-manager-compress.bitmart.com/user?protocol=1.1';

    const WS_CONTRACT_PUBLIC_URL_PRO = 'wss://openapi-ws.bitmart.com/api?protocol=1.1';
    const WS_CONTRACT_PRIVATE_URL_PRO = 'wss://openapi-ws.bitmart.com/user?protocol=1.1';

    # http header
    const CONTENT_TYPE = 'Content-Type';
    const USER_AGENT = 'User-Agent';
    const X_BM_KEY = 'X-BM-KEY';
    const X_BM_SIGN = 'X-BM-SIGN';
    const X_BM_TIMESTAMP = 'X-BM-TIMESTAMP';

    # http header
    const APPLICATION_JSON = 'application/json';
    const VERSION = 'BitMart-PHP-SDK-API/2.0.0';

    const GET = "GET";
    const POST = "POST";
    const DELETE = "DELETE";

    # http response header
    const RATE_LIMIT_REMAINING = 'X-BM-RateLimit-Remaining';
    const RATE_LIMIT_LIMIT = 'X-BM-RateLimit-Limit';
    const RATE_LIMIT_RESET = 'X-BM-RateLimit-Reset';
    const RATE_LIMIT_MODE = 'X-BM-RateLimit-Mode';


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
    const API_ACCOUNT_DEPOSIT_WITHDRAW_DETAIL_URL = '/account/v1/deposit-withdraw/detail';
    const API_ACCOUNT_MARGIN_ISOLATED_ACCOUNT_URL = '/spot/v1/margin/isolated/account';
    const API_ACCOUNT_MARGIN_ISOLATED_TRANSFER_URL = '/spot/v1/margin/isolated/transfer';
    const API_SPOT_USER_FEE_URL = '/spot/v1/user_fee';
    const API_SPOT_ACTUAL_TRADE_FEE_URL = '/spot/v1/trade_fee';

    # spot trading
    const API_SPOT_CURRENCIES_URL = '/spot/v1/currencies';
    const API_SPOT_SYMBOLS_URL = '/spot/v1/symbols';
    const API_SPOT_SYMBOLS_DETAILS_URL = '/spot/v1/symbols/details';
    const API_SPOT_V3_TICKERS_URL = '/spot/quotation/v3/tickers';
    const API_SPOT_V3_TICKER_URL = '/spot/quotation/v3/ticker';
    const API_SPOT_V3_LATEST_KLINE_URL = '/spot/quotation/v3/lite-klines';
    const API_SPOT_V3_HISTORY_KLINE_URL = '/spot/quotation/v3/klines';
    const API_SPOT_V3_BOOKS_URL = '/spot/quotation/v3/books';
    const API_SPOT_V3_TRADES_URL = '/spot/quotation/v3/trades';

    const API_SPOT_WALLET_URL = '/spot/v1/wallet';
    const API_SPOT_SUBMIT_ORDER_URL = '/spot/v2/submit_order';
    const API_SPOT_SUBMIT_MARGIN_ORDER_URL = '/spot/v1/margin/submit_order';
    const API_SPOT_SUBMIT_BATCH_ORDER_URL = '/spot/v4/batch_orders';
    const API_SPOT_CANCEL_ORDER_URL = '/spot/v3/cancel_order';
    const API_SPOT_CANCEL_ORDERS_URL = '/spot/v4/cancel_orders';
    const API_SPOT_CANCEL_ALL_URL = '/spot/v4/cancel_all';

    const API_SPOT_V4_QUERY_ORDER_BY_ID_URL = '/spot/v4/query/order';
    const API_SPOT_V4_QUERY_ORDER_BY_CLIENT_ID_URL = '/spot/v4/query/client-order';
    const API_SPOT_V4_QUERY_OPEN_ORDERS_URL = '/spot/v4/query/open-orders';
    const API_SPOT_V4_QUERY_HISTORY_ORDERS_URL = '/spot/v4/query/history-orders';
    const API_SPOT_V4_QUERY_TRADES_URL = '/spot/v4/query/trades';
    const API_SPOT_V4_QUERY_ORDER_TRADES_URL = '/spot/v4/query/order-trades';

    # Margin Loan
    const API_MARGIN_ISOLATED_BORROW_URL = '/spot/v1/margin/isolated/borrow';
    const API_MARGIN_ISOLATED_REPAY_URL = '/spot/v1/margin/isolated/repay';
    const API_MARGIN_ISOLATED_BORROW_RECORD_URL = '/spot/v1/margin/isolated/borrow_record';
    const API_MARGIN_ISOLATED_REPAY_RECORD_URL = '/spot/v1/margin/isolated/repay_record';
    const API_MARGIN_ISOLATED_PAIRS_URL = '/spot/v1/margin/isolated/pairs';

    # Futures
    # Futures Market Data
    const API_CONTRACT_DETAILS_URL = '/contract/public/details';
    const API_CONTRACT_DEPTH_URL = '/contract/public/depth';
    const API_CONTRACT_OPEN_INTEREST_URL = '/contract/public/open-interest';
    const API_CONTRACT_FUNDING_RATE_URL = '/contract/public/funding-rate';
    const API_CONTRACT_KLINE_URL = '/contract/public/kline';

    # Futures Account Data
    const API_CONTRACT_ASSETS_URL = '/contract/private/assets-detail';

    # Futures Trading
    const API_CONTRACT_PRV_ORDER_URL = '/contract/private/order';
    const API_CONTRACT_PRV_ORDER_HISTORY_URL = '/contract/private/order-history';
    const API_CONTRACT_PRV_OPEN_ORDERS_URL = '/contract/private/get-open-orders';
    const API_CONTRACT_PRV_CURRENT_PLAN_ORDERS_URL = '/contract/private/current-plan-order';
    const API_CONTRACT_PRV_POSITION_URL = '/contract/private/position';
    const API_CONTRACT_PRV_POSITION_RISK_URL = '/contract/private/position-risk';
    const API_CONTRACT_PRV_TRADES_URL = '/contract/private/trades';
    const API_CONTRACT_PRV_TRANSFER_LIST_URL = '/account/v1/transfer-contract-list';
    const API_CONTRACT_PRV_SUBMIT_ORDER_URL = '/contract/private/submit-order';
    const API_CONTRACT_PRV_CANCEL_ORDER_URL = '/contract/private/cancel-order';
    const API_CONTRACT_PRV_CANCEL_ALL_ORDER_URL = '/contract/private/cancel-orders';
    const API_CONTRACT_PRV_SUBMIT_PLAN_ORDER_URL = '/contract/private/submit-plan-order';
    const API_CONTRACT_PRV_CANCEL_PLAN_ORDER_URL = '/contract/private/cancel-plan-order';
    const API_CONTRACT_PRV_SUBMIT_LEVERAGE_URL = '/contract/private/submit-leverage';
    const API_CONTRACT_PRV_SUBMIT_TP_SL_ORDER_URL = '/contract/private/submit-tp-sl-order';
    const API_CONTRACT_PRV_MODIFY_PLAN_ORDER_ORDER_URL = '/contract/private/modify-plan-order';
    const API_CONTRACT_PRV_MODIFY_PRESET_PLAN_ORDER_URL = '/contract/private/modify-preset-plan-order';
    const API_CONTRACT_PRV_MODIFY_TP_SL_ORDER_ORDER_URL = '/contract/private/modify-tp-sl-order';
    const API_CONTRACT_PRV_TRANSFER_URL = '/account/v1/transfer-contract';


}

class Auth
{
    const __default = self::NONE;
    const NONE = 1;
    const KEYED = 2;
    const SIGNED = 3;
}