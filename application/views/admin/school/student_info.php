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
<?php require_once("application/views/admin/upload-api.php"); ?>
<link href="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui-timepicker-addon.css" />

<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui-sliderAccess.js"></script>
<link href="<?php echo BASEURL?>styles/custom_table.css" rel="stylesheet" type="text/css" /> 

<?php $countryList = getCountryList(); ?>
<!-- Validation form -->
<form id="validate" name="validate" class="form" method="post" action="">
    <fieldset>
        <div class="widget">
            <div class="title"><h6>Create Student</h6></div>
            <div class="formRow custom_table" >
                <table style="width:100%">
                    <tr class="yellow">
                        <td style="widtj:70%;text-align:left;">Class</td>
                        <td style="widtj:30%;text-align:right;">Students</td>
                    </tr>
                    <?php
                    if($class)
                    {
                        $total = 0;
                        foreach($class as $cls)
                        {
                            
                            $class_name_id = $cls['class_name_id'];
                            $school_id          = $_SESSION['school_id'];  
                            
                            $sql = "SELECT COUNT(student_id) as total_student FROM scl_student WHERE status = 1 AND school_id = $school_id AND class_name_id = $class_name_id";
                            $query = $this->db->query($sql);
                            $res = $query->row_array();
                            
                            $total = $total + $res['total_student'];
                    ?>
                    <tr>
                        <td style="widtj:70%;text-align:left;"><?php echo $cls['classname'];?></td>
                        <td style="widtj:30%;text-align:right;"><?php echo $res['total_student']?></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
                <div class="clear"></div>
            </div>
            <div class="formRow" >
                    <span class="oneThree" id="total_student_cnt">Total student on this class : <?php echo $total;?></span>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <div class="formRow">
                Search Student:
                <input id="student_id" type="text" name="student_id" placeholder="Student ID" style="width:200px;">
                <input type="button" id="search" name="search" value="Search">
            </div>
            <div class="clear"></div>
            <div class="formRow" >
                <div class="custom_table" id="student_list_con"></div>
                <div class="clear"></div>
            </div>
        </div>
    </fieldset>
</form> 
<div style="display:none;" id="class_id"></div>
<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/cmn.js"></script>
<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/result.js"></script>
<script type="text/javascript">
    $("#search").click(function() {
        var student_id = $("#student_id").val();
        if(student_id == "") {
            alert("Please enter student ID");
        } else {
            var content = {
                student_id: student_id,
                ajax: true
            };
            $.ajax({
                url: "<?php echo site_url('tabulation_sheet/getStudent')?>",
                type: 'POST',
                data: content,
                success: function(data) { 
                    $('#student_list_con').html(data);
                }
            });
        }
    });
</script>