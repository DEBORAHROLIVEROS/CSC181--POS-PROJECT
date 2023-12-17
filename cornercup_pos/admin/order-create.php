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
            <h4 class="mb-0" style="font-size: 25px; font-family: 'League Spartan', sans-serif;font-weight: bold;" >Create Order
                <a href="orders.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">

            <?php alertMessage(); ?>

            <form action="orders-code.php" method="POST">

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="">Select Product</label>
                        <select name="product_id" class="form-select mySelect2">
                            <option value="">-- Select Product --</option>
                            <?php
                                $products = getAll('products');
                                if($products){
                                    if(mysqli_num_rows($products) > 0){
                                        foreach($products as $prodItem){
                                            ?>
                                            <option value="<?= $prodItem['id']; ?>"><?= $prodItem['name']; ?></option>
                                            <?php
                                        }
                                    }else{
                                        echo '<option value="">No product found</option>';
                                    }
                                }else{
                                    echo '<option value="">Something Went Wrong</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Quantity</label>
                        <input type="number" name="quantity" value="1" class="form-control" />
                    </div>
                    <div class="col-md-3 mb-3 text-end">
                        <br/>
                        <button type="submit" name="addItem" class="btn btn-primary">Add Item</button>   
                    </div>
                </div>

            </form>
        </div>
    </div>
    
    <div class="card mt-3">
        <div class="card-header">
            <h4 class="mb-0" style="font-size: 25px; font-family: 'League Spartan', sans-serif;font-weight: bold;">Products</h4>
        </div>
        <div class="card-body" id="productArea">
            <?php
            if(isset($_SESSION['productItems']))
            {
                $sessionProducts = $_SESSION['productItems'];
                if(empty($sessionProducts)){
                    unset($_SESSION['productItems']);
                    unset($_SESSION['productItemIds']);
                }
                ?>
                <div class="table-responsive mb-3" id="productContent">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <!-- <th>Total Price</th> -->
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 1;
                                foreach($sessionProducts as $key => $item) : 
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $item['name']; ?></td>
                                <td><?= $item['price']; ?></td>
                                <td>
                                    <div class="input-group qtyBox">
                                        <input type="hidden" value="<?= $item['product_id']; ?>" class="prodId" />
                                        <button class="input-group-text decrement">-</button>
                                        <input type="text" value="<?= $item['quantity']; ?>" class="qty quantityInput" />
                                        <button class="input-group-text increment">+</button>
                                    </div>
                                </td>
                                <!-- <td><?= number_format($item['price'] * $item['quantity'], 0); ?></td> -->
                                <td>
                                    <a href="order-item-delete.php?index=<?= $key; ?>" class="btn btn-danger" style="background-color: #881106;">
                                        Remove
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <hr>
                    <?php
                    if (isset($_SESSION['productItems'])) {
                        $totalAmount = 0;

                        // Calculate the total order amount
                        foreach ($_SESSION['productItems'] as $item) {
                            $totalAmount += $item['price'] * $item['quantity'];
                        }
                        ?>
                        <div class="mt-3">
                            <h5>Total Amount: PHP <?= number_format($totalAmount, 2); ?></h5>
                            <label for="paidAmount">Enter Received Amount</label>
                            <input type="number" id="paidAmount" name="paidAmount" class="form-control" required />
                            
                            <!-- Display change when user enters the paid amount -->
                            <button type="button" class="btn btn-primary mt-2" style="background-color: #243E58;" onclick="calculateChange()">Calculate Change</button>
                            
                            <div id="changeDisplay" class="mt-2" style="display: none;">
                                <h5>Received Amount: PHP <span id="amountPaidDisplay"></span></h5>
                                <h5>Change: PHP <span id="changeAmountDisplay"></span></h5>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo '<h5>No Items Added</h5>';
                    }
                    ?>

                    <script>
                        function calculateChange() {
                            var totalAmount = <?= $totalAmount; ?>;
                            var paidAmount = parseFloat(document.getElementById('paidAmount').value);

                            if (!isNaN(paidAmount)) {
                                var changeAmount = paidAmount - totalAmount;

                                if (changeAmount >= 0) {
                                    document.getElementById('amountPaidDisplay').innerText = paidAmount.toFixed(2);
                                    document.getElementById('changeAmountDisplay').innerText = changeAmount.toFixed(2);

                                    document.getElementById('changeDisplay').style.display = 'block';
                                } else {
                                    alert('Error: The paid amount is less than the total amount. Please enter a valid amount.');
                                }
                            } else {
                                alert('Error: Please enter a valid amount.');
                            }
                        }
                    </script>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Select Payment Mode</label>
                            <select id="payment_mode" class="form-select">
                                <option value="">-- Select Payment --</option>
                                <option value="Cash Payment">Cash Payment</option>
                                <option value="Online Payment">Online Payment</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Enter Cashier Name</label>
                            <input type="name" id="cname" class="form-control" value="" />                            
                        </div>
                        <div class="col-md-4">
                            <br/>
                            <button type="button" class="btn btn-warning w-100 proceedToPlace" style="background-color: #FF9800;" >Proceed to place order</button>
                        </div>
                    </div>
                </div>
                <?php
            }
            else
            {
                echo '<h5>No Items Added</h5>';
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>