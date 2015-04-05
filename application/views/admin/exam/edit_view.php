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

<?php $countryList = getCountryList(); ?>
<!-- Validation form -->
<?php echo form_open('exam/update', array('id' => 'validate', 'name' => 'validate', 'class' => 'form')); ?>
    <fieldset>
        <div class="widget">
            <div class="title"><h6>Edit Exam</h6></div>   
            <?php foreach($exam as $row): ?>
                <div class="formRow">
                    <label>Exam Name<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneThree">
                            <input class="validate[required]" type="text" value="<?php echo $row->exam_name; ?>" name="exam_name" id="exam_name"/>
                        </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formSubmit">
                    <input type="hidden" name="exam_id" value="<?php echo $row->exam_id; ?>">
                    <input type="submit" name="submit" value="submit" class="redB" />
                </div>
            <?php endforeach; ?>
            <div class="clear"></div>
        </div>        
    </fieldset>
<?php echo form_close(); ?>
<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/cmn.js"></script>        