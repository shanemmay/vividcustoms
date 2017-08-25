(function (global) {
    'use strict';
    /**
     * Getting methods needed for from Util class.
     */
    var fabric = global.fabric || (global.fabric = {}),
        extend = fabric.util.object.extend,
        clone = fabric.util.object.clone,
        toFixed = fabric.util.toFixed;

    if (fabric.CircleText) {
        fabric.warn('fabric.CircleText is already defined.');
        return;
    }
    if (!fabric.PathText) {
        fabric.warn('fabric.CircleText requires fabric.PathText');
        return;

    }
  	
	
	// Extend fabric.PathText to include the necessary methods to render the text along a Arc.
    fabric.CircleText = fabric.util.createClass(fabric.PathText, {
		
	type: 'CircleText',
       
    /**
     * Radius of which Arc have to draw
     * @type Integer
     */
    radius: 150,

    /**
     * Angle from which Arc have to start drawing.
     * @type Integer
     */
    startAngle: 0,

    /**
     * Angle on which Arc have to stop drawing.
     * @type Integer
     */
    endAngle: 360,

    /**
     * Constant value used for calculating Angle for the Arc.
     * @type Integer
     */
	// Roughly 1/1000th of a degree, see below
	EPSILON : 0.00001,
	
	/**
     * Direction of drawing.
     * @type Integer
     */
	clockwise: true,

    /*Setting Default Properties */
	originX: 'center',
    originY: 'center',
    id: 'circleText_1',

    /*Initializing options and updating options if its value does not exists
    * @param: {Object} [objects] Object that needs to add
    * @param: {Object} [options] options that need to set
    * */
	initialize: function (objects, options) {
            options || (options = {});
			options = this._getUpdatedOptions(options);
            this.callSuper('initialize', objects, options);
			
    },

     /*Updating options if its value does not exists that are needed for the path string and generating it
     * @param: {Object} [options] options that need to set.
     * @return: {Object} Return the updated option set.
     */
	_getUpdatedOptions: function(options){
		
		options.endAngle = (options.endAngle)? parseFloat(options.endAngle) : this.endAngle;
		options.startAngle = (options.startAngle)? parseFloat(options.startAngle) : this.startAngle;
		options.radius = (options.radius)? parseFloat(options.radius) : this.radius;
		options.clockwise = (typeof options.clockwise == "boolean")? options.clockwise : this.clockwise;
		options.pathString = this._getPathObject(options);
		return options;
			
	},
	
	_getPathObject: function(options){
		var xCenter = (options.radius / 2);
		var yCenter = (options.radius / 2);
		var pathString = this._getPathString(xCenter, yCenter, options.radius, options.startAngle, options.endAngle, options.clockwise);
		return pathString;	
	},
	
	_set: function(prop, value) {
		this.callSuper('_set', prop, value);
		 if(prop == 'endAngle' || prop == 'startAngle' || prop == 'radius' || prop == 'clockwise'){
			 var options = {};
			 options[prop] = value;
			 options = this._getUpdatedOptions(options);
			 prop = 'pathString'; //Hack because does not found best solution for get key
			 value = options.pathString;
			this.callSuper('_set', prop, value);
		 }
		 return this;
		 
    },

    /*
    * Filtering data that are needed for the drawing perfect circle. making start position to 0 degrees.
    * */

    _filterData: function(radius, startAngle, endAngle, clockwise){
        var startAngle = startAngle;
        var endAngle = endAngle;
        var lastCharToConcat = '';
		var clockwise = clockwise;
        if(typeof radius == "undefined" || isNaN(radius)){
            radius = 0;
        }
        if(startAngle == endAngle){
            endAngle--;
        }
        else if(startAngle == 0 && endAngle == 360){
            endAngle--;
            lastCharToConcat = " Z";
        }
        else if(startAngle == 360 && endAngle == 0){
            startAngle--;
            lastCharToConcat = " Z";
        }
        else if(startAngle == 360)
        {
            startAngle--;
        }
        else if(endAngle == 360){
            endAngle--;
        }
        /*For making start position to 0 degree in left hand side*/
        startAngle += -180;
        endAngle += -180;
		if(!clockwise){
			endAngle = [startAngle, startAngle = endAngle][0];
		}
        return { radius:radius, startAngle:startAngle, endAngle:endAngle, lastCharToConcat:lastCharToConcat };
    },
	
	_getPathString: function(xCenter, yCenter, radius, startAngle, endAngle, clockwise)
		{
           var pathInput = this._filterData(radius, startAngle, endAngle, clockwise);
            var radius = pathInput.radius,
                startAngle = pathInput.startAngle,
                endAngle = pathInput.endAngle,
                lastCharToConcat = pathInput.lastCharToConcat;

		   /*Start Angle*/ 
		   var a1 = startAngle * (Math.PI / 180);
		   /*End Angle*/ 
		   var a2 = endAngle * (Math.PI / 180); 
		   /*Radius*/ 
		   var curves = this._createArc(radius, a1, a2); 
		   var pathData = '';
			for(var curve in curves)
			{
				var curve = curves[curve];
				if (!pathData)
					pathData =  "M " + (curve.x1 + xCenter) + " " + (curve.y1 + yCenter);
				
				pathData += 
					" C " + (curve.x2 + xCenter) + " " + (curve.y2 + yCenter) + 
					" " +   (curve.x3 + xCenter) + " " + (curve.y3 + yCenter) + 
					" " +   (curve.x4 + xCenter) + " " + (curve.y4 + yCenter); 
			}
			
			pathData += lastCharToConcat;
			return pathData;
		},
            
           
            
		/**
		 *  Return a array of objects that represent bezier curves which approximate the 
		 *  circular arc centred at the origin, from startAngle to endAngle (radians) with 
		 *  the specified radius.
		 *  
		 *  Each bezier curve is an object with four points, where x1,y1 and 
		 *  x4,y4 are the arc's end points and x2,y2 and x3,y3 are the cubic bezier's 
		 *  control points.
		 */
		_createArc : function(radius, startAngle, endAngle)
		{
			// normalize startAngle, endAngle to [-2PI, 2PI]
			
			var twoPI = Math.PI * 2;
			startAngle = startAngle % twoPI,
			endAngle = endAngle % twoPI;
			
			// Compute the sequence of arc curves, up to PI/2 at a time.  Total arc angle
			// is less than 2PI.
			
			var curves = [];
			var piOverTwo = Math.PI / 2.0;
			var sgn = (startAngle < endAngle) ? 1 : -1;
			
			var a1 = startAngle;
			for (var totalAngle = Math.min(twoPI, Math.abs(endAngle - startAngle)); totalAngle > this.EPSILON; ) 
			{
				var a2 = a1 + sgn * Math.min(totalAngle, piOverTwo);
				curves.push(this._createSmallArc(radius, a1, a2));
				totalAngle -= Math.abs(a2 - a1);
				a1 = a2;
			}
			
			return curves;
		},
		
		/**
		 *  Cubic bezier approximation of a circular arc centered at the origin, 
		 *  from (radians) a1 to a2, where a2-a1 < pi/2.  The arc's radius is r.
		 * 
		 *  Returns an object with four points, where x1,y1 and x4,y4 are the arc's end points
		 *  and x2,y2 and x3,y3 are the cubic bezier's control points.
		 * 
		 *  This algorithm is based on the approach described in:
		 *  A. Riškus, "Approximation of a Cubic Bezier Curve by Circular Arcs and Vice Versa," 
		 *  Information Technology and Control, 35(4), 2006 pp. 371-378.
		 */
		_createSmallArc: function(r, a1, a2)
		{
			// Compute all four points for an arc that subtends the same total angle
			// but is centered on the X-axis
			
			var a = (a2 - a1) / 2.0;  
			
			var x4 = r * Math.cos(a);
			var y4 = r * Math.sin(a);
			var x1 = x4;
			var y1 = -y4
			
			var k = 0.5522847498;
			var f = k * Math.tan(a);
			
			var x2 = x1 + f * y4;
			var y2 = y1 + f * x4;
			var x3 = x2; 
			var y3 = -y2;
			
			// Find the arc points actual locations by computing x1,y1 and x4,y4 
			// and rotating the control points by a + a1
			
			var ar = a + a1;
			var cos_ar = Math.cos(ar);
			var sin_ar = Math.sin(ar);
			
			return {
				x1: r * Math.cos(a1), 
					y1: r * Math.sin(a1), 
					x2: x2 * cos_ar - y2 * sin_ar, 
					y2: x2 * sin_ar + y2 * cos_ar, 
					x3: x3 * cos_ar - y3 * sin_ar, 
					y3: x3 * sin_ar + y3 * cos_ar, 
					x4: r * Math.cos(a2), 
					y4: r * Math.sin(a2)
					};
		},
	
	 /**
     * Returns object representation of an instance
     * @param {Array} [propertiesToInclude] Any properties that you might want to additionally include in the output
     * @return {Object} Object representation of an instance
     */
    toObject: function(propertiesToInclude) {
		//console.log('toObject',28);
      // Point to the correct superclass method for cases where this.constructor.superclass does not point to fabric.Object (i.e. fabric.IText).
      var fn = fabric.PathText.prototype["toObject"];
      fn = fn.bind(this);
      // Create the object with just the wanted data.
      var object = fabric.util.object.extend(fn(propertiesToInclude), {
		radius:					     this.radius,
		startAngle: 				 this.startAngle,
		endAngle: 					 this.endAngle,
		clockwise: 					 this.clockwise
      });
      // Remove default values if requested.
      if (!this.includeDefaultValues) {
        this._removeDefaultValues(object);
      }
      return object;
    }

	});
	
    /**
	 * Returns fabric.Text instance from an object representation
	 * @static
	 * @memberOf fabric.Text
	 * @param {Object} object Object to create an instance from
	 * @return {fabric.Text} Instance of fabric.Text
	 */
	fabric.CircleText.fromObject = function(object) {
	  var clonedObject = fabric.util.object.clone(object);
	  var instance = new fabric.CircleText(object.text, clonedObject, function () {
            return instance && instance.canvas && instance.canvas.renderAll();
        });
      return instance;
	};


})(typeof exports != 'undefined' ? exports : this);