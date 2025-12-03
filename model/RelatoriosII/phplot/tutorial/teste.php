<?php
// Create a test source image for this example
$im = imagecreatetruecolor(300, 50);
$text_color = imagecolorallocate($im, 233, 14, 91);
imagestring($im, 1, 5, 5,  'A Simple Text String', $text_color);

// start buffering
ob_start();
// output jpeg (or any other chosen) format & quality
imagejpeg($im, NULL, 85);
// capture output to string
$contents = ob_get_contents();
// end capture
ob_end_clean();

// be tidy; free up memory
imagedestroy($im);

// lastly (for the example) we are writing the string to a file
$fh = fopen("./temp/img.jpg", "a+" );
    fwrite( $fh, $contents );
fclose( $fh );
?> 