var arrLang = {
  "en": {
"ba":"Re",
"bb":"Withdraw",
"bc":"Sell",
"bd":"Buy",

"bone":"Cast",
"btwo":"Create",
"bthree":"Casting unlocked",
"bfour":"Unlocked created",

"listsj":"Time",
"listamount":"Amount",
"liststatus":"Status",
"listfee":"Fee",

"ctitle":"Recharge",
"camount":"recharge amount",
"cgsctext":"Please transfer GCM to this wallet address and it will arrive in 5-15 minutes. Ensure that the quantity is not less than 1 piece",
"cgscban":"Recharge the GCM immediately",
"cbtcban":"Recharge the BTC immediately",
"cgscmorelist":"More GCM Recharge Records",
"cbtcmorelist":"More BTC Recharge Records",

"ttitle":"Withdrawal",
"tamount":"Withdrawal amount",
"tgscban":"Withdrawal the GCM immediately",
"tgscts":"Fee: 20%",
"tbtcban":"Withdrawal the BTC immediately",
"tbtcts":"Fee: 500 sats",
"tgscmorelist":"More GCM Withdrawal Records",
"tbtcmorelist":"More BTC Withdrawal Records",


"footone":"Home",
"foottwo":"Wallet",
"footthree":"Market",
"footfour":"My",
  },
  
 "cn": {
"ba":"充值",
"bb":"领取",
"bc":"挂卖",
"bd":"购买",
"bone":"铸造算力",
"btwo":"缔造算力",
"bthree":"待解锁铸造算力",
"bfour":"待解锁缔造算力",

"listsj":"时间",
"listamount":"数量",
"liststatus":"状态",
"listfee":"手续费",

"ctitle":"充值",
"camount":"充值数量",
"cgsctext":"请通过本会员账户钱包向下方钱包地址转账GCM，5-15分钟内即会到账; 请确保数量不低于1枚",
"cgscban":"立即充值GCM",
"cbtcban":"立即充值btc",
"cgscmorelist":"更多GCM充值记录",
"cbtcmorelist":"更多btc充值记录",


"ttitle":"领取",
"tamount":"领取数量",
"tgscban":"立即领取GCM",
"tgscts":"领取手续费20%",
"tbtcban":"立即领取btc",
"tbtcts":"领取手续费为每笔 500sats",
"tgscmorelist":"更多GCM领取记录",
"tbtcmorelist":"更多btc领取记录",





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