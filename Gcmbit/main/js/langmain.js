var arrLang = {
  "en": {
"mainone":"Destroy",
"maintwo":"Buy GCM",
"subma":"Immediately destroy",
"log":"My Destruction Records",
"fname":"Rune name",
"fcode":"Rune ID",
"fprice":"Today's rune reference price",
"today":"Destroyed today",
"buynft":"NFT rights",
"buyjy":"Elite node rights",
"buy":"Buy",
"heidong":"Satoshi Nakamoto",
"xiaohui":"Destroyed",
"about":"About us",
"commt":"Group news",
"goout":"Read",
"dongci":"GCM Casting",
"danwei":"",
"ye":"GCM",
"cz":"Recharge",


"footone":"Home",
"foottwo":"Wallet",
"footthree":"Market",
"footfour":"My",
  },
  
 "cn": {
"mainone":"销毁铸造",
"maintwo":"购买GCM",
"subma":"销毁铸造",
"log":"查看我的销毁记录",
"fname":"符文名称",
"fcode":"符文编号",
"fprice":"今日符文参考价格",
"today":"今日销毁数量",
"buynft":"NFT权益",
"buyjy":"精英节点权益",
"buy":"购买",
"heidong":"中本聪地址",
"xiaohui":"已销毁数量",
"about":"关于我们",
"commt":"平台新闻",
"goout":"浏览",
"dongci":"GCM铸造",
"danwei":"枚",
"ye":"GCM余额",
"cz":"充值",


"footone":"首页",
"foottwo":"钱包",
"footthree":"市场",
"footfour":"我的",
  },
 

};

var lang = "en";
if('localStorage' in window){
   var lang = localStorage.getItem('lang') || navigator.language.slice(0, 2);
   if (!Object.keys(arrLang).includes(lang)) lang = 'en';
}

$(document).ready(function() {
  $(".lang").each(function(index, element) {
    $(this).text(arrLang[lang][$(this).attr("key")]);
  });
});

$(".translate").click(function() {
  var lang = $(this).attr("id");

  if('localStorage' in window){
    localStorage.setItem('lang', lang);
    console.log( localStorage.getItem('lang') );
  }

  $(".lang").each(function(index, element) {
    $(this).text(arrLang[lang][$(this).attr("key")]);
  });
});