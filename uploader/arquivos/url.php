<html>

<?php
  $url = $_POST['url'];
  
function getRemoteFilesize($url, $formatSize = true, $useHead = true)
{
    if (false !== $useHead) {
        stream_context_set_default(array('http' => array('method' => 'HEAD')));
    }
    $head = array_change_key_case(get_headers($url, 1));
    // content-length of download (in bytes), read from Content-Length: field
    $clen = isset($head['content-length']) ? $head['content-length'] : 0;

    // cannot retrieve file size, return "-1"
    if (!$clen) {
        return -1;
    }

    if (!$formatSize) {
        return $clen; // return size in bytes
    }

    $size = $clen;
    switch ($clen) {
        case $clen < 1024:
            $size = $clen .' B'; break;
        case $clen < 1048576:
            $size = round($clen / 1024, 2) .' KiB'; break;
        case $clen < 1073741824:
            $size = round($clen / 1048576, 2) . ' MiB'; break;
        case $clen < 1099511627776:
            $size = round($clen / 1073741824, 2) . ' GiB'; break;
    }

    return $size; // return formatted size
}




    set_time_limit (7 * 24 * 60 * 60);

    if (!isset($_POST['submit'])) die();

    $newfname = basename($url);

    $file = fopen ($url, "rb");
    if ($file) {
      $newf = fopen ($newfname, "wb");

      if ($newf)
      while(!feof($file)) {
        fwrite($newf, fread($file, 1024 * 8 * 8 * 8), 1024 * 8 * 8 * 8);

      }
    }

    if ($file) {
      fclose($file);
    }

    if ($newf) {
      fclose($newf);
    }
	
	
	$downloaded = filesize($newfname);
	switch ($downloaded) {
        case $downloaded < 1024:
            $sizeok = $downloaded .' B'; break;
        case $downloaded < 1048576:
            $sizeok = round($downloaded / 1024, 2) .' KiB'; break;
        case $downloaded < 1073741824:
            $sizeok = round($downloaded / 1048576, 2) . ' MiB'; break;
        case $downloaded < 1099511627776:
            $sizeok = round($downloaded / 1073741824, 2) . ' GiB'; break;
    }

	
    
		echo "<P>Downloaded <br>" . $sizeok ;
    echo "<P>TOTAL FILE SIZE <br>" . getRemoteFilesize($url);
    ?>
</html> 