<?php
session_start();
require_once 'db.php';

// දැනටමත් ලොග් වෙලා නම් කෙලින්ම dashboard එකට යවන්න
if(isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-dashboard.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Password එක verify කිරීම (අපි SQL එකේ දාපු hashed password එක එක්ක)
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user'] = $row['username'];
            header("Location: admin-dashboard.php");
            exit();
        } else {
            $error = "මුරපදය වැරදියි!";
        }
    } else {
        $error = "පරිශීලක නාමය හමු නොවීය!";
    }
}
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZeroTech - Admin Access</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #0f172a; color: #f8fafc; font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md bg-slate-900 border border-slate-800 p-8 rounded-3xl shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold uppercase tracking-widest text-emerald-400">Admin Login</h1>
            <p class="text-slate-500 text-sm mt-2">ZeroTech Control Center Access</p>
        </div>

        <?php if($error): ?>
            <div class="bg-red-500/10 border border-red-500/50 text-red-500 text-sm p-3 rounded-lg mb-6 text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-6">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Username</label>
                <input type="text" name="username" required 
                    class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500 transition text-white">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Password</label>
                <input type="password" name="password" required 
                    class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500 transition text-white">
            </div>

            <button type="submit" 
                class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-emerald-500/20 transition transform active:scale-95 uppercase text-sm tracking-widest">
                Authorize Access
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="index.php" class="text-slate-500 hover:text-emerald-400 text-xs transition">← Back to Main Site</a>
        </div>
    </div>

</body>
</html>