<script>





// Recording initialization
$(document).ready(function(){


    (async () => {      

        // Record audio 
        $(document).on('click', '.record-btn', function(){
            $("#ticketModal").modal('hide');
            $('#recordModal').modal({
                backdrop: 'static',
                keyboard: false
            })
            $('.end-record').prop('disabled', true).html('Minimum 10 Seconds');
            setTimeout(() => {
                $('.end-record').prop('disabled', false).html('End Session');
            }, 10000);
            start();
        })  


        // Start record button - for embed
        $(document).on('click', '.start-record', function(){
            start();
            $(this).addClass('hide');
            $('.end-record').removeClass('hide').prop('disabled', true).html('Minimum 10 Seconds');
            setTimeout(() => {
                $('.end-record').prop('disabled', false).html('End Session');
            }, 10000);
        })  

        // End session 
        $(document).on('click','.end-record', function(){
            stop();
            if($('.start-record').length){
                $('.start-record').removeClass('hide');
                $(this).addClass('hide');
            }
        })

        // Define configuration variable 
        let leftchannel = [], rightchannel = [], recorder = null, recording = false, recordingLength = 0, volume = null, audioInput = null, sampleRate = null, AudioContext = window.AudioContext || window.webkitAudioContext, context = null, analyser = null, canvas = document.querySelector('#recordCanvas'), canvasCtx = canvas.getContext("2d"), micSelect = document.querySelector('#micSelect'), stream = null, tested = false;
        const deviceInfos = await navigator.mediaDevices.enumerateDevices();
        var mics = [];
        

        // Getting mic setting 
        try {
            window.stream = stream = await getStream();

            // Append mic option 
            for (let i = 0; i !== deviceInfos.length; ++i) {
                let deviceInfo = deviceInfos[i];
                if (deviceInfo.kind === 'audioinput') {
                    mics.push(deviceInfo);
                    let label = deviceInfo.label || 'Microphone ' + mics.length;
                    const option = document.createElement('option')
                    option.value = deviceInfo.deviceId;
                    option.text = label;
                    micSelect.appendChild(option);
                }
            }
        } catch(err) {
            console.log('Issue getting mic' + err);
        }             

        
        // On change mic setting
        micSelect.onchange = async e => {
            stream.getTracks().forEach(function(track) {
                track.stop();
            });
            context.close();
            stream = await getStream({ audio: {
            deviceId: {exact: micSelect.value} }, video: false });
            setUpRecording();
        }
    

        setUpRecording();

                
        // Function to get media device stream 
        function getStream(constraints) {
            if (!constraints) {
            constraints = { audio: true, video: false };
            }
            return navigator.mediaDevices.getUserMedia(constraints);
        }
            

        // Function to setup recording
        function setUpRecording() {
            context = new AudioContext();
            sampleRate = context.sampleRate;
            
            // creates a gain node
            volume = context.createGain();

            // creates an audio node from teh microphone incoming stream
            audioInput = context.createMediaStreamSource(stream);
            
            // Create analyser
            analyser = context.createAnalyser();
            
            // connect audio input to the analyser
            audioInput.connect(analyser);
        
            let bufferSize = 2048;
            let recorder = context.createScriptProcessor(bufferSize, 2, 2);

            analyser.connect(recorder);
            
            // finally connect the processor to the output
            recorder.connect(context.destination); 

            recorder.onaudioprocess = function(e) {
                // Check 
                if (!recording) return;
                // Do something with the data, i.e Convert this to WAV
                let left = e.inputBuffer.getChannelData(0);
                let right = e.inputBuffer.getChannelData(1);
                if (!tested) {
                    tested = true;
                    // if this reduces to 0 we are not getting any sound
                    if ( !left.reduce((a, b) => a + b) ) {
                    alert("There seems to be an issue with your Mic");
                    // clean up;
                    stop();
                    stream.getTracks().forEach(function(track) {
                        track.stop();
                    });
                    context.close();
                    }
                }
                // we clone the samples
                leftchannel.push(new Float32Array(left));
                rightchannel.push(new Float32Array(right));
                recordingLength += bufferSize;
            };
            visualize();
        }


        // Buffer setting
        function mergeBuffers(channelBuffer, recordingLength) {
            let result = new Float32Array(recordingLength);
            let offset = 0;
            let lng = channelBuffer.length;
            for (let i = 0; i < lng; i++){
                let buffer = channelBuffer[i];
                result.set(buffer, offset);
                offset += buffer.length;
            }
            return result;
        }


        // Channel setting 
        function interleave(leftChannel, rightChannel){
            let length = leftChannel.length + rightChannel.length;
            let result = new Float32Array(length);
            let inputIndex = 0;
            for (let index = 0; index < length; ){
                result[index++] = leftChannel[inputIndex];
                result[index++] = rightChannel[inputIndex];
                inputIndex++;
            }
            return result;
        }


        // UTF setting 
        function writeUTFBytes(view, offset, string){ 
            let lng = string.length;
            for (let i = 0; i < lng; i++){
                view.setUint8(offset + i, string.charCodeAt(i));
            }
        }


        // Start recording 
        function start() {
            recording = true;
            // reset the buffers for the new recording
            leftchannel.length = rightchannel.length = 0;
            recordingLength = 0;
            if (!context) setUpRecording();
        }

        // End recording session
        function stop() {
            recording = false;
            
            // we flat the left and right channels down
            let leftBuffer = mergeBuffers ( leftchannel, recordingLength );
            let rightBuffer = mergeBuffers ( rightchannel, recordingLength );
            let interleaved = interleave ( leftBuffer, rightBuffer );
            

            // Create wav file
            let buffer = new ArrayBuffer(44 + interleaved.length * 2);
            let view = new DataView(buffer);

            // RIFF chunk descriptor
            writeUTFBytes(view, 0, 'RIFF');
            view.setUint32(4, 44 + interleaved.length * 2, true);
            writeUTFBytes(view, 8, 'WAVE');
            // FMT sub-chunk
            writeUTFBytes(view, 12, 'fmt ');
            view.setUint32(16, 16, true);
            view.setUint16(20, 1, true);
            // stereo (2 channels)
            view.setUint16(22, 2, true);
            view.setUint32(24, sampleRate, true);
            view.setUint32(28, sampleRate * 4, true);
            view.setUint16(32, 4, true);
            view.setUint16(34, 16, true);
            // data sub-chunk
            writeUTFBytes(view, 36, 'data');
            view.setUint32(40, interleaved.length * 2, true);

            // write the PCM samples
            let lng = interleaved.length, index = 44,volume = 1;
            for (let i = 0; i < lng; i++){
                view.setInt16(index, interleaved[i] * (0x7FFF * volume), true);
                index += 2;
            }

            // Binary blob
            const blob = new Blob ( [ view ], { type : 'audio/wav' } );
            const audioUrl = URL.createObjectURL(blob);
            
            // Store to server 
            var formdata = new FormData();
            formdata.append('audioBlob', blob);
            formdata.append('userID', "{{isset($user)?$user->uid:Auth::user()->uid}}");
            formdata.append('companyID', "{{isset($company)?$company->uid:getCompany()->uid}}");
            $.ajax({
                url: '/api/audio/process',
                type: 'POST',
                processData: false,
                contentType: false,
                data: formdata,
                dataType: 'JSON',
                success: function (data) { 
                }
            }); 

            $("#recordModal").modal('hide');
            swal('Call Record Created','System will take about 5 minutes to process the audio data.','success');
            

        }

        
        // Visualizer function 
        function visualize() {

            WIDTH = canvas.width;
            HEIGHT = canvas.height;
            CENTERX = canvas.width / 2;
            CENTERY = canvas.height / 2;

            if (!analyser) return;
            analyser.fftSize = 2048;
            var bufferLength = analyser.fftSize;
            var dataArray = new Uint8Array(bufferLength);
            canvasCtx.clearRect(0, 0, WIDTH, HEIGHT);
            var draw = function() {

                drawVisual = requestAnimationFrame(draw);

                analyser.getByteTimeDomainData(dataArray);

                var gradient = canvasCtx.createLinearGradient(0, 0, 170, 170);
                gradient.addColorStop(0, "rgb(104,52,210)");
                gradient.addColorStop(1, "rgb(102,230,213)");
                canvasCtx.fillStyle = gradient;
                canvasCtx.fillRect(0, 0, WIDTH, HEIGHT);
                canvasCtx.lineWidth = 2;
                canvasCtx.strokeStyle = 'rgb(255, 255, 255)';
                canvasCtx.beginPath();

                var sliceWidth = WIDTH * 1.0 / bufferLength;
                var x = 0;

                for(var i = 0; i < bufferLength; i++) {

                var v = dataArray[i] / 128.0;
                var y = v * HEIGHT/2;

                if(i === 0) {
                    canvasCtx.moveTo(x, y);
                } else {
                    canvasCtx.lineTo(x, y);
                }

                x += sliceWidth;
                }

                canvasCtx.lineTo(canvas.width, canvas.height/2);
                canvasCtx.stroke();
            };
            draw();
        }

    })()

    $("#uploadAudio").on("change", ".file-upload-field", function(){ 
        $(this).parent(".file-upload-wrapper").attr("data-text",$(this).val().replace(/.*(\/|\\)/, '') );
    });

})




</script>