var arrLang = {
  "en": {
"a1":"Put on",
"a2":"The latest",
"a3":"The lowest price",
"buy":"Buy",
"buyjy":"Buy the elite node",
"price":"Price",
"amount":"Amount",
"sale":"Sold",

"ga":"balance",
"gleixing":"Upgrade to Elite Node Exclusive",
"gamount":"GCM Amount for sale(Reduce by 20%)",
"gprice":"GCM Selling unit price",
"gpricermb":"Unit price forecast",
"gnow":"Sell immediately",
"gmy":"My sale",
"gmya":"Amount",
"gmyb":"Sold",
"gmyfee":"Fee",
"gmyprice":"Price",
"gmyfanhui":"Revoke",
"gmydel":"Sold out, please delete",
"gall":"More successful sales records",

"btitlea":"Buy GCM",
"btitleb":"Buy Elite Nodes",
"bbtc":"Your BTC balance",
"bjytext":"Elite nodes dedicated to buy links, will be purchased automatically invested into elite nodes. At the same time your foundry income base will increase the number of GCMs you buy, creating a balance of computing power will increase the number of GCM you buy by three times.",
"brice":"Selling unit price",
"bamount":"Amount",
"bamountall":"Maximum purchase",
"bpay":"You have to pay",
"bbana":"Buy GCM immediately",
"bbanb":"Buy Elite nodes immediately",
"bmore":"More Purchase Records",
"bjytextb":"You have purchased the elite node. Your foundry revenue base has increased the number of GCMs you buy, and the creation balance has increased the number of GCMS you buy by a factor of 3.",
"blista":"For Elite nodes",
"blistamount":"Amount",
"blistprice":"Price",
"blistall":"Total",

"logcstitle":"GCM Sold List",
"loggmtitle":"GCM Purchased List",
"loggdtitle":"GCM for sale",
"logamount":"Amount",
"logprice":"Price",
"logtotal":"Total",
"logzy":"Elite nodes",


"footone":"Home",
"foottwo":"Wallet",
"footthree":"Market",
"footfour":"My",
  },
  
 "cn": {
"a1":"上架",
"a2":"最新上架",
"a3":"最低价格",
"buy":"购买",
"buyjy":"购买精英节点",
"price":"单价",
"amount":"数量",
"sale":"已售",

"ga":"余额",
"gleixing":"升级精英节点专用",
"gamount":"GCM挂卖数量（将扣除20%作为手续费）",
"gprice":"GCM挂卖单价",
"gpricermb":"单价预测",
"gnow":"立即挂卖",
"gmy":"我的挂卖",
"gmya":"挂卖中",
"gmyb":"已出售",
"gmyfee":"手续费",
"gmyprice":"价格",
"gmyfanhui":"撤销",
"gmydel":"已售完，请删除",
"gall":"更多成功出售记录",

"btitlea":"购买GCM",
"btitleb":"购买精英节点",
"bbtc":"你的btc余额",
"bjytext":"精英节点专用购买链接，购买后将自动投资成精英节点。同时你的铸造收益基数将增加你购买的GCM数量，缔造算力余额将增加你购买的GCM数量的3倍。",
"brice":"售卖单价",
"bamount":"购买数量",
"bamountall":"此挂单最大购买量",
"bpay":"您需支付",
"bbana":"立即购买GCM",
"bbanb":"立即购买精英节点",
"bmore":"更多购买记录",
"bjytextb":"您已购买精英节点。你的铸造收益基数已增加了你购买的GCM数量，缔造算力余额已经增加你购买的GCM数量的3倍。",
"blista":"精英节点专属",
"blistamount":"购买数量",
"blistprice":"购买单价",
"blistall":"总消费",


"logcstitle":"GCM 已出售列表",
"loggmtitle":"GCM 已购买列表",
"loggdtitle":"GCM 出售中",
"logamount":"数量",
"logprice":"单价",
"logtotal":"总价",
"logzy":"精英节点",





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