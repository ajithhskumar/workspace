<?php
// require composer autoload
$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;

require $path . '/vendor/autoload.php';
require_once $path . '/vendor/autoload.php';

class PDFMerger extends Mpdf\Mpdf
{

function generatePDF()
{
$html = '
<h1>mPDF</h1>

';

$mpdf = new \Mpdf\Mpdf();

$mpdf->SetDisplayMode('fullpage');

// LOAD a stylesheet
$stylesheet = file_get_contents('assets/mpdfstyleA4.css');
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html);

$mpdf->Output();
	
}

function mergePDFFiles(Array $filenames, $outFile)
{
    if ($filenames) {

        $filesTotal = sizeof($filenames);
        $fileNumber = 1;

        //$this->SetImportUse();

        if (!file_exists($outFile)) {
            $handle = fopen($outFile, 'w');
            fclose($handle);
        }

        foreach ($filenames as $fileName) {
            if (file_exists($fileName)) {
                $pagesInFile = $this->SetSourceFile($fileName);
                for ($i = 1; $i <= $pagesInFile; $i++) {
                    $tplId = $this->ImportPage($i); // in Pdf v8 should be 'importPage($i)'
                    $this->UseTemplate($tplId);
                    if (($fileNumber < $filesTotal) || ($i != $pagesInFile)) {
                        $this->WriteHTML('<pagebreak />');
                    }
                }
            }
            $fileNumber++;
        }

        $this->Output($outFile);
		return 1;
    }
	return null; // MUST!
}


}
