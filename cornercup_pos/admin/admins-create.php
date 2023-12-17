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
            <h4 class="mb-0" style="font-size: 25px; font-family: 'League Spartan', sans-serif;font-weight: bold;">Add Admin
                <a href="admins.php" class="btn btn-danger float-end" style="background-color: #881106;">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="code.php" method="POST">

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Name *</label>
                        <input type="text" name="name" required class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Email *</label>
                        <input type="email" name="email" required class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Password *</label>
                        <input type="password" name="password" required class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Phone Number *</label>
                        <input type="number" name="phone" required class="form-control" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Is Ban</label>
                        <br/>
                        <input type="checkbox" name="is_ban" style="width:30px;height:30px;" />
                    </div>
                    <div class="col-md-12 mb-3 text-end">
                        <button type="submit" name="saveAdmin" class="btn btn-primary" style="background-color: #243E58;">Save</button>
                        
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>