<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vigenère Cipher Encryption/Decryption</title>
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
        <form method="POST">
            <textarea name="inputText" class="form-control" placeholder="Enter text here..." required></textarea>
            <button type="submit" name="encrypt" class="btn">Encrypt</button>
            <button type="submit" name="decrypt" class="btn">Decrypt</button>
        </form>
        <div class="output">
            <?php
            // Custom key mapping
            $customKey = [
                'A' => 'P', 'B' => 'U', 'C' => 'T', 'D' => 'A',
                'E' => 'B', 'F' => 'C', 'G' => 'D', 'H' => 'E',
                'I' => 'F', 'J' => 'G', 'K' => 'H', 'L' => 'I',
                'M' => 'J', 'N' => 'K', 'O' => 'L', 'P' => 'M',
                'Q' => 'N', 'R' => 'O', 'S' => 'Q', 'T' => 'R',
                'U' => 'S', 'V' => 'T', 'W' => 'U', 'X' => 'V',
                'Y' => 'W', 'Z' => 'X'
            ];

            // Function to encrypt the text
            function encrypt($inputText, $keyMap)
            {
                $inputText = strtoupper($inputText); // Convert to uppercase
                $encryptedText = '';

                for ($i = 0; $i < strlen($inputText); $i++) {
                    $char = $inputText[$i];
                    if (array_key_exists($char, $keyMap)) {
                        $encryptedText .= $keyMap[$char]; // Map to custom key
                    } else {
                        $encryptedText .= $char; // Non-alphabetic characters remain unchanged
                    }
                }

                return $encryptedText;
            }

            // Function to decrypt the text
            function decrypt($inputText, $keyMap)
            {
                $decryptedText = '';

                // Reverse key mapping
                $reverseKeyMap = array_flip($keyMap);

                for ($i = 0; $i < strlen($inputText); $i++) {
                    $char = $inputText[$i];
                    if (array_key_exists($char, $reverseKeyMap)) {
                        $decryptedText .= $reverseKeyMap[$char]; // Map back to original letter
                    } else {
                        $decryptedText .= $char; // Non-alphabetic characters remain unchanged
                    }
                }

                return $decryptedText;
            }

            // Process form submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $inputText = $_POST['inputText'];
                if (isset($_POST['encrypt'])) {
                    $outputText = encrypt($inputText, $customKey);
                    echo "<h4>Encrypted Text: $outputText</h4>";
                } elseif (isset($_POST['decrypt'])) {
                    $outputText = decrypt($inputText, $customKey);
                    echo "<h4>Decrypted Text: $outputText</h4>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
 