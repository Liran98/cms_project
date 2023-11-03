<?php
// phpinfo(); to check what version of php you got 
                                //*PASSWORD_DEFAULT
echo password_hash('thepassword',PASSWORD_BCRYPT, array('cost'=> 12));

$password = password_hash($password,PASSWORD_BCRYPT,array('cost'=>12));




?>