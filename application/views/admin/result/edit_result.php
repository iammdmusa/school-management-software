<style>
.imageupload_area{width:100%;float:left;}
.imageupload_area_L{width:30%;float:left;}
.imageupload_area_R{width:70%;float:left;}
.smallImgArea{width:40px;height:40px;float:left;margin-right:5px;margin-bottom:5px;}
.feature_LR{width:50%;float:left;}
.airport_stopage{float: left;clear: both;}
.airport_list_div{display: none;}


.divBox
{
    width:100%;
    float:left;
}
.clear{ clear: both; }
.levelttlBOX
{
   width:75px;
   float:left;
}
.selectionBox
{
   width:150px;
   float:left; 
   margin-right: 20px;
}
.examDate
{
    width:400px;
    float:left;
}
.actionBox
{
    width:300px !important;
    float:left !important;
}
.exmL
{
    width:120px;
    float:left;
}
.exmR
{
    width:120px;
    float:left;
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
<link href="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui-timepicker-addon.css" />
<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/datepicker/jquery-ui-sliderAccess.js"></script>


<!-- Validation form -->
        <form id="validate" name="validate" class="form" method="post" action="">
            <fieldset>
                <div class="widget">
                    <div class="title"><h6>Edit Result</h6></div>

                    <div class="formRow" >
                        
                        <div class="divBox">
                            <div class="levelttlBOX">
                            Class
                            </div>
                            <div class="selectionBox">
                                <select id="class_name_id" name="class_name_id" onchange="get_section_list(this.value);"> 
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
                            </div>
                            
                            
                            <div class="levelttlBOX">
                                Section
                            </div>
                            <div class="selectionBox">
                                <select id="section_id" name="section_id" onchange="get_subject_list(this.value);"> 
                                    <option value="">Select One</option>
                                </select>  
                            </div>
                            
                            <div class="levelttlBOX">
                                Subject
                            </div>
                            <div class="selectionBox">
                                <select id="class_id" name="class_id" > 
                                    <option value="">Select One</option>
                                </select> 
                            </div>
                            
                            <div class="levelttlBOX">
                                Exam
                            </div>
                            <div class="selectionBox">
                                <select id="exam_id" name="exam_id" > 
                                    <option value="">Select One</option>
                                    <?php
                                     if($examList)
                                     {
                                         foreach($examList as $eList)
                                         {
                                    ?>
                                            <option value="<?php echo $eList['exam_id'];?>" ><?php echo $eList['exam_name'];?></option>
                                    <?php
                                         }
                                     }
                                    ?>
                                </select>                            
                            </div>
                            
                        </div>
                        <div class="clear"></div>
                        
                    </div> 
                    
                    
                    
                    
                    
                    
                    <div class="formRow" >
 
                        <div class="examDate">
                            <div class="exmL">
                                Exam Date
                            </div>
                            <div class="exmR">
                                <input type="text" class="datepicker" id="exam_date" name="exam_date"/>
                                <script type="text/javascript">
                                        $('#exam_date').datepicker({
                                            dateFormat: "yy-mm-dd"
                                        });
                                </script>
                            </div>
                        </div>
                        
                        <div class="formRight actionBox">
                            <span class="oneThree">
                                <input type="button" id="showBtn"  name="showBtn" value="Show" onclick="edit_result_list(); return false;" />                     
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>

                    
                   <div class="formRow" >
                        <link href="<?php echo BASEURL?>styles/custom_table.css" rel="stylesheet" type="text/css" /> 
               
                        
                        <div class="custom_table" id="student_result_list">
                        
                        <!-- -->
                        
                        
                            
                        <!-- -->
                        
                        
                        
                        </div>
                    
                        <div class="clear"></div>
                   </div>      
                    

                    <div class="formSubmit"><input type="submit" value="submit" class="redB" /></div>
                    <div class="clear"></div>
                </div>
                
            </fieldset>
        </form> 
         <div style="display:none;" id="class_id"></div>
         
     <script>
     function get_section_list(class_name_id)
     {
        if(!class_name_id)
        {
            $('#section_id').html('<option value="">--SELECT ONE--</option>'); 
            $('#class_id').html('<option value="">--SELECT ONE--</option>'); 
            return false;
        }
        
        
        
        $.ajax({
            type: "POST",
            url: baseUrl + 'result/get_section_ajax',
            data:
            {                
                'class_name_id':class_name_id
            }, 
            success: function(html_data)
            {
                if (html_data != '')
                {
                    $('#section_id').html(html_data);                    
                }
            }
            }); 
     }
     function get_subject_list(section_id)
     {
        var class_name_id = $('#class_name_id').val();
        if(!section_id)
        {            
            $('#class_id').html('<option value="">--SELECT ONE--</option>'); 
            return false;
        }
        
        $.ajax({
            type: "POST",
            url: baseUrl + 'result/get_subject_list_ajax',
            data:
            {                
                'section_id':section_id,
                'class_name_id':class_name_id
            }, 
            success: function(html_data)
            {
                if (html_data != '')
                {
                    $('#class_id').html(html_data);                    
                }
            }
            }); 
     }
     
     function edit_result_list()
     {
        var class_name_id = $('#class_name_id').val();
        var section_id = $('#section_id').val();
        var class_id = $('#class_id').val();
        var exam_date = $('#exam_date').val();
        
        if(!class_name_id)
        {            
            alert('Class name has been not given');
            return false;
        }
        if(!section_id)
        {            
            alert('Section has not been given');
            return false;
        }
        if(!class_id)
        {            
            alert('Subject has not been given');
            return false;
        }
        if(!exam_date)
        {            
            alert('Exam date has not been given');
            return false;
        }
        
        $.ajax({
            type: "POST",
            url: baseUrl + 'result/edit_result_list_ajax',
            data:
            {                
                'class_name_id':class_name_id,
                'section_id':section_id,
                'class_id':class_id,
                'exam_date':exam_date
            }, 
            success: function(html_data)
            {
                if (html_data != '')
                {
                    $('#student_result_list').html(html_data);                    
                }
            }
            }); 
     }
     </script>