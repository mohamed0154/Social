
var channel = pusher.subscribe('like-notify');
channel.bind('App\\Events\\LikeNotifyEvent', function(data) {

    console.log(data.post_owner_id);

      var counter= document.querySelector('.notify_to'+data.post_owner_id);
          counter.textContent++

    var bod_not="<li class='mb-2'><a class='dropdown-item border-radius-md' href='javascript:;'>"+
                   "<div class='d-flex py-1'>"+
                       "<div class='my-auto'>"+
                             "<img src='user/images/"+data.image+"' class='avatar avatar-sm bg-gradient-dark  me-3 '>"+
                       "</div>"+
                       " <div class='d-flex flex-column justify-content-center'>"+
                            "<h6 class='text-sm font-weight-normal mb-1'>"+
                               " <span class='font-weight-bold'>comment</span>"+data.user_name+
                            "</h6>"+
                            "<p class='text-xs text-secondary mb-0'>"+
                               "<i class='fa fa-clock me-1'></i>"+
                                   'like'+
                            "</p>"+
                   "</div></div></a>"+
                "</li>";

                $('.bell_notify'+ data.post_owner_id).prepend(bod_not);
});
