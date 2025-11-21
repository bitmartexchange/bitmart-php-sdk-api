# 在 VSCode 中运行 PHP 示例

本指南介绍如何在 VSCode 中运行 `examples` 目录下的 PHP 示例文件。

## 方法 1: 使用终端运行（最简单）

### 步骤：

1. **打开终端**
   - 按 `` Ctrl + ` `` (Windows/Linux) 或 `` Cmd + ` `` (Mac) 打开集成终端
   - 或点击菜单：`Terminal` → `New Terminal`

2. **运行示例文件**
   ```bash
   # 进入项目根目录（如果不在的话）
   cd /bitmart-php-sdk-api
   
   # 运行示例
   php examples/futures/FuturesMarketData/GetLeverageBracket.php
   ```

3. **查看输出**
   结果会直接显示在终端中。

### 快捷方式：

在 VSCode 中，你可以：
- 右键点击 PHP 文件 → `Open in Integrated Terminal`
- 然后在终端中运行 `php 文件名.php`

## 方法 2: 使用 VSCode 任务（推荐）

### 步骤：

1. **打开命令面板**
   - 按 `Ctrl + Shift + P` (Windows/Linux) 或 `Cmd + Shift + P` (Mac)

2. **运行任务**
   - 输入 `Tasks: Run Task`
   - 选择 `Run Current PHP File`（运行当前打开的 PHP 文件）
   - 或选择其他预定义的任务，如 `Run Example: GetLeverageBracket`

3. **快捷键**
   - 按 `Ctrl + Shift + B` (Windows/Linux) 或 `Cmd + Shift + B` (Mac) 运行默认任务

### 自定义任务：

已预配置的任务在 `.vscode/tasks.json` 中，你可以：
- 添加更多示例文件的任务
- 修改现有任务的配置

## 方法 3: 使用调试功能（带断点调试）

### 前置条件：

1. **安装 PHP Debug 扩展**
   - 在 VSCode 扩展市场搜索并安装 `PHP Debug` (作者：Xdebug)

2. **安装 Xdebug**
   ```bash
   # macOS (使用 Homebrew)
   brew install php-xdebug
   
   # 或使用 pecl
   pecl install xdebug
   ```

3. **配置 PHP**
   在 `php.ini` 中添加：
   ```ini
   [xdebug]
   zend_extension=xdebug.so
   xdebug.mode=debug
   xdebug.start_with_request=yes
   xdebug.client_port=9003
   ```

### 使用步骤：

1. **设置断点**
   - 在代码行号左侧点击，设置红色断点

2. **启动调试**
   - 按 `F5` 或点击调试按钮
   - 选择 `Run Current PHP File` 配置

3. **调试控制**
   - `F5`: 继续执行
   - `F10`: 单步跳过
   - `F11`: 单步进入
   - `Shift + F11`: 单步跳出
   - `Shift + F5`: 停止调试

## 方法 4: 使用 Code Runner 扩展

### 安装扩展：

1. 在 VSCode 扩展市场搜索 `Code Runner`
2. 安装后，打开任意 PHP 文件
3. 点击右上角的运行按钮 ▶️
4. 或使用快捷键：
   - `Ctrl + Alt + N` (Windows/Linux)
   - `Control + Option + N` (Mac)

### 配置 Code Runner：

在 VSCode 设置中添加：

```json
{
    "code-runner.executorMap": {
        "php": "cd $dir && php $fileName"
    },
    "code-runner.runInTerminal": true,
    "code-runner.clearPreviousOutput": true
}
```

## 方法 5: 使用右键菜单运行

### 安装扩展：

1. 安装 `PHP Intelephense` 或 `PHP IntelliSense` 扩展
2. 右键点击 PHP 文件
3. 选择 `Run Code` 或类似选项（取决于扩展）

## 常见问题

### Q: 提示找不到 vendor/autoload.php？

**A:** 需要先安装依赖：
```bash
composer install
```

### Q: 提示找不到 PHP 命令？

**A:** 需要配置 PHP 路径：

1. 找到 PHP 安装路径：
   ```bash
   which php
   # 或
   php --version
   ```

2. 在 `.vscode/settings.json` 中配置：
   ```json
   {
       "php.validate.executablePath": "/usr/bin/php"
   }
   ```

### Q: 如何运行需要 API Key 的示例？

**A:** 需要先修改示例文件中的配置：

```php
$APIContract = new APIContractTrading(new CloudConfig([
    'url' => CloudConst::API_URL_V2_PRO,
    'accessKey' => "your_actual_api_key",  // 替换为真实值
    'secretKey' => "your_actual_secret_key",  // 替换为真实值
    'memo' => "your_actual_memo",  // 替换为真实值
]));
```

### Q: 如何批量运行多个示例？

**A:** 使用 shell 脚本：

```bash
# 运行所有 Futures Market Data 示例
for file in examples/futures/FuturesMarketData/*.php; do
    echo "Running: $file"
    php "$file"
    echo "---"
done
```

或使用已配置的任务：`Run All Examples (Futures Market Data)`

## 推荐配置

### 推荐的 VSCode 扩展：

1. **PHP Intelephense** - PHP 智能提示和代码补全
2. **PHP Debug** - Xdebug 调试支持
3. **Code Runner** - 快速运行代码
4. **PHP Namespace Resolver** - 命名空间解析

### 推荐的设置：

在 `.vscode/settings.json` 中：

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

## 快速开始

1. **打开示例文件**
   ```
   examples/futures/FuturesMarketData/GetLeverageBracket.php
   ```

2. **运行方式（任选一种）**
   - 终端：`php examples/futures/FuturesMarketData/GetLeverageBracket.php`
   - 任务：`Ctrl + Shift + B` → 选择任务
   - Code Runner：点击右上角 ▶️ 按钮
   - 调试：`F5` 启动调试

3. **查看结果**
   输出会显示在终端或调试控制台中

## 示例文件说明

### Futures Market Data（公共 API，无需认证）
- `GetContractDetails.php` - 获取合约详情
- `GetLeverageBracket.php` - 获取杠杆风险限制
- `GetMarketTrade.php` - 获取最新交易数据
- 等等...

### Futures Trading（需要 API Key）
- `SubmitOrder.php` - 提交订单
- `GetPosition.php` - 获取持仓
- `GetOrderDetail.php` - 获取订单详情
- 等等...

**注意**：需要 API Key 的示例需要先配置真实的密钥才能运行。

