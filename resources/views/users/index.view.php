<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>
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
        .mt-2 {
            margin-top: 2rem;
        }
        .search-create-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .create {
            text-decoration: none;
            padding: .5rem 1.5rem;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: .5rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .create:hover {
            background-color: #0056b3;
        }
        .search input[type="text"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #007BFF;
            width: 100%;
            transition: border-color 0.3s;
        }
        .search input[type="text"]:focus {
            border-color: #007BFF;
        }
        .user-table-container {
            background-color: #fff;
            border-radius: 1rem;
            overflow: hidden;
        }
        .user-table {
            border-collapse: collapse;
        }
        .user-table th, .user-table td {
            padding: 1rem 2rem;
            border-bottom: .1rem solid #ddd;
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
        .action-buttons a {
            text-decoration: none;
            color: #007BFF;
        }
        .action-buttons a:hover {
            text-decoration: underline;
        }
        .pagination {
            margin-top: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .pagination a {
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
            color: #007BFF;
            border: 1px solid #007BFF;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            margin-right: 5px;
        }
        .pagination a:hover {
            background-color: #007BFF;
            color: #fff;
        }
        .pagination .current {
            background-color: #007BFF;
            color: #fff;
        }
    </style>
</head>
<body class="bg-gray">

<?php require base_path('resources/views/partials/navbar.php')?>

<div class="container x-center">
    <div class="mt-2">
        <div class="search-create-container">
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] != App\Enums\Role::User->value) { ?>
            <a class="create" href="/users/create">Create</a>
            <?php } ?>
            <form class="search" action="/users" method="GET">
                <input type="text" name="search" placeholder="Search..." value="<?= htmlspecialchars($search) ?>">
            </form>
        </div>

        <div class="user-table-container">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= strtoupper($user['role']) ?></td>
                        <td class="action-buttons">
                            <a href="/users/<?= $user['id'] ?>">View</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <?php if ($currentPage > 1) { ?>
                <a href="/users?page=<?= $currentPage - 1 ?>&search=<?= htmlspecialchars($search) ?>">&laquo; Previous</a>
            <?php } ?>

            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                <a href="/users?page=<?= $i ?>&search=<?= htmlspecialchars($search) ?>" class="<?= $i == $currentPage ? 'current' : '' ?>">
                    <?= $i ?>
                </a>
            <?php } ?>

            <?php if ($currentPage < $totalPages) { ?>
                <a href="/users?page=<?= $currentPage + 1 ?>&search=<?= htmlspecialchars($search) ?>">Next &raquo;</a>
            <?php } ?>
        </div>
    </div>
</div>

</body>
</html>
