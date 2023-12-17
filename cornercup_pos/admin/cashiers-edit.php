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
            <h4 class="mb-0"style="font-size: 25px; font-family: 'League Spartan', sans-serif;font-weight: bold;">Edit Cashier
                <a href="cashiers.php" class="btn btn-danger float-end" style="background-color: #881106;">Back</a>
            </h4>
        </div>
        <div class="card-body">

            <?php alertMessage(); ?>

            <form action="code.php" method="POST">


                <?php
                    $paramValue = checkParamId('id');
                    if(!is_numeric($paramValue)){
                        echo '<h5>'.$paramValue.'</h5>';
                        return false;
                    }

                    $cashier = getById('cashiers', $paramValue);
                    if($cashier['status'] == 200)
                    {
                        ?>
                        <input type="hidden" name="cashierId" value="<?= $cashier['data']['id']; ?>" />

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Name *</label>
                                <input type="text" name="cname" required value="<?= $cashier['data']['cname']; ?>" class="form-control" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Email Id</label>
                                <input type="email" name="email" value="<?= $cashier['data']['email']; ?>"  class="form-control" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Phone</label>
                                <input type="number" name="phone" value="<?= $cashier['data']['phone']; ?>" class="form-control" />
                            </div>
                            <div class="col-md-6">
                                <label>Status </label>
                                <span style="font-size: 10px;  font-style: italic;">(UnChecked=Visible, Checked=Hidden)</span>
                                <br/>
                                <input type="checkbox" name="status" value="<?= $cashier['data']['status'] == true ? 'checked':'' ; ?>" style="width: 20px;height: 30px"; >
                            </div>

                            <div class="col-md-6 mb-3 text-end">
                                <br/>
                                <button type="submit" name="updateCashier" class="btn btn-primary"style="background-color: #243E58;">Update</button>
                                
                            </div>
                        </div>
                        <?php

                    }
                    else{
                        echo '<h5>'.$cashier['message'].'</h5>';
                        return false;
                    }
                ?>


            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>