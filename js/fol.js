/**
 * Created by revelation on 08/09/2020.
 * Reedax.IO Technologies Limited *
 * Developer Revelation A.F *
 */
//uploads functions
function doUploadDp() {
    $('#filedp').trigger('click');
    $(document).ready(function () {

        $('#filedp').change(function () {

            $(this).simpleUpload(BASE_URL + "/api/uploads/profile-dp", {
                name: 'file-image',
                data: _contest,
                allowedExts: ["jpg", "jpeg", "jpe", "jif", "jfif", "jfi", "png", "gif"],
                allowedTypes: ["image/pjpeg", "image/jpeg", "image/png", "image/x-png", "image/gif", "image/x-gif"],
                maxFileSize: 900000,
                beforeSend: function (xhr, settings) {
                    xhr.setRequestHeader('ssk', _tmp_ssk);
                },
                start: function (file) {
                    //upload started
                    vue.uploading = "Please wait...";
                    vue.loading = true;
                    console.log("upload started");
                },

                progress: function (progress) {
                    //received progress
                    vue.uploading = "Please wait..." + Math.round(progress);
                    vue.loading = true;
                    //console.log("upload progress: " + Math.round(progress) + "%");
                },

                success: function (data) {
                    //upload successful
                    vue.uploading = "Image Changed !";
                    setTimeout(function () {
                        vue.loading = false;
                        window.location.reload();
                    }, 2000);
                    console.log("upload successful!");
                    console.log(data);
                },

                error: function (error) {
                    //upload failed
                    vue.uploading = "File too big (Retry)";
                    vue.loading = false;
                    //console.log("upload error: " + error.name + ": " + error.message);
                }

            });

        });

    });

}