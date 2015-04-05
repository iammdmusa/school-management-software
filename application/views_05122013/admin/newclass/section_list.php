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
                    <div class="title"><h6>Section List</h6></div>

                    
                   <div class="formRow" >
                        <div class="custom_table">
                               <table style="width:100%">
                                    <tr class="yellow">
                                        <td style="widtj:10%;text-align:left;">Section</td>
                                        <td style="widtj:50%;text-align:right;">Action</td>
                                    </tr>
                                    <?php
                                    if($section_list)
                                    {
                                        foreach($section_list as $sList)
                                        {
                                    ?>
                                    <tr>
                                        <td style="widtj:10%;text-align:left;"><?php echo $sList['section']?></td>
                                        <td style="widtj:50%;text-align:right;">
                                            <a href="javascript:void(0);" onclick="delete_section(<?php echo $sList['section_id']?>); return false;">Delete Section</a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </table>
                        
                        
                        </div>
                        <div class="clear"></div>
                   </div>      

                    <div class="clear"></div>
                </div>
                
            </fieldset>
        </form> 
         <div style="display:none;" id="class_id"></div>
        <script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/cmn.js"></script>