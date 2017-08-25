(function (global) {
    'use strict';
	/**
	 * it is extension of path object
	 */
    var fabric = global.fabric || (global.fabric = {}),
        extend = fabric.util.object.extend,
        clone = fabric.util.object.clone,
        toFixed = fabric.util.toFixed;

    if (fabric.CustomPath) {
        fabric.warn('fabric.CustomPath is already defined');
        return;
    }
    if (!fabric.Object) {
        fabric.warn('fabric.CustomPath requires fabric.Object');
        return;

    }


    fabric.CustomPath = fabric.util.createClass(fabric.Path,{
		
		
        type: 'CustomPath',
		
        originX: 'center',
		
        originY: 'center',
		
        left: 1, // because bug was producing
		
        top: 1,
		
		fill : null,
		
		stroke: "#000",

		lockUniScaling: true,
		
		opacity:0.1,

        id: 'customPath_1',

        linkId: 'customPath_1',
		
		 /**
         * Gets a fabric.Point at a parametric distance along the current fabric.Path
         * @public
         * @param {Number} distance Parametric distance along the path created by the fabric.Path.
         * @param {Boolean} adjustForCanvas Adjust the position so that it means something to the canvas. Default: true.
         * @param {SVGPathElement} svgPath SVGPathElement that represents the current fabric.Path.
         * @return {fabric.Point} Represents point on line. Includes an extra property, "distance", which is the distance along the line the point exists at.
         */
        getPointAtLength: function(distance, adjustForCanvas, svgPath) {
			//console.log('CustomPath','getPointAtLength', 1);
            var point = new fabric.Point(0, 0);
            adjustForCanvas = !(adjustForCanvas == null) ? adjustForCanvas : true;
            point.distance = 0;
            try {
                // Get SVGPathElement from SVG:PATH element.
                if (!svgPath) {
                    svgPath = this.getSVGPathElement();
                }
                // Get point with (x, y).
                var svgPoint = svgPath.getPointAtLength(distance);
                var offset = new fabric.Point(0, 0);
                if (adjustForCanvas) {
                    var zeroPoint = (distance == 0) ? svgPoint : svgPath.getPointAtLength(0);
                    offset.setXY(this.left - zeroPoint.x, this.top - zeroPoint.y);
                }
                // Abstract the point with the distance it represents along the line.
                point.setXY(svgPoint.x + offset.x, svgPoint.y + offset.y);
                point.distance = distance;
                // Send the point back.
                return point;
            } catch(e) {}
            return point;
        },
		
        /**
         * Gets an SVGPathElement DOM element that represents the current fabric.Path, may include caching
         * @public
         * @return {SVGPathElement}
         */
        getSVGPathElement: function() {
			//console.log('CustomPath','getSVGPathElement', 2);
            if (this.wantSVGPathCaching) {
                if (!this._cachedSVGPathElement) {
                    this._cachedSVGPathElement = this._getSVGPathElement();
                } else {
                    var currentSVGData = this.getSVGData();
                    if (this._cachedSVGPathElement.getAttribute("d") != currentSVGData) {
                        this._cachedSVGPathElement.setAttribute("d", currentSVGData);
                    }
                }
                return this._cachedSVGPathElement;
            } else
                return this._getSVGPathElement();
        },
		
		/**
         * Gets an SVGPathElement DOM element that represents the current fabric.Path
         * @private
         * @return {SVGPathElement}
         */
        _getSVGPathElement: function() {
			//console.log('CustomPath','_getSVGPathElement', 3);
            // Obtain the data of the path element (ex: "M 0 0 L 100 100").
            var svgCommands = this._getSVGData();
            // Create an SVGPathElement.
            var svgPath = fabric.document.createElementNS('http://www.w3.org/2000/svg', 'path');
            // Add the data.
            svgPath.setAttribute("d", svgCommands);
            // Add the presentation styles.
            svgPath.setAttribute("style", this.getSvgStyles());
            // Add the transformation.
            //console.log(this.getSvgTransform());

            svgPath.setAttribute("transform", this.getSvgTransform() + this.getSvgTransformMatrix());
            // Add the line cap.
            svgPath.setAttribute("stroke-linecap", "round");
            // Send it back.
            return svgPath;
        },
		
		/**
         * Get a string of data approximately representative of the commands of the "data" attribute of an SVG:PATH
         * @private
         * @param {Array} path Points representative of an SVG:PATH, like [["M", 0, 0], ["L", 100, 100],].
         * @return {String} Points in format like: "M 0 0 L 100 100".
         */
        _getSVGData: function(path) {
			//console.log('CustomPath','_getSVGData', 4);
            path = !(path == null) ? path : this.path;
            var chunks = [];
            for (var i = 0, len = path.length; i < len; i++) {
                chunks.push(path[i].join(' '));
            }
            // Yield something like: M 0 0 L 100 100
            return chunks.join(' ');
        },
		
		/**
         * Get a string of data representative of the commands of the "data" attribute of an SVG:PATH, which may include caching and approximation
         * @private
         * @return {String} Points in format like: "M 0 0 L 100 100".
         */
        getSVGData: function() {
			//console.log('CustomPath','getSVGData', 5);
            // If caching is enabled, get the cached data. Otherwise, get recalculate and return the SVG data (ex. "M 0 0 L 100 100").
            if (this.wantSVGPathCaching) {
                // If there is no cached path array or if there is no cached SVG data string or if the cache and the current path array are not equivalent, refresh the cache.
                if (!this._cachedPathArray || !this._cachedSVGData || !this.__arrayEqualsCurrentPathArray(this._cachedPathArray)) {
                    this._cachedPathArray = this.path;
                    this._cachedSVGData = (this.wantApproximationDetail) ? this._getApproximatedSVGData() : this._getSVGData();
                }
                // Return the cached SVG data (ex. "M 0 0 L 100 100").
                return this._cachedSVGData;
            } else {
                return this._getSVGData();
            }
        }
        
    });

    fabric.CustomPath.fromObject = function(object) {
        var clonedObject = fabric.util.object.clone(object);
        var instance = new fabric.CustomPath(object.path, clonedObject, function () {
            return instance && instance.canvas && instance.canvas.renderAll();
        });
        return instance;
    };

})(typeof exports != 'undefined' ? exports : this);

