"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[9402],{61074:(e,t,a)=>{a.r(t),a.d(t,{default:()=>r});var s=a(91317),l=a.n(s),n=a(12519);const i=l().extend({data:()=>({options:[],selected:"",currentValue:null}),methods:{element:n.b,setMeta(e){return e.schemaID=this.params.schemaID,e},getValues(){this.params.api.forEachLeafNode((e=>{this.options.push(e.data[this.params.column.model])})),this.options=[...new Set(this.options)]},setValue(e){this.selected=e,this.params.filterData(this.params.column.model,e,"equals")},valueChanged(e){this.params.isClient?this.params.filterData(this.params.column.model,e.target.value,"contains"):(this.params.filterModel[this.params.column.model]=e.target.value,this.params.filterData(1))},onParentModelChanged(e){this.currentValue=e?e.filter:null}}});const r=(0,a(51900).Z)(i,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"ag-input-wrapper"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.selected,expression:"selected"}],ref:"sinput",staticClass:"ag-floating-filter-input",domProps:{value:e.selected},on:{input:[function(t){t.target.composing||(e.selected=t.target.value)},e.valueChanged]}})])}),[],!1,null,null,null).exports}}]);