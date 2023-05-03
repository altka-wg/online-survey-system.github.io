<? $conn= new mysqli('localhost','root','','survey_db')or die("Could not connect to mysql".mysqli_error($con));
mysqli_query($conn,"SET CHARACTER SET 'utf8'");
mysqli_query($conn,"SET SESSION collation_connection ='utf8_unicode_ci'");