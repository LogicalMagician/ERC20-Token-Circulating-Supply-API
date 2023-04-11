<?php

function fetchRemainingTokens() {
    $url = 'https://etherscan.io/token/CONTRACT_ADDRESS_HERE?a=0x000000000000000000000000000000000000dead';
    $leftString = '<h6 class="small text-uppercase text-muted mb-1">Balance</h6>';
    $rightString = ' COIN_TICKER_SYMBOL_HERE';

    $htmlContent = file_get_contents($url);

    if ($htmlContent !== false) {
        $startPosition = strpos($htmlContent, $leftString);
        if ($startPosition !== false) {
            $startPosition += strlen($leftString);
            $endPosition = strpos($htmlContent, $rightString, $startPosition);

            if ($endPosition !== false) {
                $burnedTokens = trim(substr($htmlContent, $startPosition, $endPosition - $startPosition));
                $burnedTokens = (float) str_replace(',', '', $burnedTokens);
                $totalSupply = 1000000000;
                $remainingSupply = $totalSupply - $burnedTokens;
                return $remainingSupply;
            }
        }
    }

    return false;
}

$remainingSupply = fetchRemainingTokens();

if ($remainingSupply !== false) {
    $filename = 'supply_amount.txt';
    file_put_contents($filename, $remainingSupply);
    echo "The remaining supply has been written to $filename.";
} else {
    echo 'Error fetching the remaining supply.';
}

?>
