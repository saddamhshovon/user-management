<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User View</title>
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
            max-width: 600px; /* Adjusted maximum width */
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Added box shadow */
            padding: 40px; /* Increased padding */
        }
        .user-info {
            margin-bottom: 30px;
        }
        .user-info h2 {
            color: #007BFF;
            margin-bottom: 10px;
        }
        .user-info p {
            margin: 0;
        }
        .button-container {
            text-align: center;
        }
        .button-container a, .button-container button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-right: 10px;
        }
        .button-container a:hover, .button-container button:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }
        .btn-delete {
            background-color: #dc3545; /* Red color for delete button */
        }
        .btn-delete:hover {
            background-color: #c82333; /* Darker shade on hover */
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Added box shadow */
        }
        .modal button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            border: none;
        }
        .modal button:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }
    </style>
</head>
<body>

<div class="container">
    <a href="/users" class="btn">Back</a>
    <div class="user-info">
        <h2>User Information</h2>
        <p><strong>Id:</strong> <?= $user['id'] ?></p>
        <p><strong>Username:</strong> <?= $user['username'] ?></p>
        <p><strong>Email:</strong> <?= $user['email'] ?></p>
        <p><strong>Role:</strong> <?= strtoupper($user['role']) ?></p>
    </div>
    <div class="button-container">
        <a href="/users/edit/<?= $user['id'] ?>">Edit</a>
        <button id="deleteBtn" class="btn-delete" style="background-color: red">Delete</button> <!-- Red color for delete button -->
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <p>Are you sure you want to delete?</p>
        <button id="confirmBtn">Confirm</button>
        <button id="cancelBtn" style="background-color: red">Cancel</button>
    </div>
</div>

<script>
    // Get the modal
    let modal = document.getElementById("myModal");

    // Get the button that opens the modal
    let btn = document.getElementById("deleteBtn");

    // Get the <span> element that closes the modal
    let cancelBtn = document.getElementById("cancelBtn");

    // When the user clicks on the delete button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x) or cancel button, close the modal
    cancelBtn.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Get the confirm button inside the modal
    var confirmBtn = document.getElementById("confirmBtn");

    // When the user clicks on the confirm button, submit the form
    confirmBtn.onclick = function() {
        // Get the form
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '/users/<?= $user['id'] ?>';
        form.style.display = 'none';

        // Add method input
        var methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);

        // Append the form to the body
        document.body.appendChild(form);

        // Submit the form
        form.submit();
    }
</script>

</body>
</html>
