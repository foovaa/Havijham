$('.like').on('click', function(event){
    event.preventDefault();
    var is_like = event.target.previousElementSibling == null;
    var post_id = $(this).data('postid');
    console.log(post_id);
    $.ajax({
        type: 'POST',
        url: likeUrl,
        data: {isLike: is_like, postId: post_id, _token: token}
    })
    .done(function() {
        event.target.innerText = is_like ? event.target.innerText == 'دوست داشتم' ? 'شما این پست رو دوست داشتید' : 'دوست داشتم' : event.target.innerText == 'دوست نداشتم' ? 'شما این پست رو دوست نداشتید' : 'دوست نداشتم';
        if (is_like) {
            event.target.nextElementSibling.innerText = 'دوست نداشتم';
        } else {
            event.target.previousElementSibling.innerText = 'دوست داشتم';
        }
    });

});

 

$('select').select2({
    maximumInputLength: 30 , // only allow terms up to 20 characters long
    tags: true ,
});






$(document).ready(function(){
    var textinput = document.getElementById('body');
textinput.onkeyup = textinput.onkeypress = function(){
    document.getElementById('preview').innerHTML = this.value;
    }   
});


// .done(function() {
//     event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You Like' : 'Like' : event.target.innerText == 'Dislike' ? 'you dont like' : 'Dislike';
//     if (isLike) {
//         event.target.nextElementSibling.innerText = 'Dislike';
//     } else {
//         event.target.previousElementSibling.innerText = 'Like';
//     }
// });