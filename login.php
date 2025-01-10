<?php include('header.php'); ?>

<div class="container mt-5">
    <h2 class="text-success">Login</h2>
    <form action="login.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-success">Login</button>
    </form>
</div>

<?php include('footer.php'); ?>
