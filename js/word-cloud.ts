!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?e(exports,require("chart.js"),require("chart.js/helpers")):"function"==typeof define&&define.amd?define(["exports","chart.js","chart.js/helpers"],e):e((t="undefined"!=typeof globalThis?globalThis:t||self).ChartWordCloud={},t.Chart,t.Chart.helpers)}(this,(function(t,e,n){"use strict";"undefined"!=typeof globalThis?globalThis:"undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self&&self;var r={exports:{}};!function(t,e){!function(t){var e={value:function(){}};function n(){for(var t,e=0,n=arguments.length,o={};e<n;++e){if(!(t=arguments[e]+"")||t in o||/[\s.]/.test(t))throw new Error("illegal type: "+t);o[t]=[]}return new r(o)}function r(t){this._=t}function o(t,e){return t.trim().split(/^|\s+/).map((function(t){var n="",r=t.indexOf(".");if(r>=0&&(n=t.slice(r+1),t=t.slice(0,r)),t&&!e.hasOwnProperty(t))throw new Error("unknown type: "+t);return{type:t,name:n}}))}function a(t,e){for(var n,r=0,o=t.length;r<o;++r)if((n=t[r]).name===e)return n.value}function i(t,n,r){for(var o=0,a=t.length;o<a;++o)if(t[o].name===n){t[o]=e,t=t.slice(0,o).concat(t.slice(o+1));break}return null!=r&&t.push({name:n,value:r}),t}r.prototype=n.prototype={constructor:r,on:function(t,e){var n,r=this._,s=o(t+"",r),l=-1,u=s.length;if(!(arguments.length<2)){if(null!=e&&"function"!=typeof e)throw new Error("invalid callback: "+e);for(;++l<u;)if(n=(t=s[l]).type)r[n]=i(r[n],t.name,e);else if(null==e)for(n in r)r[n]=i(r[n],t.name,null);return this}for(;++l<u;)if((n=(t=s[l]).type)&&(n=a(r[n],t.name)))return n},copy:function(){var t={},e=this._;for(var n in e)t[n]=e[n].slice();return new r(t)},call:function(t,e){if((n=arguments.length-2)>0)for(var n,r,o=new Array(n),a=0;a<n;++a)o[a]=arguments[a+2];if(!this._.hasOwnProperty(t))throw new Error("unknown type: "+t);for(a=0,n=(r=this._[t]).length;a<n;++a)r[a].value.apply(e,o)},apply:function(t,e,n){if(!this._.hasOwnProperty(t))throw new Error("unknown type: "+t);for(var r=this._[t],o=0,a=r.length;o<a;++o)r[o].value.apply(e,n)}},t.dispatch=n,Object.defineProperty(t,"__esModule",{value:!0})}(e)}(0,r.exports);var o=r.exports.dispatch,a=Math.PI/180,i=2048,s=function(){var t=[256,256],e=l,n=u,r=c,a=h,s=h,b=f,M=d,S=g,E=[],C=1/0,R=o("word","end"),k=null,_=Math.random,P={},z=m;function T(e,n,r){t[0],t[1];for(var o,a,i,s,l,u=n.x,h=n.y,c=Math.sqrt(t[0]*t[0]+t[1]*t[1]),f=S(t),d=_()<.5?1:-1,y=-d;(o=f(y+=d))&&(a=~~o[0],i=~~o[1],!(Math.min(Math.abs(a),Math.abs(i))>=c));)if(n.x=u+a,n.y=h+i,!(n.x+n.x0<0||n.y+n.y0<0||n.x+n.x1>t[0]||n.y+n.y1>t[1]||r&&p(n,e,t[0])||r&&(l=r,!((s=n).x+s.x1>l[0].x&&s.x+s.x0<l[1].x&&s.y+s.y1>l[0].y&&s.y+s.y0<l[1].y)))){for(var x,g=n.sprite,m=n.width>>5,v=t[0]>>5,w=n.x-(m<<4),b=127&w,M=32-b,E=n.y1-n.y0,C=(n.y+n.y0)*v+(w>>5),R=0;R<E;R++){x=0;for(var k=0;k<=m;k++)e[C+k]|=x<<M|(k<m?(x=g[R*m+k])>>>b:0);C+=v}return delete n.sprite,!0}return!1}return P.canvas=function(t){return arguments.length?(z=v(t),P):z},P.start=function(){var o=function(t){t.width=t.height=1;var e=Math.sqrt(t.getContext("2d").getImageData(0,0,1,1).data.length>>2);t.width=2048/e,t.height=i/e;var n=t.getContext("2d");return n.fillStyle=n.strokeStyle="red",n.textAlign="center",{context:n,ratio:e}}(z()),l=function(t){var e=[],n=-1;for(;++n<t;)e[n]=0;return e}((t[0]>>5)*t[1]),u=null,h=E.length,c=-1,f=[],d=E.map((function(t,o){return t.text=e.call(this,t,o),t.font=n.call(this,t,o),t.style=a.call(this,t,o),t.weight=s.call(this,t,o),t.rotate=b.call(this,t,o),t.size=~~r.call(this,t,o),t.padding=M.call(this,t,o),t})).sort((function(t,e){return e.size-t.size}));return k&&clearInterval(k),k=setInterval(p,0),p(),P;function p(){for(var e=Date.now();Date.now()-e<C&&++c<h&&k;){var n=d[c];n.x=t[0]*(_()+.5)>>1,n.y=t[1]*(_()+.5)>>1,y(o,n,d,c),n.hasText&&T(l,n,u)&&(f.push(n),R.call("word",P,n),u?x(u,n):u=[{x:n.x+n.x0,y:n.y+n.y0},{x:n.x+n.x1,y:n.y+n.y1}],n.x-=t[0]>>1,n.y-=t[1]>>1)}c>=h&&(P.stop(),R.call("end",P,f,u))}},P.stop=function(){return k&&(clearInterval(k),k=null),P},P.timeInterval=function(t){return arguments.length?(C=null==t?1/0:t,P):C},P.words=function(t){return arguments.length?(E=t,P):E},P.size=function(e){return arguments.length?(t=[+e[0],+e[1]],P):t},P.font=function(t){return arguments.length?(n=v(t),P):n},P.fontStyle=function(t){return arguments.length?(a=v(t),P):a},P.fontWeight=function(t){return arguments.length?(s=v(t),P):s},P.rotate=function(t){return arguments.length?(b=v(t),P):b},P.text=function(t){return arguments.length?(e=v(t),P):e},P.spiral=function(t){return arguments.length?(S=w[t]||t,P):S},P.fontSize=function(t){return arguments.length?(r=v(t),P):r},P.padding=function(t){return arguments.length?(M=v(t),P):M},P.random=function(t){return arguments.length?(_=t,P):_},P.on=function(){var t=R.on.apply(R,arguments);return t===R?P:t},P};function l(t){return t.text}function u(){return"serif"}function h(){return"normal"}function c(t){return Math.sqrt(t.value)}function f(){return 30*(~~(6*Math.random())-3)}function d(){return 1}function y(t,e,n,r){if(!e.sprite){var o=t.context,s=t.ratio;o.clearRect(0,0,2048/s,i/s);var l=0,u=0,h=0,c=n.length;for(--r;++r<c;){e=n[r],o.save(),o.font=e.style+" "+e.weight+" "+~~((e.size+1)/s)+"px "+e.font;var f=o.measureText(e.text+"m").width*s,d=e.size<<1;if(e.rotate){var y=Math.sin(e.rotate*a),p=Math.cos(e.rotate*a),x=f*p,g=f*y,m=d*p,v=d*y;f=Math.max(Math.abs(x+v),Math.abs(x-v))+31>>5<<5,d=~~Math.max(Math.abs(g+m),Math.abs(g-m))}else f=f+31>>5<<5;if(d>h&&(h=d),l+f>=2048&&(l=0,u+=h,h=0),u+d>=i)break;o.translate((l+(f>>1))/s,(u+(d>>1))/s),e.rotate&&o.rotate(e.rotate*a),o.fillText(e.text,0,0),e.padding&&(o.lineWidth=2*e.padding,o.strokeText(e.text,0,0)),o.restore(),e.width=f,e.height=d,e.xoff=l,e.yoff=u,e.x1=f>>1,e.y1=d>>1,e.x0=-e.x1,e.y0=-e.y1,e.hasText=!0,l+=f}for(var w=o.getImageData(0,0,2048/s,i/s).data,b=[];--r>=0;)if((e=n[r]).hasText){for(var M=(f=e.width)>>5,S=(d=e.y1-e.y0,0);S<d*M;S++)b[S]=0;if(null==(l=e.xoff))return;u=e.yoff;for(var E=0,C=-1,R=0;R<d;R++){for(S=0;S<f;S++){var k=M*R+(S>>5),_=w[2048*(u+R)+(l+S)<<2]?1<<31-S%32:0;b[k]|=_,E|=_}E?C=R:(e.y0++,d--,R--,u++)}e.y1=e.y0+C,e.sprite=b.slice(0,(e.y1-e.y0)*M)}}}function p(t,e,n){n>>=5;for(var r,o=t.sprite,a=t.width>>5,i=t.x-(a<<4),s=127&i,l=32-s,u=t.y1-t.y0,h=(t.y+t.y0)*n+(i>>5),c=0;c<u;c++){r=0;for(var f=0;f<=a;f++)if((r<<l|(f<a?(r=o[c*a+f])>>>s:0))&e[h+f])return!0;h+=n}return!1}function x(t,e){var n=t[0],r=t[1];e.x+e.x0<n.x&&(n.x=e.x+e.x0),e.y+e.y0<n.y&&(n.y=e.y+e.y0),e.x+e.x1>r.x&&(r.x=e.x+e.x1),e.y+e.y1>r.y&&(r.y=e.y+e.y1)}function g(t){var e=t[0]/t[1];return function(t){return[e*(t*=.1)*Math.cos(t),t*Math.sin(t)]}}function m(){return document.createElement("canvas")}function v(t){return"function"==typeof t?t:function(){return t}}var w={archimedean:g,rectangular:function(t){var e=4*t[0]/t[1],n=0,r=0;return function(t){var o=t<0?-1:1;switch(Math.sqrt(1+4*o*t)-o&3){case 0:n+=e;break;case 1:r+=4;break;case 2:n-=e;break;default:r-=4}return[n,r]}}};class b extends e.Element{static computeRotation(t,e){if(t.rotationSteps<=1)return 0;if(t.minRotation===t.maxRotation)return t.minRotation;const n=Math.min(t.rotationSteps,Math.floor(e()*t.rotationSteps))/(t.rotationSteps-1),r=t.maxRotation-t.minRotation;return t.minRotation+n*r}inRange(t,e){const n=this.getProps(["x","y","width","height","scale"]);if(n.scale<=0)return!1;const r=Number.isNaN(t)?n.x:t,o=Number.isNaN(e)?n.y:e;return r>=n.x-n.width/2&&r<=n.x+n.width/2&&o>=n.y-n.height/2&&o<=n.y+n.height/2}inXRange(t){return this.inRange(t,Number.NaN)}inYRange(t){return this.inRange(Number.NaN,t)}getCenterPoint(){return this.getProps(["x","y"])}tooltipPosition(){return this.getCenterPoint()}draw(t){const{options:e}=this,r=this.getProps(["x","y","width","height","text","scale"]);if(r.scale<=0)return;t.save();const o=n.toFont({...e,size:e.size*r.scale});t.font=o.string,t.fillStyle=e.color,t.textAlign="center",t.translate(r.x,r.y),t.rotate(e.rotate/180*Math.PI),e.strokeStyle&&(t.strokeStyle=e.strokeStyle,t.strokeText(r.text,0,0)),t.fillText(r.text,0,0),t.restore()}}b.id="word",b.defaults={minRotation:-90,maxRotation:0,rotationSteps:2,padding:1,strokeStyle:void 0,size:t=>t.parsed.y,hoverColor:"#ababab"},b.defaultRoutes={color:"color",family:"font.family",style:"font.style",weight:"font.weight",lineHeight:"font.lineHeight"};class M extends e.DatasetController{constructor(){super(...arguments),this.wordLayout=s().text((t=>t.text)).padding((t=>t.options.padding)).rotate((t=>t.options.rotate)).font((t=>t.options.family)).fontSize((t=>t.options.size)).fontStyle((t=>t.options.style)).fontWeight((t=>{var e;return null!==(e=t.options.weight)&&void 0!==e?e:1})),this.rand=Math.random}update(t){super.update(t),this.rand=function(t=Date.now()){let e="number"==typeof t?t:Array.from(t).reduce(((t,e)=>t+e.charCodeAt(0)),0);return()=>(e=(9301*e+49297)%233280,e/233280)}(this.chart.id);const e=this._cachedMeta.data||[];this.updateElements(e,0,e.length,t)}updateElements(t,e,r,o){var a,i,s,l;this.wordLayout.stop();const u=this._cachedMeta.xScale,h=this._cachedMeta.yScale,c=u.right-u.left,f=h.bottom-h.top,d=this.chart.data.labels,y=[];for(let t=e;t<e+r;t+=1){const e=this.resolveDataElementOptions(t,o);null==e.rotate&&(e.rotate=b.computeRotation(e,this.rand));const r={options:{...n.toFont(e),...e},x:null!==(i=null===(a=this._cachedMeta.xScale)||void 0===a?void 0:a.getPixelForDecimal(.5))&&void 0!==i?i:0,y:null!==(l=null===(s=this._cachedMeta.yScale)||void 0===s?void 0:s.getPixelForDecimal(.5))&&void 0!==l?l:0,width:10,height:10,scale:1,index:t,text:d[t]};y.push(r)}if("reset"===o)return void y.forEach((e=>{this.updateElement(t[e.index],e.index,e,o)}));this.wordLayout.random(this.rand).words(y);const p=(e=1,n=3)=>{this.wordLayout.size([c*e,f*e]).on("end",((r,a)=>{if(r.length<d.length){if(n>0)return void p(1.2*e,n-1);console.warn("cannot fit all text elements in three tries")}const i=a[1].x-a[0].x,s=a[1].y-a[0].y,l=this.options.fit?Math.min(c/i,f/s):1,y=new Set(d.map(((t,e)=>e)));r.forEach((e=>{y.delete(e.index),this.updateElement(t[e.index],e.index,{options:e.options,scale:l,x:u.left+l*e.x+c/2,y:h.top+l*e.y+f/2,width:l*e.width,height:l*e.height,text:e.text},o)})),y.forEach((e=>this.updateElement(t[e],e,{scale:0},o)))})).start()};p()}draw(){const t=this._cachedMeta.data,{ctx:e}=this.chart;t.forEach((t=>t.draw(e)))}getLabelAndValue(t){const e=super.getLabelAndValue(t),n=this.chart.data.labels;return e.label=n[t],e}}M.id="wordCloud",M.defaults={datasets:{fit:!0,animation:{colors:{properties:["color","strokeStyle"]},numbers:{properties:["x","y","size","rotate"]}}},maintainAspectRatio:!1,dataElementType:b.id},M.overrides={scales:{x:{type:"linear",min:-1,max:1,display:!1},y:{type:"linear",min:-1,max:1,display:!1}}};class S extends e.Chart{constructor(t,n){super(t,function(t,n,r,o=[],a=[]){e.registry.addControllers(r),Array.isArray(o)?e.registry.addElements(...o):e.registry.addElements(o),Array.isArray(a)?e.registry.addScales(...a):e.registry.addScales(a);const i=n;return i.type=t,i}("wordCloud",n,M,b))}}S.id=M.id,e.registry.addControllers(M),e.registry.addElements(b),t.WordCloudChart=S,t.WordCloudController=M,t.WordElement=b,Object.defineProperty(t,"__esModule",{value:!0})}));
//# sourceMappingURL=index.umd.min.js.map