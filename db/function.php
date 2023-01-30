<?php 


function create_unique_id(){
    $charecters =
    'jhehf24235645yfbhjggutgytgyugugyugcnvmhkgmcncjfkgdhrfjtgm';
    $charecters_length = strlen($charecters);
    $random = '';
    for($i = 0; $i < 20; $i++){
        $random .=$charecters[mt_rand(0, $charecters_length - 1)];
    }
    return $random;
}




if(isset($_COOKIE['main_id'])){
  $main_id = $_COOKIE['main_id'];
}else{
  $main_id = '';
}





  if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
  }else{
    $user_id = '';
  }
  ?>