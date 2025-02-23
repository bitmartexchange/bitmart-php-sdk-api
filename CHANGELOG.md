Changelog
=========================


### v2.2.0 Release
#### New Features
- New
  - `/contract/private/submit-trail-order` Submit Trail Order (SIGNED)
  - `/contract/private/cancel-trail-order` Cancel Trail Order (SIGNED)
  - `/contract/public/funding-rate-history` Query Funding Rate History
  - `/contract/public/transaction-history` Query Transaction History (KEYED)
  - `/contract/public/markprice-kline` Get MarkPrice K-line
  - `/account/v1/withdraw/address/list` Query Withdraw Address List (KEYED)
- Update
  - `/contract/private/submit-order` Submit Order (SIGNED): Remove the Request Parameters related replacing trail orders
  - `/contract/private/modify-plan-order` Modify Plan Order (SIGNED): Remove the Request Parameters **client_order_id**
  - `/account/v1/currencies` Get Currencies: Add the Request Parameters **startTime** And **endTime**
  - `/account/v2/deposit-withdraw/history` Get Currencies: Add the Request Parameters **currencies**

---

### v2.1.1 Release
#### Improvements
- The domain name `wss://openapi-ws.bitmart.com` will not provide Futures 1.0 Websocket services.
  Please use the domain name `wss://openapi-ws-v2.bitmart.com` to access Futures 2.0 Websocket services
- Rename `CloudConst::WS_CONTRACT_PUBLIC_URL_PRO` to `CloudConst::WS_FUTURES_PUBLIC_URL_PRO`
  and change the value from **wss://openapi-ws.bitmart.com/api?protocol=1.1** to **wss://openapi-ws-v2.bitmart.com/api?protocol=1.1**
- Rename `CloudConst::WS_CONTRACT_PRIVATE_URL_PRO` to `CloudConst::WS_FUTURES_PRIVATE_URL_PRO`
  and change the value from **wss://openapi-ws.bitmart.com/user?protocol=1.1** to **wss://openapi-ws-v2.bitmart.com/user?protocol=1.1**


---

### v2.1.0 Release
#### New Features
- New
  - `/contract/private/trade-fee-rate` Support querying trade fee rate(KEYED)
#### Improvements
- Add CloudConst::API_URL_V2_PRO=`https://api-cloud-v2.bitmart.com`
- The ping/pong mechanism of the spot websocket has been modified to support `ping` text
- Optimize websocket, add `login` function and `send` function and data return `callback` parameters
  - The login function is used for ws login subscription
  - The send function replaces the subscribe function and can be used to subscribe and unsubscribe
  - The callback parameter function allows customers to customize the callback function

---

### v2.0.0 Release
#### New Features
- New
  - `/spot/v4/batch_orders`
  - `/spot/v4/cancel_orders`
  - `/spot/v4/cancel_all`
  - `/contract/private/position-risk`
  - `/contract/private/submit-tp-sl-order`
  - `/contract/private/modify-plan-order`
  - `/contract/private/modify-preset-plan-order`
  - `/contract/private/modify-tp-sl-order`
- Updated
  - `/spot/v2/submit_order`
  - `/spot/v3/cancel_order`
  - `/account/v1/withdraw/apply`
  - `/account/v2/deposit-withdraw/history`
  - `/contract/private/submit-order`
  - `/contract/private/submit-plan-order`
- Removed
  - `/spot/v2/ticker`
  - `spot/v1/ticker_detail`
  - `/spot/v1/steps`
  - `/spot/v1/symbols/kline`
  - `/spot/v1/symbols/book`
  - `/spot/v1/symbols/trades`
  - `/spot/v2/batch_orders`
  - `/spot/v1/cancel_orders`
#### Improvements
- Support custom request headers
#### Bug Fixes

---


### v1.0.1 Release
#### New Features
##### 2023-09-12
- New endpoints for API Spot Market
  - <code>/spot/quotation/v3/tickers</code> Get Ticker of All Pairs (V3)
    <code>/spot/quotation/v3/ticker</code> Get Ticker of a Trading Pair(V3)
    <code>/spot/quotation/v3/lite-klines</code> Get Latest K-Line (V3)
    <code>/spot/quotation/v3/klines</code> Get History K-Line (V3)
    <code>/spot/quotation/v3/books</code> Get Depth(V3)
    <code>/spot/quotation/v3/trades</code> Get Recent Trades(V3)
- New endpoints for API Futures Trading
  - <code>/contract/private/submit-leverage</code>Submit Leverage (SIGNED)

---

### v1.0.0 Release
#### New Features
##### 2023-06-16
- New endpoints for Contract Market
  - <code>/contract/public/details</code>Get contract details
  - <code>/contract/public/depth</code>Get contract depth
  - <code>/contract/public/open-interest</code>Get contract open interest
  - <code>/contract/public/funding-rate</code>Get contract funding rate
  - <code>/contract/public/kline</code>Get contract kline
- New endpoints for Contract Account
  - <code>/contract/private/assets-detail</code>Get contract user assets detail
- New endpoints for Contract Trade
  - <code>/contract/private/order</code>Get contract order detail
  - <code>/contract/private/order-history</code>Get contract order history
  - <code>/contract/private/position</code>Get contract position
  - <code>/contract/private/trades</code>Get contract trades
  - <code>/contract/private/submit_order</code>Post contract submit order
  - <code>/contract/private/cancel_order</code>Post contract cancel order
  - <code>/contract/private/cancel_orders</code>Post contract batch cancel orders
- New endpoints for Spot & Margin
  - <code>/spot/v1/margin/isolated/account</code>Applicable for isolated margin account inquiries
  - <code>/spot/v1/margin/isolated/transfer</code>For fund transfers between a margin account and spot account
  - <code>/spot/v1/user_fee</code>For querying the base rate of the current user
  - <code>/spot/v1/trade_fee</code>For the actual fee rate of the trading pairs
  - <code>/spot/v1/margin/submit_order</code>Applicable for margin order placement
  - <code>/spot/v1/margin/isolated/borrow</code>Applicable to isolated margin account borrowing operations
  - <code>/spot/v1/margin/isolated/repay</code>Applicable to isolated margin account repayment operations
  - <code>/spot/v1/margin/isolated/borrow_record</code>Applicable to the inquiry of borrowing records of an isolated margin account
  - <code>/spot/v1/margin/isolated/repay_record</code>Applicable to the inquiry of repayment records of isolated margin account
  - <code>/spot/v1/margin/isolated/pairs</code>Applicable for checking the borrowing rate and borrowing amount of trading pairs


##### 2022-01-20
- Update endpoints for Spot
  - <code>/spot/v1/symbols/details</code>Add a new respond parameter trade_status, to show the trading status of a trading pair symbol.


##### 2022-01-18
- websocket public channel address<code>wss://ws-manager-compress.bitmart.com?protocol=1.1</code>will be taken down on 2022-02-28 UTC time,The new address is<code>wss://ws-manager-compress.bitmart.com/api?protocol=1.1</code>


##### 2021-11-24
- New endpoints for Spot
    - <code>/spot/v2/orders</code>Get User Order History V2
    - <code>/spot/v1/batch_orders</code>Batch Order
- Update endpoints for Spot
    - <code>/spot/v1/symbols/kline</code>Add new field 'quote_volume'
    - <code>/spot/v1/symbols/trades</code>Add optional parameter N to return the number of items, the default is up to 50 items
    - <code>/spot/v1/order_detail</code>Add new field 'unfilled_volume'
    - <code>/spot/v1/submit_order</code>The request parameter type added limit_maker and ioc order types
- New endpoints for Account
    - <code>/account/v2/deposit-withdraw/history</code>Get Deposit And Withdraw  History V2
- Update endpoints for Account
    - <code>/account/v1/wallet</code>Remove the account_type,Only respond to currency accounts; you can bring currency parameters (optional)


##### 2021-11-24
- New endpoints for Spot
  - <code>/spot/v2/orders</code>Get User Order History V2
  - <code>/spot/v1/batch_orders</code>Batch Order
- Update endpoints for Spot
  - <code>/spot/v1/symbols/kline</code>Add new field 'quote_volume'
  - <code>/spot/v1/symbols/trades</code>Add optional parameter N to return the number of items, the default is up to 50 items
  - <code>/spot/v1/order_detail</code>Add new field 'unfilled_volume'
  - <code>/spot/v1/submit_order</code>The request parameter type added limit_maker and ioc order types
- New endpoints for Account
  - <code>/account/v2/deposit-withdraw/history</code>Get Deposit And Withdraw  History V2
- Update endpoints for Account
  - <code>/account/v1/wallet</code>Remove the account_type,Only respond to currency accounts; you can bring currency parameters (optional)


##### 2021-01-19
- New endpoints for Spot WebSocket
  - Public - ticket channels
  - Public - K channel
  - Public - trading channels
  - Public - depth channels
  - Login
  - User - Trading Channel


##### 2020-09-21
- Interface Spot API `/spot/v1/symbols/book` add `size` parameter, which represents the number of depths


##### 2020-07-16
- Interface Spot API `Cancel Order` update to v2 version that is `POST https://api-cloud.bitmart.com/spot/v2/cancel_order`
- UserAgent set "BitMart-PHP-SDK/1.0.1"












