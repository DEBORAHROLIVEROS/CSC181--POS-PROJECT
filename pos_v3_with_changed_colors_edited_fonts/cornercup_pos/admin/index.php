<?php include('includes/header.php'); ?>

<style>
    body {
        font-family: 'Arimo', sans-serif;
        background-color: #FFFFFF; /* Set background color for the body */
        color: #000000;
    }

    h1, h5, p {
        font-family: 'Arimo', sans-serif;
    }

    .card p, .card h5 {
        font-family: 'Arimo', sans-serif;
    }

    .container-fluid {
        padding: 20px; /* Add padding to the container for better spacing */
    }

    .card {
        background-color: #c0c6cc; /* Set card background color */
        color: #000000; /* Set text color for cards */
        margin-bottom: 20px;
    }
</style>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h1 class="mt-4" style="font-size: 35px; font-family: 'League Spartan', sans-serif; font-weight: bold;">Dashboard</h1>
            <?php alertMessage(); ?>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body p-3">
                <p class="text-sm mb-0 text-capitalize" style= "font-size: 17px; font-family: 'League Spartan'', sans-serif;">Total Category</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('categories'); ?>
                </h5>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body p-3">
                <p class="text-sm mb-0 text-capitalize" style= "font-size: 17px; font-family: 'League Spartan'', sans-serif;">Total Products</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('products'); ?>
                </h5>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-body p-3">
                <p class="text-sm mb-0 text-capitalize" style= "font-size: 17px; font-family: 'League Spartan'', sans-serif;">Total Admins</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('admins'); ?>
                </h5>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-body p-3">
                <p class="text-sm mb-0 text-capitalize" style= "font-size: 17px; font-family: 'League Spartan'', sans-serif;">Total Cashiers</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('cashiers'); ?>
                </h5>
            </div>
        </div>

        <div class="col-md-12 mb-3">
            <hr>
            <h5 style="font-size: 27px; font-family: 'League Spartan', sans-serif;">Orders</h5>
        </div>

        <div class="col-md-3 mb-3">
        <div class="card card-body p-3">
                <p class="text-sm mb-0 text-capitalize" style= "font-size: 17px; font-family: 'League Spartan'', sans-serif;">Today Orders</p>
                <h5 class="fw-bold mb-0">
                    <?php
                        $todayDate = date('Y-m-d');
                        $todayOrders = mysqli_query($conn,"SELECT * FROM orders WHERE order_date='$todayDate' ");
                        if($todayOrders){
                            if(mysqli_num_rows($todayOrders) > 0){
                                $totalCountOrders = mysqli_num_rows($todayOrders);
                                echo $totalCountOrders;
                            }else{
                                echo "0";
                            }
                        }else{
                            echo 'Something went Wrong!';
                        }
                    
                    ?>
                </h5>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card card-body p-3">
                <p class="text-sm mb-0 text-capitalize" style= "font-size: 17px; font-family: 'League Spartan', sans-serif;">Total Orders</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('orders'); ?>
                </h5>
            </div>
        </div>

    </div>

</div>

<?php include('includes/footer.php'); ?>