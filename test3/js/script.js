$(document).ready(function() {
    var names = [];
    $(".changeName").on('click',function(){
        $(".changeName").each(function(index,element){ 
        names.push($(element).attr('value'));
        });
        var last_value = names[names.length - 1];
        names.splice(-1,1);
        names.unshift(last_value);
        $(".changeName").each(function(index,element){
        $(this).attr('value',names[index]);
        });
    });
});


