(function(e,t){if(window.layui&&layui.define){layui.define(function(e){e("pdfobject",t())})}else if(typeof define==="function"&&define.amd){define([],t)}else if(typeof module==="object"&&module.exports){module.exports=t()}else{e.PDFObject=t()}})(this,function(){"use strict";if(typeof window==="undefined"||typeof navigator==="undefined"){return false}var e="2.0.201604172",m,t,n,o=typeof navigator.mimeTypes["application/pdf"]!=="undefined",i,b,r,g,f,h,w,a=function(){return/iphone|ipad|ipod/i.test(navigator.userAgent.toLowerCase())}(),v;t=function(e){var t;try{t=new ActiveXObject(e)}catch(e){t=null}return t};n=function(){return!!(window.ActiveXObject||"ActiveXObject"in window)};i=function(){return!!(t("AcroPDF.PDF")||t("PDF.PdfCtrl"))};m=o||n()&&i();b=function(e){var t="",n;if(e){for(n in e){if(e.hasOwnProperty(n)){t+=encodeURIComponent(n)+"="+encodeURIComponent(e[n])+"&"}}if(t){t="#"+t;t=t.slice(0,t.length-1)}}return t};r=function(e){if(typeof console!=="undefined"&&console.log){console.log("[PDFObject] "+e)}};g=function(e){r(e);return false};h=function(e){var t=document.body;if(typeof e==="string"){t=document.querySelector(e)}else if(typeof jQuery!=="undefined"&&e instanceof jQuery&&e.length){t=e.get(0)}else if(typeof e.nodeType!=="undefined"&&e.nodeType===1){t=e}return t};w=function(e,t,n,o,i){var r=o+"?file="+encodeURIComponent(t)+n;var f=a?"-webkit-overflow-scrolling: touch; overflow-y: scroll; ":"overflow: hidden; ";var d="<div style='"+f+"position: absolute; top: 0; right: 0; bottom: 0; left: 0;'><iframe  "+i+" src='"+r+"' style='border: none; width: 100%; height: 100%;' frameborder='0'></iframe></div>";e.className+=" pdfobject-container";e.style.position="relative";e.style.overflow="auto";e.innerHTML=d;return e.getElementsByTagName("iframe")[0]};v=function(e,t,n,o,i,r,f){var d="";if(t&&t!==document.body){d="width: "+i+"; height: "+r+";"}else{d="position: absolute; top: 0; right: 0; bottom: 0; left: 0; width: 100%; height: 100%;"}e.className+=" pdfobject-container";e.innerHTML="<embed "+f+" class='pdfobject' src='"+n+o+"' type='application/pdf' style='overflow: auto; "+d+"'/>";return e.getElementsByTagName("embed")[0]};f=function(e,t,n){if(typeof e!=="string"){return g("URL is not valid")}t=typeof t!=="undefined"?t:false;n=typeof n!=="undefined"?n:{};var o=n.id&&typeof n.id==="string"?"id='"+n.id+"'":"",i=n.page?n.page:false,r=n.pdfOpenParams?n.pdfOpenParams:{},f=typeof n.fallbackLink!=="undefined"?n.fallbackLink:true,d=n.width?n.width:"100%",a=n.height?n.height:"100%",l=typeof n.forcePDFJS==="boolean"?n.forcePDFJS:false,s=n.PDFJS_URL?n.PDFJS_URL:false,u=h(t),c="",p="",y="<p>This browser does not support inline PDFs. Please download the PDF to view it: <a href='[url]'>Download PDF</a></p>";if(!u){return g("Target element cannot be determined")}if(i){r.page=i}p=b(r);if(l&&s){return w(u,e,p,s,o)}else if(m){return v(u,t,e,p,d,a,o)}else{if(s){return w(u,e,p,s,o)}else if(f){c=typeof f==="string"?f:y;u.innerHTML=c.replace(/\[url\]/g,e)}return g("This browser does not support embedded PDFs")}};return{embed:function(e,t,n){return f(e,t,n)},pdfobjectversion:function(){return e}(),supportsPDFs:function(){return m}()}});