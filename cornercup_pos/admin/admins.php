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
            <h4 class="mb-0" style="font-size: 25px; font-family: 'League Spartan', sans-serif;font-weight: bold;">Admins/Staff
                <a href="admins-create.php" class="btn btn-primary float-end" style="background-color: #243E58;">Add Admin</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>

            <?php 
            $admins = getAll('admins');
            if(!$admins){
                echo '<h4>Something Went Wrong! </h4>';
                return false;
            }
            if(mysqli_num_rows($admins) > 0)
            {

            ?>
            <div class="table-responsive">
                <table class="table table-stiped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Is Ban</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php foreach($admins as $adminItem) : ?>
                        <tr>
                            <td><?= $adminItem['id'] ?></td>
                            <td><?= $adminItem['name'] ?></td>
                            <td><?= $adminItem['email'] ?></td>
                            <td>
                                <?php
                                    if($adminItem['is_ban'] == 1){
                                        echo '<span class="badge bg-danger" style="background-color: #d10d2f !important;">Banned</span>';
                                    }else{
                                        echo '<span class="badge bg-primary" style="background-color: #4ac00e !important;">Active</span>';
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="admins-edit.php?id=<?= $adminItem['id']; ?>" class="btn btn-success btn-sm" style="background-color: #d59b24;">Edit</a>
                                <a href="admins-delete.php?id=<?= $adminItem['id']; ?>" class="btn btn-danger btn-sm" style="background-color: #881106;">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        
                    </tbody>
                </table>
            </div>
            <?php 
            }
            else
            {
                ?>
                    <h4 class="mb-0">No Record Found</h4>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>