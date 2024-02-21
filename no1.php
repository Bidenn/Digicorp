<?php
function generateRandomStr($length = 32){
    $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($char) - 1);
        $randomString .= $char[$index];
    }
 
    return $randomString;
}

function generateNewToken($user){
    $maximum_token = 10;

    if(!isset($_SESSION['tokens'][$user])) {
        $_SESSION['tokens'][$user] = [];
    }

    $newToken = generateRandomStr();

    array_push($_SESSION['tokens'][$user], $newToken);

    if(count($_SESSION['tokens'][$user]) > $maximum_token) {
        array_shift($_SESSION['tokens'][$user]);
    }

    return $newToken;
}

function verifyToken($user, $token){
    if(isset($_SESSION['tokens'][$user])) {
        $indexing = array_search($token, $_SESSION['tokens'][$user]);

        if($indexing !== false) {
            unset($_SESSION['tokens'][$user][$indexing]);
        }
    }
    return false;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['generate_token'])){
        $user = $_POST['inputUser'];
        if($user != null) {
            $generatedToken = generateNewToken($user);
        }else {
            $generatedToken = null;
        }
    }else {
        $user = $_POST['inputUserVerification'];
        $token = $_POST['inputTokenVerification'];

        $verification = verifyToken($user, $token);

        echo $verification;

        $valid = "Token Benar";
        $invalid = "Token Salah";

        if($verification) {
            $msg = "Token Valid";
            return $msg;
        }else {
            $msg = "Token Invalid";
            return $msg;
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
                                            <h4 style="margin-bottom: 20px;">Form Input User</h4>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">User</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="inputUser">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Token</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="outputToken" value="<?php echo $generatedToken ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-primary" name="generate_token" type="submit">Generate Token</button>
                                        </div>
                                    </div>
                                </form>

                                <form method="post">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 style="margin-bottom: 20px;">Form Verifikasi Token dan User</h4>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">User</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="inputUserVerification">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Token</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="inputTokenVerification">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="verifyResult" value="<?php echo $msg ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-success" name="verify_token" type="submit">Verify</button>
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