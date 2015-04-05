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
                    <div class="title"><h6>Teacher List</h6></div>

                    
                   <div class="formRow" >
                        <div class="custom_table">
                               <table style="width:100%">
                                    <tr class="yellow">
                                        <td style="widtj:10%;text-align:left;">Teacher Name</td>
                                        <td style="widtj:10%;text-align:left;">Assign Class</td>
                                        <td style="widtj:20%;text-align:left;">Assign Subject</td>
                                        <td style="widtj:10%;text-align:left;">Assign Date</td>
                                        <td style="widtj:50%;text-align:right;">Action</td>
                                    </tr>
                                    <?php
                                    if($teacherList)
                                    {
                                        foreach($teacherList as $tLeas)
                                        {
                                    ?>
                                    <tr>
                                        <td style="widtj:10%;text-align:left;"><?php echo $tLeas['teacher_name']?></td>
                                        <td style="widtj:10%;text-align:left;"><?php echo $tLeas['classname']?></td>
                                        <td style="widtj:20%;text-align:left;"><?php echo $tLeas['subject']?></td>
                                        <td style="widtj:10%;text-align:left;"><?php echo date('Y-m-d',strtotime($tLeas['created_on']))?></td>
                                        <td style="widtj:50%;text-align:right;">
                                            <?php
                                            if($tLeas['teacher_assign_subject_id'])
                                            {
                                            ?>
                                                <a href="javascript:void(0);" onclick="delete_teacher_assign_class(<?php echo $tLeas['teacher_assign_subject_id']?>); return false;">Delete assign class</a> |
                                            <?php
                                            }
                                            if($tLeas['teacher_id'])
                                            {
                                            ?>
                                                <a href="javascript:void(0);" onclick="delete_teacher(<?php echo $tLeas['teacher_id']?>); return false;">Delete Teacher |</a>
                                                <a href="<?php echo BASEURL?>create/teacher_info_edit/<?php echo $tLeas['teacher_id']?>" > Edit</a>
                                            <?php
                                            }
                                            ?>
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