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
	// Theme inspired by http://www.colourlovers.com/palette/46688/fresh_cut_day
    var colorPalette = [
        '#00a8c6','#40c0cb','#f0dec2','#aee239',
        '#8fbe00','#33e0ff','#b3f4ff','#e6ff99'
    ];

    var theme = {

        color: colorPalette,

        title: {
            textStyle: {
                fontWeight: 'normal',
				color: '#00a8c6'
            }
        },

        visualMap: {
            color:['#00a8c6','#a2d4e6']
        }, 

        toolbox: {
            color : ['#00a8c6','#00a8c6','#00a8c6','#00a8c6']
        },

    tooltip: {
        backgroundColor: 'rgba(0,0,0,0.5)',
        axisPointer : {            // Axis indicator, coordinate trigger effective
            type : 'line',         // The default is a straight line： 'line' | 'shadow'
            lineStyle : {          // Straight line indicator style settings
                color: '#00a8c6',
                type: 'dashed'
            },
            crossStyle: {
                color: '#00a8c6'
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
        handleColor: '#00a8c6'     // Handle color
    },

    timeline : {
        lineStyle : {
            color : '#00a8c6'
        },
        controlStyle : {
            normal : { color : '#00a8c6'},
            emphasis : { color : '#00a8c6'}
        }
    },

	k: {
        itemStyle: {
            normal: {
                color: '#40c0cb',          // Yang line filled with color
                color0: '#f0dec2',      // Yinxian fill color
                lineStyle: {
                    width: 1,
                    color: '#8fbe00',   // Yang line border color
                    color0: '#aee239'   // Yinbian border color
                }
            }
        }
    },

        candlestick: {
            itemStyle: {
                normal: {
                    color: '#00a8c6',
                    color0: '#a2d4e6',
                    lineStyle: {
                        width: 1,
                        color: '#00a8c6',
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
                    color: '#f0dec2'
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
                    color : '#00a8c6'
                }
            }
        }
    },

        gauge : {
        axisLine: {            // Coordinate axis
            show: true,        // Default display, property show control display or not
            lineStyle: {       // Attribute lineStyle controls the line style
                color: [[0.2, '#40c0cb'],[0.8, '#00a8c6'],[1, '#8fbe00']], 
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
    echarts.registerTheme('fresh-cut', theme);
}));