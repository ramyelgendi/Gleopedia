<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-globe"></i>
        </div>
        <div class="sidebar-brand-text mx-2 mt-2">Gleopedia  <sup>Database Project</sup></div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Tables -->
    <?php  $current = basename($_SERVER['PHP_SELF']); # Incase there is more than one page. To make this dynamic for any page.
    if($current=="index.php"){
        echo'<li class="nav-item active">';
    } else {
        echo'<li class="nav-item">';
    }  ?>
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-home"></i>
            <span>List Of Countries</span></a>
    </li>
    <?php  $current = basename($_SERVER['PHP_SELF']); # Incase there is more than one page. To make this dynamic for any page.
    if($current=="ReviewsList.php"){
        echo'<li class="nav-item active">';
    } else {
        echo'<li class="nav-item">';
    }  ?>
        <a class="nav-link" href="ReviewsList.php">
            <i class="fas fa-fw fa-info"></i>
            <span>Reviews</span></a>
    </li>
    <?php  $current = basename($_SERVER['PHP_SELF']); # Incase there is more than one page. To make this dynamic for any page.
    if($current=="filter.php"){
        echo'<li class="nav-item active">';
    } else {
        echo'<li class="nav-item">';
    }  ?>
        <a class="nav-link" href="filter.php">
            <i class="fas fa-fw fa-search"></i>
            <span>Filter Countries</span></a>
    </li>
    <?php  $current = basename($_SERVER['PHP_SELF']); # Incase there is more than one page. To make this dynamic for any page.
    if($current=="covid.php"){
        echo'<li class="nav-item active">';
    } else {
        echo'<li class="nav-item">';
    }  ?>
        <a class="nav-link" href="covid.php">
            <i class="fas fa-fw fa-virus"></i>
            <span>Covid Statistics</span></a>
    </li>
    <?php  $current = basename($_SERVER['PHP_SELF']); # Incase there is more than one page. To make this dynamic for any page.
    if($current=="top.php"){
        echo'<li class="nav-item active">';
    } else {
        echo'<li class="nav-item">';
    }  ?>
        <a class="nav-link" href="top.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Retrieve Top 10</span></a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
        <!-- End of Sidebar -->
