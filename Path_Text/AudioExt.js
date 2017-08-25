


(function (global) {
    'use strict';
    /**
     * Getting methods needed for from Util class.
     */
    var fabric = global.fabric || (global.fabric = {}),
        extend = fabric.util.object.extend,
        clone = fabric.util.object.clone,
        toFixed = fabric.util.toFixed;

    if (fabric.Audio) {
        fabric.warn('fabric.Audio is already defined.');
        return;
    }
    if (!fabric.Image) {
        fabric.warn('fabric.Audio requires fabric.Image');
        return;

    }
  	
	
	// Extend fabric.Image to include the necessary methods to render the text along a Arc.
    fabric.Audio = fabric.util.createClass(fabric.Image, {
		
	 /**
     * Type of an object
     * @type String
     * @default
     */
	type: 'audio',
	
	  /**
	 * audioSrc value should be path of audio widget
	 * @type String
	 * @default	
	 */
	audioSrc: "",
	
	 /**
     * state value (should be one of "play", "pause") It define the current state of widget
     * @type String
     * @default
     */
    state: 'play',
	
	/**
     * loop value (should be one of "single", "repeat") It define the repeatation of track 
     * @type String
     * @default
     */
    loop: 'single',
	
	/**
     * duration value defines length of the track 
     * @type Number
     * @default
     */
    duration: 1,
	
	/**
     * muted value define is track is muted or not (should be one of true or false)
     * @type Boolean
     * @default
     */
    muted: false,
	
	/**
     * volume value (should be one of 0 to 5) it defines level of sound for track
     * @type Number
     * @default
     */
    volume: 5,
	
	/**
     * autoPlay value (should be one of true or false) it defines whether the track will be automatically played default.
     * @type Boolean
     * @default
     */
    autoPlay: true,
	
	 /*Initializing options and updating options if its value does not exists
    * @param: {Object} [objects] Object that needs to add
    * @param: {Object} [options] options that need to set
    * */
	initialize: function (objects, options) {
            options || (options = {});
            this.callSuper('initialize', objects, options);
			
    },
	
	 /**
     * Returns object representation of an instance
     * @param {Array} [propertiesToInclude] Any properties that you might want to additionally include in the output
     * @return {Object} Object representation of an instance
     */
    toObject: function(propertiesToInclude) {
      // Point to the correct superclass method for cases where this.constructor.superclass does not point to fabric.Object (i.e. fabric.IText).
      var fn = fabric.Image.prototype["toObject"];
      fn = fn.bind(this);
      // Create the object with just the wanted data.
      var object = fabric.util.object.extend(fn(propertiesToInclude), {
		audioSrc:					 this.audioSrc,
		state: 				 		 this.state,
		loop: 					 	 this.loop,
		duration: 					 this.duration,
		muted: 					 	 this.muted,
		volume: 					 this.volume,
		autoPlay: 					 this.autoPlay
      });
      // Remove default values if requested.
      if (!this.includeDefaultValues) {
        this._removeDefaultValues(object);
      }
      return object;
    }

	});
	
	
	/**
   * Creates an instance of fabric.Audio from its object representation
   * @static
   * @param {Object} object Object to create an instance from
   * @param {Function} [callback] Callback to invoke when an image instance is created
   */
  fabric.Audio.fromObject = function(object, callback) {
    fabric.util.loadImage(object.src, function(img) {
      fabric.Audio.prototype._initFilters.call(object, object, function(filters) {
        object.filters = filters || [ ];
        var instance = new fabric.Audio(img, object);
        callback && callback(instance);
      });
    }, null, object.crossOrigin);
  };


})(typeof exports != 'undefined' ? exports : this);