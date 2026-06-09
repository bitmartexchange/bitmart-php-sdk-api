# CLAUDE.md

This file gives guidance to Claude Code (claude.ai/code) when working in this repository.

## Project Overview

`bitmartexchange/bitmart-php-sdk-api` is the official BitMart Exchange PHP client for the
[BitMart Cloud API](https://developer.bitmart.com/spot). It wraps the REST endpoints and
WebSocket streams documented in the online API reference into typed PHP classes.

- Package name: `bitmartexchange/bitmart-php-sdk-api`
- PHP: `>=7.3.0 || >=8.0.0`
- Current version: `2.3.0` (see `CloudConst::VERSION`)
- License: MIT
- PSR-4 autoload: `BitMart\` → `src/BitMart`; tests `BitMart\Tests\` → `tests/`

Key dependencies:
- `guzzlehttp/guzzle ^7.5` — REST HTTP client
- `ratchet/pawl ^0.4` (+ ReactPHP event loop) — WebSocket client
- `ext-json`, `ext-zlib` (zlib is needed to gzinflate compressed WS frames)
- dev: `phpunit/phpunit ^7.5 || ^8.0`

## Common Commands

```bash
composer install                 # install dependencies
composer test                    # run PHPUnit (alias for `phpunit`)
composer test-coverage           # run with HTML coverage → build/artifacts/coverage
vendor/bin/phpunit tests/BitMart/Spot/APISpotTest.php   # run a single test file

# Run any example (examples require valid API keys for private endpoints)
php examples/spot/Market/GetTickers.php
```

PHPUnit config is in `phpunit.xml`; results are written to `tests/results/junit.xml`.
Static analysis config lives in `.phan/`.

## Architecture

The SDK has three layers: shared lib/infrastructure, REST API wrappers, and WebSocket clients.

### Core library (`src/BitMart/Lib/`)
- **`CloudConfig`** — configuration holder. Constructed from an assoc array:
  `url`, `accessKey`, `secretKey`, `memo`, `timeoutSecond` (default 5), `customHeaders`,
  `logger`. Defaults `url` to the V1 REST host. Also builds a `CloudLogger`.
- **`CloudClient`** — the single REST entry point. `request($requestPath, $method, $params, $auth)`
  builds the URL (query string for GET/DELETE, JSON body for POST), sets headers, calls Guzzle
  (`http_errors => false`), and returns a uniform array:
  `['response' => stdClass (json_decode'd), 'httpCode' => int, 'limit' => [Remaining, Limit, Reset, Mode]]`.
  On Guzzle exception it logs/echoes and returns `[]`.
- **`CloudUtil`** — `getHeader()` and `signature()`. Signature is
  `HMAC-SHA256(secretKey, "{timestamp}#{memo}#{body}")`, sent via `X-BM-SIGN` with
  `X-BM-KEY` and `X-BM-TIMESTAMP` headers.
- **`CloudWebsocket`** — abstract base for all WS clients. Manages the ReactPHP loop, auto
  reconnect, ping/pong keepalive (every 10s), gzip inflate of binary frames, and `login()`.
  Subscriptions sent via `send()` are cached in `reconnectionParam` and replayed on reconnect.
- **`CloudLogger`** — optional structured request/response logging (see
  `LOGGER_CONFIGURATION.en.md` / `.zh.md`).

### Constants (`src/BitMart/CloudConst.php`)
Central registry of **all** endpoint paths, hosts, header names, and HTTP verbs. Add new
endpoint URLs here as constants and reference them from the API classes — never hardcode paths
in the wrapper methods. Also defines the `Auth` enum: `NONE = 1`, `KEYED = 2`, `SIGNED = 3`.

Hosts:
- `API_URL_PRO` = `https://api-cloud.bitmart.com` — Spot/Account REST (V1/V2/V3 paths)
- `API_URL_V2_PRO` = `https://api-cloud-v2.bitmart.com` — Futures REST
- `WS_SPOT_PUBLIC_URL_PRO` / `WS_SPOT_PRIVATE_URL_PRO` — Spot WS
- `WS_FUTURES_PUBLIC_URL_PRO` / `WS_FUTURES_PRIVATE_URL_PRO` — Futures WS

### REST API wrappers
Each class takes a `CloudConfig` and instantiates a `CloudClient`. Every public method is a thin
wrapper over `CloudClient::request(...)` with the right path constant, verb, params, and auth level.

- **`src/BitMart/Spot/APISpot.php`** — spot market data + spot/margin trading (23 methods).
  Public market data (currencies, symbols, V3 tickers/kline/books/trades) is `Auth::NONE`;
  order placement/query (`/spot/v2`, `/spot/v3`, `/spot/v4`) is `Auth::SIGNED`.
- **`src/BitMart/Spot/APIAccount.php`** — account, wallet, deposit/withdraw, fees, isolated
  margin transfer (13 methods).
- **`src/BitMart/Spot/APIMarginLoan.php`** — isolated margin borrow/repay + records (6 methods).
- **`src/BitMart/Spot/APISystem.php`** — system time/service status (3 methods, `Auth::NONE`).
- **`src/BitMart/Futures/APIContractMarket.php`** — futures public market data (10 methods),
  uses the V2 host.
- **`src/BitMart/Futures/APIContractTrading.php`** — futures account + trading: orders, plan
  orders, TP/SL, trailing, leverage, position mode, transfers (30 methods), uses the V2 host.

### WebSocket clients (`src/BitMart/Websocket/`)
All extend `CloudWebsocket`; configured via an assoc array with `url`, `xdebug`, `callback`, `pong`
(and `accessKey`/`secretKey`/`memo` for private streams).
- `Spot/WsSpotPub` — public spot channels (no login).
- `Spot/WsSpotPrv` — private spot channels; call `login()` before subscribing.
- `Futures/WsContractPub` / `Futures/WsContractPrv` — futures equivalents.

Spot vs futures protocols differ (handled in `CloudWebsocket`): spot login uses
`{op:login,args:[key,ts,sign]}` and `ping`/`pong`; futures uses
`{action:access,args:[key,ts,sign,web]}` and `{"action":"ping"}`. The signed login string is
`HMAC-SHA256` over `"bitmart.WebSocket"`.

## Usage Patterns

REST (public):
```php
use BitMart\Lib\CloudConfig;
use BitMart\Spot\APISpot;

$api = new APISpot(new CloudConfig(['timeoutSecond' => 5]));
$response = $api->getV3Tickers()['response'];
```

REST (signed): pass `accessKey`/`secretKey`/`memo` into `CloudConfig`; for futures also set
`'url' => CloudConst::API_URL_V2_PRO`.

WebSocket (private): construct the client with keys, call `login()`, then `send()` subscription JSON.

Examples for every endpoint live under `examples/` (mirroring `spot/`, `futures/`, and each
`Market`/`Account`/`Trading`/`Websocket` group). `examples/ExampleConfig.php` and `tests/TestConfig.php`
show config construction. See `VSCODE_RUN_EXAMPLES.en.md` for running examples in VS Code.

## Conventions When Extending the SDK

1. Add the endpoint path as a constant in `CloudConst.php` (grouped by domain).
2. Add a wrapper method in the matching `API*` class with a PHPDoc block that includes the full
   `url:` line and a short description (match the existing style).
3. Choose the correct auth level: `Auth::NONE` (public), `Auth::KEYED` (key only),
   `Auth::SIGNED` (key + signature). Default in `request()` is `Auth::NONE`.
4. Return the raw `CloudClient::request(...)` array — do not unwrap `['response']` inside the SDK.
5. Add a corresponding test in `tests/BitMart/...` and an example in `examples/...`.
6. Bump `CloudConst::VERSION` and update `CHANGELOG.md` for releases.

## Notes

- Tests hit the live BitMart API and assert `['response']->code == 1000` (success) for public
  endpoints; private-endpoint tests need real credentials in `tests/TestConfig.php`.
- `APISpot` has leftover `use Binance\...` imports — harmless legacy, ignore unless cleaning up.
- The API reference (source of truth for endpoints/params): https://developer.bitmart.com/spot
