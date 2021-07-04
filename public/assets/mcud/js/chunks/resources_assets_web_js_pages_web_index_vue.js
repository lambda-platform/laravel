(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_assets_web_js_pages_web_index_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/index.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/index.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************************************************/
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
var chartData = [];
var chartLabel = [];
var ctx2 = null;
var ctx3 = null;
var monthChart = null;
var monthChart1 = null;
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      filter: {
        aimag: 22,
        sum: null,
        zereglel: null,
        area: null,
        room: null,
        price: null,
        type: null,
        year: 2018
      },
      sumlist: window.init.data.sum,
      baglist: [],
      data: window.init.data // duuregData: [parseFloat(window.init.data.duureg['137'] ? window.init.data.duureg['137'] : 0).toFixed(0),
      // parseFloat(window.init.data.duureg['335'] ? window.init.data.duureg['335'] : 0).toFixed(0),
      // parseFloat(window.init.data.duureg['337'] ? window.init.data.duureg['337'] : 0).toFixed(0),
      // parseFloat(window.init.data.duureg['334'] ? window.init.data.duureg['334'] : 0).toFixed(0),
      // parseFloat(window.init.data.duureg['336'] ? window.init.data.duureg['336'] : 0).toFixed(0),
      // parseFloat(window.init.data.duureg['138']? window.init.data.duureg['138'] : 0).toFixed(0),
      // parseFloat(window.init.data.duureg['136'] ? window.init.data.duureg['136'] : 0).toFixed(0),
      // parseFloat(window.init.data.duureg['135'] ? window.init.data.duureg['135'] : 0).toFixed(0),
      // parseFloat(window.init.data.duureg['157'] ? window.init.data.duureg['157'] : 0).toFixed(0)]

    };
  },
  mounted: function mounted() {
    var _this = this;

    this.$nextTick(function () {
      var rs3 = new Rickshaw.Graph({
        element: document.querySelector('#rs3'),
        renderer: 'line',
        series: [{
          data: [{
            x: 0,
            y: 5
          }, {
            x: 1,
            y: 7
          }, {
            x: 2,
            y: 10
          }, {
            x: 3,
            y: 11
          }, {
            x: 4,
            y: 12
          }, {
            x: 5,
            y: 10
          }, {
            x: 6,
            y: 9
          }, {
            x: 7,
            y: 7
          }, {
            x: 8,
            y: 6
          }, {
            x: 9,
            y: 8
          }, {
            x: 10,
            y: 9
          }, {
            x: 11,
            y: 10
          }, {
            x: 12,
            y: 7
          }, {
            x: 13,
            y: 10
          }],
          color: '#1B84E7'
        }]
      });
      rs3.render(); // Responsive Mode

      new ResizeSensor($('.slim-mainpanel'), function () {
        rs3.configure({
          width: $('#rs3').width(),
          height: $('#rs3').height()
        });
        rs3.render();
      });

      _this.init();
    });
  },
  methods: {
    init: function init() {
      ctx2 = document.getElementById('chartBar2').getContext('2d');
      ctx3 = document.getElementById('chartBar3').getContext('2d');
      monthChart = new Chart(ctx2, {
        type: 'line',
        data: {
          labels: [],
          datasets: [{
            label: ' ₮',
            data: [],
            borderColor: '#2ecc71'
          }]
        },
        options: {
          maintainAspectRatio: false,
          legend: {
            display: false,
            labels: {
              display: false
            }
          },
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false,
                fontSize: 10
              }
            }],
            xAxes: [{
              ticks: {
                beginAtZero: false,
                fontSize: 11
              }
            }]
          }
        }
      });
      monthChart1 = new Chart(ctx3, {
        type: 'line',
        data: {
          labels: ['1 сар', '2 сар', '3 сар', '4 сар', '5 сар', '6 сар', '7 сар', '8 сар', '9 сар', '10 сар', '11 сар', '12 сар'],
          datasets: [{
            label: ' ₮',
            data: [],
            borderColor: '#2ecc71'
          }]
        },
        options: {
          maintainAspectRatio: false,
          legend: {
            display: false,
            labels: {
              display: false
            }
          },
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false,
                fontSize: 10
              }
            }],
            xAxes: [{
              ticks: {
                beginAtZero: false,
                fontSize: 11
              }
            }]
          }
        }
      });
      chartData = [];
      chartLabel = [];
      this.data.monthly.forEach(function (item) {
        if (item !== null) {
          chartData.push(item.avg_une.toFixed(0));
          chartLabel.push(item.month + ' сар');
        }
      });
      this.updateMonthlyChart(chartData, chartLabel);
      this.filterData();
    },
    updateMonthlyChart: function updateMonthlyChart(data, labels) {
      monthChart.data.datasets[0].data = data;
      monthChart.data.labels = labels;
      monthChart.update();
    },
    updateMonthlyChart1: function updateMonthlyChart1(data) {
      monthChart1.data.datasets[0].data = data;
      monthChart1.update();
    },
    filterData: function filterData() {
      var _this2 = this;

      axios.post("/filter", this.filter).then(function (o) {
        $('#totalProjects').text(o.data.all);
        $('#totalObjects').text(o.data.allObject);
        $('#totalObjectsInActive').text('Үүнээс захиалга авч буй (' + o.data.niitiinObjectInActivePercent + '%)');
        $('#totalObjectsProggressBar')[0].className = '';
        $('#totalObjectsProggressBar')[0].className = 'progress-bar bg-success progress-bar-xs wd-' + parseInt(o.data.niitiinObjectInActivePercent / 5) * 5 + 'p';
        $('#aminii').text(o.data.aminii);
        $('#aminiiObject').text(o.data.aminiiObject);
        $('#aminiiObjectInActive').text('Үүнээс захиалга авч буй (' + o.data.aminiiObjectInActivePercent + '%)');
        $('#aminiiObjectProggressBar')[0].className = 'progress-bar bg-success progress-bar-xs wd-' + parseInt(o.data.niitiinObjectInActivePercent / 5) * 5 + 'p';
        $('#niitiin').text(o.data.niitiin);
        $('#niitiinObject').text(o.data.niitiinObject);
        $('#niitiinObjectInActive').text('Үүнээс захиалга авч буй (' + o.data.niitiinObjectInActivePercent + '%)');
        $('#niitiinObjectProggressBar')[0].className = 'progress-bar bg-success progress-bar-xs wd-' + parseInt(o.data.niitiinObjectInActivePercent / 5) * 5 + 'p';
        var chartData1 = [];
        o.data.monthly.forEach(function (item) {
          if (item !== null) {
            chartData1.push(item.avg_une.toFixed(0));
          }
        });

        _this2.updateMonthlyChart1(chartData1);
      });
    },
    formatNumber: function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    },
    currencyFormat: function currencyFormat(num) {
      return num.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    },
    customGetDate: function customGetDate(d) {
      return d.substring(0, 10);
    },
    renderImg: function renderImg(path) {
      return 'background-image' + ':' + 'url("' + path.replace(/\\/g, '/') + '")';
    },
    choosePoster: function choosePoster(item) {
      this.$router.push('posterdetail/' + item.id);
    },
    relateSelect: function relateSelect() {
      var _this3 = this;

      this.subcategory = [];
      axios.get("/getSubcategory/" + this.formData.cat1).then(function (_ref) {
        var data = _ref.data;
        _this3.subcategory = data;
      });
    },
    aimagChanges: function aimagChanges(val) {
      var _this4 = this;

      this.sumlist = [];
      axios.get('/sumlist/' + val).then(function (o) {
        _this4.sumlist = o.data;
      })["catch"](function (e) {
        console.log(e.message);
      });
    },
    sumChanges: function sumChanges(val) {
      var _this5 = this;

      axios.get('/getbaghoroo/' + val).then(function (o) {
        _this5.baglist = o.data;
      })["catch"](function (e) {
        console.log(e.message);
      });
    }
  }
});

/***/ }),

/***/ "./resources/assets/web/js/pages/web/index.vue":
/*!*****************************************************!*\
  !*** ./resources/assets/web/js/pages/web/index.vue ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _index_vue_vue_type_template_id_a47a86b6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./index.vue?vue&type=template&id=a47a86b6& */ "./resources/assets/web/js/pages/web/index.vue?vue&type=template&id=a47a86b6&");
/* harmony import */ var _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./index.vue?vue&type=script&lang=js& */ "./resources/assets/web/js/pages/web/index.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _index_vue_vue_type_template_id_a47a86b6___WEBPACK_IMPORTED_MODULE_0__.render,
  _index_vue_vue_type_template_id_a47a86b6___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/web/js/pages/web/index.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/assets/web/js/pages/web/index.vue?vue&type=script&lang=js&":
/*!******************************************************************************!*\
  !*** ./resources/assets/web/js/pages/web/index.vue?vue&type=script&lang=js& ***!
  \******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/index.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/assets/web/js/pages/web/index.vue?vue&type=template&id=a47a86b6&":
/*!************************************************************************************!*\
  !*** ./resources/assets/web/js/pages/web/index.vue?vue&type=template&id=a47a86b6& ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_a47a86b6___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_a47a86b6___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_a47a86b6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./index.vue?vue&type=template&id=a47a86b6& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/index.vue?vue&type=template&id=a47a86b6&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/index.vue?vue&type=template&id=a47a86b6&":
/*!***************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/web/js/pages/web/index.vue?vue&type=template&id=a47a86b6& ***!
  \***************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "container pd-t-20" }, [
    _vm._m(0),
    _vm._v(" "),
    _c("div", { staticClass: "row no-gutters dashboard-chart-one" }, [
      _c("div", { staticClass: "col-md col-lg-4" }, [
        _c("div", { staticClass: "card card-revenue" }, [
          _c("h6", { staticClass: "chart-title" }, [
            _vm._v("Сүүлийн сарын мэдээ")
          ]),
          _vm._v(" "),
          _c("p", [_vm._v("Шинэ орон сууцны мкв-н үнийн статистик ")]),
          _vm._v(" "),
          _c("h1", [
            _vm._v(
              _vm._s(_vm.currencyFormat(_vm.data.lastMonthAvg)) +
                "₮\n                    "
            ),
            _c(
              "span",
              {
                staticClass:
                  "tx-success {!! data.monthPercent > 0 ? 'up' : 'down' !!}"
              },
              [
                _vm._v(
                  "\n                        " +
                    _vm._s(_vm.data.monthPercent.toFixed(1)) +
                    "%\n                        "
                ),
                _vm.data.monthPercent > 0
                  ? _c("i", { staticClass: "ti-arrow-up" })
                  : _c("i", { staticClass: "ti-arrow-down" })
              ]
            )
          ]),
          _vm._v(" "),
          _c("div", {
            staticClass: "ht-50 ht-sm-70 mg-r--1",
            attrs: { id: "rs3" }
          }),
          _vm._v(" "),
          _c("label", [
            _vm._v("Өнгөрсөн сард: "),
            _c("span", [
              _vm._v(
                _vm._s(_vm.currencyFormat(_vm.data.previousMonthAvg)) + "₮"
              )
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-md-4 col-lg" }, [
        _c("div", { staticClass: "card card-total" }, [
          _c("div", [
            _c("h1", [_vm._v(_vm._s(_vm.formatNumber(_vm.data.all)))]),
            _vm._v(" "),
            _c("p", [_vm._v("Захиалга авч буй нийт төсөл")])
          ]),
          _vm._v(" "),
          _c("div", [
            _vm._m(1),
            _vm._v(" "),
            _c("label", [
              _vm._v(
                "Улаанбаатарт (" +
                  _vm._s(_vm.formatNumber(_vm.data.allUb)) +
                  ")"
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "progress mg-b-10" }, [
              _c("div", {
                class:
                  "progress-bar bg-primary progress-bar-xs wd-" +
                  Math.round((_vm.data.allUb * 100) / _vm.data.all) +
                  "p",
                attrs: {
                  role: "progressbar",
                  "aria-valuenow":
                    "" + Math.round((_vm.data.allUb * 100) / _vm.data.all),
                  "aria-valuemin": "0",
                  "aria-valuemax": "100"
                }
              })
            ]),
            _vm._v(" "),
            _c("label", [
              _vm._v(
                "Орон нутагт (" +
                  _vm._s(_vm.formatNumber(_vm.data.allCountry)) +
                  ")"
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "progress" }, [
              _c("div", {
                class:
                  "progress-bar bg-danger progress-bar-xs wd-" +
                  Math.round((_vm.data.allCountry * 100) / _vm.data.all) +
                  "p",
                attrs: {
                  role: "progressbar",
                  "aria-valuenow": "5",
                  "aria-valuemin": "0",
                  "aria-valuemax": "100"
                }
              })
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-md-4 col-lg" }, [
        _c("div", { staticClass: "card card-total" }, [
          _c("div", [
            _c("h1", [_vm._v(_vm._s(_vm.formatNumber(_vm.data.niitiin)))]),
            _vm._v(" "),
            _c("p", [_vm._v("Үүнээс нийтийн оронсууц")])
          ]),
          _vm._v(" "),
          _c("div", [
            _vm._m(2),
            _vm._v(" "),
            _c("label", [
              _vm._v(
                "Улаанбаатарт (" +
                  _vm._s(_vm.formatNumber(_vm.data.niitiinUb)) +
                  ")"
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "progress mg-b-10" }, [
              _c("div", {
                class:
                  "progress-bar bg-success progress-bar-xs wd-" +
                  Math.round((_vm.data.niitiinUb * 100) / _vm.data.niitiin) +
                  "p",
                attrs: {
                  role: "progressbar",
                  "aria-valuenow": "85",
                  "aria-valuemin": "0",
                  "aria-valuemax": "100"
                }
              })
            ]),
            _vm._v(" "),
            _c("label", [
              _vm._v(
                "Орон нутагт (" +
                  _vm._s(_vm.formatNumber(_vm.data.niitiinCountry)) +
                  ")"
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "progress" }, [
              _c("div", {
                class:
                  "progress-bar bg-warning progress-bar-xs wd-" +
                  Math.round(
                    (_vm.data.niitiinCountry * 100) / _vm.data.niitiin
                  ) +
                  "p",
                attrs: {
                  role: "progressbar",
                  "aria-valuenow": "15",
                  "aria-valuemin": "0",
                  "aria-valuemax": "100"
                }
              })
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-md-4 col-lg" }, [
        _c("div", { staticClass: "card card-total" }, [
          _c("div", [
            _c("h1", [_vm._v(_vm._s(_vm.formatNumber(_vm.data.aminii)))]),
            _vm._v(" "),
            _c("p", [_vm._v("Үүнээс амины оронсууц")])
          ]),
          _vm._v(" "),
          _c("div", [
            _vm._m(3),
            _vm._v(" "),
            _c("label", [
              _vm._v(
                "Улаанбаатарт (" +
                  _vm._s(_vm.formatNumber(_vm.data.aminiiUb)) +
                  ")"
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "progress mg-b-10" }, [
              _vm.data.aminii > 0
                ? _c("div", {
                    class:
                      "progress-bar bg-purple progress-bar-xs wd-" +
                      Math.round((_vm.data.aminiiUb * 100) / _vm.data.aminii) +
                      "p",
                    attrs: {
                      role: "progressbar",
                      "aria-valuenow": "75",
                      "aria-valuemin": "0",
                      "aria-valuemax": "100"
                    }
                  })
                : _c("div", {
                    staticClass: "progress-bar bg-purple progress-bar-xs wd-0p",
                    attrs: {
                      role: "progressbar",
                      "aria-valuenow": "75",
                      "aria-valuemin": "0",
                      "aria-valuemax": "100"
                    }
                  })
            ]),
            _vm._v(" "),
            _c("label", [
              _vm._v(
                "Орон нутагт (" +
                  _vm._s(_vm.formatNumber(_vm.data.aminiiCountry)) +
                  ")"
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "progress" }, [
              _vm.data.aminii > 0
                ? _c("div", {
                    class:
                      "progress-bar bg-pink progress-bar-xs wd-" +
                      Math.round(
                        (_vm.data.aminiiCountry * 100) / _vm.data.aminii
                      ) +
                      "p",
                    attrs: {
                      role: "progressbar",
                      "aria-valuenow": "25",
                      "aria-valuemin": "0",
                      "aria-valuemax": "100"
                    }
                  })
                : _c("div", {
                    staticClass: "progress-bar bg-pink progress-bar-xs wd-0p",
                    attrs: {
                      role: "progressbar",
                      "aria-valuenow": "25",
                      "aria-valuemin": "0",
                      "aria-valuemax": "100"
                    }
                  })
            ])
          ])
        ])
      ])
    ]),
    _vm._v(" "),
    _vm._m(4),
    _vm._v(" "),
    _c("hr"),
    _vm._v(" "),
    _vm._m(5),
    _vm._v(" "),
    _c("div", { staticClass: "row no-gutters dashboard-chart-one" }, [
      _c("div", { staticClass: "col-md-3" }, [
        _c(
          "div",
          { staticClass: "filter" },
          [
            _c(
              "el-form",
              {
                ref: "ruleForm",
                attrs: {
                  id: "filterFrm",
                  model: _vm.filter,
                  "label-position": "top"
                }
              },
              [
                _c(
                  "div",
                  { staticClass: "card card-body pd-10 mg-t-10" },
                  [
                    _c(
                      "el-form-item",
                      { attrs: { label: "Аймаг/Нийслэл сонгох" } },
                      [
                        _c(
                          "el-select",
                          {
                            attrs: { placeholder: "Сонгоно уу" },
                            on: { change: _vm.aimagChanges },
                            model: {
                              value: _vm.filter.aimag,
                              callback: function($$v) {
                                _vm.$set(_vm.filter, "aimag", $$v)
                              },
                              expression: "filter.aimag"
                            }
                          },
                          _vm._l(_vm.data.aimag, function(item) {
                            return _c("el-option", {
                              key: item.id,
                              attrs: { label: item.ner, value: item.id }
                            })
                          }),
                          1
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "el-form-item",
                      { attrs: { label: "Сум/Дүүрэг сонгох" } },
                      [
                        _c(
                          "el-select",
                          {
                            attrs: { placeholder: "Сонгоно уу" },
                            model: {
                              value: _vm.filter.sum,
                              callback: function($$v) {
                                _vm.$set(_vm.filter, "sum", $$v)
                              },
                              expression: "filter.sum"
                            }
                          },
                          _vm._l(_vm.sumlist, function(item) {
                            return _c("el-option", {
                              key: item.id,
                              attrs: { label: item.ner, value: item.id }
                            })
                          }),
                          1
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "el-form-item",
                      { attrs: { label: "Зэрэглэл сонгох" } },
                      [
                        _c(
                          "el-select",
                          {
                            attrs: { placeholder: "Сонгоно уу" },
                            model: {
                              value: _vm.filter.zereglel,
                              callback: function($$v) {
                                _vm.$set(_vm.filter, "zereglel", $$v)
                              },
                              expression: "filter.zereglel"
                            }
                          },
                          _vm._l(_vm.data.zereglel, function(item) {
                            return _c("el-option", {
                              key: item.id,
                              attrs: { label: item.ner, value: item.id }
                            })
                          }),
                          1
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c("el-divider"),
                    _vm._v(" "),
                    _c(
                      "el-form-item",
                      { attrs: { label: "Дундаж үнэ огноогоор шүүх" } },
                      [
                        _c(
                          "el-select",
                          {
                            attrs: { placeholder: "Сонгоно уу" },
                            model: {
                              value: _vm.filter.year,
                              callback: function($$v) {
                                _vm.$set(_vm.filter, "year", $$v)
                              },
                              expression: "filter.year"
                            }
                          },
                          _vm._l(_vm.data.year, function(item) {
                            return _c("el-option", {
                              key: item.id,
                              attrs: { label: item.ner, value: item.ner }
                            })
                          }),
                          1
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c("br"),
                    _vm._v(" "),
                    _c(
                      "el-form-item",
                      { staticClass: "sbm-btn" },
                      [
                        _c(
                          "el-button",
                          {
                            attrs: { type: "primary", icon: "el-icon-search" },
                            on: { click: _vm.filterData }
                          },
                          [_vm._v("ШҮҮХ")]
                        )
                      ],
                      1
                    )
                  ],
                  1
                )
              ]
            )
          ],
          1
        )
      ]),
      _vm._v(" "),
      _vm._m(6)
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "slim-pageheader" }, [
      _c("ol", { staticClass: "breadcrumb slim-breadcrumb" }),
      _vm._v(" "),
      _c(
        "h6",
        {
          staticClass: "slim-pagetitle",
          staticStyle: { "font-weight": "400" }
        },
        [_vm._v("Монгол улсын шинэ орон сууцны статистик")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "tx-15 mg-b-10 tx-center op-5" }, [
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-400" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-400" })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "tx-14 mg-b-15 tx-center op-5" }, [
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-400" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-400" })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "tx-14 mg-b-10 tx-center op-5" }, [
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-600" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-400" }),
      _vm._v(" "),
      _c("i", { staticClass: "ti ti-package tx-gray-400" })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "row row-statistics mg-b-30" }, [
      _c("div", { staticClass: "col-md-12 mg-t-20 mg-md-t-0 col-off" }, [
        _c("div", { staticClass: "card bd pd-l-20 pd-y-30 pd-r-30" }, [
          _c("h3", { staticClass: "chart-title" }, [
            _vm._v("Орон сууцны дундаж үнэ - Сүүлийн жилд")
          ]),
          _vm._v(" "),
          _c("canvas", {
            staticStyle: { "max-height": "300px" },
            attrs: { id: "chartBar2" }
          })
        ])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "slim-pageheader" }, [
      _c("ol", { staticClass: "breadcrumb slim-breadcrumb" }),
      _vm._v(" "),
      _c(
        "h6",
        {
          staticClass: "slim-pagetitle",
          staticStyle: { "font-weight": "400" }
        },
        [_vm._v("Засаг захиргааны нэгжээр")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-9" }, [
      _c("div", { staticClass: "row" }, [
        _c("div", { staticClass: "col-md-4" }, [
          _c("div", { staticClass: "card card-total" }, [
            _c("div", [
              _c(
                "h1",
                {
                  staticStyle: { "font-size": "44px" },
                  attrs: { id: "totalProjects" }
                },
                [_vm._v("0")]
              ),
              _vm._v(" "),
              _c("p", [_vm._v("Нийт барилга")])
            ]),
            _vm._v(" "),
            _c("div", [
              _c("div", { staticClass: "tx-16 mg-b-10 tx-center op-5" }, [
                _c("i", { staticClass: "ti ti-server tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-400" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-400" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-400" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-400" })
              ]),
              _vm._v(" "),
              _c("label", [
                _vm._v("Айлын тоо ("),
                _c("span", { attrs: { id: "totalObjects" } }, [_vm._v("0")]),
                _vm._v(")")
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "progress mg-b-10" }, [
                _c("div", {
                  staticClass:
                    "progress-bar bg-primary progress-bar-xs wd-100p",
                  attrs: {
                    role: "progressbar",
                    "aria-valuenow": "66",
                    "aria-valuemin": "0",
                    "aria-valuemax": "100"
                  }
                })
              ]),
              _vm._v(" "),
              _c("label", { attrs: { id: "totalObjectsInActive" } }, [
                _vm._v("Үүнээс захиалга авч буй (0)")
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "progress" }, [
                _c("div", {
                  staticClass: "progress-bar bg-success progress-bar-xs",
                  attrs: {
                    id: "totalObjectsProggressBar",
                    role: "progressbar",
                    "aria-valuenow": "34",
                    "aria-valuemin": "0",
                    "aria-valuemax": "100"
                  }
                })
              ])
            ])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "col-md-4" }, [
          _c("div", { staticClass: "card card-total" }, [
            _c("div", [
              _c(
                "h1",
                {
                  staticStyle: { "font-size": "44px" },
                  attrs: { id: "niitiin" }
                },
                [_vm._v("0")]
              ),
              _vm._v(" "),
              _c("p", [_vm._v("Нийтийн барилга")])
            ]),
            _vm._v(" "),
            _c("div", [
              _c("div", { staticClass: "tx-16 mg-b-15 tx-center op-5" }, [
                _c("i", { staticClass: "ti ti-package tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-package tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-package tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-package tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-package tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-package tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-package tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-package tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-package tx-gray-400" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-package tx-gray-400" })
              ]),
              _vm._v(" "),
              _c("label", [
                _vm._v("Айлын тоо ("),
                _c("span", { attrs: { id: "niitiinObject" } }, [_vm._v("0")]),
                _vm._v(")")
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "progress mg-b-10" }, [
                _c("div", {
                  staticClass:
                    "progress-bar bg-primary progress-bar-xs wd-100p",
                  attrs: {
                    role: "progressbar",
                    "aria-valuenow": "66",
                    "aria-valuemin": "0",
                    "aria-valuemax": "100"
                  }
                })
              ]),
              _vm._v(" "),
              _c("label", { attrs: { id: "niitiinObjectInActive" } }, [
                _vm._v("Үүнээс захиалга авч буй (0)")
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "progress" }, [
                _c("div", {
                  staticClass: "progress-bar bg-success progress-bar-xs wd-0p",
                  attrs: {
                    id: "niitiinObjectProggressBar",
                    role: "progressbar",
                    "aria-valuenow": "34",
                    "aria-valuemin": "0",
                    "aria-valuemax": "100"
                  }
                })
              ])
            ])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "col-md-4" }, [
          _c("div", { staticClass: "card card-total" }, [
            _c("div", [
              _c(
                "h1",
                {
                  staticStyle: { "font-size": "44px" },
                  attrs: { id: "aminii" }
                },
                [_vm._v("0")]
              ),
              _vm._v(" "),
              _c("p", [_vm._v("Амины барилга")])
            ]),
            _vm._v(" "),
            _c("div", [
              _c("div", { staticClass: "tx-16 mg-b-10 tx-center op-5" }, [
                _c("i", { staticClass: "ti ti-server tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-600" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-400" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-400" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-400" }),
                _vm._v(" "),
                _c("i", { staticClass: "ti ti-server tx-gray-400" })
              ]),
              _vm._v(" "),
              _c("label", [
                _vm._v("Айлын тоо ("),
                _c("span", { attrs: { id: "aminiiObject" } }, [_vm._v("0")]),
                _vm._v(")")
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "progress mg-b-10" }, [
                _c("div", {
                  staticClass:
                    "progress-bar bg-primary progress-bar-xs wd-100p",
                  attrs: {
                    role: "progressbar",
                    "aria-valuenow": "66",
                    "aria-valuemin": "0",
                    "aria-valuemax": "100"
                  }
                })
              ]),
              _vm._v(" "),
              _c("label", { attrs: { id: "aminiiObjectInActive" } }, [
                _vm._v("Үүнээс захиалга авч буй (0)")
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "progress" }, [
                _c("div", {
                  staticClass: "progress-bar bg-success progress-bar-xs wd-0p",
                  attrs: {
                    id: "aminiiObjectProggressBar",
                    role: "progressbar",
                    "aria-valuenow": "34",
                    "aria-valuemin": "0",
                    "aria-valuemax": "100"
                  }
                })
              ])
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "row mg-t-20" }, [
        _c("div", { staticClass: "col-xl-12 mg-t-20 mg-b-20 mg-xl-t-0" }, [
          _c("div", { staticClass: "card bd pd-l-20 pd-y-30 pd-r-30" }, [
            _c("h3", { staticClass: "chart-title" }, [
              _vm._v("Орон сууцны дундаж үнэ")
            ]),
            _vm._v(" "),
            _c("canvas", {
              staticStyle: { "max-height": "300px" },
              attrs: { id: "chartBar3" }
            })
          ])
        ])
      ])
    ])
  }
]
render._withStripped = true



/***/ })

}]);