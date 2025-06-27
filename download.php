<?php
// Set header untuk download file
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="CV_Defrima_Fitriyani.pdf"');
header('Content-Length: ' . filesize('assets/CV_Defrima_Fitriyani.pdf'));

// Baca file dan output ke browser
readfile('assets/CV_Defrima_Fitriyani.pdf');
exit;
?>