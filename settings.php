<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="settings.css">
    <script src="settings.js" defer></script>
    <style>
        body.light-mode {
            background-color: #f4f4f4;
            color: #333;
        }

        body.dark-mode {
            background-color: #333;
            color: #f4f4f4;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            text-align: center;
        }

        .theme-toggle-button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .theme-toggle-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Settings</h1>
        <form id="theme-form" method="post" action="passdash.php">
            <button type="button" class="theme-toggle-button" id="toggle-theme">Toggle Theme</button>
            <input type="hidden" id="theme-input" name="theme">
        </form>
    </div>
</body>

</html>
