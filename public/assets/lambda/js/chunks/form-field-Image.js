"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[6987],{31222:(e,s,t)=>{t.r(s),t.d(s,{default:()=>i});const l={props:["model","label","rule","meta","do_render"],mounted(){this.uploadList=void 0!==this.$refs.upload.fileList?this.$refs.upload.fileList:[]},data:()=>({defaultList:[],uploadList:[],showImage:!1,showImageUrl:""}),watch:{"model.form"(e){let s=e[this.model.component];if(void 0!==this.meta.file.isMultiple&&this.meta.file.isMultiple)if("string"==typeof s&&void 0!==s&&null!=s){let e=JSON.parse(this.model.form[this.model.component]);Array.isArray(e)&&(this.defaultList=e.map((e=>({status:"finished",response:e.response,name:e.name}))),this.$nextTick((()=>{this.uploadList=this.$refs.upload.fileList})))}else this.$refs.upload.fileList=[],this.uploadList=[],this.model.form[this.model.component]=null}},methods:{handleView(e){this.showImage=!0,this.showImageUrl=e},success(e){console.log(e),this.meta.file.isMultiple?(this.uploadList=this.$refs.upload.fileList,this.model.form[this.model.component]=JSON.stringify(this.uploadList.map((e=>({name:e.name,response:e.response}))))):this.model.form[this.model.component]=e},handleRemove(e){const s=this.$refs.upload.fileList;this.$refs.upload.fileList.splice(s.indexOf(e),1),this.uploadList=this.$refs.upload.fileList,this.model.form[this.model.component]=this.uploadList.map((e=>({name:e.name,response:e.response})))},beforeUpload(){}}};const i=(0,t(51900).Z)(l,(function(){var e=this,s=e.$createElement,t=e._self._c||s;return t("FormItem",{attrs:{prop:e.rule}},[e.meta.file&&1==e.meta.file.isMultiple?t("div",{staticClass:"multi-upload"},[t("label",[e._v(e._s(e.label))]),e._v(" "),t("div",{staticClass:"multi-upload-list"},[e._l(e.uploadList,(function(s){return t("div",{key:s.index,staticClass:"upload-list"},["finished"==s.status?[s.response?t("img",{attrs:{src:s.response},on:{click:function(t){return e.handleView(s.response)}}}):e._e(),e._v(" "),t("div",{directives:[{name:"show",rawName:"v-show",value:!e.meta||!e.meta.disabled,expression:"meta && meta.disabled ? false : true"}],staticClass:"upload-control",on:{click:function(t){return e.handleRemove(s)}}},[e._v("Устгах")])]:[s.showProgress?t("Progress",{attrs:{percent:s.percentage,"hide-info":""}}):e._e()]],2)})),e._v(" "),t("Upload",{ref:"upload",attrs:{multiple:"","with-credentials":!0,action:"/lambda/krud/upload","show-upload-list":!1,"default-file-list":e.defaultList,"on-success":e.success,"before-upload":e.beforeUpload,disabled:!(!e.meta||!e.meta.disabled)&&e.meta.disabled}},[t("div",{staticClass:"upload-handler"},[t("i",{staticClass:"ti ti-camera"})])])],2)]):t("Upload",{ref:"upload",attrs:{"with-credentials":!0,action:"/lambda/krud/upload","on-success":e.success,disabled:!(!e.meta||!e.meta.disabled)&&e.meta.disabled},model:{value:e.model.form[e.model.component],callback:function(s){e.$set(e.model.form,e.model.component,s)},expression:"model.form[model.component]"}},[t("Button",{attrs:{type:"dashed"}},[null!=this.model.form[this.model.component]?t("img",{staticClass:"preview-img",attrs:{src:this.model.form[this.model.component],alt:"image"}}):e._e(),e._v(" "),t("div",[t("i",{staticClass:"ti ti-camera"}),e._v("\n                "+e._s(e.label)+"\n            ")])])],1),e._v(" "),t("Modal",{attrs:{title:"Зураг харах",width:"1000px"},model:{value:e.showImage,callback:function(s){e.showImage=s},expression:"showImage"}},[e.showImage?t("img",{staticStyle:{width:"100%"},attrs:{src:e.showImageUrl}}):e._e()])],1)}),[],!1,null,null,null).exports}}]);