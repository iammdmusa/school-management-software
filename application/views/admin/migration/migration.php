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
                    <div class="title"><h6>Class Migration</h6></div>

                    <div class="formRow" >
                        <label>From :: Class<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree">
                                <select id="from_class_name_id" name="from_class_name_id" onclick="get_migration_from_class_section(this.value);"> 
                                    <option value="" >Select One</option>
                                    <?php
                                     if($class_name_list)
                                     {
                                         foreach($class_name_list as $cls)
                                         {
                                    ?>
                                            <option value="<?php echo $cls['class_name_id'];?>" ><?php echo $cls['classname'];?></option>
                                    <?php
                                         }
                                     }
                                    ?>
                                </select>                            
                            </span>
                            <label>Section<span class="req">*</span></label>
                            <span class="oneThree">
	                        <select id="from_section_id" name="from_section_id[]" multiple style="width:200px;"> 
	                            <option value="" >Select One</option>
	                        </select>                            
                    	    </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    
                     <div class="formRow" >
                        <label>To :: Class<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree">
                                <select id="to_class_name_id" name="to_class_name_id" onclick="get_migration_to_class_section(this.value);"> 
                                    <option value="" >Select One</option>
                                    <?php
                                     if($class_name_list)
                                     {
                                         foreach($class_name_list as $cls)
                                         {
                                    ?>
                                            <option value="<?php echo $cls['class_name_id'];?>" ><?php echo $cls['classname'];?></option>
                                    <?php
                                         }
                                     }
                                    ?>
                                </select>                            
                            </span>
                            <label>Section<span class="req">*</span></label>
                            <span class="oneThree">
	                        <select id="to_section_id" name="to_section_id"> 
	                            <option value="" >Select One</option>
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
         <div style="display:none;" id="class_id"></div>
        <script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/cmn.js"></script>