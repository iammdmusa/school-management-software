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

<!-- Validation form -->
        <form id="validate" name="validate" class="form" method="post" action="">
            <fieldset>
                <div class="widget">
                    <div class="title"><h6>Student Attendance</h6></div>

                    <div class="formRow" >
                        <label>Class<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree">
                                <select id="class_name_id" name="class_name_id" onchange="get_class_section1(this.value);"> 
                                    <option value="" >Select One</option>
                                    <?php
                                     if($class)
                                     {
                                         foreach($class as $cls)
                                         {
                                    ?>
                                            <option <?php if($class_name_id == $cls['class_name_id']) { ?> selected="selected" <? } ?> value="<?php echo $cls['class_name_id'];?>" ><?php echo $cls['classname'];?></option>
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
                        <label>Section<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree">
                                <select id="section_id" name="section_id" onchange="set_std_list_ajax1(this.value);"> 
                                    <option value="" >Select One</option>
                                    <?php
                                    if($section_ids_arr)
                                    {
                                        foreach($section_ids_arr as $arr)
                                        {
                                    ?>
                                           <option <?php if($section_id == $arr['section_id']) { ?> selected="selected" <? } ?>  value="<?php echo $arr['section_id']?>" ><?php echo $arr['section']?></option>
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
                            <?php echo $list;?>
                        </div>
                        <div class="clear"></div>
                    </div>                    
                    
                    <div class="formSubmit" id="formSubmit_id">
                    
                        <?php
                        if($attendence)
                        {
                            if($attendence[0]['is_message_sent'] == '0')
                            {
                        ?>
                             <input id="send_button_id"  type="button" value="Send SMS" class="redB send_button_idCSS" onclick="send_gurdian_sms1(document.forms.validate);" />
                             <?php
                            }
                             ?>
                             <input type="submit" value="edit" class="redB" />
                        <?php    
                        }
                        ?>
                    
                    </div>
                    <div class="clear"></div>
                </div>
                
            </fieldset>
        </form> 
         <div style="display:none;" id="class_id"></div>
         <span class="send_button_idCSS"></span>
        <script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/cmn.js"></script>