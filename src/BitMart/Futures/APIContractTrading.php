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
     * @param array $options
     *  account : Account type (futures/copy_trading)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractOrderDetail(string $symbol, string $orderId, array $options = []): array
    {
        $params = array_merge(
            [
                'symbol' => $symbol,
                'order_id' => $orderId,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_ORDER_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/order-history
     * Get Order History (KEYED) - Applicable for querying contract order history
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @param array $options
     *  account : Account type (futures/copy_trading)
     *  order_id : Order ID
     *  client_order_id : Client Order ID
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
     *  account : Account type (futures/copy_trading)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractPosition(array $options = []): array
    {
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_POSITION_URL, CloudConst::GET, $options, Auth::KEYED);
    }


    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/position-risk
     * Applicable for checking the position risk details a specified contract
     * @param array $options
     *  symbol : Symbol of the contract(like BTCUSDT)
     *  account : Account type (futures/copy_trading)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractPositionRisk(array $options = []): array
    {
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_POSITION_RISK_URL, CloudConst::GET, $options, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/trades
     * Get Order Trade (KEYED) - Applicable for querying contract order trade detail
     * @param array $options
     *  symbol : Symbol of the contract(like BTCUSDT), optional
     *  account : Account type (futures/copy_trading)
     *  startTime : Start time, default is the last 7 days
     *  endTime : End time, default is the last 7 days
     *  order_id : Order ID
     *  client_order_id : Client Order ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractTrades(array $options = []): array
    {
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_TRADES_URL, CloudConst::GET, $options, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/transaction-history
     * Get Transaction History (KEYED) - Applicable for querying futures transaction history
     * @param array $options
     *  account : Account type (futures/copy_trading)
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
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_TRANSACTION_HISTORY_URL, CloudConst::GET, $options, Auth::KEYED);
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
     *  stp_mode : Self-Trade Prevention mode
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

    /**
     * url: POST https://api-cloud-v2.bitmart.com/contract/private/modify-limit-order
     * Modify Limit Order (SIGNED) - Applicable for modifying futures limit orders
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @param array $options
     *  order_id : Order ID
     *  client_order_id : Client Order ID (order_id or client_order_id must give one)
     *  price : Order price
     *  size : Order size (Number of contracts)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function modifyLimitOrder(string $symbol, array $options = []): array
    {
        $params = array_merge(
            [
                'symbol' => $symbol,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_MODIFY_LIMIT_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud-v2.bitmart.com/contract/private/cancel-all-after
     * Timed Cancel All Orders (SIGNED) - Applicable for canceling all futures orders timed
     * @param string $symbol : Symbol of the contract(like BTCUSDT)
     * @param int $timeout : Timeout in seconds, 0 means cancel the timed cancel all orders
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function cancelAllAfter(string $symbol, int $timeout): array
    {
        $params = [
            'symbol' => $symbol,
            'timeout' => $timeout,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_CANCEL_ALL_AFTER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/get-position-mode
     * Get Position Mode (KEYED) - Applicable for getting position mode
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getPositionMode(): array
    {
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_GET_POSITION_MODE_URL, CloudConst::GET, [], Auth::KEYED);
    }

    /**
     * url: POST https://api-cloud-v2.bitmart.com/contract/private/set-position-mode
     * Set Position Mode (SIGNED) - Applicable for setting position mode
     * @param string $positionMode : Position mode (one_way_mode/hedge_mode)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function setPositionMode(string $positionMode): array
    {
        $params = [
            'position_mode' => $positionMode,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_SET_POSITION_MODE_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/position-v2
     * Get Current Position V2 (KEYED) - Applicable for checking the position details a specified contract
     * @param array $options
     *  symbol : Symbol of the contract(like BTCUSDT), optional
     *  account : Account type (futures/copy_trading)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractPositionV2(array $options = []): array
    {
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_POSITION_V2_URL, CloudConst::GET, $options, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/auto_repayment
     * Get Auto Repayment Record (KEYED) - Applicable for querying cross collateral auto repayment records
     * @param array $options
     *  start_time : Start time (timestamp in seconds)
     *  end_time : End time (timestamp in seconds)
     *  page : Current page
     *  size : Query size
     *  from_coin_code : Repayment currency (like USDT)
     *  type : Repayment type (like AUTO_REPAY)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractAutoRepayment(array $options = []): array
    {
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_AUTO_REPAYMENT_URL, CloudConst::GET, $options, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/cross_collateral/interest_log
     * Get Cross Collateral Interest Log (KEYED) - Applicable for querying cross collateral interest accrual logs
     * @param array $options
     *  start_time : Start time (timestamp in seconds)
     *  end_time : End time (timestamp in seconds)
     *  page : Current page
     *  size : Query size
     *  coin_code : Currency (like USDT)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractInterestLog(array $options = []): array
    {
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_INTEREST_LOG_URL, CloudConst::GET, $options, Auth::KEYED);
    }

    /**
     * url: POST https://api-cloud-v2.bitmart.com/contract/private/claim
     * Claim Demo Assets (SIGNED) - Applicable for claiming demo trading assets, no real assets required
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function claim(): array
    {
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_CLAIM_URL, CloudConst::POST, [], Auth::SIGNED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/affiliate/aff-customer-info
     * Get Invited User Contract Account Info (KEYED) - Applicable for affiliates to query an invited user's contract account info
     * @param $userId : The invited user ID to query
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getAffiliateCustomerInfo($userId): array
    {
        $params = [
            'userId' => $userId,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_AFFILIATE_CUSTOMER_INFO_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/affiliate/deposit-withdrawal-list
     * Get Invited User Deposit/Withdrawal List (KEYED) - Applicable for affiliates to query an invited user's deposit/withdrawal records
     * @param int $page : Page number
     * @param int $size : Records per page (max 50)
     * @param $cid : The user CID to query
     * @param $startTime : Start time (timestamp in seconds)
     * @param $endTime : End time (timestamp in seconds), max interval 60 days
     * @param array $options
     *  type : Type (1=deposit, 2=withdrawal)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getAffiliateDepositWithdrawalList(int $page, int $size, $cid, $startTime, $endTime, array $options = []): array
    {
        $params = array_merge(
            [
                'page' => $page,
                'size' => $size,
                'cid' => $cid,
                'start_time' => $startTime,
                'end_time' => $endTime,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_AFFILIATE_DEPOSIT_WITHDRAWAL_LIST_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/affiliate/rebate-inviteUser
     * Get Invited Customer List (KEYED) - Applicable for affiliates to query the invited user rebate list
     * @param $startTime : Start time (timestamp in seconds)
     * @param $endTime : End time (timestamp in seconds), max interval 60 days
     * @param int $page : Current page
     * @param int $size : Records per page (max 50)
     * @param array $options
     *  cid : The user CID to query
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getAffiliateRebateInviteUser($startTime, $endTime, int $page, int $size, array $options = []): array
    {
        $params = array_merge(
            [
                'start_time' => $startTime,
                'end_time' => $endTime,
                'page' => $page,
                'size' => $size,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_AFFILIATE_REBATE_INVITE_USER_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/affiliate/invite-check
     * Check Invited User (KEYED) - Applicable for affiliates to check whether a user is an invited user
     * @param $cid : The user CID to query
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getAffiliateInviteCheck($cid): array
    {
        $params = [
            'cid' => $cid,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_AFFILIATE_INVITE_CHECK_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/affiliate/rebate-user
     * Get Single User Rebate (KEYED) - Applicable for affiliates to query the rebate of a single invited user
     * @param $cid : The user CID to query
     * @param $startTime : Start time (timestamp in seconds)
     * @param $endTime : End time (timestamp in seconds), max interval 60 days
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getAffiliateRebateUser($cid, $startTime, $endTime): array
    {
        $params = [
            'cid' => $cid,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_AFFILIATE_REBATE_USER_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/affiliate/rebate-api
     * Get Single API User Rebate (KEYED) - Applicable for affiliates to query the API rebate of a single invited user
     * @param $cid : The user CID to query
     * @param $startTime : Start time (timestamp in seconds)
     * @param $endTime : End time (timestamp in seconds), max interval 60 days
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getAffiliateRebateApi($cid, $startTime, $endTime): array
    {
        $params = [
            'cid' => $cid,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_AFFILIATE_REBATE_API_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/affiliate/rebate-list
     * Get Rebate List (KEYED) - Applicable for affiliates to query the rebate records list
     * @param int $page : Page number
     * @param int $size : Records per page
     * @param string $currency : Query currency
     * @param array $options
     *  user_id : The user ID to query
     *  rebate_start_time : Rebate start time (timestamp in seconds)
     *  rebate_end_time : Rebate end time (timestamp in seconds)
     *  register_start_time : Register start time (timestamp in seconds)
     *  register_end_time : Register end time (timestamp in seconds)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getAffiliateRebateList(int $page, int $size, string $currency, array $options = []): array
    {
        $params = array_merge(
            [
                'page' => $page,
                'size' => $size,
                'currency' => $currency,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_AFFILIATE_REBATE_LIST_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/contract/private/affiliate/trade-list
     * Get Trade List (KEYED) - Applicable for affiliates to query an invited user's trade records
     * @param $userId : The user ID to query
     * @param int $type : Query type
     *                    -1=USDT-M
     *                    -2=Coin-M
     * @param int $page : Page number
     * @param int $size : Records per page
     * @param array $options
     *  start_time : Start time (timestamp in seconds)
     *  end_time : End time (timestamp in seconds)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getAffiliateTradeList($userId, int $type, int $page, int $size, array $options = []): array
    {
        $params = array_merge(
            [
                'user_id' => $userId,
                'type' => $type,
                'page' => $page,
                'size' => $size,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_AFFILIATE_TRADE_LIST_URL, CloudConst::GET, $params, Auth::KEYED);
    }

}