
/*============== Added usefull util methods in global scope =================*/
var toFixed = fabric.util.toFixed;
var extend = fabric.util.object.extend;
var clone = fabric.util.object.clone;
/*============== End of usefull util methods in global scope =================*/
/* ====  Image  =====*/
fabric.util.object.extend(fabric.Image.prototype, /** @lends fabric.Path.prototype */ {
	/*============== Custom Changes For Artifi ===================*/
	/**
     * @private
     * @param {CanvasRenderingContext2D} ctx Context to render on
     */
    _render: function(ctx, noTransform) {
		try{
				/* Following changes is due to NS_ERROR_NOT_AVAILABLE exception in firefox */
				$(this._element).attr('crossorigin', 'anonymus');
				$(this._element).attr('class', 'canvas-img');
				/*Following code is for fix image quality issue*/
				var imageElement = this._element;   
				if (true) {
					var width = this.currentWidth ? this.currentWidth : this.width;
					var height = this.currentHeight ? this.currentHeight : this.height;
					imageElement = fabric.util.antiAlise(imageElement, width, height);
				}
				
			  imageElement &&
			  ctx.drawImage(
				imageElement,
				//this._element, /*commented to fix image quality issue */
				noTransform ? this.left : -this.width/2,
				noTransform ? this.top : -this.height/2,
				this.width,
				this.height
			  );
			  this._renderStroke(ctx);
	  	}
		catch (err) {
			//console.log(err);
		}
	}
});
/**
* Creates an instance of fabric.Image from an URL string
* @static
* @param {String} url URL to create an image from
* @param {Function} [callback] Callback to invoke when image is created (newly created image is passed as a first argument)
* @param {Object} [imgOptions] Options object
*/
fabric.Image.fromURL = function (url, callback, imgOptions) {
    fabric.util.loadImage(url, function (img) {
        /*============== Custom Changes For Artifi ===================*/
        if (img == null) {
            var data = { type: "error", message: "Image is not loaded" };
            callback(data);
        }
        else {
            callback(new fabric.Image(img, imgOptions));
        }
    }, null, imgOptions && imgOptions.crossOrigin);
};
/* ====  Image End =====*/

/* ====  Static Canvas  =====*/
fabric.util.object.extend(fabric.StaticCanvas.prototype, /** @lends fabric.Path.prototype */ {

	/* ==================================== Custom Changes for Artifi Project ==================== */
   /**
     * @private
     * @param {String} property Property to set ({@link fabric.StaticCanvas#backgroundImage|backgroundImage}
     * or {@link fabric.StaticCanvas#overlayImage|overlayImage})
     * @param {(fabric.Image|String|null)} image fabric.Image instance, URL of an image or null to set background or overlay to
     * @param {Function} callback Callback to invoke when image is loaded and set as background or overlay
     * @param {Object} [options] Optional options to set for the {@link fabric.Image|image}.
     */
    __setBgOverlayImage: function(property, image, callback, options) {
      if (typeof image === 'string') {
        fabric.util.loadImage(image, function(img) {
          this[property] = new fabric.Image(img, options);
          callback && callback();
        }, this, 'anonymus');
      }
      else {
        this[property] = image;
        callback && callback();
      }

      return this;
    },

    /**
     * @private
     * @param {String} property Property to set ({@link fabric.StaticCanvas#backgroundColor|backgroundColor}
     * or {@link fabric.StaticCanvas#overlayColor|overlayColor})
     * @param {(Object|String|null)} color Object with pattern information, color value or null
     * @param {Function} [callback] Callback is invoked when color is set
     */
    __setBgOverlayColor: function(property, color, callback) {
      if (color && color.source) {
        var _this = this;
        fabric.util.loadImage(color.source, function(img) {
          _this[property] = new fabric.Pattern({
            source: img,
            repeat: color.repeat,
            offsetX: color.offsetX,
            offsetY: color.offsetY
          });
          callback && callback();
        }, this,'anonymus');
      }
      else {
        this[property] = color;
        callback && callback();
      }

      return this;
    },
	
    /**
    * @private
    */
    __serializeBgOverlay: function () {
        var data = {
            background: (this.backgroundColor && this.backgroundColor.toObject)
              ? this.backgroundColor.toObject()
              : this.backgroundColor
        };

        if (this.overlayColor) {
            data.overlay = this.overlayColor.toObject
              ? this.overlayColor.toObject()
              : this.overlayColor;
        }
        if (this.backgroundImage) {
            data.backgroundImage = this.backgroundImage.toObject();
        }
        if (this.overlayImage) {
            data.overlayImage = this.overlayImage.toObject();
        }
        /* ==================================== Custom Changes for Artifi Project ==================== */
        if (this.maskData) {
            data.maskData = this.maskData;
        }

        return data;
    },

    /**
     * @private
     */
    _toObjectMethod: function (methodName, propertiesToInclude) {

        var activeGroup = this.getActiveGroup();
        if (activeGroup) {
            this.discardActiveGroup();
        }

        var objects = this._toObjects(methodName, propertiesToInclude);
        /* ==================================== Custom Changes for Artifi Project ==================== */
        /*==================================== Remove CustomPath objects from objects array ==================*/
        var data = {
            objects: objects.filter(function(o){ return o.type != 'CustomPath'})
        };

        extend(data, this.__serializeBgOverlay());

        fabric.util.populateWithProperties(this, data, propertiesToInclude);

        if (activeGroup) {
            this.setActiveGroup(new fabric.Group(activeGroup.getObjects(), {
                originX: 'center',
                originY: 'center'
            }));
            activeGroup.forEachObject(function(o) {
                o.set('active', true);
            });

            if (this._currentTransform) {
                this._currentTransform.target = this.getActiveGroup();
            }
        }

        return data;
    },


});
/* ====  Static Canvas End  =====*/

/* ====  Util   =====*/
fabric.util.object.extend(fabric.util, /** @lends fabric.Path.prototype */ {

	/* ==================================== Custom Changes for Artifi Project ==================== */
    /**
    * @private 
    * @param {imageElement} image element on which operation have to perform
    * @param {requireWidth} require image dimention width area when anti alise image
    * @param {requireHeight} require image dimention height area when anti alise image
    */
    antiAlise: function(imageElement, totalWidth, totalHeight) {
        try {

            var steps,
                originalCanvas = document.createElement('canvas'),
                ctx = originalCanvas.getContext('2d'),
                finalCanvas = document.createElement('canvas'),
                w = imageElement.width,
                h = imageElement.height;

            originalCanvas.width = w;
            originalCanvas.height = h;

            finalCanvas.width = totalWidth;
            finalCanvas.height = totalHeight;

            if ((w / totalWidth) > (h / totalHeight)) {
                steps = Math.ceil(Math.log(w / totalWidth) / Math.log(2));
            } else {
                steps = Math.ceil(Math.log(h / totalHeight) / Math.log(2));
            }

            if (steps <= 1) {
                ctx = finalCanvas.getContext('2d');

                ctx.drawImage(imageElement, 0, 0, totalWidth, totalHeight);
                return finalCanvas;
            }

            ctx.drawImage(imageElement, 0, 0);
            steps--;



            var tempCanvas = document.createElement('canvas');
            var tctx = tempCanvas.getContext('2d');


            while (steps > 0) {
                w *= 0.5;
                h *= 0.5;
                w = parseInt(w);
                h = parseInt(h);
                tempCanvas.width = w * 2;
                tempCanvas.height = h * 2;
                tctx.drawImage(originalCanvas, 0, 0);
                ctx.clearRect(0, 0, w * 2, h * 2);
                originalCanvas.width = w;
                originalCanvas.height = h;
                var clipW = w * 2;
                var clipH = h * 2;

                ctx.drawImage(tempCanvas, 0, 0, clipW, clipH, 0, 0, w, h);
                tctx.clearRect(0, 0, w * 2, h * 2);
                steps--;
            }

            ctx = finalCanvas.getContext('2d');
            if (totalWidth < 30 && totalHeight < 30) {
                ctx.mozImageSmoothingEnabled = ctx.webkitImageSmoothingEnabled = ctx.imageSmoothingEnabled = false;/*FOR ENABLING SMOOTHENING IMAGE*/
            }
            else {
                ctx.mozImageSmoothingEnabled = ctx.webkitImageSmoothingEnabled = ctx.imageSmoothingEnabled = true;/*FOR ENABLING SMOOTHENING IMAGE*/
            }
            ctx.drawImage(originalCanvas, 0, 0, w, h, 0, 0, totalWidth, totalHeight);
            return finalCanvas;
        }
        catch (err) {

            //console.log(err);
            return imageElement;
        }
    },
	
	
	
	
});
/* ====  Util End  =====*/

/* ====  Object  =====*/
fabric.util.object.extend(fabric.Object.prototype,/** @lends fabric.Object.prototype */ {
	
	 /**=================================================Added New Property For Diff Wedget and  Objects +===Added By umashankar Pardhi (7-1-2014)======================*/
          /**
         * Add new subtype for photo Diff
         * @type string
         * @default
         */
        widgetSubType: null,
        /**
       * Add new subtype for widget
       * @type string
       * @default
       */
        widgetType: null,
        /**
       * Add new id for diff objects
       * @type string
       * @default
       */
        id: null,
        /**
       * Add original Weidth 
       * @type number
       * @default
       */
        originalWidth: 50,
        /**
      * Add original Height
      * @type number
      * @default
      */
        originalHeight: 50,
        /**
      * Add current widget width same as currentWidth
      * @type number
      * @default
      */
        currentWidgetWidth: 50,
        /**
      * Add current widget height same as currentHeight
      * @type number
      * @default
      */
        currentWidgetHeight: 50,

        /**
      * Add Decal Id for 3d preview
      * @type string
      * @default
      */
        decalId: null,
        /**
      * Add SVG (URL/path) svg masking
      * @type string
      * @default
      */
        svgData: null,

        libProp: {},
		
		 /**
     * List of properties to consider when checking if state
     * of an object is changed (fabric.Object#hasStateChanged)
     * as well as for history (undo/redo) purposes
     * @type Array
     */
    stateProperties:  (
      'top left width height scaleX scaleY flipX flipY originX originY transformMatrix ' +
      'stroke strokeWidth strokeDashArray strokeLineCap strokeLineJoin strokeMiterLimit ' +
      'angle opacity fill fillRule globalCompositeOperation shadow clipTo visible backgroundColor'+
	  /* ======================== Custom Changes for Artifi ==========================*/
	  'widgetType widgetSubtType id originalWidth originalHeight imageUniqueName ImageUniqueNameOnUGC originalUrl scaleFactor cropArea currentWidgetWidth currentWidgetHeight decalId svgData libProp'
    ).split(' '),
	
	
	 /**
     * Returns an object representation of an instance
     * @param {Array} [propertiesToInclude] Any properties that you might want to additionally include in the output
     * @return {Object} Object representation of an instance
     */
    toObject: function(propertiesToInclude) {
      var NUM_FRACTION_DIGITS = fabric.Object.NUM_FRACTION_DIGITS,

          object = {
            type:                     this.type,
            originX:                  this.originX,
            originY:                  this.originY,
            left:                     toFixed(this.left, NUM_FRACTION_DIGITS),
            top:                      toFixed(this.top, NUM_FRACTION_DIGITS),
            width:                    toFixed(this.width, NUM_FRACTION_DIGITS),
            height:                   toFixed(this.height, NUM_FRACTION_DIGITS),
            fill:                     (this.fill && this.fill.toObject) ? this.fill.toObject() : this.fill,
            stroke:                   (this.stroke && this.stroke.toObject) ? this.stroke.toObject() : this.stroke,
            strokeWidth:              toFixed(this.strokeWidth, NUM_FRACTION_DIGITS),
            strokeDashArray:          this.strokeDashArray,
            strokeLineCap:            this.strokeLineCap,
            strokeLineJoin:           this.strokeLineJoin,
            strokeMiterLimit:         toFixed(this.strokeMiterLimit, NUM_FRACTION_DIGITS),
            scaleX:                   toFixed(this.scaleX, NUM_FRACTION_DIGITS),
            scaleY:                   toFixed(this.scaleY, NUM_FRACTION_DIGITS),
            angle:                    toFixed(this.getAngle(), NUM_FRACTION_DIGITS),
            flipX:                    this.flipX,
            flipY:                    this.flipY,
            opacity:                  toFixed(this.opacity, NUM_FRACTION_DIGITS),
            shadow:                   (this.shadow && this.shadow.toObject) ? this.shadow.toObject() : this.shadow,
            visible:                  this.visible,
            clipTo:                   this.clipTo && String(this.clipTo),
            backgroundColor:          this.backgroundColor,
            fillRule:                 this.fillRule,
            globalCompositeOperation: this.globalCompositeOperation,
			/* ======================== Custom Changes for Artifi ==========================*/
			widgetType: this.widgetType,
			widgetSubType: this.widgetSubType,
			id: this.id,
			originalWidth: this.originalWidth,
			originalHeight: this.originalHeight,
			imageUniqueName: this.imageUniqueName,
			originalUrl: this.originalUrl,
			scaleFactor: this.scaleFactor,
			cropArea: this.cropArea,
			currentWidgetWidth: toFixed(this.width, NUM_FRACTION_DIGITS) * toFixed(this.scaleX, NUM_FRACTION_DIGITS),
			currentWidgetHeight: toFixed(this.height, NUM_FRACTION_DIGITS) * toFixed(this.scaleY, NUM_FRACTION_DIGITS),
			ImageUniqueNameOnUGC: this.ImageUniqueNameOnUGC,
			decalId: this.decalId,
			svgData: this.svgData,
			libProp: this.libProp
          };

      if (!this.includeDefaultValues) {
        object = this._removeDefaultValues(object);
      }

      fabric.util.populateWithProperties(this, object, propertiesToInclude);
      			return object;
      },
	  
	  
	
	});
	/* ====  Object End   =====*/
	
	/* ====  Textbox =====*/
	(function (global) {

   'use strict';


    /**
     * fabric.Textbox A class to create TextBoxes, with or without images as their boxes
     */

    var fabric = global.fabric || (global.fabric = {}),
        extend = fabric.util.object.extend,
        clone = fabric.util.object.clone,
        toFixed = fabric.util.toFixed;

    if (fabric.Textbox) {
        fabric.warn('fabric.Textbox is already defined');
        return;
    }
    if (!fabric.Object) {
        fabric.warn('fabric.Textbox requires fabric.Object');
        return;

    }
    var fabric = global.fabric || (global.fabric = {}),
        extend = fabric.util.object.extend,
        clone = fabric.util.object.clone,
        toFixed = fabric.util.toFixed;

    fabric.Textbox = fabric.util.createClass(fabric.Text, {
        type: 'textbox',
        vAlign: 'middle',
        textPadding: 0,
        originalFontSize: 50,

        initialize: function (objects, options) {
            options || (options = {});
            this.callSuper('initialize', objects, options);
            this.set('vAlign', options.vAlign || 'middle');
        },

        toObject: function () {
            return fabric.util.object.extend(this.callSuper('toObject'), {
                vAlign: this.get('vAlign'),
                width: this.get('width'),
                height: this.get('height'),
                originalFontSize: this.get('originalFontSize')
                
            });
        },

        _render: function (ctx) {
            this.callSuper('_render', ctx);
        },

        _getTextWidth: function (ctx, textLines) {
            var maxWidth = ctx.measureText(textLines[0]).width;
            for (var i = 1, len = textLines.length; i < len; i++) {
                var currentLineWidth = ctx.measureText(textLines[i]).width;
                if (currentLineWidth > maxWidth) {
                    maxWidth = currentLineWidth;
                }
            }

            var actualWidth = this.width
            if (actualWidth < maxWidth) {
                actualWidth = maxWidth
            }
            return actualWidth;;

        },
        _getTextHeight: function (ctx, textLines) {
            var actualHeight = this.height;
            var calculatedHeight = this.fontSize * textLines.length * this.lineHeight;
            var styles = {};
            if (actualHeight < calculatedHeight) {
                actualHeight = calculatedHeight
            }
            return actualHeight;
        },
        _getTopPosition: function (ctx, textLines) {

            if (this.vAlign === "top") {
                return -this.height / 2;
            } else if (this.vAlign === 'bottom') {

                return this.height / 2;
            }
            return 0;

        },
        _getTopOffset: function (ctx, textLines) {

            if (fabric.isLikelyNode) {
                if (this.originY === 'center') {
                    return -this.height / 2;
                }
                else if (this.originY === 'bottom') {
                    return -this.height;
                }
                return 0;
            }



        },

        getTextPadding: function (scale) {
            if (!scale) scale = "x";
            else scale = scale.toLowerCase();

            var scales = {}

            scales.x = this.get("scaleX");
            scales.y = this.get("scaleY");

            return this.textPadding * scales[scale];

        },
        getTopPositionOfText: function (ctx, textLines, totalLineHeight, lineHeights, top) {

            if (this.vAlign === 'bottom') {
                if (textLines.length == 1) {

                    lineHeights = 0
                    top = this._getTopPosition(ctx, textLines) + lineHeights
                } else {
                    top = this._getTopPosition(ctx, textLines) - (totalLineHeight + this.getTextPadding('y')) + lineHeights;
                }
            }
            else if (this.vAlign === 'middle') {;
                top = this._getTopPosition(ctx, textLines) - (totalLineHeight + this.getTextPadding('y')) / 2 + lineHeights;
                //top =top/2;
            }

            else if (this.vAlign === 'top') {

                top = this._getTopPosition(ctx, textLines) + lineHeights

            }
            return top


        },
        /**
     * @private
     * @param {CanvasRenderingContext2D} ctx Context to render on
     * @param {Array} textLines Array of all text lines
     */
        _renderTextLinesBackground: function (ctx, textLines) {
            if (!this.textBackgroundColor) return;

            ctx.save();
            ctx.fillStyle = this.textBackgroundColor;
            var lineHeights = 0;
            var top = 0;
            for (var i = 0, len = textLines.length; i < len; i++) {
                var heightOfLine = this._getHeightOfLine(ctx, i, textLines);
                lineHeights += heightOfLine;
                var totalLineHeight = textLines.length * heightOfLine;

                var totalLineHeight = textLines.length * heightOfLine;
                top = this.getTopPositionOfText(ctx, textLines, totalLineHeight, lineHeights, top);
                top = top - heightOfLine;
                if (textLines[i] !== '') {

                    var lineWidth = this._getLineWidth(ctx, textLines[i]);
                    var lineLeftOffset = this._getLineLeftOffset(lineWidth);

                    ctx.fillRect(
					this._getLeftOffset() + lineLeftOffset,
					// this._getTopOffset() + (i * this.fontSize * this.lineHeight),
					top, lineWidth, this.fontSize * this.lineHeight);
                }
            }
            ctx.restore();
        },

        /**
		 * @private
		 * @param {CanvasRenderingContext2D} ctx Context to render on
		 * @param {Array} textLines Array of all text lines
		 */
        _renderTextFill: function (ctx, textLines) {

            if (!this.fill && !this.skipFillStrokeCheck) return;

            this._boundaries = [];
            var lineHeights = 0;
            var top = 0
            for (var i = 0, len = textLines.length; i < len; i++) {
                var heightOfLine = this._getHeightOfLine(ctx, i, textLines);
                lineHeights += heightOfLine;
                var totalLineHeight = textLines.length * heightOfLine;
                top = this.getTopPositionOfText(ctx, textLines, totalLineHeight, lineHeights, top)
                var position = 0;

                this._drawTextLine('fillText', ctx, textLines[i], this._getLeftOffset(), top);
            }
        },
        /* _TO_SVG_START_ */
        /**
         * Returns SVG representation of an instance
         * @return {String} svg representation of an instance
         */
        toSVG: function () {

            var tempHeight = this.height;
            var textLines = this.text.split(/\r?\n/);
            // this.height=this.fontSize*this.lineHeight* textLines.length;
            // canvas.renderAll();
            var textLines = this.text.split(/\r?\n/),
                lineTopOffset = this.useNative ? this.fontSize * this.lineHeight : (-this._fontAscent - ((this._fontAscent / 5) * this.lineHeight)),


                textLeftOffset = -(this.width / 2),
                textTopOffset = this.useNative ? this.fontSize - this.lineHeight : (this.height / 2) - (textLines.length * this.fontSize) - this._totalLineHeight,


                textAndBg = this._getSVGTextAndBg(lineTopOffset, textLeftOffset, textLines),
                shadowSpans = this._getSVGShadows(lineTopOffset, textLines);



            // move top offset by an ascent
            textTopOffset += (this._fontAscent ? ((this._fontAscent / 5) * this.lineHeight) : 0);
            var tempTop = this.top;



            if (this.vAlign === 'top') {
                // this.top = parseFloat(this.top+0.80)
            }
            if (this.vAlign === 'bottom') {
                //this.top = parseFloat(this.top +parseFloat(this.height - this.fontSize*this.lineHeight* textLines.length+1))
            }
            if (this.vAlign === 'middle') {
                // this.top = parseFloat(this.top + this.height / 2 - lineTopOffset * textLines.length / 2) - this.getTextPadding('y') / 2 +1
            }
            // this.height=this.fontSize*this.lineHeight* textLines.length;
            //canvas.renderAll();
            // debugger;

            // if (this.vAlign === 'middle') {
            ////     this.top = parseFloat(this.top + this.height / 2 - lineTopOffset * textLines.length / 2) - this.getTextPadding('y') / 2 +1
            //  } else if (this.vAlign === 'bottom') {
            //     this.top = parseFloat(this.top + this.height - this.fontSize*this.lineHeight* textLines.length+1)
            //  }
            //  else if (this.vAlign === 'top') {
            //     this.top = parseFloat(this.top+1)
            //  }
            //  var tempLeft =this.left
            //  if(this.angle>0  && this.angle<11){
            //this.top =this.top+4.88;
            //	this.left=  this.left - 3;  
            //  }


            this.height = tempHeight;

            var suvTransform = this.getSvgTransform();
            // var calculation=  suvTransform..split(/[()]+/).filter(function(e) { return e; });


            this.top = tempTop;
            //  this.left = tempLeft;
            return [
                     '<g transform="', suvTransform, '">',
                       textAndBg.textBgRects.join(''),
                       '<text ',
                         (this.fontFamily ? 'font-family="' + this.fontFamily.replace(/"/g, '\'') + '" ' : ''),
                         (this.fontSize ? 'font-size="' + this.fontSize + '" ' : ''),
                         (this.originalFontSize ? 'original-font-size="' + this.originalFontSize + '" ' : ''),
                         (this.fontStyle ? 'font-style="' + this.fontStyle + '" ' : ''),
                         (this.fontWeight ? 'font-weight="' + this.fontWeight + '" ' : ''),
                         (this.textDecoration ? 'text-decoration="' + this.textDecoration + '" ' : ''),
                         'style="', this.getSvgStyles(), '" ',
                         /* svg starts from left/bottom corner so we normalize height */
                         'transform="translate(', toFixed(textLeftOffset, 2), ' ', toFixed(textTopOffset, 2), ')">',
                         shadowSpans.join(''),
                         textAndBg.textSpans.join(''),
                       '</text>',
                     '</g>'
            ].join('');
        },
        /* @private
                 * @param {CanvasRenderingContext2D} ctx Context to render on
                 */
        _renderTextBoxBackground: function (ctx) {
            if (!this.backgroundColor) return;


            var lineHeights = 0;
            var top = 0;
            var textLines = this.text.split(/\r?\n/);
            var heightOfLine = this._getHeightOfLine(ctx, 1, textLines);
            var totalLineHeight = textLines.length * heightOfLine;

            top = this.getTopPositionOfText(ctx, textLines, totalLineHeight, lineHeights, top);

            ctx.save();
            ctx.fillStyle = this.backgroundColor;

            ctx.fillRect(
            this._getLeftOffset(), -this.height / 2,
            //this._getTopOffset(),
            this.width, this.height);

            ctx.restore();
        },
        /**
         * @private
         * @param {CanvasRenderingContext2D} ctx Context to render on
         * @param {Array} textLines Array of all text lines
         */
        _renderTextDecoration: function (ctx, textLines) {

            var lineHeights = 0;
            var top = 0;

            if (!this.textDecoration) return;

            // var halfOfVerticalBox = this.originY === 'top' ? 0 : this._getTextHeight(ctx, textLines) / 2;
            var halfOfVerticalBox = this._getTextHeight(ctx, textLines) / 2;
            var _this = this;

            /** @ignore */

            function renderLinesAtOffset(offset) {
                for (var i = 0, len = textLines.length; i < len; i++) {
                    var heightOfLine = _this._getHeightOfLine(ctx, i, textLines);
                    lineHeights += heightOfLine;
                    var totalLineHeight = textLines.length * heightOfLine;

                    var totalLineHeight = textLines.length * heightOfLine;
                    top = _this.getTopPositionOfText(ctx, textLines, totalLineHeight, lineHeights, top);
                    top = top - offset;



                    var lineWidth = _this._getLineWidth(ctx, textLines[i]);
                    var lineLeftOffset = _this._getLineLeftOffset(lineWidth);

                    ctx.fillRect(
                    _this._getLeftOffset() + lineLeftOffset,
                    //(offset + (i * _this._getHeightOfLine(ctx, i, textLines))) - halfOfVerticalBox,
                    top, lineWidth, 1);
                    /*1 is used For Line thikness of */
                }
            }

            var fractionOfFontSize = this.fontSize / 4;


            if (this.textDecoration.indexOf('underline') > -1) {
                renderLinesAtOffset(0 - 5);
            }
            if (this.textDecoration.indexOf('line-through') > -1) {
                renderLinesAtOffset(fractionOfFontSize);
            }
            if (this.textDecoration.indexOf('overline') > -1) {
                renderLinesAtOffset(this.fontSize * this.lineHeight - fractionOfFontSize);
            }
        },
        /**
            * @private
            * @param {Number} lineTopOffset Line top offset
            * @param {Number} textLeftOffset Text left offset
            * @param {Array} textLines Array of all text lines
            * @return {Object}
            */
        _getSVGTextAndBg: function (lineTopOffset, textLeftOffset, textLines) {
            var textSpans = [], textBgRects = [], i, lineLeftOffset, len, lineTopOffsetMultiplier = 1;


            // bounding-box background
            if (this.backgroundColor && this._boundaries) {

                textBgRects.push(
                  '<rect ',
                    this._getFillAttributes(this.backgroundColor),
                    ' x="',
                    toFixed(-this.width / 2, 2),
                    '" y="',
                    toFixed(-this.height + (textLines.length * this.lineHeight * this.fontSize) / 2, 2),
                    '" width="',
                    toFixed(this.width, 2),
                    '" height="',
                    toFixed(this.height, 2),
                  '"></rect>');
            }

            // text and text-background
            var lineHeights = 0;
            var top = 0;
            for (i = 0, len = textLines.length; i < len; i++) {
                if (parseFloat(this.lineHeight) == 1.3) {
                    var heightOfLine = this._getHeightOfLine();
                    lineHeights += heightOfLine;
                    var totalLineHeight = textLines.length * heightOfLine;

                    var totalLineHeight = textLines.length * heightOfLine;
                    top = this.getTopPositionOfText('', textLines, totalLineHeight, lineHeights, top);
                    //top = (top - heightOfLine);
                    if (parseFloat(this.lineHeight) == 1.3)
                        top = ((top - heightOfLine) + 1) + 5.5;

                    if (textLines[i] !== '') {

                        lineLeftOffset = (this._boundaries && this._boundaries[i]) ? toFixed(this._boundaries[i].left, 2) : 0;
                        textSpans.push(
                          '<tspan x="',
                            lineLeftOffset, '" ',
                            (i === 0 || this.useNative ? 'y' : 'dy'), '="',
                            top, '" ',
                            // doing this on <tspan> elements since setting opacity on containing <text> one doesn't work in Illustrator
                            this._getFillAttributes(this.fill), '>',
                            fabric.util.string.escapeXml(textLines[i]),
                          '</tspan>'
                        );
                        lineTopOffsetMultiplier = 1;




                    }
                    else {
                        // in some environments (e.g. IE 7 & 8) empty tspans are completely ignored, using a lineTopOffsetMultiplier
                        // prevents empty tspans
                        lineTopOffsetMultiplier++;
                    }


                } else {
                    var topOffset = toFixed(this.useNative ? ((lineTopOffset * i) - this.height / 2) : (lineTopOffset * lineTopOffsetMultiplier), 2);
                    if (this.vAlign === 'middle') {

                        topOffset = (lineTopOffset * i) - lineTopOffset * textLines.length * this.lineHeight / 2 + 1;

                    } else if (this.vAlign === 'top') {
                        topOffset = (lineTopOffset * i) - lineTopOffset * textLines.length * this.lineHeight / 2;

                        topOffset = topOffset - ((this.height - (lineTopOffset * textLines.length * this.lineHeight)) / 2) + 1
                    } else if (this.vAlign === 'bottom') {
                        topOffset = (lineTopOffset * i) - lineTopOffset * textLines.length * this.lineHeight / 2;

                        topOffset = topOffset + ((this.height - (lineTopOffset * textLines.length * this.lineHeight)) / 2) + 1
                    }

                    if (textLines[i] !== '') {

                        lineLeftOffset = (this._boundaries && this._boundaries[i]) ? toFixed(this._boundaries[i].left, 2) : 0;
                        textSpans.push(
                          '<tspan x="',
                            lineLeftOffset, '" ',
                            (i === 0 || this.useNative ? 'y' : 'dy'), '="',
                            topOffset, '" ',
                            // doing this on <tspan> elements since setting opacity on containing <text> one doesn't work in Illustrator
                            this._getFillAttributes(this.fill), '>',
                            fabric.util.string.escapeXml(textLines[i]),
                          '</tspan>'
                        );
                        lineTopOffsetMultiplier = 1;




                    }
                    else {
                        // in some environments (e.g. IE 7 & 8) empty tspans are completely ignored, using a lineTopOffsetMultiplier
                        // prevents empty tspans
                        lineTopOffsetMultiplier++;
                    }


                }

                if (!this.textBackgroundColor || !this._boundaries) continue;

                textBgRects.push(
                  '<rect ',
                    this._getFillAttributes(this.textBackgroundColor),
                    ' x="',
                    toFixed(textLeftOffset + this._boundaries[i].left, 2),
                    '" y="',
                    /* an offset that seems to straighten things out */
                    toFixed((lineTopOffset * i) - this.height / 2, 2),
                    '" width="',
                    toFixed(this._boundaries[i].width, 2),
                    '" height="',
                    toFixed(this._boundaries[i].height, 2),
                  '"></rect>');
            }
            return {
                textSpans: textSpans,
                textBgRects: textBgRects
            };
        },
        /**
       * @private
       * @param {CanvasRenderingContext2D} ctx Context to render on
       * @param {Array} textLines Array of all text lines
       */
        _renderTextStroke: function (ctx, textLines) {
            if (!this.stroke && !this.skipFillStrokeCheck) return;


            var lineHeights = 0;
            var top = 0;

            ctx.save();
            if (this.strokeDashArray) {
                // Spec requires the concatenation of two copies the dash list when the number of elements is odd
                if (1 & this.strokeDashArray.length) {
                    this.strokeDashArray.push.apply(this.strokeDashArray, this.strokeDashArray);
                }
                supportsLineDash && ctx.setLineDash(this.strokeDashArray);
            }

            ctx.beginPath();
            for (var i = 0, len = textLines.length; i < len; i++) {
                var heightOfLine = this._getHeightOfLine(ctx, i, textLines);
                lineHeights += heightOfLine;
                var totalLineHeight = textLines.length * heightOfLine;
                top = this.getTopPositionOfText(ctx, textLines, totalLineHeight, lineHeights, top)
                var position = 0;

                this._drawTextLine(
                  'strokeText',
                  ctx,
                  textLines[i],
                  this._getLeftOffset(),
                  top,
                  i
                );
            }
            ctx.closePath();
            ctx.restore();
        },
        /**
         * @private
         * @param {String} method Method name ("fillText" or "strokeText")
         * @param {CanvasRenderingContext2D} ctx Context to render on
         * @param {String} line Text to render
         * @param {Number} left Left position of text
         * @param {Number} top Top position of text
         * @param {Number} lineIndex Index of a line in a text
         */
        _drawTextLine: function (method, ctx, line, left, top, lineIndex) {

            // short-circuit
            if (this.textAlign !== 'justify') {
                this._drawChars(method, ctx, line, left, top, lineIndex);
                return;
            }

            var lineWidth = ctx.measureText(line).width;
            var totalWidth = this.width;

            if (totalWidth > lineWidth) {
                // stretch the line

                var words = line.split(/\s+/);
                var wordsWidth = ctx.measureText(line.replace(/\s+/g, '')).width;
                var widthDiff = totalWidth - wordsWidth;
                var numSpaces = words.length - 1;
                var spaceWidth = widthDiff / numSpaces;

                var leftOffset = 0;
                for (var i = 0, len = words.length; i < len; i++) {
                    this._drawChars(method, ctx, words[i], left + leftOffset, top, lineIndex);
                    leftOffset += ctx.measureText(words[i]).width + spaceWidth;
                }
            }
            else {
                this._drawChars(method, ctx, line, left, top, lineIndex);
            }
        },
        _drawChars: function (method, ctx, chars, left, top) {
            ctx[method](chars, left, top);
        },




    });
    /*
     * Synchronous loaded object
     */
    fabric.Textbox.fromObject = function (object) {

        var instance = new fabric.Textbox(object.originalText, clone(object), function () {
            return instance && instance.canvas && instance.canvas.renderAll();
        });
        return instance;
    };
})(typeof exports != 'undefined' ? exports : this);// JavaScript Document

/* ====  Textbox End  =====*/