$(function(){
    var timer = null;
    $('.selfMsg').hover(function(){
        //鼠标移入，子元素ul显示
        var li = $('#quit');
        timer = setTimeout(function(){
            li.slideDown(500);
        },250);
    },function(){
        //鼠标离开，子元素ul隐藏
        clearTimeout(timer);
        $('#quit').slideUp(500);
    });
});