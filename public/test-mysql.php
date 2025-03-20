<?php
if (extension_loaded('pdo_mysql')) {
    echo "PDO MySQL driver is loaded\n";
} else {
    echo "PDO MySQL driver is NOT loaded\n";
}

if (extension_loaded('mysqli')) {
    echo "MySQLi extension is loaded\n";
} else {
    echo "MySQLi extension is NOT loaded\n";
}