<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="customer_home" class="navbar-brand">
            <span class="text-dark">Online Farmers Market</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="customer_home" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="customer_orders" class="nav-link">Orders</a>
                </li>
                <li class="nav-item">
                    <a href="customer_orders" class="nav-link">Payments</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Reports</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="#" class="dropdown-item">Orders </a></li>
                        <li><a href="#" class="dropdown-item">Payments</a></li>
                    </ul>
                </li>
            </ul>

        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link text-primary" href="customer_profile">
                    <i class="fas fa-user-tag"></i>
                </a>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link text-danger" href="logout">
                    <i class="fas fa-power-off"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>