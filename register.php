<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-300 to-blue-400 flex items-center justify-center min-h-screen">

<div class="form_box p-8 bg-white rounded-md shadow-md">
    <h2 class="text-2xl font-bold text-center mb-6">Register</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex flex-col">
                <label for="registerUsername" class="text-gray-700">Username:</label>
                <input type="text" id="registerUsername" name="username" required
                       class="form-control border-gray-300 rounded-md shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-400 focus:ring-opacity-50 px-3 py-2 mt-1">
            </div>
            <div class="flex flex-col">
                <label for="registerPhoneNumber" class="text-gray-700">Phone Number:</label>
                <input type="tel" id="registerPhoneNumber" name="phoneNumber" required
                       class="form-control border-gray-300 rounded-md shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-400 focus:ring-opacity-50 px-3 py-2 mt-1">
            </div>
            <div class="flex flex-col">
                <label for="registerEmail" class="text-gray-700">Email:</label>
                <input type="email" id="registerEmail" name="email" required
                       class="form-control border-gray-300 rounded-md shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-400 focus:ring-opacity-50 px-3 py-2 mt-1">
            </div>
            <div class="flex flex-col">
                <label for="registerPassword" class="text-gray-700">Password:</label>
                <input type="password" id="registerPassword" name="password" required
                       class="form-control border-gray-300 rounded-md shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-400 focus:ring-opacity-50 px-3 py-2 mt-1">
            </div>
            <div class="flex flex-col">
                <label for="registerConfirmPassword" class="text-gray-700">Confirm Password:</label>
                <input type="password" id="registerConfirmPassword" name="confirmPassword" required
                       class="form-control border-gray-300 rounded-md shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-400 focus:ring-opacity-50 px-3 py-2 mt-1">
                <span id="passwordError" class="error"></span>
            </div>
        </div>

        <button type="submit" name="submit" class="w-full bg-gradient-to-r from-blue-700 to-blue-800 text-white rounded-md py-2 px-4 font-semibold hover:bg-blue-600 transition duration-300 mt-6">Register</button>
    </form>

    <p class="text-center mt-4">Already have an account? <a href="login.php" class="text-blue-500 hover:underline">Login here.</a></p>
</div>

</body>
</html>



    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "register";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];
        $password = $_POST['password'];
        $c_password=$_POST['confirmPassword'];

        $sql = "INSERT INTO register (username, email, p_number, pass , c_pass) VALUES ('$username', '$email', '$phoneNumber', '$password' , '$c_password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registration successful');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    ?>

    <script>
        function switchForm(page) {
            // Redirect to the specified page
            window.location.href = page;
        }

        function validateForm() {
            var password = document.getElementById("registerPassword").value;
            var confirmPassword = document.getElementById("registerConfirmPassword").value;
            var passwordError = document.getElementById("passwordError");

            if (password !== confirmPassword) {
                passwordError.textContent = "Passwords do not match";
                return false;
            } else {
                passwordError.textContent = "";
                return true;
            }
        }
    </script>

</body>
</html>
