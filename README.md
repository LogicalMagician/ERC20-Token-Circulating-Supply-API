Have you ever noticed inconsistencies in the data displayed on CoinGecko and CoinMarketCap? This is primarily due to their reliance on contract deployers to supply their own API endpoints for parsing token values. To address this issue, I've developed a straightforward solution: a simple API that performs the following tasks:

The core of this solution is a PHP script that retrieves the balance of the burn wallet and deducts it from the total supply. Each time the script is requested, it updates a text file with the current supply, overwriting the previous value.

To keep the data up-to-date, set up a cron job to periodically request the PHP script, allowing it to refresh the supply values.

With this solution, you can provide CoinMarketCap and CoinGecko with a direct URL to the text file, which will serve as the API endpoint. This enables your circulating supply to be accurately and consistently updated on both platforms.



Change CONTRACT_ADDRESS_HERE with Contract Address
Change COIN_TICKER_SYMBOL_HERE with Ticker Symbol
Change 1000000000 with Total Supply amount of your token
You should CHMOD the .txt file so only the Server can write to it
