<?php
session_start();
$image = ImageCreateFromPng ("Images/captchaImage.png");

$red = rand(80,130);
$green = rand(80,130);
$blue = 320 -$red - $green;
$textColour = ImageColorAllocate($image, $red, $green, $blue);

$charArray = array('A','B','C','D','E','F','G','H','J','K','L','M','N','P','Q','R','T','U','V','W','X','Y','Z','2','3','4','6','7','8','9');

shuffle($charArray);
$captchaString = $charArray[0];
for ($i=1; $i<5; $i++) {
    $_SESSION['CAPTCHA'] = $captchaString .= ' ' . $charArray[$i];
}
$charNumber = range(1, 19);
$max = 18;
shuffle($charNumber);
$numRan = $charNumber[0];
for ($i=1; $i< $max; $i++) {
    $numRan = $charNumber[$i];
}
// $numRan changes the position of captcha String
ImageString($image, 10, $numRan, $numRan, $captchaString, $textColour);

$bigImage = imagecreatetruecolor(200, 80);
imagecopyresized($bigImage, $image, 0, 0, 0, 0, 200, 80, 100, 40);

header("Content-Type: image/jpeg");
Imagejpeg($bigImage, NULL, 8);

ImageDestroy($image);
ImageDestroy($bigImage);
?>