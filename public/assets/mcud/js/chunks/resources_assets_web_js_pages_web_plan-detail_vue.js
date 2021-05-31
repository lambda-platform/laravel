(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_assets_web_js_pages_web_plan-detail_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/plan-detail.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/plan-detail.vue?vue&type=script&lang=js& ***!
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
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      plan: {},
      related: []
    };
  },
  created: function created() {
    this.getData();
  },
  methods: {
    getData: function getData() {
      var _this = this;

      this.loading = true;
      axios.post("/getplandetail/" + this.$route.params.id).then(function (_ref) {
        var data = _ref.data;
        _this.plan = data.plan;
        _this.related = data.related;
        _this.loading = false;
      });
    },
    customGetDate: function customGetDate(d) {
      return d.substring(0, 10);
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

/***/ "./resources/assets/web/js/pages/web/plan-detail.vue":
/*!***********************************************************!*\
  !*** ./resources/assets/web/js/pages/web/plan-detail.vue ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _plan_detail_vue_vue_type_template_id_8e5d0cf0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./plan-detail.vue?vue&type=template&id=8e5d0cf0& */ "./resources/assets/web/js/pages/web/plan-detail.vue?vue&type=template&id=8e5d0cf0&");
/* harmony import */ var _plan_detail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./plan-detail.vue?vue&type=script&lang=js& */ "./resources/assets/web/js/pages/web/plan-detail.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _plan_detail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _plan_detail_vue_vue_type_template_id_8e5d0cf0___WEBPACK_IMPORTED_MODULE_0__.render,
  _plan_detail_vue_vue_type_template_id_8e5d0cf0___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/web/js/pages/web/plan-detail.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/assets/web/js/pages/web/plan-detail.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/assets/web/js/pages/web/plan-detail.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_plan_detail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./plan-detail.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/plan-detail.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_plan_detail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/assets/web/js/pages/web/plan-detail.vue?vue&type=template&id=8e5d0cf0&":
/*!******************************************************************************************!*\
  !*** ./resources/assets/web/js/pages/web/plan-detail.vue?vue&type=template&id=8e5d0cf0& ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_plan_detail_vue_vue_type_template_id_8e5d0cf0___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_plan_detail_vue_vue_type_template_id_8e5d0cf0___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_plan_detail_vue_vue_type_template_id_8e5d0cf0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./plan-detail.vue?vue&type=template&id=8e5d0cf0& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/plan-detail.vue?vue&type=template&id=8e5d0cf0&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/plan-detail.vue?vue&type=template&id=8e5d0cf0&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/plan-detail.vue?vue&type=template&id=8e5d0cf0& ***!
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
    _c("div", { staticClass: "row row-sm" }, [
      _c("div", { staticClass: "col-md-8" }, [
        _c("div", { staticClass: "card" }, [
          _c("div", { staticClass: "detail-media" }, [
            _c("img", {
              attrs: {
                src: _vm.plan.image
                  ? _vm.plan.image
                  : "/assets/mcud/images/no-image.jpg",
                width: "100%"
              }
            })
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "detail-info" }, [
            _c("div", { staticClass: "zar-detail" }, [
              _vm._v(
                "\n                        " +
                  _vm._s(_vm.plan.name) +
                  "\n                        "
              ),
              _c("br"),
              _vm._v(" "),
              _c("h4", [
                _c(
                  "a",
                  {
                    attrs: {
                      href: "/#/plandownload/" + _vm.plan.id,
                      target: "_blank"
                    }
                  },
                  [_vm._v("Файл татах холбоос")]
                )
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "info-row clearfix" }, [
              _c("div", { staticClass: "row" }, [
                _c(
                  "div",
                  {
                    staticClass: "col-md-12 col-sm-12 info-section",
                    staticStyle: { padding: "40px" }
                  },
                  [
                    _c("h4", [_vm._v("Зургийн ерөнхий мэдээлэл")]),
                    _vm._v(" "),
                    _c(
                      "table",
                      { staticClass: "table table-striped table-small" },
                      [
                        _c("tbody", [
                          _c("tr", [
                            _c("td", [_vm._v("Захиалагч")]),
                            _vm._v(" "),
                            _c("td", [_vm._v(_vm._s(_vm.plan.zahialagch_comp))])
                          ]),
                          _vm._v(" "),
                          _c("tr", [
                            _c("td", [_vm._v("Захиалагч нэр")]),
                            _vm._v(" "),
                            _c("td", [_vm._v(_vm._s(_vm.plan.zahialagch_name))])
                          ]),
                          _vm._v(" "),
                          _c("tr", [
                            _c("td", [_vm._v("Гүйцэтгэгч")]),
                            _vm._v(" "),
                            _c("td", [
                              _vm._v(_vm._s(_vm.plan.guitsetgegch_comp))
                            ])
                          ]),
                          _vm._v(" "),
                          _c("tr", [
                            _c("td", [_vm._v("Гүйцэтгэгч нэр")]),
                            _vm._v(" "),
                            _c("td", [
                              _vm._v(_vm._s(_vm.plan.guitsetsgegch_name))
                            ])
                          ]),
                          _vm._v(" "),
                          _c("tr", [
                            _c("td", [_vm._v("Үзсэн тоо")]),
                            _vm._v(" "),
                            _c("td", [_vm._v(_vm._s(_vm.plan.viewed))])
                          ]),
                          _vm._v(" "),
                          _c("tr", [
                            _c("td", [_vm._v("Татагдсан тоо")]),
                            _vm._v(" "),
                            _c("td", [_vm._v(_vm._s(_vm.plan.downloaded))])
                          ]),
                          _vm._v(" "),
                          _c("tr", [
                            _c("td", [_vm._v("Файлын төрөл")]),
                            _vm._v(" "),
                            _c("td", [_vm._v(_vm._s(_vm.plan.file_type))])
                          ])
                        ])
                      ]
                    ),
                    _vm._v(" "),
                    _c("h4", [_vm._v("АОС-ны мэдээлэл")]),
                    _vm._v(" "),
                    _c(
                      "table",
                      { staticClass: "table table-striped table-small" },
                      [
                        _c("tbody", [
                          _c("tr", [
                            _c("td", [_vm._v("Хийц")]),
                            _vm._v(" "),
                            _c("td", [_vm._v(_vm._s(_vm.plan.hiits))])
                          ]),
                          _vm._v(" "),
                          _c("tr", [
                            _c("td", [_vm._v("Давхарын тоо")]),
                            _vm._v(" "),
                            _c("td", [_vm._v(_vm._s(_vm.plan.davhar))])
                          ]),
                          _vm._v(" "),
                          _c("tr", [
                            _c("td", [_vm._v("Өрөөний тоо")]),
                            _vm._v(" "),
                            _c("td", [_vm._v(_vm._s(_vm.plan.uruu_too))])
                          ]),
                          _vm._v(" "),
                          _c("tr", [
                            _c("td", [_vm._v("Талбайн хэмжээ")]),
                            _vm._v(" "),
                            _c("td", [_vm._v(_vm._s(_vm.plan.mkv) + "мкв")])
                          ]),
                          _vm._v(" "),
                          _c("tr", [
                            _c("td", [_vm._v("АЦ өрөөний тоо")]),
                            _vm._v(" "),
                            _c("td", [_vm._v(_vm._s(_vm.plan.ats_uruu))])
                          ])
                        ])
                      ]
                    )
                  ]
                )
              ])
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-md-4" }, [
        _c(
          "div",
          { staticClass: "listings-list listings-list similar-list" },
          _vm._l(_vm.related, function(item) {
            return _vm.related.length > 0
              ? _c("div", { staticClass: "listings-grid__item" }, [
                  _c(
                    "a",
                    {
                      staticClass: "media",
                      attrs: { href: "/#/plandetail/" + item.id }
                    },
                    [
                      _c(
                        "div",
                        { staticClass: "pull-left listings-grid__main" },
                        [
                          _c("div", {
                            staticClass: "list-thumb",
                            style: _vm.renderImg(item.image)
                          })
                        ]
                      ),
                      _vm._v(" "),
                      _c("div", { staticClass: "media-body" }, [
                        _c(
                          "div",
                          {
                            staticClass: "listings-grid__body",
                            staticStyle: {
                              padding: "10px 5px 5px 5px!important"
                            }
                          },
                          [
                            _c(
                              "h5",
                              {
                                staticStyle: {
                                  height: "45px",
                                  overflow: "hidden"
                                }
                              },
                              [
                                _vm._v(
                                  "\n                                    " +
                                    _vm._s(item.name) +
                                    "\n                                "
                                )
                              ]
                            )
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "ul",
                          {
                            staticClass: "listings-grid__attrs",
                            staticStyle: { padding: "10px" }
                          },
                          [
                            _c("li", [
                              _c("i", { staticClass: "ti-view-list" }),
                              _vm._v(
                                "\n                                " +
                                  _vm._s(item.davhar) +
                                  " давхар\n                            "
                              )
                            ]),
                            _vm._v(" "),
                            _c("li", [
                              _c("i", { staticClass: "ti-ruler" }),
                              _vm._v(
                                " " +
                                  _vm._s(item.mkv) +
                                  " мкв\n                            "
                              )
                            ])
                          ]
                        )
                      ])
                    ]
                  )
                ])
              : _vm._e()
          }),
          0
        )
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
          _c("a", { attrs: { href: "/" } }, [_vm._v("Нүүр")])
        ]),
        _vm._v(" "),
        _c(
          "li",
          {
            staticClass: "breadcrumb-item active",
            attrs: { "aria-current": "page" }
          },
          [_vm._v("Амины орон сууцны зураг төсөл")]
        )
      ])
    ])
  }
]
render._withStripped = true



/***/ })

}]);