<?php
function retrieveStatus($arrStat, $currStat)
{
    $currIndex = array_search($currStat, $arrStat);

    if($currIndex !== false) {
        $nxtIndex = ($currIndex + 1) % count($arrStat);
        return $arrStat[$nxtIndex];
    }

    return null;
}

$currStat = 'Merah';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['start_traffic_array'])) {

        $allStat = ['Merah','Kuning','Hijau'];
        $currStat = $_POST['currStat'];

        $nextStat = retrieveStatus($allStat, $currStat);

        if($nextStat) {
            $currStat = $nextStat;
        }
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
                                            <h4 style="margin-bottom: 20px;">Array Lampu Merah</h4>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Array</label>
                                                <div class="col-sm-10">
                                                    <?php if($currStat == 'Merah' || $nextStat == 'Merah'): ?>
                                                        <input type="text" class="form-control" name="currStat" value="Merah" style="background-color:red">
                                                    <?php elseif($currStat == 'Kuning' || $nextStat == 'Kuning'): ?>
                                                        <input type="text" class="form-control" name="currStat" value="Kuning" style="background-color:yellow">
                                                    <?php elseif($currStat == 'Hijau' || $nextStat == 'Hijau'): ?>
                                                        <input type="text" class="form-control" name="currStat" value="Hijau" style="background-color:green">
                                                    <?php endif; ?> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-primary" name="start_traffic_array" type="submit">Start Array</button>
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