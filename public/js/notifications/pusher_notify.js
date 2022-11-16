
var channel = pusher.subscribe('mf-social-notify');
channel.bind('App\\Events\\SocialNotify', function(data) {
    var content_comment="<div class='name'>"+data.user_name+"</div>"+"<img class='img_comm' width='30px' height='30px'  src='user/images/"+data.image+"' alt=''>"+"<div class='st_com'>"+"<span>"+data.comment+"</span>"+"</div>";
    $('.com'+data.post_id).append(content_comment);

    data.users_notify_id.forEach(not => {
        console.log(not);
      var counter= document.querySelector('.notify_to'+not);
          counter.textContent++
    });

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
                                   data.comment+
                            "</p>"+
                   "</div></div></a>"+
                "</li>";

     data.users_notify_id.forEach(not_comm => {
         console.log(not_comm);
        $('.bell_notify'+ not_comm).prepend(bod_not);
     });
});
