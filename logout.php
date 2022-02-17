<?php
SESSION_START();
SESSION_DESTROY();
ECHO "<div style='color:green;text-align:center;'>Berhasil keluar</div>";
header("location:index.php");
