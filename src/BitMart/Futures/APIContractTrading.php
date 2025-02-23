<?php


namespace BitMart\Futures;


use BitMart\Auth;
use BitMart\CloudConst;
use BitMart\Lib\CloudClient;
use BitMart\Lib\CloudConfig;

class APIContractTrading
{
    static $cloudClient;

    public function __construct(CloudConfig $cloudConfig)
    {
        self::$cloudClient = new CloudClient($cloudConfig);
    }


    // ----------- Private API

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/assets-detail
     * Get Contract Assets (KEYED) - Applicable for querying user contract asset details
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractAssets(): array
    {
        return self::$cloudClient->request(CloudConst::API_CONTRACT_ASSETS_URL, CloudConst::GET, [], Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/trade-fee-rate
     * Get Trade Fee Rate (KEYED) - Applicable for querying trade fee rate
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractTradeFeeRate(string $symbol): array
    {
        $params = [
            'symbol' => $symbol,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_TRADE_FEE_RATE_URL, CloudConst::GET, $params, Auth::KEYED);
    }


    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/order
     * Get Order Detail (KEYED) - Applicable for querying contract order detail
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @param string $orderId : Order ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractOrderDetail(string $symbol, string $orderId): array
    {
        $params = [
            'symbol' => $symbol,
            'order_id' => $orderId,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_ORDER_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/order-history
     * Get Order History (KEYED) - Applicable for querying contract order history
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @param array $options
     *  startTime : Start time, default is the last 7 days
     *  endTime : End time, default is the last 7 days
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractOrderHistory(string $symbol, array $options = []): array
    {
        $params = array_merge(
            [
                'symbol' => $symbol,
            ],
            $options
        );

        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_ORDER_HISTORY_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/get-open-orders
     * Get All Open Orders (KEYED) - Applicable for querying contract all open orders
     * @param array $options
     *  symbol : Symbol of the contract(like BTCUSDT)
     *  type : Order type (limit/market)
     *  orderState : Order state (all(default)/partially_filled)
     *  limit : The number of returned results, with a maximum of 100 and a default of 100
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractOpenOrders(array $options = []): array
    {
        $params = $options;
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_OPEN_ORDERS_URL, CloudConst::GET, $params, Auth::KEYED);
    }


    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/current-plan-order
     * Applicable for querying contract all plan orders
     * @param array $options
     *  symbol : Symbol of the contract(like BTCUSDT)
     *  type : Order type (limit/market)
     *  limit : The number of returned results, with a maximum of 100 and a default of 100
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractCurrentPlanOrder(array $options = []): array
    {
        $params = $options;
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_CURRENT_PLAN_ORDERS_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/position
     * Get Current Position (KEYED) - Applicable for checking the position details a specified contract
     * @param array $options
     *  symbol : Symbol of the contract(like BTCUSDT)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractPosition(array $options = []): array
    {
        $params = $options;
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_POSITION_URL, CloudConst::GET, $params, Auth::KEYED);
    }


    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/position-risk
     * Applicable for checking the position risk details a specified contract
     * @param array $options
     *  symbol : Symbol of the contract(like BTCUSDT)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractPositionRisk(array $options = []): array
    {
        $params = $options;
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_POSITION_RISK_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/trades
     * Get Order Trade (KEYED) - Applicable for querying contract order trade detail
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @param array $options
     *  startTime : Start time, default is the last 7 days
     *  endTime : End time, default is the last 7 days
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractTrades(string $symbol, array $options = []): array
    {
        $params = array_merge(
            [
                'symbol' => $symbol,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_TRADES_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/transaction-history
     * Get Transaction History (KEYED) - Applicable for querying futures transaction history
     * @param array $options
     *  symbol : Symbol of the contract
     *  flow_type : Type
                    - 0 = All (default)
                    - 1 = Transfer
                    - 2 = Realized PNL
                    - 3 = Funding Fee
                    - 4 = Commission Fee
                    - 5 = Liquidation Clearance
     *  startTime : Start time, timestamp in ms
     *  endTime : End time, timestamp in ms
     *  page_size : Default 100; max 1000
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractTransactionHistory(array $options = []): array
    {
        $params = $options;
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_TRANSACTION_HISTORY_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: POST https://api-cloud-v2.bitmart.com/account/v1/transfer-contract-list
     * Get Transfer List (SIGNED) - Query futures account transfer records
     * @param int $page : Number of pages, allowed range [1,1000]
     * @param int $limit : Number of queries, allowed range [10,100]
     * @param array $options
     *  currency : Currency (like USDT)
     *  timeStart : Start time in milliseconds, (e.g. 1681701557927)
     *  timeEnd : End time in milliseconds, (e.g. 1681701557927)
     *  recvWindow : Trade time limit, allowed range (0,60000], default: 5000 milliseconds
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractTransferList(int $page, int $limit, array $options = []): array
    {
        $params = array_merge(
            [
                'page' => $page,
                'limit' => $limit,
            ],
            $options
        );

        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_TRANSFER_LIST_URL, CloudConst::POST, $params, Auth::SIGNED);
    }


    /**
     * url: POST https://api-cloud-v2.bitmart.com/contract/private/submit-order
     * Submit Order (SIGNED) - Applicable for placing contract orders
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @param int $side : Order side
                            -1=buy_open_long
                            -2=buy_close_short
                            -3=sell_close_long
                            -4=sell_open_short
     * @param array $options :
     *  string client_order_id : Client-defined OrderId(A combination of numbers and letters, less than 32 bits)
     *  type : Order type
                -limit(default)
                -market
                -trailing
     *  leverage : Order leverage
     *  open_type : Open type, required at close position
                    -cross
                    -isolated
     *  mode : Order mode
            -1=GTC(default)
            -2=FOK
            -3=IOC
            -4=Maker Only
     *  price : Order price, required at limit order
     *  size : Order size (Number of contracts)
     *  activation_price : Activation price, required at trailing order
     *  callback_rate : Callback rate, required at trailing order, min 0.1, max 5 where 1 for 1%
     *  activation_price_type : Activation price type, required at trailing order
                        -1=last_price
                        -2=fair_price
     *  preset_take_profit_price_type : Pre-set TP price type
                        -1=last_price(default)
                        -2=fair_price
     *  preset_stop_loss_price_type : Pre-set SL price type
                            -1=last_price(default)
                            -2=fair_price
     *  preset_take_profit_price : Pre-set TP price
     *  preset_stop_loss_price : Pre-set SL price
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function submitOrder(string $symbol, int $side, array $options = []): array
    {
        $params = array_merge(
            [
                'symbol' => $symbol,
                'side' => $side,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_SUBMIT_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }


    /**
     * url: POST https://api-cloud-v2.bitmart.com/contract/private/cancel-order
     * Cancel Order (SIGNED) - Applicable for canceling a specific contract order
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @param string $orderId : Order ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function cancelOrder(string $symbol, string $orderId): array
    {
        $params = [
            'symbol' => $symbol,
            'order_id' => $orderId,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_CANCEL_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud-v2.bitmart.com/contract/private/cancel-orders
     * Cancel All Orders (SIGNED) - Applicable for batch order cancellation under a particular contract
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function cancelAllOrder(string $symbol): array
    {
        $params = [
            'symbol' => $symbol,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_CANCEL_ALL_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud-v2.bitmart.com/contract/private/submit-plan-order
     * Submit Plan Order (SIGNED) - Applicable for placing contract plan orders
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @param int $side : Order side
                        -1=buy_open_long
                        -2=buy_close_short
                        -3=sell_close_long
                        -4=sell_open_short
     * @param array $options
     *  type : Order type
                    -limit(default)
                    -market
                    -take_profit
                    -stop_loss
     *  leverage : Order leverage
     *  open_type : Open type, required at close position
                -cross
                -isolated
     *  mode : Order mode
                -1=GTC(default)
                -2=FOK
                -3=IOC
                -4=Maker Only
     *  price : Order price, required at limit order
     *  trigger_price : Trigger price
     *  executive_price : Execution price for plan order, mandatory when type = limit
     *  price_way : Price way
                    -1=price_way_long
                    -2=price_way_short
     *  price_type : Trigger price type
                    -1=last_price
                    -2=fair_price
     *  plan_category : TP/SL type
                        -1=TP/SL
                        -2=Position TP/SL
     *  preset_take_profit_price_type : Pre-set TP price type
                                        -1=last_price(default)
                                        -2=fair_price
     *  preset_stop_loss_price_type : Pre-set SL price type
                                    -1=last_price(default)
                                    -2=fair_price
     *  preset_take_profit_price : Pre-set TP price
     *  preset_stop_loss_price : Pre-set SL price
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function submitPlanOrder(string $symbol, int $side, array $options = []): array
    {
        $params = array_merge(
            [
                'symbol' => $symbol,
                'side' => $side,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_SUBMIT_PLAN_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud-v2.bitmart.com/contract/private/cancel-plan-order
     * Cancel Plan Order (SIGNED) - Applicable for canceling a specific contract plan order
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @param string $orderId : Order ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function cancelPlanOrder(string $symbol, string $orderId): array
    {
        $params = [
            'symbol' => $symbol,
            'order_id' => $orderId,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_CANCEL_PLAN_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud-v2.bitmart.com/account/v1/transfer-contract
     * Transfer (SIGNED) - Transfer between spot account and contract account
     * @param string $currency : Currency (Only USDT is supported)
     * @param string $amount : Transfer amount，allowed range[0.01,10000000000]
     * @param string $type : Transfer type(spot_to_contract/contract_to_spot)
     * @param array $options
     *  recvWindow : Trade time limit, allowed range (0,60000], default: 5000 milliseconds
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function transfer(string $currency, string $amount, string $type, array $options = []): array
    {
        $params = array_merge(
            [
                'currency' => $currency,
                'amount' => $amount,
                'type' => $type,
            ],
            $options
        );

        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_TRANSFER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud-v2.bitmart.com/contract/private/submit-leverage
     * Submit Leverage (SIGNED) - Applicable for adjust contract leverage
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @param string $leverage : Order leverage
     * @param string $open_type : Open type, required at close position
                                -cross
                                -isolated
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function submitLeverage(string $symbol, string $open_type, $leverage): array
    {
        $params = [
            'symbol' => $symbol,
            'open_type' => $open_type,
        ];

        if ($leverage) {
            $params["leverage"] = $leverage;
        }

        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_SUBMIT_LEVERAGE_URL, CloudConst::POST, $params, Auth::SIGNED);
    }


    /**
     * Applicable for placing contract TP or SL orders
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @param string $type : Order type
                            -take_profit
                            -stop_loss
     * @param int $side : Order side
                    -2=buy_close_short
                    -3=sell_close_long
     * @param array $options
     *  size : Order size (Number of contracts) Default the size of position
     *  trigger_price : Trigger price
     *  executive_price : Execution price
     *  price_type : Trigger price type
                    -1=last_price
                    -2=fair_price
     *  plan_category : TP/SL type
                        -1=TP/SL(default)
                        -2=Position TP/SL
     *  client_order_id : Client order ID
     *  category : Trigger order type, position TP/SL default market
                -limit
                -market
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function submitTPOrSLOrder(string $symbol, string $type, int $side, array $options = []): array
    {
        $params = array_merge(
            [
                'symbol' => $symbol,
                'type' => $type,
                'side' => $side,
            ],
            $options
        );

        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_SUBMIT_TP_SL_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * Applicable for modifying contract plan orders
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @param array $options
     *  order_id : Order ID(order_id or client_order_id must give one)
     *  client_order_id: Client order ID(order_id or client_order_id must give one)
     *  trigger_price : Trigger price
     *  executive_price : Execution price for plan order, mandatory when type = limit
     *  price_type : Trigger price type
                    -1=last_price
                    -2=fair_price
     *  type : Order type
                -limit
                -market
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function modifyPlanOrder(string $symbol, array $options = []): array
    {
        $params = array_merge(
            [
                'symbol' => $symbol,
            ],
            $options
        );

        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_MODIFY_PLAN_ORDER_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * POST: /contract/private/modify-preset-plan-order
     * Applicable for modifying contract preset plan orders
     *
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @param array $options
     *  order_id : Order ID
     *  preset_take_profit_price_type : Pre-set TP price type
                                        -1=last_price(default)
                                        -2=fair_price
     *  preset_stop_loss_price_type : Pre-set SL price type
                                    -1=last_price(default)
                                    -2=fair_price
     *  preset_take_profit_price : Pre-set TP price
     *  preset_stop_loss_price : Pre-set SL price
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function modifyPresetPlanOrder(string $symbol, array $options = []): array
    {
        $params = array_merge(
            [
                'symbol' => $symbol,
            ],
            $options
        );

        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_MODIFY_PRESET_PLAN_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * POST: /contract/private/modify-tp-sl-order
     * Applicable for modifying TP/SL orders
     *
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @param array $options
     *  order_id : Order ID
     *  client_order_id : Client order ID(order_id or client_order_id must give one)
     *  trigger_price : Trigger price
     *  executive_price : Execution price for order, mandatory when plan_category = 1
     *  price_type : Trigger price type
                    -1=last_price
                    -2=fair_price
     * plan_category : TP/SL type
                        -1=TP/SL
                        -2=Position TP/SL
     * category : Order type, Position TP/SL default market
                        -limit
                        -market
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function modifyTpSlOrder(string $symbol, array $options = []): array
    {
        $params = array_merge(
            [
                'symbol' => $symbol,
            ],
            $options
        );

        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_MODIFY_TP_SL_ORDER_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }


    /**
     * url: POST https://api-cloud-v2.bitmart.com/contract/private/submit-trail-order
     * Submit Trail Order (SIGNED) - Applicable for placing contract trail orders
     * @param array $options :
     * string $symbol : Symbol of the contract(like BTCUSDT)
     * int $side : Order side
                -1=buy_open_long
                -2=buy_close_short
                -3=sell_close_long
                -4=sell_open_short
     *  leverage : Order leverage
     *  open_type : Open type, required at close position
            -cross
            -isolated
     *  size : Order size (Number of contracts)
     *  activation_price : Activation price, required at trailing order
     *  callback_rate : Callback rate, required at trailing order, min 0.1, max 5 where 1 for 1%
     *  activation_price_type : Activation price type, required at trailing order
            -1=last_price
            -2=fair_price
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function submitTrailOrder(array $options = []): array
    {
        $params = $options;
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_SUBMIT_TRAIL_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }


    /**
     * url: POST https://api-cloud-v2.bitmart.com/contract/private/cancel-trail-order
     * Cancel Trail Order (SIGNED) - Applicable for canceling a specific contract trail order
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @param array $options :
     *  order_id : Order ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function cancelTrailOrder(string $symbol, array $options = []): array
    {
        $params = array_merge(
            [
                'symbol' => $symbol,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_CANCEL_TRAIL_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

}