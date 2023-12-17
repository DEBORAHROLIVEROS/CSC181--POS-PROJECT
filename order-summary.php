

<?php 

include('includes/header.php');

$amountPaid = isset($_SESSION['amountPaid']) ? $_SESSION['amountPaid'] : 'N/A';
$changeAmount = isset($_SESSION['changeAmount']) ? $_SESSION['changeAmount'] : 'N/A';

if(!isset($_SESSION['productItems'])){
    echo '<script> window.location.href ="order-create.php"; </script>';
}

?>


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

<div class="modal fade" id="orderSuccessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
       
        <div class="mb-3 p-4">
            <h5 id="orderPlaceSuccessMessage"></h5>
        </div>
        <a href="orders.php" class="btn btn-secondary" style="background-color: #243E58;">Close</a>
        <button type="button" onclick="printMyBillingArea()" class="btn btn-danger" style="background-color: #881106;">Print</button>
        <button type="button" onclick="downloadPDF('<?= $_SESSION['invoice_no']; ?>')" class="btn btn-warning"  style="background-color: #d59b24;">Download PDF</button>
      </div>
    </div>
  </div>
</div>



<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0" style="font-size: 25px; font-family: 'League Spartan', sans-serif;font-weight: bold;">Order Summary
                        <a href="order-create.php" class="btn btn-danger float-end" style="background-color: #881106;">Back to create order</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php alertMessage(); ?>

                    <div id="myBillingArea">

                        <?php 
                        if(isset($_SESSION['cname']))
                        {
                            $cname = validate($_SESSION['cname']);
                            $invoiceNo = validate($_SESSION['invoice_no']);

                            $cashierQuery = mysqli_query($conn,"SELECT * FROM cashiers WHERE cname ='$cname' LIMIT 1");
                            if($cashierQuery){
                                if(mysqli_num_rows($cashierQuery) > 0){

                                    $cRowData = mysqli_fetch_assoc($cashierQuery);
                                    ?>
                                    <table style="width: 100%; margin-bottom: 20px;">
                                        <tbody>
                                            <tr>
                                                <td style="text-align: center;" colspan="2">
                                                    <h4 style="font-size: 23px; line-height: 30px; margin: 2px; padding: 0; font-family: 'League Spartan', sans-serif;font-weight: bold;"" >CORNERCUP</h4>
                                                    <p style="font-size: 16px; line-height: 24px; margin: 2px; padding: 0; font-family: 'Times New Roman', sans-serif;">Purok 2-A, Linamon, LDN</p>
                                                    <p style="font-size: 16px; line-height: 24px; margin: 2px; padding: 0; font-family: 'Times New Roman', sans-serif;">09564119014</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5 style="font-size: 20px; line-height: 30px; margin: 0px; padding: 0; font-family: 'Times New Roman', sans-serif;">Cashier Detail</h5>
                                                    <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0; font-family: 'Times New Roman', sans-serif;">Cashier Name: <?= $cRowData['cname']?> </p>
                                                </td>
                                                <td align="end">
                                                    <h5 style="font-size: 20px; line-height: 30px; margin: 0px; padding: 0; font-family: 'Times New Roman', sans-serif;">Invoice Details</h5>
                                                    <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0; font-family: 'Times New Roman', sans-serif;">Invoice No: <?= $invoiceNo; ?> </p>
                                                    <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0; font-family: 'Times New Roman', sans-serif;">Invoice Date: <?= date('d M Y'); ?> </p>

                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <?php
                                }else{
                                    echo "<h5>No Cashier Found</h5>";
                                    return;
                                }
                            }
                        }
                        ?>

                        <?php
                        if(isset($_SESSION['productItems']))
                        {
                            $sessionProducts = $_SESSION['productItems'];
                            ?>
                                <div class="table-responsive mb-3">
                                    <table style="width: 100%;" cellpadding="5">
                                        <thead>
                                            <tr>
                                                <th align="start" style="border-bottom: 1px solid #ccc;font-family: 'Times New Roman', sans-serif; font-weight: bold;" width="5%">ID</th>
                                                <th align="start" style="border-bottom: 1px solid #ccc;font-family: 'Times New Roman', sans-serif; font-weight: bold;">Product Name</th>
                                                <th align="start" style="border-bottom: 1px solid #ccc; font-family: 'Times New Roman', sans-serif; font-weight: bold;" width="10%">Price</th>
                                                <th align="start" style="border-bottom: 1px solid #ccc;font-family: 'Times New Roman', sans-serif; font-weight: bold;" width="10%">Quantity</th>
                                                <th align="start" style="border-bottom: 1px solid #ccc;font-family: 'Times New Roman', sans-serif; font-weight: bold;" width="15%">Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                $totalAmount = 0;

                                                foreach($sessionProducts as $key => $row) :

                                                $totalAmount += $row['price'] * $row['quantity']
                                            ?>
                                            <tr>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $i++; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['name']; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= number_format($row['price'],0) ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['quantity']; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;" class="fw-bold">
                                                    <?= number_format($row['price'] * $row['quantity'], 0) ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="4" style="font-family: 'Times New Roman', sans-serif; font-weight: bold;">Total Amount:</td>
                                                <td colspan="1" style="font-weight: bold;"><?= number_format($totalAmount, 0); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="font-family: 'Times New Roman', sans-serif; font-weight: bold;">Received Amount:</td>
                                                <td colspan="1" style="font-weight: bold;"><?= $amountPaid; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="font-family: 'Times New Roman', sans-serif; font-weight: bold;">Change:</td>
                                                <td colspan="1" style="font-weight: bold;"><?= $changeAmount; ?></td>
                                            </tr>

                                            <tr>
                                                <td colspan="5" style="font-family: 'Times New Roman', sans-serif; font-weight: bold;"> Payment Mode: <?= $_SESSION['payment_mode']; ?> </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            <?php
                        }
                        else
                        {
                            echo '<h5 class="text-center">No Items Added</h5>';
                        }
                        ?>
                    </div>

                    <?php if(isset($_SESSION['productItems'])) : ?>
                    <div class="mt-4 text-end">
                        <button type="button" class="btn btn-primary px-4 mx-1" style="background-color: #243E58;"7 id="saveOrder">Save</button>
                        
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>




<?php include('includes/footer.php'); ?>