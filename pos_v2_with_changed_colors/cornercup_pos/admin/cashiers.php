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

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Cashiers
                <a href="cashiers-create.php" class="btn btn-primary float-end">Add Cashier</a>
            </h4>
        </div>
        <div class="card-body">

            <?php alertMessage(); ?>

            <?php 
            $cashiers = getAll('cashiers');
            if(!$cashiers){
                echo '<h4>Something Went Wrong! </h4>';
                return false;
            }
            if(mysqli_num_rows($cashiers) > 0)
            {

            ?>
            <div class="table-responsive">
                <table class="table table-stiped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php foreach($cashiers as $item) : ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['cname'] ?></td>
                            <td><?= $item['email'] ?></td>
                            <td><?= $item['phone'] ?></td>
                            <td>
                                <?php
                                    if($item['status'] == 1){
                                        echo '<span class="badge bg-danger">Hidden</span>';
                                    }else{
                                        echo '<span class="badge bg-primary">Visible</span>';
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="cashiers-edit.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                <a 
                                    href="cashiers-delete.php?id=<?= $item['id']; ?>" 
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this data?')"
                                >
                                    Delete
                                </a>
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