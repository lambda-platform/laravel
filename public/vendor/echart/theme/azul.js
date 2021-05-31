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
	// Theme inspired by http://www.colourlovers.com/palette/41805/cobblestone_jazz
    var colorPalette = [
        '#f2385a','#f5a503','#e6efdc','#4ad9d9',
        '#36b1bf','#f7879c','#fccfd7','#d5f6f6'
    ];

    var theme = {

        color: colorPalette,

        title: {
            textStyle: {
                fontWeight: 'normal',
				color: '#f2385a'
            }
        },

        visualMap: {
            color:['#f2385a','#a2d4e6']
        }, 

        toolbox: {
            color : ['#f2385a','#f2385a','#f2385a','#f2385a']
        },

    tooltip: {
        backgroundColor: 'rgba(0,0,0,0.5)',
        axisPointer : {            // Axis indicator, coordinate trigger effective
            type : 'line',         // The default is a straight line： 'line' | 'shadow'
            lineStyle : {          // Straight line indicator style settings
                color: '#f2385a',
                type: 'dashed'
            },
            crossStyle: {
                color: '#f2385a'
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
        handleColor: '#f2385a'     // Handle color
    },

    timeline : {
        lineStyle : {
            color : '#f2385a'
        },
        controlStyle : {
            normal : { color : '#f2385a'},
            emphasis : { color : '#f2385a'}
        }
    },

	k: {
        itemStyle: {
            normal: {
                color: '#f5a503',          // Yang line filled with color
                color0: '#e6efdc',      // Yinxian fill color
                lineStyle: {
                    width: 1,
                    color: '#36b1bf',   // Yang line border color
                    color0: '#4ad9d9'   // Yinbian border color
                }
            }
        }
    },

        candlestick: {
            itemStyle: {
                normal: {
                    color: '#f2385a',
                    color0: '#a2d4e6',
                    lineStyle: {
                        width: 1,
                        color: '#f2385a',
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
                    color: '#e6efdc'
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
                    color : '#f2385a'
                }
            }
        }
    },

        gauge : {
        axisLine: {            // Coordinate axis
            show: true,        // Default display, property show control display or not
            lineStyle: {       // Attribute lineStyle controls the line style
                color: [[0.2, '#f5a503'],[0.8, '#f2385a'],[1, '#36b1bf']], 
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
    echarts.registerTheme('azul', theme);
}));