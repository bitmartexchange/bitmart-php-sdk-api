Changelog
=========================


###### 2023-06-16
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

---

###### 2022-01-20
- Update endpoints for Spot
  - <code>/spot/v1/symbols/details</code>Add a new respond parameter trade_status, to show the trading status of a trading pair symbol.

---

###### 2022-01-18
- websocket public channel address<code>wss://ws-manager-compress.bitmart.com?protocol=1.1</code>will be taken down on 2022-02-28 UTC time,The new address is<code>wss://ws-manager-compress.bitmart.com/api?protocol=1.1</code>


---

###### 2021-11-24
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


---


###### 2021-11-24
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


---

###### 2021-01-19
- New endpoints for Spot WebSocket
  - Public - ticket channels
  - Public - K channel
  - Public - trading channels
  - Public - depth channels
  - Login
  - User - Trading Channel


---

###### 2020-09-21
- Interface Spot API `/spot/v1/symbols/book` add `size` parameter, which represents the number of depths


---

###### 2020-07-16
- Interface Spot API `Cancel Order` update to v2 version that is `POST https://api-cloud.bitmart.com/spot/v2/cancel_order`
- UserAgent set "BitMart-PHP-SDK/1.0.1"











