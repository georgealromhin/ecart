window.setInterval(function(){
    checkNotification();
  }, 3000);

  var notifImage = "../images/logo.png";
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
       url: '../notifications/count', 
       dataType: 'json',
       success: function (data) { 
        if(data > 0){
            $("#easyNotify").easyNotify(options);
            deleteNotification()
        }

       },
       
     });
   }
 
   function deleteNotification(){
       
     $.ajax({ 
       type: 'GET', 
       url: '../notification/markAsRead', 
       dataType: 'json',
       success: function (data) { 
         console.log('Notification marked as read');
       },
       error: function() { 
           //console.log('Error');
       }
   });
   }

