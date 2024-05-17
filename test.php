<?php
$link = mysql_connect('localhost', 'root', 'Test@123456');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
printf("MySQL server version: %s\n", mysql_get_server_info());
?>