


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="dashbourd.php">Dashbord</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-grow-0" id="navbarNavDropdown">
      <ul class="navbar-nav  ">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="users.php">users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categories.php">categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">	comments</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <?php echo $_SESSION['admin']; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Admin</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
           
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>