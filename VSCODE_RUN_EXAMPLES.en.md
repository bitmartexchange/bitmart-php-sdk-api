# Running PHP Examples in VSCode

This guide explains how to run PHP example files in the `examples` directory using VSCode.

## Method 1: Using Terminal (Simplest)

### Steps:

1. **Open Terminal**
   - Press `` Ctrl + ` `` (Windows/Linux) or `` Cmd + ` `` (Mac) to open integrated terminal
   - Or click menu: `Terminal` → `New Terminal`

2. **Run Example File**
   ```bash
   # Navigate to project root (if not already there)
   cd /bitmart-php-sdk-api
   
   # Run example
   php examples/futures/FuturesMarketData/GetLeverageBracket.php
   ```

3. **View Output**
   Results will be displayed directly in the terminal.

### Shortcuts:

In VSCode, you can:
- Right-click on PHP file → `Open in Integrated Terminal`
- Then run `php filename.php` in the terminal

## Method 2: Using VSCode Tasks (Recommended)

### Steps:

1. **Open Command Palette**
   - Press `Ctrl + Shift + P` (Windows/Linux) or `Cmd + Shift + P` (Mac)

2. **Run Task**
   - Type `Tasks: Run Task`
   - Select `Run Current PHP File` (runs the currently open PHP file)
   - Or select other predefined tasks, such as `Run Example: GetLeverageBracket`

3. **Keyboard Shortcut**
   - Press `Ctrl + Shift + B` (Windows/Linux) or `Cmd + Shift + B` (Mac) to run default task

### Custom Tasks:

Pre-configured tasks are in `.vscode/tasks.json`, you can:
- Add more example file tasks
- Modify existing task configurations

## Method 3: Using Debugging (With Breakpoints)

### Prerequisites:

1. **Install PHP Debug Extension**
   - Search and install `PHP Debug` (by Xdebug) in VSCode extension marketplace

2. **Install Xdebug**
   ```bash
   # macOS (using Homebrew)
   brew install php-xdebug
   
   # Or using pecl
   pecl install xdebug
   ```

3. **Configure PHP**
   Add to `php.ini`:
   ```ini
   [xdebug]
   zend_extension=xdebug.so
   xdebug.mode=debug
   xdebug.start_with_request=yes
   xdebug.client_port=9003
   ```

### Usage Steps:

1. **Set Breakpoints**
   - Click on the left side of line numbers to set red breakpoints

2. **Start Debugging**
   - Press `F5` or click debug button
   - Select `Run Current PHP File` configuration

3. **Debug Controls**
   - `F5`: Continue execution
   - `F10`: Step over
   - `F11`: Step into
   - `Shift + F11`: Step out
   - `Shift + F5`: Stop debugging

## Method 4: Using Code Runner Extension

### Install Extension:

1. Search for `Code Runner` in VSCode extension marketplace
2. After installation, open any PHP file
3. Click the run button ▶️ in the top right corner
4. Or use keyboard shortcut:
   - `Ctrl + Alt + N` (Windows/Linux)
   - `Control + Option + N` (Mac)

### Configure Code Runner:

Add to VSCode settings:

```json
{
    "code-runner.executorMap": {
        "php": "cd $dir && php $fileName"
    },
    "code-runner.runInTerminal": true,
    "code-runner.clearPreviousOutput": true
}
```

## Method 5: Using Right-Click Menu

### Install Extension:

1. Install `PHP Intelephense` or `PHP IntelliSense` extension
2. Right-click on PHP file
3. Select `Run Code` or similar option (depends on extension)

## Common Issues

### Q: Can't find vendor/autoload.php?

**A:** Need to install dependencies first:
```bash
composer install
```

### Q: Can't find PHP command?

**A:** Need to configure PHP path:

1. Find PHP installation path:
   ```bash
   which php
   # or
   php --version
   ```

2. Configure in `.vscode/settings.json`:
   ```json
   {
       "php.validate.executablePath": "/usr/bin/php"
   }
   ```

### Q: How to run examples that require API Key?

**A:** Need to modify the configuration in the example file first:

```php
$APIContract = new APIContractTrading(new CloudConfig([
    'url' => CloudConst::API_URL_V2_PRO,
    'accessKey' => "your_actual_api_key",  // Replace with real value
    'secretKey' => "your_actual_secret_key",  // Replace with real value
    'memo' => "your_actual_memo",  // Replace with real value
]));
```

### Q: How to run multiple examples in batch?

**A:** Use shell script:

```bash
# Run all Futures Market Data examples
for file in examples/futures/FuturesMarketData/*.php; do
    echo "Running: $file"
    php "$file"
    echo "---"
done
```

Or use configured task: `Run All Examples (Futures Market Data)`

## Recommended Configuration

### Recommended VSCode Extensions:

1. **PHP Intelephense** - PHP IntelliSense and code completion
2. **PHP Debug** - Xdebug debugging support
3. **Code Runner** - Quick code execution
4. **PHP Namespace Resolver** - Namespace resolution

### Recommended Settings:

In `.vscode/settings.json`:

```json
{
    "php.validate.executablePath": "/usr/bin/php",
    "php.suggest.basic": true,
    "files.associations": {
        "*.php": "php"
    },
    "editor.formatOnSave": false,
    "[php]": {
        "editor.tabSize": 4,
        "editor.insertSpaces": true
    },
    "code-runner.executorMap": {
        "php": "cd $dir && php $fileName"
    },
    "code-runner.runInTerminal": true
}
```

## Quick Start

1. **Open Example File**
   ```
   examples/futures/FuturesMarketData/GetLeverageBracket.php
   ```

2. **Run Method (Choose one)**
   - Terminal: `php examples/futures/FuturesMarketData/GetLeverageBracket.php`
   - Task: `Ctrl + Shift + B` → Select task
   - Code Runner: Click ▶️ button in top right corner
   - Debug: `F5` to start debugging

3. **View Results**
   Output will be displayed in terminal or debug console

## Example Files Description

### Futures Market Data (Public API, no authentication required)
- `GetContractDetails.php` - Get contract details
- `GetLeverageBracket.php` - Get leverage risk limits
- `GetMarketTrade.php` - Get latest trade data
- etc...

### Futures Trading (Requires API Key)
- `SubmitOrder.php` - Submit order
- `GetPosition.php` - Get position
- `GetOrderDetail.php` - Get order details
- etc...

**Note**: Examples that require API Key need to configure real keys before running.

