var arrLang = {
  "en": {
"a01":"Time",
"a02":"Amount",
"a03":"Status",
"a04":"fee",

"a1":"Referral Code",
"a2":"Place an order",
"a3":"Profit",
"a4":"My Foundry",
"a5":"Referral Code",
"a6":"Recharge Records",
"a7":"Destruction Records",
"a8":"Withdrawal records",
"a9":"Profit records",
"a10":"NFT",
"a11":"Elite Node",
"a12":"GCM Market pending orders",
"a13":"GCM Selling records",
"a14":"GCM Purchase records",
"a15":"GCM(BNB Network) Stand-by registration",
"a16":"Share balance",
"a17":"Estimate price",
"a18":"Total asset",

"a1b":"Copy Referral Code",
"a1c":"You are not a qualified member yet！",

"a3a1":"Time",
"a3a2":"Source",
"a3a3":"Amount",
"a3b1":"Casting destruction:",
"a3b2":"",
"a3b3":"",

"a4a1":"Direct general membership",
"a4a2":"Team Master member",
"a4a3":"Team performance",
"a4a7":"Direct total(Old)",
"a4a8":"Team Master member(Old)",

"a9a1":"Pmining pool",
"a9a2":"Mining Pool",
"a9a3":"Poor mining pool",
"a9a4":"SameLevel",
"a9a5":"Solid",
"a9a6":"NFT",
"a9a7":"ForV",

"v1":"Creating Star",
"v2":"Creating Glory",
"v3":"Creating King",
"v4":"Creating Envoys",
"v5":"Creating Ambassador",

"g1":"Shareholder",
"g2":"Super node",
"g6":"Half shareholder",

"a10a1":"purchase an NFT node, You need:",
"a10a2":"Buy immediately",
"a10a3":"You have purchased the NFT node",
"a10a4":"Buy the NFT node, you will get weighted dividends!",
"a10a5":"Remaining NFT quantity:",

"a15a1":"BSC Stand-by registration",
"a15a2":"Please fill in your BNB wallet address",
"a15a3":"Confirmed",
"a15a4":"Description",

"footone":"Home",
"foottwo":"Wallet",
"footthree":"Market",
"footfour":"My",
  },
  
 "cn": {
"a01":"时间",
"a02":"数量",
"a03":"状态",
"a04":"手续费",

"a1":"缔造码",
"a2":"铸造",
"a3":"铸造量",
"a4":"我的铸造者",
"a5":"缔造码",
"a6":"充值记录",
"a7":"销毁铸造记录",
"a8":"领取记录",
"a9":"缔造记录",
"a10":"NFT",
"a11":"精英节点",
"a12":"GCM市场挂单",
"a13":"GCM出售记录",
"a14":"GCM购买记录",
"a15":"GCM(BNB链地址)备用登记",
"a16":"分享余额",
"a17":"预估价格",
"a18":"资产总价值",


"a1b":"复制缔造码",
"a1c":"您还不是合格会员",

"a3a1":"时间",
"a3a2":"项目",
"a3a3":"数量",
"a3b1":"节点铸造销毁记录：",
"a3b2":"",
"a3b3":"",

"a4a1":"铸造合格矿工",
"a4a2":"铸造社区矿工",
"a4a3":"矿工业绩",
"a4a7":"铸造合格矿工(旧版)",
"a4a8":"铸造社区矿工(旧版)",

"a9a1":"特级矿池",
"a9a2":"矿池",
"a9a3":"矿池差距",
"a9a4":"级别平等",
"a9a5":"铸造",
"a9a6":"NFT分红",
"a9a7":"V级分红",

"v1":"缔造之星",
"v2":"缔造荣耀",
"v3":"缔造王者",
"v4":"缔造特使",
"v5":"缔造大使",

"g1":"股东",
"g2":"超级节点",
"g6":"半股东",

"a10a1":"购买NFT节点需要：",
"a10a2":"立即购买",
"a10a3":"你已经购买NFT节点",
"a10a4":"购买NFT节点，享加权分红！",
"a10a5":"还剩余NFT数量:",

"a15a1":"BSC备用登记",
"a15a2":"请填写您的BNB钱包地址",
"a15a3":"立即确认无误提交",
"a15a4":"备注",


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