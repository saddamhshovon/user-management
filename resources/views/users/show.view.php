<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User View</title>
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
        .mt-1 {
            margin-top: 1rem;
        }
        .mb-1 {
            margin-bottom: 1rem;
        }
        .relative {
            position: relative;
        }
        .back {
            text-decoration: none;
            padding: .5rem 1.5rem;
            background-color: #007BFF;
            color: #fff;
            border: .1rem solid #fff;
            border-radius: .5rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .back:hover {
            background-color: #0056b3;
        }
        .heading {
            color: #007bff;
            margin-bottom: 1rem;
        }
        .center {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .user-table-container {
            background-color: #fff;
        }
        .user-table {
            border-collapse: collapse;
        }
        .user-table th, .user-table td {
            padding: 1rem 2rem;
            border: .1rem solid #ddd;
            color: #333;
            font-size: medium;
            text-align: left;
        }
        .user-table th {
            background-color: #007BFF;
            color: #fff;
        }
        .user-table td {
            background-color: #f9f9f9;
        }
        .user-table tr:hover td {
            background-color: #e6e6e6;
        }
        .button-container {
            display: inline-block;
        }
        .edit {
            text-decoration: none;
            padding: .5rem 1.5rem;
            background-color: #007BFF;
            color: #fff;
            border: .1rem solid #fff;
            border-radius: .5rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .edit:hover {
            background-color: #0056b3;
        }
        .delete {
            padding: .5rem 1.5rem;
            background-color: red;
            color: #fff;
            border: .1rem solid #fff;
            border-radius: .5rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .delete:hover {
            background-color: darkred;
        }
        dialog::backdrop {
            background-color: black;
            opacity: 0.5;
        }
        #modal {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 2rem;
            border-radius: 1rem;
        }
        .modal-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body class="bg-gray">

<?php require base_path('resources/views/partials/navbar.php')?>

<div class="container x-center relative">
    <div class="card mt-5">
        <a href="/users" class="back">Back</a>
        <div class="center">
            <h1 class="heading mt-1">User Information</h1>
            <div class="user-table-container">
                <table class="user-table">
                <tr>
                    <th>Id:</th>
                    <td><?= $user['id'] ?></td>
                </tr>
                <tr>
                    <th>Username:</th>  
                    <td><?= $user['username'] ?></td>      
                </tr>  
                <tr>
                    <th>Email:</th>  
                    <td><?= $user['email'] ?></td>      
                </tr>
                <tr>
                    <th>Role:</th>  
                    <td><?= strtoupper($user['role']) ?></td>      
                </tr>
                </table>
            </div>
            <?php if (isset($_SESSION['user']) && ($_SESSION['user']['role'] == App\Enums\Role::Admin->value || $_SESSION['user']['id'] == $user['id'])) { ?>        
            <div class="button-container mt-1">
                <button onclick="window.location.href='/users/edit/<?= $user['id'] ?>'" class="edit">Edit</button>
                <button id="delete" class="delete" >Delete</button> <!-- Red color for delete button -->
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<dialog id="modal">
    <div class="modal-content">
        <p>Are you sure you want to delete?</p>
        <div class="button-container mt-1">
            <form action='/users/<?= $user['id'] ?>' style="display: inline-block;" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="edit">Confirm</button>
            </form>
            <button id="cancel" class="delete">Cancel</button>
        </div>
    </div>
</dialog>

<script>
    const dialog = document.querySelector("#modal");
    const showButton = document.querySelector("#delete");
    const closeButton = document.querySelector("#cancel");

    showButton.addEventListener("click", () => {
        dialog.showModal();
    });

    closeButton.addEventListener("click", () => {
        dialog.close();
    });
</script>

</body>
</html>
