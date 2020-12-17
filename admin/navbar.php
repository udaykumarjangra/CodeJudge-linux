<nav class="navbar navbar-light bg-light p-3">
    <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
        <a class="navbar-brand" href="#">
            CodeJudge
        </a>
        <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="col-12 col-md-4 col-lg-2">
    </div>
    <div class="col-12 col-md-5 col-lg-6 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
        <div class="mr-3 mt-1">
            <?php echo $_SESSION["username"]; ?> (Admin)
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="account.php">Settings</a></li>
                <li><a class="dropdown-item" href="../signout.php">Sign out</a></li>
            </ul>
            </div>
    </div>
</nav>