<?php
include('phpqrcode/qrlib.php');
if(isset($_GET['code']) && !empty($_GET['code'])) {
    $code = $_GET['code'];
    if(isset($_GET['download']) && $_GET['download'] == 'true') {
        $temp_file = tempnam(sys_get_temp_dir(), 'qr_');
        QRcode::png($code, $temp_file);    
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="qr-code.png"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($temp_file));
        readfile($temp_file);
        unlink($temp_file);
        exit;
    }
    else{
        // Anzeige des QR-Codes auf der Webseite
        QRcode::png($code);
    }
    
} else {
    echo '<br><center><h1>QR Code Generator</h1><br><br>';
    echo 'Please enter text or number:<br><br>';
    echo '<form action="index.php" method="get">';
    echo '<input type="text" name="code" />';
    echo '<input type="submit" value="Generate" />';
    echo '</form></center>';
}
?>