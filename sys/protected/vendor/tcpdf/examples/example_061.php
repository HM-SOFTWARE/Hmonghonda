<?php
//============================================================+
// File name   : example_061.php
// Begin       : 2010-05-24
// Last Update : 2014-01-25
//
// Description : Example 061 for TCPDF class
//               XHTML + CSS
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: XHTML + CSS
 * @author Nicola Asuni
 * @since 2010-05-25
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 061');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style
$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	
</style>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">
        <p>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ
          <br />
        ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ
        <br />
        ----------@@@@@@@@----------    </p>
      <table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
      <tr>
            <td align="center"><u>ມະຫາວິທະຍາໄລແຫ່ງຊາດ</u><br />
                  <u>ຄະນະກຳມະການສອບເສັງ</u></td>
            <td valign="top" align="center">ເລກລະຫັດບັດ: 00001</td>
        </tr>
			<tr>
            <td align="center" colspan="2">
                <strong>ບັດອະນຸຍາດເຂົ້າຫ້ອງສອບເສັງ</strong>
              <br/>
                ຄະນະກຳມະການສອບເສັງຄັດເລືອກເອົານັກສຶກສາເຂົ້າຮຽນຕໍ່ທີ່ ມະຫາວະຍາໄລແຫ່ງຊາດ
              </td>
          </tr>
          
      </table>
        
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td align="left">ອະນຸຍາດໃຫ້ <strong>ທ້າວ Annysili</strong></td>
            <td align="left" >ນາມສະກຸນ <strong>Kosmetic</strong></td>
            <td align="left" >ເບີໂທລະສັບ <strong>22224071</strong></td>
          </tr>
      </table>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td align="left">ວັນເດືອນປີເກີດ <strong>2015-12-15</strong></td>
        <td align="left">ປະຈຸບັນຢູ່ບ້ານ <strong>ທາດຫຼວງ</strong></td>
        <td align="left">ເມືອງ <strong>ໄຊເສດຖາ</strong></td>
        <td align="left">ແຂວງ <strong>ນະຄອນຫຼວງວຽງຈັນ</strong></td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td align="left">ຮຽນຈົບ ມ.7 ສົກຮຽນ <strong>2010-11</strong></td>
        <td align="left">ຈາກໂຮງຮຽນ <strong>ແຂວງ ນະຄອນຫຼວງວຽງຈັນ</strong></td>
      </tr>
      <tr>
        <td align="left" colspan="2">ເຂົ້າສອບເສັງເພື່ອຮຽນຕໍ່ທີ່ມະຫາວິທະຍາໄລແຫ່ງຊາດ; ຄັ້ງວັນທີ <strong>2015-12-12</strong> ທີ່ສູນສອບເສັງ ມະຫາວິທະຍາໄລແຫ່ງຊາດ</td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td align="left">ຈຸດສອບເສັງ <strong>ດົງໂດກ</strong></td>
        <td align="left" >ອາຄານສອບເສັງ <strong>X</strong></td>
        <td align="left" >ຫ້ອງສອບເສັງ <strong>X02</strong></td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td align="left"><br/>ໃຫ້ໃຊ້ບິກຂຽນຂໍ້ມູນໃຫ້ຈະແຈ້ງບໍ່ມີຮອຍຂີດຂ້າ</td>
        <td align="left">ທີ່ ນະຄອນຫຼວງວຽງຈັນ, ວັນທີ ...... ເດືອນ ...... ປີ .............
        <br />
        ຄະນະກຳມະການສອບເສັງ
        </td>
      </tr>
      <tr>
        <td align="left" colspan="2">ຕ້ອງຮັກສາບັດເຂົ້າຫ້ອງສອບເສັງນີ້ໄວ້ເພື່ອໃຊ້ເປັນຫຼັກຖານເວລາສະເໜີຕົວເຂົ້າຮຽນ ມຊ</td>
      </tr>
    </table>
   </td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">
        <p>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ
          <br />
        ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ
        <br />
        ----------@@@@@@@@----------    </p>
      <table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
      <tr>
            <td align="center"><u>ມະຫາວິທະຍາໄລແຫ່ງຊາດ</u><br />
                  <u>ຄະນະກຳມະການສອບເສັງ</u></td>
            <td valign="top" align="center">ເລກລະຫັດບັດ: 00001</td>
        </tr>
			<tr>
            <td align="center" colspan="2">
                <strong>ບັດອະນຸຍາດເຂົ້າຫ້ອງສອບເສັງ</strong>
              <br/>
                ຄະນະກຳມະການສອບເສັງຄັດເລືອກເອົານັກສຶກສາເຂົ້າຮຽນຕໍ່ທີ່ ມະຫາວະຍາໄລແຫ່ງຊາດ
              </td>
          </tr>
          
      </table>
        
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td align="left">ອະນຸຍາດໃຫ້ <strong>ທ້າວ Annysili</strong></td>
            <td align="left" >ນາມສະກຸນ <strong>Kosmetic</strong></td>
            <td align="left" >ເບີໂທລະສັບ <strong>22224071</strong></td>
          </tr>
      </table>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td align="left">ວັນເດືອນປີເກີດ <strong>2015-12-15</strong></td>
        <td align="left">ປະຈຸບັນຢູ່ບ້ານ <strong>ທາດຫຼວງ</strong></td>
        <td align="left">ເມືອງ <strong>ໄຊເສດຖາ</strong></td>
        <td align="left">ແຂວງ <strong>ນະຄອນຫຼວງວຽງຈັນ</strong></td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td align="left">ຮຽນຈົບ ມ.7 ສົກຮຽນ <strong>2010-11</strong></td>
        <td align="left">ຈາກໂຮງຮຽນ <strong>ແຂວງ ນະຄອນຫຼວງວຽງຈັນ</strong></td>
      </tr>
      <tr>
        <td align="left" colspan="2">ເຂົ້າສອບເສັງເພື່ອຮຽນຕໍ່ທີ່ມະຫາວິທະຍາໄລແຫ່ງຊາດ; ຄັ້ງວັນທີ <strong>2015-12-12</strong> ທີ່ສູນສອບເສັງ ມະຫາວິທະຍາໄລແຫ່ງຊາດ</td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td align="left">ຈຸດສອບເສັງ <strong>ດົງໂດກ</strong></td>
        <td align="left" >ອາຄານສອບເສັງ <strong>X</strong></td>
        <td align="left" >ຫ້ອງສອບເສັງ <strong>X02</strong></td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td align="left"><br/>ໃຫ້ໃຊ້ບິກຂຽນຂໍ້ມູນໃຫ້ຈະແຈ້ງບໍ່ມີຮອຍຂີດຂ້າ</td>
        <td align="left">ທີ່ ນະຄອນຫຼວງວຽງຈັນ, ວັນທີ ...... ເດືອນ ...... ປີ .............
        <br />
        ຄະນະກຳມະການສອບເສັງ
        </td>
      </tr>
      <tr>
        <td align="left" colspan="2">ຕ້ອງຮັກສາບັດເຂົ້າຫ້ອງສອບເສັງນີ້ໄວ້ເພື່ອໃຊ້ເປັນຫຼັກຖານເວລາສະເໜີຕົວເຂົ້າຮຽນ ມຊ</td>
      </tr>
    </table>
   </td>
  </tr>
</table>

EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_061.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
