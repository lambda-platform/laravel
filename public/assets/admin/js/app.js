(self.webpackChunk=self.webpackChunk||[]).push([[565],{14025:(t,e,n)=>{"use strict";var o=n(91317),r=n.n(o),i=n(9669),s=n.n(i);window._=n(96486),window.axios=n(9669),window.axios.defaults.headers.common["X-Requested-With"]="XMLHttpRequest",r().config.productionTip=!1,window.Vue=r(),window.axios=s();function a(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(t);e&&(o=o.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,o)}return n}function c(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}const u={computed:function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?a(Object(n),!0).forEach((function(e){c(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):a(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}({},(0,n(20629).Se)({user:"user"})),created:function(){console.log(this.$route)},data:function(){return{logoutModal:!1,menu:window.init.menu,cruds:window.init.cruds,permissions:window.init.permissions.permissions,extra:window.init.permissions.extra}},methods:{can:function(t){return!this.permissions[t.id]||!!this.permissions[t.id].show},getTitle:function(t){if("crud"==t.link_to){var e=this.cruds.findIndex((function(e){return e.id===t.url}));return e>=0?this.cruds[e].title:""}return t.title},checkActive:function(t){var e=t.split("#");if(e.length>1&&e[1]===this.$route.path)return"active"},logout:function(){axios.post("/auth/logout",{}).then((function(t){window.location="/auth/login"}))},cancel:function(){this.$data.logoutModal=!1}}};const l=(0,n(51900).Z)(u,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"paper-theme aside-page"},[n("sidebar",{staticClass:"with-text"},[n("div",{staticClass:"logo",attrs:{slot:"brand"},slot:"brand"},[n("img",{attrs:{src:t.$logo,alt:"Lambda"}})]),t._v(" "),n("ul",t._l(t.menu,(function(e,o){return t.can(e)?n("li",{key:o},["link"!=e.link_to&&"router-link"!=e.link_to?n("router-link",{attrs:{to:"/p/"+e.id}},[e.icon?n("i",{class:e.icon}):t._e(),t._v(" "),n("span",{domProps:{innerHTML:t._s(t.getTitle(e))}})]):t._e(),t._v(" "),"router-link"==e.link_to?n("router-link",{attrs:{to:e.url}},[e.icon?n("i",{class:e.icon}):t._e(),t._v(" "),n("span",{domProps:{innerHTML:t._s(t.getTitle(e))}})]):t._e(),t._v(" "),"link"==e.link_to?n("a",{attrs:{href:e.url}},[e.icon?n("i",{class:e.icon}):t._e(),t._v(" "),n("span",{domProps:{innerHTML:t._s(t.getTitle(e))}})]):t._e()],1):t._e()})),0),t._v(" "),n("div",{attrs:{slot:"aside-bottom"},slot:"aside-bottom"},[n("ul",[t.extra.userlist?n("li",[n("router-link",{attrs:{to:"/module/agent"}},[n("i",{staticClass:"ti-user"})])],1):t._e(),t._v(" "),n("li",[n("a",{on:{click:function(e){t.logoutModal=!0}}},[n("i",{staticClass:"ti-power-off"})])])])])]),t._v(" "),n("main",[n("router-view",{key:t.$route.path})],1),t._v(" "),n("Modal",{staticClass:"logout-modal",attrs:{closable:!1,width:"252"},model:{value:t.logoutModal,callback:function(e){t.logoutModal=e},expression:"logoutModal"}},[n("p",{staticStyle:{display:"none"},attrs:{slot:"header"},slot:"header"}),t._v(" "),n("div",{staticStyle:{"text-align":"center"}},[n("a",{on:{click:function(e){return t.logout()}}},[n("i",{staticClass:"ti-power-off"}),t._v("\n                Гарах\n            ")]),t._v(" "),n("a",{on:{click:function(e){return t.cancel()}}},[n("i",{staticClass:"ti-reload"}),t._v("\n                Болих\n            ")])]),t._v(" "),n("div",{staticStyle:{display:"none"},attrs:{slot:"footer"},slot:"footer"},[n("form",{attrs:{action:"/auth/logout"}})])])],1)}),[],!1,null,null,null).exports;var d=n(78345);Vue.use(d.Z);var f="/";location.pathname&&"/"!=location.pathname&&(f=location.pathname.split("/").slice(0,-1).join("/"));const p=new d.Z({base:f,routes:[],history:!0,linkActiveClass:"active"});Vue.prototype.$init=window.init,Vue.prototype.$user=window.init.user,Vue.prototype.$logo=window.logo,new Vue({components:{App:l},router:p,render:function(t){return t(l)}}).$mount("#app")},12302:()=>{},11354:()=>{},70102:()=>{},85698:()=>{},26335:()=>{},44710:()=>{},56931:()=>{},98028:()=>{},86668:()=>{},15541:()=>{},29971:()=>{},34155:t=>{var e,n,o=t.exports={};function r(){throw new Error("setTimeout has not been defined")}function i(){throw new Error("clearTimeout has not been defined")}function s(t){if(e===setTimeout)return setTimeout(t,0);if((e===r||!e)&&setTimeout)return e=setTimeout,setTimeout(t,0);try{return e(t,0)}catch(n){try{return e.call(null,t,0)}catch(n){return e.call(this,t,0)}}}!function(){try{e="function"==typeof setTimeout?setTimeout:r}catch(t){e=r}try{n="function"==typeof clearTimeout?clearTimeout:i}catch(t){n=i}}();var a,c=[],u=!1,l=-1;function d(){u&&a&&(u=!1,a.length?c=a.concat(c):l=-1,c.length&&f())}function f(){if(!u){var t=s(d);u=!0;for(var e=c.length;e;){for(a=c,c=[];++l<e;)a&&a[l].run();l=-1,e=c.length}a=null,u=!1,function(t){if(n===clearTimeout)return clearTimeout(t);if((n===i||!n)&&clearTimeout)return n=clearTimeout,clearTimeout(t);try{n(t)}catch(e){try{return n.call(null,t)}catch(e){return n.call(this,t)}}}(t)}}function p(t,e){this.fun=t,this.array=e}function h(){}o.nextTick=function(t){var e=new Array(arguments.length-1);if(arguments.length>1)for(var n=1;n<arguments.length;n++)e[n-1]=arguments[n];c.push(new p(t,e)),1!==c.length||u||s(f)},p.prototype.run=function(){this.fun.apply(null,this.array)},o.title="browser",o.browser=!0,o.env={},o.argv=[],o.version="",o.versions={},o.on=h,o.addListener=h,o.once=h,o.off=h,o.removeListener=h,o.removeAllListeners=h,o.emit=h,o.prependListener=h,o.prependOnceListener=h,o.listeners=function(t){return[]},o.binding=function(t){throw new Error("process.binding is not supported")},o.cwd=function(){return"/"},o.chdir=function(t){throw new Error("process.chdir is not supported")},o.umask=function(){return 0}},51900:(t,e,n)=>{"use strict";function o(t,e,n,o,r,i,s,a){var c,u="function"==typeof t?t.options:t;if(e&&(u.render=e,u.staticRenderFns=n,u._compiled=!0),o&&(u.functional=!0),i&&(u._scopeId="data-v-"+i),s?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(s)},u._ssrRegister=c):r&&(c=a?function(){r.call(this,(u.functional?this.parent:this).$root.$options.shadowRoot)}:r),c)if(u.functional){u._injectStyles=c;var l=u.render;u.render=function(t,e){return c.call(e),l(t,e)}}else{var d=u.beforeCreate;u.beforeCreate=d?[].concat(d,c):[c]}return{exports:t,options:u}}n.d(e,{Z:()=>o})}},0,[[14025,245,204],[98028,245,204],[86668,245,204],[15541,245,204],[29971,245,204],[12302,245,204],[11354,245,204],[70102,245,204],[85698,245,204],[26335,245,204],[44710,245,204],[56931,245,204]]]);
//# sourceMappingURL=app.js.map