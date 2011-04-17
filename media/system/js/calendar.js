/*  Copyright Mihai Bazon, 2002-2005  |  www.bazon.net/mishoo
 * -----------------------------------------------------------
 *
 * The DHTML Calendar, version 1.0 "It is happening again"
 *
 * Details and latest version at:
 * www.dynarch.com/projects/calendar
 *
 * This script is developed by Dynarch.com.  Visit us at www.dynarch.com.
 *
 * This script is distributed under the GNU Lesser General Public License.
 * Read the entire license text here: http://www.gnu.org/licenses/lgpl.html
 */
Calendar=function(d,c,f,a){this.activeDiv=null;this.currentDateEl=null;this.getDateStatus=null;this.getDateToolTip=null;this.getDateText=null;this.timeout=null;this.onSelected=f||null;this.onClose=a||null;this.dragging=false;this.hidden=false;this.minYear=1970;this.maxYear=2050;this.dateFormat=Calendar._TT.DEF_DATE_FORMAT;this.ttDateFormat=Calendar._TT.TT_DATE_FORMAT;this.isPopup=true;this.weekNumbers=true;this.firstDayOfWeek=typeof d=="number"?d:Calendar._FD;this.showsOtherMonths=false;this.dateStr=c;this.ar_days=null;this.showsTime=false;this.time24=true;this.yearStep=2;this.hiliteToday=true;this.multiple=null;this.table=null;this.element=null;this.tbody=null;this.firstdayname=null;this.monthsCombo=null;this.yearsCombo=null;this.hilitedMonth=null;this.activeMonth=null;this.hilitedYear=null;this.activeYear=null;this.dateClicked=false;if(typeof Calendar._SDN=="undefined"){if(typeof Calendar._SDN_len=="undefined"){Calendar._SDN_len=3}var b=new Array();for(var e=8;e>0;){b[--e]=Calendar._DN[e].substr(0,Calendar._SDN_len)}Calendar._SDN=b;if(typeof Calendar._SMN_len=="undefined"){Calendar._SMN_len=3}b=new Array();for(var e=12;e>0;){b[--e]=Calendar._MN[e].substr(0,Calendar._SMN_len)}Calendar._SMN=b}};Calendar._C=null;Calendar.is_ie=(/msie/i.test(navigator.userAgent)&&!/opera/i.test(navigator.userAgent));Calendar.is_ie5=(Calendar.is_ie&&/msie 5\.0/i.test(navigator.userAgent));Calendar.is_opera=/opera/i.test(navigator.userAgent);Calendar.is_khtml=/Konqueror|Safari|KHTML/i.test(navigator.userAgent);Calendar.getAbsolutePos=function(e){var a=0,d=0;var c=/^div$/i.test(e.tagName);if(c&&e.scrollLeft){a=e.scrollLeft}if(c&&e.scrollTop){d=e.scrollTop}var f={x:e.offsetLeft-a,y:e.offsetTop-d};if(e.offsetParent){var b=this.getAbsolutePos(e.offsetParent);f.x+=b.x;f.y+=b.y}return f};Calendar.isRelated=function(c,a){var d=a.relatedTarget;if(!d){var b=a.type;if(b=="mouseover"){d=a.fromElement}else{if(b=="mouseout"){d=a.toElement}}}while(d){if(d==c){return true}d=d.parentNode}return false};Calendar.removeClass=function(e,d){if(!(e&&e.className)){return}var a=e.className.split(" ");var b=new Array();for(var c=a.length;c>0;){if(a[--c]!=d){b[b.length]=a[c]}}e.className=b.join(" ")};Calendar.addClass=function(b,a){Calendar.removeClass(b,a);b.className+=" "+a};Calendar.getElement=function(a){var b=Calendar.is_ie?window.event.srcElement:a.currentTarget;while(b.nodeType!=1||/^div$/i.test(b.tagName)){b=b.parentNode}return b};Calendar.getTargetElement=function(a){var b=Calendar.is_ie?window.event.srcElement:a.target;while(b.nodeType!=1){b=b.parentNode}return b};Calendar.stopEvent=function(a){a||(a=window.event);if(Calendar.is_ie){a.cancelBubble=true;a.returnValue=false}else{a.preventDefault();a.stopPropagation()}return false};Calendar.addEvent=function(a,c,b){if(a.attachEvent){a.attachEvent("on"+c,b)}else{if(a.addEventListener){a.addEventListener(c,b,true)}else{a["on"+c]=b}}};Calendar.removeEvent=function(a,c,b){if(a.detachEvent){a.detachEvent("on"+c,b)}else{if(a.removeEventListener){a.removeEventListener(c,b,true)}else{a["on"+c]=null}}};Calendar.createElement=function(c,b){var a=null;if(document.createElementNS){a=document.createElementNS("http://www.w3.org/1999/xhtml",c)}else{a=document.createElement(c)}if(typeof b!="undefined"){b.appendChild(a)}return a};Calendar._add_evs=function(el){with(Calendar){addEvent(el,"mouseover",dayMouseOver);addEvent(el,"mousedown",dayMouseDown);addEvent(el,"mouseout",dayMouseOut);if(is_ie){addEvent(el,"dblclick",dayMouseDblClick);el.setAttribute("unselectable",true)}}};Calendar.findMonth=function(a){if(typeof a.month!="undefined"){return a}else{if(typeof a.parentNode.month!="undefined"){return a.parentNode}}return null};Calendar.findYear=function(a){if(typeof a.year!="undefined"){return a}else{if(typeof a.parentNode.year!="undefined"){return a.parentNode}}return null};Calendar.showMonthsCombo=function(){var e=Calendar._C;if(!e){return false}var e=e;var f=e.activeDiv;var d=e.monthsCombo;if(e.hilitedMonth){Calendar.removeClass(e.hilitedMonth,"hilite")}if(e.activeMonth){Calendar.removeClass(e.activeMonth,"active")}var c=e.monthsCombo.getElementsByTagName("div")[e.date.getMonth()];Calendar.addClass(c,"active");e.activeMonth=c;var b=d.style;b.display="block";if(f.navtype<0){b.left=f.offsetLeft+"px"}else{var a=d.offsetWidth;if(typeof a=="undefined"){a=50}b.left=(f.offsetLeft+f.offsetWidth-a)+"px"}b.top=(f.offsetTop+f.offsetHeight)+"px"};Calendar.showYearsCombo=function(d){var a=Calendar._C;if(!a){return false}var a=a;var c=a.activeDiv;var f=a.yearsCombo;if(a.hilitedYear){Calendar.removeClass(a.hilitedYear,"hilite")}if(a.activeYear){Calendar.removeClass(a.activeYear,"active")}a.activeYear=null;var b=a.date.getFullYear()+(d?1:-1);var j=f.firstChild;var h=false;for(var e=12;e>0;--e){if(b>=a.minYear&&b<=a.maxYear){j.innerHTML=b;j.year=b;j.style.display="block";h=true}else{j.style.display="none"}j=j.nextSibling;b+=d?a.yearStep:-a.yearStep}if(h){var k=f.style;k.display="block";if(c.navtype<0){k.left=c.offsetLeft+"px"}else{var g=f.offsetWidth;if(typeof g=="undefined"){g=50}k.left=(c.offsetLeft+c.offsetWidth-g)+"px"}k.top=(c.offsetTop+c.offsetHeight)+"px"}};Calendar.tableMouseUp=function(ev){var cal=Calendar._C;if(!cal){return false}if(cal.timeout){clearTimeout(cal.timeout)}var el=cal.activeDiv;if(!el){return false}var target=Calendar.getTargetElement(ev);ev||(ev=window.event);Calendar.removeClass(el,"active");if(target==el||target.parentNode==el){Calendar.cellClick(el,ev)}var mon=Calendar.findMonth(target);var date=null;if(mon){date=new Date(cal.date);if(mon.month!=date.getMonth()){date.setMonth(mon.month);cal.setDate(date);cal.dateClicked=false;cal.callHandler()}}else{var year=Calendar.findYear(target);if(year){date=new Date(cal.date);if(year.year!=date.getFullYear()){date.setFullYear(year.year);cal.setDate(date);cal.dateClicked=false;cal.callHandler()}}}with(Calendar){removeEvent(document,"mouseup",tableMouseUp);removeEvent(document,"mouseover",tableMouseOver);removeEvent(document,"mousemove",tableMouseOver);cal._hideCombos();_C=null;return stopEvent(ev)}};Calendar.tableMouseOver=function(n){var a=Calendar._C;if(!a){return}var c=a.activeDiv;var j=Calendar.getTargetElement(n);if(j==c||j.parentNode==c){Calendar.addClass(c,"hilite active");Calendar.addClass(c.parentNode,"rowhilite")}else{if(typeof c.navtype=="undefined"||(c.navtype!=50&&(c.navtype==0||Math.abs(c.navtype)>2))){Calendar.removeClass(c,"active")}Calendar.removeClass(c,"hilite");Calendar.removeClass(c.parentNode,"rowhilite")}n||(n=window.event);if(c.navtype==50&&j!=c){var m=Calendar.getAbsolutePos(c);var p=c.offsetWidth;var o=n.clientX;var q;var l=true;if(o>m.x+p){q=o-m.x-p;l=false}else{q=m.x-o}if(q<0){q=0}var f=c._range;var h=c._current;var g=Math.floor(q/10)%f.length;for(var e=f.length;--e>=0;){if(f[e]==h){break}}while(g-->0){if(l){if(--e<0){e=f.length-1}}else{if(++e>=f.length){e=0}}}var b=f[e];c.innerHTML=b;a.onUpdateTime()}var d=Calendar.findMonth(j);if(d){if(d.month!=a.date.getMonth()){if(a.hilitedMonth){Calendar.removeClass(a.hilitedMonth,"hilite")}Calendar.addClass(d,"hilite");a.hilitedMonth=d}else{if(a.hilitedMonth){Calendar.removeClass(a.hilitedMonth,"hilite")}}}else{if(a.hilitedMonth){Calendar.removeClass(a.hilitedMonth,"hilite")}var k=Calendar.findYear(j);if(k){if(k.year!=a.date.getFullYear()){if(a.hilitedYear){Calendar.removeClass(a.hilitedYear,"hilite")}Calendar.addClass(k,"hilite");a.hilitedYear=k}else{if(a.hilitedYear){Calendar.removeClass(a.hilitedYear,"hilite")}}}else{if(a.hilitedYear){Calendar.removeClass(a.hilitedYear,"hilite")}}}return Calendar.stopEvent(n)};Calendar.tableMouseDown=function(a){if(Calendar.getTargetElement(a)==Calendar.getElement(a)){return Calendar.stopEvent(a)}};Calendar.calDragIt=function(b){var c=Calendar._C;if(!(c&&c.dragging)){return false}var e;var d;if(Calendar.is_ie){d=window.event.clientY+document.body.scrollTop;e=window.event.clientX+document.body.scrollLeft}else{e=b.pageX;d=b.pageY}c.hideShowCovered();var a=c.element.style;a.left=(e-c.xOffs)+"px";a.top=(d-c.yOffs)+"px";return Calendar.stopEvent(b)};Calendar.calDragEnd=function(ev){var cal=Calendar._C;if(!cal){return false}cal.dragging=false;with(Calendar){removeEvent(document,"mousemove",calDragIt);removeEvent(document,"mouseup",calDragEnd);tableMouseUp(ev)}cal.hideShowCovered()};Calendar.dayMouseDown=function(ev){var el=Calendar.getElement(ev);if(el.disabled){return false}var cal=el.calendar;cal.activeDiv=el;Calendar._C=cal;if(el.navtype!=300){with(Calendar){if(el.navtype==50){el._current=el.innerHTML;addEvent(document,"mousemove",tableMouseOver)}else{addEvent(document,Calendar.is_ie5?"mousemove":"mouseover",tableMouseOver)}addClass(el,"hilite active");addEvent(document,"mouseup",tableMouseUp)}}else{if(cal.isPopup){cal._dragStart(ev)}}if(el.navtype==-1||el.navtype==1){if(cal.timeout){clearTimeout(cal.timeout)}cal.timeout=setTimeout("Calendar.showMonthsCombo()",250)}else{if(el.navtype==-2||el.navtype==2){if(cal.timeout){clearTimeout(cal.timeout)}cal.timeout=setTimeout((el.navtype>0)?"Calendar.showYearsCombo(true)":"Calendar.showYearsCombo(false)",250)}else{cal.timeout=null}}return Calendar.stopEvent(ev)};Calendar.dayMouseDblClick=function(a){Calendar.cellClick(Calendar.getElement(a),a||window.event);if(Calendar.is_ie){document.selection.empty()}};Calendar.dayMouseOver=function(b){var a=Calendar.getElement(b);if(Calendar.isRelated(a,b)||Calendar._C||a.disabled){return false}if(a.ttip){if(a.ttip.substr(0,1)=="_"){a.ttip=a.caldate.print(a.calendar.ttDateFormat)+a.ttip.substr(1)}a.calendar.tooltips.innerHTML=a.ttip}if(a.navtype!=300){Calendar.addClass(a,"hilite");if(a.caldate){Calendar.addClass(a.parentNode,"rowhilite");var c=a.calendar;if(c&&c.getDateToolTip){var e=a.caldate;window.status=e;a.title=c.getDateToolTip(e,e.getFullYear(),e.getMonth(),e.getDate())}}}return Calendar.stopEvent(b)};Calendar.dayMouseOut=function(ev){with(Calendar){var el=getElement(ev);if(isRelated(el,ev)||_C||el.disabled){return false}removeClass(el,"hilite");if(el.caldate){removeClass(el.parentNode,"rowhilite")}if(el.calendar){el.calendar.tooltips.innerHTML=_TT.SEL_DATE}}};Calendar.cellClick=function(e,o){var c=e.calendar;var h=false;var l=false;var f=null;if(typeof e.navtype=="undefined"){if(c.currentDateEl){Calendar.removeClass(c.currentDateEl,"selected");Calendar.addClass(e,"selected");h=(c.currentDateEl==e);if(!h){c.currentDateEl=e}}c.date.setDateOnly(e.caldate);f=c.date;var b=!(c.dateClicked=!e.otherMonth);if(!b&&!c.currentDateEl&&c.multiple){c._toggleMultipleDate(new Date(f))}else{l=!e.disabled}if(b){c._init(c.firstDayOfWeek,f)}}else{if(e.navtype==200){Calendar.removeClass(e,"hilite");c.callCloseHandler();return}f=new Date(c.date);if(e.navtype==0){f.setDateOnly(new Date())}c.dateClicked=false;var n=f.getFullYear();var g=f.getMonth();function a(q){var r=f.getDate();var i=f.getMonthDays(q);if(r>i){f.setDate(i)}f.setMonth(q)}switch(e.navtype){case 400:Calendar.removeClass(e,"hilite");var p=Calendar._TT.ABOUT;if(typeof p!="undefined"){p+=c.showsTime?Calendar._TT.ABOUT_TIME:""}else{p='Help and about box text is not translated into this language.\nIf you know this language and you feel generous please update\nthe corresponding file in "lang" subdir to match calendar-en.js\nand send it back to <mihai_bazon@yahoo.com> to get it into the distribution  ;-)\n\nThank you!\nhttp://dynarch.com/mishoo/calendar.epl\n'}alert(p);return;case -2:if(n>c.minYear){f.setFullYear(n-1)}break;case -1:if(g>0){a(g-1)}else{if(n-->c.minYear){f.setFullYear(n);a(11)}}break;case 1:if(g<11){a(g+1)}else{if(n<c.maxYear){f.setFullYear(n+1);a(0)}}break;case 2:if(n<c.maxYear){f.setFullYear(n+1)}break;case 100:c.setFirstDayOfWeek(e.fdow);return;case 50:var k=e._range;var m=e.innerHTML;for(var j=k.length;--j>=0;){if(k[j]==m){break}}if(o&&o.shiftKey){if(--j<0){j=k.length-1}}else{if(++j>=k.length){j=0}}var d=k[j];e.innerHTML=d;c.onUpdateTime();return;case 0:if((typeof c.getDateStatus=="function")&&c.getDateStatus(f,f.getFullYear(),f.getMonth(),f.getDate())){return false}break}if(!f.equalsTo(c.date)){c.setDate(f);l=true}else{if(e.navtype==0){l=h=true}}}if(l){o&&c.callHandler()}if(h){Calendar.removeClass(e,"hilite");o&&c.callCloseHandler()}};Calendar.prototype.create=function(n){var m=null;if(!n){m=document.getElementsByTagName("body")[0];this.isPopup=true}else{m=n;this.isPopup=false}this.date=this.dateStr?new Date(this.dateStr):new Date();var q=Calendar.createElement("table");this.table=q;q.cellSpacing=0;q.cellPadding=0;q.calendar=this;Calendar.addEvent(q,"mousedown",Calendar.tableMouseDown);var a=Calendar.createElement("div");this.element=a;a.className="calendar";if(this.isPopup){a.style.position="absolute";a.style.display="none"}a.appendChild(q);var k=Calendar.createElement("thead",q);var o=null;var r=null;var b=this;var e=function(s,j,i){o=Calendar.createElement("td",r);o.colSpan=j;o.className="button";if(i!=0&&Math.abs(i)<=2){o.className+=" nav"}Calendar._add_evs(o);o.calendar=b;o.navtype=i;o.innerHTML="<div unselectable='on'>"+s+"</div>";return o};r=Calendar.createElement("tr",k);var c=6;(this.isPopup)&&--c;(this.weekNumbers)&&++c;e("?",1,400).ttip=Calendar._TT.INFO;this.title=e("",c,300);this.title.className="title";if(this.isPopup){this.title.ttip=Calendar._TT.DRAG_TO_MOVE;this.title.style.cursor="move";e("&#x00d7;",1,200).ttip=Calendar._TT.CLOSE}r=Calendar.createElement("tr",k);r.className="headrow";this._nav_py=e("&#x00ab;",1,-2);this._nav_py.ttip=Calendar._TT.PREV_YEAR;this._nav_pm=e("&#x2039;",1,-1);this._nav_pm.ttip=Calendar._TT.PREV_MONTH;this._nav_now=e(Calendar._TT.TODAY,this.weekNumbers?4:3,0);this._nav_now.ttip=Calendar._TT.GO_TODAY;this._nav_nm=e("&#x203a;",1,1);this._nav_nm.ttip=Calendar._TT.NEXT_MONTH;this._nav_ny=e("&#x00bb;",1,2);this._nav_ny.ttip=Calendar._TT.NEXT_YEAR;r=Calendar.createElement("tr",k);r.className="daynames";if(this.weekNumbers){o=Calendar.createElement("td",r);o.className="name wn";o.innerHTML=Calendar._TT.WK}for(var h=7;h>0;--h){o=Calendar.createElement("td",r);if(!h){o.navtype=100;o.calendar=this;Calendar._add_evs(o)}}this.firstdayname=(this.weekNumbers)?r.firstChild.nextSibling:r.firstChild;this._displayWeekdays();var g=Calendar.createElement("tbody",q);this.tbody=g;for(h=6;h>0;--h){r=Calendar.createElement("tr",g);if(this.weekNumbers){o=Calendar.createElement("td",r)}for(var f=7;f>0;--f){o=Calendar.createElement("td",r);o.calendar=this;Calendar._add_evs(o)}}if(this.showsTime){r=Calendar.createElement("tr",g);r.className="time";o=Calendar.createElement("td",r);o.className="time";o.colSpan=2;o.innerHTML=Calendar._TT.TIME||"&#160;";o=Calendar.createElement("td",r);o.className="time";o.colSpan=this.weekNumbers?4:3;(function(){function t(C,E,D,F){var A=Calendar.createElement("span",o);A.className=C;A.innerHTML=E;A.calendar=b;A.ttip=Calendar._TT.TIME_PART;A.navtype=50;A._range=[];if(typeof D!="number"){A._range=D}else{for(var B=D;B<=F;++B){var z;if(B<10&&F>=10){z="0"+B}else{z=""+B}A._range[A._range.length]=z}}Calendar._add_evs(A);return A}var x=b.date.getHours();var i=b.date.getMinutes();var y=!b.time24;var j=(x>12);if(y&&j){x-=12}var v=t("hour",x,y?1:0,y?12:23);var u=Calendar.createElement("span",o);u.innerHTML=":";u.className="colon";var s=t("minute",i,0,59);var w=null;o=Calendar.createElement("td",r);o.className="time";o.colSpan=2;if(y){w=t("ampm",j?"pm":"am",["am","pm"])}else{o.innerHTML="&#160;"}b.onSetTime=function(){var A,z=this.date.getHours(),B=this.date.getMinutes();if(y){A=(z>=12);if(A){z-=12}if(z==0){z=12}w.innerHTML=A?"pm":"am"}v.innerHTML=(z<10)?("0"+z):z;s.innerHTML=(B<10)?("0"+B):B};b.onUpdateTime=function(){var A=this.date;var B=parseInt(v.innerHTML,10);if(y){if(/pm/i.test(w.innerHTML)&&B<12){B+=12}else{if(/am/i.test(w.innerHTML)&&B==12){B=0}}}var C=A.getDate();var z=A.getMonth();var D=A.getFullYear();A.setHours(B);A.setMinutes(parseInt(s.innerHTML,10));A.setFullYear(D);A.setMonth(z);A.setDate(C);this.dateClicked=false;this.callHandler()}})()}else{this.onSetTime=this.onUpdateTime=function(){}}var l=Calendar.createElement("tfoot",q);r=Calendar.createElement("tr",l);r.className="footrow";o=e(Calendar._TT.SEL_DATE,this.weekNumbers?8:7,300);o.className="ttip";if(this.isPopup){o.ttip=Calendar._TT.DRAG_TO_MOVE;o.style.cursor="move"}this.tooltips=o;a=Calendar.createElement("div",this.element);this.monthsCombo=a;a.className="combo";for(h=0;h<Calendar._MN.length;++h){var d=Calendar.createElement("div");d.className=Calendar.is_ie?"label-IEfix":"label";d.month=h;d.innerHTML=Calendar._SMN[h];a.appendChild(d)}a=Calendar.createElement("div",this.element);this.yearsCombo=a;a.className="combo";for(h=12;h>0;--h){var p=Calendar.createElement("div");p.className=Calendar.is_ie?"label-IEfix":"label";a.appendChild(p)}this._init(this.firstDayOfWeek,this.date);m.appendChild(this.element)};Calendar._keyEvent=function(k){var a=window._dynarch_popupCalendar;if(!a||a.multiple){return false}(Calendar.is_ie)&&(k=window.event);var i=(Calendar.is_ie||k.type=="keypress"),l=k.keyCode;if(k.ctrlKey){switch(l){case 37:i&&Calendar.cellClick(a._nav_pm);break;case 38:i&&Calendar.cellClick(a._nav_py);break;case 39:i&&Calendar.cellClick(a._nav_nm);break;case 40:i&&Calendar.cellClick(a._nav_ny);break;default:return false}}else{switch(l){case 32:Calendar.cellClick(a._nav_now);break;case 27:i&&a.callCloseHandler();break;case 37:case 38:case 39:case 40:if(i){var e,m,j,g,c,d;e=l==37||l==38;d=(l==37||l==39)?1:7;function b(){c=a.currentDateEl;var n=c.pos;m=n&15;j=n>>4;g=a.ar_days[j][m]}b();function f(){var n=new Date(a.date);n.setDate(n.getDate()-d);a.setDate(n)}function h(){var n=new Date(a.date);n.setDate(n.getDate()+d);a.setDate(n)}while(1){switch(l){case 37:if(--m>=0){g=a.ar_days[j][m]}else{m=6;l=38;continue}break;case 38:if(--j>=0){g=a.ar_days[j][m]}else{f();b()}break;case 39:if(++m<7){g=a.ar_days[j][m]}else{m=0;l=40;continue}break;case 40:if(++j<a.ar_days.length){g=a.ar_days[j][m]}else{h();b()}break}break}if(g){if(!g.disabled){Calendar.cellClick(g)}else{if(e){f()}else{h()}}}}break;case 13:if(i){Calendar.cellClick(a.currentDateEl,k)}break;default:return false}}return Calendar.stopEvent(k)};Calendar.prototype._init=function(m,w){var v=new Date(),q=v.getFullYear(),y=v.getMonth(),b=v.getDate();this.table.style.visibility="hidden";var h=w.getFullYear();if(h<this.minYear){h=this.minYear;w.setFullYear(h)}else{if(h>this.maxYear){h=this.maxYear;w.setFullYear(h)}}this.firstDayOfWeek=m;this.date=new Date(w);var x=w.getMonth();var A=w.getDate();var z=w.getMonthDays();w.setDate(1);var r=(w.getDay()-this.firstDayOfWeek)%7;if(r<0){r+=7}w.setDate(-r);w.setDate(w.getDate()+1);var e=this.tbody.firstChild;var k=Calendar._SMN[x];var o=this.ar_days=new Array();var n=Calendar._TT.WEEKEND;var d=this.multiple?(this.datesCells={}):null;for(var t=0;t<6;++t,e=e.nextSibling){var a=e.firstChild;if(this.weekNumbers){a.className="day wn";a.innerHTML=w.getWeekNumber();a=a.nextSibling}e.className="daysrow";var u=false,f,c=o[t]=[];for(var s=0;s<7;++s,a=a.nextSibling,w.setDate(f+1)){f=w.getDate();var g=w.getDay();a.className="day";a.pos=t<<4|s;c[s]=a;var l=(w.getMonth()==x);if(!l){if(this.showsOtherMonths){a.className+=" othermonth";a.otherMonth=true}else{a.className="emptycell";a.innerHTML="&#160;";a.disabled=true;continue}}else{a.otherMonth=false;u=true}a.disabled=false;a.innerHTML=this.getDateText?this.getDateText(w,f):f;if(d){d[w.print("%Y%m%d")]=a}if(this.getDateStatus){var p=this.getDateStatus(w,h,x,f);if(p===true){a.className+=" disabled";a.disabled=true}else{if(/disabled/i.test(p)){a.disabled=true}a.className+=" "+p}}if(!a.disabled){a.caldate=new Date(w);a.ttip="_";if(!this.multiple&&l&&f==A&&this.hiliteToday){a.className+=" selected";this.currentDateEl=a}if(w.getFullYear()==q&&w.getMonth()==y&&f==b){a.className+=" today";a.ttip+=Calendar._TT.PART_TODAY}if(n.indexOf(g.toString())!=-1){a.className+=a.otherMonth?" oweekend":" weekend"}}}if(!(u||this.showsOtherMonths)){e.className="emptyrow"}}this.title.innerHTML=Calendar._MN[x]+", "+h;this.onSetTime();this.table.style.visibility="visible";this._initMultipleDates()};Calendar.prototype._initMultipleDates=function(){if(this.multiple){for(var b in this.multiple){var a=this.datesCells[b];var c=this.multiple[b];if(!c){continue}if(a){a.className+=" selected"}}}};Calendar.prototype._toggleMultipleDate=function(b){if(this.multiple){var c=b.print("%Y%m%d");var a=this.datesCells[c];if(a){var e=this.multiple[c];if(!e){Calendar.addClass(a,"selected");this.multiple[c]=b}else{Calendar.removeClass(a,"selected");delete this.multiple[c]}}}};Calendar.prototype.setDateToolTipHandler=function(a){this.getDateToolTip=a};Calendar.prototype.setDate=function(a){if(!a.equalsTo(this.date)){this._init(this.firstDayOfWeek,a)}};Calendar.prototype.refresh=function(){this._init(this.firstDayOfWeek,this.date)};Calendar.prototype.setFirstDayOfWeek=function(a){this._init(a,this.date);this._displayWeekdays()};Calendar.prototype.setDateStatusHandler=Calendar.prototype.setDisabledHandler=function(a){this.getDateStatus=a};Calendar.prototype.setRange=function(b,c){this.minYear=b;this.maxYear=c};Calendar.prototype.callHandler=function(){if(this.onSelected){this.onSelected(this,this.date.print(this.dateFormat))}};Calendar.prototype.callCloseHandler=function(){if(this.onClose){this.onClose(this)}this.hideShowCovered()};Calendar.prototype.destroy=function(){var a=this.element.parentNode;a.removeChild(this.element);Calendar._C=null;window._dynarch_popupCalendar=null};Calendar.prototype.reparent=function(b){var a=this.element;a.parentNode.removeChild(a);b.appendChild(a)};Calendar._checkCalendar=function(b){var c=window._dynarch_popupCalendar;if(!c){return false}var a=Calendar.is_ie?Calendar.getElement(b):Calendar.getTargetElement(b);for(;a!=null&&a!=c.element;a=a.parentNode){}if(a==null){window._dynarch_popupCalendar.callCloseHandler();return Calendar.stopEvent(b)}};Calendar.prototype.show=function(){var e=this.table.getElementsByTagName("tr");for(var d=e.length;d>0;){var f=e[--d];Calendar.removeClass(f,"rowhilite");var c=f.getElementsByTagName("td");for(var b=c.length;b>0;){var a=c[--b];Calendar.removeClass(a,"hilite");Calendar.removeClass(a,"active")}}this.element.style.display="block";this.hidden=false;if(this.isPopup){window._dynarch_popupCalendar=this;Calendar.addEvent(document,"keydown",Calendar._keyEvent);Calendar.addEvent(document,"keypress",Calendar._keyEvent);Calendar.addEvent(document,"mousedown",Calendar._checkCalendar)}this.hideShowCovered()};Calendar.prototype.hide=function(){if(this.isPopup){Calendar.removeEvent(document,"keydown",Calendar._keyEvent);Calendar.removeEvent(document,"keypress",Calendar._keyEvent);Calendar.removeEvent(document,"mousedown",Calendar._checkCalendar)}this.element.style.display="none";this.hidden=true;this.hideShowCovered()};Calendar.prototype.showAt=function(a,c){var b=this.element.style;b.left=a+"px";b.top=c+"px";this.show()};Calendar.prototype.showAtElement=function(c,d){var a=this;var e=Calendar.getAbsolutePos(c);if(!d||typeof d!="string"){this.showAt(e.x,e.y+c.offsetHeight);return true}function b(i){if(i.x<0){i.x=0}if(i.y<0){i.y=0}var j=document.createElement("div");var h=j.style;h.position="absolute";h.right=h.bottom=h.width=h.height="0px";document.body.appendChild(j);var g=Calendar.getAbsolutePos(j);document.body.removeChild(j);if(Calendar.is_ie){g.y+=document.body.scrollTop;g.x+=document.body.scrollLeft}else{g.y+=window.scrollY;g.x+=window.scrollX}var f=i.x+i.width-g.x;if(f>0){i.x-=f}f=i.y+i.height-g.y;if(f>0){i.y-=f}}this.element.style.display="block";Calendar.continuation_for_the_khtml_browser=function(){var f=a.element.offsetWidth;var i=a.element.offsetHeight;a.element.style.display="none";var g=d.substr(0,1);var j="l";if(d.length>1){j=d.substr(1,1)}switch(g){case"T":e.y-=i;break;case"B":e.y+=c.offsetHeight;break;case"C":e.y+=(c.offsetHeight-i)/2;break;case"t":e.y+=c.offsetHeight-i;break;case"b":break}switch(j){case"L":e.x-=f;break;case"R":e.x+=c.offsetWidth;break;case"C":e.x+=(c.offsetWidth-f)/2;break;case"l":e.x+=c.offsetWidth-f;break;case"r":break}e.width=f;e.height=i+40;a.monthsCombo.style.display="none";b(e);a.showAt(e.x,e.y)};if(Calendar.is_khtml){setTimeout("Calendar.continuation_for_the_khtml_browser()",10)}else{Calendar.continuation_for_the_khtml_browser()}};Calendar.prototype.setDateFormat=function(a){this.dateFormat=a};Calendar.prototype.setTtDateFormat=function(a){this.ttDateFormat=a};Calendar.prototype.parseDate=function(b,a){if(!a){a=this.dateFormat}this.setDate(Date.parseDate(b,a))};Calendar.prototype.hideShowCovered=function(){if(!Calendar.is_ie&&!Calendar.is_opera){return}function b(k){var i=k.style.visibility;if(!i){if(document.defaultView&&typeof(document.defaultView.getComputedStyle)=="function"){if(!Calendar.is_khtml){i=document.defaultView.getComputedStyle(k,"").getPropertyValue("visibility")}else{i=""}}else{if(k.currentStyle){i=k.currentStyle.visibility}else{i=""}}}return i}var s=new Array("applet","iframe","select");var c=this.element;var a=Calendar.getAbsolutePos(c);var f=a.x;var d=c.offsetWidth+f;var r=a.y;var q=c.offsetHeight+r;for(var h=s.length;h>0;){var g=document.getElementsByTagName(s[--h]);var e=null;for(var l=g.length;l>0;){e=g[--l];a=Calendar.getAbsolutePos(e);var o=a.x;var n=e.offsetWidth+o;var m=a.y;var j=e.offsetHeight+m;if(this.hidden||(o>d)||(n<f)||(m>q)||(j<r)){if(!e.__msh_save_visibility){e.__msh_save_visibility=b(e)}e.style.visibility=e.__msh_save_visibility}else{if(!e.__msh_save_visibility){e.__msh_save_visibility=b(e)}e.style.visibility="hidden"}}}};Calendar.prototype._displayWeekdays=function(){var b=this.firstDayOfWeek;var a=this.firstdayname;var d=Calendar._TT.WEEKEND;for(var c=0;c<7;++c){a.className="day name";var e=(c+b)%7;if(c){a.ttip=Calendar._TT.DAY_FIRST.replace("%s",Calendar._DN[e]);a.navtype=100;a.calendar=this;a.fdow=e;Calendar._add_evs(a)}if(d.indexOf(e.toString())!=-1){Calendar.addClass(a,"weekend")}a.innerHTML=Calendar._SDN[(c+b)%7];a=a.nextSibling}};Calendar.prototype._hideCombos=function(){this.monthsCombo.style.display="none";this.yearsCombo.style.display="none"};Calendar.prototype._dragStart=function(ev){if(this.dragging){return}this.dragging=true;var posX;var posY;if(Calendar.is_ie){posY=window.event.clientY+document.body.scrollTop;posX=window.event.clientX+document.body.scrollLeft}else{posY=ev.clientY+window.scrollY;posX=ev.clientX+window.scrollX}var st=this.element.style;this.xOffs=posX-parseInt(st.left);this.yOffs=posY-parseInt(st.top);with(Calendar){addEvent(document,"mousemove",calDragIt);addEvent(document,"mouseup",calDragEnd)}};Date._MD=new Array(31,28,31,30,31,30,31,31,30,31,30,31);Date.SECOND=1000;Date.MINUTE=60*Date.SECOND;Date.HOUR=60*Date.MINUTE;Date.DAY=24*Date.HOUR;Date.WEEK=7*Date.DAY;Date.parseDate=function(l,c){var n=new Date();var o=0;var e=-1;var k=0;var q=l.split(/\W+/);var p=c.match(/%./g);var h=0,g=0;var r=0;var f=0;for(h=0;h<q.length;++h){if(!q[h]){continue}switch(p[h]){case"%d":case"%e":k=parseInt(q[h],10);break;case"%m":e=parseInt(q[h],10)-1;break;case"%Y":case"%y":o=parseInt(q[h],10);(o<100)&&(o+=(o>29)?1900:2000);break;case"%b":case"%B":for(g=0;g<12;++g){if(Calendar._MN[g].substr(0,q[h].length).toLowerCase()==q[h].toLowerCase()){e=g;break}}break;case"%H":case"%I":case"%k":case"%l":r=parseInt(q[h],10);break;case"%P":case"%p":if(/pm/i.test(q[h])&&r<12){r+=12}else{if(/am/i.test(q[h])&&r>=12){r-=12}}break;case"%M":f=parseInt(q[h],10);break}}if(isNaN(o)){o=n.getFullYear()}if(isNaN(e)){e=n.getMonth()}if(isNaN(k)){k=n.getDate()}if(isNaN(r)){r=n.getHours()}if(isNaN(f)){f=n.getMinutes()}if(o!=0&&e!=-1&&k!=0){return new Date(o,e,k,r,f,0)}o=0;e=-1;k=0;for(h=0;h<q.length;++h){if(q[h].search(/[a-zA-Z]+/)!=-1){var s=-1;for(g=0;g<12;++g){if(Calendar._MN[g].substr(0,q[h].length).toLowerCase()==q[h].toLowerCase()){s=g;break}}if(s!=-1){if(e!=-1){k=e+1}e=s}}else{if(parseInt(q[h],10)<=12&&e==-1){e=q[h]-1}else{if(parseInt(q[h],10)>31&&o==0){o=parseInt(q[h],10);(o<100)&&(o+=(o>29)?1900:2000)}else{if(k==0){k=q[h]}}}}}if(o==0){o=n.getFullYear()}if(e!=-1&&k!=0){return new Date(o,e,k,r,f,0)}return n};Date.prototype.getMonthDays=function(b){var a=this.getFullYear();if(typeof b=="undefined"){b=this.getMonth()}if(((0==(a%4))&&((0!=(a%100))||(0==(a%400))))&&b==1){return 29}else{return Date._MD[b]}};Date.prototype.getDayOfYear=function(){var a=new Date(this.getFullYear(),this.getMonth(),this.getDate(),0,0,0);var c=new Date(this.getFullYear(),0,0,0,0,0);var b=a-c;return Math.floor(b/Date.DAY)};Date.prototype.getWeekNumber=function(){var c=new Date(this.getFullYear(),this.getMonth(),this.getDate(),0,0,0);var b=c.getDay();c.setDate(c.getDate()-(b+6)%7+3);var a=c.valueOf();c.setMonth(0);c.setDate(4);return Math.round((a-c.valueOf())/(7*86400000))+1};Date.prototype.equalsTo=function(a){return((this.getFullYear()==a.getFullYear())&&(this.getMonth()==a.getMonth())&&(this.getDate()==a.getDate())&&(this.getHours()==a.getHours())&&(this.getMinutes()==a.getMinutes()))};Date.prototype.setDateOnly=function(a){var b=new Date(a);this.setDate(1);this.setFullYear(b.getFullYear());this.setMonth(b.getMonth());this.setDate(b.getDate())};Date.prototype.print=function(l){var b=this.getMonth();var k=this.getDate();var n=this.getFullYear();var p=this.getWeekNumber();var q=this.getDay();var v={};var r=this.getHours();var c=(r>=12);var h=(c)?(r-12):r;var u=this.getDayOfYear();if(h==0){h=12}var e=this.getMinutes();var j=this.getSeconds();v["%a"]=Calendar._SDN[q];v["%A"]=Calendar._DN[q];v["%b"]=Calendar._SMN[b];v["%B"]=Calendar._MN[b];v["%C"]=1+Math.floor(n/100);v["%d"]=(k<10)?("0"+k):k;v["%e"]=k;v["%H"]=(r<10)?("0"+r):r;v["%I"]=(h<10)?("0"+h):h;v["%j"]=(u<100)?((u<10)?("00"+u):("0"+u)):u;v["%k"]=r;v["%l"]=h;v["%m"]=(b<9)?("0"+(1+b)):(1+b);v["%M"]=(e<10)?("0"+e):e;v["%n"]="\n";v["%p"]=c?"PM":"AM";v["%P"]=c?"pm":"am";v["%s"]=Math.floor(this.getTime()/1000);v["%S"]=(j<10)?("0"+j):j;v["%t"]="\t";v["%U"]=v["%W"]=v["%V"]=(p<10)?("0"+p):p;v["%u"]=q+1;v["%w"]=q;v["%y"]=(""+n).substr(2,2);v["%Y"]=n;v["%%"]="%";var t=/%./g;if(!Calendar.is_ie5&&!Calendar.is_khtml){return l.replace(t,function(a){return v[a]||a})}var o=l.match(t);for(var g=0;g<o.length;g++){var f=v[o[g]];if(f){t=new RegExp(o[g],"g");l=l.replace(t,f)}}return l};Date.prototype.__msh_oldSetFullYear=Date.prototype.setFullYear;Date.prototype.setFullYear=function(b){var a=new Date(this);a.__msh_oldSetFullYear(b);if(a.getMonth()!=this.getMonth()){this.setDate(28)}this.__msh_oldSetFullYear(b)};window._dynarch_popupCalendar=null;