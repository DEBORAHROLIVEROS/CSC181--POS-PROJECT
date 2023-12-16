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
            <h4 class="mb-0" style="font-size: 25px; font-family: 'League Spartan', sans-serif;font-weight: bold;">Add Product
                <a href="products.php" class="btn btn-danger float-end" style="background-color: #881106;">Back</a>
            </h4>
        </div>
        <div class="card-body">

            <?php alertMessage(); ?>

            <form action="code.php" method="POST" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Select Category</label>
                        <select name="category_id" class="form-select">
                            <option value="">Select Category</option>
                            <?php 
                            $categories = getAll('categories');
                            if($categories){
                                if(mysqli_num_rows($categories) > 0){
                                    foreach($categories as $cateItem){
                                        echo '<option value="'.$cateItem['id'].'">'.$cateItem['name'].'</option>';

                                    }

                                }else{
                                    echo '<option value="">No Categories Found</option>';
                                }
                            }else{
                                echo '<option value="">Something Went Wrong!</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for=""  style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Product Name *</label>
                        <input type="text" name="name" required class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for=""  style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Description </label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for=""  style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Price *</label>
                        <input type="text" name="price" required class="form-control" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for=""  style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Quantity *</label>
                        <input type="text" name="quantity" required class="form-control" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for=""  style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Image *</label>
                        <input type="file" name="image" class="form-control" />
                    </div>

                    <div class="col-md-6" style="font-family: font-size: 17px, 'League Spartan', sans-serif;">
                        <label>Status </label>
                        <span style="font-size: 10px;  font-style: italic;">(UnChecked=Visible, Checked=Hidden)</span>
                         <br/>
                        <input type="checkbox" name="status" style="width: 20px;height: 30px"; >
                    </div>

                    <div class="col-md-6 mb-3 text-end">
                        <br/>
                        <button type="submit" name="saveProduct" class="btn btn-primary" style="background-color: #243E58;">Save</button>
                        
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>