!function(a){function b(b,d,g,h,i){function j(){p.unbind("webkitTransitionEnd transitionend otransitionend oTransitionEnd"),d&&c(d,g,h,i),i.startOrder=[],i.newOrder=[],i.origSort=[],i.checkSort=[],o.removeStyle(i.prefix+"filter, filter, "+i.prefix+"transform, transform, opacity, display").css(i.clean).removeAttr("data-checksum"),window.atob||o.css({display:"none",opacity:"0"}),p.removeStyle(i.prefix+"transition, transition, "+i.prefix+"perspective, perspective, "+i.prefix+"perspective-origin, perspective-origin, "+(i.resizeContainer?"height":"")),"list"==i.layoutMode?(q.css({display:i.targetDisplayList,opacity:"1"}),i.origDisplay=i.targetDisplayList):(q.css({display:i.targetDisplayGrid,opacity:"1"}),i.origDisplay=i.targetDisplayGrid),i.origLayout=i.layoutMode,setTimeout(function(){if(o.removeStyle(i.prefix+"transition, transition"),i.mixing=!1,"function"==typeof i.onMixEnd){var a=i.onMixEnd.call(this,i);i=a?a:i}})}if(clearInterval(i.failsafe),i.mixing=!0,i.filter=b,"function"==typeof i.onMixStart){var k=i.onMixStart.call(this,i);i=k?k:i}for(var l=i.transitionSpeed,k=0;2>k;k++){var m=0==k?m=i.prefix:"";i.transition[m+"transition"]="all "+l+"ms linear",i.transition[m+"transform"]=m+"translate3d(0,0,0)",i.perspective[m+"perspective"]=i.perspectiveDistance+"px",i.perspective[m+"perspective-origin"]=i.perspectiveOrigin}var n=i.targetSelector,o=h.find(n);o.each(function(){this.data={}});var p=o.parent();p.css(i.perspective),i.easingFallback="ease-in-out","smooth"==i.easing&&(i.easing="cubic-bezier(0.25, 0.46, 0.45, 0.94)"),"snap"==i.easing&&(i.easing="cubic-bezier(0.77, 0, 0.175, 1)"),"windback"==i.easing&&(i.easing="cubic-bezier(0.175, 0.885, 0.320, 1.275)",i.easingFallback="cubic-bezier(0.175, 0.885, 0.320, 1)"),"windup"==i.easing&&(i.easing="cubic-bezier(0.6, -0.28, 0.735, 0.045)",i.easingFallback="cubic-bezier(0.6, 0.28, 0.735, 0.045)"),k="list"==i.layoutMode&&null!=i.listEffects?i.listEffects:i.effects,Array.prototype.indexOf&&(i.fade=-1<k.indexOf("fade")?"0":"",i.scale=-1<k.indexOf("scale")?"scale(.01)":"",i.rotateZ=-1<k.indexOf("rotateZ")?"rotate(180deg)":"",i.rotateY=-1<k.indexOf("rotateY")?"rotateY(90deg)":"",i.rotateX=-1<k.indexOf("rotateX")?"rotateX(90deg)":"",i.blur=-1<k.indexOf("blur")?"blur(8px)":"",i.grayscale=-1<k.indexOf("grayscale")?"grayscale(100%)":"");var q=a(),r=a(),s=[],t=!1;"string"==typeof b?s=f(b):(t=!0,a.each(b,function(a){s[a]=f(this)})),"or"==i.filterLogic?(""==s[0]&&s.shift(),1>s.length?r=r.add(h.find(n+":visible")):o.each(function(){var b=a(this);if(t){var c=0;a.each(s,function(){this.length?b.is("."+this.join(", ."))&&c++:c>0&&c++}),c==s.length?q=q.add(b):r=r.add(b)}else b.is("."+s.join(", ."))?q=q.add(b):r=r.add(b)})):(q=q.add(p.find(n+"."+s.join("."))),r=r.add(p.find(n+":not(."+s.join(".")+"):visible"))),b=q.length;var u=a(),v=a(),w=a();if(r.each(function(){var b=a(this);"none"!=b.css("display")&&(u=u.add(b),w=w.add(b))}),q.filter(":visible").length==b&&!u.length&&!d){if(i.origLayout==i.layoutMode)return j(),!1;if(1==q.length)return"list"==i.layoutMode?(h.addClass(i.listClass),h.removeClass(i.gridClass),w.css("display",i.targetDisplayList)):(h.addClass(i.gridClass),h.removeClass(i.listClass),w.css("display",i.targetDisplayGrid)),j(),!1}if(i.origHeight=p.height(),q.length){if(h.removeClass(i.failClass),q.each(function(){var b=a(this);"none"==b.css("display")?v=v.add(b):w=w.add(b)}),i.origLayout!=i.layoutMode&&0==i.animateGridList)return"list"==i.layoutMode?(h.addClass(i.listClass),h.removeClass(i.gridClass),w.css("display",i.targetDisplayList)):(h.addClass(i.gridClass),h.removeClass(i.listClass),w.css("display",i.targetDisplayGrid)),j(),!1;if(!window.atob)return j(),!1;if(o.css(i.clean),w.each(function(){this.data.origPos=a(this).offset()}),"list"==i.layoutMode?(h.addClass(i.listClass),h.removeClass(i.gridClass),v.css("display",i.targetDisplayList)):(h.addClass(i.gridClass),h.removeClass(i.listClass),v.css("display",i.targetDisplayGrid)),v.each(function(){this.data.showInterPos=a(this).offset()}),u.each(function(){this.data.hideInterPos=a(this).offset()}),w.each(function(){this.data.preInterPos=a(this).offset()}),"list"==i.layoutMode?w.css("display",i.targetDisplayList):w.css("display",i.targetDisplayGrid),d&&c(d,g,h,i),d&&e(i.origSort,i.checkSort))return j(),!1;for(u.hide(),v.each(function(){this.data.finalPos=a(this).offset()}),w.each(function(){this.data.finalPrePos=a(this).offset()}),i.newHeight=p.height(),d&&c("reset",null,h,i),v.hide(),w.css("display",i.origDisplay),"block"==i.origDisplay?(h.addClass(i.listClass),v.css("display",i.targetDisplayList)):(h.removeClass(i.listClass),v.css("display",i.targetDisplayGrid)),i.resizeContainer&&p.css("height",i.origHeight+"px"),b={},k=0;2>k;k++)m=0==k?m=i.prefix:"",b[m+"transform"]=i.scale+" "+i.rotateX+" "+i.rotateY+" "+i.rotateZ,b[m+"filter"]=i.blur+" "+i.grayscale;v.css(b),w.each(function(){var b=this.data,c=a(this);c.hasClass("mix_tohide")?(b.preTX=b.origPos.left-b.hideInterPos.left,b.preTY=b.origPos.top-b.hideInterPos.top):(b.preTX=b.origPos.left-b.preInterPos.left,b.preTY=b.origPos.top-b.preInterPos.top);for(var d={},e=0;2>e;e++){var f=0==e?f=i.prefix:"";d[f+"transform"]="translate("+b.preTX+"px,"+b.preTY+"px)"}c.css(d)}),"list"==i.layoutMode?(h.addClass(i.listClass),h.removeClass(i.gridClass)):(h.addClass(i.gridClass),h.removeClass(i.listClass)),setTimeout(function(){if(i.resizeContainer){for(var b={},c=0;2>c;c++){var d=0==c?d=i.prefix:"";b[d+"transition"]="all "+l+"ms ease-in-out",b.height=i.newHeight+"px"}p.css(b)}for(u.css("opacity",i.fade),v.css("opacity",1),v.each(function(){var b=this.data;b.tX=b.finalPos.left-b.showInterPos.left,b.tY=b.finalPos.top-b.showInterPos.top;for(var c={},d=0;2>d;d++){var e=0==d?e=i.prefix:"";c[e+"transition-property"]=e+"transform, "+e+"filter, opacity",c[e+"transition-timing-function"]=i.easing+", linear, linear",c[e+"transition-duration"]=l+"ms",c[e+"transition-delay"]="0",c[e+"transform"]="translate("+b.tX+"px,"+b.tY+"px)",c[e+"filter"]="none"}a(this).css("-webkit-transition","all "+l+"ms "+i.easingFallback).css(c)}),w.each(function(){var b=this.data;b.tX=0!=b.finalPrePos.left?b.finalPrePos.left-b.preInterPos.left:0,b.tY=0!=b.finalPrePos.left?b.finalPrePos.top-b.preInterPos.top:0;for(var c={},d=0;2>d;d++){var e=0==d?e=i.prefix:"";c[e+"transition"]="all "+l+"ms "+i.easing,c[e+"transform"]="translate("+b.tX+"px,"+b.tY+"px)"}a(this).css("-webkit-transition","all "+l+"ms "+i.easingFallback).css(c)}),b={},c=0;2>c;c++)d=0==c?d=i.prefix:"",b[d+"transition"]="all "+l+"ms "+i.easing+", "+d+"filter "+l+"ms linear, opacity "+l+"ms linear",b[d+"transform"]=i.scale+" "+i.rotateX+" "+i.rotateY+" "+i.rotateZ,b[d+"filter"]=i.blur+" "+i.grayscale,b.opacity=i.fade;u.css(b),p.bind("webkitTransitionEnd transitionend otransitionend oTransitionEnd",function(b){(-1<b.originalEvent.propertyName.indexOf("transform")||-1<b.originalEvent.propertyName.indexOf("opacity"))&&(-1<n.indexOf(".")?a(b.target).hasClass(n.replace(".",""))&&j():a(b.target).is(n)&&j())})},10),i.failsafe=setTimeout(function(){i.mixing&&j()},l+400)}else{if(i.resizeContainer&&p.css("height",i.origHeight+"px"),!window.atob)return j(),!1;u=r,setTimeout(function(){if(p.css(i.perspective),i.resizeContainer){for(var a={},b=0;2>b;b++){var c=0==b?c=i.prefix:"";a[c+"transition"]="height "+l+"ms ease-in-out",a.height=i.minHeight+"px"}p.css(a)}if(o.css(i.transition),r.length){for(a={},b=0;2>b;b++)c=0==b?c=i.prefix:"",a[c+"transform"]=i.scale+" "+i.rotateX+" "+i.rotateY+" "+i.rotateZ,a[c+"filter"]=i.blur+" "+i.grayscale,a.opacity=i.fade;u.css(a),p.bind("webkitTransitionEnd transitionend otransitionend oTransitionEnd",function(a){(-1<a.originalEvent.propertyName.indexOf("transform")||-1<a.originalEvent.propertyName.indexOf("opacity"))&&(h.addClass(i.failClass),j())})}else i.mixing=!1},10)}}function c(b,c,d,e){function f(a,c){var d=isNaN(1*a.attr(b))?a.attr(b).toLowerCase():1*a.attr(b),e=isNaN(1*c.attr(b))?c.attr(b).toLowerCase():1*c.attr(b);return e>d?-1:d>e?1:0}function g(a){"asc"==c?i.prepend(a).prepend(" "):i.append(a).append(" ")}function h(a){a=a.slice();for(var b=a.length,c=b;c--;){var d=parseInt(Math.random()*b),e=a[c];a[c]=a[d],a[d]=e}return a}d.find(e.targetSelector).wrapAll('<div class="mix_sorter"/>');var i=d.find(".mix_sorter");if(e.origSort.length||i.find(e.targetSelector+":visible").each(function(){a(this).wrap("<s/>"),e.origSort.push(a(this).parent().html().replace(/\s+/g,"")),a(this).unwrap()}),i.empty(),"reset"==b)a.each(e.startOrder,function(){i.append(this).append(" ")});else if("default"==b)a.each(e.origOrder,function(){g(this)});else if("random"==b)e.newOrder.length||(e.newOrder=h(e.startOrder)),a.each(e.newOrder,function(){i.append(this).append(" ")});else if("custom"==b)a.each(c,function(){g(this)});else{if("undefined"==typeof e.origOrder[0].attr(b))return console.log("No such attribute found. Terminating"),!1;e.newOrder.length||(a.each(e.origOrder,function(){e.newOrder.push(a(this))}),e.newOrder.sort(f)),a.each(e.newOrder,function(){g(this)})}e.checkSort=[],i.find(e.targetSelector+":visible").each(function(b){var c=a(this);0==b&&c.attr("data-checksum","1"),c.wrap("<s/>"),e.checkSort.push(c.parent().html().replace(/\s+/g,"")),c.unwrap()}),d.find(e.targetSelector).unwrap()}function d(a){for(var b=["Webkit","Moz","O","ms"],c=0;c<b.length;c++)if(b[c]+"Transition"in a.style)return b[c];return"transition"in a.style?"":!1}function e(a,b){if(a.length!=b.length)return!1;for(var c=0;c<b.length;c++)if(a[c].compare&&!a[c].compare(b[c])||a[c]!==b[c])return!1;return!0}function f(b){b=b.replace(/\s{2,}/g," ");var c=b.split(" ");return a.each(c,function(a){"all"==this&&(c[a]="mix_all")}),""==c[0]&&c.shift(),c}var g={init:function(e){return this.each(function(){var f=window.navigator.appVersion.match(/Chrome\/(\d+)\./),f=f?parseInt(f[1],10):!1,g=function(a){a=document.getElementById(a);var b=a.parentElement,c=document.createElement("div"),d=document.createDocumentFragment();b.insertBefore(c,a),d.appendChild(a),b.replaceChild(a,c)};(f&&31==f||32==f)&&g(this.id);var h={targetSelector:".mix",filterSelector:".filter",sortSelector:".sort",buttonEvent:"click",effects:["fade","scale"],listEffects:null,easing:"smooth",layoutMode:"grid",targetDisplayGrid:"inline-block",targetDisplayList:"block",listClass:"",gridClass:"",transitionSpeed:600,showOnLoad:"all",sortOnLoad:!1,multiFilter:!1,filterLogic:"or",resizeContainer:!0,minHeight:0,failClass:"fail",perspectiveDistance:"3000",perspectiveOrigin:"50% 50%",animateGridList:!0,onMixLoad:null,onMixStart:null,onMixEnd:null,container:null,origOrder:[],startOrder:[],newOrder:[],origSort:[],checkSort:[],filter:"",mixing:!1,origDisplay:"",origLayout:"",origHeight:0,newHeight:0,isTouch:!1,resetDelay:0,failsafe:null,prefix:"",easingFallback:"ease-in-out",transition:{},perspective:{},clean:{},fade:"1",scale:"",rotateX:"",rotateY:"",rotateZ:"",blur:"",grayscale:""};e&&a.extend(h,e),this.config=h,a.support.touch="ontouchend"in document,a.support.touch&&(h.isTouch=!0,h.resetDelay=350),h.container=a(this);var i=h.container;if(h.prefix=d(i[0]),h.prefix=h.prefix?"-"+h.prefix.toLowerCase()+"-":"",i.find(h.targetSelector).each(function(){h.origOrder.push(a(this))}),h.sortOnLoad){var j;a.isArray(h.sortOnLoad)?(f=h.sortOnLoad[0],j=h.sortOnLoad[1],a(h.sortSelector+"[data-sort="+h.sortOnLoad[0]+"][data-order="+h.sortOnLoad[1]+"]").addClass("active")):(a(h.sortSelector+"[data-sort="+h.sortOnLoad+"]").addClass("active"),f=h.sortOnLoad,h.sortOnLoad="desc"),c(f,j,i,h)}for(j=0;2>j;j++)f=0==j?f=h.prefix:"",h.transition[f+"transition"]="all "+h.transitionSpeed+"ms ease-in-out",h.perspective[f+"perspective"]=h.perspectiveDistance+"px",h.perspective[f+"perspective-origin"]=h.perspectiveOrigin;for(j=0;2>j;j++)f=0==j?f=h.prefix:"",h.clean[f+"transition"]="none";"list"==h.layoutMode?(i.addClass(h.listClass),h.origDisplay=h.targetDisplayList):(i.addClass(h.gridClass),h.origDisplay=h.targetDisplayGrid),h.origLayout=h.layoutMode,j=h.showOnLoad.split(" "),a.each(j,function(){a(h.filterSelector+'[data-filter="'+this+'"]').addClass("active")}),i.find(h.targetSelector).addClass("mix_all"),"all"==j[0]&&(j[0]="mix_all",h.showOnLoad="mix_all");var k=a();a.each(j,function(){k=k.add(a("."+this))}),k.each(function(){var b=a(this);"list"==h.layoutMode?b.css("display",h.targetDisplayList):b.css("display",h.targetDisplayGrid),b.css(h.transition)}),setTimeout(function(){h.mixing=!0,k.css("opacity","1"),setTimeout(function(){if(k.removeStyle(h.prefix+"transition, transition").css("list"==h.layoutMode?{display:h.targetDisplayList,opacity:1}:{display:h.targetDisplayGrid,opacity:1}),h.mixing=!1,"function"==typeof h.onMixLoad){var a=h.onMixLoad.call(this,h);h=a?a:h}},h.transitionSpeed)},10),h.filter=h.showOnLoad,a(h.sortSelector).bind(h.buttonEvent,function(){if(!h.mixing){var c=a(this),d=c.attr("data-sort"),e=c.attr("data-order");if(c.hasClass("active")){if("random"!=d)return!1}else a(h.sortSelector).removeClass("active"),c.addClass("active");i.find(h.targetSelector).each(function(){h.startOrder.push(a(this))}),b(h.filter,d,e,i,h)}}),a(h.filterSelector).bind(h.buttonEvent,function(){if(!h.mixing){var c=a(this);if(0==h.multiFilter)a(h.filterSelector).removeClass("active"),c.addClass("active"),h.filter=c.attr("data-filter"),a(h.filterSelector+'[data-filter="'+h.filter+'"]').addClass("active");else{var d=c.attr("data-filter");c.hasClass("active")?(c.removeClass("active"),h.filter=h.filter.replace(RegExp("(\\s|^)"+d),"")):(c.addClass("active"),h.filter=h.filter+" "+d)}b(h.filter,null,null,i,h)}})})},toGrid:function(){return this.each(function(){var c=this.config;"grid"!=c.layoutMode&&(c.layoutMode="grid",b(c.filter,null,null,a(this),c))})},toList:function(){return this.each(function(){var c=this.config;"list"!=c.layoutMode&&(c.layoutMode="list",b(c.filter,null,null,a(this),c))})},filter:function(c){return this.each(function(){var d=this.config;d.mixing||(a(d.filterSelector).removeClass("active"),a(d.filterSelector+'[data-filter="'+c+'"]').addClass("active"),b(c,null,null,a(this),d))})},sort:function(c){return this.each(function(){var d=this.config,e=a(this);if(!d.mixing){if(a(d.sortSelector).removeClass("active"),a.isArray(c)){var f=c[0],g=c[1];a(d.sortSelector+'[data-sort="'+c[0]+'"][data-order="'+c[1]+'"]').addClass("active")}else a(d.sortSelector+'[data-sort="'+c+'"]').addClass("active"),f=c,g="desc";e.find(d.targetSelector).each(function(){d.startOrder.push(a(this))}),b(d.filter,f,g,e,d)}})},multimix:function(c){return this.each(function(){var d=this.config,e=a(this);multiOut={filter:d.filter,sort:null,order:"desc",layoutMode:d.layoutMode},a.extend(multiOut,c),d.mixing||(a(d.filterSelector).add(d.sortSelector).removeClass("active"),a(d.filterSelector+'[data-filter="'+multiOut.filter+'"]').addClass("active"),"undefined"!=typeof multiOut.sort&&(a(d.sortSelector+'[data-sort="'+multiOut.sort+'"][data-order="'+multiOut.order+'"]').addClass("active"),e.find(d.targetSelector).each(function(){d.startOrder.push(a(this))})),d.layoutMode=multiOut.layoutMode,b(multiOut.filter,multiOut.sort,multiOut.order,e,d))})},remix:function(c){return this.each(function(){var d=this.config,e=a(this);d.origOrder=[],e.find(d.targetSelector).each(function(){var b=a(this);b.addClass("mix_all"),d.origOrder.push(b)}),d.mixing||"undefined"==typeof c||(a(d.filterSelector).removeClass("active"),a(d.filterSelector+'[data-filter="'+c+'"]').addClass("active"),b(c,null,null,e,d))})}};a.fn.mixitup=function(a){return g[a]?g[a].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof a&&a?void 0:g.init.apply(this,arguments)},a.fn.removeStyle=function(b){return this.each(function(){var c=a(this);b=b.replace(/\s+/g,"");var d=b.split(",");a.each(d,function(){var a=RegExp(this.toString()+"[^;]+;?","g");c.attr("style",function(b,c){return c?c.replace(a,""):void 0})})})}}(jQuery);