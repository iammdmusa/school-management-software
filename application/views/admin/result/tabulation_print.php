<?php $i=0; ?>
<!DOCTYPE html>
<html>
<head>
	<style>
        body{font-family:Myriad Pro;color:#000;background-color:#ddd;margin:0;padding:0;font-size: 16px;}
        input[type=text],textarea{border:1px solid #CFCECD}
        table {border-collapse: collapse;border-spacing: 0;}
        .bg{background-color:#fff;min-width:1280px;margin:0 auto 0px auto;padding-left:20px;padding-right:20px;border-radius:5px;}
        .structure{max-width:100%;margin:0 auto;}
        .fix{overflow:hidden;}
        .logo{float:left;width:200px;}
        .logo img{margin-top: 30px;margin-right:5px;width: 80px;}
        .header_text h1{color: #000000;font-size: 19px; text-align: center; margin: 0;}
        .header_text h2{color: #000000;font-size: 15px;line-height: 5px;text-align: center;}
        .upper_main_content{}
        .header_title{margin-bottom: 0px;margin-top: 0px;}
        .header_title h1{color: #000000;font-size: 20px;text-align: center;}
        .header_title h2{color: #000000;font-size: 15px;text-align: center;}
        .header_title span hr{margin-top: -12px;width: 181px;}
        .header_title  hr{margin-top: -12px;width: 90px;}

        .upper_main_content_left_side{float: left;width: 414px;}

        .upper_main_content_left_side h1{font-size:15px;font-style: italic;}
        .upper_main_content_left_side h2{font-style:italic;font-size:15px;line-height:10px;border-radius:10px;}
        .upper_main_content_left_side h3{font-style:italic;font-size:15px;line-height:10px;border-radius:10px;}
        .upper_main_content_right_side{float:right;}
        .upper_main_content_right_side table{margin-top:0px;width:180px;}
        .upper_main_content_right_side table tr,th{text-align:center;}
        .clase_event{margin-bottom: 14px;margin-top: -70px;}
        .clase_event table{border-radius: 20px 20px 20px 20px;width: 365px;}
        .clase_event table th,td{text-align:center}
        .upper_main_content_left_side{}
        .main_content{float:center;margin-bottom:10px;}
        .main_content table{width: 100%;height:10px;}
        .second_table  table {}
        .second_table  table td{}
        .second_table  table td:first-child{font-weight: bold;width: 367px;}
        .second_table  table td:last-child{width: 133px;}
        .final_grade{border: 1px solid #000000;margin-bottom: 0px;margin-left: 1px;width: 588px;}
        .final_grade form{float:left;}
        .final_grade form p {float:left;margin-right:5px;}
        .final_grade form p:first-child {margin-left:4px;}
        .final_grade form p input[type=text] {margin-right: 0px;width: 35px;}
        .remarks{padding:2px;}
        .remarks textarea{border: 1px solid #000000;padding: 0px;width: 560px;}
        .footer{margin-top:0px;}
        .class_teacher{float: left;margin-right: 20px;margin-top: 20px;width: 170px;}
        .class_teacher:first-child{float:left;margin-right:20px;margin-left:20px;}
        .class_teacher:last-child{float:left;margin-left:0px;}
        .class_teacher p{text-align:center;}
        table.maintable { page-break-inside:auto }
        tr { page-break-inside:avoid; page-break-after:auto }
        .maintable	{ /*display: block;*/ page-break-after: always; }
        .tabulation_table tr td {border:2px solid #000;}
        @media print {.tabulation_table {page-break-after: always;}}
    </style>
</head>

<body>  
    <table cellpadding="0" cellspacing="0" width="100%" class="maintable" align="center">
        <tr>
            <td>
                <div class="bg">
                    <div class="header structure fix">
                        <div class="header_text">
                            <div class="schoolImg">
                                <img width="136" height="81" style="" src="http://xenontech.net/school/images/logo/thumb/<?php echo $img; ?>" alt="">
                            </div>
                            <h1><?php echo $school?></h1>
                        </div>
                    </div>
                    <div class="upper_main_content structure fix">
                        <div class="header_title">
                            <h1>Tabulation Sheet</h1>
                            <span><hr></span>
                            <div style="clear:both;"></div>
                            <hr>
                        </div>
                        <div class="upper_main_content_left_side fix">    
                            <table>
                                <tr>
                                   <td style="text-align:left;">Class</td>
                                   <td style="text-align:left;">: <?php echo $class_name; ?></td>
                                </tr>
                                <tr>
                                   <td style="text-align:left;">Section</td>
                                   <td style="text-align:left;">: <?php echo $section_name; ?></td>
                                </tr>
                                <tr>
                                   <td style="text-align:left;">Exam</td>
                                   <td style="text-align:left;">: <?php echo $exam_name; ?></td>
                                </tr>
                            </table>  
                        </div>
                        <div class="upper_main_content_right_side fix" style="font-size:10px;">
                            <table border="1">
                                <tr><th>Letter Grade</th><th>Grade Point</th></tr>
                                <tr><td>A+</td><td>5</td></tr>
                                <tr><td>A</td><td>4.5</td></tr>
                                <tr><td>A-</td><td>4</td></tr>
                                <tr><td>B+</td><td>3.5</td></tr>
                                <tr><td>B</td><td>3</td></tr>
                                <tr><td>C</td><td>2.5</td></tr>
                                <tr><td>F</td><td>0</td></tr>
                            </table>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div style="height:10px;"></div>
                    <div style="clear:both;"></div>
                    <div class="main_content structure fix">
                        <table class="tabulation_table">
                            <tbody>
                                <tr class="yellow">
                                    <td>ID</td>
                                    <td style="text-align:left;">Student name(roll)</td>
                                    <?php if(count($subjects)): ?>
                                        <?php for($i=0; $i<count($subjects); $i++): ?>
                                            <td colspan='2'><?php echo $subjects[$i]; ?></td>
                                        <?php endfor; ?>
                                    <?php else: ?>
                                        <td>Results</td>
                                    <?php endif; ?>
                                    <td>Total marks</td>
                                    <td>Position</td>
                                    <td>GPA</td>
                                </tr>
                                <?php foreach($students as $student): ?>
                                    <tr>
                                        <td><?php echo $student->display_id; ?></td>
                                        <td style="text-align:left;">
                                            <?php echo $student->name; ?>(<?php echo $student->roll_no; ?>)
                                        </td>
                                        <?php if($student->results): ?>
                                            <?php foreach($student->results as $result): ?>
                                                <td style="border-right:1px solid #000;"><?php echo $result->marks; ?></td>
                                                <td style="border-left:0px;"><?php echo $result->grade_id; ?></td>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <td>No Results found</td>
                                        <?php endif; ?>
                                        <td><?php echo $result_summary['total_marks'][$student->student_id]; ?></td>
                                        <td><?php echo $result_summary['rank'][$student->student_id]; ?></td>
                                        <td><?php echo $result_summary['gpa'][$student->student_id]; ?></td>
                                    </tr>
                                    <?php if($i%38 == 0): ?>
                                        </tbody>
                                        </table>
                                        <p>&nbsp;</p>
                                        <table class="tabulation_table">
                                            <tbody>
                                                <tr class="yellow subject_header">
                                                    <td>ID</td>
                                                    <td>Student name(roll)</td>
                                                    <?php if(count($subjects)): ?>
                                                        <?php for($i=0; $i<count($subjects); $i++): ?>
                                                            <td colspan='2'><?php echo $subjects[$i]; ?></td>
                                                        <?php endfor; ?>
                                                    <?php else: ?>
                                                        <td>Results</td>
                                                    <?php endif; ?>
                                                    <td>Total marks</td>
                                                    <td>Position</td>
                                                    <td>GPA</td>
                                                </tr>
                                    <?php endif; ?>
                                <?php $i++; endforeach; ?>
                            </tbody>                        
                        </table>
                        <div style="clear:both;">&nbsp;</div>
                    </div>
                </div> 
            </td>
        </tr>
    </table>
</body>
</html>