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
        <form id="validate" name="validate" class="form" method="post" action="<?php echo BASEURL?>create/send_student_result">
            <fieldset>
                <div class="widget">
                    <div class="title"><h6>Result</h6></div>

                    <div class="formRow" >
                        <label>Class<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree">
                                <select id="class_name_id" name="class_name_id" onchange="get_class_section_list_v2_1(this.value);"> 
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
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow" >
                        <label>Section<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree">
                                <select id="section_id" name="section_id" onchange="get_class_subject_list_v2_1(this.value);"> 
                                    <option value="">Select One</option>
                                </select>                            
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    
                    <div class="formRow" >
                        <label>Subject<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree">
                                <select id="class_id" name="class_id" > 
                                    <option value="">Select One</option>
                                </select>                            
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    
                    <div class="formRow" >
                        <label>Exam<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree">
                                <select id="exam_id" name="exam_id"> 
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
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    
                    <div class="formRow" >
                        <label>Subject<span class="req">*</span></label>
                        <div class="formRight">
                            <span class="oneThree">
                                <input type="button" id="showBtn"  name="showBtn" value="Show" onclick="get_result_sheet_SMS_v2_1(); return false;" />                     
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>

                    
                   <div class="formRow" >
                        <link href="<?php echo BASEURL?>styles/custom_table.css" rel="stylesheet" type="text/css" /> 
                        <style>
                         #student_result_list
                         {
                             float:left;
                             overflow-x:scroll;
                             width:1000px;
                         }
                         .hclass
                         {
                             width:120px;
                             height:100px;
                             float:left;
                             background: #4B5520;
                             border-right:1px solid #D5D5D5;
                         }
                         .hclass p.centertxt
                         {
                             color: #ffffff !important;
                             padding-top: 40px;
                         }
                         .hclass p
                         {
                             color: #ffffff !important;                             
                         }
                         #student_result_list .fg
                         {
                             background: #004759 !important;
                         }
                         
                         .sdtname
                         {
                             width:150px;
                             height:35px;
                             float:left;
                             background: #ffffff;
                             border-bottom:1px solid #4B5520;
                             border-right:1px solid #D5D5D5;
                         }
                         .sdtnamettl
                         {
                            width:150px !important; 
                         }
                         .resultbox
                         {
                             width:120px;
                             height:35px;
                             float:left;
                             background: #ffffff;
                             border-bottom:1px solid #4B5520; 
                             border-right:1px solid #D5D5D5;
                         }
                         .resmarkbox
                         {
                             width:80px;
                             height:35px;
                             float:left; 
                         }
                         .resgrdkbox
                         {
                             width:40px;
                             height:35px;
                             float:left; 
                             background: #D2E19C;
                         }
                         .evn
                         {
                            background: #E5E5E5; 
                         }
                         .pcompromise p
                         {
                            padding-top:8px !important; 
                         }
                         p.ttllpadding
                         {
                            padding-left:10px !important; 
                         }
                         .clear
                         {
                             clear:both;
                         }
                         .v_gap
                         {
                             height:20px;
                         }
                        </style>
                        
                        <div id="student_result_list">
                        
                            
                            <!-- -->
                            
                            <table> 
                                <tr>
                                    <td>
                                        
                                       <div class="hclass sdtnamettl">
                                           <p class="centertxt" align="center">Student name</p>
                                        </div>
                                        
                                        <div class="hclass">
                                            <p align="center">Class test 1</p>
                                            <p align="center">
                                                (Assignment)
                                                <br/>
                                                21/04/2013
                                            </p>
                                        </div>
                                        
                                        <div class="hclass">
                                            <p align="center">Class test 1</p>
                                            <p align="center">
                                                (Assignment)
                                                <br/>
                                                21/04/2013
                                            </p>
                                        </div>
                                        <div class="hclass">
                                            <p align="center">Class test 1</p>
                                            <p align="center">
                                                (Assignment)
                                                <br/>
                                                21/04/2013
                                            </p>
                                        </div>
                                        <div class="hclass">
                                            <p align="center">Class test 1</p>
                                            <p align="center">
                                                (Assignment)
                                                <br/>
                                                21/04/2013
                                            </p>
                                        </div>
                                        <div class="hclass fg">
                                            <p align="center">Final</p>
                                            <p align="center">
                                                (Assignment)
                                                <br/>
                                                21/04/2013
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="pcompromise">
                                    <td>
                                        <div class="sdtname">
                                            <p align="left" class="ttllpadding">Md.Hamim</p>
                                        </div>
                                        
                                        <div class="resultbox">
                                            <div class="resmarkbox">
                                              <p align="center">80</p>
                                            </div>
                                        
                                            <div class="resgrdkbox">
                                              <p align="center">A</p>
                                            </div>                                            
                                        </div>
                                        <div class="resultbox">
                                            <div class="resmarkbox">
                                              80
                                            </div>
                                        
                                            <div class="resgrdkbox">
                                              A
                                            </div>                                            
                                        </div>
                                        <div class="resultbox">
                                            <div class="resmarkbox">
                                              80
                                            </div>
                                        
                                            <div class="resgrdkbox">
                                              A
                                            </div>                                            
                                        </div>
                                        <div class="resultbox">
                                            <div class="resmarkbox">
                                              80
                                            </div>
                                        
                                            <div class="resgrdkbox">
                                              A
                                            </div>                                            
                                        </div>
                                        <div class="resultbox">
                                            <div class="resmarkbox">
                                              80
                                            </div>
                                        
                                            <div class="resgrdkbox">
                                              A
                                            </div>                                            
                                        </div>
                                    </td>
                                </tr>
                                
                                
                                
                                <tr class="pcompromise">
                                    <td>
                                        <div class="sdtname evn">
                                            <p align="left" class="ttllpadding">Md.Hamim</p>
                                        </div>
                                        
                                        <div class="resultbox">
                                            <div class="resmarkbox evn">
                                              <p align="center">80</p>
                                            </div>
                                        
                                            <div class="resgrdkbox">
                                              <p align="center">A</p>
                                            </div>                                            
                                        </div>
                                        <div class="resultbox">
                                            <div class="resmarkbox evn">
                                              80
                                            </div>
                                        
                                            <div class="resgrdkbox">
                                              A
                                            </div>                                            
                                        </div>
                                        <div class="resultbox">
                                            <div class="resmarkbox evn">
                                              80
                                            </div>
                                        
                                            <div class="resgrdkbox">
                                              A
                                            </div>                                            
                                        </div>
                                        <div class="resultbox">
                                            <div class="resmarkbox evn">
                                              80
                                            </div>
                                        
                                            <div class="resgrdkbox">
                                              A
                                            </div>                                            
                                        </div>
                                        <div class="resultbox">
                                            <div class="resmarkbox evn">
                                              80
                                            </div>
                                        
                                            <div class="resgrdkbox">
                                              A
                                            </div>                                            
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            
                            
                                        
                            
                            <!-- -->
                            
                            
                        <div class="clear"></div>
                        <div class="v_gap"></div>
                        <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                   </div>      
                    

                    <div class="formSubmit"><input type="submit" value="Send Message" class="redB" /></div>
                    <div class="clear"></div>
                </div>
                
            </fieldset>
        </form> 
         <div style="display:none;" id="class_id"></div>
        <script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/result.js"></script>
        
    <script>
    function get_class_section_list_v2_1(class_name_id)
    {   
            if(!class_name_id)
            {
               $('#section_id').html('');
               return false;
            } 
            
            $.ajax({ 
             url: baseUrl+'report/get_class_section_list_rs',        
             data:
             {
                   'class_name_id':class_name_id
             },
             dataType: 'json',
             success: function(data)
             {
                 result = ''+data['result']+'';
                 list = ''+data['list']+'';

                 if(result == 'success')
                 {
                    $('#section_id').html(list);     
                 }
                 else if(result == 'fail')
                 {

                 }  
             }
         });
         return false; // keeps the page from not refreshing
    }  

    function get_class_subject_list_v2_1(section_id)
    {
         if(!section_id)
         {
            $('#class_id').html('');
            return false;
         }

         var class_name_id = $('#class_name_id').val();    

        $.ajax({ 
          url: baseUrl+'report/get_class_subject_list_rs',        
          data:
          {
                'section_id':section_id,
                'class_name_id':class_name_id
          },
          dataType: 'json',
          success: function(data)
          {
              result = ''+data['result']+'';
              list = ''+data['list']+'';

              if(result == 'success')
              {
                 $('#class_id').html(list);     
              }
              else if(result == 'fail')
              {

              }  
          }
      });
      return false; // keeps the page from not refreshing 
    }
    
    function get_result_sheet_SMS_v2_1()
    {
          var class_name_id = $('#class_name_id').val(); 
          var section_id = $('#section_id').val(); 
          var class_id = $('#class_id').val(); 
          var exam_id = $('#exam_id').val(); 

          if(!class_name_id)
          {
            $('#class_id').html(''); 
            $('#student_result_list').html(''); 
            return false;
          }
          if(!class_id)
          {
            $('#student_result_list').html(''); 
            return false;
          }

          $.ajax({ 
          url: baseUrl+'report/get_result_sheet_SMS_rs',        
          data:
          {
                'class_name_id':class_name_id,
                'section_id':section_id,
                'exam_id':exam_id,
                'class_id':class_id
          },
          dataType: 'json',
          success: function(data)
          {
              result = ''+data['result']+'';
              list = ''+data['list']+'';

              if(result == 'success')
              {


                 $('#student_result_list').html(list);  
              }
              else if(result == 'fail')
              {

              }  
          }
      });
      return false; // keeps the page from not refreshing

    }
    </script>