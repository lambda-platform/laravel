(self.webpackChunk=self.webpackChunk||[]).push([[683],{46731:(t,n,e)=>{var i=[{path:"/p/:menu_id",component:e(41654).Z,children:[{path:":sub_menu_id",component:e(81885).Z}]},{path:"/module/:module",component:e(478).Z},{name:"Error",path:"/*",component:e(24022).Z}];"undefined"!=typeof window&&window.Vue&&window.Vue.mixin({mounted:function(){var t=this;this.$nextTick((function(){t.$parent||t.$router.app.$router.addRoutes(i)}))}})},97855:(t,n,e)=>{"use strict";e.d(n,{Z:()=>a});var i=e(94015),r=e.n(i),o=e(23645),s=e.n(o)()(r());s.push([t.id,"#notfound{position:relative;height:100vh}#notfound .notfound{position:absolute;left:50%;top:50%;transform:translate(-50%,-50%)}.notfound{max-width:520px;width:100%;line-height:1.4;text-align:center}.notfound .notfound-404{position:relative;height:200px;margin:0 auto 20px;z-index:-1}.notfound .notfound-404 h1{font-size:236px;font-weight:200;margin:0;left:50%;top:50%;transform:translate(-50%,-50%)}.notfound .notfound-404 h1,.notfound .notfound-404 h2{font-family:Montserrat,sans-serif;color:#211b19;text-transform:uppercase;position:absolute}.notfound .notfound-404 h2{font-size:28px;font-weight:400;background:#fff;padding:10px 5px;margin:auto;display:inline-block;bottom:0;left:0;right:0}.notfound a{font-family:Montserrat,sans-serif;display:inline-block;font-weight:700;text-decoration:none;color:#fff;text-transform:uppercase;padding:13px 23px;background:#007ae5;font-size:18px;transition:all .2s}.notfound a:hover{color:#007ae5;background:#211b19}@media only screen and (max-width:767px){.notfound .notfound-404 h1{font-size:148px}}@media only screen and (max-width:480px){.notfound .notfound-404{height:148px;margin:0 auto 10px}.notfound .notfound-404 h1{font-size:86px}.notfound .notfound-404 h2{font-size:16px}.notfound a{padding:7px 15px;font-size:14px}}","",{version:3,sources:["webpack://./../../vue/page/src/views/404.vue"],names:[],mappings:"AAgBA,UACA,iBAAA,CACA,YACA,CAEA,oBACA,iBAAA,CACA,QAAA,CACA,OAAA,CAGA,8BACA,CAEA,UACA,eAAA,CACA,UAAA,CACA,eAAA,CACA,iBACA,CAEA,wBACA,iBAAA,CACA,YAAA,CACA,kBAAA,CACA,UACA,CAEA,2BAEA,eAAA,CACA,eAAA,CACA,QAAA,CAIA,QAAA,CACA,OAAA,CAGA,8BACA,CAEA,sDAdA,iCAAA,CAIA,aAAA,CACA,wBAAA,CACA,iBAsBA,CAdA,2BAEA,cAAA,CACA,eAAA,CAGA,eAAA,CACA,gBAAA,CACA,WAAA,CACA,oBAAA,CAEA,QAAA,CACA,MAAA,CACA,OACA,CAEA,YACA,iCAAA,CACA,oBAAA,CACA,eAAA,CACA,oBAAA,CACA,UAAA,CACA,wBAAA,CACA,iBAAA,CACA,kBAAA,CACA,cAAA,CAEA,kBACA,CAEA,kBACA,aAAA,CACA,kBACA,CAEA,yCACA,2BACA,eACA,CACA,CAEA,yCACA,wBACA,YAAA,CACA,kBACA,CACA,2BACA,cACA,CACA,2BACA,cACA,CACA,YACA,gBAAA,CACA,cACA,CACA",sourcesContent:["<template>\n    <div id=\"notfound\">\n        <div class=\"notfound\">\n            <div class=\"notfound-404\">\n                <h1>Oops!</h1>\n                <h2>404 - The Page can't be found</h2>\n            </div>\n        </div>\n    </div>\n</template>\n\n<script>\n    export default {}\n<\/script>\n<style>\n\n#notfound {\n    position: relative;\n    height: 100vh;\n}\n\n#notfound .notfound {\n    position: absolute;\n    left: 50%;\n    top: 50%;\n    -webkit-transform: translate(-50%, -50%);\n    -ms-transform: translate(-50%, -50%);\n    transform: translate(-50%, -50%);\n}\n\n.notfound {\n    max-width: 520px;\n    width: 100%;\n    line-height: 1.4;\n    text-align: center;\n}\n\n.notfound .notfound-404 {\n    position: relative;\n    height: 200px;\n    margin: 0px auto 20px;\n    z-index: -1;\n}\n\n.notfound .notfound-404 h1 {\n    font-family: 'Montserrat', sans-serif;\n    font-size: 236px;\n    font-weight: 200;\n    margin: 0px;\n    color: #211b19;\n    text-transform: uppercase;\n    position: absolute;\n    left: 50%;\n    top: 50%;\n    -webkit-transform: translate(-50%, -50%);\n    -ms-transform: translate(-50%, -50%);\n    transform: translate(-50%, -50%);\n}\n\n.notfound .notfound-404 h2 {\n    font-family: 'Montserrat', sans-serif;\n    font-size: 28px;\n    font-weight: 400;\n    text-transform: uppercase;\n    color: #211b19;\n    background: #fff;\n    padding: 10px 5px;\n    margin: auto;\n    display: inline-block;\n    position: absolute;\n    bottom: 0px;\n    left: 0;\n    right: 0;\n}\n\n.notfound a {\n    font-family: 'Montserrat', sans-serif;\n    display: inline-block;\n    font-weight: 700;\n    text-decoration: none;\n    color: #fff;\n    text-transform: uppercase;\n    padding: 13px 23px;\n    background: #007AE5;\n    font-size: 18px;\n    -webkit-transition: 0.2s all;\n    transition: 0.2s all;\n}\n\n.notfound a:hover {\n    color: #007AE5;\n    background: #211b19;\n}\n\n@media only screen and (max-width: 767px) {\n    .notfound .notfound-404 h1 {\n        font-size: 148px;\n    }\n}\n\n@media only screen and (max-width: 480px) {\n    .notfound .notfound-404 {\n        height: 148px;\n        margin: 0px auto 10px;\n    }\n    .notfound .notfound-404 h1 {\n        font-size: 86px;\n    }\n    .notfound .notfound-404 h2 {\n        font-size: 16px;\n    }\n    .notfound a {\n        padding: 7px 15px;\n        font-size: 14px;\n    }\n}\n</style>\n"],sourceRoot:""}]);const a=s},23645:t=>{"use strict";t.exports=function(t){var n=[];return n.toString=function(){return this.map((function(n){var e=t(n);return n[2]?"@media ".concat(n[2]," {").concat(e,"}"):e})).join("")},n.i=function(t,e,i){"string"==typeof t&&(t=[[null,t,""]]);var r={};if(i)for(var o=0;o<this.length;o++){var s=this[o][0];null!=s&&(r[s]=!0)}for(var a=0;a<t.length;a++){var u=[].concat(t[a]);i&&r[u[0]]||(e&&(u[2]?u[2]="".concat(e," and ").concat(u[2]):u[2]=e),n.push(u))}},n}},94015:t=>{"use strict";function n(t,n){return function(t){if(Array.isArray(t))return t}(t)||function(t,n){if("undefined"==typeof Symbol||!(Symbol.iterator in Object(t)))return;var e=[],i=!0,r=!1,o=void 0;try{for(var s,a=t[Symbol.iterator]();!(i=(s=a.next()).done)&&(e.push(s.value),!n||e.length!==n);i=!0);}catch(t){r=!0,o=t}finally{try{i||null==a.return||a.return()}finally{if(r)throw o}}return e}(t,n)||function(t,n){if(!t)return;if("string"==typeof t)return e(t,n);var i=Object.prototype.toString.call(t).slice(8,-1);"Object"===i&&t.constructor&&(i=t.constructor.name);if("Map"===i||"Set"===i)return Array.from(t);if("Arguments"===i||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(i))return e(t,n)}(t,n)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function e(t,n){(null==n||n>t.length)&&(n=t.length);for(var e=0,i=new Array(n);e<n;e++)i[e]=t[e];return i}t.exports=function(t){var e=n(t,4),i=e[1],r=e[3];if("function"==typeof btoa){var o=btoa(unescape(encodeURIComponent(JSON.stringify(r)))),s="sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(o),a="/*# ".concat(s," */"),u=r.sources.map((function(t){return"/*# sourceURL=".concat(r.sourceRoot||"").concat(t," */")}));return[i].concat(u).concat([a]).join("\n")}return[i].join("\n")}},93379:(t,n,e)=>{"use strict";var i,r=function(){return void 0===i&&(i=Boolean(window&&document&&document.all&&!window.atob)),i},o=function(){var t={};return function(n){if(void 0===t[n]){var e=document.querySelector(n);if(window.HTMLIFrameElement&&e instanceof window.HTMLIFrameElement)try{e=e.contentDocument.head}catch(t){e=null}t[n]=e}return t[n]}}(),s=[];function a(t){for(var n=-1,e=0;e<s.length;e++)if(s[e].identifier===t){n=e;break}return n}function u(t,n){for(var e={},i=[],r=0;r<t.length;r++){var o=t[r],u=n.base?o[0]+n.base:o[0],d=e[u]||0,l="".concat(u," ").concat(d);e[u]=d+1;var c=a(l),p={css:o[1],media:o[2],sourceMap:o[3]};-1!==c?(s[c].references++,s[c].updater(p)):s.push({identifier:l,updater:m(p,n),references:1}),i.push(l)}return i}function d(t){var n=document.createElement("style"),i=t.attributes||{};if(void 0===i.nonce){var r=e.nc;r&&(i.nonce=r)}if(Object.keys(i).forEach((function(t){n.setAttribute(t,i[t])})),"function"==typeof t.insert)t.insert(n);else{var s=o(t.insert||"head");if(!s)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");s.appendChild(n)}return n}var l,c=(l=[],function(t,n){return l[t]=n,l.filter(Boolean).join("\n")});function p(t,n,e,i){var r=e?"":i.media?"@media ".concat(i.media," {").concat(i.css,"}"):i.css;if(t.styleSheet)t.styleSheet.cssText=c(n,r);else{var o=document.createTextNode(r),s=t.childNodes;s[n]&&t.removeChild(s[n]),s.length?t.insertBefore(o,s[n]):t.appendChild(o)}}function f(t,n,e){var i=e.css,r=e.media,o=e.sourceMap;if(r?t.setAttribute("media",r):t.removeAttribute("media"),o&&"undefined"!=typeof btoa&&(i+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(o))))," */")),t.styleSheet)t.styleSheet.cssText=i;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(i))}}var A=null,h=0;function m(t,n){var e,i,r;if(n.singleton){var o=h++;e=A||(A=d(n)),i=p.bind(null,e,o,!1),r=p.bind(null,e,o,!0)}else e=d(n),i=f.bind(null,e,n),r=function(){!function(t){if(null===t.parentNode)return!1;t.parentNode.removeChild(t)}(e)};return i(t),function(n){if(n){if(n.css===t.css&&n.media===t.media&&n.sourceMap===t.sourceMap)return;i(t=n)}else r()}}t.exports=function(t,n){(n=n||{}).singleton||"boolean"==typeof n.singleton||(n.singleton=r());var e=u(t=t||[],n);return function(t){if(t=t||[],"[object Array]"===Object.prototype.toString.call(t)){for(var i=0;i<e.length;i++){var r=a(e[i]);s[r].references--}for(var o=u(t,n),d=0;d<e.length;d++){var l=a(e[d]);0===s[l].references&&(s[l].updater(),s.splice(l,1))}e=o}}}},24022:(t,n,e)=>{"use strict";e.d(n,{Z:()=>u});const i={};var r=e(93379),o=e.n(r),s=e(97855),a={insert:"head",singleton:!1};o()(s.Z,a);s.Z.locals;const u=(0,e(51900).Z)(i,(function(){var t=this,n=t.$createElement;t._self._c;return t._m(0)}),[function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("div",{attrs:{id:"notfound"}},[e("div",{staticClass:"notfound"},[e("div",{staticClass:"notfound-404"},[e("h1",[t._v("Oops!")]),t._v(" "),e("h2",[t._v("404 - The Page can't be found")])])])])}],!1,null,null,null).exports},41654:(t,n,e)=>{"use strict";e.d(n,{Z:()=>r});const i={data:function(){return{options:{height:"1000px"},pageType:"",property:{template:"canvas",title:"",grid:null,form:null,form_width:800,view_url:null,actions:[],user_condition:null,permissions:{c:!1,r:!1,u:!1,d:!1}},iframeUrl:"",submenu:[],showSub:!1,menu:window.init.menu,cruds:window.init.cruds,permissions:window.init.permissions.permissions,pageTitle:""}},methods:{checkSub:function(){var t=this,n=this.menu.findIndex((function(n){return n.id==t.$route.params.menu_id}));if(n>=0)if(this.menu[n].children.length>=1)if(this.pageTitle=this.getTitle(this.menu[n]),this.pageTitle=this.getTitle(this.menu[n]),this.$route.matched.length<=1){var e=this.getShowAbleChild(this.menu[n].children);e&&this.$router.push("/p/".concat(this.$route.params.menu_id,"/").concat(e.id))}else this.subMenu=this.menu[n].children,this.showSub=!0;else this.showSub=!1,this.getPage()},getShowAbleChild:function(t){var n=this,e=t.findIndex((function(t){return n.can(t)}));return e>=0?t[e]:null},can:function(t){return!!this.permissions[t.id]&&!!this.permissions[t.id].show},getTitle:function(t){if("crud"==t.link_to){var n=this.cruds.findIndex((function(n){return n.id==t.url}));return n>=0?this.cruds[n].title:""}return t.title},getPage:function(){var t=this,n=this.menu.findIndex((function(n){return n.id==t.$route.params.menu_id}));if(n>=0){var e=this.menu[n];switch(this.pageType=e.link_to,this.pageType){case"crud":var i=this.cruds.findIndex((function(t){return t.id==e.url}));if(i>=0){this.property.title=this.cruds[i].title,this.property.grid=this.cruds[i].grid,this.property.form=this.cruds[i].form,this.property.form_width=this.cruds[i].form_width?this.cruds[i].form_width:null,this.property.view_url=this.cruds[i].view_url,this.property.permissions.c=this.permissions[e.id].c,this.property.permissions.r=this.permissions[e.id].r,this.property.permissions.u=this.permissions[e.id].u,this.property.permissions.d=this.permissions[e.id].d;var r={};this.permissions[e.id].formCondition&&(r.formCondition=this.permissions[e.id].formCondition),this.permissions[e.id].gridCondition&&(r.gridCondition=this.permissions[e.id].gridCondition),r&&(this.property.user_condition=r)}break;case"link":window.location=this.menu[n].url;break;case"router-link":console.log(this.menu[n].url),this.$router.push(this.menu[n].url);break;case"iframe":this.iframeUrl=e.url}}}},mounted:function(){this.checkSub()}};const r=(0,e(51900).Z)(i,(function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("section",{staticClass:"page"},[t.showSub?e("router-view",{key:t.$route.path},[t.showSub?e("nav",{attrs:{slot:"v-nav"},slot:"v-nav"},[e("div",{staticClass:"card sub-nav-list"},[e("h3",{staticClass:"card-header"},[t._v(t._s(t.pageTitle))]),t._v(" "),e("ul",{staticClass:"card-body"},t._l(t.subMenu,(function(n,i){return t.can(n)?e("li",{key:i},["link"!=n.link_to?e("router-link",{attrs:{to:"/p/"+t.$route.params.menu_id+"/"+n.id}},[n.icon?e("i",{class:n.icon}):t._e(),t._v(" "),e("span",{domProps:{innerHTML:t._s(t.getTitle(n))}})]):t._e(),t._v(" "),"link"==n.link_to?e("a",{attrs:{href:n.url,target:"_blank"}},[n.icon?e("i",{class:n.icon}):t._e(),t._v(" "),e("span",{domProps:{innerHTML:t._s(t.getTitle(n))}})]):t._e()],1):t._e()})),0)])]):t._e()]):t._e(),t._v(" "),t.showSub?t._e():e("div",{class:"iframe"==t.pageType?"iframe-page":"sub-page"},["crud"==t.pageType?e("krud",{staticClass:"material",attrs:{template:t.property.template,property:t.property}},[e("user-control",{attrs:{slot:"right"},slot:"right"})],1):t._e(),t._v(" "),"iframe"==t.pageType?e("iframe",{attrs:{src:t.iframeUrl}}):t._e()],1)],1)}),[],!1,null,null,null).exports},478:(t,n,e)=>{"use strict";e.d(n,{Z:()=>i});const i=(0,e(51900).Z)({},(function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("section",["agent"==t.$route.params.module?e("agent",[e("user-control",{attrs:{slot:"user-control"},slot:"user-control"})],1):t._e(),t._v(" "),"profile"==t.$route.params.module?e("agent-form",{attrs:{type:"profile"}},[e("user-control",{attrs:{slot:"user-control"},slot:"user-control"})],1):t._e(),t._v(" "),"password"==t.$route.params.module?e("agent-form",{attrs:{type:"password"}},[e("user-control",{attrs:{slot:"user-control"},slot:"user-control"})],1):t._e(),t._v(" "),"notify"==t.$route.params.module?e("notif-list"):t._e(),t._v(" "),"logger"==t.$route.params.module?e("logger"):t._e()],1)}),[],!1,null,null,null).exports},81885:(t,n,e)=>{"use strict";e.d(n,{Z:()=>r});const i={data:function(){return{pageType:"",menu:window.init.menu,cruds:window.init.cruds,permissions:window.init.permissions.permissions,property:{template:"canvas",title:"",grid:null,form:null,form_width:null,view_url:null,actions:[],user_condition:null,permissions:{c:!1,r:!1,u:!1,d:!1}},iframeUrl:""}},methods:{getPage:function(){var t=this,n=this.menu.findIndex((function(n){return n.id==t.$route.params.menu_id}));if(n>=0){var e=this.menu[n].children.findIndex((function(n){return n.id==t.$route.params.sub_menu_id}));if(e>=0){var i=this.menu[n].children[e];if(this.pageType=i.link_to,"crud"==this.pageType){var r=this.cruds.findIndex((function(t){return t.id==i.url}));if(r>=0){this.property.title=this.cruds[r].title,this.property.grid=this.cruds[r].grid,this.property.form=this.cruds[r].form,this.property.form_width=this.cruds[r].form_width?this.cruds[r].form_width:null,this.property.view_url=this.cruds[r].view_url,this.property.permissions.c=this.permissions[i.id].c,this.property.permissions.r=this.permissions[i.id].r,this.property.permissions.u=this.permissions[i.id].u,this.property.permissions.d=this.permissions[i.id].d;var o={};this.permissions[i.id].formCondition&&(o.formCondition=this.permissions[i.id].formCondition),this.permissions[i.id].gridCondition&&(o.gridCondition=this.permissions[i.id].gridCondition),o&&(this.property.user_condition=o)}}else"iframe"==this.pageType&&(this.iframeUrl=i.url)}}}},mounted:function(){this.getPage()}};const r=(0,e(51900).Z)(i,(function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("div",{class:(t.pageType,"")},["crud"==t.pageType?e("krud",{staticClass:"material",attrs:{template:t.property.template,property:t.property}},[e("template",{slot:"nav"},[t._t("nav")],2),t._v(" "),e("template",{slot:"v-nav"},[t._t("v-nav")],2),t._v(" "),e("user-control",{attrs:{slot:"right"},slot:"right"})],2):t._e(),t._v(" "),"iframe"==t.pageType?e("div",{staticClass:"material"},[e("section",{staticClass:"offcanvas-template"},[e("div",{staticClass:"crud-page"},[t._m(0),t._v(" "),e("div",{staticClass:"crud-page-body"},[e("div",{staticClass:"v-nav"},[t._t("v-nav")],2),t._v(" "),e("div",{staticClass:"dg-flex"},[e("div",{staticClass:"iframe-page"},["iframe"==t.pageType?e("iframe",{attrs:{src:t.iframeUrl}}):t._e()])])])])])]):t._e()],1)}),[function(){var t=this.$createElement,n=this._self._c||t;return n("div",{staticClass:"crud-page-header"},[n("h3")])}],!1,null,null,null).exports},51900:(t,n,e)=>{"use strict";function i(t,n,e,i,r,o,s,a){var u,d="function"==typeof t?t.options:t;if(n&&(d.render=n,d.staticRenderFns=e,d._compiled=!0),i&&(d.functional=!0),o&&(d._scopeId="data-v-"+o),s?(u=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(s)},d._ssrRegister=u):r&&(u=a?function(){r.call(this,(d.functional?this.parent:this).$root.$options.shadowRoot)}:r),u)if(d.functional){d._injectStyles=u;var l=d.render;d.render=function(t,n){return u.call(n),l(t,n)}}else{var c=d.beforeCreate;d.beforeCreate=c?[].concat(c,u):[u]}return{exports:t,options:d}}e.d(n,{Z:()=>i})}},0,[[46731,245]]]);
//# sourceMappingURL=page.js.map