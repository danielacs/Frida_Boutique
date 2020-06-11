<?php

include "../configs/configs.php";
include "../configs/funciones.php";

@session_destroy();
redir("../index.html");
?>