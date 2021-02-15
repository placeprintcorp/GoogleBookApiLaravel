
    
            /* this is cropperjs config file to use image cropper plugin
                three steps required before use this file
                1 -> initialize the cropper_config_options 
                2 -> call saveImage() on submit button click
                3 -> ajaxSuccess() method to perform action after success          
            */

            //console.log(cropper_config_options);
            
            // Cropper.noConflict();

           var cropper;
           var preloader = $('.preloader-container');
        
            function initCropper ( image, inputImage, options ) {
                console.log(image, inputImage, options);
                // cropper is a global variable decalare at the top of the file
                cropper = new Cropper(image, {
                    preview: ".img-preview",
                    minContainerWidth: options.containerWidth,
                    minContainerHeight: options.containerHeight,
                    minCropBoxWidth: options.cropBoxWidth,
                    minCropBoxHeight: options.cropBoxHeight,
                    dragMode: 'move',
                    aspectRatio: options.aspectRatio,
                    restore: false,
                    center: false,
                    //cropBoxMovable: false,
                    cropBoxResizable: false,
                    toggleDragModeOnDblclick: false,
                    checkCrossOrigin: true,
                    checkOrientation: false,
                });


                if (window.FileReader) {
                    inputImage.onchange = function() {
                        var fileReader = new FileReader(),
                                files = this.files,
                                file;
    
                        if (!files.length) {
                            return;
                        }
    
                        file = files[0];
    
                        if (/^image\/\w+$/.test(file.type)) {
                            fileReader.readAsDataURL(file);
                            fileReader.onload = function () {
                                
                                inputImage.value = '';
                                cropper.reset();
                                cropper.replace(this.result);
                            };
                        } else {
                            /* lobibox message shoMessage() exists in helper_function.js */
                            showMessage("error", "Please choose an image file.");
                        }
                    };
                } else {
                    inputImage.addClass("hide");
                }

            }

            function postAjax( url, attachData ) {
                
                    preloader.show();
                    
                    // Use `jQuery.ajax` method for example
                    $.ajax(url, {
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken,
                            'Access-Control-Allow-Origin': base_url,
                        },
                        method: 'POST',
                        data: attachData,
                        processData: false,
                        contentType: false,
                        success() {
                            preloader.hide();
                            /* be ready with ajaxSuccess() function before use this script file */
                            if ( 'undefined' == typeof ajaxSuccess ) {
                                showMessage('success', 'Upload file success!');
                            } else {
                                ajaxSuccess();
                            }
                            
                            console.log('Upload success');
                        },
                        error(e) {
                            preloader.hide();
                            /* Lobibox notification plugin */
                            if ( 'undefined' == typeof ajaxError ) {
                                showMessage('error', 'Upload file error!');
                            } else {
                                ajaxError(e);
                            }

                            console.log('Upload error', e);
                        },
                    });
            }
       
       
    
  