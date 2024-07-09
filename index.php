<?php
$server = "";
$username = "";
$password = '';
$db = '';

$conn = mysqli_connect($server, $username, $password, $db);

if (!$conn) {
    die("Connection failed. Reason: " . mysqli_connect_error());
}
echo "Connected!\n";

$endpoint = 'https://api-testnet.bybit.com/v5/market/kline?category=inverse&symbol=BTCUSD&interval=1&start=1670601600000&end=1670688000000';
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);



echo json_encode($data);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    $responseDecode = json_decode($response, true);
    $klineList = $responseDecode['result']['list'];

 

    for ($i = 0; $i < count($klineList); $i++) {
        $startTime = $klineList[$i][0];
        $openPrice = $klineList[$i][1];
        $highPrice = $klineList[$i][2];
        $lowPrice = $klineList[$i][3];
        $closePrice = $klineList[$i][4];
        $volume = $klineList[$i][5];
        $turnover = $klineList[$i][6];

        //$sql = "INSERT INTO candlesticks (startTime, openPrice, highPrice, lowPrice, closePrice, volume, turnover) VALUES ($startTime, $openPrice, $highPrice, $lowPrice, $closePrice, $volume, $turnover)";
        // Execute the statement
        if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
        }  else {
            echo "Error: " . $stmt->error . "\n";
        }
    }

    // Close the statement
  }

curl_close($ch);
mysqli_close($conn);
?>
