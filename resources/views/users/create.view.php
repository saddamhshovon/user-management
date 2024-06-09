<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .user-edit {
            width: 90%;
            max-width: 400px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
        }
        .user-edit h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .user-edit label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-size: 16px;
            font-weight: bold;
        }
        .user-edit input, .user-edit select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        .user-edit input:focus, .user-edit select:focus {
            border-color: #007BFF;
        }
        .user-edit button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .user-edit button:hover {
            background-color: #0056b3;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            text-decoration: none;
            color: #007BFF;
            font-size: 16px;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="user-edit">
    <h2>Create User</h2>
    <form action="/users" method="POST">
        <?php if (isset($errors['username'])) { ?>
        <p style="color: red; margin-top: 4px"><?= $errors['username'] ?></p>
        <?php } ?>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username" value="<?= old('username') ?>" required>
            
        <?php if (isset($errors['email'])) { ?>
        <p style="color: red; margin-top: 4px"><?= $errors['email'] ?></p>
        <?php } ?>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="email@example.com" value="<?= old('email') ?>" required>
        
        <?php if (isset($errors['role'])) { ?>
        <p style="color: red; margin-top: 4px"><?= $errors['role'] ?></p>
        <?php } ?>
        <label for="role">Role</label>
        <select id="role" name="role" required>
            <option value="admin" >Admin</option>
            <option value="moderator" >Moderator</option>
            <option value="user" >User</option>
        </select>
        
        <button type="submit">Submit</button>
    </form>
    <div class="back-link">
        <a href="/users">Back to User Table</a>
    </div>
</div>

</body>
</html>
