<?php
function my_merge_image($first, $second) {

header("content-type:image/png");
$img = imagecreatefrompng($first);
$img2 = imagecreatefrompng($second);
if (imagesx($img) > imagesx($img2))
    $destination = imagecreatetruecolor(imagesx($img)+imagesx($img2), imagesy($img));
else $destination =  imagecreatetruecolor(imagesx($img)+imagesx($img2), imagesy($img2));


imagecopymerge($destination, $img, 0, 0, 0, 0, imagesx($img), imagesy($img),100);
imagecopymerge($destination, $img2, imagesx($img), 0, 0, 0, imagesx($img2), imagesy($img2),100);
imagepng($destination, "test.png");
my_generate_css($first, $second);
}

function my_generate_css($first, $second) {
$img = imagecreatefrompng($first);
imagecreatefrompng($second);
$width_f_img = imagesx($img);
$height_f_img = imagesy($img);
$img_css = "#firstimg \n{\n\t width : ".$width_f_img."px;\n\t height :".$height_f_img."px;\n }";
$file = 'style.css';
file_put_contents($file, $img_css);

$img2 = imagecreatefrompng($second);
imagecreatefrompng($first);
$width_s_img = imagesx($img2);
$height_s_img = imagesy($img2);
$img_css = "\n\n#secondimg \n{\n\t width : ".$width_s_img."px;\n\t height :".$height_s_img."px;\n\tbackground: url("."test.png) -".$width_f_img."px 0\n}";
$file = 'style.css';
file_put_contents($file, $img_css, FILE_APPEND);
}

function main($argv, $argc)
{
    my_merge_image($argv[1], $argv[2]);
}

my_merge_image('fb_icon_325x325.png', 'index.png');
