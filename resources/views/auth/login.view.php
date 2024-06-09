<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 100%;
            max-width: 400px; /* Adjusted maximum width */
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Added box shadow */
            padding: 40px; /* Increased padding */
        }
        h2 {
            color: #007BFF;
            margin-bottom: 30px; /* Increased margin-bottom */
        }
        .form-control {
            margin-bottom: 20px; /* Increased margin-bottom */
        }
        .form-control label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-control input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .button-container {
            text-align: center;
        }
        .button-container button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 10px;
        }
        .button-container button:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Login</h2>
    <form action="#">
        <div class="form-control">
            <label for="username">Username</label>
            <input type="text" id="username" name="username">
        </div>
        <div class="form-control">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>
        <div class="button-container">
            <button type="submit">Login</button>
        </div>
    </form>
</div>

</body>
</html>
