(self.webpackChunk=self.webpackChunk||[]).push([[241],{7241:(t,a,e)=>{"use strict";e.r(a),e.d(a,{default:()=>l});const i={name:"apartments",data:function(){return{filter:{aimag:22,sum:null,zereglel:null,area:null,room:null,price:null,type:null,year:2020},data:window.init.data,sumlist:window.init.data.sum,loading:!0,datas:[],paginate:{currentPage:1,paginate:12,total:0}}},created:function(){this.filterData(1)},methods:{filterData:function(t){var a=this;this.loading=!0,this.datas=[],axios.post("/getoslist?page="+t,this.filter).then((function(t){var e=t.data;console.log(e),a.datas=e.data,a.paginate.total=e.total,a.paginate.currentPage=e.current_page,a.loading=!1}))},aimagChanges:function(t){var a=this;this.sumlist=[],axios.get("/sumlist/"+t).then((function(t){a.sumlist=t.data})).catch((function(t){console.log(t.message)}))},sumChanges:function(t){var a=this;axios.get("/getbaghoroo/"+t).then((function(t){a.baglist=t.data})).catch((function(t){console.log(t.message)}))},renderImg:function(t){return null==t?{"background-image":'url("/assets/zipcode/images/unnamed.png")'}:{background:'url("'+t.replace(/\\/g,"/")+'")'}}}};const l=(0,e(1900).Z)(i,(function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"container"},[t._m(0),t._v(" "),e("div",{staticClass:"row row-sm"},[e("div",{staticClass:"col-md-4 col-lg-3"},[e("div",{staticClass:"filter"},[e("el-form",{ref:"ruleForm",attrs:{id:"filterFrm",model:t.filter,"label-position":"top"}},[e("div",{staticClass:"card card-body pd-10 mg-t-10"},[e("el-form-item",{attrs:{label:"Аймаг/Нийслэл сонгох"}},[e("el-select",{attrs:{placeholder:"Сонгоно уу"},on:{change:t.aimagChanges},model:{value:t.filter.aimag,callback:function(a){t.$set(t.filter,"aimag",a)},expression:"filter.aimag"}},t._l(t.data.aimag,(function(t){return e("el-option",{key:t.id,attrs:{label:t.ner,value:t.id}})})),1)],1),t._v(" "),e("el-form-item",{attrs:{label:"Сум/Дүүрэг сонгох"}},[e("el-select",{attrs:{placeholder:"Сонгоно уу"},model:{value:t.filter.sum,callback:function(a){t.$set(t.filter,"sum",a)},expression:"filter.sum"}},t._l(t.sumlist,(function(t){return e("el-option",{key:t.id,attrs:{label:t.ner,value:t.id}})})),1)],1),t._v(" "),e("el-divider"),t._v(" "),e("el-form-item",{attrs:{label:"Огноо"}},[e("el-select",{attrs:{disabled:"",placeholder:"Сонгоно уу"},model:{value:t.filter.year,callback:function(a){t.$set(t.filter,"year",a)},expression:"filter.year"}},t._l(t.data.year,(function(t){return e("el-option",{key:t.id,attrs:{label:t.ner,value:t.ner}})})),1)],1),t._v(" "),e("br"),t._v(" "),e("el-form-item",{staticClass:"sbm-btn"},[e("el-button",{attrs:{type:"primary",icon:"el-icon-search"},on:{click:function(a){return t.filterData(1)}}},[t._v("ШҮҮХ\n                            ")])],1)],1)])],1)]),t._v(" "),e("div",{staticClass:"col-md-8 col-lg-9 listings-list"},[t._v("\n            Нийт илэрц: "+t._s(t.paginate.total)+" барилга /Ашиглалтад орсон, захиалга авч буй/\n            "),t.loading?e("div",[e("div",{staticStyle:{"text-align":"center",height:"300px","padding-top":"140px"}},[t._v("\n                    Түр хүлээнэ үү ...\n                ")])]):t.loading||0!=t.datas.length?t.datas.length>0?t._l(t.datas,(function(a){return e("div",{key:a.id,staticClass:"listings-grid__item"},[e("a",{staticClass:"media",attrs:{href:"/#/apartmentdetail/"+a.id}},[e("div",{staticClass:"pull-left listings-grid__main"},[e("div",{staticClass:"list-thumb",style:t.renderImg(a.bimage)})]),t._v(" "),e("div",{staticClass:"media-body"},[e("div",{staticClass:"listings-grid__body"},[e("small",[e("i",{staticClass:"ti-location-pin"}),t._v("\n                                "+t._s(a.aimag)+", "+t._s(a.soum)+", "+t._s(a.bag)+"\n                            ")]),t._v(" "),e("h5",[t._v("\n                                "+t._s(a.hothonner)+" - "+t._s(a.ner)+"\n                            ")])]),t._v(" "),e("ul",{staticClass:"listings-grid__attrs"},[e("li",[e("i",{staticClass:"ti-time"}),t._v("\n                                "+t._s(a.updated_at)+"\n                            ")]),t._v(" "),e("li",[e("i",{staticClass:"ti-view-grid"}),t._v("\n                                "+t._s(a.ail_too)+" айл\n                            ")]),t._v(" "),e("li",[e("i",{staticClass:"ti-ruler"}),t._v("  "+t._s(a.davhar_too)+" давхар\n                            ")])])])])])})):t._e():e("div",[e("div",{staticStyle:{"text-align":"center",height:"300px","padding-top":"140px"}},[t._v("\n                    Үр дүн олдсонгүй\n                ")])]),t._v(" "),e("div",{staticStyle:{"text-align":"center"}},[e("el-pagination",{attrs:{background:"",layout:"total, prev, pager, next",total:t.paginate.total,"page-size":12},on:{"current-change":t.filterData}})],1)],2)])])}),[function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"slim-pageheader"},[e("ol",{staticClass:"breadcrumb slim-breadcrumb"},[e("li",{staticClass:"breadcrumb-item"},[e("a",{attrs:{href:"/#/index"}},[t._v("Нүүр")])]),t._v(" "),e("li",{staticClass:"breadcrumb-item active",attrs:{"aria-current":"page"}},[t._v("Барилгын жагсаалт")])]),t._v(" "),e("h6",{staticClass:"slim-pagetitle"},[t._v("Барилгын мэдээлэл жагсаалт")])])}],!1,null,null,null).exports}}]);