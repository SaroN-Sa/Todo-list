<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <style>
        /* CSS styles for alert */
        .alert {
            padding: 15px;
            border-radius: 5px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            position: relative;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .alert strong {
            margin-right: 10px;
        }

        .btn-close {
            width: 20px;
            height: 20px;
            font-size: 1rem;
            color: #721c24;
            cursor: pointer;
            background-color: transparent;
            border: none;
            padding: 0;
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
        }

        .btn-close:before {
            content: "×";
        }
    </style>
</head>
<body>
    <?php
     if(isset($_SESSION['message'])):

   
    ?>
    <div class="alert">
        <strong>Message:</strong>
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['message']); // Unset the session message after displaying the alert
    endif;
    ?>

    <!-- Your HTML content goes here -->

    <!-- JavaScript to handle alert close functionality -->
    <script>
        // Get the close button
        const closeButton = document.querySelector('.btn-close');

        // Add event listener to close the alert when the button is clicked
        closeButton.addEventListener('click', function() {
            const alert = this.parentElement; // Get the parent element of the button (which is the alert)
            alert.style.display = 'none'; // Hide the alert
        });
    </script>
</body>
</html>
