<?php
include_once 'connection.php';
$setting = $conn->query(" select * from settings where id = 2 ")->fetch_assoc();
if(isset($setting)){
    $appName = $setting['app_name'];
    $adminEmail = $setting['admin_email'];
}else{
    $appName = 'mega store';
    $adminEmail = '7modyalasaker@gmail.com';
}
$config = 
[
    'app_name' => $appName,
    'app_date' => '2021_junary_9',
    'app_url'  => 'http://localhost/study/mega store/',
    'admin_mail' => '7modyalasaker@gmail.com',
    'admin_assets' => 'http://localhost/study/mega store/admin/templates/assets/',
    
]

?>