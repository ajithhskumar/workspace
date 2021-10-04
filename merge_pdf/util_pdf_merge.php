<?php
function console_log($msg) {
	echo '<script type=\"text/javascript\">' .
	  'console.log(' . $msg . ');</script>';
}

// Check the hash of receiver
if (isset($_GET['op'])) {
	$operation=$_GET['op'];
	console_log($operation);
	console_log("op not set. exiting");
}
else
{
	console_log("op not set. exiting");
	exit;
}

$count=0;
$dirPath="./images";
$files = array();
if (isset($_GET['doc_one'])) {
	$filename=$dirPath.'/'.$_GET['doc_one'];
	if (file_exists($filename)) {
		$files[$count]=$filename;
		$count=$count+1;
	}
	else
	{
		console_log("file not found");
	}
}
if (isset($_GET['doc_two'])) {
	$filename=$dirPath.'/'.$_GET['doc_two'];
	if (file_exists($filename)) {
		$files[$count]=$filename;
		$count=$count+1;
	}else
	{
		console_log("file not found");
		exit;
	}
}

require_once __DIR__ . '/Clipboard.php';
echo "Clip";
$c = new Clipboard();

if ($c->isUnsupported() === false) {
	$c->writeAll('copied');
	echo '<script>alert("Copied")</script>';
	echo "<script>window.close();</script>";
	exit;
}
//var_dump($files);
$outFileName="";
foreach ($files as $file) {
	$outFileName=$outFileName.basename($file,'.pdf');
}
$outFileName=$dirPath.'/'.$outFileName.".pdf";
//==============================================================
require_once __DIR__ . '/PDFMerger.php';
$mpdf = new \Mpdf\Mpdf();
$mypdf = new PDFMerger();
$ret = $mypdf->mergePDFFiles($files, $outFileName);

//==============================================================
if(!($ret === NULL))
{
	header("Content-Type: application/octet-stream");
	$file = $outFileName;
	$name="myname";
	header("Content-Disposition: attachment; filename=".$name);   
	header("Content-Type: application/download");
	header("Content-Description: File Transfer");            
	header("Content-Length: " . filesize($file));
	  
	flush(); // This doesn't really matter.
	  
	$fp = fopen($file, "r");
	while (!feof($fp)) {
		echo fread($fp, 65536);
		flush(); // This is essential for large downloads
	} 
	  
	fclose($fp); 
}
?>