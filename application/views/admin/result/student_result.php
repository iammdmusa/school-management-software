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
    background: #313A43;
    border-right:1px solid #CDCDCD;
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
    border-bottom:1px solid #CDCDCD;
    border-right:1px solid #CDCDCD;
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
    border-bottom:1px solid #CDCDCD; 
    border-right:1px solid #CDCDCD;
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
    border-bottom: 1px solid #E5E5E5;
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
   padding-left:5px !important; 
}
.clear
{
    clear:both;
}
.v_gap
{
    height:20px;
}
.formSubmit input
{
    display:none;
}
</style>
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
   width:100px;
   float:left;
}
.selectionBox
{
   width:180px;
   float:left; 
   margin-right: 20px;
}
messagesendChoiceBox
{
    width: 600px;
    float: left;
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

<?php
  $countryList = getCountryList(); 
?>
<!-- Validation form -->
        <form id="validate" name="validate" class="form" method="post" action="<?php echo BASEURL?>report/send_student_result">
            <fieldset>
                <div class="widget">
                    <div class="title"><h6>Result</h6></div>

                    <div class="formRow" >
                        
                        <div class="divBox">
                            <div class="levelttlBOX">
                            Class
                            </div>
                            <div class="selectionBox">
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
                            </div>
                            
                            
                            <div class="levelttlBOX">
                                Section
                            </div>
                            <div class="selectionBox">
                                <select id="section_id" name="section_id" onchange="get_class_subject_list_v2_1(this.value);"> 
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
                                <input type="button" id="showBtn"  name="showBtn" value="Show" onclick="get_result_sheet_SMS_v2_1(); return false;" />
                            </div>
                            
                        </div>
                        <div class="clear"></div>
                        
                    </div>    
                    
                    
                    
                    
                    

                    
                   <div class="formRow" >
                        <div id="student_result_list">
                        
                            
                            <!-- -->
                            
                            <!-- -->
                            
                        
                        </div>
                        <div class="clear"></div>
                   </div>      
                    <div class="clear"></div>
                
                    <div class="messagesendChoiceBox"> </div>
                    <div class="printChoiceBox"> </div>
                    
                    
                    
                    
                    
                    <div class="formSubmit">
                            <input type="button" value="Send Message (Marks)" class="redB messagesendActionprint" onclick="send_me_message_m(); return false;" />
                            
                            <input type="button" value="Send Message (GPA)" class="redB messagesendActionprint" onclick="send_me_message_g(); return false;" />
                            
                            <input type="button" value="Print Result" class="redB messagesendActionprint" onclick="print_selected_exam(); return false;" />
                    </div>
                    <div class="formSubmit1001">
                            
                            
                            
                    </div>
            </fieldset>
        </form> 
         <div style="display:none;" id="class_id"></div>
         <a id="trigger_link" target="_blank" href="<?php echo BASEURL?>result/generate_pdf_ex"></a>
         <form target="_blank" id="printFrm" name="printFrm" method="post" action="<?php echo BASEURL?>result/generate_pdf_ex"> </form>
         <form target="_blank" id="msgFrm2m" name="msgFrm2m" method="post" action="<?php echo BASEURL?>result/send_sms_m"> </form>
         <form target="_blank" id="msgFrm2g" name="msgFrm2g" method="post" action="<?php echo BASEURL?>result/send_sms_g"> </form>
        <script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/result.js"></script>
        
    <script>
    function XXprint_selected_exam()
    {
          var class_name_id = $('#class_name_id').val(); 
          var section_id = $('#section_id').val(); 
          var class_id = $('#class_id').val(); 
          
          if (!$("input[@name='print_examselection']:checked").val()) 
          {
                alert('Select exam for for printing result');
                return false;
          }
          var print_examselection = $("input[@name='print_examselection']:checked").val();
          
          $.ajax({ 
             url: baseUrl+'report/set_print_info',        
             data:
             {
                   'class_name_id':class_name_id,
                   'section_id':section_id,
                   'class_id':class_id,
                   'print_examselection':print_examselection
             },
             dataType: 'json',
             success: function(data)
             {
                 result = ''+data['result']+'';                 
                 if(result == 'success')
                 {
                     //alert('Open resultprint section to print result');
                     //document.forms.printFrm.submit();
                     $('#trigger_link').click();
                 }  
             }
         });
         return false; // keeps the page from not refreshing
    }
    
    function print_selected_exam()
    {
          var class_name_id = $('#class_name_id').val(); 
          var section_id = $('#section_id').val(); 
          var class_id = $('#class_id').val(); 
          
          if (!$("input[@name='print_examselection']:checked").val()) 
          {
                alert('Select exam for for printing result');
                return false;
          }
          var print_examselection = $("input[@name='print_examselection']:checked").val();
          
          $.ajax({ 
             url: baseUrl+'result/save_print_info',        
             data:
             {
                   'class_name_id':class_name_id,
                   'section_id':section_id,
                   'class_id':class_id,
                   'print_examselection':print_examselection
             },
             dataType: 'json',
             success: function(data)
             {
                 result = ''+data['result']+'';                 
                 if(result == 'success')
                 {
                     //alert('Open resultprint section to print result');
                     document.forms.printFrm.submit();
                     //alert('Hi');
                     //$('#trigger_link').click();
                     //window.location.href = baseUrl+'result/generate_pdf_ex';
                 }  
             }
         });
         return false; // keeps the page from not refreshing
    }
    
    
    
    function send_me_message_m()
    {
          var class_name_id = $('#class_name_id').val(); 
          var section_id = $('#section_id').val(); 
          var class_id = $('#class_id').val(); 
          
          if (!$("input[@name='print_examselection']:checked").val()) 
          {
                alert('Select exam for for printing result');
                return false;
          }
          var print_examselection = $("input[@name='print_examselection']:checked").val();
          
          $.ajax({ 
             url: baseUrl+'result/save_print_info',        
             data:
             {
                   'class_name_id':class_name_id,
                   'section_id':section_id,
                   'class_id':class_id,
                   'print_examselection':print_examselection
             },
             dataType: 'json',
             success: function(data)
             {
                 result = ''+data['result']+'';                 
                 if(result == 'success')
                 {
                     //alert('Open resultprint section to print result');
                     document.forms.msgFrm2m.submit();
                     //alert('Hi');
                     //$('#trigger_link').click();
                     //window.location.href = baseUrl+'result/generate_pdf_ex';
                 }  
             }
         });
         return false; // keeps the page from not refreshing
    }
    function send_me_message_g()
    {
          var class_name_id = $('#class_name_id').val(); 
          var section_id = $('#section_id').val(); 
          var class_id = $('#class_id').val(); 
          
          if (!$("input[@name='print_examselection']:checked").val()) 
          {
                alert('Select exam for for printing result');
                return false;
          }
          var print_examselection = $("input[@name='print_examselection']:checked").val();
          
          $.ajax({ 
             url: baseUrl+'result/save_print_info',        
             data:
             {
                   'class_name_id':class_name_id,
                   'section_id':section_id,
                   'class_id':class_id,
                   'print_examselection':print_examselection
             },
             dataType: 'json',
             success: function(data)
             {
                 result = ''+data['result']+'';                 
                 if(result == 'success')
                 {
                     //alert('Open resultprint section to print result');
                     document.forms.msgFrm2g.submit();
                     //alert('Hi');
                     //$('#trigger_link').click();
                     //window.location.href = baseUrl+'result/generate_pdf_ex';
                 }  
             }
         });
         return false; // keeps the page from not refreshing
    }
    
    
    function send_selected_message()
    {
        if (!$("input[@name='examselection']:checked").val()) 
        {
            alert('Select exam for sendion message');
            return false;
        }
        document.forms.validate.submit();
    }
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
              
              a_subject = ''+data['a_subject']+'';

              if(result == 'success')
              {
                 $('#class_id').html(list);   
                 $('.printChoiceBox').html(a_subject);
                 $('.messagesendActionprint').show();
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
                'class_id':class_id
          },
          dataType: 'json',
          success: function(data)
          {
              result = ''+data['result']+'';
              list = ''+data['list']+'';
              radioAction = ''+data['radioAction']+'';                                          
              usrActionAllExam = ''+data['usrActionAllExam']+'';
              
              if(result == 'success')
              {
                 $('#student_result_list').html(list); 
                 $('.messagesendAction').show();
                 $('.messagesendChoiceBox').html(radioAction); 
                // $('.printChoiceBox').html(usrActionAllExam); 
                 
                 
                 
                 
                 
//                 if(is_sms_sent == '1')
//                 {
//                     $('.messagesendDisable').show();
//                 }
//                 else
//                 {
//                     $('.messagesendAction').show();
//                 }
              }
              else if(result == 'fail')
              {

              }  
          }
      });
      return false; // keeps the page from not refreshing

    }
    </script>