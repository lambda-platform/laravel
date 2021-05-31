(function (root, factory) {if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['exports', 'echarts'], factory);
    } else if (typeof exports === 'object' && typeof exports.nodeName !== 'string') {
        // CommonJS
        factory(exports, require('echarts'));
    } else {
        // Browser globals
        factory({}, root.echarts);
    }
}(this, function (exports, echarts) {
    var log = function (msg) {
        if (typeof console !== 'undefined') {
            console && console.error && console.error(msg);
        }
    };
    if (!echarts) {
        log('ECharts is not Loaded');
        return;
    }
	// Theme inspired by http://www.colourlovers.com/palette/656966/Koi_Carp
    var colorPalette = [
        '#f0d8A8','#3d1c00','#86b8b1','#f2d694',
        '#fa2a00','#ff8066','#ffd5cc','#f9edd2'
    ];

    var theme = {

        color: colorPalette,

        title: {
            textStyle: {
                fontWeight: 'normal',
				color: '#f0d8A8'
            }
        },

        visualMap: {
            color:['#f0d8A8','#a2d4e6']
        }, 

        toolbox: {
            color : ['#f0d8A8','#f0d8A8','#f0d8A8','#f0d8A8']
        },

    tooltip: {
        backgroundColor: 'rgba(0,0,0,0.5)',
        axisPointer : {            // Axis indicator, coordinate trigger effective
            type : 'line',         // The default is a straight line： 'line' | 'shadow'
            lineStyle : {          // Straight line indicator style settings
                color: '#f0d8A8',
                type: 'dashed'
            },
            crossStyle: {
                color: '#f0d8A8'
            },
            shadowStyle : {                     // Shadow indicator style settings
                color: 'rgba(200,200,200,0.3)'
            }
        }
    },

    // Area scaling controller
    dataZoom: {
        dataBackgroundColor: '#eee',            // Data background color
        fillerColor: 'rgba(144,197,237,0.2)',   // Fill the color
        handleColor: '#f0d8A8'     // Handle color
    },

    timeline : {
        lineStyle : {
            color : '#f0d8A8'
        },
        controlStyle : {
            normal : { color : '#f0d8A8'},
            emphasis : { color : '#f0d8A8'}
        }
    },

	k: {
        itemStyle: {
            normal: {
                color: '#3d1c00',          // Yang line filled with color
                color0: '#86b8b1',      // Yinxian fill color
                lineStyle: {
                    width: 1,
                    color: '#fa2a00',   // Yang line border color
                    color0: '#f2d694'   // Yinbian border color
                }
            }
        }
    },

        candlestick: {
            itemStyle: {
                normal: {
                    color: '#f0d8A8',
                    color0: '#a2d4e6',
                    lineStyle: {
                        width: 1,
                        color: '#f0d8A8',
                        color0: '#a2d4e6'
                    }
                }
            }
        },

        graph: {
            color: colorPalette
        },

        map: {
        itemStyle: {
            normal: {
                areaStyle: {
                    color: '#ddd'
                },
                label: {
                    textStyle: {
                        color: '#c12e34'
                    }
                }
            },
            emphasis: {                 // Is also selected style
                areaStyle: {
                    color: '#86b8b1'
                },
                label: {
                    textStyle: {
                        color: '#c12e34'
                    }
                }
            }
        }
    },

	force : { 
        itemStyle: {
            normal: {
                linkStyle : {
                    color : '#f0d8A8'
                }
            }
        }
    },

        gauge : {
        axisLine: {            // Coordinate axis
            show: true,        // Default display, property show control display or not
            lineStyle: {       // Attribute lineStyle controls the line style
                color: [[0.2, '#3d1c00'],[0.8, '#f0d8A8'],[1, '#fa2a00']], 
                width: 8
            }
        },
        axisTick: {            // Small mark of the axis
            splitNumber: 10,   // How many segments per split subdivision
            length :12,        // Attribute length control line length
            lineStyle: {       // Attribute lineStyle controls the line style
                color: 'auto'
            }
        },
        axisLabel: {           // Axis text label, see details axis.axisLabel
            textStyle: {       // The remaining attributes use the global text style by default TEXTSTYLE
                color: 'auto'
            }
        },
        splitLine: {           // Separate lines
            length : 18,         // Attribute length control line length
            lineStyle: {       // The attribute lineStyle (see lineStyle for details) controls the line style
                color: 'auto'
            }
        },
        pointer : {
            length : '90%',
            color : 'auto'
        },
        title : {
            textStyle: {       // The remaining attributes use the global text style by default TEXTSTYLE
                color: '#333'
            }
        },
        detail : {
            textStyle: {       // The remaining attributes use the global text style by default TEXTSTYLE
                color: 'auto'
            }
        }
    }
  };
    echarts.registerTheme('carp', theme);
}));