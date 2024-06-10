<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            font-family: Arial, "sans-serif";
            margin: 0;
            padding: 0;
            border: 0;
            box-sizing: border-box;
        }
        .bg-gray {
            background-color: #f5f5f5;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .x-center{
            display: flex;
            justify-content: center;
        }
        .card {
            width: 50%;
            background-color: #fff;
            padding: 4rem 2rem;
            border-radius: 1rem;
        }
        .mt-5 {
            margin-top: 5rem;
        }
        .heading {
            color: #007bff;
            margin-bottom: 1rem;
        }
        .form-control {
            margin-bottom: 20px;
        }
        .form-control label {
            display: block;
            margin-bottom: .5rem;
            color: #555;
        }
        .form-control input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .button-container {
            text-align: right;
        }
        .button-container button {
            padding: .5rem 1.5rem;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: .5rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button-container button:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }
        .login {
            text-align: left;
        }
        .error {
            text-align: left;
            font-size: small;
            color: red;
            padding: .5rem;
        }
    </style>
</head>
<body class="bg-gray">

<div class="container x-center">
    <div class="card mt-5">
        <h1 class="heading">Register</h1>
        <form action="/register" method="POST">
            <div class="form-control">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?= old('username') ?>" placeholder="username" required>
                <?php if (isset($errors['username'])) { ?>
                <p style="color: red; margin-top: 4px"><?= $errors['username'] ?></p>
                <?php } ?>
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= old(key: 'email') ?>" placeholder="email@example.com" required>
                <?php if (isset($errors['email'])) { ?>
                <p class="error"><?= $errors['email'] ?></p>
                <?php } ?>
            </div>
            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="password" required>
                <?php if (isset($errors['password'])) { ?>
                <p class="error"><?= $errors['password'] ?></p>
                <?php } ?>
            </div>
            <div class="form-control">
                <label for="password_confirm">Password confirmation</label>
                <input type="password" id="password_confirm" name="password_confirm" placeholder="password" required>
                <?php if (isset($errors['password_confirm'])) { ?>
                <p class="error"><?= $errors['password_confirm'] ?></p>
                <?php } ?>
            </div>
            <div class="button-container">
                <button type="submit">Register</button>
            </div>
        </form>
        <p class="login">Already have an account? <a href="/">Login</a></p>
    </div>
</div>

</body>
</html>
