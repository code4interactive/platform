function showRequest(t,e,i){return $(".error").removeClass("error"),$(".field-error").remove(),$(".messageBox").empty(),$('button[type="submit"], input[type="submit"]').attr("disabled",!0),$(".processingIndicator").css("display","block"),!0}function showResponse(responseText,statusText,xhr,$form){$(".processingIndicator").css("display","none"),$('button[type="submit"], input[type="submit"]').attr("disabled",!1),"undefined"!=typeof responseText.status&&"success"===responseText.status&&("undefined"!=typeof responseText.redirect&&($(".redirectOverlay").css("display","block"),window.location.replace(responseText.redirect)),"undefined"!=typeof responseText.eval&&eval("("+responseText.eval+")"))}function showFieldErrors(t,e){return $(".processingIndicator").css("display","none"),$('button[type="submit"], input[type="submit"]').attr("disabled",!1),"string"==typeof e&&(e=jQuery.parseJSON(e)),"object"!=typeof e?(console.log("form.js: Errors are not in object form"),!1):(jQuery.each(e,function(e,i){var o="";if("messageBox"===e){for(var n=$(document.createElement("div")).addClass("alert alert-danger"),s=0;s<i.length;s++)n.append("<p>"+i[s]+"</p>");t.find(".messageBox").html(n)}else if("popup"===e);else{for(var r=0;r<i.length;r++)o+='<label id="'+e+'-error" class="error field-error" for="'+e+'">'+i[r]+"</label>";t.find("#form-"+e).addClass("error").parent().append(o)}}),!0)}function showErrors(t,e,i,o){return toastr.error("W przesłanym formularzu są błędy","Błąd formularza"),showFieldErrors(o,t.responseText)}function ajaxSuccess(){}!function(t){t.fn.gritter=t.gritter={},t.fn.gritter.options=t.gritter.options={position:"",addPosition:"bottom",class_name:"",fade_in_speed:"medium",fade_out_speed:1e3,time:6e3},t.fn.gritter.add=t.gritter.add=function(t){try{return e.add(t||{})}catch(i){var o="Gritter Error: "+i;"undefined"!=typeof console&&console.error?console.error(o,t):alert(o)}},t.fn.gritter.remove=t.gritter.remove=function(t,i){e.removeSpecific(t,i||{})},t.fn.gritter.removeAll=t.gritter.removeAll=function(t){e.stop(t||{})};var e={position:"",addPosition:"",fade_in_speed:"",fade_out_speed:"",time:"",_custom_timer:0,_item_count:0,_is_setup:0,_tpl_close:'<div class="gritter-close"></div>',_tpl_title:'<span class="gritter-title">[[title]]</span>',_tpl_item:'<div id="gritter-item-[[number]]" class="gritter-item-wrapper [[item_class]]" style="display:none"><div class="gritter-top"></div><div class="gritter-item">[[close]][[image]]<div class="[[class_name]]">[[title]]<p>[[text]]</p></div><div style="clear:both"></div></div><div class="gritter-bottom"></div></div>',_tpl_wrap:'<div id="gritter-notice-wrapper"></div>',add:function(i){if("string"==typeof i&&(i={text:i}),null===i.text)throw'You must supply "text" parameter.';this._is_setup||this._runSetup();var o=i.title,n=i.text,s=i.image||"",r=i.sticky||!1,a=i.hover_state||!0,l=i.class_name||t.gritter.options.class_name,d=t.gritter.options.position,c=i.close_icon||this._tpl_close,u=i.time||"";this._verifyWrapper(),this._item_count++;var p=this._item_count,h=this._tpl_item;t(["before_open","after_open","before_close","after_close"]).each(function(o,n){e["_"+n+"_"+p]=t.isFunction(i[n])?i[n]:function(){}}),this._custom_timer=0,u&&(this._custom_timer=u);var f=""!==s?'<img src="'+s+'" class="gritter-image" />':"",m=""!==s?"gritter-with-image":"gritter-without-image";if(o=o?this._str_replace("[[title]]",o,this._tpl_title):"",h=this._str_replace(["[[title]]","[[text]]","[[close]]","[[image]]","[[number]]","[[class_name]]","[[item_class]]"],[o,n,c,f,this._item_count,m,l],h),this["_before_open_"+p]()===!1)return!1;"top"===this.addPosition?t("#gritter-notice-wrapper").addClass(d).prepend(h):t("#gritter-notice-wrapper").addClass(d).append(h);var _=t("#gritter-item-"+this._item_count);return _.fadeIn(this.fade_in_speed,function(){e["_after_open_"+p](t(this))}),r||this._setFadeTimer(_,p),t(_).bind("mouseenter mouseleave",function(i){"mouseenter"===i.type?r||e._restoreItemIfFading(t(this),p):r||e._setFadeTimer(t(this),p),"no"!==a&&e._hoverState(t(this),i.type)}),t(_).find(".gritter-close").click(function(){e.removeSpecific(p,{},null,!0)}),p},_countRemoveWrapper:function(e,i,o){i.remove(),this["_after_close_"+e](i,o),0===t(".gritter-item-wrapper").length&&t("#gritter-notice-wrapper").remove()},_fade:function(t,i,o,n){var o=o||{},s="undefined"!=typeof o.fade?o.fade:!0,r=o.speed||this.fade_out_speed,a=n;this["_before_close_"+i](t,a),n&&t.unbind("mouseenter mouseleave"),s?t.animate({opacity:0},r,function(){t.animate({height:0},300,function(){e._countRemoveWrapper(i,t,a)})}):this._countRemoveWrapper(i,t)},_hoverState:function(t,e){"mouseenter"==e?(t.addClass("hover"),t.find(".gritter-close").show()):(t.removeClass("hover"),t.find(".gritter-close").hide())},removeSpecific:function(e,i,o,n){if(!o)var o=t("#gritter-item-"+e);this._fade(o,e,i||{},n)},_restoreItemIfFading:function(t,e){clearTimeout(this["_int_id_"+e]),t.stop().css({opacity:"",height:""})},_runSetup:function(){for(opt in t.gritter.options)this[opt]=t.gritter.options[opt];this._is_setup=1},_setFadeTimer:function(t,i){var o=this._custom_timer?this._custom_timer:this.time;this["_int_id_"+i]=setTimeout(function(){e._fade(t,i)},o)},stop:function(e){var i=t.isFunction(e.before_close)?e.before_close:function(){},o=t.isFunction(e.after_close)?e.after_close:function(){},n=t("#gritter-notice-wrapper");i(n),n.fadeOut(function(){t(this).remove(),o()})},_str_replace:function(t,e,i,o){var n=0,s=0,r="",a="",l=0,d=0,c=[].concat(t),u=[].concat(e),p=i,h=u instanceof Array,f=p instanceof Array;for(p=[].concat(p),o&&(this.window[o]=0),n=0,l=p.length;l>n;n++)if(""!==p[n])for(s=0,d=c.length;d>s;s++)r=p[n]+"",a=h?void 0!==u[s]?u[s]:"":u[0],p[n]=r.split(c[s]).join(a),o&&p[n]!==r&&(this.window[o]+=(r.length-p[n].length)/c[s].length);return f?p:p[0]},_verifyWrapper:function(){0==t("#gritter-notice-wrapper").length&&t("body").append(this._tpl_wrap)}}}(jQuery),function(t){"use strict";function e(){var t=document.createElement("mm"),e={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var i in e)if(void 0!==t.style[i])return{end:e[i]};return!1}function i(e){return this.each(function(){var i=t(this),o=i.data("mm"),s=t.extend({},n.DEFAULTS,i.data(),"object"==typeof e&&e);o||i.data("mm",o=new n(this,s)),"string"==typeof e&&o[e]()})}t.fn.emulateTransitionEnd=function(e){var i=!1,n=this;t(this).one("mmTransitionEnd",function(){i=!0});var s=function(){i||t(n).trigger(o.end)};return setTimeout(s,e),this};var o=e();o&&(t.event.special.mmTransitionEnd={bindType:o.end,delegateType:o.end,handle:function(e){return t(e.target).is(this)?e.handleObj.handler.apply(this,arguments):void 0}});var n=function(e,i){this.$element=t(e),this.options=t.extend({},n.DEFAULTS,i),this.transitioning=null,this.init()};n.TRANSITION_DURATION=350,n.DEFAULTS={toggle:!0,doubleTapToGo:!1,activeClass:"active",collapseClass:"collapse",collapseInClass:"in",collapsingClass:"collapsing"},n.prototype.init=function(){var e=this,i=this.options.activeClass,o=this.options.collapseClass,n=this.options.collapseInClass;this.$element.find("li."+i).has("ul").children("ul").attr("aria-expanded",!0).addClass(o+" "+n),this.$element.find("li").not("."+i).has("ul").children("ul").attr("aria-expanded",!1).addClass(o),this.options.doubleTapToGo&&this.$element.find("li."+i).has("ul").children("a").addClass("doubleTapToGo"),this.$element.find("li").has("ul").children("a").on("click.metisMenu",function(o){var n=t(this),s=n.parent("li"),r=s.children("ul");return o.preventDefault(),s.hasClass(i)&&!e.options.doubleTapToGo?(e.hide(r),n.attr("aria-expanded",!1)):(e.show(r),n.attr("aria-expanded",!0)),e.options.doubleTapToGo&&e.doubleTapToGo(n)&&"#"!==n.attr("href")&&""!==n.attr("href")?(o.stopPropagation(),void(document.location=n.attr("href"))):void 0})},n.prototype.doubleTapToGo=function(t){var e=this.$element;return t.hasClass("doubleTapToGo")?(t.removeClass("doubleTapToGo"),!0):t.parent().children("ul").length?(e.find(".doubleTapToGo").removeClass("doubleTapToGo"),t.addClass("doubleTapToGo"),!1):void 0},n.prototype.show=function(e){var i=this.options.activeClass,s=this.options.collapseClass,r=this.options.collapseInClass,a=this.options.collapsingClass,l=t(e),d=l.parent("li");if(!this.transitioning&&!l.hasClass(r)){d.addClass(i),this.options.toggle&&this.hide(d.siblings().children("ul."+r).attr("aria-expanded",!1)),l.removeClass(s).addClass(a).height(0),this.transitioning=1;var c=function(){l.removeClass(a).addClass(s+" "+r).height("").attr("aria-expanded",!0),this.transitioning=0};return o?void l.one("mmTransitionEnd",t.proxy(c,this)).emulateTransitionEnd(n.TRANSITION_DURATION).height(l[0].scrollHeight):c.call(this)}},n.prototype.hide=function(e){var i=this.options.activeClass,s=this.options.collapseClass,r=this.options.collapseInClass,a=this.options.collapsingClass,l=t(e);if(!this.transitioning&&l.hasClass(r)){l.parent("li").removeClass(i),l.height(l.height())[0].offsetHeight,l.addClass(a).removeClass(s).removeClass(r),this.transitioning=1;var d=function(){this.transitioning=0,l.removeClass(a).addClass(s).attr("aria-expanded",!1)};return o?void l.height(0).one("mmTransitionEnd",t.proxy(d,this)).emulateTransitionEnd(n.TRANSITION_DURATION):d.call(this)}};var s=t.fn.metisMenu;t.fn.metisMenu=i,t.fn.metisMenu.Constructor=n,t.fn.metisMenu.noConflict=function(){return t.fn.metisMenu=s,this}}(jQuery),$(document).ready(function(){$(document.body).on("click",'form.ajax button[type="submit"], form.ajax input[type="submit"]',function(){var t={beforeSubmit:showRequest,success:showResponse,error:showErrors,type:"post",dataType:"json"};$("form.ajax").ajaxForm(t)}),$(document.body).on("click",".confirmDelete",function(t){var e='Czy napewno usunąć "'+$(this).data("name")+'"?';return confirm(e)})}),$(document).ready(function(){$(document.body).on("click",".loadInModal",function(t){t.preventDefault();var e=$(this).attr("href");return $.ajax({url:e,method:"get",success:function(t){$id=$(t).find(".modal").attr("id"),$(t).modal("show")},error:function(t){}}),!1}),$(document.body).on("click","[data-modal]",function(t){t.preventDefault();var e;return""!==$(this).attr("data-modal")?e=$(this).attr("data-modal"):""!==$(this).attr("href")&&(e=$(this).attr("href")),""===e?void console.log("No target/url for modal"):"#"===e.substr(0,1)||"."===e.substr(0,1)?void $(e).modal("show"):($.ajax({url:e,method:"get",success:function(t){$(t).modal("show")},error:function(t){}}),!1)}),$(document.body).on("click",".editModal",function(t){t.preventDefault();var e=$(this).attr("href");return $.ajax({url:e,method:"get",success:function(t){$id=$(t).find(".modal").attr("id"),$(t).modal("show")},error:function(t){}}),!1})});var slug=function(t){t=t.replace(/^\s+|\s+$/g,""),t=t.toLowerCase();for(var e="ąãàáäâęẽèéëêìíïîõòóöôùúüûñńçćśłżź·/_,:;",i="aaaaaaeeeeeeiiiiooooouuuunnccslzz------",o=0,n=e.length;n>o;o++)t=t.replace(new RegExp(e.charAt(o),"g"),i.charAt(o));return t=t.replace(/[^a-z0-9 -]/g,"").replace(/\s+/g,"-").replace(/-+/g,"-")};$(document).ready(function(){$("#top-search").on("focusin",function(){$(this).val().length>2&&$(".search-dropdown").show()}),$("body").not(".search-dropdown, #top-search").on("click",function(t){$(".search-dropdown").hide()})});
//# sourceMappingURL=main.js.map
