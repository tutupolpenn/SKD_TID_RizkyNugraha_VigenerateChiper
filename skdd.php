<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vigenere Cipher - RizkyNugr.</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        label {
            display: block;
            font-size: 1.1em;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            font-size: 1em;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .result {
            margin-top: 20px;
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Vigenere Cipher Enkripsi dan Dekripsi</h2>
        
        <form method="POST" action="">
            <label for="plaintext">Plaintext:</label>
            <input type="text" id="plaintext" name="plaintext" required>
            
            <label for="key">Key:</label>
            <input type="text" id="key" name="key" required>
            
            <input type="submit" name="action" value="Encrypt">
            <input type="submit" name="action" value="Decrypt">
        </form>

        <?php
        function vigenere_encrypt($plaintext, $key) {
            $ciphertext = "";
            $key = strtoupper($key);
            $key_len = strlen($key);
            $key_index = 0;

            for ($i = 0; $i < strlen($plaintext); $i++) {
                $char = $plaintext[$i];

                if (ctype_alpha($char)) {
                    $shift = ord($key[$key_index % $key_len]) - ord('A');

                    if (ctype_lower($char)) {
                        $ciphertext .= chr(((ord($char) - ord('a') + $shift) % 26) + ord('a'));
                    } else {
                        $ciphertext .= chr(((ord($char) - ord('A') + $shift) % 26) + ord('A'));
                    }

                    $key_index++;
                } else {
                    $ciphertext .= $char;
                }
            }
            return $ciphertext;
        }

        function vigenere_decrypt($ciphertext, $key) {
            $plaintext = "";
            $key = strtoupper($key);
            $key_len = strlen($key);
            $key_index = 0;

            for ($i = 0; $i < strlen($ciphertext); $i++) {
                $char = $ciphertext[$i];

                if (ctype_alpha($char)) {
                    $shift = ord($key[$key_index % $key_len]) - ord('A');

                    if (ctype_lower($char)) {
                        $plaintext .= chr(((ord($char) - ord('a') - $shift + 26) % 26) + ord('a'));
                    } else {
                        $plaintext .= chr(((ord($char) - ord('A') - $shift + 26) % 26) + ord('A'));
                    }

                    $key_index++;
                } else {
                    $plaintext .= $char;
                }
            }
            return $plaintext;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $plaintext = $_POST['plaintext'];
            $key = $_POST['key'];

            if ($_POST['action'] == 'Encrypt') {
                $result = vigenere_encrypt($plaintext, $key);
                echo "<div class='result'><h3>Encrypted Text:</h3><p>$result</p></div>";
            } elseif ($_POST['action'] == 'Decrypt') {
                $result = vigenere_decrypt($plaintext, $key);
                echo "<div class='result'><h3>Decrypted Text:</h3><p>$result</p></div>";
            }
        }
        ?>
    </div>
</body>
</html>
