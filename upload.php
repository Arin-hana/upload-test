<?php

@$fileName = $_POST['fileName'];
@$chunkNumber = (int)$_POST['chunkNumber'];
@$totalChunks = (int)$_POST['totalChunks'];
function randomFunc($rgn) {
    for ($i = 0; $i < 2; $i++) {
        $random = $rgn[array_rand($rgn)];
        return $random;
    }
}

$rgn = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "X", "Y", "Z", "a", "b", "c", "d", "f", "g", "h", "i", "j", "k", "l", "m", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "_", "-" );

$text = randomFunc($rgn).randomFunc($rgn).randomFunc($rgn).randomFunc($rgn).randomFunc($rgn).randomFunc($rgn).randomFunc($rgn).randomFunc($rgn).randomFunc($rgn).randomFunc($rgn).randomFunc($rgn);

echo $text;

@$fileName = $_POST['fileName'];
@$chunkNumber = (int)$_POST['chunkNumber'];
@$totalChunks = (int)$_POST['totalChunks'];

$targetDir = './watch/';
$targetFile = $targetDir . $fileName;
$movefile = './watch/'.$text.'/'.$fileName;
$movedir = './watch/'.$text.'/';
$tempFile = $targetDir . $fileName . '_' . $chunkNumber;

if (!move_uploaded_file($_FILES['file']['tmp_name'], $tempFile)) {
  http_response_code(500);
  exit();
}

if ($chunkNumber == $totalChunks - 1) {
  // Open the final file
  $finalFile = fopen($targetFile, 'wb');

  // Loop through all chunks and merge them
  for ($i = 0; $i < $totalChunks; $i++) {
    $chunk = $targetDir . $fileName . '_' . $i;
    $chunkFile = fopen($chunk, 'rb');
    while (!feof($chunkFile)) {
      fwrite($finalFile, fread($chunkFile, 8192));
    }
    fclose($chunkFile);
    unlink($chunk);
  }
  fclose($finalFile);
}
if (file_exists($targetFile)) {
  mkdir($movedir, 0777, true);
    if (!file_exists($movefile)) {
        rename($targetFile, $movefile);
        echo "File '".$fileName."' moved to directory '".$movedir."' successfully.";
    } else {
        echo "File '".$fileName."' already exists in directory '".$movedir."'.";
    }
} else {
    echo "File '".$fileName."' does not exist.";
}
http_response_code(200);

?>
