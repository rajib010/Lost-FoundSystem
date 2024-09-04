<html>

<head>
    <style>
         .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #ff5722;
            color: white;
        }

        .admin-header h1 {
            font-size: 1.8em;
        }

        .logout-btn {
            background-color: #ffc107;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1em;
            color: #333;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #ff9800;
        }
    </style>
</head>

    <header class="admin-header">
        <h1>Welcome, Admin</h1>
        <button class="logout-btn">Log out</button>
    </header>

</html>