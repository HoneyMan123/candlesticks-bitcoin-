const log = console.log;

const chartProperties = {
  width: 1500,
  height: 600,
  timeScale: {
    timeVisible: true,
    secondsVisible: false,
  }
}

const domElement = document.getElementById('tvchart');
const chart = LightweightCharts.createChart(domElement, chartProperties);
const candleSeries = chart.addCandlestickSeries();

fetch(`https://api-testnet.bybit.com/v5/market/kline?category=inverse&symbol=BTCUSD&interval=1&start=1670601600000&end=1670688000000`)
  .then(res => res.json())
  .then(response => {
    // Log the entire response to understand its structure
    log(response);
    
    // Check if the response contains the data in a nested structure
    const data =  response.result;  // Adjust this line according to the actual response structure
    if (!Array.isArray(data)) {
      throw new Error('Expected an array of data');
    }
    
    const cdata = data.map(d => {
      return {
        time: d[0] / 1000,
        open: parseFloat(d[1]),
        high: parseFloat(d[2]),
        low: parseFloat(d[3]),
        close: parseFloat(d[4])
      };
    });
    candleSeries.setData(cdata);
  })
  .catch(err => log(err));
