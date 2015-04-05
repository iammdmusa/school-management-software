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
  
  #dumpVar($schoolInfo);
?>
<!-- Validation form -->
        <form id="validate" name="validate" class="form" method="post" action="">
            <input type="hidden" id="school_id" name="school_id" value="<?php echo $schoolInfo['school_id'];?>" />
            <input type="hidden" id="admin_id" name="admin_id" value="<?php echo $schoolInfo['admin_id'];?>" />
            <fieldset>
                <div class="widget">
                    <div class="title"><h6>Create School</h6></div>
                        
                    <div class="formRow" >
                        <label>School Name<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" name="school_name" id="school_name" value="<?php echo $schoolInfo['school_name']?>" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Mail ID<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" name="mail_id" id="mail_id"  value="<?php echo $schoolInfo['mail_id']?>"  /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>SID<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="<?php echo $schoolInfo['sid']?>" name="sid" id="sid" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Phone No<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text"  name="phon_no" id="phon_no" value="<?php echo $schoolInfo['phon_no']?>"  /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                     <div class="formRow" >
                        <label>School Short Name<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" name="school_short_name" id="school_short_name"  value="<?php echo $schoolInfo['school_short_name']?>" /></span>
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
                                          <?
                                          if($schoolInfo['logo'])
                                          {
                                          ?>
                                            <img border="0" src="<?php echo BASEURL?>images/logo/small/<?php echo $schoolInfo['logo'];?>">
                                          <?
                                          }
                                          ?>
                                    </div>

                                
                                </div>
                            
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Billing Information<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text"  name="billing_information" id="billing_information" value="<?php echo $schoolInfo['billing_information']?>"  /></span>
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
                                        <option <?php if($i == $schoolInfo['current_billing_year']){ echo 'selected="selected"';} ?>  value="<?php echo $i?>"><?php echo $i?></option>
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
                                    <option value="1" <?php if($schoolInfo['billing_status'] == 1){ echo 'selected="selected"';} ?>>Enable</option>
                                </select>
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Monthly SMS Quota<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" name="sms_quota" id="sms_quota" value="<?php echo $schoolInfo['sms_quota']?>"  /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>School Username<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text"  name="school_username" id="school_username"  value="<?php echo $schoolInfo['school_username']?>"   /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    
                    <div class="formRow" >
                        <label>School Admin Email</label>
                        <div class="formRight">
                            <span class="oneThree"><input type="text"  name="admin_email" id="admin_email" value="<?php echo $schoolInfo['email']?>"  /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    
                    <div class="formRow" >
                        <label>Admin Password</label>
                        <div class="formRight">
                            <span class="oneThree"><input type="password"  name="school_password" id="school_password" value="******" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>



                    <div class="formSubmit"><input type="submit" value="submit" class="redB" /></div>
                    <div class="clear"></div>
                </div>
                
            </fieldset>
        </form> 
        
        <script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/cmn.js"></script>
        