(window.webpackJsonp=window.webpackJsonp||[]).push([[4],{222:function(t,e,n){"use strict";n.r(e);var r={name:"",data:function(){return{users:[],currentPage:0,perPage:0,page:0,lastPage:0,apiUrl:"/api/user",usersLoaded:!1}},created:function(){this.loader()},watch:{$route:function(t,e){this.loader()}},methods:{getPage:function(t){},linkGen:function(t){return this.category>0&&this.category+"/","/#/users-page/"+t},loadUsers:function(t){this.usersLoaded=t},loader:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0,n="";e||this.$route.params.page&&(e=this.$route.params.page),this.usersLoaded=!1,parseInt(this.lastPage)<parseInt(e)||parseInt(e)<0?this.$router.push({path:"/404"}):n+="?page="+e,axios.get(this.apiUrl+n).then(function(e){t.users=e.data.data,t.lastPage=e.data.last_page,t.path=e.data.path,t.currentPage=e.data.current_page,t.usersLoaded=!0}).catch(function(e){console.log(e),404==error.response.status&&t.$router.push({path:"/404"})})}}},a=(n(234),n(221)),s=Object(a.a)(r,function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"container px-2",attrs:{id:"users"}},[t._m(0),t._v(" "),n("div",{staticClass:"row"},[t.users&&0==t.users.length&&t.usersLoaded?n("div",{staticClass:"col-12"},[n("div",{staticClass:"display-4"},[t._v("\n          There are no registered users!\n      ")]),t._v(" "),n("div",{staticClass:"alert alert-info"},[t._v("\n        You can register new user in\n        "),n("router-link",{attrs:{to:"/CreateUser"}},[t._v("here")])],1)]):t.usersLoaded?t._l(t.users,function(e){return n("div",{staticClass:"col-sm-6 col-lg-4 col-xl-3 p-1"},[n("div",{staticClass:"card user-card"},[n("div",{staticClass:"card-header px-2"},[t._v("\n          "+t._s(e.name)+"\n        ")]),t._v(" "),n("div",{staticClass:"card-body container"},[n("div",{staticClass:"row"},[n("div",{staticClass:"col-6 pr-0 pl-1"},[t._v("\n              Date of birth:\n            ")]),t._v(" "),n("div",{staticClass:"col-6 pr-2 text-right"},[t._v("\n              "+t._s(e.date_of_birth)+"\n            ")])]),t._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col pl-1"},[t._v("\n              Email"+t._s(e.emails&&e.emails.length>1?"s":"")+":\n            ")])]),t._v(" "),n("div",{staticClass:"row"},t._l(e.emails,function(e){return n("div",{staticClass:"col-12 px-2 text-right"},[n("a",{attrs:{href:"mailto:"+e.email}},[t._v(t._s(e.email))])])}),0)])])])}):n("div",{staticClass:"loader"},[t._v("\n      Loading...\n    ")])],2),t._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col pt-2",class:{"d-none":!t.usersLoaded}},[t.lastPage>1?n("b-pagination-nav",{attrs:{"link-gen":t.linkGen,"number-of-pages":t.lastPage,size:"md",align:"center",limit:7},on:{input:function(e){return t.getPage(t.currentPage)}},model:{value:t.currentPage,callback:function(e){t.currentPage=e},expression:"currentPage"}}):t._e()],1)])])},[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"row"},[e("h1",[this._v("Users")])])}],!1,null,"7fa95b1e",null);e.default=s.exports},228:function(t,e){t.exports=function(t){var e=[];return e.toString=function(){return this.map(function(e){var n=function(t,e){var n=t[1]||"",r=t[3];if(!r)return n;if(e&&"function"==typeof btoa){var a=(o=r,"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(o))))+" */"),s=r.sources.map(function(t){return"/*# sourceURL="+r.sourceRoot+t+" */"});return[n].concat(s).concat([a]).join("\n")}var o;return[n].join("\n")}(e,t);return e[2]?"@media "+e[2]+"{"+n+"}":n}).join("")},e.i=function(t,n){"string"==typeof t&&(t=[[null,t,""]]);for(var r={},a=0;a<this.length;a++){var s=this[a][0];"number"==typeof s&&(r[s]=!0)}for(a=0;a<t.length;a++){var o=t[a];"number"==typeof o[0]&&r[o[0]]||(n&&!o[2]?o[2]=n:n&&(o[2]="("+o[2]+") and ("+n+")"),e.push(o))}},e}},229:function(t,e,n){var r,a,s={},o=(r=function(){return window&&document&&document.all&&!window.atob},function(){return void 0===a&&(a=r.apply(this,arguments)),a}),i=function(t){var e={};return function(t,n){if("function"==typeof t)return t();if(void 0===e[t]){var r=function(t,e){return e?e.querySelector(t):document.querySelector(t)}.call(this,t,n);if(window.HTMLIFrameElement&&r instanceof window.HTMLIFrameElement)try{r=r.contentDocument.head}catch(t){r=null}e[t]=r}return e[t]}}(),c=null,l=0,u=[],f=n(230);function d(t,e){for(var n=0;n<t.length;n++){var r=t[n],a=s[r.id];if(a){a.refs++;for(var o=0;o<a.parts.length;o++)a.parts[o](r.parts[o]);for(;o<r.parts.length;o++)a.parts.push(g(r.parts[o],e))}else{var i=[];for(o=0;o<r.parts.length;o++)i.push(g(r.parts[o],e));s[r.id]={id:r.id,refs:1,parts:i}}}}function p(t,e){for(var n=[],r={},a=0;a<t.length;a++){var s=t[a],o=e.base?s[0]+e.base:s[0],i={css:s[1],media:s[2],sourceMap:s[3]};r[o]?r[o].parts.push(i):n.push(r[o]={id:o,parts:[i]})}return n}function v(t,e){var n=i(t.insertInto);if(!n)throw new Error("Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid.");var r=u[u.length-1];if("top"===t.insertAt)r?r.nextSibling?n.insertBefore(e,r.nextSibling):n.appendChild(e):n.insertBefore(e,n.firstChild),u.push(e);else if("bottom"===t.insertAt)n.appendChild(e);else{if("object"!=typeof t.insertAt||!t.insertAt.before)throw new Error("[Style Loader]\n\n Invalid value for parameter 'insertAt' ('options.insertAt') found.\n Must be 'top', 'bottom', or Object.\n (https://github.com/webpack-contrib/style-loader#insertat)\n");var a=i(t.insertAt.before,n);n.insertBefore(e,a)}}function h(t){if(null===t.parentNode)return!1;t.parentNode.removeChild(t);var e=u.indexOf(t);e>=0&&u.splice(e,1)}function m(t){var e=document.createElement("style");if(void 0===t.attrs.type&&(t.attrs.type="text/css"),void 0===t.attrs.nonce){var r=function(){0;return n.nc}();r&&(t.attrs.nonce=r)}return b(e,t.attrs),v(t,e),e}function b(t,e){Object.keys(e).forEach(function(n){t.setAttribute(n,e[n])})}function g(t,e){var n,r,a,s;if(e.transform&&t.css){if(!(s="function"==typeof e.transform?e.transform(t.css):e.transform.default(t.css)))return function(){};t.css=s}if(e.singleton){var o=l++;n=c||(c=m(e)),r=x.bind(null,n,o,!1),a=x.bind(null,n,o,!0)}else t.sourceMap&&"function"==typeof URL&&"function"==typeof URL.createObjectURL&&"function"==typeof URL.revokeObjectURL&&"function"==typeof Blob&&"function"==typeof btoa?(n=function(t){var e=document.createElement("link");return void 0===t.attrs.type&&(t.attrs.type="text/css"),t.attrs.rel="stylesheet",b(e,t.attrs),v(t,e),e}(e),r=function(t,e,n){var r=n.css,a=n.sourceMap,s=void 0===e.convertToAbsoluteUrls&&a;(e.convertToAbsoluteUrls||s)&&(r=f(r));a&&(r+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(a))))+" */");var o=new Blob([r],{type:"text/css"}),i=t.href;t.href=URL.createObjectURL(o),i&&URL.revokeObjectURL(i)}.bind(null,n,e),a=function(){h(n),n.href&&URL.revokeObjectURL(n.href)}):(n=m(e),r=function(t,e){var n=e.css,r=e.media;r&&t.setAttribute("media",r);if(t.styleSheet)t.styleSheet.cssText=n;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(n))}}.bind(null,n),a=function(){h(n)});return r(t),function(e){if(e){if(e.css===t.css&&e.media===t.media&&e.sourceMap===t.sourceMap)return;r(t=e)}else a()}}t.exports=function(t,e){if("undefined"!=typeof DEBUG&&DEBUG&&"object"!=typeof document)throw new Error("The style-loader cannot be used in a non-browser environment");(e=e||{}).attrs="object"==typeof e.attrs?e.attrs:{},e.singleton||"boolean"==typeof e.singleton||(e.singleton=o()),e.insertInto||(e.insertInto="head"),e.insertAt||(e.insertAt="bottom");var n=p(t,e);return d(n,e),function(t){for(var r=[],a=0;a<n.length;a++){var o=n[a];(i=s[o.id]).refs--,r.push(i)}t&&d(p(t,e),e);for(a=0;a<r.length;a++){var i;if(0===(i=r[a]).refs){for(var c=0;c<i.parts.length;c++)i.parts[c]();delete s[i.id]}}}};var y,w=(y=[],function(t,e){return y[t]=e,y.filter(Boolean).join("\n")});function x(t,e,n,r){var a=n?"":r.css;if(t.styleSheet)t.styleSheet.cssText=w(e,a);else{var s=document.createTextNode(a),o=t.childNodes;o[e]&&t.removeChild(o[e]),o.length?t.insertBefore(s,o[e]):t.appendChild(s)}}},230:function(t,e){t.exports=function(t){var e="undefined"!=typeof window&&window.location;if(!e)throw new Error("fixUrls requires window.location");if(!t||"string"!=typeof t)return t;var n=e.protocol+"//"+e.host,r=n+e.pathname.replace(/\/[^\/]*$/,"/");return t.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi,function(t,e){var a,s=e.trim().replace(/^"(.*)"$/,function(t,e){return e}).replace(/^'(.*)'$/,function(t,e){return e});return/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/|\s*$)/i.test(s)?t:(a=0===s.indexOf("//")?s:0===s.indexOf("/")?n+s:r+s.replace(/^\.\//,""),"url("+JSON.stringify(a)+")")})}},231:function(t,e,n){var r=n(235);"string"==typeof r&&(r=[[t.i,r,""]]);var a={hmr:!0,transform:void 0,insertInto:void 0};n(229)(r,a);r.locals&&(t.exports=r.locals)},234:function(t,e,n){"use strict";var r=n(231);n.n(r).a},235:function(t,e,n){(t.exports=n(228)(!1)).push([t.i,'.loader[data-v-7fa95b1e] {\n  color: #3490dc;\n  text-indent: -9999em;\n  margin: 88px auto;\n  position: relative;\n  font-size: 11px;\n  -webkit-transform: translateZ(0);\n  -ms-transform: translateZ(0);\n  transform: translateZ(0);\n  -webkit-animation-delay: -0.16s;\n  animation-delay: -0.16s;\n  margin-top: 30vh;\n}\n.loader[data-v-7fa95b1e], .loader[data-v-7fa95b1e]:before, .loader[data-v-7fa95b1e]:after {\n  background: #3490dc;\n  -webkit-animation: load1-data-v-7fa95b1e 1s infinite ease-in-out;\n  animation: load1-data-v-7fa95b1e 1s infinite ease-in-out;\n  width: 1em;\n  height: 4em;\n}\n.loader[data-v-7fa95b1e]:before, .loader[data-v-7fa95b1e]:after {\n  position: absolute;\n  top: 0;\n  content: "";\n}\n.loader[data-v-7fa95b1e]:before {\n  left: -1.5em;\n  -webkit-animation-delay: -0.32s;\n  animation-delay: -0.32s;\n}\n.loader[data-v-7fa95b1e]:after {\n  left: 1.5em;\n}\n@-webkit-keyframes load1-data-v-7fa95b1e {\n0%, 80%, 100% {\n    box-shadow: 0 0;\n    height: 4em;\n}\n40% {\n    box-shadow: 0 -2em;\n    height: 5em;\n}\n}\n@keyframes load1-data-v-7fa95b1e {\n0%, 80%, 100% {\n    box-shadow: 0 0;\n    height: 4em;\n}\n40% {\n    box-shadow: 0 -2em;\n    height: 5em;\n}\n}',""])}}]);
//# sourceMappingURL=4.js.map