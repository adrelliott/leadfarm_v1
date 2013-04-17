/*
 Input Mask plugin for jquery
 http://github.com/RobinHerbots/jquery.inputmask
 Copyright (c) 2010 - 2013 Robin Herbots
 Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
 Version: 2.2.1
*/
(function(e){void 0==e.fn.inputmask&&(e.inputmask={defaults:{placeholder:"_",optionalmarker:{start:"[",end:"]"},escapeChar:"\\",mask:null,oncomplete:e.noop,onincomplete:e.noop,oncleared:e.noop,repeat:0,greedy:!0,autoUnmask:!1,clearMaskOnLostFocus:!0,insertMode:!0,clearIncomplete:!1,aliases:{},onKeyUp:e.noop,onKeyDown:e.noop,showMaskOnFocus:!0,showMaskOnHover:!0,onKeyValidation:e.noop,skipOptionalPartCharacter:" ",numericInput:!1,radixPoint:"",rightAlignNumerics:!0,definitions:{9:{validator:"[0-9]",
cardinality:1},a:{validator:"[A-Za-z\u0410-\u044f\u0401\u0451]",cardinality:1},"*":{validator:"[A-Za-z\u0410-\u044f\u0401\u04510-9]",cardinality:1}},keyCode:{ALT:18,BACKSPACE:8,CAPS_LOCK:20,COMMA:188,COMMAND:91,COMMAND_LEFT:91,COMMAND_RIGHT:93,CONTROL:17,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,INSERT:45,LEFT:37,MENU:93,NUMPAD_ADD:107,NUMPAD_DECIMAL:110,NUMPAD_DIVIDE:111,NUMPAD_ENTER:108,NUMPAD_MULTIPLY:106,NUMPAD_SUBTRACT:109,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SHIFT:16,SPACE:32,
TAB:9,UP:38,WINDOWS:91},ignorables:[9,13,19,27,33,34,35,36,37,38,39,40,45,46,93,112,113,114,115,116,117,118,119,120,121,122,123],getMaskLength:function(e,B,Q){var N=e.length;!B&&1<Q&&(N+=e.length*(Q-1));return N}},val:e.fn.val,escapeRegex:function(e){return e.replace(RegExp("(\\/|\\.|\\*|\\+|\\?|\\||\\(|\\)|\\[|\\]|\\{|\\}|\\\\)","gim"),"\\$1")}},e.fn.inputmask=function(s,B){var Q,N;function J(b,c){var g=a.aliases[b];return g?(g.alias&&J(g.alias),e.extend(!0,a,g),e.extend(!0,a,c),!0):!1}function O(b){var c=
!1,g=0,r=a.greedy,j=a.repeat;1==b.length&&!1==r&&(a.placeholder="");for(var b=e.map(b.split(""),function(b){var e=[];if(b==a.escapeChar)c=true;else if(b!=a.optionalmarker.start&&b!=a.optionalmarker.end||c){var j=a.definitions[b];if(j&&!c)for(b=0;b<j.cardinality;b++)e.push(C(g+b));else{e.push(b);c=false}g=g+e.length;return e}}),G=b.slice(),f=1;f<j&&r;f++)G=G.concat(b.slice());return{mask:G,repeat:j,greedy:r}}function S(b){var c=!1,g=!1,r=!1;return e.map(b.split(""),function(b){var e=[];if(b==a.escapeChar)g=
!0;else if(b==a.optionalmarker.start&&!g)r=c=!0;else if(b==a.optionalmarker.end&&!g)c=!1,r=!0;else{var f=a.definitions[b];if(f&&!g){for(var m=f.prevalidator,i=m?m.length:0,n=1;n<f.cardinality;n++){var d=i>=n?m[n-1]:[],h=d.validator,d=d.cardinality;e.push({fn:h?"string"==typeof h?RegExp(h):new function(){this.test=h}:/./,cardinality:d?d:1,optionality:c,newBlockMarker:!0==c?r:!1,offset:0,casing:f.casing,def:b});!0==c&&(r=!1)}e.push({fn:f.validator?"string"==typeof f.validator?RegExp(f.validator):new function(){this.test=
f.validator}:/./,cardinality:f.cardinality,optionality:c,newBlockMarker:r,offset:0,casing:f.casing,def:b})}else e.push({fn:null,cardinality:0,optionality:c,newBlockMarker:r,offset:0,casing:null,def:b}),g=!1;r=!1;return e}})}function W(){function b(g,e){var j=e.split(a.optionalmarker.end,2),h,f,i=j[0].split(a.optionalmarker.start);1<i.length?(h=g+i[0]+(a.optionalmarker.start+i[1]+a.optionalmarker.end)+(1<j.length?j[1]:""),f=O(h),c.push({_buffer:f.mask,tests:S(h),lastValidPosition:void 0,greedy:f.greedy,
repeat:f.repeat}),h=g+i[0]+(1<j.length?j[1]:""),f=O(h),c.push({_buffer:f.mask,tests:S(h),lastValidPosition:void 0,greedy:f.greedy,repeat:f.repeat}),1<j.length&&1<j[1].split(a.optionalmarker.start).length&&(b(g+i[0]+(a.optionalmarker.start+i[1]+a.optionalmarker.end),j[1]),b(g+i[0],j[1]))):(h=g+j,f=O(h),c.push({_buffer:f.mask,tests:S(h),lastValidPosition:void 0,greedy:f.greedy,repeat:f.repeat}))}var c=[];e.isArray(a.mask)?e.each(a.mask,function(c,a){b("",a.toString())}):b("",a.mask.toString());return c}
function D(){return p[h].tests}function i(){return p[h]._buffer}function F(b,c,g,r,j){function i(b,d){for(var e=A(b),j=c?1:0,f="",h=d.tests[e].cardinality;h>j;h--)f+=z(g,e-(h-1));c&&(f+=c);return null!=d.tests[e].fn?d.tests[e].fn.test(f,g,b,r,a):!1}if(r)return i(b,p[h]);var f=[],m=!1,l=h;e.each(p,function(e){h=e;var d=b;if(l!=h&&!x(b)){if(c==this._buffer[d]||c==a.skipOptionalPartCharacter)return f[e]={refresh:!0},this.lastValidPosition=d,!1;d=j?L(g,b):w(g,b)}if((void 0==this.lastValidPosition||j||
a.numericInput?this.lastValidPosition<=a.numericInput?q(g):w(g,d):this.lastValidPosition>=L(g,d))&&0<=d&&d<q(g))f[e]=i(d,this),!1!==f[e]?(!0===f[e]&&(f[e]={pos:d}),this.lastValidPosition=f[e].pos||d):this.lastValidPosition=j?b==q(g)?void 0:w(g,b):0==b?void 0:L(g,b)});h=l;T(g,b,l,j);m=f[h]||m;setTimeout(function(){a.onKeyValidation.call(this,m,a)},0);return m}function T(b,c,g,r){e.each(p,function(e){if(this.lastValidPosition&&(r||a.numericInput)?this.lastValidPosition<=c:this.lastValidPosition>=c){h=
e;if(h!=g){var e=q(b),p=i();if(r||a.numericInput)b.reverse(),p.reverse();for(var f=b.length=c;f<e;f++){var m=A(f);H(b,f,z(p,m))}r&&b.reverse()}return!1}})}function x(b){b=A(b);b=D()[b];return void 0!=b?b.fn:!1}function A(b){return b%D().length}function C(b){return a.placeholder.charAt(b%a.placeholder.length)}function q(b){return a.getMaskLength(i(),p[h].greedy,p[h].repeat,b,a)}function w(b,c){var a=q(b);if(c>=a)return a;for(var e=c;++e<a&&!x(e););return e}function L(b,c){var a=c;if(0>=a)return 0;
for(;0<--a&&!x(a););return a}function H(b,c,a){var e=D()[A(c)],j=a;if(void 0!=j)switch(e.casing){case "upper":j=a.toUpperCase();break;case "lower":j=a.toLowerCase()}b[c]=j}function z(b,c,a){a&&(c=X(b,c));return b[c]}function X(b,c,a){if(a)for(;0>c&&b.length<q(b);){a=i().length-1;for(c=i().length;void 0!==i()[a];)b.unshift(i()[a--])}else for(;void 0==b[c]&&b.length<q(b);)for(a=0;void 0!==i()[a];)b.push(i()[a++]);return c}function E(b,a,e){b._valueSet(a.join(""));void 0!=e&&o(b,e)}function Y(b,a,e){for(var h=
q(b);a<e&&a<h;a++)H(b,a,z(i().slice(),a))}function P(b,a){var e=A(a);H(b,a,z(i(),e))}function y(b,c,g,r){var j=e(b).data("inputmask").isRTL,G=U(b._valueGet(),j).split(""),f=q(c);if(j){var m=G.reverse();m.length=f;for(var l=0;l<f;l++){var n=A(f-(l+1));null==D()[n].fn&&m[l]!=z(i(),n)?(m.splice(l,0,z(i(),n)),m.length=f):m[l]=m[l]||z(i(),n)}G=m.reverse()}Y(c,0,c.length);c.length=i().length;for(var d=m=-1,o,y=G.length,n=0==y?f:-1,l=0;l<y;l++)for(var t=d+1;t<f;t++)if(x(t)){var s=G[l];!1!==(o=F(t,s,c,!g,
j))?(!0!==o&&(t=void 0!=o.pos?o.pos:t,s=void 0!=o.c?o.c:s),H(c,t,s),m=d=t):(P(c,t),s==C(t)&&(n=d=t));break}else if(P(c,t),m==d&&(m=t),d=t,G[l]==z(c,t))break;if(!1==p[h].greedy)for(l=U(c.join(""),j).split("");c.length!=l.length;)j?c.shift():c.pop();g&&E(b,c);return j?a.numericInput?""!=a.radixPoint&&-1!=e.inArray(a.radixPoint,c)&&!0!==r?e.inArray(a.radixPoint,c):w(c,f):w(c,n):w(c,m)}function aa(b){return e.inputmask.escapeRegex.call(this,b)}function U(b,a){return a?b.replace(RegExp("^("+aa(i().join(""))+
")*"),""):b.replace(RegExp("("+aa(i().join(""))+")*$"),"")}function Z(b,a){y(b,a,!1);var g=a.slice(),h,j;if(e(b).data("inputmask").isRTL)for(j=0;j<=g.length-1;j++)if(h=A(j),D()[h].optionality)if(!x(j)||!F(j,a[j],a,!0))g.splice(0,1);else break;else break;else for(j=g.length-1;0<=j;j--)if(h=A(j),D()[h].optionality)if(!x(j)||!F(j,a[j],a,!0))g.pop();else break;else break;E(b,g)}function ba(a,c){var g=a[0];if(D()&&(!0===c||!a.hasClass("hasDatepicker"))){var h=i().slice();y(g,h);return e.map(h,function(a,
b){return x(b)&&F(b,a,h,!0)?a:null}).join("")}return g._valueGet()}function o(b,c,g){var h=b.jquery&&0<b.length?b[0]:b;if("number"==typeof c)e(b).is(":visible")&&(g="number"==typeof g?g:c,!1==a.insertMode&&c==g&&g++,h.setSelectionRange?V?(setTimeout(function(){h.selectionStart=c;h.selectionEnd=V?c:g},10),Q=c,N=g):(h.selectionStart=c,h.selectionEnd=g):h.createTextRange&&(range=h.createTextRange(),range.collapse(!0),range.moveEnd("character",g),range.moveStart("character",c),range.select()));else{if(!e(b).is(":visible"))return{begin:0,
end:0};h.setSelectionRange?(c=h.selectionStart,g=h.selectionEnd):document.selection&&document.selection.createRange&&(range=document.selection.createRange(),c=0-range.duplicate().moveStart("character",-1E5),g=c+range.text.length);return{begin:c,end:g}}}function R(a){var c=!1,g=0,o=h;e.each(p,function(e,o){h=e;var f=q(a);if(o.lastValidPosition&&o.lastValidPosition>=g&&o.lastValidPosition==f-1){for(var p=!0,l=0;l<f;l++){var n=x(l);if(n&&a[l]==C(l)||!n&&a[l]!=i()[l]){p=!1;break}}if(c=c||p)return!1}g=
o.lastValidPosition});h=o;return c}function $(b){function c(a){a=e._data(a).events;e.each(a,function(a,b){e.each(b,function(a,b){if("inputmask"==b.namespace){var d=b.handler;b.handler=function(){return this.readOnly||this.disabled?!1:d.apply(this,arguments)}}})})}function g(a){var b;Object.getOwnPropertyDescriptor&&(b=Object.getOwnPropertyDescriptor(a,"value"));if(b&&b.get)a._valueGet||(a._valueGet=b.get,a._valueSet=b.set,Object.defineProperty(a,"value",{get:function(){var a=e(this),b=e(this).data("inputmask"),
d=b.masksets,c=b.activeMasksetIndex;return b&&b.autoUnmask?a.inputmask("unmaskedvalue"):this._valueGet()!=d[c]._buffer.join("")?this._valueGet():""},set:function(a){this._valueSet(a);e(this).triggerHandler("setvalue.inputmask")}}));else if(document.__lookupGetter__&&a.__lookupGetter__("value"))a._valueGet||(a._valueGet=a.__lookupGetter__("value"),a._valueSet=a.__lookupSetter__("value"),a.__defineGetter__("value",function(){var a=e(this),b=e(this).data("inputmask"),d=b.masksets,c=b.activeMasksetIndex;
return b&&b.autoUnmask?a.inputmask("unmaskedvalue"):this._valueGet()!=d[c]._buffer.join("")?this._valueGet():""}),a.__defineSetter__("value",function(a){this._valueSet(a);e(this).triggerHandler("setvalue.inputmask")}));else if(a._valueGet||(a._valueGet=function(){return this.value},a._valueSet=function(a){this.value=a}),!0!=e.fn.val.inputmaskpatch)e.fn.val=function(){if(arguments.length==0){var a=e(this);if(a.data("inputmask")){if(a.data("inputmask").autoUnmask)return a.inputmask("unmaskedvalue");
var a=e.inputmask.val.apply(a),b=e(this).data("inputmask");return a!=b.masksets[b.activeMasksetIndex]._buffer.join("")?a:""}return e.inputmask.val.apply(a)}var d=arguments;return this.each(function(){var a=e(this),b=e.inputmask.val.apply(a,d);a.data("inputmask")&&a.triggerHandler("setvalue.inputmask");return b})},e.extend(e.fn.val,{inputmaskpatch:!0})}function r(b,d){if(a.numericInput&&""!=a.radixPoint){var e=b._valueGet().indexOf(a.radixPoint);u=d.begin<=e||d.end<=e||-1==e}}function j(a,b,e){for(;!x(a)&&
0<=a-1;)a--;for(var c=a;c<b&&c<q(d);c++)if(x(c)){P(d,c);var h=w(d,c),g=z(d,h);if(g!=C(h))if(h<q(d)&&!1!==F(c,g,d,!0,u)&&D()[A(c)].def==D()[A(h)].def)H(d,c,z(d,h)),P(d,h);else{if(x(c))break}else if(void 0==e)break}else P(d,c);void 0!=e&&H(d,u?b:L(d,b),e);d=U(d.join(""),u).split("");0==d.length&&(d=i().slice());return a}function s(a,b,c,e){for(;a<=b&&a<q(d);a++)if(x(a)){var h=z(d,a);H(d,a,c);if(h!=C(a))if(c=w(d,a),c<q(d))if(!1!==F(c,h,d,!0,u)&&D()[A(a)].def==D()[A(c)].def)c=h;else if(x(c))break;else c=
h;else break;else if(!0!==e)break}else P(d,a);e=d.length;d=U(d.join(""),u).split("");0==d.length&&(d=i().slice());return b-(e-d.length)}function f(b){t=!1;var c=this,g=b.keyCode,f=o(c);r(c,f);if(g==a.keyCode.BACKSPACE||g==a.keyCode.DELETE||da&&127==g){var v=q(d);if(0==f.begin&&f.end==v)h=0,d=i().slice(),E(c,d),o(c,y(c,d,!1));else if(1<f.end-f.begin||1==f.end-f.begin&&a.insertMode)Y(d,f.begin,f.end),T(d,f.begin,h),E(c,d,u?y(c,d,!1):f.begin);else{var k=ca?f.end:f.begin;g==a.keyCode.DELETE?(k<I&&(k=
I),k<v&&(a.numericInput&&""!=a.radixPoint&&d[k]==a.radixPoint?(k=d.length-1==k?k:w(d,k),k=j(k,v)):u?(k=s(I,k,C(k),!0),k=w(d,k)):k=j(k,v),T(d,k,h),E(c,d,k))):g==a.keyCode.BACKSPACE&&k>I&&(k-=1,a.numericInput&&""!=a.radixPoint&&d[k]==a.radixPoint?(k=s(I,d.length-1==k?k:k-1,C(k),!0),k++):u?(k=s(I,k,C(k),!0),k=d[k+1]==a.radixPoint?k+1:w(d,k)):k=j(k,v),T(d,k,h),E(c,d,k))}c._valueGet()==i().join("")&&e(c).trigger("cleared");b.preventDefault()}else g==a.keyCode.END||g==a.keyCode.PAGE_DOWN?setTimeout(function(){var e=
y(c,d,!1,!0);!a.insertMode&&(e==q(d)&&!b.shiftKey)&&e--;o(c,b.shiftKey?f.begin:e,e)},0):g==a.keyCode.HOME&&!b.shiftKey||g==a.keyCode.PAGE_UP?o(c,0,b.shiftKey?f.begin:0):g==a.keyCode.ESCAPE?(c._valueSet(B),o(c,0,y(c,d))):g==a.keyCode.INSERT?(a.insertMode=!a.insertMode,o(c,!a.insertMode&&f.begin==q(d)?f.begin-1:f.begin)):b.ctrlKey&&88==g?setTimeout(function(){o(c,y(c,d,!0))},0):a.insertMode||(g==a.keyCode.RIGHT?(v=f.begin==f.end?f.end+1:f.end,v=v<q(d)?v:f.end,o(c,b.shiftKey?f.begin:v,b.shiftKey?v+1:
v)):g==a.keyCode.LEFT&&(v=f.begin-1,v=0<v?v:0,o(c,v,b.shiftKey?f.end:v)));a.onKeyDown.call(this,b,d,a);J=-1!=e.inArray(g,a.ignorables)}function m(b){if(t)return!1;t=!0;var c=e(this),b=b||window.event,g=b.which||b.charCode||b.keyCode,f=String.fromCharCode(g);if(a.numericInput&&f==a.radixPoint){var i=this._valueGet().indexOf(a.radixPoint);o(this,w(d,-1!=i?i:q(d)))}if(b.metaKey||J)return!0;if(g){var k=o(this),n=q(d),g=!0;Y(d,k.begin,k.end);if(u){var i=L(d,k.end),l;if(!1!==(l=F(i==n||z(d,i)==a.radixPoint?
L(d,i):i,f,d,!1,u))){var m=!1;!0!==l&&(m=l.refresh,i=void 0!=l.pos?l.pos:i,f=void 0!=l.c?l.c:f);if(!0!==m)if(n=q(d),l=I,!0==a.insertMode){if(!0==p[h].greedy)for(m=d.slice();z(m,l,!0)!=C(l)&&l<=i;)l=l==n?n+1:w(d,l);l<=i&&(p[h].greedy||d.length<n)?(d[I]!=C(I)&&d.length<n&&(m=X(d,-1,u),0!=k.end&&(i+=m),n=d.length),j(l,i,f)):g=!1}else H(d,i,f);g&&(E(this,d,a.numericInput?i+1:i),setTimeout(function(){R(d)&&c.trigger("complete")},0))}}else if(i=w(d,k.begin-1),X(d,i,u),!1!==(l=F(i,f,d,!1,u))){m=!1;!0!==
l&&(m=l.refresh,i=void 0!=l.pos?l.pos:i,f=void 0!=l.c?l.c:f);if(!0!==m)if(!0==a.insertMode){k=q(d);for(m=d.slice();z(m,k,!0)!=C(k)&&k>=i;)k=0==k?-1:L(d,k);k>=i?s(i,d.length,f):g=!1}else H(d,i,f);g&&(f=w(d,i),E(this,d,f),setTimeout(function(){R(d)&&c.trigger("complete")},0))}V&&o(this,Q,N);b.preventDefault()}}function l(b){var c=e(this),g=b.keyCode;a.onKeyUp.call(this,b,d,a);g==a.keyCode.TAB&&(c.hasClass("focus.inputmask")&&0==this._valueGet().length&&a.showMaskOnFocus)&&(d=i().slice(),E(this,d),u||
o(this,0),B=this._valueGet())}var n=e(b);if(n.is(":input")){var d=i().slice();p[h].greedy=p[h].greedy?p[h].greedy:0==p[h].repeat;var K=n.prop("maxLength");q(d)>K&&-1<K&&(K<i().length&&(i().length=K),!1==p[h].greedy&&(p[h].repeat=Math.round(K/i().length)),n.prop("maxLength",2*q(d)));n.data("inputmask",{masksets:p,activeMasksetIndex:h,autoUnmask:a.autoUnmask,definitions:a.definitions,isRTL:!1});g(b);var d=i().slice(),B=b._valueGet(),t=!1,J=!1,M=-1,I=w(d,-1);L(d,q(d));var u=!1;if("rtl"==b.dir||a.numericInput)("rtl"==
b.dir||a.numericInput&&a.rightAlignNumerics)&&n.css("text-align","right"),b.dir="ltr",n.removeAttr("dir"),K=n.data("inputmask"),K.isRTL=!0,n.data("inputmask",K),u=!0;n.unbind(".inputmask");n.removeClass("focus.inputmask");n.bind("mouseenter.inputmask",function(){if(!e(this).hasClass("focus.inputmask")&&a.showMaskOnHover){var b=this._valueGet().length;if(b<d.length){b==0&&(d=i().slice());E(this,d)}}}).bind("blur.inputmask",function(){var b=e(this),c=this._valueGet();b.removeClass("focus.inputmask");
c!=B&&b.change();a.clearMaskOnLostFocus&&c!=""&&(c==i().join("")?this._valueSet(""):Z(this,d));if(!R(d)){b.trigger("incomplete");if(a.clearIncomplete)if(a.clearMaskOnLostFocus)this._valueSet("");else{d=i().slice();E(this,d)}}}).bind("focus.inputmask",function(){var b=e(this),c=this._valueGet();if(a.showMaskOnFocus&&!b.hasClass("focus.inputmask")&&(!a.showMaskOnHover||a.showMaskOnHover&&c=="")){c=c.length;if(c<d.length){c==0&&(d=i().slice());o(this,y(this,d,true))}}b.addClass("focus.inputmask");B=
this._valueGet()}).bind("mouseleave.inputmask",function(){var b=e(this);a.clearMaskOnLostFocus&&(b.hasClass("focus.inputmask")||(this._valueGet()==i().join("")||this._valueGet()==""?this._valueSet(""):Z(this,d)))}).bind("click.inputmask",function(){var a=this;setTimeout(function(){var b=o(a);if(b.begin==b.end){var c=b.begin;M=y(a,d,false);r(a,b);u?o(a,c>M&&(F(c,d[c],d,true,u)!==false||!x(c))?c:M):o(a,c<M&&(F(c,d[c],d,true,u)!==false||!x(c))?c:M)}},0)}).bind("dblclick.inputmask",function(){var a=this;
setTimeout(function(){o(a,0,M)},0)}).bind("keydown.inputmask",f).bind("keypress.inputmask",m).bind("keyup.inputmask",l).bind(ea+".inputmask dragdrop.inputmask drop.inputmask",function(){var a=this;setTimeout(function(){o(a,y(a,d,true));R(d)&&n.trigger("complete")},0)}).bind("setvalue.inputmask",function(){B=this._valueGet();y(this,d,true);this._valueGet()==i().join("")&&this._valueSet("")}).bind("complete.inputmask",a.oncomplete).bind("incomplete.inputmask",a.onincomplete).bind("cleared.inputmask",
a.oncleared);var M=y(b,d,!0),O;try{O=document.activeElement}catch(S){}O===b?(n.addClass("focus.inputmask"),o(b,M)):a.clearMaskOnLostFocus&&(b._valueGet()==i().join("")?b._valueSet(""):Z(b,d));c(b)}}var a=e.extend(!0,{},e.inputmask.defaults,B),ea=function(a){var c=document.createElement("input"),a="on"+a,e=a in c;e||(c.setAttribute(a,"return;"),e="function"==typeof c[a]);return e}("paste")?"paste":"input",da=null!=navigator.userAgent.match(/iphone/i),V=null!=navigator.userAgent.match(/android.*safari.*/i),
ca;if(V){var fa=navigator.userAgent.match(/safari.*/i);ca=533>=parseInt(RegExp(/[0-9]+/).exec(fa))}var p,h=0;if("string"==typeof s)switch(s){case "mask":return J(a.alias,B),p=W(),this.each(function(){$(this)});case "unmaskedvalue":return p=this.data("inputmask").masksets,h=this.data("inputmask").activeMasksetIndex,a.definitions=this.data("inputmask").definitions,ba(this);case "remove":return this.each(function(){var b=e(this),c=this;setTimeout(function(){if(b.data("inputmask")){p=b.data("inputmask").masksets;
h=b.data("inputmask").activeMasksetIndex;a.definitions=b.data("inputmask").definitions;c._valueSet(ba(b,!0));b.removeData("inputmask");b.unbind(".inputmask");b.removeClass("focus.inputmask");var e;Object.getOwnPropertyDescriptor&&(e=Object.getOwnPropertyDescriptor(c,"value"));e&&e.get?c._valueGet&&Object.defineProperty(c,"value",{get:c._valueGet,set:c._valueSet}):document.__lookupGetter__&&c.__lookupGetter__("value")&&c._valueGet&&(c.__defineGetter__("value",c._valueGet),c.__defineSetter__("value",
c._valueSet));delete c._valueGet;delete c._valueSet}},0)});case "getemptymask":return this.data("inputmask")?(p=this.data("inputmask").masksets,h=this.data("inputmask").activeMasksetIndex,p[h]._buffer.join("")):"";case "hasMaskedValue":return this.data("inputmask")?!this.data("inputmask").autoUnmask:!1;case "isComplete":return p=this.data("inputmask").masksets,h=this.data("inputmask").activeMasksetIndex,a.definitions=this.data("inputmask").definitions,R(this[0].split(""));default:return J(s,B)||(a.mask=
s),p=W(),this.each(function(){$(this)})}else{if("object"==typeof s)return a=e.extend(!0,{},e.inputmask.defaults,s),J(a.alias,s),p=W(),this.each(function(){$(this)});if(void 0==s)return this.each(function(){var b=e(this).attr("data-inputmask");if(b&&""!=b)try{var b=b.replace(RegExp("'","g"),'"'),c=e.parseJSON("{"+b+"}");a=e.extend(!0,{},e.inputmask.defaults,c);J(a.alias,c);a.alias=void 0;e(this).inputmask(a)}catch(g){}})}return this})})(jQuery);