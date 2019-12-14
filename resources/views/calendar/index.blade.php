<!DOCTYPE html>
<html>
  <head>
    <title>Calendar Saving Event</title>
    <link rel="stylesheet" href="{{ asset('calendar_asset/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('calendar_asset/bootstrap.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    <br />
    <h2 align="center"><a href="#">Calendar Event Saving </a></h2>
    <br />
    <div class="container">
      <div id="calendar"></div>
    </div>
    <script src="{{ asset('calendar_asset/jquery.min.js') }}"></script>
    <script src="{{ asset('calendar_asset/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('calendar_asset/moment.min.js') }}"></script>
    <script src="{{ asset('calendar_asset/fullcalendar.min.js') }}"></script>
    <script>
      $(document).ready(function() {
       var calendar = $('#calendar').fullCalendar({
        editable:true,
        header:{
         left:'prev,next today',
         center:'title',
         right:'month,agendaWeek,agendaDay'
        },
        events: '/calendar/load',
        selectable:true,
        selectHelper:true,
        select: function(start, end, allDay)
        {
         var title = prompt("Enter Event Title");
         if(title)
         {
            var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      
            $.ajax({
              url:"/calendar/insert",
              type:"POST",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data:{title:title, start:start, end:end},
              success:function()
              {
                calendar.fullCalendar('refetchEvents');
                alert("Added Successfully");
              }
            })
         }
        },
        editable:true,
        eventResize:function(event)
        {
         var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
         var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
         var title = event.title;
         var id = event.id;
         $.ajax({
          url:"/calendar/update",
          type:"POST",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data:{title:title, start:start, end:end, id:id},
          success:function(){
           calendar.fullCalendar('refetchEvents');
           alert('Event Update');
          }
         })
        },
      
        eventDrop:function(event)
        {
         var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
         var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
         var title = event.title;
         var id = event.id;
         $.ajax({
          url:"/calendar/update",
          type:"POST",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data:{title:title, start:start, end:end, id:id},
          success:function()
          {
           calendar.fullCalendar('refetchEvents');
           alert("Event Updated");
          }
         });
        },
      
        eventClick:function(event)
        {
         if(confirm("Are you sure you want to remove it?"))
         {
          var id = event.id;
          $.ajax({
           url:"/calendar/delete",
           type:"POST",
           data:{id:id},
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success:function()
           {
            calendar.fullCalendar('refetchEvents');
            alert("Event Removed");
           }
          })
         }
        },
      
       });
      });
       
    </script>
  </body>
</html>