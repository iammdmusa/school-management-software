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
var fileindex = 2; 
facility_incrementer[0] = 0;
</script>
<link href="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui-timepicker-addon.css" />

<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui-sliderAccess.js"></script>

<?php
  require_once("application/views/admin/upload-api.php"); 
?>
<!-- Validation form -->
        <form id="validate" name="validate" class="form" method="post" action="">
            <fieldset>
                <div class="widget">
                    <div class="title"><h6>Create School</h6></div>
                        
                    <div class="formRow" >
                        <label>School Name<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="" name="school_name" id="school_name" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Mail ID<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="" name="mail_id" id="mail_id" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>SID<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="" name="sid" id="sid" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Phone No<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="" name="phon_no" id="phon_no" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                     <div class="formRow" >
                        <label>School Short Name<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="" name="school_short_name" id="school_short_name" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow">
                        <label>Logo</label>
                        <div class="formRight">
                            <div class="imageupload_area">
                                <div class="imageupload_area_L">
                                    <div id="upload" ><span>Upload<span></div><span id="status" style="display:none"> <img src="<?php echo BASEURL?>scripts/upload_js/loading.gif" /> </span>
                                </div>
                                <div class="imageupload_area_R">
                                
                                    <div class="smallImgArea">
                                         
                                    </div>

                                
                                </div>
                            
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Billing Information<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="" name="billing_information" id="billing_information" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                     <div class="formRow" >
                        <label>Billing Year<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree">
                                <select id="current_billing_year" name="current_billing_year">
                                    <option value="">Select One</option>
                                    <?
                                    $year = date('Y',time());
                                    for($i=$year;$i<=($year+1);$i++)
                                    {
                                    ?>
                                        <option value="<?php echo $i?>"><?php echo $i?></option>
                                    <?
                                    }
                                    ?>
                                </select>
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Billing Status<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree">
                                <select id="billing_status" name="billing_status">
                                    <option value="0">Disable</option>
                                    <option value="1">Enable</option>
                                </select>
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Monthly SMS Quota<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="" name="sms_quota" id="sms_quota" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>School Username<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="" name="school_username" id="school_username" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    
                    <div class="formRow" >
                        <label>School Admin Email<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="" name="admin_email" id="admin_email" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    
                    <div class="formRow" >
                        <label>Admin Password<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="password" value="" name="school_password" id="school_password" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>



                    <div class="formSubmit"><input type="submit" value="submit" class="redB" /></div>
                    <div class="clear"></div>
                </div>
                
            </fieldset>
        </form> 
        
        <script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/cmn.js"></script>
        