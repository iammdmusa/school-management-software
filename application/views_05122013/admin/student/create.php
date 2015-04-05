<style>
.imageupload_area{width:100%;float:left;}
.imageupload_area_L{width:30%;float:left;}
.imageupload_area_R{width:70%;float:left;}
.smallImgArea{width:40px;height:40px;float:left;margin-right:5px;margin-bottom:5px;}
.feature_LR{width:50%;float:left;}
.airport_stopage{float: left;clear: both;}
.airport_list_div{display: none;}
.profileImg
{
    width:90%;
    border:1px solid #CCCCCC;
    height:250px;
}
.chooseBtn
{
    width: 100%;
    min-height:40px;
    margin-top:10px;
}
.clear
{
    clear:both;
}
.v_gap
{
    height:20px;
}
.previousClass
{
    width:90%;
    float:left;
    min-height:120px;
    border:1px solid #CCCCCC;
}
.form input[type="text"], .form input[type="password"], .form textarea {
    width: 90% !important;
}
#upload
{
    margin-left: 25px;
}
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
                    <div class="title"><h6>Create Student</h6></div>
                    
                    <div class="clear"></div>
                    <div class="v_gap"></div>
                    <div class="v_gap"></div>
                    <div class="clear"></div>
                    
                    <table width="96%" style="margin-left:10px;">
                        <tr>
                            <td style="width:25%;float:left;">
                                <div class="profileImg">
                                        <div class="imageupload_area_R">                                
                                            <div class="smallImgArea">

                                            </div>                                
                                        </div>
                                </div>
                                
                                <div class="chooseBtn">
                                    <div id="upload" ><span>Upload<span></div><span id="status" style="display:none"> <img src="<?php echo BASEURL?>scripts/upload_js/loading.gif" /> </span>
                                </div>                                
                                <div class="clear"></div>
                                <div class="v_gap"></div>
                                
<!--                                <div class="previousClass">
                                    
                                    previousClass
                                </div>-->
                                
                            </td>
                            <td style="width:70%;float:left;">
                                <table width="100%">
                                    <tr>
                                        <td style="width:50%;float:left;">
                                            <table width="100%">
                                                <tr>
                                                    <td style="width:30%;float:left;">Full Name</td>
                                                    <td style="width:70%;float:left;"><input class="validate[required]" type="text" value="" name="name" id="name" /></td>
                                                </tr>
                                                <tr><td colspan="2">&nbsp;</td></tr>
                                                <tr>
                                                    <td style="width:30%;float:left;">Nick Name</td>
                                                    <td style="width:70%;float:left;"><input class="validate[required]" type="text" value="" name="nickname" id="nickname" /></td>
                                                </tr>
                                                <tr><td colspan="2">&nbsp;</td></tr>
                                                <tr>
                                                    <td style="width:30%;float:left;">Birth Date</td>
                                                    <td style="width:70%;float:left;">
                                                        <input type="text" class="datepicker" id="birthdate" name="birthdate"/>
                                                        <script type="text/javascript">
                                                                $('#birthdate').datepicker({
                                                                    dateFormat: "yy-mm-dd"
                                                                });
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr><td colspan="2">&nbsp;</td></tr>
                                                <tr>
                                                    <td style="width:30%;float:left;">Gender</td>
                                                    <td style="width:70%;float:left;">
                                                        <select id="gender" name="gender">
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                        </td>
                                        <td style="width:50%;float:left;">
                                            <table width="100%">
                                                <tr>
                                                    <td style="width:30%;float:left;">Status</td>
                                                    <td style="width:70%;float:left;">
                                                        <select id="is_enrolled" name="is_enrolled">
                                                            <option value="Enrolled">Enrolled</option>
                                                            <option value="Notenrolled">Notenrolled</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr><td colspan="2">&nbsp;</td></tr>
                                                <tr>
                                                    <td style="width:30%;float:left;">Class</td>
                                                    <td style="width:70%;float:left;">
                                                        <select   id="class_name_id" name="class_name_id" onclick="get_class_section(this.value);"> 
                                                            <option value="" >Select One</option>
                                                            <?php
                                                             if($class)
                                                             {
                                                                 foreach($class as $cls)
                                                                 {
                                                            ?>
                                                                    <option value="<?php echo $cls['class_name_id'];?>" ><?php echo $cls['classname'];?></option>
                                                            <?php
                                                                 }
                                                             }
                                                            ?>
                                                        </select>    
                                                    </td>
                                                </tr>
                                                <tr><td colspan="2">&nbsp;</td></tr>
                                                <tr>
                                                    <td style="width:30%;float:left;">Section</td>
                                                    <td style="width:70%;float:left;">
                                                        <select   id="section_id" name="section_id"> 
                                                            <option value="" >Select One</option>
                                                        </select> 
                                                    </td>
                                                </tr>
                                                <tr><td colspan="2">&nbsp;</td></tr>
                                                <tr>
                                                    <td style="width:30%;float:left;">Roll No</td>
                                                    <td style="width:70%;float:left;">
                                                        <input class="validate[required]" type="text" value="" name="roll_no" id="roll_no" /> 
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                
                                <div class="clear"></div>
                                <div class="v_gap"></div>                                
                                <div class="clear"></div>
                                
                                
                                <table width="100%">
                                    <tr>
                                        <td style="width:50%;float:left;">
                                            <table width="100%">
                                                <tr>
                                                    <td style="width:30%;float:left;">Home Address</td>
                                                    <td style="width:70%;float:left;">
                                                        <textarea id="homeaddress" name="homeaddress" ></textarea>
                                                    </td>
                                                </tr>
                                                <tr><td colspan="2">&nbsp;</td></tr>
                                                <tr>
                                                    <td style="width:30%;float:left;">City</td>
                                                    <td style="width:70%;float:left;"><input  type="text" value="" name="city" id="city" /></td>
                                                </tr>
                                                <tr><td colspan="2">&nbsp;</td></tr>
                                                <tr>
                                                    <td style="width:30%;float:left;">Country</td>
                                                    <td style="width:70%;float:left;">
                                                        <select id="country" name="country">
                                                            <option value="BD">Bangladesh</option>                                                            
                                                        </select>
                                                    </td>
                                                </tr>

                                                
                                            </table>
                                        </td>
                                        <td style="width:50%;float:left;">
                                            <table width="100%">
                                                <tr>
                                                    <td style="width:30%;float:left;">Home Phone</td>
                                                    <td style="width:70%;float:left;">
                                                        <td style="width:70%;float:left;"><input  type="text" value="" name="homephone" id="homephone" /></td>
                                                    </td>
                                                </tr>
                                                <tr><td colspan="2">&nbsp;</td></tr>
                                                <tr>
                                                    <td style="width:30%;float:left;">Cell Phone</td>
                                                    <td style="width:70%;float:left;">
                                                        <td style="width:70%;float:left;"><input  type="text" value="" name="cellphone" id="cellphone" /></td>
                                                    </td>
                                                </tr>
                                                <tr><td colspan="2">&nbsp;</td></tr>
                                                <tr>
                                                    <td style="width:30%;float:left;">Email</td>
                                                    <td style="width:70%;float:left;">
                                                        <td style="width:70%;float:left;"><input  type="text" value="" name="email" id="email" /></td>
                                                    </td>
                                                </tr>                                                
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                
                                
                                
                                <div class="clear"></div>
                                <div class="v_gap"></div>                                
                                <div class="clear"></div>
                                
                                
                                <table width="100%">
                                    <tr>
                                        <td style="width:50%;float:left;">
                                            <table width="100%">
                                                <tr>
                                                    <td style="width:30%;float:left;">Father's Name</td>
                                                    <td style="width:70%;float:left;">
                                                        <input class="validate[required]" type="text" value="" name="father_name" id="father_name" />
                                                    </td>
                                                </tr>
                                                <tr><td colspan="2">&nbsp;</td></tr>
                                                <tr>
                                                    <td style="width:30%;float:left;">Mother's Name</td>
                                                    <td style="width:70%;float:left;"><input class="validate[required]" type="text" value="" name="mother_name" id="mother_name" /></td>
                                                </tr>

                                            </table>
                                        </td>
                                        <td style="width:50%;float:left;">
                                            <table width="100%">
                                                 <tr>
                                                    <td style="width:30%;float:left;">Gurdian's Name</td>
                                                    <td style="width:70%;float:left;">
                                                        <input class="validate[required]" type="text" value="" name="gurdian_name" id="gurdian_name" />
                                                    </td>
                                                </tr>
                                                <tr><td colspan="2">&nbsp;</td></tr>
                                                <tr>
                                                    <td style="width:30%;float:left;">Gurdian Relation</td>
                                                    <td style="width:70%;float:left;">
                                                        <td style="width:70%;float:left;"><input class="validate[required]" type="text" value="" name="gurdian_relation" id="gurdian_relation" /></td>
                                                    </td>
                                                </tr>
                                                <tr><td colspan="2">&nbsp;</td></tr>
                                                <tr>
                                                    <td style="width:30%;float:left;">Gurdian Phon No</td>
                                                    <td style="width:70%;float:left;">
                                                        <td style="width:70%;float:left;"><input class="validate[required]" type="text" value="" name="gurdian_phon_no" id="gurdian_phon_no" /></td>
                                                    </td>
                                                </tr>                                                
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                
                                
                                
                                
                                
                            </td>
                        </tr>
                    </table>


                    <div class="formSubmit"><input type="submit" value="submit" class="redB" /></div>
                    <div class="clear"></div>
                </div>
                
            </fieldset>
        </form> 
         <div style="display:none;" id="class_id"></div>
        <script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/cmn.js"></script>