// CHECK FORM
function checkMainForm(form_id)
{
    var nom_contact             = document.getElementById('nom_contact').value;
    var tel_personnel_contact   = document.getElementById('tel_personnel_contact').value; 
    var email                   = document.getElementById('email').value; 
    var DEPT                    = document.getElementById('DEPT').value;
    var date_entree             = document.getElementById('date_entree').value;
    
    //var tooltip_fade = "fade('tooltip_form');";
    var tooltip_fade = "document.getElementById('tooltip_form').style.display = 'none';";
    
    if(DEPT==0)
    {
        //fade('tooltip_form');
        document.getElementById('tooltip_form').style.display = 'block';  
        document.getElementById('tooltip_form').style.top = tooltipTop('TTdepartement', form_id)+'px';
        document.getElementById('tooltip_form').style.left= tooltipLeft('TTdepartement', form_id)+'px';
        document.getElementById('tooltip_bg').innerHTML = 'Veuillez sélectionner un Département';
        setTimeout(tooltip_fade, 2500);      
        return;   
    }
    if(date_entree==0)
    {
        //fade('tooltip_form');
        document.getElementById('tooltip_form').style.display = 'block';
        document.getElementById('tooltip_form').style.top = tooltipTop('TTdelai', form_id)+'px';
        document.getElementById('tooltip_form').style.left= tooltipLeft('TTdelai', form_id)+'px';
        document.getElementById('tooltip_bg').innerHTML = 'Veuillez sélectionner un Délai';
        setTimeout(tooltip_fade, 2500);
        return;   
    }
    if(nom_contact=='Nom :')
    {
        //fade('tooltip_form');
        document.getElementById('tooltip_form').style.display = 'block';
        document.getElementById('tooltip_form').style.top = tooltipTop('TTnom', form_id)+'px';
        document.getElementById('tooltip_form').style.left= tooltipLeft('TTnom', form_id)+'px';
        document.getElementById('tooltip_bg').innerHTML = 'Veuillez saisir votre nom';
        setTimeout(tooltip_fade, 2500);
        return;  
    }
    if(tel_personnel_contact=='Tel :')
    {
        //fade('tooltip_form');
        document.getElementById('tooltip_form').style.display = 'block';
        document.getElementById('tooltip_form').style.top = tooltipTop('TTtel', form_id)+'px';
        document.getElementById('tooltip_form').style.left= tooltipLeft('TTtel', form_id)+'px';
        document.getElementById('tooltip_bg').innerHTML = 'Veuillez saisir votre téléphone';
        setTimeout(tooltip_fade, 2500);
        return;
    }
    var numericExp = /^[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}/; // numero a 10 chiffres
	if(tel_personnel_contact!='Tel :' && !tel_personnel_contact.match(numericExp))
    {
        //fade('tooltip_form');
        document.getElementById('tooltip_form').style.display = 'block';
        document.getElementById('tooltip_form').style.top = tooltipTop('TTtel', form_id)+'px';
        document.getElementById('tooltip_form').style.left= tooltipLeft('TTtel', form_id)+'px';
        document.getElementById('tooltip_bg').innerHTML = 'Veuillez saisir un numéro valide';
        setTimeout(tooltip_fade, 2500);
        return;
    }
    
    document.getElementById(form_id).submit();
    
}

// calculate the position of the element in relation to the left of the browser //
function leftPosition(target) {
  var left = 0;
  if(target.offsetParent) {
    while(1) {
      left += target.offsetLeft;
      if(!target.offsetParent) {
        break;
      }
      target = target.offsetParent;
    }
  } else if(target.x) {
    left += target.x;
  }
  return left;
}

// calculate the position of the element in relation to the top of the browser window //
function topPosition(target) {
  var top = 0;
  if(target.offsetParent) {
    while(1) {
      top += target.offsetTop;
      if(!target.offsetParent) {
        break;
      }
      target = target.offsetParent;
    }
  } else if(target.y) {
    top += target.y;
  }
  return top;
}

// TOOLTIP TOP + LEFT
function tooltipTop(field_id, form_id)
{
    var divHeight;
    var obj = document.getElementById(field_id);
    
    if(obj.offsetHeight)          {divHeight=obj.offsetHeight;}
    else if(obj.style.pixelHeight){divHeight=obj.style.pixelHeight;}
    
    if(form_id=='form_vertical')
        var myTop  = topPosition(document.getElementById(field_id))+divHeight-9+10;
    else
        var myTop  = topPosition(document.getElementById(field_id))+divHeight-9;
        
    return myTop;
}

function tooltipLeft(field_id)
{
    // compatibilite navigateur !!!!!!!!!!!!!!!!!!!!!!!!!!
    var myLeft = leftPosition(document.getElementById(field_id));
    return myLeft;
}

// FADE IN + FADE OUT pour TOOLTIP FORMULAIRE
var TimeToFade = 800;

function fade(eid)
{
  var element = document.getElementById(eid);
  if(element == null)
    return;
    
  if(element.FadeState == null)
  {
    if(element.style.opacity == null || element.style.opacity == '' || element.style.opacity == '0')
      element.FadeState = 1;
    else
      element.FadeState = -1;
  }
  else
  {
    if(element.FadeState==1)
        element.FadeState = -1;
    else
        element.FadeState = 1;
  }
   
  element.FadeTimeLeft = TimeToFade;
  setTimeout("animateFade(" + new Date().getTime() + ",'" + eid + "')", 20);
}

function animateFade(lastTick, eid)
{  
  var curTick = new Date().getTime();
  var elapsedTicks = curTick - lastTick;
 
  var element = document.getElementById(eid);
 
  if(element.FadeTimeLeft <= elapsedTicks)
  {
    element.style.opacity = element.FadeState == 1 ? '1' : '0';
    element.style.filter = 'alpha(opacity = '
        + (element.FadeState == 1 ? '100' : '0') + ')';
    element.FadeState = element.FadeState == 1 ? 1 : -1;
    return;
  }
 
  element.FadeTimeLeft -= elapsedTicks;
  var newOpVal = element.FadeTimeLeft/TimeToFade;
  if(element.FadeState == 1)
    newOpVal = 1 - newOpVal;

  element.style.opacity = newOpVal;
  element.style.filter = 'alpha(opacity = ' + (newOpVal*100) + ')';
 
  setTimeout("animateFade(" + curTick + ",'" + eid + "')", 20);
}


// SHOW TOOLTIP MAP
function affiche_tooltip_selon_alt(event,item,baliseId,offsetX,offsetY)
{
	netscape = false;
	if(navigator.appName.substring(0,8) == "Netscape")
	{
		netscape = true;
	}	
	x = (netscape) ? event.pageX : event.x + document.documentElement.scrollLeft;
	y = (netscape) ? event.pageY : event.y + document.documentElement.scrollTop;
	document.getElementById(baliseId).style.left=x-offsetX+"px";
	document.getElementById(baliseId).style.top=y-offsetY+"px";
	document.getElementById(baliseId).style.visibility='visible';
	document.getElementById(baliseId).style.display='block';
	document.getElementById(baliseId).innerHTML=item.alt;
}

// HIDE TOOLTIP MAP
function hide_tooltip(baliseId)
{
	document.getElementById(baliseId).style.display='none';
	document.getElementById(baliseId).style.visibility='hidden';
}


//
// Fonction javascript
//
function limite_check(nom_champ, nbre_limit) {
var nbre = 0;
var nbre_check = 0;

nom = document.getElementById('form_profil').elements[nom_champ];
nbre_check = nom.length;

for(i = 0; i < nbre_check; i++) {
if(nom[i].checked == true)
nbre++;
}

if(nbre >= nbre_limit) {
for(i = 0; i < nbre_check; i++) {
if(nom[i].checked == false)
nom[i].disabled = true;
}
}
else {
for(i = 0; i < nbre_check; i++) {
if(nom[i].checked == false)
nom[i].disabled = false;
}
}
}
