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

class Nilai {
    public $mapel;
    public $nilai;

    public function __construct($mapel, $nilai) 
    {
        $this->mapel = $mapel;
        $this->nilai = $nilai;
    }
}

class Siswa {
    public $nrp;
    public $nama;
    public $daftarNilai = [];

    public function __construct($nrp, $nama)
    {
        $this->nrp = $nrp;
        $this->nama = $nama;
    }

    public function insertNilai($mapel, $nilai) {
        $this->daftarNilai[] = new Nilai($mapel, $nilai);
    }
}

function inputSiswa($nrp, $nama) {
    $newSiswa = new Siswa($nrp, $nama);
    $newSiswa->insertNilai("Inggris", 100);

    return $newSiswa;
}

function generateSiswa()
{
    $siswaArray = [];

    for ($i = 0; $i < 10; $i++) {
        $namaSiswa = generateRandomStr(10);
        $mapel = ['Inggris', 'Jepang', 'Indonesia'][array_rand(['Inggris', 'Jepang', 'Indonesia'])];
        $nilai = rand(0, 100);

        $siswa = new Siswa($i + 1, $namaSiswa);
        $siswa->insertNilai($mapel, $nilai);

        $siswaArray[] = $siswa;
    }

    return $siswaArray;
}

$inputSiswa = null;
$generateSiswa = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['input_siswa'])) {

        $nrp = $_POST['inputNrp'];
        $nama = $_POST['inputSiswa'];

        $inputSiswa = inputSiswa($nrp, $nama);

    } elseif (isset($_POST['generate_siswa'])) {

        $generateSiswa = generateSiswa();
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
                                            <h4 style="margin-bottom: 20px;">Form Input Siswa Baru</h4>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">NRP</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="inputNrp">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="inputSiswa">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-primary" name="input_siswa" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>

                                <?php if($inputSiswa): ?>
                                <div class="card">
                                    <div class="card-body">
                                        <h4 style="margin-bottom: 20px;">Output Siswa Baru</h4>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">NRP</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="<?php echo $inputSiswa->nrp ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="<?php echo $inputSiswa->nama ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Mapel</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="<?php echo $inputSiswa->daftarNilai[0]->mapel ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nilai</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="<?php echo $inputSiswa->daftarNilai[0]->nilai ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>  

                                <form method="post">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 style="margin-bottom: 20px;">Generate 10 Siswa Random</h4>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-primary" name="generate_siswa" type="submit">Generate</button>
                                        </div>
                                    </div>
                                </form>

                                <div class="card">
                                    <div class="card-body">
                                        <h4 style="margin-bottom: 20px;">Result Generate 10 Siswa Random</h4>
                                        <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Mapel</th>
                                                <th scope="col">Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($generateSiswa): ?>
                                                <?php foreach($generateSiswa as $siswa): ?>
                                                    <?php foreach($siswa->daftarNilai as $nilai): ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $siswa->nrp ?></th>
                                                        <td><?php echo $siswa->nama ?></td>
                                                        <td><?php echo $nilai->mapel ?></td>
                                                        <td><?php echo $nilai->nilai ?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>                                               
                                        </tbody>
                                    </table>
                                    </div>
                                </div>

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