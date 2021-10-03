<?php

$files = array();
echo '<html><body><h3>Merge Files</h3><ol>';

$doc_one="1.pdf";
$doc_two="2.pdf";
echo '<a href="util_pdf_merge.php?op=merge2&doc_one='.$doc_one.'&doc_two='.$doc_two.'" target="_blank"> Download </a>';

echo '</body></html>';