<?php $str="this is the copy text";?>

<html>
<body onload="onLoadFunction()">
<input type="text" value="<?php echo $str;?>" id="hiddenInput" maxlength="1" size="1">
<script>
// return a promise
function copyToClipboard(textToCopy) {
    // navigator clipboard api needs a secure context (https)
    if (false && navigator.clipboard && window.isSecureContext) {
        // navigator clipboard api method'
        return navigator.clipboard.writeText(textToCopy);
    } else {
        // text area method
        let textArea = document.createElement("textarea");
        textArea.value = textToCopy;
        // make the textarea out of viewport
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        return new Promise((res, rej) => {
            // here the magic happens
            document.execCommand('copy') ? res() : rej();
            textArea.remove();
        });
    }
}
function onLoadFunction() {
  var copyText = document.getElementById("hiddenInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  //var successful = document.execCommand('copy');
  //var msg = successful ? 'successful' : 'unsuccessful';
  //navigator.clipboard.writeText(copyText.value);
  copyToClipboard(copyText.value);
  copyText.remove();
  alert("Done");
  //window.close();
}
</script>
</body></html>