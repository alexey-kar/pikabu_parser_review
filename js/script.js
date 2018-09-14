
$( document ).ready(function() {

    setInterval(LoadPage, 15000);

});

function LoadPage(){

    $.ajax({
        url:'ajax/post.php',
        type:'POST',
        data:{'parser': 'parser_site'},
        success: function(data){
            if(data == 'NO_NEW_POST') {
                console.log(data);
            }
            else {
                $('#new_post').html('<div>'  + data + '</div>');
            }
        }
    });

}