<?php

require '../config/function.php';


$paraResult = checkParamID('id');
if(is_numeric($paraResult)){

    $adminId = validate($paraResult);
    
    $admin = getById('admins', $adminId);
    if($admin['status'] == 200)
    {
        $adminDelete = delete('admins', $adminId);
        if($adminDelete)
        {
            redirect('admins.php','Admin Deleted Successfully.');
        }
        else{
            redirect('admins.php','Something Went Wrong.');
        }
    }
    else
    {
        redirect('admins.php', $admin['message']);
    }
    //echo $adminId;

}else{
    redirect('admins.php','Something Went Wrong.');
}

?>