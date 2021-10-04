<html><body><h3>Merge Files</h3><ol>
<script>
function copyText($msg){
    var text = document.getElementById("textInput");
	document.value="hahh"
    text.select();
    document.execCommand("copy");
}
</script>

<?php


$files = array();

$doc_one="1.pdf";
$doc_two="2.pdf";
echo '<a href="util_pdf_merge.php?op=merge2&doc_one='.$doc_one.'&doc_two='.$doc_two.'" target="_blank"> Download </a>';
echo '<br>';
echo '<a href="#" onclick="copyFunction()"> Copy </a>';


?>
<input type="text" value="Welcome to CodexWorld" id="textInput" style="visibility=disable">
<button onclick="copyText()">Copy text</button>

</body></html>;


