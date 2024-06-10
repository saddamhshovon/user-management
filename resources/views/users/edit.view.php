<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
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
        .nav {
            background-color: #007bff;
            padding: 1.5rem 0;
        }
        .right {
            display: flex;
            justify-content: end;
        }
        .logout {
            text-decoration: none;
            padding: .5rem 1.5rem;
            background-color: #007BFF;
            color: #fff;
            border: .1rem solid #fff;
            border-radius: .5rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .logout:hover {
            background-color: #0056b3;
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
        .form-control select {
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
        .back {
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

<?php require base_path('resources/views/partials/navbar.php')?>

<div class="container x-center">
    <div class="card mt-5">
        <h1 class="heading">Edit User</h1>
        <form action="/users/<?= $user['id'] ?>" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <div class="form-control">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?= old('username') == null ? $user['username'] : old('username') ?>" required>
                <?php if (isset($errors['username'])) { ?>
                <p class="error"><?= $errors['username'] ?></p>
                <?php } ?>
            </div>

            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= old('email') == null ? $user['email'] : old('email') ?>" required>
                <?php if (isset($errors['email'])) { ?>
                <p class="error"><?= $errors['email'] ?></p>
                <?php } ?>
            </div>
            
            <div class="form-control">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == App\Enums\Role::Admin->value) { ?>
                    <option value="admin" <?= ($user['role'] === 'admin') ? 'selected' : '' ?> >Admin</option>
                    <?php } ?>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] != App\Enums\Role::User->value) { ?>
                    <option value="moderator" <?= ($user['role'] === 'moderator') ? 'selected' : '' ?> >Moderator</option>
                    <?php } ?>
                    <option value="user" <?= ($user['role'] === 'user') ? 'selected' : '' ?> >User</option>
                </select>
                <?php if (isset($errors['role'])) { ?>
                <p class="error"><?= $errors['role'] ?></p>
                <?php } ?>
            </div>
            <div class="button-container">
                <button type="submit">Save Changes</button>
            </div>
        </form>
        <div class="back">
            <a href="/users/<?= $user['id'] ?>">Back to User</a>
        </div>
    </div>
</div>

</body>
</html>
