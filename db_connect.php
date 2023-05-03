<? $conn= new mysqli('204.11.58.166','survey_db','3Rh4&ot16','survey_db')or die("Could not connect to mysql".mysqli_error($con));
mysqli_query($conn,"SET CHARACTER SET 'utf8'");
mysqli_query($conn,"SET SESSION collation_connection ='utf8_unicode_ci'");