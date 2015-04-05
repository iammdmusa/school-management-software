function add_new_room_type()
{
   var str = '';
   room_incrementer++;
   str = '<label>Room Type</label>';
   str = str+'<label>Room Type</label>';
   str = str+'<div class="formRight">';
   str = str+'<span class="oneFour"><input type="text" placeholder="Standard Room" id="room_type_'+room_incrementer+'" name="room_type['+room_incrementer+']"/></span>';
   str = str+'<span class="oneFour"><input type="text" placeholder="Max person" id="max_person_'+room_incrementer+'" name="max_person['+room_incrementer+']" /></span>';
   str = str+'<span class="oneFour"><input type="text" placeholder="Price Per stay" id="price_per_stay_'+room_incrementer+'" name="price_per_stay['+room_incrementer+']" /></span>';
   str = str+'</div>';
   str = str+'<div class="clear"></div>';
   $('#room_type_container').append(str);
}
function add_new_feature_type()
{
   feature_incrementer++;
   facility_incrementer[feature_incrementer] = 0;
   var str = ''; 
   str = '<label>Feature</label>'; 
   str = str+'<div class="formRight">'; 
   str = str+'<div class="feature_LR">'; 
   str = str+'<span class="oneTwo"><input type="text" placeholder="General" id="feature_'+feature_incrementer+'" name="feature['+feature_incrementer+']"/></span>'; 
   str = str+'</div>'; 
   str = str+'<div class="feature_LR">'; 
   str = str+'<span class="feature_facility_id_'+feature_incrementer+'">'; 
   str = str+'<input type="text" placeholder="Facility" id="facility_'+feature_incrementer+'_'+facility_incrementer[feature_incrementer]+'" name="facility['+feature_incrementer+']['+facility_incrementer[feature_incrementer]+']"/>'; 
   str = str+'</span>'; 
   str = str+'<a href="javascript:void(0);" onclick="add_new_facility('+feature_incrementer+'); return false;">Add another Facility</a>'; 
   str = str+'</div>'; 
   str = str+'</div>'; 
   str = str+'<div class="clear"></div>'; 
   $('#room_type_container_F').append(str); 
}
function add_new_facility(feature_inc)
{
   var str = '';
   facility_incrementer[feature_inc]++;
   str = '<input type="text" placeholder="Facility" id="facility_'+feature_inc+'_'+facility_incrementer[feature_inc]+'" name="facility['+feature_inc+']['+facility_incrementer[feature_inc]+']"/>'; 
   $('.feature_facility_id_'+feature_inc+'').append(str);
}
function add_new_package()
{
   var str = ''; 
   package_incrementer++;
   str = '<label>Package</label>'; 
   str = str+'<div class="formRight">'; 
   str = str+'<span class="oneFour"><input type="text" placeholder="Package" id="package_'+package_incrementer+'" name="package['+package_incrementer+']"/></span>'; 
   str = str+'<span class="oneFour"><input type="text" placeholder="Price" id="package_price_'+package_incrementer+'" name="package_price['+package_incrementer+']" /></span>'; 
   str = str+'<span class="oneFour"><textarea rows="4" cols="" placeholder="Package Description" id="package_description_'+package_incrementer+'"  name="package_description['+package_incrementer+']"></textarea></span>'; 
   str = str+'</div>'; 
   str = str+'<div class="clear"></div>'; 
   $('#package_container').append(str);
}
function set_state_visibility(country)
{
     if(country == "US")
     {
         $('#state_row_id').show();
         $('#state').addClass('validate[required]');
     }
     else
     {
         $('#state_row_id').hide();
         $('#state').removeClass('validate[required]');
     }
}
function add_another_stops()
{
   stops_incrementer++;
   var core = $('.airport_list_div').html(); 
   var str = ''; 
   var str = '<div class="airport_stopage c_'+stops_incrementer+'">'; 
   //str = str+'<select name="airport_list_id_'+stops_incrementer+'" id="airport_list_id['+stops_incrementer+']" >';
   str = str+core;
   //str = str+'</select>'; 
   str = str+'</div>'; 
   $('.shop_type_container_CLS').append(str); 
   
   $('.c_'+stops_incrementer).find('select').attr('id', 'airport_list_id_'+stops_incrementer);
   $('.c_'+stops_incrementer).find('select').attr('name', 'airport_list_id['+stops_incrementer+']');
   $('.c_'+stops_incrementer).find('.selector').attr('id', 'uniform-airport_list_id['+stops_incrementer+']');
}
function add_new_fare_suummary()
{
    fare_suummary_inc++
    var str = ''; 
    str = '<div class="formRight">';
    str = str+'<span class="oneFour"><input type="text" placeholder="Traveller Type" id="vehicle_traveler_type_id_'+fare_suummary_inc+'" name="vehicle_traveler_type_id['+fare_suummary_inc+']"/></span>';
    str = str+'<span class="oneFour"><input type="text" placeholder="Base Price" id="base_price_'+fare_suummary_inc+'" name="base_price['+fare_suummary_inc+']" /></span>';
    str = str+'<span class="oneFour"><input type="text" placeholder="Taxes" id="tax_'+fare_suummary_inc+'" name="tax['+fare_suummary_inc+']" /></span>';
    str = str+'</div>';
    str = str+'<div class="clear"></div>';
    $('#fare_summary_container').append(str);
}
function add_new_room_feature()
{
   room_container++;
   var str = ''; 
   str = '<label>&nbsp;</label>'; 
   str = str+'<div class="formRight">'; 
   str = str+'<span class="oneFour"><input type="text" placeholder="Room Feature" id="room_feature_'+room_container+'" name="room_feature['+room_container+']"/></span>'; 
   str = str+'<span class="oneFour"><input type="text" placeholder="Price" id="room_price_'+room_container+'" name="room_price['+room_container+']"/></span> '; 
   str = str+'</div>'; 
   str = str+'<div class="clear"></div>'; 
   $('#room_container').append(str); 
}

function update_teacher_attendence_sheet(teacher_allowed_attendence_id)
{
        $.ajax({ 
          url: baseUrl+'create/teacher_attendence_sheet_ajax',        
          data:
          {
                'teacher_allowed_attendence_id':teacher_allowed_attendence_id
          },
          dataType: 'json',
          success: function(data)
          {
              result = ''+data['result']+'';
              list = ''+data['list']+'';
              actionBtn = ''+data['actionBtn']+'';
              
              if(result == 'success')
              {
                 $('#student_list_con').html(list);   
                 $('#formSubmit_id').html(actionBtn);   
              }
              else if(result == 'fail')
              {
                 
              }  
          }
      });
      return false; // keeps the page from not refreshing 
}

function get_message_class_section(class_name_id)
{
     if(!class_name_id)
     {
        var str = '<option value="" >Select One</option>';
        $('#section_id').html(str);
        $('#student_id').html('');
        $('#student_id').html(str);
        return false;
     }
     
     
     $.ajax({ 
          url: baseUrl+'create/ajax_message_class_section',        
          data:
          {
                'class_name_id':class_name_id
          },
          dataType: 'json',
          success: function(data)
          {
              result = ''+data['result']+'';
              section_id = ''+data['section_id']+'';
              student_id = ''+data['student_id']+'';
              if(result == 'success')
              {
                 $('#section_id').html(section_id);  
                 $('#student_id').html(student_id);  
              }
              else if(result == 'fail')
              {
                 
              }  
          }
      });
      return false; // keeps the page from not refreshing 
}
function get_section_students(section_id)
{
     var class_name_id = $('#class_name_id').val();   
     if(!class_name_id)
     {
        alert('Class should be defined');
        return false;
     }
     $.ajax({ 
      url: baseUrl+'create/get_section_students_ajax',        
      data:
      {
            'class_name_id':class_name_id,
            'section_id':section_id
      },
      dataType: 'json',
      success: function(data)
      {
          result = ''+data['result']+'';
          student_id = ''+data['student_id']+'';
          if(result == 'success')
          { 
             $('#student_id').html(student_id);  
          }
          else if(result == 'fail')
          {
             
          }  
      }
  });
  return false; // keeps the page from not refreshing 
}

function get_class_section(class_name_id)
{
     if(!class_name_id)
     {
        var str = '<option value="" >Select One</option>';
        $('#section_id').html('');
        $('#section_id').html(str);
        $('#class_id').html(str);
        return false;
     }
     
     
     $.ajax({ 
          url: baseUrl+'create/ajax_class_section',        
          data:
          {
                'class_name_id':class_name_id
          },
          dataType: 'json',
          success: function(data)
          {
              result = ''+data['result']+'';
              section_id = ''+data['section_id']+'';
              if(result == 'success')
              {
                 $('#section_id').html(section_id);  
              }
              else if(result == 'fail')
              {
                 
              }  
          }
      });
      return false; // keeps the page from not refreshing 
}


function get_class_section1(class_name_id)
{
     if(!class_name_id)
     {
        var str = '<option value="" >Select One</option>';
        $('#section_id').html('');
        $('#section_id').html(str);
        
        return false;
     }
     $('#student_list_con').html('');    
     $('#formSubmit_id').html('');    
     //$('.send_button_idCSS').hide();   
     
     $.ajax({ 
          url: baseUrl+'create/ajax_class_section',        
          data:
          {
                'class_name_id':class_name_id
          },
          dataType: 'json',
          success: function(data)
          {
              result = ''+data['result']+'';
              section_id = ''+data['section_id']+'';
              if(result == 'success')
              {
                 $('#section_id').html(section_id);  
              }
              else if(result == 'fail')
              {
                 
              }  
          }
      });
      return false; // keeps the page from not refreshing 
}

function get_section_subject(section_id)
{
     var class_name_id = $('#class_name_id').val();
     
     if(!section_id)
     {
        var str = '<option value="" >Select One</option>';
        $('#class_id').html(str);
        return false;
     }
     
     $.ajax({ 
          url: baseUrl+'create/ajax_class_subject',        
          data:
          {
                'section_id':section_id,
                'class_name_id':class_name_id
          },
          dataType: 'json',
          success: function(data)
          {
              result = ''+data['result']+'';
              class_id = ''+data['class_id']+'';
              if(result == 'success')
              {
                 $('#class_id').html(class_id);  
              }
              else if(result == 'fail')
              {
                 
              }  
          }
      });
      return false; // keeps the page from not refreshing 
}

function set_std_names(section_id)
{
   var class_name_id = $('#class_name_id').val();
   $.ajax({ 
          url: baseUrl+'create/ajax_student_name',        
          data:
          {
                'section_id':section_id,
                'class_name_id':class_name_id
          },
          dataType: 'json',
          success: function(data)
          {
              result = ''+data['result']+'';
              student_id = ''+data['student_id']+'';
              if(result == 'success')
              {
                 $('#student_id').html(student_id);  
              }
              else if(result == 'fail')
              {
                 
              }  
          }
      });
      return false; // keeps the page from not refreshing 
}
function send_gurdian_sms(frm)
{
   $('#send_sms').val(1);
   actionName = baseUrl+'create/send_gurdian_sms'
   frm.action = actionName;
   frm.submit();
}

function send_gurdian_sms1(frm)
{
   $('#send_sms').val(1);
   actionName = baseUrl+'create/send_gurdian_sms/1'
   frm.action = actionName;
   frm.submit();
}


function set_std_list_ajax(section_id)
{
     var class_name_id = $('#class_name_id').val(); 
     if(!class_name_id)
     {
        alert('Class should be defined');
        return false;
     }
    $.ajax({ 
      url: baseUrl+'create/std_list_ajax',        
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
             $('#student_list_con').html(list);  
          }
          else if(result == 'fail')
          {
             
          }  
      }
  });
  return false; // keeps the page from not refreshing 
}

function set_std_list_ajax1(section_id)
{
     var class_name_id = $('#class_name_id').val(); 
     if(!class_name_id)
     {
        alert('Class should be defined');
        return false;
     }
    $.ajax({ 
      url: baseUrl+'create/std_list_ajax',        
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
          actionBtn = ''+data['actionBtn']+'';
          if(result == 'success')
          {
             $('#student_list_con').html(list);  
             $('#formSubmit_id').html(actionBtn);  
          }
          else if(result == 'fail')
          {
             
          }  
      }
  });
  return false; // keeps the page from not refreshing 
}
function get_class_subject(class_name_id)
{
     if(!class_name_id)
     {
        $('#class_id').html(''); 
        $('#student_result_list').html(''); 
        return false;
     }
     $.ajax({ 
      url: baseUrl+'create/class_subject_ajax',        
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
             $('#class_id').html(list);  
          }
          else if(result == 'fail')
          {
             
          }  
      }
  });
  return false; // keeps the page from not refreshing
}
function get_class_result_list(class_name_id)
{
      if(!class_name_id)
      {
        $('#student_result_list').html(''); 
        return false;
      }
      $.ajax({ 
      url: baseUrl+'create/get_class_result_list_ajax',        
      data:
      {
            'class_name_id':class_name_id
      },
      dataType: 'json',
      success: function(data)
      {
          result = ''+data['result']+'';
          resultList = ''+data['resultList']+'';
          if(result == 'success')
          {
             $('#student_result_list').html(resultList);  
          }
          else if(result == 'fail')
          {
             
          }  
      }
  });
  return false; // keeps the page from not refreshing
}

function get_result_sheet(class_id)
{
      var class_name_id = $('#class_name_id').val(); 
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
      url: baseUrl+'create/result_sheet_ajax',        
      data:
      {
            'class_name_id':class_name_id,
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
function add_new_subject()
{
   subject_incrementer++;
   var str = '<input class="validate[required]" type="text" value="" name="subject['+subject_incrementer+']" id="subject_'+subject_incrementer+'"/><div style="clear:both;"></div>';
   $('#subject_div_id').append(str);
}
function delete_teacher_assign_class(teacher_assign_subject_id)
{
    con = confirm('Are you sure to delete this record?');
    if(con)
    {
       var url = baseUrl+'create/deleterecord/'+teacher_assign_subject_id+'/teacher_assign_subject_id/scl_teacher_assign_subject/teacherlist';
       window.location.href = url;
    }
}

function delete_teacher(teacher_id)
{
    con = confirm('Are you sure to delete this record?');
    if(con)
    {
       var url = baseUrl+'create/deleterecord/'+teacher_id+'/teacher_id/scl_teacher/teacherlist';
       window.location.href = url;
    }
}

function delete_class_subject(class_id)
{
    con = confirm('Are you sure to delete this record?');
    if(con)
    {
       var url = baseUrl+'create/deleterecord/'+class_id+'/class_id/scl_class/class_subject_list';
       window.location.href = url;
    }
}
function enable_disable_school(school_id,status)
{
    con = confirm('Are you sure to change the statue?');
    if(con)
    {
       var url = baseUrl+'create/school_billing_status/'+school_id+'/'+status;
       window.location.href = url;
    }

}
function delete_school(school_id)
{
    con = confirm('Are you sure to delete this record?');
    if(con)
    {
       var url = baseUrl+'create/delete_school/'+school_id;
       window.location.href = url;
    }
}
function delete_school_admin(admin_id)
{
    con = confirm('Are you sure to delete this record?');
    if(con)
    {
       var url = baseUrl+'create/delete_school_admin/'+admin_id;
       window.location.href = url;
    }
}
function delete_section(section_id)
{
    con = confirm('Are you sure to delete this record?');
    if(con)
    {
       var url = baseUrl+'create/delete_section_record/'+section_id;
       window.location.href = url;
    }
}
function delete_student(student_id)
{
    con = confirm('Are you sure to delete this record?');
    if(con)
    {
       var url = baseUrl+'create/deleterecord/'+student_id+'/student_id/scl_student/student_list';
       window.location.href = url;
    }
}
function get_student_profile(student_id)
{
    //alert(student_id);
    var url = baseUrl+'create/get_student_detail/'+student_id;
    window.open(url,'1358355315758','width=800,height=500,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=1,left=100,top=100');
}

function get_student_list(class_name_id)
{
     if(!class_name_id)
     {
        $('#student_list_con').html(''); 
        return false;
     }
     $.ajax({ 
      url: baseUrl+'create/student_list_ajax',        
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
             $('#student_list_con').html(list);  
          }
          else if(result == 'fail')
          {
             
          }  
      }
  });
  return false; // keeps the page from not refreshing
}

