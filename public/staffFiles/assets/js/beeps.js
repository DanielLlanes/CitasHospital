function beep(url) {
  var file = url;
  let audioTrack = new Audio(file);
  audioTrack.preload = 'auto';
  //console.log("audio file " + file + "length:" + audioTrack.duration + "  sec.");
  audioTrack.onloadeddata = function () {
      //console.log("audio: " + file + " has successfully loaded."); 
  }; 
  audioTrack.load();
  audioTrack.play();
}