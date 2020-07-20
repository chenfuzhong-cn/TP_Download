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

// 回调
$(document).on('click', '.pagination a', function () {
    var p = $(this).attr('href');
    aj(p);
    return false;
});
// 删除
$(document).on('click', '#delete', function () {
    var url = $(this).attr('href');
    $.ajax({
        url:url,
        type:'DELETE',
        success:function(data){
            alert(data.msg);
            if(data.msg != '删除失败'){
                location.reload();
            }
            
        }
    });
    return false;
});

aj('/adminAjax');
function aj(u) {
    $.ajax({
        type: 'get',
        url: u,
        dataType: 'json',
        success: function (res) {
            var res2 = res[0].data;
            var v = res[0];
            var pager = res[1];
            var str = '';
            $.each(res2, function (i, val) {
                var res = v.data[i];
                str += '<tr>';
                str += '<td>'+res.id+'</td>';
                str += '<td>'+res.title+'</td>';
                str += '<td>'+res.imagesrc.substring(0,20)+'...'+'</td>';
                str += '<td>'+res.fcode+'</td>';
                str += '<td>'+res.link+'</td>';
                str += '<td>'+
                   '<div class="btn-group">'+
                       '<a href="/soft/'+res.id+'/edit" class="btn btn-sm btn-primary">修改</a>'+
                       '<a href="/soft/'+res.id+'" class="btn btn-sm btn-danger" id="delete">删除</a>'+
                   '</div>'+
                '</td>';
            str += '</tr>';
            });
            $('#tbody').html(str);
            $('#pager').html(pager);
        }
    });
}