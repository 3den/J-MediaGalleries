var hidden = "div2";
var visible = "div1";
window.addEvent('domready',function(){
	$(hidden).fade('out');
	$$('.thumbnail').filter('img[active=false]').fade(".6");
	$$('.thumbnail').addEvent('mouseover',function(){
		this.fade('in');
	});
	$$('.thumbnail').addEvent('mouseleave',function(){
		if(this.get('active')!='true')
			this.fade('.6');

	});
	$$('.thumbnail').addEvent('click',function(){
		$$('img[active=true]')[0].fade('.6');
		$$('.thumbnail').set('active','false');
		this.set('active','true');
		$(hidden).getElement('img').set('src',this.get('src'));
		$(hidden).fade('in');
		$(visible).fade('out');
		if(hidden=='div1')
		{
			hidden="div2"; visible="div1";
		}
		else
		{
			hidden="div1"; visible="div2";
		}
	});
	
});

function show(whichOne){
    if(whichOne == 1){
        tDiv = "div1";
        vDiv = "div2";
    }else{
        tDiv = "div2";
        vDiv = "div1";
    }
    if($(tDiv).fx){$(tDiv).fx.stop();}
    if($(vDiv).fx){$(vDiv).fx.stop();}
    $(tDiv).fade('in');
    $(vDiv).fade('out');
}