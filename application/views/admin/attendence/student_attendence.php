<style>
.imageupload_area{width:100%;float:left;}
.imageupload_area_L{width:30%;float:left;}
.imageupload_area_R{width:70%;float:left;}
.smallImgArea{width:40px;height:40px;float:left;margin-right:5px;margin-bottom:5px;}
.feature_LR{width:50%;float:left;}
.airport_stopage{float: left;clear: both;}
.airport_list_div{display: none;}
</style>
<script>
var stops_incrementer = 0; 
var fare_suummary_inc = 0; 


var feature_incrementer = 0; 
var package_incrementer = 0; 
var facility_incrementer = []; 
var fileindex = 1; 
facility_incrementer[0] = 0;
</script>
<link href="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui-timepicker-addon.css" />

<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui-sliderAccess.js"></script>
<link href="<?php echo BASEURL?>styles/custom_table.css" rel="stylesheet" type="text/css" /> 
<?php
  $countryList = getCountryList(); 
?>
<!-- Validation form -->
        <form id="validate" name="validate" class="form" method="post" action="">
            <fieldset>
                <div class="widget">
                    <div class="title"><h6>Student Attendance</h6></div>

                    <div class="formRow" >
                        <label>Class</label>
                        <div class="formRight">
                            <span class="oneThree">
                                
                                <!--select id="class_name_id" name="class_name_id" onchange="update_teacher_attendence_sheet(this.value);"-->
                                <!--option <?php if($class_name_id == $cName['class_name_id']){ ?> selected="selected" <?php } ?>   value="<?php echo $cName['class_name_id']?>" ><?php echo $cName['classname']?></option-->
                                <select id="teacher_allowed_attendence_id" name="teacher_allowed_attendence_id" onchange="update_teacher_attendence_sheet(this.value);">
                                      <?php
                                       if($class_names)
                                       {
                                           foreach($class_names as $cName)
                                           {
                                      ?>
                                        <option <?php if($teacher_allowed_attendence_id == $cName['teacher_allowed_attendence_id']){ ?> selected="selected" <?php } ?>   value="<?php echo $cName['teacher_allowed_attendence_id']?>" ><?php echo $cName['classname'].' - ['.$cName['section'].']';?></option>
                                      <?php
                                           }
                                       }
                                      ?>
                                </select>                     
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>


                    <div class="formRow" >
                        <div class="custom_table" id="student_list_con">
                            <?php
                            if($attendence)
                            {
                            ?>
                                <input type="hidden" id="is_update" name="is_update" value="1" />
                                <input type="hidden" id="send_sms" name="send_sms" value="0" />
                                <table style="width:100%">
                                    <tr class="yellow">
                                        <td style="widtj:50%;text-align:left;">Student Name</td>
                                        <td style="widtj:35%;text-align:left;">Roll No.</td>
                                        <td style="widtj:15%;text-align:left;">Is Present ?</td>
                                    </tr>
                                    <?php
                                    if($attendence)
                                    {
                                        foreach($attendence as $sInfo)
                                        {
                                    ?>
                                    <tr>
                                        <td style="widtj:50%;text-align:left;"><?php echo $sInfo['name']?></td>
                                        <td style="widtj:35%;text-align:left;"><?php echo $sInfo['roll_no']?></td>
                                        <td style="widtj:15%;text-align:right;">
                                            <input type="hidden"  id="is_present_hid<?php echo $sInfo['student_id']?>"  name="is_present_hid[<?php echo $sInfo['student_id']?>]" value="1" />
                                            <input type="checkbox" <?php if($sInfo['is_present'] == '1'){ echo 'checked="checked"'; } ?> id="is_present_<?php echo $sInfo['student_id']?>"  name="is_present[<?php echo $sInfo['student_id']?>]" value="1" />
                                            <input type="hidden" id="section_id_<?php echo $sInfo['student_id']?>"  name="section_id[<?php echo $sInfo['student_id']?>]"  value="<?php echo $sInfo['section_id']?>" />
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    else
                                    {
                                    ?>    
                                     <tr>
                                        <td style="widtj:100%;text-align:center;" colspan="3">No Record Found</td>
                                    </tr>   
                                        
                                    <?php    
                                    }
                                    ?>
                                </table>
                            <?php
                            }
                            else if($studentList)
                            {
                            ?>
                            <table style="width:100%">
                                <tr class="yellow">
                                    <td style="widtj:50%;text-align:left;">Student Name</td>
                                    <td style="widtj:25%;text-align:left;">Roll No.</td>
                                    <td style="widtj:15%;text-align:left;">Is Present ?</td>
                                    <td style="widtj:10%;text-align:left;">Date</td>
                                </tr>
                                <?php
                                if($studentList)
                                {
                                    foreach($studentList as $sInfo)
                                    {
                                ?>
                                <tr>
                                    <td style="widtj:50%;text-align:left;"><?php echo $sInfo['name']?></td>
                                    <td style="widtj:25%;text-align:left;"><?php echo $sInfo['roll_no']?></td>
                                    <td style="widtj:15%;text-align:right;">
                                        <input type="hidden"  id="is_present_hid<?php echo $sInfo['student_id']?>"  name="is_present_hid[<?php echo $sInfo['student_id']?>]" value="1" />
                                        <input type="checkbox" checked="checked" id="is_present_<?php echo $sInfo['student_id']?>"  name="is_present[<?php echo $sInfo['student_id']?>]" value="1" />
                                        <input type="hidden" id="section_id_<?php echo $sInfo['student_id']?>"  name="section_id[<?php echo $sInfo['student_id']?>]"  value="<?php echo $sInfo['section_id']?>" />
                                    </td>
                                    <td style="widtj:10%;text-align:left;"><?php echo date('Y-m-d',time());?></td>
                                </tr>
                                <?php
                                    }
                                }
                                else
                                {
                                ?>    
                                 <tr>
                                    <td style="widtj:100%;text-align:center;" colspan="3">No Record Found</td>
                                </tr>   
                                    
                                <?php    
                                }
                                ?>
                            </table>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="clear"></div>
                    </div>                    
                    
                    <div class="formSubmit" id="formSubmit_id">
                        <?php
                        if($attendence)
                        {
                        ?>
                            <input id="send_button_id"  type="button" value="Send SMS" class="redB" onclick="send_gurdian_sms(document.forms.validate);" />
                        <?php
                        }
                        ?>
                        <input type="submit" value="submit" class="redB" />
                    </div>
                    <div class="clear"></div>
                </div>
                
            </fieldset>
        </form> 
         <div style="display:none;" id="class_id"></div>
        <script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/cmn.js"></script>