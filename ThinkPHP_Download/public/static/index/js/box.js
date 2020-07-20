// $('div').box({left:'left',top:'center'});
$.fn.box = function (position) {
    // position = ({left:'left',top:'center'});
    var box = $(this);
    var win = $(window);
    //用户希望位置
    var lefter = position.left;
    var toper = position.top;
    //真实的left和top
    var trueLeft;
    var trueTop;
    //div的宽度、高度
    var boxWidth = box.outerWidth();
    var boxHeight = box.outerHeight();
    //获取浏览器的宽高
    var winWidth;
    var winHeight;
    //滚动条滚动的距离
    var scrollLeft;
    var scrollTop;

    //获取浏览器的宽高
    function getVal() {
        //浏览器窗口的宽度、高度
        winWidth = win.width();
        winHeight = win.height();
        //滚动条滚动的距离
        scrollLeft = win.scrollLeft();
        scrollTop = win.scrollTop();
    }

    //计算真实left 和 top
    function calc() {
        //以九宫格的位置显示
        //可选的lefter值都有：left center right
        //可选的toper值都有：top center bottom
        if (lefter == 'left') {
            trueLeft = 0 + scrollLeft + 'px';
        }
        else if (lefter == 'center') {
            trueLeft = (winWidth - boxWidth) / 2 + scrollLeft + 'px';
        }
        else if (lefter == 'right') {
            trueLeft = winWidth - boxWidth + scrollLeft + 'px';
        }
        if (toper == 'top') {
            trueTop = 0 + scrollTop + 'px';
        }
        else if (toper == 'center') {
            trueTop = (winHeight - boxHeight) / 2 + scrollTop + 'px';
        }
        else if (toper == 'bottom') {
            trueTop = winHeight - boxHeight + scrollTop + 'px';
        }
    }

    //让窗口显示
    function info() {
        box.css('left', trueLeft).css('top', trueTop).show();
    }


    //页面刷新，调用上面的函数
    getVal();
    calc();
    info();

    //当滚动条滚动的时候，窗口位置保持不变
    win.scroll(function () {
        // console.log(123);
        getVal();
        calc();
        info();
    });
    //当浏览器改变大小的时候，窗口位置保持不变
    win.resize(function () {
        // console.log(456);
        getVal();
        calc();
        info();
    });

    //关闭窗口，find可以找到所有的指定元素的后代
    box.find('span').click(function(){
        box.hide();
    });
};
