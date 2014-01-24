<?php
error_reporting (E_ALL);
echo '<pre>';

// include class
require_once('../Mime_Types.php');


print_section('Load file');
$mime =& new Mime_Types('mime.types');



print_section('Get type with file command (tries to guess the type based on file contents)');
// you should edit Mime_Types class to specify the path to the file command,
// you can also extend the class and set the file command path that way.
$file = 'cookies.txt';
echo "get_file_type('$file'): ",$mime->get_file_type($file);



print_section('Get type based on file extension');
$file = 'cookies.txt';
echo "get_type('$file'): ",$mime->get_type($file);



print_section('Get file extension(s) associated with MIME type');
$type = 'video/mpeg';
echo "get_extension('$type'): ",$mime->get_extension($type);
echo "\n";
echo "get_extensions('$type'): ",implode(', ', $mime->get_extensions($type));


print_section('Remove extensions: mpga and mp3');
$type = 'audio/mpeg';
$ext = 'mpga mp3';
echo "get_extension('$type'): ",$mime->get_extension($type),"\n";
echo "get_extensions('$type'): ",implode(', ', $mime->get_extensions($type)),"\n";
echo "-- removing $ext --\n";
$mime->remove_extension($ext);
echo "get_extension('$type'): ",$mime->get_extension($type),"\n";
echo "get_extensions('$type'): ",implode(', ', $mime->get_extensions($type)),"\n";



print_section('Remove video/mpeg');
$type = 'video/mpeg';
if ($mime->has_type($type)) echo 'Got ',$type,"\n";
$mime->remove_type($type);
if ($mime->has_type($type)) echo 'Got ',$type,"\n"; else echo "$type now gone :(","\n";


print_section('Remove text/*');
$type = 'text/*';
$check = 'text/plain';
$check2 = 'text/html';
$check3 = 'image/gif';
if ($mime->has_type($check)) echo 'Got ',$check,"\n";
if ($mime->has_type($check2)) echo 'Got ',$check2,"\n";
if ($mime->has_type($check3)) echo 'Got ',$check3,"\n";
$mime->remove_type($type);
echo "-- removing $type --\n";
if ($mime->has_type($check)) echo 'Got ',$check,"\n"; else echo "$check now gone :(","\n";
if ($mime->has_type($check2)) echo 'Got ',$check2,"\n"; else echo "$check2 now gone :(","\n";
if ($mime->has_type($check3)) echo 'Got ',$check3,"\n"; else echo "$check3 now gone :(";



print_section('Remove all');
$ext = 'pdf';
if ($mime->has_extension($ext)) echo "Got $ext"; else echo "No $ext";
echo "\n";
$mime->remove_type();
if ($mime->has_extension($ext)) echo "Got $ext"; else echo "No $ext";


echo '</pre>';

function print_section($desc='')
{
    static $num = 1;
    echo "\n\n";
    echo '+---------------------------------------------',"\n";
    echo '| Test ',$num,' - ',$desc,"\n";
    echo '+---------------------------------------------',"\n";
    echo "\n";
    $num++;
}
?>