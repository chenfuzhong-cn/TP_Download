window.onload = function(){

var g = document.getElementById("goods_g");
var w = document.getElementById("WeChat_w");
var a = document.getElementById("alipay_a");
var m = document.getElementsByTagName('img');
g.onclick = function () {
    M(0);
};

for (var i = 0; i < m.length; i++) {
    m[i].b = i;
    m[i].onclick = function () {
        M(this.b);
    };
}

function M(i) {
    if (m[i].style.display == 'block') {
        w.style.display = "none";
        a.style.display = "none";
        g.style.display = "block";
    } else {
        w.style.display = "block";
        a.style.display = "block";
        g.style.display = "none";
    }
}
};