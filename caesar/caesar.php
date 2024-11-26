<?php  
// Fungsi cipher untuk enkripsi dan dekripsi
function cipher($char, $key){
    if (ctype_alpha($char)) {
        $nilai = ord(ctype_upper($char) ? 'A' : 'a');
        $ch = ord($char);
        $mod = fmod($ch + $key - $nilai, 26);
        return chr($mod + $nilai);
    } else {
        return $char;
    }
} 

// Fungsi enkripsi
function enkripsi($input, $key){
    $output = "";
    $chars = str_split($input);
    foreach($chars as $char){
        $output .= cipher($char, $key);
    }
    return $output;
}

// Fungsi dekripsi
function dekripsi($input, $key){
    return enkripsi($input, 26 - $key);
}

$hasil = ""; // Variable to store the result

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $plainText = $_POST["plain"];
    $key = (int)$_POST["key"]; // Ensure the key is an integer

    // Check which button was pressed
    if (isset($_POST["enkripsi"])) {
        $hasil = enkripsi($plainText, $key);
    } else if (isset($_POST["dekripsi"])) {
        $hasil = dekripsi($plainText, $key);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encryption & Decryption - AULIA DIVA</title>
    <style>
        /* General Styles */
        body {
            background-color: #001f3f;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        /* Container */
        .container {
            background-color: #0a2a43;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 100%;
            max-width: 450px;
        }

        /* Header */
        h1 {
            color: #80d8ff;
            font-size: 2.5em;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        /* Input Fields */
        input[type="text"], input[type="number"], textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #80d8ff;
            border-radius: 12px;
            font-size: 1.1em;
            background-color: #03396c;
            color: #fff;
        }

        /* Textarea */
        textarea {
            height: 100px;
            resize: none;
            font-family: Arial, sans-serif;
        }

        /* Button container */
        .button-container {
            display: flex;
            justify-content: space-between;
        }

        /* Navy themed buttons */
        .btn {
            padding: 10px 20px;
            font-size: 1.1em;
            cursor: pointer;
            border-radius: 12px;
            margin: 10px;
            border: none;
            color: white;
            font-weight: bold;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-encrypt {
            background: #0074d9;
        }

        .btn-encrypt:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 116, 217, 0.4);
        }

        .btn-decrypt {
            background: #39cccc;
        }

        .btn-decrypt:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(57, 204, 204, 0.4);
        }

        /* Footer */
        .footer {
            margin-top: 20px;
            font-size: 1em;
            color: #80d8ff;
        }

        .footer span {
            color: #39cccc;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Encrypt & Decrypt</h1>
        <form action="" method="post">
            <input type="text" name="plain" placeholder="Enter your message" required />
            <input type="number" name="key" placeholder="Enter key (0-25)" required />
            <br />
            <div class="button-container">
                <button type="submit" name="dekripsi" class="btn btn-encrypt">Decrypt</button>
                <button type="submit" name="enkripsi" class="btn btn-decrypt">Encrypt</button>
            </div>
            <br />
            <textarea readonly placeholder="Result"><?php echo $hasil; ?></textarea>
        </form>
        <div class="footer">
            support by ga tidur <span>Tapi boong</span>
        </div>
    </div>
</body>
</html>
