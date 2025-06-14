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
            <h4 class="mb-0" style="font-size: 25px; font-family: 'League Spartan', sans-serif;font-weight: bold;">Edit Admin
                <a href="admins.php" class="btn btn-danger float-end" style="background-color: #881106;">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>

            <form action="code.php" method="POST">

                <?php 
                    if(isset($_GET['id']))
                    {
                        if($_GET['id'] != ''){

                            $adminId = $_GET['id'];

                        }else{
                            echo '<h5>No Id Found</h5>';
                            return false;
                        }
                    }
                    else
                    {
                        echo '<h5>No Id given in URL</h5>';
                        return false;
                    }

                    $adminData = getById('admins', $adminId);
                    if($adminData)
                    {
                        if($adminData['status'] == 200)
                        {
                            ?>
                            <input type="hidden" name="adminId" value="<?= $adminData['data']['id']; ?>">

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Name *</label>
                                    <input type="text" name="name" required value="<?= $adminData['data']['name']; ?>" class="form-control" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Email *</label>
                                    <input type="email" name="email" required value="<?= $adminData['data']['email']; ?>" class="form-control" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Password *</label>
                                    <input type="password" name="password" class="form-control" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Phone Number *</label>
                                    <input type="number" name="phone" value="<?= $adminData['data']['phone']; ?>" class="form-control" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Is Ban</label>
                                    <br/>
                                    <input type="checkbox" name="is_ban" <?= $adminData['data']['is_ban'] == true ? 'checked':''; ?> style="width:30px;height:30px;" />
                                </div>
                                <div class="col-md-12 mb-3 text-end">
                                    <button type="submit" name="updateAdmin" class="btn btn-primary" style="background-color: #243E58;">Update</button>             
                                </div>
                            </div>
                            <?php

                        }
                        else
                        {
                            echo '<h5>' .$adminData['message'].'</h5>';
                        }

                    }
                    else{
                        echo 'Something Went Wrong';
                        return false;
                    }
                
                ?>

                

            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>