"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[7911],{48670:(e,t,l)=>{l.r(t),l.d(t,{default:()=>a});const o={props:["model","label","rule","meta"],computed:{options(){return this.meta.options.length>=1?this.meta.options:this.relations?this.relations[this.meta.relation.table]&&this.relations[this.meta.relation.table].data?this.relations[this.meta.relation.table].data:[]:void 0}}};const a=(0,l(51900).Z)(o,(function(){var e=this,t=e.$createElement,l=e._self._c||t;return l("FormItem",{attrs:{label:e.label,prop:e.rule}},[l("RadioGroup",{model:{value:e.model.form[e.model.component],callback:function(t){e.$set(e.model.form,e.model.component,t)},expression:"model.form[model.component]"}},e._l(e.options,(function(t){return l("Radio",{key:t.index,attrs:{label:t.value,disabled:!(!e.meta||!e.meta.disabled)&&e.meta.disabled}},[l("span",[e._v(e._s(t.label))])])})),1)],1)}),[],!1,null,null,null).exports}}]);