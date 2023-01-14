$(document).ready(function () {
    $('#submit').submit(function (e) {
        e.preventDefault();

        // image_select();
        $.ajax({
            url: window.location.pathname,
            type: "post",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function (data) {
                if (data >= 1) {
                    alert("Thêm ảnh thành công");

                    // ImagesFileAsURL();
                    image_select();
                } else {
                    alert("Thất bại");
                }
            }
        });
    });

});

var images = [];
function image_select() {
    var image = document.getElementById('file').files;
    for (i = 0; i < image.length; i++) {
        if (check_duplicate(image[i].name)) {
            images.push({
                "name": image[i].name,
                "url": URL.createObjectURL(image[i]),
                "file": image[i],
            })
        } else {
            alert(image[i].name + " is already added to the list");
        }
    }
    document.getElementById('ketqua').innerHTML = document.getElementById('ketqua').innerHTML + image_show();
}

function image_show() {
    var image = "";
    images.forEach((i) => {
         image += `<div class="col-md-4">
                <img src="`+ i.url +`" alt="Image">
          </div>`;
    })
    return image;
}

function check_duplicate(name) {
    var image = true;
    if (images.length > 0) {
        for (e = 0; e < images.length; e++) {
            if (images[e].name == name) {
                image = false;
                break;
            }
        }
    }
    return image;
}

// function ImagesFileAsURL() {
//     var fileSelected = document.getElementById('file').files;
//     if (fileSelected.length > 0) {
//         var fileToLoad = fileSelected[0];
//         var fileReader = new FileReader();
//         fileReader.onload = function (fileLoaderEvent) {
//             var srcData = fileLoaderEvent.target.result;
//             var newImage = document.createElement('img');
//             newImage.src = srcData;
//             document.getElementById('displayImg').innerHTML = newImage.outerHTML;
//         }
//         fileReader.readAsDataURL(fileToLoad);
//     }
// }