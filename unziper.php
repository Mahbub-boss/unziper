<?php
/*
* Package: Unziper
* Author: Mahbub
* Url: https://github.com/Mahbub-boss
*/

error_reporting(0);
ignore_user_abort(true);
if ((time() - filemtime(basename(__FILE__))) > 36000) {
echo "EN: The file expired. Maximum 10 minutes after uploading this file.";
unlink(basename(__FILE__));
exit;
}
if(!class_exists('ZipArchive')) {
die("Class ZipArchive Not found in your hosting!");
}
function zipExtract ($src, $dest)
    {
        $zip = new ZipArchive();
        if ($zip->open($src)===true)
        {
            $zip->extractTo($dest);
            $zip->close();
            return true;
        }
        return false;
    }

echo '<html><head><title>Unziper</title></head><body>';
if (!isset($_GET['zip'])) {
echo '<form method="get" action="?"><b>ZIP URL</b><br /><input type="text" name="zip" value="http://"/><input type="submit" value="Install"/></form></body></html>';
exit;
}
$RemoteFile = ($_GET["zip"]);
$ZipFile = "Archive.zip";
$Dir = "./";

copy($RemoteFile,$ZipFile) or die("EN: Can not copy the file <b>".$RemoteFile."</b>.");

if (zipExtract($ZipFile,$Dir)) {
echo "EN: <b>".basename($RemoteFile)."</b> Successfully extracted to current directory.<br />ID: <b>".basename($RemoteFile)."</b>";
unlink($ZipFile);
unlink(basename(__FILE__));
}
else {
echo "EN: Unable to extracting <b>".$ZipFile.".</b>";
if (file_exists($ZipFile)) {
unlink($ZipFile);
}
unlink(basename(__FILE__));
}
echo '</body></html>';
?>