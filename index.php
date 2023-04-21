<!DOCTYPE html>
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
			background: linear-gradient(135deg, #8e44ad, #3498db);
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
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>