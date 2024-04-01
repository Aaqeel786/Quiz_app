<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        body {
            background-color: #9CF6FB; /* Background color #9CF6FB */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background-color: #E1FCFD; /* Form container background color #E1FCFD */
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        /* Button styles */
        .btn-blue {
            background-color: #4A5FC1; /* Button background color #4A5FC1 */
            color: #E5B9A8; /* Button text color #E5B9A8 */
            transition: background-color 0.3s ease;
        }

        .btn-blue:hover {
            background-color: #394F8A; /* Button hover background color #394F8A */
        }
    </style>
</head>
<body>

<div class="form-container w-96">
    <h2 class="text-2xl font-bold text-center mb-8">Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="mb-4">
            <label for="loginUsername" class="block text-gray-700">Username or Email:</label>
            <input type="text" id="loginUsername" name="username" required
                   class="form-control w-full border-gray-300 rounded-md shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-400 focus:ring-opacity-50">
        </div>

        <div class="mb-4">
            <label for="loginPassword" class="block text-gray-700">Password:</label>
            <input type="password" id="loginPassword" name="password" required
                   class="form-control w-full border-gray-300 rounded-md shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-400 focus:ring-opacity-50">
            <span id="loginError" class="error"><?php echo $loginError ?? ''; ?></span>
        </div>

        <button type="submit" name="submit" class="w-full btn-blue rounded-md py-2 font-semibold transition duration-300">Login</button>
    </form>

    <p class="text-center mt-4">Don't have an account? <a href="register.php" class="text-blue-500 hover:underline">Register here.</a></p>
</div>

</body>
</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection
    $servername = "localhost";
    $db_username = "root"; // Update with your actual database username
    $db_password = ""; // Update with your actual database password
    $dbname = "register";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM register WHERE (username = ? OR email = ?) AND pass = ?");
    $stmt->bind_param("sss", $username, $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Login successful
        header("Location: home.html"); // Redirect to quiz page
        exit();
    } else {
        // Invalid username or password
        $loginError = "Invalid username or password";
    }

    $conn->close();
}
?>

<script>
    function switchForm(page) {
        // Redirect to the specified page
        window.location.href = page;
    }
</script>

</body>
</html>
