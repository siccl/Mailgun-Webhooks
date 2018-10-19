<?php
// For Debug value = 1
$debug = 0;
// DB Connection
$dbconn = mysqli_connect("localhost", "dbuser", "dbpass", "dbname");
$dbconn->set_charset('utf8');
// MailGun Key
$key = "key-xxxxxxxxxxxxxxxxxxxxxxxxx";