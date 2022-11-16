
var channel = pusher.subscribe('mf_social-notify');
// Bind a function to a Event (the full Laravel class)
channel.bind('App/Events/SocialNotify', function (data) {
//    var bell=document.querySelector('i.counter');


// var comment_place=document.querySelector('div.com'+data.post_id);


//     comment_place.innerHTML="<div class='st_com'>"+"<span>"+ data.comment+"</span><br><br></div>";
//    bell.textContent++;
console.log(data.comment);
});
