 /// <reference path="../js/jquery-1.11.1.min.js" />


$(function(){
	
//	//	图片, 正方形
//	var picH = $(".pic-w").width();
//	$(".pic-w").height(picH);
//	$(window).resize(function(){ 
//		var picH = $(".pic-w").width();
//		$(".pic-w").height(picH);
//	});

	//	弹出层关闭按钮
	$(".pop-closeBtn").click(function() {
		$(".popbox-wrap").removeClass("mui-active");
		$(".popbox-wrap").hide();
		$(".mui-backdrop.mui-active").remove();
	});

	$(".js-top-ms1 li a").click(function(){
		var msTxt = $(this).text();
		$(".js-txt-add1").text(msTxt);
		$(".popbox-wrap,.mui-backdrop").removeClass("mui-active").css("display","none");
		$(".mui-backdrop").removeClass("mui-active").remove();
	});
	$(".js-top-ms2 li a").click(function(){
		var msTxt = $(this).text();
		$(".js-txt-add2").text(msTxt);
		$(".popbox-wrap,.mui-backdrop").removeClass("mui-active").css("display","none");
		$(".mui-backdrop").removeClass("mui-active").remove();
	});
});





 
document.getElementById('a1').addEventListener('tap', function() {
	//打开关于页面
	mui.openWindow({
		url: 'index.html', //目标页面地址
		id: 'a1' //触发新打开页面的id
	});
});
document.getElementById('a2').addEventListener('tap', function() {
	//打开关于页面
	mui.openWindow({
		url: 'toudan.html', //目标页面地址
		id: 'a2' //触发新打开页面的id
	});
});
document.getElementById('a3').addEventListener('tap', function() {
	//打开关于页面
	mui.openWindow({
		url: 'my.html', //目标页面地址
		id: 'a3' //触发新打开页面的id
	});
});



function checkNum(obj,intNum=0,decNum=0) {
    var value=obj.value;
    var changeValue,t1,t2;
    switch (decNum){
            case 0:
                value=value.replace(/[^\d]/g,'');
                value=value.replace(/^0\d+/g,'0');
                if(intNum!=0){
                    value=value.substr(0,intNum);
                }
                break;
            default:
                value=value.replace(/[^\d.]/g,'');
                value=value.replace(/^[^\d]/g,'');
                value=value.replace(/\.{2}/g,'.');
                value=value.replace(/^0\d+/g,'0');
                changeValue=value.split('.');
                if(changeValue.length>1){
                    if(intNum==0){
                        t1=changeValue[0];
                    }else{
                        t1=changeValue[0].substr(0,intNum);
                    }
                    t2=changeValue[1].substr(0,decNum);
                    value=t1+'.'+t2;
                }else{
                    if(intNum!=0){
                        value=value.substr(0,intNum);
                    }
                }
                break;
        }
    if(obj.value!=value){
        obj.value=value;
    }
    return value;
}

 
 
      