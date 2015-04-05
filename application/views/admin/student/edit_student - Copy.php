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
<?php
  require_once("application/views/admin/upload-api.php"); 
?>
<link href="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui-timepicker-addon.css" />

<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui-sliderAccess.js"></script>

<?php
  $countryList = getCountryList(); 
?>
<!-- Validation form -->
        <form id="validate" name="validate" class="form" method="post" action="">
            <input type="hidden" name="student_id" value="<?php echo $sinfo['student_id']?>" />
            <input type="hidden" name="old_display_id" value="<?php echo $sinfo['old_display_id']?>" />
            <fieldset>
                <div class="widget">
                    <div class="title"><h6>Create Student</h6></div>
                        
                    <div class="formRow" >
                        <label>Student Name<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="<?php echo $sinfo['name']?>" name="name" id="name" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Father's Name<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="<?php echo $sinfo['father_name']?>" name="father_name" id="father_name" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Mother's Name<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="<?php echo $sinfo['mother_name']?>" name="mother_name" id="mother_name" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                     <div class="formRow" >
                        <label>Gurdian's Name<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="<?php echo $sinfo['gurdian_name']?>" name="gurdian_name" id="gurdian_name" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Gurdian Relation<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="<?php echo $sinfo['gurdian_relation']?>" name="gurdian_relation" id="gurdian_relation" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Gurdian Phon No<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="<?php echo $sinfo['gurdian_phon_no']?>" name="gurdian_phon_no" id="gurdian_phon_no" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow" >
                        <label>Class<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree">
                                <select class="validate[required]"  id="class_name_id" name="class_name_id" onclick="get_class_section(this.value);"> 
                                    <option value="" >Select One</option>
                                    <?php
                                     if($class)
                                     {
                                         foreach($class as $cls)
                                         {
                                    ?>
                                            <option <?php if($cls['class_name_id'] == $sinfo['class_name_id']){ ?> selected="selected" <?php } ?>  value="<?php echo $cls['class_name_id'];?>" ><?php echo $cls['classname'];?></option>
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
                                <select class="validate[required]"  id="section_id" name="section_id"> 
                                    <?php
                                        $section_id = $sinfo['section_id'];
                                        $sql = "SELECT * FROM scl_section WHERE section_id = $section_id LIMIT 1";
                                        $query = $this->db->query($sql);
                                        $row = $query->row_array();
                                    ?>
                                    <option value="<?php echo $row['section_id']?>" ><?php echo $row['section']?></option>
                                </select>                            
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    
                    <div class="formRow" >
                        <label>Roll No<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="<?php echo $sinfo['roll_no']?>" name="roll_no" id="roll_no" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Birthdate<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree">
                                <input type="text" class="datepicker" id="birthdate" name="birthdate" value="<?php echo date('Y-m-d',strtotime($sinfo['birthdate']))?>" />
                            </span>
                            <script type="text/javascript">
                                $('#birthdate').datepicker({
                                    dateFormat: "yy-mm-dd"
                                });
                        </script>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow">
                        <label>Images</label>
                        <div class="formRight">
                            <div class="imageupload_area">
                                <div class="imageupload_area_L">
                                    <div id="upload" ><span>Upload<span></div><span id="status" style="display:none"> <img src="<?php echo BASEURL?>scripts/upload_js/loading.gif" /> </span>
                                </div>
                                <div class="imageupload_area_R">
                                
                                    <div class="smallImgArea">
                                           <img src="<?php echo BASEURL?>images/students/small/<?php echo $sinfo['image']?>" />
                                    </div>

                                
                                </div>
                            
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>


                    <div class="formSubmit"><input type="submit" value="submit" class="redB" /></div>
                    <div class="clear"></div>
                </div>
                
            </fieldset>
        </form> 
         <div style="display:none;" id="class_id"></div>
        <script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/cmn.js"></script>