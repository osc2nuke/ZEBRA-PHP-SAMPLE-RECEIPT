<?php


$handle = printer_open('ZDesigner MZ 320');
printer_set_option($handle, PRINTER_PAPER_FORMAT, PRINTER_FORMAT_CUSTOM); // Custom paper format
printer_set_option($handle, PRINTER_PAPER_WIDTH, "76"); // 76mm wide
printer_set_option($handle, PRINTER_MODE, "RAW"); // And raw printing mode

$label = "
! U1 JOURNAL
! U1 SETLP 5 2 46   
AURORA'S FABRIC SHOP\r
! U1 SETLP 5 0 24
123 Castle Drive, Kingston, RI 02881\r           
(401) 555-4CU            \r\n
! U1 SETLP 7 0 24
4:20 PM    Thursday, June 04, 2020   Store: 142 \r

Order Number: #59285691                         \r
Status: ! U1 SETSP 10
INCOMPLETE ! U1 SETSP 0
\r\n
Item Description   Quant.    Price Subtotal Tax \r\n

1211 45Buckram    5 yds@  $3.42/yd   $17.10  Y  \r

Z121 60Blue Silk 10 yds@ $15.00/yd  $150.00  N  \r

Z829 60Muslin    20 yds@  $1.00/yd   $20.00  Y  \r

SUBTOTAL:                    $187.10     \r
RHODE ISLAND SALES TAX 7.00%:  $2.60     \r\n
TOTAL:                       $189.70     \n";
$label .= "! 200 200 200 120 1\n";
$label .= "PCX 0 30\n";

$filename = 'images/zebra.pcx';
$handler = fopen($filename, "r");
$bin_content = fread($handler, filesize($filename));

$label .= "$bin_content\n";
fclose($handler);

$label .= "ENDPCX.LBL\n";
$label .= "FORM\n";
$label .= "PRINT\n";
$label .= "! U1 SETLP 7 1 48

PLEASE BRING THIS RECEIPT TO THE CASHIER   \r
WITH THE REST OF YOUR PURCHASES.      \r\n
! U1 CENTER
! U1 B 128 1 2 100 0 0 59285691 ST 187.10 T 2.60
\r\n
\r\n";


printer_write($handle, $label); // Sample text
printer_close($handle);
?>