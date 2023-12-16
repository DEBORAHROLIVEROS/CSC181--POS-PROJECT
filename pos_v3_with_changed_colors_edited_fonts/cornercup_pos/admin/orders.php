<?php include('includes/header.php'); ?>

<style>
    body {
        font-family: 'League Spartan', sans-serif;
        background-color: #FFFFFF; /* Set background color for the body */
        color: #000000;
    }

    h1, h5, p {
        font-family: 'League Spartan', sans-serif;
    }

    .card p, .card h5 {
        font-family: 'League Spartan', sans-serif;
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

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="mb-0" style="font-size: 25px; font-family: 'League Spartan', sans-serif;font-weight: bold;">Orders</h4>
                </div>
                <div class="col-md-8">
                    <form action="" method="GET">
                        <div class="row g-1">
                            <div class="col-md-4">
                                <input type="date" 
                                    name="date"
                                    class="form-control"
                                    value="<?= isset($_GET['date']) == true ? $_GET['date']:''; ?>" 
                                />
                            </div>
                            <div class="col-md-4">
                                <select name="payment_status" class="form-select">
                                    <option value="">Select Payment Status</option>
                                    <option value="Cash Payment"
                                        <?= 
                                        isset($_GET['payment_status']) == true 
                                        ?
                                        ($_GET['payment_status'] == 'Cash Payment' ? 'selected' : '')
                                        :
                                        ''; 
                                        ?>
                                        >
                                        Cash Payment
                                    </option>
                                    <option 
                                        value="Online Payment"
                                        <?= 
                                        isset($_GET['payment_status']) == true 
                                        ?
                                        ($_GET['payment_status'] == 'Online Payment' ? 'selected' : '')
                                        :
                                        ''; 
                                        ?>
                                        >Online Payment</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary" style="background-color: #243E58;">Filter</button>
                                <a href="orders.php" class="btn btn-danger" style="background-color: #881106;">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">

            <?php

                if(isset($_GET['date']) || isset($_GET['payment_status'])){

                    $orderDate = validate($_GET['date']);
                    $paymentStatus = validate($_GET['payment_status']);

                    if($orderDate != '' && $paymentStatus == ''){
                        $query = "SELECT o.*,c.* FROM orders o, cashiers c
                            WHERE c.id = o.cashier_id AND o.order_date='$orderDate' ORDER BY o.id DESC";

                    }elseif($orderDate == '' && $paymentStatus != ''){
                        $query = "SELECT o.*,c.* FROM orders o, cashiers c
                            WHERE c.id = o.cashier_id AND o.payment_mode='$paymentStatus' ORDER BY o.id DESC";

                    }elseif($orderDate != '' && $paymentStatus != ''){
                        $query = "SELECT o.*,c.* FROM orders o, cashiers c
                            WHERE c.id = o.cashier_id 
                            AND o.order_date='$orderDate' 
                            AND o.payment_mode='$paymentStatus' ORDER BY o.id DESC";
                    }else{
                        $query = "SELECT o.*, c.* FROM orders o, cashiers c 
                            WHERE c.id = o.cashier_id ORDER BY o.id DESC";
                    }

                }else{
                    $query = "SELECT o.*, c.* FROM orders o, cashiers c 
                        WHERE c.id = o.cashier_id ORDER BY o.id DESC";
                }
                $orders = mysqli_query($conn, $query); 
                if($orders){
                    if(mysqli_num_rows($orders) > 0)
                    {
                        ?>
                        <table class="table table-striped table-bordered align-items-center justify-content-center">
                            <thead>
                                <tr>
                                    <th>Tracking No.</th>
                                    <th> Name</th>
                                    <th> Phone No.</th>
                                    <th>Order Date</th>
                                    <th>Order Status</th>
                                    <th>Payment Mode</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($orders as $orderItem) : ?>
                                <tr>
                                    <td class="fw-bold"><?= $orderItem['tracking_no']; ?></td>
                                    <td><?= $orderItem['cname']; ?></td>
                                    <td><?= $orderItem['phone']; ?></td>
                                    <td><?= date('d M, Y', strtotime($orderItem['order_date'])); ?></td>
                                    <td><?= $orderItem['order_status']; ?></td>
                                    <td><?= $orderItem['payment_mode']; ?></td>
                                    <td>
                                        <a href="orders-view.php?track=<?= $orderItem['tracking_no']; ?>" class="btn btn-info mb-0 px-2 btn-sm" style="background-color: #cdd5a1;">View</a>
                                        <a href="orders-view-print.php?track=<?= $orderItem['tracking_no']; ?>" class="btn btn-primary mb-0 px-2 btn-sm" style="background-color: #6987a4;">Print</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php
                    }
                }
            ?>

        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

