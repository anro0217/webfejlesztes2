<?php
// A megoldó kulcs
$key = array(5, -14, 31, -9, 3);

// A password.txt fájl beolvasása
$file = file('password.txt', FILE_IGNORE_NEW_LINES);

// Dekódolt sorok eltárolása
$users = array();

// Karakterek visszaállítása és eltárolása
foreach ($file as $line) {
    $decoded_line = '';
    $key_index = 0;
    for ($i = 0; $i < strlen($line); $i++) {
        // Az ASCII-kód kiszámítása a kulcs segítségével
        $ascii_code = ord($line[$i]) - $key[$key_index];
        // Ha az ASCII-kód az EOL (A0), akkor hagyjuk változatlanul
        if ($ascii_code < 32) {
            $key_index++;
        } else {
            // Ha az ASCII-kód nem A0, akkor visszaállítjuk a karaktert a kulcs segítségével
            $decoded_line .= chr($ascii_code % 128);
            $key_index++;
            if ($key_index == count($key)) {
                $key_index = 0;
            }
        }
    }
    // Az állomány sorainak feldolgozása és a felhasználók tömbjének frissítése
    $parts = explode('*', $decoded_line);
    $users[$parts[0]] = $parts[1];
}

$username = $_POST['username'];
$password = $_POST['password'];


$servername = "localhost";
$ser_username = "localhost";
$ser_password = "";
$dbname = "adatok";

// Create connection
$conn = new mysqli($servername, $ser_username, $ser_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getUserColor($username, $conn) {
    $sql = "SELECT Titkos FROM tabla WHERE Username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Titkos'];
    } else {
        return 'none'; //default value
    }
}
$sec_color = getUserColor($username, $conn);

if($sec_color == "none"){
	$bg_color = '#8B0000'; // default background color
	$bg_color2 = '#00008B';
}

if(isset($users[$username]) && $users[$username] == $password){
	
	switch($sec_color) {
		case 'piros':
			$bg_color = '#ff4757'; 
			$bg_color2 = '#8b0000'; 
			break;
		case 'zold':
			$bg_color = '#2ecc71';
			$bg_color2 = '#1c814a'; 
			break;
		case 'sarga':
			$bg_color = '#f1c40f';
			$bg_color2 = '#b7950b'; 
			break;
		case 'kek':
			$bg_color = '#3498db';
			$bg_color2 = '#154360'; 
			break;
		case 'fekete':
			$bg_color = '#000000';
			$bg_color2 = '#4d4d4d'; 
			break;
		case 'feher':
			$bg_color = '#ffffff';
			$bg_color2 = '#bdc3c7';
			break;
	}
}

if(isset($users[$username]) && $users[$username] == $password) {
    echo '<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
		.container {
			background-color: #f1f1f1;
			padding: 40px;
			border-radius: 20px;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
		}
        body {
			background: linear-gradient(135deg,' . $bg_color . ', ' . $bg_color2 . ');
		}
        input[type=text], input[type=password] {
            width: 100%;
            padding: 24px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
			font-size: 24px;
        }
        label {
            display: block;
            margin-bottom: 6px;
			font-size: 24px;
        }
        .placeholder {
            position: absolute;
            color: #aaa;
            pointer-events: none;
            left: 20px;
            top: 20px;
            transition: 0.2s all ease-out;
			font-size: 24px;
        }
        .form-control {
            position: relative;
            margin-bottom: 15px;
            padding-top: 25px;
        }
        .form-control input {
            border: none;
            border-bottom: 1px solid #ccc;
            outline: none;
            background-color: transparent;
            height: 40px;
            font-size: 24px; 
            padding: 0 10px;
            width: 100%;
            box-sizing: border-box;
        }
        .form-control input:focus + .placeholder, .form-control input:not(:placeholder-shown) + .placeholder {
            top: 5px;
            left: 10px;
		    font-size: 18px; 
            color: #777;
        }
        input[type=submit] {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 20px 40px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 24px; 
            margin: 8px 2px;
			border-radius: 4px;
			cursor: pointer;
			transition: background-color 0.3s ease;
			}
			input[type=submit]:hover {
			background-color: #45a049;
			}
			</style>
			</head>
			<body>
				 <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <div class="form-control">
                <input type="text" id="username" name="username" required>
                <label for="username" class="placeholder">Username</label>
            </div>
            <div class="form-control">
                <input type="password" id="password" name="password" required>
                <label for="password" class="placeholder">Password</label>
            </div>
		<p style="color: green;">Logged in successfully!</p>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>';
} else {
	header("refresh:3;url=https://www.police.hu/");
    echo '<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
		.container {
			background-color: #f1f1f1;
			padding: 40px;
			border-radius: 20px;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
		}
        body {
			background: linear-gradient(135deg, ' . $bg_color . ', ' . $bg_color2 . ');
		}
        input[type=text], input[type=password] {
            width: 100%;
            padding: 24px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
			font-size: 24px;
        }
        label {
            display: block;
            margin-bottom: 6px;
			font-size: 24px;
        }
        .placeholder {
            position: absolute;
            color: #aaa;
            pointer-events: none;
            left: 20px;
            top: 20px;
            transition: 0.2s all ease-out;
			font-size: 24px;
        }
        .form-control {
            position: relative;
            margin-bottom: 15px;
            padding-top: 25px;
        }
        .form-control input {
            border: none;
            border-bottom: 1px solid #ccc;
            outline: none;
            background-color: transparent;
            height: 40px;
            font-size: 24px; 
            padding: 0 10px;
            width: 100%;
            box-sizing: border-box;
        }
        .form-control input:focus + .placeholder, .form-control input:not(:placeholder-shown) + .placeholder {
            top: 5px;
            left: 10px;
		    font-size: 18px; 
            color: #777;
        }
        input[type=submit] {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 20px 40px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 24px; 
            margin: 8px 2px;
			border-radius: 4px;
			cursor: pointer;
			transition: background-color 0.3s ease;
			}
			input[type=submit]:hover {
			background-color: #45a049;
			}
			</style>
			</head>
			<body>
				 <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <div class="form-control">
                <input type="text" id="username" name="username" required>
                <label for="username" class="placeholder">Username</label>
            </div>
            <div class="form-control">
                <input type="password" id="password" name="password" required>
                <label for="password" class="placeholder">Password</label>
            </div>
		<p style="color: red;">Wrong username or password!</p>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>';
}
?> 