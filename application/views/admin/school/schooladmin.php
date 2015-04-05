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
?>
<!-- Validation form -->
        <form id="validate" name="validate" class="form" method="post" action="">
            <fieldset>
                <div class="widget">
                    <div class="title"><h6>Create School Admin</h6></div>

                    
                    
                    <div class="formRow" >
                        <label>Admin Email<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="text" value="" name="admin_email" id="admin_email" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    
                    <div class="formRow" >
                        <label>Password<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree"><input class="validate[required]" type="password" value="" name="admin_password" id="admin_password" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>School<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree">
                                 <select id="school_id" name="school_id" class="validate[required]" >
                                    <option value="" >Select One</option>
                                    <?php
                                     if($schoolInfo)
                                     {
                                         foreach($schoolInfo as $sInfo)
                                         {
                                    ?>
                                            <option value="<?php echo $sInfo['school_id']?>" ><?php echo $sInfo['school_name']?></option>
                                    <?php
                                         }
                                     }
                                    ?>
                                 </select>
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>



                    <div class="formSubmit"><input type="submit" value="submit" class="redB" /></div>
                    <div class="clear"></div>
                </div>
                
            </fieldset>
        </form> 
        
        <script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/cmn.js"></script>
        