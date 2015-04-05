function get_class_section_list_r(class_name_id)
{
     if(!class_name_id)
     {
        $('#section_id').html('');
        return false;
     }   
        
    $.ajax({ 
      url: baseUrl+'create/get_class_section_list_rs',        
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

function get_class_subject_list_r(section_id)
{
     if(!section_id)
     {
        $('#class_id').html('');
        return false;
     }
     
     var class_name_id = $('#class_name_id').val();    
        
    $.ajax({ 
      url: baseUrl+'create/get_class_subject_list_rs',        
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

function get_result_sheet()
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
      url: baseUrl+'create/result_sheet_ajax_rs',        
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

function get_result_sheet_SMS()
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
      url: baseUrl+'create/get_result_sheet_SMS_rs',        
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

function get_student_profile(student_id)
{
    //alert(student_id);
    var url = baseUrl+'create/get_student_detail/'+student_id;
    window.open(url,'1358355315758','width=800,height=500,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=1,left=100,top=100');
}

function get_total_student(class_name_id)
{
      $.ajax({ 
      url: baseUrl+'create/get_total_student_rs',        
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
             $('#total_student_cnt').html(list);  
          }
          else if(result == 'fail')
          {
             
          }  
      }
  });
  return false; // keeps the page from not refreshing

}

function delete_greeting(greeting_id)
{
    var con = confirm('Are you sure to delete this greeting');
    if(con)
    {
        window.location.href = baseUrl+'create/delete_greeting/'+greeting_id;
    }
}


function send_greeting_sms(greeting_id)
{
   var con = confirm('Are you sure to send  this greeting to all your student');
    if(con)
    {
        window.location.href = baseUrl+'create/send_greeting_sms/'+greeting_id; 
    }
   
}