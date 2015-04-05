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
                    <div class="title"><h6>Update SMS</h6></div>
                    
                     <input type="hidden" id="greeting_id" name="greeting_id" value="<?php echo $greeting['greeting_id']?>" />
                     <div class="formRow" >
                        <label>Greeting Title<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree">
                                <input type="text" id="greeting_title" name="greeting_title" class="validate[required]" value="<?php echo $greeting['greeting_title']?>" />
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                        
                    <div class="formRow" >
                        <label>Greeting<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree">
                                <##STUDENTNAME##><br/>
                                <textarea  name="greeting" id="greeting" class="validate[required]" style="width:500px;height:50px;resize:none;" ><?php echo $greeting['greeting']?></textarea>
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
        