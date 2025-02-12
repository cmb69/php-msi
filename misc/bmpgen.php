<?php

$im = imagecreatetruecolor(493, 58);
imagefilledrectangle($im, 0, 0, 492, 57, 0xE2E4EF);
$logo = imagecreatefrompng(__DIR__ . "/banner-logo.png");
imagecopy($im, $logo, 426, 2, 0, 0, 53, 53);
imagebmp($im, __DIR__ . "/banner.bmp");

$im = imagecreatetruecolor(493, 312);
imagefilledrectangle($im, 0, 0, 163, 311, 0x4F5B93);
imagefilledrectangle($im, 164, 0, 492, 311, 0xE2E4EF);
$logo = imagecreatefrompng(__DIR__ . "/dialog-logo.png");
imagecopy($im, $logo, 12, 86, 0, 0, 139, 139);
imagebmp($im, __DIR__ . "/dialog.bmp");
