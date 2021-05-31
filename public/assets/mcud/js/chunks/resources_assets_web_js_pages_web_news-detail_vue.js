(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_assets_web_js_pages_web_news-detail_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/news-detail.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/news-detail.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      medee: window.init.medee
    };
  },
  created: function created() {//  this.getData();
  },
  methods: {
    getData: function getData() {
      var _this = this;

      this.loading = true;
      axios.get("/getNewsDetail/" + this.$route.params.id).then(function (_ref) {
        var data = _ref.data;
        _this.data = data;
        _this.loading = false;
      });
    },
    customGetDate: function customGetDate(d) {
      if (d) return d.substring(0, 10);
      return '';
    },
    renderImg: function renderImg(path) {
      return 'background-image' + ':' + 'url("' + path.replace(/\\/g, '/') + '")';
    },
    choosePoster: function choosePoster(item) {
      this.$router.push('posterdetail/' + item.id);
    }
  }
});

/***/ }),

/***/ "./resources/assets/web/js/pages/web/news-detail.vue":
/*!***********************************************************!*\
  !*** ./resources/assets/web/js/pages/web/news-detail.vue ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _news_detail_vue_vue_type_template_id_7dc4eb9e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./news-detail.vue?vue&type=template&id=7dc4eb9e& */ "./resources/assets/web/js/pages/web/news-detail.vue?vue&type=template&id=7dc4eb9e&");
/* harmony import */ var _news_detail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./news-detail.vue?vue&type=script&lang=js& */ "./resources/assets/web/js/pages/web/news-detail.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _news_detail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _news_detail_vue_vue_type_template_id_7dc4eb9e___WEBPACK_IMPORTED_MODULE_0__.render,
  _news_detail_vue_vue_type_template_id_7dc4eb9e___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/web/js/pages/web/news-detail.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/assets/web/js/pages/web/news-detail.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/assets/web/js/pages/web/news-detail.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_news_detail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./news-detail.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/news-detail.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_news_detail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/assets/web/js/pages/web/news-detail.vue?vue&type=template&id=7dc4eb9e&":
/*!******************************************************************************************!*\
  !*** ./resources/assets/web/js/pages/web/news-detail.vue?vue&type=template&id=7dc4eb9e& ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_news_detail_vue_vue_type_template_id_7dc4eb9e___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_news_detail_vue_vue_type_template_id_7dc4eb9e___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_news_detail_vue_vue_type_template_id_7dc4eb9e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./news-detail.vue?vue&type=template&id=7dc4eb9e& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/news-detail.vue?vue&type=template&id=7dc4eb9e&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/news-detail.vue?vue&type=template&id=7dc4eb9e&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/news-detail.vue?vue&type=template&id=7dc4eb9e& ***!
  \*********************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "container" }, [
    _vm._m(0),
    _vm._v(" "),
    _c("div", { staticClass: "section-wrapper" }, [
      _c("label", { staticClass: "section-title" }, [
        _vm._v(_vm._s(_vm.medee.type))
      ]),
      _vm._v(" "),
      _c("p", { staticClass: "mg-b-20 mg-sm-b-40" }, [
        _vm._v(_vm._s(_vm.medee.title))
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "mg-t-20" }, [
        _c("div", { staticClass: "row" }, [
          _c("div", {
            staticStyle: { width: "100%" },
            domProps: { innerHTML: _vm._s(_vm.medee.body) }
          })
        ])
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "slim-pageheader" }, [
      _c("ol", { staticClass: "breadcrumb slim-breadcrumb" }, [
        _c("li", { staticClass: "breadcrumb-item" }, [
          _c("a", { attrs: { href: "/#/index" } }, [_vm._v("Нүүр")])
        ]),
        _vm._v(" "),
        _c(
          "li",
          {
            staticClass: "breadcrumb-item active",
            attrs: { "aria-current": "page" }
          },
          [_vm._v("Мэдээ мэдээлэл")]
        )
      ]),
      _vm._v(" "),
      _c("h6", { staticClass: "slim-pagetitle" }, [_vm._v("Мэдээ мэдээлэл")])
    ])
  }
]
render._withStripped = true



/***/ })

}]);