<?php
/*
 *  This file is part of Websico: online Web Site Composer, http://websico.net
 *  Copyright (c) 2009-2020 Olivier Seston, Bordeaux, France
 *	Author: O.Seston
 *
 *  This is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  It is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this file. If not, see <http://www.gnu.org/licenses/>.
 *  
*/

session_start();

header('Content-Type: image/png');

function random($length){
        $alphabet = "123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }
$mot = random(5);
if (empty($_SESSION['captcha']))
    $_SESSION['captcha'] = array();
$_SESSION['captcha'][$_REQUEST['id']] = $mot;

$char1 = substr($mot,0,1);
$char2 = substr($mot,1,1);
$char3 = substr($mot,2,1);
$char4 = substr($mot,3,1);
$char5 = substr($mot,4,1);

$img = imagecreatefrompng('ws_images/captcha.png');
$font = 'ws_fonts/Macondo-Regular.ttf';
$font2 = 'ws_fonts/DOTMATRI.TTF';
$col1 = imagecolorallocatealpha($img, 0, 0, 127, 60);
$col2 = imagecolorallocatealpha($img, 0, 127, 0, 40);

imagettftext($img, 28, 20, 10, 37, $col1, $font, $char1);
imagettftext($img, 28, 20, 40, 33, $col2, $font2, $char2);
imagettftext($img, 28, -25, 60, 37, $col1, $font, $char3);
imagettftext($img, 28, 0, 100, 33, $col2, $font2, $char4);
imagettftext($img, 28, 15, 130, 37, $col2, $font, $char5);

imagepng($img);
imagedestroy($img);