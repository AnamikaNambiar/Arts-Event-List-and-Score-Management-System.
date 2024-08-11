<?php
$regusername=filter_input(INPUT_POST,'regusername');
$regpassword=filter_input(INPUT_POST,'regpassword');
$sem=filter_input(INPUT_POST,'sem');
$dep=filter_input(INPUT_POST,'dep');
$regtype=filter_input(INPUT_POST,'regtype');

if(!empty($regusername)){
    if(!empty($regpassword)){
        if(!empty($regtype)){
            $Host="localhost";
            $dbusername="root";
            $dbpass="";
            $dbName="multiuserlogin";

$con=new mysqli($Host,$dbusername,$dbpass,$dbName);
if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'
    .mysqli_connect_error());
}
else{
    $sql="INSERT INTO multiuserlogin (username,password,sem,dep,usertype)
    values ('$regusername','$regpassword','$sem','$dep','$regtype')";
    if($con->query($sql)){
        echo "Registration successfull";
    }
    else{
        echo "Eror: ".$sql ."<br>".$con->error;
    }
    $con->close();
}
}

else{
    echo "Select regestration type";
    die();
}
}
else{
    echo "password should not be empty";
    die();
}
}
else{
    echo "username should not be empty";
    die();
}
?>