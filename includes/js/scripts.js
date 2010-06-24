$(document).ready(function(){



 $('#tinlinelink').click(function(){
 var t = this.title || this.name || null;
 var a = this.rel;
 var g = false;
 tb_show(t,a,g);
 this.blur();
 return false;
 });

 if(navigator.userAgent.indexOf("Opera") == -1)
{

 if($('#google_ads_frame2').length < 1)
 {

 var a = new Array('<a target="_blank" href="http://themeforest.net?ref=spykawg"><img src="/images/tf2.jpg" alt="Premium templates" /></a>',
 '<a target="_blank" href="http://www.BlueHost.Com/track/spykawg/swtem"><img src="/images/bh2.gif" alt="Cheap web hosting" /></a>',
 '<a target="_blank" href="http://www.HotScripts.com/?RID=N720153"><img src="http://spyka.co.uk/network/common/images/hs-4.jpg" alt="HotScripts" /></a>');
 var rand = Math.floor(Math.random()*a.length);

 $('.templateinner div').html(a[rand]);
 }

 if($('.header-link ins').length < 1)
 {

 var a = new Array('<a target="_blank" href="http://themeforest.net?ref=spykawg"><img src="/images/tf2.jpg" alt="Premium templates" /></a>',
 '<a target="_blank" href="http://www.BlueHost.Com/track/spykawg/swtem"><img src="/images/bh2.gif" alt="Cheap web hosting" /></a>',
 '<a target="_blank" href="http://www.awesomestyles.com/default?utm_source=snetheaderbanner&utm_medium=medbanner&utm_campaign=spnet"><img src="/images/aws468.jpg" alt="phpBB3 styles" /></a>',
 '<a target="_blank" href="http://www.justfreetemplates.com/?utm_source=snetheaderbanner&utm_medium=medbanner&utm_campaign=spnet"><img src="/images/jft468.jpg" alt="Free Web Templates" /></a>',
 '<a target="_blank" href="http://www.HotScripts.com/?RID=N720153"><img src="http://spyka.co.uk/network/common/images/hs-4.jpg" alt="HotScripts" /></a>');
 var rand = Math.floor(Math.random()*a.length);

 $('.header-link').html(a[rand]);
 $('.header-link a').attr("target", "_blank");
 }

}
});
 