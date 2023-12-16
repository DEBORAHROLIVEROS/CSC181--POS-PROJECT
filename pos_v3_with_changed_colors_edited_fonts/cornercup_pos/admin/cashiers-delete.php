<?php

require '../config/function.php';


$paraResult = checkParamID('id');
if(is_numeric($paraResult)){

    $cashierId = validate($paraResult);
    
    $cashier = getById('cashiers', $cashierId);

    if($cashier['status'] == 200)
    {
        $response = delete('cashiers', $cashierId);
        if($response)
        {
            redirect('cashiers.php','Cashier Deleted Successfully.');
        }
        else{
            redirect('cashiers.php','Something Went Wrong.');
        }
    }
    else
    {
        redirect('cashiers.php', $cashier ['message']);
    }

}else{
    redirect('cashiers.php','Something Went Wrong.');
}

?>