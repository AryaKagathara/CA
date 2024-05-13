/**
 * CodeDropz Uploader v1.3.7.2
 * Copyright 2018 Glen Mongaya
 * CodeDrop Drag&Drop Uploader
 * @version 1.3.7.2
 * @author CodeDropz, Glen Don L. Mongaya
 * @license The MIT License (MIT)
 */

// CodeDropz Drag and Drop Plugin
(function() {

    const CodeDropz_Uploader = function( settings ){

        // Generate & check nonce
        const form = document.querySelector('form.wpcf7-form');
        if( form ) {
            const data = new FormData();
            data.append('action', '_wpcf7_check_nonce');
            data.append('_ajax_nonce', dnd_cf7_uploader.ajax_nonce );
            fetch(dnd_cf7_uploader.ajax_url, { method: 'POST', body: data })
            .then(res => res.json())
            .then(({ data, success }) => success && (dnd_cf7_uploader.ajax_nonce = data))
            .catch(console.error)
        }

        // Parent input file type
        var input = this;

        // Define default options
        const defaultOptions = {
            handler: input,
            color: '#000',
            background: '',
            server_max_error: 'Uploaded file exceeds the maximum upload size of your server.',
            max_file: input.dataset.max ? input.dataset.max : 10, // default 10
            max_upload_size: input.dataset.limit ? input.dataset.limit : '10485760', // should be a bytes it's (5MB)
            supported_type: input.dataset.type ? input.dataset.type : 'jpg|jpeg|JPG|png|gif|pdf|doc|docx|ppt|pptx|odt|avi|ogg|m4a|mov|mp3|mp4|mpg|wav|wmv|xls',
            text: 'Drag & Drop Files Here',
            separator: 'or',
            button_text: 'Browse Files',
            on_success: '',
        };

        // Merge options with default options
        const options = Object.assign({}, defaultOptions, settings);

        // Get storage name
        var dataStorageName = input.dataset.name + '_count_files';

        // File Counter
        localStorage.setItem( dataStorageName, 1);

        // Template Container
        const cdropz_template = `
            <div class="codedropz-upload-handler">
                <div class="codedropz-upload-container">
                <div class="codedropz-upload-inner">
                    <${dnd_cf7_uploader.drag_n_drop_upload.tag}>${options.text}</${dnd_cf7_uploader.drag_n_drop_upload.tag}>
                    <span>${options.separator}</span>
                    <div class="codedropz-btn-wrap"><a class="cd-upload-btn" href="javascript:void(0)">${options.button_text}</a></div>
                </div>
                </div>
                <span class="dnd-upload-counter"><span>0</span> ${dnd_cf7_uploader.dnd_text_counter} ${parseInt(options.max_file)}</span>
            </div>
        `;

        // Wrap input fields
        const wrapper = document.createElement('div');

        // Begin to wrap upload fields
        wrapper.classList.add('codedropz-upload-wrapper');
        options.handler.parentNode.insertBefore(wrapper, options.handler);
        wrapper.appendChild(options.handler);

        // Remove special character
        options.supported_type = options.supported_type.replace(/[^a-zA-Z0-9| ]/g, "");

        // Element Handler
        const form_handler = options.handler.closest('form');
        const options_handler = options.handler.closest('.codedropz-upload-wrapper');
        const btnOBJ = form_handler.querySelector('input[type="submit"]');

        // Append Format
        options.handler.insertAdjacentHTML('afterend', cdropz_template);

        // preventing the unwanted behaviours
        ['drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop'].forEach(function(eventName) {
            options_handler.querySelector('.codedropz-upload-handler').addEventListener(eventName, function(e) {
                e.preventDefault();
                e.stopPropagation();
            });
        });

        // dragover and dragenter - add class
        ['dragover', 'dragenter'].forEach(function(eventName) {
            options_handler.querySelector('.codedropz-upload-handler').addEventListener(eventName, function(e) {
                options_handler.querySelector('.codedropz-upload-handler').classList.add('codedropz-dragover');
            });
        });

        // dragleave dragend drop - remove class
        ['dragleave', 'dragend', 'drop'].forEach(function(eventName){
            options_handler.querySelector('.codedropz-upload-handler').addEventListener(eventName, function(e) {
                options_handler.querySelector('.codedropz-upload-handler').classList.remove('codedropz-dragover');
            });
        });

        // Browse button clicked
        options_handler.querySelector('.cd-upload-btn').addEventListener('click', function(e){
            // stops the default action of an element from happening
            e.preventDefault();

            // Reset value
            options.handler.value = null;

            // Click input type[file] element
            options.handler.click();
        });

        // when dropping files
        options_handler.querySelector('.codedropz-upload-handler').addEventListener('drop', function(event) {
            // Run the uploader
            DND_Setup_Uploader(event.dataTransfer.files, 'drop');
        });

        // Trigger when input type[file] is click/changed
        options.handler.addEventListener('change', function(e) {
            // Run the uploader
            DND_Setup_Uploader(this.files, 'click');
        });
        
        // Remove accept attribute on mobile devices
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            input.removeAttribute('accept');
        }

        // Setup Uploader
        var DND_Setup_Uploader = function( files, action ) {

            // make sure we have files
            if (files.length == 0 ) return;

            // gathering the form data
            var formData = new FormData();

            // Append file
            //formData.append('supported_type', options.supported_type ); @note : removed due Vulnerability
            //formData.append('size_limit', options.max_upload_size );
            formData.append('action', 'dnd_codedropz_upload' );
            formData.append('type', action );
            formData.append('security', dnd_cf7_uploader.ajax_nonce );

            // CF7 - upload field name & cf7 id
            formData.append('form_id', input.dataset.id);
            formData.append('upload_name', input.dataset.name);

            // black list file types
            if( input.hasAttribute('data-black-list') ){
                formData.append('blacklist-types', input.dataset.blackList);
            }

            // remove has error
            const errorHandler = options.handler.querySelector('.has-error');
            if (errorHandler) {
                errorHandler.remove();
            }

            // Loop files
            for (const file of files) {

                // Reset upload file type
                if( typeof formData.delete !== 'undefined' ) {
                    formData.delete('upload-file');
                }

                // Limit file upload
                if( Number( localStorage.getItem(dataStorageName) ) > options.max_file ) {
                    var hasErrorMsg = options_handler.querySelector('span.has-error-msg');
                    if (!hasErrorMsg) {
                        var err_msg = dnd_cf7_uploader.drag_n_drop_upload.max_file_limit;
                        var errorMsgEl = document.createElement('span');
                        errorMsgEl.className = 'has-error-msg';
                        errorMsgEl.textContent = err_msg.replace('%count%', options.max_file);
                        options_handler.appendChild(errorMsgEl);
                    }
                    return false;
                }


                // Create progress bar
                const progressBarID = CodeDropz_Object.createProgressBar( file );
                var has_error = false;

                // File size limit - validation
                if (file.size > options.max_upload_size) {
                    const parentProgressBar = document.getElementById(progressBarID);
                    const errorSpan = document.createElement('span');
                    errorSpan.classList.add('has-error');
                    errorSpan.textContent = dnd_cf7_uploader.drag_n_drop_upload.large_file;
                    parentProgressBar.querySelector('.dnd-upload-details').appendChild(errorSpan);
                    has_error = true;
                }

                // Validate file type
                regex_type = new RegExp("(.*?)\.("+ options.supported_type +")$");
                if ( has_error === false && !( regex_type.test( file.name.toLowerCase() ) ) ) {
                    document.querySelector('#' + progressBarID + ' .dnd-upload-details').insertAdjacentHTML('beforeend', '<span class="has-error">' + dnd_cf7_uploader.drag_n_drop_upload.inavalid_type + '</span>');
                    has_error = true;
                }

                // Increment count
                localStorage.setItem( dataStorageName, ( Number( localStorage.getItem( dataStorageName ) ) + 1 ) );
            
                // Make sure there's no error
                if( has_error === false ) {

                    // Append file
                    formData.append('upload-file', file );

                    // Process ajax upload
                    var xhr = new XMLHttpRequest();

                    // Get progress bar element
                    var progressBar = document.getElementById( progressBarID );
                    var progressElement = progressBar.querySelector('.dnd-progress-bar');
                    var detailsElement = progressBar.querySelector('.dnd-upload-details');
                    var submitButton = form_handler.querySelector('input[type="submit"]');

                    xhr.open(form_handler.getAttribute('method'), options.ajax_url);
                    xhr.onreadystatechange = function() {
                        if (this.readyState === 4) {
                            if (this.status === 200) {
                                var response = JSON.parse(this.responseText);
                                if (response.success) {

                                    // Complete the progress bar
                                    CodeDropz_Object.setProgressBar(progressBarID, 100);

                                    // Callback on success
                                    if (typeof options.on_success === "function") {
                                        options.on_success.call(this, input, progressBarID, response);
                                    }

                                } else {
                                    progressElement.remove();
                                    detailsElement.insertAdjacentHTML('beforeend', '<span class="has-error">'+ response.data +'</span>');
                                    submitButton.classList.remove('disabled');
                                    submitButton.removeAttribute('disabled');
                                    progressBar.classList.remove('in-progress');
                                }
                            } else {
                                progressElement.remove();
                                detailsElement.insertAdjacentHTML('beforeend', '<span class="has-error">'+ options.server_max_error +'</span>');
                                submitButton.classList.remove('disabled');
                                submitButton.removeAttribute('disabled');
                                progressBar.classList.remove('in-progress');
                            }
                        }
                    };
                    xhr.upload.addEventListener("progress", function(event){
                        if ( event.lengthComputable ) {

                            var percentComplete = ( event.loaded / event.total );
                            var percentage = parseInt( percentComplete * 100 );

                            // Make progress on the loading
                            CodeDropz_Object.setProgressBar( progressBarID, percentage - 1 );
                        }
                    }, false);

                    xhr.send(formData);

                }
            }

        }
        // End of Uploader function

        // CodeDropz object and functions
        var CodeDropz_Object = {

            // Create progress bar
            createProgressBar : function( file ) {

                // Setup progress bar variable
                var upload_handler = options_handler.querySelector('.codedropz-upload-handler');
                var generated_ID = 'dnd-file-' + Math.random().toString(36).substr(2, 9);

                // Setup progressbar elements
                var fileDetails = `
                    <div class="dnd-upload-image">
                        <span class="file"></span>
                    </div>
                    <div class="dnd-upload-details">
                        <span class="name"><span>${file.name}</span><em>(${CodeDropz_Object.bytesToSize(file.size)})</em></span>
                        <a href="javascript:void(0)" title="${dnd_cf7_uploader.drag_n_drop_upload.delete.title}" class="remove-file" data-storage="${dataStorageName}">
                        <span class="dnd-icon-remove"></span>
                        </a>
                        <span class="dnd-progress-bar"><span></span></span>
                    </div>
                `;

                // Create new element and insert after upload_handler
                var statusElement = document.createElement('div');
                statusElement.id = generated_ID;
                statusElement.className = 'dnd-upload-status';
                statusElement.innerHTML = fileDetails;
                upload_handler.parentNode.insertBefore(statusElement, upload_handler.nextSibling);

                return generated_ID;

            },

            // Process progressbar ( Animate progress )
            setProgressBar : function( progressBarID, percent ) {

                const progressBar = document.getElementById( progressBarID );
                const statusBar = progressBar.querySelector('.dnd-progress-bar');

                //console.log(statusbar);
                if (statusBar) {

                    // Disable submit button
                    CodeDropz_Object.disableBtn(btnOBJ);

                    // Compute Progress bar
                    let progress_width = percent * statusBar.offsetWidth / 100;

                    // Set status bar in-progress
                    progressBar.classList.add('in-progress');

                    if (percent == 100) {
                        statusBar.querySelector('span').style.width = '100%';
                        statusBar.querySelector('span').textContent = `${percent}% `;
                    } else {
                        statusBar.querySelector('span').style.width = progress_width + 'px';
                        statusBar.querySelector('span').textContent = `${percent}% `;
                    }

                    if (percent == 100) {
                        progressBar.classList.add('complete');
                        progressBar.classList.remove('in-progress');
                    }
                }
                return false;

            },

            // Size Conversion
            bytesToSize : function( bytes ) {

                if( bytes === 0 )
                    return '0';

                kBytes = (bytes / 1024);
                fileSize = ( kBytes >= 1024 ? ( kBytes / 1024 ).toFixed(2) + 'MB' : kBytes.toFixed(2) + 'KB' );

                return fileSize;
            },

            // Disable button
            disableBtn : function( BtnOJB ) {
                if( BtnOJB  ) {
                    BtnOJB.classList.add('disable');
                    BtnOJB.disabled = true;
                }
            }
        };

	} // end fn.function

    // Remove File
    document.addEventListener("click", function(e) {
        if( !e.target.classList.contains("dnd-icon-remove") ) return;

        var _self = e.target,
            _dnd_status = _self.closest(".dnd-upload-status"),
            _parent_wrap = _self.closest(".codedropz-upload-wrapper"),
            removeStorageData = _self.parentElement.getAttribute("data-storage"),
            storageCount = Number(localStorage.getItem(removeStorageData));
        
        // Direct remove the file if there's any error.
        if (_dnd_status.classList.contains("in-progress") || _dnd_status.querySelector(".has-error")) {
            _dnd_status.remove();
            localStorage.setItem(removeStorageData, storageCount - 1);
            return false;
        }
        
        // Change text Status
        _self.classList.add("deleting");
        _self.textContent = dnd_cf7_uploader.drag_n_drop_upload.delete.text + "...";

        // Request ajax image delete
        var xhr = new XMLHttpRequest();
        xhr.open("POST", dnd_cf7_uploader.ajax_url);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (this.status === 200) {
                var response = JSON.parse(this.responseText);
                if (response.success) {

                    // Reduce file count and status bar element.
                    _dnd_status.remove();   
                    localStorage.setItem(removeStorageData, storageCount - 1);
                    
                    // Remove error msg
                    if ( _parent_wrap.querySelectorAll(".dnd-upload-status").length <= 1 ){
                        if( _parent_wrap.querySelector(".has-error-msg") ){
                            _parent_wrap.querySelector(".has-error-msg").remove();
                        }
                    }

                    // Update Counter
                    _parent_wrap.querySelector(".dnd-upload-counter span").textContent = Number(localStorage.getItem(removeStorageData)) - 1;
                }
            }
        };

        xhr.send(
            "path=" + _dnd_status.querySelector('input[type="hidden"]').value +
            "&action=dnd_codedropz_upload_delete" +
            "&security=" + dnd_cf7_uploader.ajax_nonce
        );

        document.querySelectorAll(".has-error-msg").forEach(function(el) {
            el.remove();
        });

    });

    // Attach CodeDropz_Uploader to HTMLElement prototype
    HTMLElement.prototype.CodeDropz_Uploader = CodeDropz_Uploader;

})();
// END: CodeDropz Uploader function

// BEGIN: initialize upload
document.addEventListener('DOMContentLoaded', function() {

	// Fires when an Ajax form submission has completed successfully, and mail has been sent.
    document.addEventListener( 'wpcf7mailsent', function( event ) {

        // Get form
        const form = event.target;

        // Get input type file element
        var inputFile = form.querySelectorAll('.wpcf7-drag-n-drop-file');
        var status = form.querySelectorAll('.dnd-upload-status');
        var counter = form.querySelector('.dnd-upload-counter span');
        var error = form.querySelectorAll('span.has-error-msg');

        // Reset upload list for multiple fields
        if ( inputFile.length > 0 ) {
            inputFile.forEach( function(input) {
                localStorage.setItem( input.getAttribute('data-name') + '_count_files', 1 ); // Reset file counts
            });
        }

        // Remove status / progress bar
        if (status) {
            status.forEach(function(statEl){
                statEl.remove();
            });
        }
        
        if (counter) {
            counter.textContent = '0';
        }

        if (error) {
            error.forEach(function(errEl){
                errEl.remove();
            });
        }

    }, false );

	window.initDragDrop = function () {

		// Get text object options/settings from localize script
		var TextOJB = dnd_cf7_uploader.drag_n_drop_upload;
        var fileUpload = document.querySelectorAll('.wpcf7-drag-n-drop-file');

        fileUpload.forEach(function(Upload) {

            // Support Multiple Fileds
            Upload.CodeDropz_Uploader({
                'color': '#fff',
                'ajax_url': dnd_cf7_uploader.ajax_url,
                'text': TextOJB.text,
                'separator': TextOJB.or_separator,
                'button_text': TextOJB.browse,
                'server_max_error': TextOJB.server_max_error,
                'on_success': function(input, progressBar, response) {

                    // Progressbar Object
                    var progressDetails = document.querySelector('.codedropz-upload-wrapper #' + progressBar);
                    var form = input.closest('form');
                    var span = form.querySelector('.wpcf7-acceptance');
                    var checkboxInput = ( span ? span.querySelector('input[type="checkbox"]') : '' );

                    // Remove 'required' error message
                    const requiredMessage = input.closest('.codedropz-upload-wrapper').nextElementSibling;
                    if( requiredMessage && requiredMessage.classList.contains('wpcf7-not-valid-tip') ){
                        requiredMessage.remove();
                    }

                    // If it's complete remove disabled attribute in button
                    if ( ( span && span.classList.contains('optional') ) || ! span || checkboxInput.checked || form.classList.contains('wpcf7-acceptance-as-validation')) {
                        setTimeout(function(){ 
                            form.querySelector('input[type="submit"]').removeAttribute('disabled'); 
                        }, 1);
                    }

                    // Append hidden input field
                    var detailsElement = progressDetails.querySelector('.dnd-upload-details');
                    var inputHTML = '<span><input type="hidden" name="' + input.dataset.name + '[]" value="' + response.data.path + '/' + response.data.file + '"></span>';
                    detailsElement.insertAdjacentHTML('beforeend', inputHTML);

                    // Update counter
                    var filesCounter = ( Number( localStorage.getItem( input.dataset.name + '_count_files' ) ) - 1);
                    var counterElement = input.closest('.codedropz-upload-wrapper').querySelector('.dnd-upload-counter span');
                    counterElement.textContent = filesCounter;
                }
            });

        });

		

	}

	window.initDragDrop();

});