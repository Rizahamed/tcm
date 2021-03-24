<?php
// session_start();
// if (empty($_SESSION["acm_uid"]) || !isset($_SESSION["acm_uid"])) {
//     header("Location:login.php");
// }
require_once("header.php"); 
?>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-show">
    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#/margin_account">
            <img class="navbar-brand-full" src="./files/assets/images/logo.png" width="89" height="25"
                alt="CoreUI Logo">
        </a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="nav navbar-nav ml-auto">

            <li class="nav-item dropdown container-fluid">
                <a class="nav-link" data-toggle="dropdown" href="/" role="button" aria-haspopup="true"
                    aria-expanded="true">
                    <!-- <?php echo $_SESSION["acm_name"]; ?> &nbsp;&nbsp;&nbsp; -->
                     <i class="nav-icon icon-arrow-down"> </i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">

                    <li class="dropdown-header text-center">
                        <strong>Settings</strong>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#/profile">
                            <i class="fa fa-user"></i> Profile</a> </li>
                    <li><a class="dropdown-item" href="#/setting">
                            <i class="fa fa-wrench"></i> Settings</a> </li>

                    <li> <a class="dropdown-item" href="logout.php">
                            <i class="fa fa-lock"></i> Logout</a> </li>
                </ul>
            </li>
        </ul>
    </header>
    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li><br></li>
                    <li class="nav-item">
                        <a class="nav-link active " href="#/margin_account">
                            <i class="nav-icon icon-layers"></i>Margin Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#/open_orders">
                            <i class="nav-icon icon-notebook"></i> Open Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#/order_history">
                            <i class="nav-icon icon-envelope-letter "></i> Order History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#/fund_history">
                            <i class="nav-icon icon-folder-alt"></i> Fund History</a>
                    </li>
                    <li class="divider"></li>
                </ul>

            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>


        <main class="main">
            <div ng-view></div>
        </main>

    </div>

</body>
<?php require_once("footer.php"); ?>