<?php

require '../config/function.php';


$paraResult = checkParamID('id');
if(is_numeric($paraResult)){

    $productId = validate($paraResult);
    
    $product = getById('products', $productId);

    if($product['status'] == 200)
    {
        $response = delete('products', $productId);
        if($response)
        {
            $deleteImage = "../".$product['data']['image'];
            if(file_exists($deleteImage)){
                unlink($deleteImage);
            }
            
            redirect('products.php','Product Deleted Successfully.');
        }
        else{
            redirect('products.php','Something Went Wrong.');
        }
    }
    else
    {
        redirect('products.php', $product ['message']);
    }

}else{
    redirect('products.php','Something Went Wrong.');
}

?>