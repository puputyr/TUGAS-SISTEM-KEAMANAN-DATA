<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vigenère Cipher</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #000080, #1e3c72);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .container {
            text-align: center;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
            width: 80%;
            max-width: 600px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
            resize: vertical;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            margin: 10px 5px;
            background-color: #28a745;
        }

        .output {
            margin-top: 20px;
        }

        .output h4 {
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Vigenère Cipher</h1>
        <?php
        // Vigenère cipher functions
        function vigenereEncrypt($plainText, $key) {
            $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $encryptedText = '';
            $keyIndex = 0;
            $plainTextLength = strlen($plainText);
            $keyLength = strlen($key);

            for ($i = 0; $i < $plainTextLength; $i++) {
                $plainChar = strtoupper($plainText[$i]);

                if (strpos($alphabet, $plainChar) !== false) {
                    $keyChar = strtoupper($key[$keyIndex % $keyLength]);
                    $plainIndex = strpos($alphabet, $plainChar);
                    $keyIndexValue = strpos($alphabet, $keyChar);
                    $encryptedIndex = ($plainIndex + $keyIndexValue) % strlen($alphabet);
                    $encryptedText .= $alphabet[$encryptedIndex];
                    $keyIndex++;
                } else {
                    $encryptedText .= $plainChar; // Non-alphabetic characters are added directly
                }
            }

            return $encryptedText;
        }

        function vigenereDecrypt($encryptedText, $key) {
            $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $decryptedText = '';
            $keyIndex = 0;
            $encryptedTextLength = strlen($encryptedText);
            $keyLength = strlen($key);

            for ($i = 0; $i < $encryptedTextLength; $i++) {
                $encryptedChar = strtoupper($encryptedText[$i]);

                if (strpos($alphabet, $encryptedChar) !== false) {
                    $keyChar = strtoupper($key[$keyIndex % $keyLength]);
                    $encryptedIndex = strpos($alphabet, $encryptedChar);
                    $keyIndexValue = strpos($alphabet, $keyChar);
                    $decryptedIndex = ($encryptedIndex - $keyIndexValue + strlen($alphabet)) % strlen($alphabet);
                    $decryptedText .= $alphabet[$decryptedIndex];
                    $keyIndex++;
                } else {
                    $decryptedText .= $encryptedChar; // Non-alphabetic characters are added directly
                }
            }

            return $decryptedText;
        }

        // Predefined key
        $key = "PUPUTPUPUTPUPUTPUPUTPUPUTPUPUTPUPUTPUPUTPUPUTPUPUTPUPUTPUPUTPUPUT";

        // Check if the form is submitted for encryption or decryption
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $plainText = $_POST['plain'] ?? '';
            if (isset($_POST['enkripsi'])) {
                $result = vigenereEncrypt($plainText, $key);
                $action = 'Encrypted Text';
            } elseif (isset($_POST['dekripsi'])) {
                $result = vigenereDecrypt($plainText, $key);
                $action = 'Decrypted Text';
            }
        }
        ?>

        <!-- Form input -->
        <form method="post">
            <textarea name="plain" class="form-control" rows="10" placeholder="Input Text" required></textarea>
            <div>
                <input class="btn" type="submit" name="enkripsi" value="Encrypt">
                <input class="btn" type="submit" name="dekripsi" value="Decrypt">
            </div>
        </form>

        <!-- Result display -->
        <?php if (isset($result)): ?>
            <div class="output">
                <h4><?php echo $action; ?>:</h4>
                <p><b><?php echo $result; ?></b></p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
 