<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Enkripsi dan Dekripsi</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Enkripsi dan Dekripsi</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="teks">Masukkan Sandi:</label>
                <textarea class="form-control" name="teks" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="program">Pilih Program:</label>
                <select class="form-control" name="program">
                    <option value="enkripsi">Enkripsi</option>
                    <option value="dekripsi">Dekripsi</option>
                </select>

            </div>
            <button type="submit" class="btn btn-primary">Proses</button>
        </form>

        <?php
        // Fungsi untuk mengenkripsi teks
        function enkripsi($teks, $tabelSubstitusi) {
            $teksTerenkripsi = strtr($teks, $tabelSubstitusi);
            return $teksTerenkripsi;
        }

        // Fungsi untuk mendekripsi teks
        function dekripsi($teksTerenkripsi, $tabelSubstitusi) {
            $teksAsli = strtr($teksTerenkripsi, array_flip($tabelSubstitusi));
            return $teksAsli;
        }

        // Tabel substitusi (tambahkan karakter dan perubahannya sesuai keinginan)
        $tabelSubstitusi = array(
            'a' => '~', 'i' => '$', 'u' => '^', 'e' => '#', 'o' => '+',
            'A' => '!', 'I' => '%', 'U' => '_', 'E' => '=', 'O' => '*',
            '1' => '<', '2' => '>', '3' => '(', '4' => ')', '5' => '-',
            '6' => '@', '7' => '.', '8' => '[', '9' => ']', '0' => '`' 
            // Tambahkan karakter dan perubahannya di sini
        );

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $teks = $_POST["teks"];
            $operasi = $_POST["program"];

            if ($operasi == "enkripsi") {
                $teksTerenkripsi = enkripsi($teks, $tabelSubstitusi);
                echo '<div class="mt-3"><strong>Hasil Enkripsi:</strong><br>' . $teksTerenkripsi . '</div>';
            } elseif ($operasi == "dekripsi") {
                $teksAsli = dekripsi($teks, $tabelSubstitusi);
                echo '<div class="mt-3"><strong>Hasil Dekripsi:</strong><br>' . $teksAsli . '</div>';
            }
        }
        ?>
    </div>
</body>
</html>