<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
.checker fieldset fieldset{ display: none;}
.checker fieldset { border: 1px solid #000000;}
table { page-break-inside:auto }
tr    { page-break-inside:avoid; page-break-after:auto }
</style>
</head>
	<body>
            <input type="button" onClick="window.print()" value="Print" />
<?php

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
      $str .= '<table cellpadding="0" cellspacing="0" width="100%">  
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
      if($inc<10)
      {
         $extrarow = 10-$inc; 
         
         for($i=0;$i<$extrarow;$i++)
         {
             $str_F .= '<tr><td colspan="6">&nbsp;</td></tr>'; 
         }
      }
      
      if($inc)
      {
         for($i=0;$i<2;$i++)
         {
             $str_F2 .= '<tr><td colspan="6">&nbsp;</td></tr>'; 
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
                '.$str_F2.'                
            </table>
            ';
      echo '<div class="checker"  style="width:700px;margin:0 auto;"><fieldset>'.$str.'<fieldset></div>';
      echo '<div style="clear:both;"></div>';
      echo '<div style="height:20px;"></div>';
      echo '<div style="clear:both;"></div>';
      $str = '';
      $str_F2 = '';
      $str_F = '';
   }        
}
?>
            
	</body>
</html>