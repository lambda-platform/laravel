(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_assets_web_js_pages_web_apartment-detail_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/apartment-detail.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/apartment-detail.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************************************************/
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
  name: "apartment-detail",
  data: function data() {
    return {
      loading: true,
      data: null,
      detail: null,
      related: [],
      imgs: []
    };
  },
  created: function created() {
    this.getData();
  },
  methods: {
    getData: function getData() {
      var _this = this;

      this.loading = true;
      this.data = null;
      this.related = [];
      this.imgs = [];
      this.detail = null;
      axios.post("/getosdetail/" + this.$route.params.id).then(function (_ref) {
        var data = _ref.data;
        console.log(data);
        _this.data = data.barilga;
        _this.related = data.related;
        _this.imgs = data.imgs;
        _this.detail = data.detail;
        _this.loading = false;
      });
    },
    renderImg: function renderImg(path) {
      if (path == null) return {
        'background-image': 'url("/assets/zipcode/images/unnamed.png")'
      };
      return {
        'background': 'url("' + path.replace(/\\/g, '/') + '")'
      };
    }
  }
});

/***/ }),

/***/ "./resources/assets/web/js/pages/web/apartment-detail.vue":
/*!****************************************************************!*\
  !*** ./resources/assets/web/js/pages/web/apartment-detail.vue ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _apartment_detail_vue_vue_type_template_id_e763026e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./apartment-detail.vue?vue&type=template&id=e763026e&scoped=true& */ "./resources/assets/web/js/pages/web/apartment-detail.vue?vue&type=template&id=e763026e&scoped=true&");
/* harmony import */ var _apartment_detail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./apartment-detail.vue?vue&type=script&lang=js& */ "./resources/assets/web/js/pages/web/apartment-detail.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _apartment_detail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _apartment_detail_vue_vue_type_template_id_e763026e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _apartment_detail_vue_vue_type_template_id_e763026e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "e763026e",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/web/js/pages/web/apartment-detail.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/assets/web/js/pages/web/apartment-detail.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************!*\
  !*** ./resources/assets/web/js/pages/web/apartment-detail.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_apartment_detail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./apartment-detail.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/apartment-detail.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_apartment_detail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/assets/web/js/pages/web/apartment-detail.vue?vue&type=template&id=e763026e&scoped=true&":
/*!***********************************************************************************************************!*\
  !*** ./resources/assets/web/js/pages/web/apartment-detail.vue?vue&type=template&id=e763026e&scoped=true& ***!
  \***********************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_apartment_detail_vue_vue_type_template_id_e763026e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_apartment_detail_vue_vue_type_template_id_e763026e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_apartment_detail_vue_vue_type_template_id_e763026e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./apartment-detail.vue?vue&type=template&id=e763026e&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/apartment-detail.vue?vue&type=template&id=e763026e&scoped=true&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/apartment-detail.vue?vue&type=template&id=e763026e&scoped=true&":
/*!**************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/apartment-detail.vue?vue&type=template&id=e763026e&scoped=true& ***!
  \**************************************************************************************************************************************************************************************************************************************************/
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
    _c("div", { staticClass: "slim-pageheader" }, [
      _vm._m(0),
      _vm._v(" "),
      _vm.data
        ? _c("h6", { staticClass: "slim-pagetitle" }, [
            _vm._v(_vm._s(_vm.data.hothonner) + " - " + _vm._s(_vm.data.ner))
          ])
        : _vm._e()
    ]),
    _vm._v(" "),
    _vm.loading
      ? _c("div", [
          _c(
            "div",
            {
              staticStyle: {
                "text-align": "center",
                height: "300px",
                "padding-top": "140px"
              }
            },
            [_vm._v("\n            Түр хүлээнэ үү ...\n        ")]
          )
        ])
      : _c("div", { staticClass: "row row-sm" }, [
          _c("div", { staticClass: "col-md-8" }, [
            _c("div", { staticClass: "card" }, [
              _c("div", { staticClass: "detail-media" }, [
                _c(
                  "section",
                  { staticClass: "barilga-detail" },
                  [
                    _c(
                      "el-carousel",
                      { attrs: { "indicator-position": "outside" } },
                      _vm._l(_vm.imgs, function(item) {
                        return _vm.imgs.length > 0
                          ? _c("el-carousel-item", { key: item.id }, [
                              _c("div", { staticClass: "img-item" }, [
                                _c("img", {
                                  attrs: {
                                    src: item.path
                                      ? item.path
                                      : "/assets/zipcode/images/unnamed.png",
                                    alt: ""
                                  }
                                }),
                                _vm._v(" "),
                                _c("h3", [_vm._v(_vm._s(item.desc))])
                              ])
                            ])
                          : _c("el-carousel-item", [
                              _c("div", { staticClass: "img-item" }, [
                                _c("img", {
                                  attrs: {
                                    src: "/assets/zipcode/images/unnamed.png",
                                    alt: ""
                                  }
                                }),
                                _vm._v(" "),
                                _c("h3", [_vm._v("Зураг олдсонгүй")])
                              ])
                            ])
                      }),
                      1
                    )
                  ],
                  1
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "detail-info" }, [
                _c("div", { staticClass: "zar-detail" }, [
                  _c("small", [
                    _vm._v(
                      _vm._s(_vm.data.aimag) +
                        ", " +
                        _vm._s(_vm.data.soum) +
                        ", " +
                        _vm._s(_vm.data.bag ? _vm.data.bag : "")
                    )
                  ]),
                  _c("br"),
                  _vm._v(" "),
                  _c("small", [_vm._v(_vm._s(_vm.data.delgerengui))]),
                  _vm._v(" "),
                  _c("br"),
                  _vm._v(" "),
                  _c("small", [
                    _vm._v(
                      "Холбоо барих:" +
                        _vm._s(_vm.data.borluulaltBagUtas) +
                        ", " +
                        _vm._s(_vm.data.borluulatiinBagEmail)
                    )
                  ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "info-row clearfix" }, [
                  _c("div", { staticClass: "row" }, [
                    _c(
                      "div",
                      { staticClass: "col-md-8 col-sm-12 info-section" },
                      [
                        _c("h4", [_vm._v("Үндсэн мэдээлэл")]),
                        _vm._v(" "),
                        _c(
                          "table",
                          { staticClass: "table table-small table-striped" },
                          [
                            _c("tbody", [
                              _c("tr", [
                                _c("td", [_vm._v("Хотхон")]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(_vm.data.hothonner))])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Нэр")]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(_vm.data.ner))])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Зэрэглэл")]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(_vm.data.zereglel))])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Барилгын хийц")]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(_vm.data.hiits_id))])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Захиалагч")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(_vm._s(_vm.data.zahialach_ner))
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Гүйцэтгэгч")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(_vm._s(_vm.data.guitsetgegch))
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Хотын төвөөс")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(
                                    _vm._s(_vm.data.fromCityCenter) + " км"
                                  )
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Сургууль зай")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(_vm._s(_vm.data.fromSchool) + " км")
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Цэцэрлэг зай")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(
                                    _vm._s(_vm.data.fromKindergarden) + " км"
                                  )
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Дэлгүүр зай")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(_vm._s(_vm.data.fromShop) + " км")
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Тээврийн үйлчилгээ зай")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(_vm._s(_vm.data.fromBus) + " км")
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Худалдааны төв зай")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(
                                    _vm._s(_vm.data.fromShopingCenter) + " км"
                                  )
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Нийт айлын тоо")]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(_vm.data.ail_too))])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Давхар")]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(_vm.data.davhar_too))])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("1 өрөө")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(
                                    _vm._s(
                                      _vm.data.uruu_1 ? _vm.data.uruu_1 : 0
                                    )
                                  )
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("2 өрөө")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(
                                    _vm._s(
                                      _vm.data.uruu_2 ? _vm.data.uruu_2 : 0
                                    )
                                  )
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("3 өрөө")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(
                                    _vm._s(
                                      _vm.data.uruu_3 ? _vm.data.uruu_3 : 0
                                    )
                                  )
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("4 өрөө")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(
                                    _vm._s(
                                      _vm.data.uruu_4 ? _vm.data.uruu_4 : 0
                                    )
                                  )
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("5 өрөө")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(
                                    _vm._s(
                                      _vm.data.uruu_5 ? _vm.data.uruu_5 : 0
                                    )
                                  )
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("6,7 өрөө")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(
                                    _vm._s(
                                      _vm.data.uruu_6_7 ? _vm.data.uruu_6_7 : 0
                                    )
                                  )
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Дуплекс")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(
                                    _vm._s(
                                      _vm.data.duplex ? _vm.data.duplex : 0
                                    )
                                  )
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Дулаан зогссол")]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(_vm.data.dulaanz_too))])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Гаднах зогсоол")]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(_vm.data.gadnaz_too))])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Агаарын бохирдол")]),
                                _vm._v(" "),
                                _c("td", [_vm._v(_vm._s(_vm.data.airPolution))])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Газар хөдлөлтын бүс")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm._v(_vm._s(_vm.data.earthQuick) + " балл")
                                ])
                              ])
                            ])
                          ]
                        )
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        staticClass: "col-md-4 col-sm-12 info-section",
                        staticStyle: { "padding-right": "20px" }
                      },
                      [
                        _c("h4", [_vm._v("Нэмэлт мэдээлэл")]),
                        _vm._v(" "),
                        _c(
                          "table",
                          {
                            staticClass: "table table-small table-striped full"
                          },
                          [
                            _c("tbody", [
                              _c("tr", [
                                _c("td", [_vm._v("Камержуулалттай эсэх")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm.detail.is_camera == 1
                                    ? _c("i", {
                                        staticClass: "ti-check text-success"
                                      })
                                    : _c("i", {
                                        staticClass: "ti-close text-danger"
                                      })
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [
                                  _vm._v("24 цаг нэвтрэх боломжтой эсэх")
                                ]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm.data.is_24 == 1
                                    ? _c("i", {
                                        staticClass: "ti-check text-success"
                                      })
                                    : _c("i", {
                                        staticClass: "ti-close text-danger"
                                      })
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Нэгдсэн ресепшинтэй эсэх")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm.data.is_reception == 1
                                    ? _c("i", {
                                        staticClass: "ti-check text-success"
                                      })
                                    : _c("i", {
                                        staticClass: "ti-close text-danger"
                                      })
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [
                                  _vm._v("Нэгдсэн цэвэрлэгээтэй эсэх")
                                ]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm.data.is_tseverlegee == 1
                                    ? _c("i", {
                                        staticClass: "ti-check text-success"
                                      })
                                    : _c("i", {
                                        staticClass: "ti-close text-danger"
                                      })
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Дулаан гаражтай эсэх")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm.data.is_garage == 1
                                    ? _c("i", {
                                        staticClass: "ti-check text-success"
                                      })
                                    : _c("i", {
                                        staticClass: "ti-close text-danger"
                                      })
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Тоглоомын талбайтай эсэх")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm.data.is_togloom == 1
                                    ? _c("i", {
                                        staticClass: "ti-check text-success"
                                      })
                                    : _c("i", {
                                        staticClass: "ti-close text-danger"
                                      })
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [
                                  _vm._v(
                                    "Ашиглалтын шаардлага хангахгүй болсон"
                                  )
                                ]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm.data.is_shaard_hangahgui == 1
                                    ? _c("i", {
                                        staticClass: "ti-check text-success"
                                      })
                                    : _c("i", {
                                        staticClass: "ti-close text-danger"
                                      })
                                ])
                              ]),
                              _vm._v(" "),
                              _c("tr", [
                                _c("td", [_vm._v("Хурлын өрөө")]),
                                _vm._v(" "),
                                _c("td", [
                                  _vm.data.is_hural_uruu == 1
                                    ? _c("i", {
                                        staticClass: "ti-check text-success"
                                      })
                                    : _c("i", {
                                        staticClass: "ti-close text-danger"
                                      })
                                ])
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
                          attrs: { href: "/#/apartmentdetail/" + item.id }
                        },
                        [
                          _c(
                            "div",
                            { staticClass: "pull-left listings-grid__main" },
                            [
                              _c("div", {
                                staticClass: "list-thumb",
                                style: _vm.renderImg(item.bimage)
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
                                      height: "16px",
                                      overflow: "hidden"
                                    }
                                  },
                                  [
                                    _vm._v(
                                      "\n                                    " +
                                        _vm._s(item.hothonner) +
                                        " - " +
                                        _vm._s(item.ner) +
                                        "\n                                "
                                    )
                                  ]
                                ),
                                _vm._v(" "),
                                _c("small", [
                                  _c("i", { staticClass: "ti-location-pin" }),
                                  _vm._v(
                                    "\n                                    " +
                                      _vm._s(item.aimag) +
                                      ","
                                  ),
                                  _c("br"),
                                  _vm._v(
                                    " " +
                                      _vm._s(item.soum) +
                                      ", " +
                                      _vm._s(item.bag) +
                                      "\n                                "
                                  )
                                ])
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "div",
                              {
                                staticClass: "listings-grid__attrs",
                                staticStyle: { padding: "10px" }
                              },
                              [
                                _c("small", [
                                  _c("i", { staticClass: "ti-view-grid" }),
                                  _vm._v(
                                    "\n                                    " +
                                      _vm._s(item.ail_too) +
                                      " айл\n                                "
                                  )
                                ]),
                                _vm._v(" "),
                                _c("small", [
                                  _c("i", { staticClass: "ti-ruler" }),
                                  _vm._v(
                                    " " +
                                      _vm._s(item.davhar_too) +
                                      " давхар\n                                "
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
    return _c("ol", { staticClass: "breadcrumb slim-breadcrumb" }, [
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
        [_vm._v("Барилгын дэлгэрэнгүй")]
      )
    ])
  }
]
render._withStripped = true



/***/ })

}]);