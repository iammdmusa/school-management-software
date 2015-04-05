<?php
ini_set("memory_limit","500M");
ini_set('max_execution_time', 800);
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
$pdf->SetFont('', '', 9, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0, 'depth_h'=>0, 'color'=>array(196,196,196), 'opacity'=>0, 'blend_mode'=>'Normal'));

function dumpVar($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    exit();
}

$str = '';
if($_SESSION['result_arr'])
{
    foreach($_SESSION['result_arr'] as $k => $v)
    {
      
      $totalInc = 0;       
      $school = $v[0]['school_name']; 
      $exam = $v[0]['exam_name']; 
      $name = $v[0]['name']; 
      $roll = $v[0]['roll_no']; 
      $class = $v[0]['classname']; 
      $section = $v[0]['section']; 
      $birthdate = date('Y-m-d',strtotime($v[0]['birthdate'])); 
      $date = date('Y-m-d',time());
      
      $total_working_days = $v[0]['total_working_days'] ? $v[0]['total_working_days'] : 0; 
      $absent = $v[0]['absent'] ? $v[0]['absent'] : 0; 
      
      $str .= '<h1 align="center">'.$school.'</h1>';
      $str .= '<p align="center">'.$exam.'</p>';
      $str .= '<hr/>';
      $str .= '<div style="clear: both; height: 40px;"></div>';
      $str .= '<table cellpadding="0" cellspacing="0">  
                    <tr>
                        <td class="cv_label">Name: '.$name.'</td><td class="cv_info" colspan="2">Roll :'.$roll.'</td>    
                    </tr> 
                    <tr>
                        <td colspan="3" style="border-top:1px solid #000000;">&nbsp;</td>    
                    </tr>
                    <tr>
                        <td class="cv_label">Class: '.$class.'</td><td class="cv_info">Section :'.$section.'</td><td class="cv_info">Birthdate :'.$birthdate.'</td>    
                    </tr> 
                    <tr>
                        <td colspan="3" style="border-top:1px solid #000000;">&nbsp;</td>    
                    </tr>
                    <tr>
                        <td class="cv_label">Total Working days: '.$total_working_days.'</td><td class="cv_info" colspan="2">Total Absent :'.$absent.'</td>    
                    </tr>
                    <tr>
                        <td colspan="3" style="border-top:1px solid #000000;">&nbsp;</td>    
                    </tr>
                 </table>';
      $str .= '<div style="clear:both;"></div>';
      $str .= '<table width="100%" cellpadding="0" cellspacing="0"> 
                    <tr class="tbrow1">
                        <td class="tblttl">Subjcet</td>
                        <td class="tblttl">Marks</td>
                        <td class="tblttl">Letter Grade</td>
                        <td class="tblttl">Grade Point</td>
                        <td class="tblttl">Highest Marks</td>
                        <td class="tblttl">Remarks</td>
                    </tr>';
      $inc = 0; 
      foreach($v as $k2 => $v2)
      {          
        $avgMark = $v2['marks'];
        $Obtained_GPA = '';

        if($avgMark>=80)
        {
          $Obtained_GPA_v2 = '5.00';  
          $Obtained_GPA = 'A+';
        }
        else if($avgMark>=70 && $avgMark<79)
        {
          $Obtained_GPA_v2 = '4.00'; 
          $Obtained_GPA = 'A';
        }
        else if($avgMark>=60 && $avgMark<69)
        {
          $Obtained_GPA_v2 = '3.50'; 
          $Obtained_GPA = 'A-';
        }
        else if($avgMark>=50 && $avgMark<59)
        {
          $Obtained_GPA_v2 = '3.00'; 
          $Obtained_GPA = 'B';
        }
        else if($avgMark>=40 && $avgMark<49)
        {
          $Obtained_GPA_v2 = '2.00'; 
          $Obtained_GPA = 'C';
        }
        else if($avgMark>=33 && $avgMark<39)
        {
          $Obtained_GPA_v2 = '1.00'; 
          $Obtained_GPA = 'D';
        }
        else if($avgMark>=0 && $avgMark<32)
        {
          $Obtained_GPA_v2 = '0.00'; 
          $Obtained_GPA = 'F';
        } 
        $str .= '<tr class="tbrow2">
                  <td class="tbltt2">'.$v2['subject'].'</td>
                  <td class="tbltt2">'.$v2['marks'].'</td>
                  <td class="tbltt2">'.$Obtained_GPA.'</td>
                  <td class="tbltt2">'.$Obtained_GPA_v2.'</td>
                  <td class="tbltt2">'.$v2['heightmark'].'</td>
                  <td class="tbltt2">'.$v2['remarks'].'</td>
               </tr>';
        $totalInc = $totalInc + $v2['marks'];
        $inc++;
      }
      $extrarow = 0;
      $str_F = '';
      if($inc<38)
      {
         $extrarow = 38-$inc; 
         
         for($i=0;$i<$extrarow;$i++)
         {
             $str_F .= '<tr><td colspan="6">&nbsp;</td></tr>'; 
         }
      }

        $avgMark = $totalInc/$inc;
        $Obtained_GPA_v2 = '';
        if($avgMark>=80)
        {
          $Obtained_GPA_v2 = '5.00';  
        }
        else if($avgMark>=70 && $avgMark<79)
        {
          $Obtained_GPA_v2 = '4.00'; 
        }
        else if($avgMark>=60 && $avgMark<69)
        {
          $Obtained_GPA_v2 = '3.50'; 
        }
        else if($avgMark>=50 && $avgMark<59)
        {
          $Obtained_GPA_v2 = '3.00'; 
        }
        else if($avgMark>=40 && $avgMark<49)
        {
          $Obtained_GPA_v2 = '2.00'; 
        }
        else if($avgMark>=33 && $avgMark<39)
        {
          $Obtained_GPA_v2 = '1.00'; 
        }
        else if($avgMark>=0 && $avgMark<32)
        {
          $Obtained_GPA_v2 = '0.00'; 
        } 
        
        if($Obtained_GPA == 'F')
        {
           $Obtained_GPA_v2 = '0.00';  
        }
      
      $str .= '<tr class="tbrow3">
                    <td colspan="2"  class="tblttX">&nbsp;Total Marks: '.$totalInc.'</td>
                    <td colspan="4"  class="tblttX">&nbsp;Obtained GPA: '.$Obtained_GPA_v2.'</td>        
                </tr>
                '.$str_F.'
                <tr class="footertext">
                    <td colspan="2">
                    ................
                    <br/>
                    <span>&nbsp;&nbsp;Teacher Signature</span>
                    </td>                    
                    <td colspan="2">
                    ................
                    <br/>
                    <span>&nbsp;&nbsp;Guardian Signature</span>
                    </td>                    
                    <td colspan="2">
                    ................
                    <br/>
                    <span>&nbsp;&nbsp;Principal Signature</span>
                    </td>                    
                </tr>
                <tr>
                    <td colspan="6">
                    &nbsp;
                    </td>                                                         
                </tr>
                <tr>
                    <td colspan="6">
                    Date of Result Publication: '.$date.'
                    </td>                                                         
                </tr>
            </table>';
   }        
}

// Set some content to print
$html = <<<EOD
$str 

<style type="text/css">
.footertext span{font-size:14px;font-weight:bold;}
.tbrow1 
{
    background-color: #E2F5F9;   
    text-align: center;
}
.tbrow2 
{
    background-color: #E2F5F9;
    text-align: center;
    line-height:10px;
}
.tbrow3 
{
    background-color: #F0F0F0;
    text-align: center;
}
.tblttl
{
    color: #004350;
    font-weight: bold;
    line-height:10px;
    border-right:1px solid #ffffff;
}
.tblttl
{
    color: #004350;
    font-weight: bold;
    line-height:10px;
    border-right:1px solid #ffffff;
}
.tbltt2
{
    color: #004350;
    font-weight: normal;
    line-height:10px;
    border-top:1px solid #ffffff;
    border-right:1px solid #ffffff;
}
.tblttX
{
    color: #004350;
    font-weight: normal;
    line-height:10px;
    border-right:1px solid #ffffff;
    border-top:1px solid #ffffff;
    text-align: left;
}

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
.label_text
{
    font-weight: bold;
}
table tr
{
    padding: 10px 0;
    height: 30px;
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
#$pdf->Output('result_list.pdf', 'I');
$pdf->Output('result_list.pdf', 'F');

//============================================================+
// END OF FILE
//============================================================+