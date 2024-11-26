<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playfair Cipher</title>
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
                <h4>Playfair Cipher</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <input type="text" name="key" class="form-control" placeholder="Masukkan kunci (key)" required>
                    <input type="text" name="plaintext" class="form-control" placeholder="Masukkan teks untuk dienkripsi atau didekripsi" required>
                    <button type="submit" name="encrypt" class="btn btn-success">Encrypt</button>
                    <button type="submit" name="decrypt" class="btn btn-danger">Decrypt</button>
                </form>
            </div>
            <div class="output">
                <?php
                class PlayfairCipher {
                    private $matrix = array();
                
                    public function __construct() {
                        // Initialize the matrix with the specified values
                        $this->matrix = [
                            ['M', 'A', 'D', 'I', 'U'],
                            ['N', 'B', 'C', 'E', 'F'],
                            ['G', 'H', 'K', 'L', 'O'],
                            ['P', 'Q', 'R', 'S', 'T'],
                            ['V', 'W', 'X', 'Y', 'Z']
                        ];
                    }
                
                    private function findPosition($char) {
                        for ($i = 0; $i < 5; $i++) {
                            for ($j = 0; $j < 5; $j++) {
                                if ($this->matrix[$i][$j] == $char) {
                                    return [$i, $j];
                                }
                            }
                        }
                        // If character is not found in the matrix
                        return [null, null];
                    }
                
                    private function prepareText($text) {
                        $text = strtoupper(str_replace('J', 'I', $text));
                        $text = preg_replace('/[^A-Z]/', '', $text);
                
                        $prepared = '';
                        $len = strlen($text);
                        for ($i = 0; $i < $len; $i += 2) {
                            $first = $text[$i];
                            $second = ($i + 1 < $len) ? $text[$i + 1] : 'X';
                
                            if ($first == $second) {
                                $prepared .= $first . 'X';
                                $i--;
                            } else {
                                $prepared .= $first . $second;
                            }
                        }
                
                        if (strlen($prepared) % 2 != 0) {
                            $prepared .= 'X';
                        }
                
                        return $prepared;
                    }
                
                    public function encrypt($text) {
                        $text = $this->prepareText($text);
                        $cipher = '';
                
                        for ($i = 0; $i < strlen($text); $i += 2) {
                            [$row1, $col1] = $this->findPosition($text[$i]);
                            [$row2, $col2] = $this->findPosition($text[$i + 1]);
                
                            // Check if positions are valid
                            if (is_null($row1) || is_null($col1) || is_null($row2) || is_null($col2)) {
                                echo "<h4>Error: Character not found in key matrix</h4>";
                                return; // Stop if any character is not found
                            }
                
                            if ($row1 == $row2) {
                                $cipher .= $this->matrix[$row1][($col1 + 1) % 5];
                                $cipher .= $this->matrix[$row2][($col2 + 1) % 5];
                            } elseif ($col1 == $col2) {
                                $cipher .= $this->matrix[($row1 + 1) % 5][$col1];
                                $cipher .= $this->matrix[($row2 + 1) % 5][$col2];
                            } else {
                                $cipher .= $this->matrix[$row1][$col2];
                                $cipher .= $this->matrix[$row2][$col1];
                            }
                        }
                
                        return $cipher;
                    }
                
                    public function decrypt($cipher) {
                        $text = '';
                
                        for ($i = 0; $i < strlen($cipher); $i += 2) {
                            [$row1, $col1] = $this->findPosition($cipher[$i]);
                            [$row2, $col2] = $this->findPosition($cipher[$i + 1]);
                
                            // Check if positions are valid
                            if (is_null($row1) || is_null($col1) || is_null($row2) || is_null($col2)) {
                                echo "<h4>Error: Character not found in key matrix</h4>";
                                return; // Stop if any character is not found
                            }
                
                            if ($row1 == $row2) {
                                $text .= $this->matrix[$row1][($col1 + 4) % 5];
                                $text .= $this->matrix[$row2][($col2 + 4) % 5];
                            } elseif ($col1 == $col2) {
                                $text .= $this->matrix[($row1 + 4) % 5][$col1];
                                $text .= $this->matrix[($row2 + 4) % 5][$col2];
                            } else {
                                $text .= $this->matrix[$row1][$col2];
                                $text .= $this->matrix[$row2][$col1];
                            }
                        }
                
                        return $text;
                    }
                }
                
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $plaintext = $_POST['plaintext'];
                    $cipher = new PlayfairCipher();
                
                    if (isset($_POST['encrypt'])) {
                        $encrypted = $cipher->encrypt($plaintext);
                        echo "<h4>Encrypted Text: $encrypted</h4>";
                    }
                
                    if (isset($_POST['decrypt'])) {
                        $decrypted = $cipher->decrypt($plaintext);
                        echo "<h4>Decrypted Text: $decrypted</h4>";
                    }
                }
                ?>
                
            
</body>
</html>
