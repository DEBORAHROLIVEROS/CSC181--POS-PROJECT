<?php
    $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") +1);
?>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu" style="background-color: #455E78;">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                
                <a class="nav-link <?= $page == 'index.php' ? 'active' : ''; ?>" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="font-size: 30px; font-family: 'League Spartan', sans-serif;font-weight: bold;"></i></div>
                    Dashboard
                </a>

                <a class="nav-link <?= $page == 'order-create.php' ? 'active' : ''; ?>" href="order-create.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-bell" style="font-size: 30px; font-family: 'League Spartan', sans-serif;font-weight: bold;"></i></div>
                    Create Order
                </a>
                <a class="nav-link <?= $page == 'orders.php' ? 'active' : ''; ?>" href="orders.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list" style="font-size: 30px; font-family: 'League Spartan', sans-serif;font-weight: bold;"></i></div>
                    Orders
                </a>

                <div class="sb-sidenav-menu-heading">Interface</div>
                
                <a class="nav-link <?= ($page == 'categories-create.php') || ($page == 'categories.php') ? 'collapse active':'collapsed'; ?>"
                    href="#" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseCategory">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns" style="font-size: 30px; font-family: 'League Spartan', sans-serif;font-weight: bold;"></i></div>
                    Categories
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= ($page == 'categories-create.php') || ($page == 'categories.php') ? 'show':''; ?>"
                    id="collapseCategory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'categories-create.php' ? 'active' : ''; ?>" href="categories-create.php">Create Category </a>
                        <a class="nav-link <?= $page == 'categories.php' ? 'active' : ''; ?>" href="categories.php">View Categories</a>
                    </nav>
                </div>

                <a class="nav-link <?= ($page == 'products-create.php') || ($page == 'products.php') ? 'collapse active':'collapsed'; ?>" 
                    href="#" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseProduct">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns" style="font-size: 30px; font-family: 'League Spartan', sans-serif;font-weight: bold;"></i></div>
                    Products
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= ($page == 'products-create.php') || ($page == 'products.php') ? 'show':''; ?>" 
                    id="collapseProduct" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'products-create.php' ? 'active' : ''; ?>" href="products-create.php">Create Product </a>
                        <a class="nav-link <?= $page == 'products.php' ? 'active' : ''; ?>" href="products.php">View Products</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Manage Users</div>
                
                <a class="nav-link collapsed" href="#" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseCashier" 
                    aria-expanded="false" aria-controls="collapseCashier">

                    <div class="sb-nav-link-icon"><i class="fas fa-columns" style="font-size: 30px; font-family: 'League Spartan', sans-serif;font-weight: bold;"></i></div>
                    Cashiers
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCashier" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'cashiers-create.php' ? 'active' : ''; ?>" href="cashiers-create.php">Add Cashier</a>
                        <a class="nav-link <?= $page == 'cashiers.php' ? 'active' : ''; ?>" href="cashiers.php">View Cashier</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseAdmins" 
                    aria-expanded="false" aria-controls="collapseAdmins">

                    <div class="sb-nav-link-icon"><i class="fas fa-columns" style="font-size: 30px; font-family: 'League Spartan', sans-serif;font-weight: bold;"></i></div>
                    Admins
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAdmins" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'admins-create.php' ? 'active' : ''; ?>" href="admins-create.php">Add Admin</a>
                        <a class="nav-link <?= $page == 'admins.php' ? 'active' : ''; ?>" href="admins.php">View Admins</a>
                    </nav>
                </div>
                
            </div>
        </div>
    </nav>
</div>