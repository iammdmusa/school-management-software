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

<?php
  $countryList = getCountryList();

	$admin_id =$tDetails['admin_id'];
	$sql = "SELECT email,password FROM scl_admin WHERE admin_id = $admin_id LIMIT 1";
	$query = $this->db->query($sql);
	$res = $query->row_array();
	
	$sql2 = "SELECT class_name_id,section_id FROM scl_teacher_allowed_attendence WHERE admin_id = $admin_id LIMIT 1";
	$query2 = $this->db->query($sql2);
	$res2 = $query2->row_array();

?>
<!-- Validation form -->
        <form id="validate" name="validate" class="form" method="post" action="<?php echo  BASEURL?>create/edit_teacher">
            <fieldset>
                <div class="widget">
                    <div class="title"><h6>Edit Teacher Info</h6></div>
                        
                    <div class="formRow" >
                        <label>Teacher Name<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="<?php echo $tDetails['name']?>" name="name" id="name"/></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Subject<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="<?php echo $tDetails['subject']?>" name="subject" id="subject"/></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>User ID<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="<?php echo $tDetails['userid']?>" name="userid" id="userid"/></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Phone No<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="<?php echo $tDetails['phon_no']?>" name="phon_no" id="phon_no"//></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Email<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="<?php echo $res['email']; ?>" name="email" id="email" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                     
                    <div class="formRow" >
                        <label>Password<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input type="password" value="" name="password" id="password" placeholder="Add New Password" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>

                     <div class="formRow" >
                        <label>Attendence Allowed</label>
                        <div class="formRight">
                            <span class="oneThree">
                                <select id="attendance_class_name_id" name="attendance_class_name_id">
                                     <?php
                                     if($atnsubject)
                                     {
                                         foreach($atnsubject as $as)
                                         {
                                     ?>                 
                                        <option <?php if(($res2['class_name_id'] == $as['class_name_id']) && ($res2['section_id'] == $as['section_id'])){ echo 'selected=selected'; } ?> value="<?php echo $as['class_name_id'].'-'.$as['section_id']?>"><?php echo $as['classname'].'['.$as['section'].']'?></option>
                                     <?php
                                         }
                                     }
                                     ?>
                                     
                                </select>
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
			<input type="hidden" value="<?php echo $tDetails['teacher_id']; ?>" name="teacher_id" id="teacher_id" />
			<input type="hidden" value="<?php echo $tDetails['admin_id']; ?>" name="admin_id" id="admin_id" />
                    <div class="formSubmit"><input type="submit" value="submit" class="redB" /></div>
                    <div class="clear"></div>
                </div>
                
            </fieldset>
        </form> 
        
        <script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/cmn.js"></script>
        