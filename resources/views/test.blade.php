@php
    if (auth('athlete')->check()) {
        $layout = 'applayout';
    } elseif (auth('staff')->check()) {
        $user = auth('staff')->user();
        if ($user && $user->role == 'admin') {
            $layout = 'applayoutadmin';
        } elseif ($user && $user->role == 'coach') {
            $layout = 'applayoutcoach';
        } else {
            $layout = 'applayout'; // Default layout if role is not admin or coach
        }
    } else {
        $layout = 'applayout'; // Default layout if neither athlete nor staff is authenticated
    }
@endphp

@extends($layout)

@section('content')

<link rel="stylesheet" href="{{ asset('css/test.css') }}" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


<script>
    document.addEventListener("DOMContentLoaded", function() {
    const nextButtons = document.querySelectorAll(".next");
    const prevButtons = document.querySelectorAll(".prev");
    const form = document.getElementById("signup-form");
    const progressBar = document.querySelector(".progress-bar");
    const progressBarSteps = document.querySelectorAll(".progress-bar .step");
    let currentStep = 0;

    nextButtons.forEach(button => {
        button.addEventListener("click", () => {
            const inputs = form.querySelectorAll(".page")[currentStep].querySelectorAll("input, select");
            let valid = true;
            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    valid = false;
                    input.classList.add("is-invalid");
                } else {
                    input.classList.remove("is-invalid");
                }
            });

            if (valid) {
                currentStep++;
                updateForm();
            }
        });
    });

    prevButtons.forEach(button => {
        button.addEventListener("click", () => {
            currentStep--;
            updateForm();
        });
    });

    form.addEventListener("submit", event => {
        event.preventDefault();
        alert("Form submitted!");
    });

    function updateForm() {
        const pages = form.querySelectorAll(".page");
        pages.forEach((page, index) => {
            page.classList.toggle("active", index === currentStep);
        });

        progressBar.style.width = `${(currentStep / (pages.length - 1)) * 100}%`;
        progressBar.setAttribute("aria-valuenow", (currentStep / (pages.length - 1)) * 100);

        // Update progress steps
        progressBarSteps.forEach((step, index) => {
            if (index <= currentStep) {
                step.classList.add("completed");
            } else {
                step.classList.remove("completed");
            }
        });
    }
});

</script>

<div class="container" style="margin-top: 6%;">
    <div class="d-flex justify-content-center">
            <div class="box right-box p-4" style="background-color: rgba(227, 237, 247, 0.548);">
                <header class="mb-4" style="text-align: center">Athlete Profile Application</header>

                <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <form method="POST" action="{{ route('store-athlete')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="page slide-page active">
                        <div class="title" style="text-align: center"><strong>Basic Information</strong></div>

                        <div class="form-group">
                            <label for="weight"><strong>Weight</strong></label>
                            <input type="number" class="form-control" id="weight" name="weight" placeholder="Enter weight in kg" pattern="[0-9]*" inputmode="numeric">
                        </div>

                        <div class="form-group">
                            <label for="height"><strong>Height</strong></label>
                            <input type="text" class="form-control" id="height" placeholder="Enter height in cm" pattern="[0-9]*" inputmode="numeric">
                        </div>

                        <div class="page slide-page d-flex justify-content-end">
                            <button type="button" class="btn btn-primary next">Next</button>
                        </div>
                    </div>

                    <div class="page slide-page">
                        <div class="title text-center" style="margin-bottom: 5%"><strong>Sports Information</strong></div>

                        <div class="row">
                            <!-- Left side: Sports and Position -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sports"><strong>Sports</strong></label>

                                </div>

                                <div class="form-group">
                                    <label for="position"><strong>Position</strong></label>
                                    <textarea id="position" name="position" class="form-control" placeholder="Netball: Goal Attack" ></textarea>
                                </div>

                            </div>
                            <!-- Right side: Achievement and Level -->
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="level" class="form-label"><strong>Experience Level</strong></label>
                                    <select id="level" name="level" class="form-control">
                                        <option value="" disabled selected>Choose your level</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="achievement"><strong>Achievement</strong></label>
                                    <textarea id="achievement" name="achievement" class="form-control" placeholder="1. Johan Ragbi UiTM Lion 7's 2024" ></textarea>
                                </div>

                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary prev">Previous</button>
                            <button type="button" class="btn btn-primary next">Next</button>
                        </div>

                    </div>


                    <div class="page slide-page">
                        <div class="title text-center" style="margin-bottom: 5%"><strong>Skills Assesment:</strong></div>

                        <div class="form-group d-flex flex-column align-items-center mt-4">

                            <label for="strength"><strong>Please select your strength level (1-5):</strong></label>
                            <div class="d-flex align-items-center mt-0">
                                <label for="strength" class="mr-2">Low</label>
                                <input type="range" id="strength" name="strength" min="1" max="5" value="3" oninput="this.nextElementSibling.value = this.value" class="mr-2">
                                <output>3</output>
                                <label for="strength" class="ml-2">High</label>
                            </div>

                            <label for="speed"><strong>Please select your speed level (1-5):</strong></label>
                            <div class="d-flex align-items-center mt-0">
                                <label for="speed" class="mr-2">Low</label>
                                <input type="range" id="speed" name="speed" min="1" max="5" value="3" oninput="this.nextElementSibling.value = this.value" class="mr-2">
                                <output>3</output>
                                <label for="speed" class="ml-2">High</label>
                            </div>

                            <label for="endurance"><strong>Please select your endurance level (1-5):</strong></label>
                            <div class="d-flex align-items-center mt-0">
                                <label for="endurance" class="mr-2">Low</label>
                                <input type="range" id="endurance" name="endurance" min="1" max="5" value="3" oninput="this.nextElementSibling.value = this.value" class="mr-2">
                                <output>3</output>
                                <label for="endurance" class="ml-2">High</label>
                            </div>

                            <label for="focus"><strong>Please select your focus level (1-5):</strong></label>
                            <div class="d-flex align-items-center mt-0">
                                <label for="focus" class="mr-2">Low</label>
                                <input type="range" id="focus" name="focus" min="1" max="5" value="3" oninput="this.nextElementSibling.value = this.value" class="mr-2">
                                <output>3</output>
                                <label for="focus" class="ml-2">High</label>
                            </div>

                            <label for="reflex"><strong>Please select your reflex level (1-5):</strong></label>
                            <div class="d-flex align-items-center mt-0">
                                <label for="reflex" class="mr-2">Low</label>
                                <input type="range" id="reflex" name="reflex" min="1" max="5" value="3" oninput="this.nextElementSibling.value = this.value" class="mr-2">
                                <output>3</output>
                                <label for="reflex" class="ml-2">High</label>
                            </div>

                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary prev">Previous</button>
                            <button type="button" class="btn btn-primary next">Next</button>
                        </div>
                    </div>

                    <div class="page slide-page">
                        <div class="title text-center" style="margin-bottom: 5%"><strong>Athlete Profile Photo Submission</strong></div>

                        <div class="form-group">
                            <label for="image" class="form-label">Upload Image:</label>
                            <input type="file" id="image" name="image" accept="image/*" required class="form-control">
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary prev">Previous</button>
                            <button type="button" class="btn btn-success submit">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
</div>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/667a45929d7f358570d308e7/1i16pvhd9';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->

@endsection
