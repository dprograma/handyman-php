<?php

$curl = curl_init();

$request = '{
    "data":{3 items
    "details":{4 items
    "last_30_days":{5 items
    "pending":3
    "lost":795
    "total":2541
    "postponed":55
    "won":1688
    }
    "last_14_days":{5 items
    "pending":3
    "lost":363
    "total":1198
    "postponed":40
    "won":792
    }
    "yesterday":{5 items
    "pending":3
    "lost":0
    "total":4
    "postponed":0
    "won":1
    }
    "last_7_days":{5 items
    "pending":3
    "lost":180
    "total":596
    "postponed":13
    "won":400
    }
    }
    "market":"classic"
    "accuracy":{4 items
    "last_30_days":0.679822795006041
    "last_14_days":0.6857142857142857
    "yesterday":1
    "last_7_days":0.6896551724137931
    }
    }
    }';

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://football-prediction-api.p.rapidapi.com/api/v2/performance-stats?market=classic",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_POST => 1,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        "x-rapidapi-host: football-prediction-api.p.rapidapi.com",
        "x-rapidapi-key: 41834580e0msh8594be3ef36a1aap1ef98djsn72103c2c414a",
        "fixture_id: 157462",
        "content-type: application/json"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    //echo $response;

    $res = json_decode($response);
    //print_r($res);

    $yesterday = $res->data->details->yesterday;
    $last7days = $res->data->details->last_7_days;
    $last14days = $res->data->details->last_14_days;
    $last30days = $res->data->details->last_30_days;
    //print_r($yesterday);

?>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width minimum-scale=1.0 maximum-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../../assets/fontawesome/css/all.css">
        <script type="text/javascript" src="../../assets/js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../../assets/js/bootstrap.js"></script>
        <script type="text/javascript" src="../../assets/fontawesome/js/all.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
            </div>
            <div class="row">
                <div class="justify-content-center">
                    <table class="table table-md table-hover table-striped center">
                        <thead class="thead-dark text-center" style="font-size: 22px;"><tr><th colspan="5">Live Prediction</td></tr></thead>
                        <thead class="thead-dark">
                            <tr>
                                <th>Details</th>
                                <th>Last 30 days</th>
                                <th>Last 14 days</th>
                                <th>Last 7 days</th>
                                <th>Yesterday</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Pending</td>
                                <td><?php echo $last30days->pending; ?></td>
                                <td><?php echo $last14days->pending; ?></td>
                                <td><?php echo $last7days->pending; ?></td>
                                <td><?php echo $yesterday->pending ?></td>
                            </tr>
                            <tr>
                                <td>Lost</td>
                                <td><?php echo $last30days->lost; ?></td>
                                <td><?php echo $last14days->lost; ?></td>
                                <td><?php echo $last7days->lost; ?></td>
                                <td><?php echo $yesterday->lost; ?></td>
                            </tr>
                            <tr>
                                <td>Postponed</td>
                                <td><?php echo $last30days->postponed; ?></td>
                                <td><?php echo $last14days->postponed; ?></td>
                                <td><?php echo $last7days->postponed; ?></td>
                                <td><?php echo $yesterday->postponed ?></td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td><?php echo $last30days->total; ?></td>
                                <td><?php echo $last14days->total; ?></td>
                                <td><?php echo $last7days->total; ?></td>
                                <td><?php echo $yesterday->total ?></td>
                            </tr>
                            <tr>
                                <td>Won</td>
                                <td><?php echo $last30days->won; ?></td>
                                <td><?php echo $last14days->won; ?></td>
                                <td><?php echo $last7days->won; ?></td>
                                <td><?php echo $yesterday->won ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>

    </html>

<?php
}
?>