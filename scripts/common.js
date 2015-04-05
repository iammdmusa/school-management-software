function search_hotel(frm)
{

   var destination = $('#destination').val();
   var check_in = $('#check_in').val();
   var check_out = $('#check_out').val();
   var guests = $('#guests').val();
   var rooms = $('#rooms').val();
   
   
   if(!destination)
   {
       alert('Destination should be given');
       return false;
   }
   if(!check_in)
   {
       alert('Check in date should be given');
       return false;
   }
   if(!check_out)
   {
       alert('Check out date should be given');
       return false;
   }
   if(!guests)
   {
       alert('Total guests should be given');
       return false;
   }
   if(!rooms)
   {
       alert('Total rooms should be given');
       return false;
   }
   frm.submit();
}

function search_flight(frm)
{

   var leaving_from = $('#leaving_from').val();
   var going_to = $('#going_to').val();
   var leaving_date = $('#leaving_date').val();
   var return_date = $('#return_date').val();
   var trip_type = $("input[name='trip_type']:checked").val();
   
   if(!leaving_from)
   {
       alert('Leaving from should be given');
       return false;
   }
   if(!going_to)
   {
       alert('Going place should be given');
       return false;
   }
   if(!leaving_date)
   {
       alert('Leaving date should be given');
       return false;
   }
   if(trip_type != '1' && !return_date)
   {
       alert('Return date should be given');
       return false;
   }
   frm.submit();
}
function set_me(flag)
{
   if(flag == '1')
   {
      $('#leaving_content').hide(); 
   }
   if(flag == '2')
   {
      $('#leaving_content').show(); 
   }
   //return false; 
}

function set_me0(flag)
{
   if(flag == '1')
   {
      $('.return_date0css').hide(); 
   }
   if(flag == '2')
   {
      $('.return_date0css').show(); 
   }
}
function find_mytrip(frm)
{
    var mytrip_leaving_from     = $('#mytrip_leaving_from').val();
    var mytrip_going_to         = $('#mytrip_going_to').val();
    var mytrip_leaving_date     = $('#mytrip_leaving_date').val();
    var mytrip_return_date      = $('#mytrip_return_date').val();
    var transportation          = $('#transportation').val();
    var mytrip_guests           = $('#mytrip_guests').val();
    var mytrip_rooms            = $('#mytrip_rooms').val();
    
    var mytrip_type = $("input[name='mytrip_type']:checked").val();

   if(!mytrip_leaving_from)
   {
       alert('Leaving from should be given');
       return false;
   }
   if(!mytrip_going_to)
   {
       alert('Going place should be given');
       return false;
   }
   if(!mytrip_leaving_date)
   {
       alert('Leaving date should be given');
       return false;
   }
   if(mytrip_type != '1' && !mytrip_return_date)
   {
       alert('Return date should be given');
       return false;
   }
   if(!mytrip_guests)
   {
       alert('Guest should be given');
       return false;
   }
   frm.submit();
}