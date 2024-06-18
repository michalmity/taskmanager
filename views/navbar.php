<div class="navbar">
    <div class="navbar-left">
        <h1>TODO</h1>
    </div>
    <div class="navbar-right">
        <?php if (isset($_SESSION["user_id"])): ?>
            <div class="navbar-profile">
                    <img src="https://wallpapers.com/images/featured-full/cool-profile-picture-87h46gcobjl5e4xu.jpg">
                <p><?php echo $_SESSION["username"]; ?></p>
                <a href="../controllers/user_controller.php?action=logout">
                    <i class="bi bi-box-arrow-right"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>