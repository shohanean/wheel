<!DOCTYPE html>
<html>
    <head>
        <title>ভাগ্যের চাকা</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="icon" type="image/png" href="https://www.creativeitinstitute.com/favicon-32x32.png"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('winwheel') }}/main.css" type="text/css" />
        <script type="text/javascript" src="{{ asset('winwheel') }}/Winwheel.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
    </head>
    <body style="background-image: url('{{ asset('winwheel/bg.png') }}'); background-repeat:no-repeat">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div align="center" class="mt-4">
                        <h1 class="fw-bold lh-lg">
                            ক্রিয়েটিভ আইটির
                        </h1>
                        <h2 class="lh-lg" style="color:red">সকল কোর্সে নিশ্চিত ছাড়</h2>
                        <h3 class="lh-lg">ভাগ্যের চাকা ঘুরিয়ে পেয়ে যান স্পেশাল ডিস্কাউন্ট</h3>
                        <button class="my-3 px-5 btn btn-lg btn-success" id="spin_button" onClick="startSpin();">চাকা ঘুরান</button>
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td width="438" height="582" class="the_wheel" align="center" valign="center">
                                        <canvas id="canvas" width="434" height="434">
                                            <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
                                        </canvas>
                                    </td>
                                </tr>
                            </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Create new wheel object specifying the parameters at creation time.
            let theWheel = new Winwheel({
                'outerRadius'     : 212,        // Set outer radius so wheel fits inside the background.
                'innerRadius'     : 75,         // Make wheel hollow so segments don't go all way to center.
                'textFontSize'    : 30,         // Set default font size for the segments.
                'textOrientation' : 'horizontal', // Make text vertial so goes down from the outside of wheel.
                'textAlignment'   : 'outer',    // Align text to outside of wheel.
                'numSegments'     : 22,         // Specify number of segments.
                'segments'        :             // Define segments including colour and text.
                [                               // font size and test colour overridden on backrupt segments.
                   {'textFillStyle' : 'white', 'fillStyle' : '#CA3D77', 'text' : '35%', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#39A1E8', 'text' : '40%', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#2EAA70', 'text' : '60%', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#CA3D77', 'text' : 'OH NO', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#39A1E8', 'text' : '40%', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#D3494A', 'text' : '45%', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#3266E3', 'text' : '35%', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#CA3D77', 'text' : '45%', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#39A1E8', 'text' : 'NO LUCK', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#2FAF74', 'text' : '45%', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#3368E8', 'text' : '30%', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#E65051', 'text' : '40%', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#2FAF74', 'text' : '30%', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#CA3D77', 'text' : '55%', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#39A1E8', 'text' : 'OH NO', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#E65051', 'text' : '35%', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#3368E8', 'text' : '50%', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#CA3D77', 'text' : '55%', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#39A1E8', 'text' : '30%', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#3368E8', 'text' : 'SORRY', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#E65051', 'text' : '35%', 'textFontSize' : 16},
                   {'textFillStyle' : 'white', 'fillStyle' : '#2FAF74', 'text' : '50%', 'textFontSize' : 16},
                //    {'textFillStyle' : 'white', 'fillStyle' : '#ee1c24', 'text' : 'Bad Luck', 'textFontSize' : 25},
                ],
                'animation' :           // Specify the animation to use.
                {
                    'type'     : 'spinToStop',
                    'duration' : 10,    // Duration in seconds.
                    'spins'    : 3,     // Default number of complete spins.
                    'callbackFinished' : alertPrize,
                    'callbackSound'    : playSound,   // Function to call when the tick sound is to be triggered.
                    'soundTrigger'     : 'pin'        // Specify pins are to trigger the sound, the other option is 'segment'.
                },
                'pins' :				// Turn pins on.
                {
                    'number'     : 22,
                    'fillStyle'  : '#FFF2A0',
                    'outerRadius': 5,
                }
            });

            // Loads the tick audio sound in to an audio object.
            let audio = new Audio("{{ asset('winwheel') }}/tick.mp3");

            // This function is called when the sound is to be played.
            function playSound()
            {
                // Stop and rewind the sound if it already happens to be playing.
                audio.pause();
                audio.currentTime = 0;

                // Play the sound.
                audio.play();
            }

            // Vars used by the code in this page to do power controls.
            let wheelPower    = 0;
            let wheelSpinning = false;

            // -------------------------------------------------------
            // Function to handle the onClick on the power buttons.
            // -------------------------------------------------------
            function powerSelected(powerLevel)
            {
                // Ensure that power can't be changed while wheel is spinning.
                if (wheelSpinning == false) {
                    // Reset all to grey incase this is not the first time the user has selected the power.
                    document.getElementById('pw1').className = "";
                    document.getElementById('pw2').className = "";
                    document.getElementById('pw3').className = "";

                    // Now light up all cells below-and-including the one selected by changing the class.
                    if (powerLevel >= 1) {
                        document.getElementById('pw1').className = "pw1";
                    }

                    if (powerLevel >= 2) {
                        document.getElementById('pw2').className = "pw2";
                    }

                    if (powerLevel >= 3) {
                        document.getElementById('pw3').className = "pw3";
                    }

                    // Set wheelPower var used when spin button is clicked.
                    wheelPower = powerLevel;

                    // Light up the spin button by changing it's source image and adding a clickable class to it.
                    document.getElementById('spin_button').src = "{{ asset('winwheel') }}/spin_on.png";
                    document.getElementById('spin_button').className = "clickable";
                }
            }

            // -------------------------------------------------------
            // Click handler for spin button.
            // -------------------------------------------------------
            function startSpin()
            {
                // Ensure that spinning can't be clicked again while already running.
                if (wheelSpinning == false) {
                    // Based on the power level selected adjust the number of spins for the wheel, the more times is has
                    // to rotate with the duration of the animation the quicker the wheel spins.
                    if (wheelPower == 1) {
                        theWheel.animation.spins = 3;
                    } else if (wheelPower == 2) {
                        theWheel.animation.spins = 6;
                    } else if (wheelPower == 3) {
                        theWheel.animation.spins = 10;
                    }

                    // Disable the spin button so can't click again while wheel is spinning.
                    document.getElementById('spin_button').src       = "{{ asset('winwheel') }}/spin_off.png";
                    document.getElementById('spin_button').className = "d-none";

                    // Begin the spin animation by calling startAnimation on the wheel object.
                    theWheel.startAnimation();

                    // Set to true so that power can't be changed and spin button re-enabled during
                    // the current animation. The user will have to reset before spinning again.
                    wheelSpinning = true;
                }
            }

            // -------------------------------------------------------
            // Function for reset button.
            // -------------------------------------------------------
            function resetWheel()
            {
                theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
                theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
                theWheel.draw();                // Call draw to render changes to the wheel.

                document.getElementById('pw1').className = "";  // Remove all colours from the power level indicators.
                document.getElementById('pw2').className = "";
                document.getElementById('pw3').className = "";

                wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.
            }

            // -------------------------------------------------------
            // Called when the spin animation has finished by the callback feature of the wheel because I specified callback in the parameters.
            // -------------------------------------------------------
            function alertPrize(indicatedSegment)
            {
                $(document).ready(function(){

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type:'POST',
                        url:'/final/shot',
                        data: {final_text: indicatedSegment.text, session_value: "{{ session('status') }}"},
                        success: function (data) {
                            Swal.fire({
                            text: data,
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ url('/') }}";
                                }
                            })
                        }
                    });
                });
                // Just alert to the user what happened.
                // In a real project probably want to do something more interesting than this with the result.
                // if (indicatedSegment.text == 'LOOSE TURN') {
                //     alert('Sorry but you loose a turn.');
                // } else if (indicatedSegment.text == 'BANKRUPT') {
                //     alert('Oh no, you have gone BANKRUPT!');
                // } else {
                //     alert("You have won " + indicatedSegment.text);
                // }
            }
        </script>
    </body>
</html>
