<p align="center">Please wait for viewing print result.Every print result will come in 30 seconds</p>

<script>
   var intervalID = setInterval("update_print_result();", 30000);
   var false_value = '1';
   function update_print_result()
   { 
        $.ajax({ 
          url: baseUrl+'report/ajax_result_print_step_1',        
          data:
          {
                'false_value':false_value
          },
          dataType: 'json',
          success: function(data)
          {
              result          = ''+data['result']+'';
              student_id      = ''+data['student_id']+'';
              school_id       = ''+data['school_id']+'';
              exam_id         = ''+data['exam_id']+'';
              section_id      = ''+data['section_id']+'';
              class_name_id   = ''+data['class_name_id']+'';

              if(result == 'success')
              {
                 popup_print_page(student_id,school_id,exam_id,section_id,class_name_id); 
              }                    
          }
      });
      return false; // keeps the page from not refreshing 
   }
   
   function popup_print_page(student_id,school_id,exam_id,section_id,class_name_id)
   {
       var url = baseUrl + 'report/ajax_result_print_step_2/'+student_id+'/'+school_id+'/'+exam_id+'/'+section_id+'/'+class_name_id;
       
       var win = window.open(url, '','width=900,height=600,status=0,toolbar=0');
       
       var timer = setInterval(function() 
       {
            if(win.closed) 
            {
                clearInterval(timer);
                
                $.ajax({ 
                        url: baseUrl+'report/close_student_report',        
                        data:
                        {
                              'student_id':student_id,
                              'school_id':school_id,
                              'exam_id':exam_id,
                              'section_id':section_id,
                              'class_name_id':class_name_id
                        },
                        dataType: 'json',
                        success: function(data)
                        {
                            result = ''+data['result']+'';                           
                            if(result == 'success')
                            {
                                 
                            }                           
                        }
                    });
                    return false; // keeps the page from not refreshing 
                  
            }
       }, 1000);
   }
</script>