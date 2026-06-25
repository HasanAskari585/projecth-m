<?php

echo "<pre>";
echo "HOST: "; var_dump(getenv("MYSQLHOST"));
echo "USER: "; var_dump(getenv("MYSQLUSER"));
echo "PASS: "; var_dump(getenv("MYSQLPASSWORD"));
echo "DB: "; var_dump(getenv("MYSQLDATABASE"));
echo "PORT: "; var_dump(getenv("MYSQLPORT"));
die();