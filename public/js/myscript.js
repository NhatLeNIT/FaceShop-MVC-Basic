/**
 * Created by quinhatpy@gmail.com on 16-Nov-16.
 */
function xacnhanxoa (msg) {
    if(window.confirm(msg)) {
        return true;
    }
    return false;
}

// select image and display
function showImage(src,target) {
    var fr=new FileReader();
    // when image is loaded, set the src of the image where you want to display it
    fr.onload = function(e) { target.src = this.result; };
    src.addEventListener("change",function() {
        // fill fr with image data
        fr.readAsDataURL(src.files[0]);
    });
}
