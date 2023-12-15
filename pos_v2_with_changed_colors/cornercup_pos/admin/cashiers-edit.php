<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Cashier
                <a href="cashiers.php" class="btn btn-danger float-end">Back</a>
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
                                <label for="">Name *</label>
                                <input type="text" name="cname" required value="<?= $cashier['data']['cname']; ?>" class="form-control" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Email Id</label>
                                <input type="email" name="email" value="<?= $cashier['data']['email']; ?>"  class="form-control" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Phone</label>
                                <input type="number" name="phone" value="<?= $cashier['data']['phone']; ?>" class="form-control" />
                            </div>
                            <div class="col-md-6">
                                <label>Status (UnChecked=Visible, Checked-Hidden)</label>
                                <br/>
                                <input type="checkbox" name="status" value="<?= $cashier['data']['status'] == true ? 'checked':'' ; ?>" style="width: 20px;height: 30px"; >
                            </div>

                            <div class="col-md-6 mb-3 text-end">
                                <br/>
                                <button type="submit" name="updateCashier" class="btn btn-primary">Update</button>
                                
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