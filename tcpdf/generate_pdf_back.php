<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2012-07-25
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               Manor Coach House, Church Hill
//               Aldershot, Hants, GU12 4RQ
//               UK
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

session_start();

require_once('config/lang/eng.php');
require_once('tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('');
$pdf->SetSubject('');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' ', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData($tc=array(0,64,0), $lc=array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));


$cv_name = $_SESSION['cv_name'];
$cv_nationality = $_SESSION['cv_nationality'];
$cv_dob = date('d M Y',strtotime($_SESSION['cv_dob']));
$cv_marital_status = $_SESSION['cv_marital_status'];
$cv_contact_no = $_SESSION['cv_contact_no'];
$cv_email = $_SESSION['cv_email'];
$cv_passport_no = $_SESSION['cv_passport_no'];
$cv_country_of_issue = $_SESSION['cv_country_of_issue'];
$cv_passport_expire_date = date('d M Y',strtotime($_SESSION['cv_passport_expire_date']));

$cv_qualification = '<table><tr><td colspan="2">None</td></tr></table>';
if(isset($_SESSION['cv_qualifications']) && !empty($_SESSION['cv_qualifications']))
{
    $cv_qualification = '<table>';
    foreach($_SESSION['cv_qualifications'] as $key => $value)
    {
        $cv_qualification .= '<tr><td colspan="2">'.$value.'</td></tr>';
    }
    $cv_qualification .= '</table>';
}

$cv_safety = '<table><tr><td colspan="2">None</td></tr></table>';
if(isset($_SESSION['cv_safety']) && !empty($_SESSION['cv_safety']))
{
    $cv_safety = '<table>';
    foreach($_SESSION['cv_safety'] as $key => $value)
    {
        $cv_safety .= '<tr><td colspan="2">'.$value.'</td></tr>';
    }
    $cv_safety .= '</table>';
}

$cv_skills = '<table><tr><td colspan="2">None</td></tr></table>';
if(isset($_SESSION['cv_skills']) && !empty($_SESSION['cv_skills']))
{
    $cv_skills = '<table>';
    foreach($_SESSION['cv_skills'] as $key => $value)
    {
        $cv_skills .= '<tr><td colspan="2">'.$value.'</td></tr>';
    }
    $cv_skills .= '</table>';
}

$cv_experience = '<table><tr><td colspan="2">None</td></tr></table>';
if(isset($_SESSION['cv_experience']) && !empty($_SESSION['cv_experience']))
{
    $cv_experience = '<table>';
    foreach($_SESSION['cv_experience'] as $key => $value)
    {
        $cv_experience .= '<tr><td colspan="2">'.$value.'</td></tr>';
    }
    $cv_experience .= '</table>';
}

$cv_certificate = '<table><tr><td colspan="2">None</td></tr></table>';
if(isset($_SESSION['cv_certificate']) && !empty($_SESSION['cv_certificate']))
{
    $cv_certificate = '<table>';
    foreach($_SESSION['cv_certificate'] as $key => $value)
    {
        $cv_certificate .= '<tr><td colspan="2"><img src="../scripts/without-flash-uploader/files-upload-script/uploads/'.$value.'"/></td></tr>';
    }
    $cv_certificate .= '</table>';
}

// Set some content to print
$html = <<<EOD
<h1>CV of $cv_name</h1>
<hr/>
<div style="clear: both; height: 40px;"></div>
<h3>Personal Information</h3>
<table>  
<tr>
    <td class="cv_label">Nationality</td><td class="cv_info">: $cv_nationality</td>
</tr> 
<tr>
    <td class="cv_label">Date of Birth</td><td class="cv_info">: $cv_dob</td>
</tr>
<tr>
    <td class="cv_label">Marital Status</td><td class="cv_info">: $cv_marital_status</td>
</tr>
<tr>
    <td class="cv_label">Contact No</td><td class="cv_info">: $cv_contact_no</td>
</tr>
<tr>
    <td class="cv_label">Email</td><td class="cv_info">: $cv_email</td>
</tr>
<tr>
    <td class="cv_label">Passport No</td><td class="cv_info">: $cv_passport_no</td>
</tr>
<tr>
    <td class="cv_label">Country of Issue</td><td class="cv_info">: $cv_country_of_issue</td>
</tr>
<tr>
    <td class="cv_label">Expiry Date</td><td class="cv_info">: $cv_passport_expire_date</td>
</tr>
</table>
<div style="clear: both; height: 20px;"></div>
<h3>Professional Training and Qualifications</h3>
$cv_qualification
<div style="clear: both; height: 20px;"></div>
<h3>Safety Training Courses and Medical</h3>
$cv_safety
<div style="clear: both; height: 20px;"></div>
<h3>Other Training and Skills</h3>
$cv_skills
<div style="clear: both; height: 20px;"></div>
<h3>Work Experience</h3>
$cv_experience
<div style="clear: both; height: 20px;"></div>

<div style="page-break-inside:avoid;">
<h3>Certificates</h3>
$cv_certificate
</div>


<style type="text/css">
.cv_label
{
    width: 200px;
}
.cv_info
{
}
.cv_heading
{
    font-weight: bold;
    font-size: 200%;
}
table tr
{
    padding: 15px 0;
    height: 40px;
}
</style>
EOD;

//$html = 'Dhaka is the capital of Bangladesh';


// Print text using writeHTMLCell()
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

//$pdf->lastPage();
//$pdf->AddPage();


// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('My_CrewBook_CV.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+