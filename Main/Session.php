<?php

if (($_SESSION['StudentIDNum'] == FALSE) && ($_SESSION['TutorIDNum'] == FALSE)) {
	header("Location: Login.php");
}

?>