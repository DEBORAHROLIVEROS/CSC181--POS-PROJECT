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
            <h4 class="mb-0" style="font-size: 25px; font-family: 'League Spartan', sans-serif;font-weight: bold;">Edit Product
                <a href="products.php" class="btn btn-danger float-end" style="background-color: #881106;">Back</a>
            </h4>
        </div>
        <div class="card-body">

            <?php alertMessage(); ?>

            <form action="code.php" method="POST" enctype="multipart/form-data">

                <?php
                    $paramValue = checkParamId('id');
                    if(!is_numeric($paramValue)){
                        echo '<h5>Id is not an integer</h5>';
                        return false;
                    }

                    $product = getById('products', $paramValue);
                    if($product)
                    {
                        if($product['status'] == 200)
                        {
                        ?>

                        <input type="hidden" name="product_id" value="<?= $product['data']['id']; ?>" />
                        
                        <div class="row">
                            <div class="col-md-12 mb-3" >
                                <label style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Select Category</label>
                                <select name="category_id" class="form-select">
                                    <option value="">Select Category</option>
                                    <?php 
                                    $categories = getAll('categories');
                                    if($categories){
                                        if(mysqli_num_rows($categories) > 0){
                                            foreach($categories as $cateItem){
                                                ?>
                                                    <option 
                                                        value="<?= $cateItem['id']; ?>"
                                                        <?= $product['data']['category_id'] == $cateItem['id'] ? 'selected':''; ?>
                                                    >
                                                        <?= $cateItem['name']; ?>
                                                    </option>
                                                <?php
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
                                <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Product Name *</label>
                                <input type="text" name="name" required value="<?= $product['data']['name']; ?>" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Description </label>
                                <textarea name="description" class="form-control" rows="3"><?= $product['data']['description']; ?></textarea>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Price *</label>
                                <input type="text" name="price" required value="<?= $product['data']['price']; ?>" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Quantity *</label>
                                <input type="text" name="quantity" required value="<?= $product['data']['quantity']; ?>" class="form-control" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="" style="font-size: 17px; font-family: 'League Spartan', sans-serif;">Image *</label>
                                <input type="file" name="image" class="form-control" />
                                <img src="../<?= $product['data']['image']; ?>" style="width: 40px; height: 40px;" alt="Img" />
                            </div>

                            <div class="col-md-6">
                            <label>Status </label>
                                <span style="font-size: 10px;  font-style: italic;">(UnChecked=Visible, Checked=Hidden)</span>
                                <br/>
                                <input type="checkbox" name="status" <?= $product['data']['status'] == true ? 'checked':''; ?> style="width: 30px;height: 30px"; >
                            </div>

                            <div class="col-md-6 mb-3 text-end">
                                <br/>
                                <button type="submit" name="updateProduct" class="btn btn-primary" style="background-color: #243E58;">Update</button>
                        
                            </div>
                        </div>
                        <?php
                        }else
                        {
                            echo '<h5>'.$product['message'].'</h5>';
                        }
                    }
                    else
                    {
                        echo '<h5>Something Went Wrong</h5>';
                        return false;
                    }
                ?>

            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>