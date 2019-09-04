# Line-Message-Bot 串接匯率

## 安裝
1. clone 到你想要的路徑
    ```bash
    git clone https://github.com/hansamlin/Line-Message-Bot.git
    ```

2. 使用composer安裝套件庫
   ```bash
   composer install 
   ```
   
3. 建立.env
    ```bash
    cp .env.example .env
    ```

4. 從line developers取得channel access token跟channel serect
    ```
    LINE_CHANNEL_ACCESS_TOKEN={Channel access token}
    LINE_CHANNEL_SECRET={Channel serect}
    ```

5. 在line developers的channel setting設定Webhook URL(replyMessage使用)

## 資料來源
* 黃金匯率：https://goldprice.org/zh-hant
* 貨幣匯率：https://tw.rter.info/howto_currencyapi.php


