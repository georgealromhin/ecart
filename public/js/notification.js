window.setInterval(function(){
    checkNotification();
  }, 3000);

  var notifImage = "../public/images/logo.png";
  var options = {
    title: "New Order",
    options: {
      body: "New Order Placed ",
      icon: notifImage,
      lang: 'en'
    }
  };

    // check for notifications
    function checkNotification(){
   $.ajax({ 
       type: 'GET', 
       url: '../public/notifications/count', 
       dataType: 'json',
       success: function (data) { 
        if(data > 0){
            $("#easyNotify").easyNotify(options);
            deleteNotification()
        }

       },
       error: function(XMLHttpRequest) { 
           console.log('Error reading notificatios');
       }
     });
   }
 
   function deleteNotification(){
       
     $.ajax({ 
       type: 'GET', 
       url: '../public/notification/markAsRead', 
       dataType: 'json',
       success: function (data) { 
         console.log('Notification marked as read');
       },
       error: function() { 
           console.log('Error');
       }
   });
   }

