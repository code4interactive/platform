
var platform = {};

function jsRedirect(redirectPath) {
    console.log("Redirecting:"+redirectPath);
    loadingLayer(true);
    window.location=redirectPath;
}

function isset () {
    var a=arguments, l=a.length, i=0, undef;
    if (l===0) {
        throw new Error('Empty isset');
    }
    while(i!==l){
        if(a[i]===undef||a[i]===null){
            return false;
        }
        i++;
    }
    return true;
}