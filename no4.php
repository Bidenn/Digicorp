<?php
function generateRandomInt(){
    $arrValue = [];

    $min = 1;
    $max = 100;
    
    for ($i = 0; $i < 5; $i++) {
        $arrValue[] = rand($min, $max);
    }
    
    return $arrValue;
}

function secondHighest()
{
    $arrValue = generateRandomInt();

    rsort($arrValue);

    $secondHigh = $arrValue[1];

    return ['arrValue' => $arrValue, 'secondHigh' => $secondHigh];
}

$arrValue = [];
$sortingInt = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['sortingInt'])) {
        $result = secondHighest();
        $arrValue = $result['arrValue'];
        $sortingInt = $result['secondHigh'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <form method="post">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 style="margin-bottom: 20px;">5 Random Integer Mendapatkan Terbesar Kedua</h4>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Hasil Array</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="<?php echo implode(', ', $arrValue) ?>" readonly>                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Terbesar Kedua</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="<?php echo $sortingInt ?>" readonly>                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-primary" name="sortingInt" type="submit">Result</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

</body>

</html>