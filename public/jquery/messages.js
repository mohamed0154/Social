$('a.get_messages').click(function(){
    $('.your_messages').slideDown(1000);
    $('.up').click(function(){
       $('.your_messages').slideUp(1000);
    });
});

var pl_users_active=$('.st_user_active');
var pl_write_message=$('.write_message');
var pl_messages=$('.messages');

$('.users_active').click(function(){
   pl_users_active.show();
   pl_write_message.hide();
   pl_messages.hide();
});


$('.users_messages').click(function(){
   pl_users_active.hide();
   pl_messages.show();
   pl_write_message.hide();
});

$('.user_active').click(function(){
    pl_write_message.show();
    pl_users_active.hide();
    pl_messages.hide();
});
