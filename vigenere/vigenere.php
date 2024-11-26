<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vigenere Cipher</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #000080, #1e3c72);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes twinkle {
            0% {
                opacity: 0.5;
            }
            50% {
                opacity: 1;
            }
            100% {
                opacity: 0.5;
            }
        }

        .container {
            text-align: center;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
            animation: twinkle 2s infinite ease-in-out;
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
        }

        .card-header h4 {
            color: white;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            margin: 10px 5px;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .output {
            margin-top: 20px;
        }

        .output h4 {
            color: white;
        }

        table {
            width: 100%;
            text-align: left;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4><b>VIGENERE CIPHER</b></h4>
            </div>
            <div class="card-body">
                <?php
                // Fungsi untuk enkripsi karakter
                function vigenere_cipher($char, $key_char, $encrypt = true)
                {
                    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $char = strtoupper($char);
                    $key_char = strtoupper($key_char);

                    if (ctype_alpha($char)) {
                        $char_pos = strpos($alphabet, $char);
                        $key_pos = strpos($alphabet, $key_char);

                        if ($encrypt) {
                            // Enkripsi
                            $new_pos = ($char_pos + $key_pos) % 26;
                        } else {
                            // Dekripsi
                            $new_pos = ($char_pos - $key_pos + 26) % 26;
                        }

                        return $alphabet[$new_pos];
                    } else {
                        return $char; // Mengembalikan karakter non-alphabet apa adanya
                    }
                }

                // Fungsi untuk enkripsi teks
                function vigenere_encrypt($input, $key)
                {
                    $output = "";
                    $key_len = strlen($key);
                    $input = strtoupper($input);
                    $key = strtoupper($key);

                    $key_index = 0;

                    foreach (str_split($input) as $char) {
                        if (ctype_alpha($char)) {
                            $output .= vigenere_cipher($char, $key[$key_index % $key_len]);
                            $key_index++;
                        } else {
                            $output .= $char;
                        }
                    }
                    return $output;
                }

                // Fungsi untuk dekripsi teks
                function vigenere_decrypt($input, $key)
                {
                    $output = "";
                    $key_len = strlen($key);
                    $input = strtoupper($input);
                    $key = strtoupper($key);

                    $key_index = 0;

                    foreach (str_split($input) as $char) {
                        if (ctype_alpha($char)) {
                            $output .= vigenere_cipher($char, $key[$key_index % $key_len], false);
                            $key_index++;
                        } else {
                            $output .= $char;
                        }
                    }
                    return $output;
                }

                // Cek apakah tombol enkripsi atau dekripsi ditekan
                if (isset($_POST['enkripsi'])) {
                    $hasil = vigenere_encrypt($_POST['plain'], $_POST['key']);
                } else if (isset($_POST['dekripsi'])) {
                    $hasil = vigenere_decrypt($_POST['plain'], $_POST['key']);
                }
                ?>

                <!-- Form input -->
                <form name="vigenere" method="post">
                    <div class="input-group">
                        <input type="text" name="plain" class="form-control" placeholder="Input Text">
                    </div>
                    <div class="input-group">
                        <input type="text" name="key" class="form-control" placeholder="Input Key (Word)">
                    </div>
                    <div class="box-footer">
                        <input class="btn btn-success" type="submit" name="enkripsi" value="Enkripsi">
                        <input class="btn btn-danger" type="submit" name="dekripsi" value="Dekripsi">
                    </div>
                </form>
            </div>
            <!-- Bagian hasil enkripsi/dekripsi -->
            <div class="card-header output">
                <h4><b>HASIL</b></h4>
            </div>
            <div class="card-body result">
                <table>
                    <tr>
                        <td>Output yang dihasilkan:</td>
                        <td><b><?php if (isset($hasil)) {
                            echo $hasil;
                        } ?></b></td>
                    </tr>
                    <tr>
                        <td>Text yang dimasukkan:</td>
                        <td><b><?php if (isset($_POST['plain'])) {
                            echo strtoupper($_POST['plain']);
                        } ?></b></td>
                    </tr>
                    <tr>
                        <td>Key:</td>
                        <td><b><?php if (isset($_POST['key'])) {
                            echo strtoupper($_POST['key']);
                        } ?></b></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
