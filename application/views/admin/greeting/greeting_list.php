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
<?php
  require_once("application/views/admin/upload-api.php"); 
?>
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
                    <div class="title"><h6>Greeting List</h6></div>

                    
                    
                    <div class="formRow" >
                        
                    <!-- -->    
                    
                    <link href="<?php echo BASEURL?>styles/custom_table.css" rel="stylesheet" type="text/css" /> 
                    <span class="custom_table">
                    <table style="width:100%">
                        <tr class="yellow">
                            <td style="widtj:20%;text-align:left;">Title</td>
                            <td style="widtj:60%;text-align:left;">Message</td>
                            <td style="widtj:20%;text-align:right;">Action</td>
                        </tr>
                        <?php
                        if($greeting)
                        {
                            foreach($greeting as $gr)
                            {
                        ?>
                        <tr>
                            <td style="widtj:20%;text-align:left;"><?php echo $gr['greeting_title']?></td>
                            <td style="widtj:60%;text-align:left;"><?php echo $gr['greeting'];?></td>
                            <td style="widtj:20%;text-align:right;">
                                <?php
                                if($_SESSION['is_superadmin'] == '1')
                                {
                                ?>
                                    <a href="javascript:void(0);" onclick="delete_greeting(<?php echo $gr['greeting_id']?>); return false;">Delet</a> |
                                    <a href="<?php echo BASEURL?>create/edit_greeting/<?php echo $gr['greeting_id']?>" >Edit</a>
                                <?php
                                }
                                else
                                {
                                ?>
                                     <!--div style="width:30px;float:left;"><a href="<?php echo BASEURL?>create/view_greeting/<?php echo $gr['greeting_id']?>" >View</a></div--> 
                                     <!--div class="formSubmit" style="width:80px;float:right;"><input type="button" value="VIEW" class="redB" onclick="new_page(<?php echo $gr['greeting_id']?>);" /></div-->
                                     <!--a href="javascript:void(0);" onclick="send_greeting_sms(<?php echo $gr['greeting_id']?>); return false;" >SEND SMS</a-->
                                     <div class="formSubmit" style="width:80px;float:right;"><input type="button" value="SEND SMS" class="redB" onclick="send_greeting_sms(<?php echo $gr['greeting_id']?>); return false;"  /></div> 
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        else
                        {
                        ?>    
                         <tr>
                            <td style="width:100%;text-align:center;" colspan="3">No Record Found</td>
                        </tr>   
                            
                        <?php    
                        }
                        ?>
                        
                    </table> 
                    </span>
                    <!-- -->    
                        
                        
                        
                        
                        
                        <div class="clear"></div>
                    </div>
                    


                    <div class="clear"></div>
                </div>
                
            </fieldset>
        </form> 
         <div style="display:none;" id="class_id"></div>
        <script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/result.js"></script>
        
<script>
function new_page(greeting_id)
{
    window.location.href = baseUrl+'create/view_greeting/'+greeting_id;
}
</script>