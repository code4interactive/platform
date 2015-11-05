



var WebCodeCamJQueryTxt = "innerText" in HTMLElement.prototype ? "innerText" : "textContent";
var WebCodeCamJQueryArg = {
    resultFunction: function(resText, lastImageSrc) {
        var aChild = document.createElement('li');
        aChild[WebCodeCamJQueryTxt] = resText;
        document.querySelector('body').appendChild(aChild);
    }
};
/* ----------------------------------------- Available parameters -----------------------------------------*/
var WebCodeCamJQueryOptions = {
    DecodeQRCodeRate: 5,            // null to disable OR int > 0 !
    DecodeBarCodeRate: 5,           // null to disable OR int > 0 !
    frameRate: 15,                  // 1 - 25
    width: 220,                     // canvas width
    height: 150,                    // canvas height
    constraints: {                  // default constraints
        video: {
            mandatory: {
                maxWidth: 1280,
                maxHeight: 720
            },
            optional: [{
                sourceId: true
            }]
        },
        audio: false
    },
    flipVertical: false,            // boolean
    flipHorizontal: false,          // boolean
    zoom: 2,                       // if zoom = -1, auto zoom for optimal resolution else int
    beep: "/qrReader/audio/beep.mp3",// string, audio file location
    brightness: 0,                  // int
    autoBrightnessValue: false,     // functional when value autoBrightnessValue is int
    grayScale: false,               // boolean
    contrast: 0,                    // int
    threshold: 0,                   // int
    sharpness: [],                  // to On declare matrix, example for sharpness ->  [0, -1, 0, -1, 5, -1, 0, -1, 0]
    resultFunction: function(resText, lastImageSrc) { //resText as decoded code, lastImageSrc as image source
        console.log(resText);
        alert(resText);
    },
    cameraSuccess: function(stream) {                   //callback funtion to camera success
        console.log('Camera Initialized');
    },
    canPlayFunction: function() {                       //callback funtion to can play
        console.log('canPlayFunction');
    },
    getDevicesError: function(error) {                  //callback funtion to get Devices error
        console.log(error);
    },
    getUserMediaError: function(error) {                //callback funtion to get usermedia error
        console.log(error);
    },
    cameraError: function(error) {                      //callback funtion to camera error
        console.log(error);
    }
};
$(document).ready(function () {
/*------------------------------------ Declarations and initializing ------------------------------------*/
//new WebCodeCamJS("canvas").init(WebCodeCamJQueryArg);
/* OR */
//var canvas = document.querySelector('#webcodecam-canvas');
//new WebCodeCamJS(canvas).init();
/* OR */
//new WebCodeCamJS('#webcodecam-canvas').init();

/*---------------------------- Example initializations using jquery version ----------------------------*/
////////////////var decoder = $("#webcodecam-canvas").WebCodeCamJQuery(WebCodeCamJQueryOptions).data().plugin_WebCodeCamJQuery;
/* Chrome & Spartan: build select menu
 *  Firefox: the default camera initializes, return decoder object
 */
//decoder.buildSelectMenu("#camera-select");
//simple initialization
//decoder.testListDevices();
///////////////////////decoder.init();

/* ---------------------------------------- Available Functions: ----------------------------------------*/
/* camera stop & delete stream */
//decoder.stop();
/* camera play, restore process */
////////////////////////decoder.play();
/* get current image from camera */
//decoder.getLastImageSrc();
/* get optimal zoom */
//decoder.getOptimalZoom();
/* Configurable options */
//decoder.options['parameter'];
/* Example:
 ** decoder.options.brightness = 20;         - set brightness to 20
 ** decoder.options.DecodeQRCodeRate = null; - disable qrcode decoder
 */
});