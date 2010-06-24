function checkMail(e)
{
 var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 if (filter.test(e)) {
 return false;
 } else {
 return true;
 }
}

function contact_us(f, a)
{
 var msg="";
 if(f.name.value=="") msg += "You must supply name!<br />";
 if(f.email.value=="") msg += "You must supply an email!<br />";
 if(checkMail(f.email.value)) msg += "You must supply a VALID email!<br />";
 if(f.message.value=="") msg += "You must supply a comment/message!<br />";
 if(f.antibot.value!=a) msg += "You must answer the question correctly!<br />";
 if(msg=="") {
 f.submit();
 } else {
 var status=document.getElementById('errors');
 status.innerHTML="<b>Please correct the following errors:</b><br />";
 status.innerHTML+=msg;
 }
}

function licence(f, a)
{
 var msg="";
 if(f.name.value=="") msg += "You must supply name!<br />";
 if(f.email.value=="") msg += "You must supply an email!<br />";
 if(checkMail(f.email.value)) msg += "You must supply a VALID email!<br />";
 if(f.url.value=="") msg += "You must supply your URL<br />";
 if(f.antibot.value!=a) msg += "You must answer the question correctly!<br />";
 if(msg=="") {
 f.submit();
 } else {
 var status=document.getElementById('errors');
 status.style.display = 'block';
 status.innerHTML="<b>Please correct the following errors:</b><br />";
 status.innerHTML+=msg;
 }
}
 