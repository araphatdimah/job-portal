<x-layout>
@guest('portal')
     <x-slot:status>
      <x-unauthenticated>
            <a href="/portal-login" class="login-btn">Login</a>
        <!-- Profile dropdown -->
        <div class="relative ml-3">
          <div>
                <a href="/portal-register" class="create-account-btn" :active="request()->is('portal-register')">Create account</a> 
          </div>
        </div>
        </x-unauthenticated>
     </x-slot:status>
      @endguest

      @auth('portal')
     <x-slot:status>
      <x-authenticated-user>
        <div class="relative ml-3">
          <div>
            <button style="color:whitesmoke; background-color:#e6494e; border-radius:5px; padding:9px 9px 5px 9px;" href="#" id="passwordSettingButton">
                <i style="font-size: 1.3rem;" class="fas fa-cog"></i>
            </button> 
          </div>
        </div>
        <div class="relative ml-3">
        <form method="POST" action="/portal-logout">
            @csrf
                <button style="color:whitesmoke; background-color:#e6494e; border-radius:5px; padding:9px 9px 5px 9px;">
                    <i style="font-size: 1.3rem;" class="fas fa-sign-out-alt"></i>
                </button> 
        </form>
      </div>
        </x-authenticated-user>
     </x-slot:status>
@endauth
    <x-slot:heading>
        Welcome, <span> {{ Auth::guard('portal')->user()->name }}</span>
    </x-slot:heading>
    <x-slot:content>
    <div class="container">

        <!-- Profile section -->
        <div class="profile-section">
            <div class="profile-card">
                <img src="{{ Auth::guard('portal')->user()->profile_picture }}" alt="{{ Auth::guard('portal')->user()->name }}" class="profile-img">
                <h2 style="font-size: 1.2rem; margin: 5px 0">{{ Auth::guard('portal')->user()->name }}</h2>
                <p>Laravel Developer</p>
            </div>
            <div class="quick-links">
                <h3 style="font-weight: 500; font-size:1.1rem; color:darkblue; margin:8px 0;">Social Links</h3>
                <ul>
                    <li><a href="#"><i style="font-size: 1.3rem; margin: 0 10%; padding:5px; color: blue" class="fab fa-facebook"></i></a></li>
                    <li><a href="#"><i style="font-size: 1.3rem; margin: 0 10%; padding:5px; color: darkblue" class="fab fa-linkedin"></i></a></li>
                    <li><a href="#"><i style="font-size: 1.3rem; margin: 0 10%; padding:5px; color: black" class="fab fa-x"></i></a></li>
                </ul>
            </div>
            <div class="express-feeds">
                <h3 style="font-weight: 500; font-size:1.1rem; color:darkblue; margin:7px 0;">Profile</h3>
                <ul>
                    <li><a href="#" style=" color:;">{{ Auth::guard('portal')->user()->email }}</a></li>
                    <li><a href="#" style=" color:;">{{ Auth::guard('portal')->user()->phone }}</a></li>
                    <li><a href="#" style=" color:;">{{ Auth::guard('portal')->user()->required_experience }} Years Work Experience</a></li>
                    <li><a href="#" style=" color:;">{{ Auth::guard('portal')->user()->qualification }}</a></li>
                </ul>
            </div>
            <div class="facilities">
                <h3 style="font-weight: 500; font-size:1.1rem; color:darkblue; margin:7px 0;">Experiences Gained</h3>
                <ul>
                    <li><a>Media Trainee</a></li>
                    <li><a>Developer at Aamusted</a></li>
                    <li><a>Intern at Nonihub</a></li>
                </ul>
            </div>
            <div class="facilities">
                <h3 style="font-weight: 500; font-size:1.1rem; color:darkblue; margin:7px 0;">My Bio</h3>
                <p>
                {{ Auth::guard('portal')->user()->biography }} 
                </p>
            </div>
            @auth('portal')
            <button class="mt-5" data-bs-toggle="modal" data-bs-target="#editProfileModal" id="seekerEditProfileButton">Edit Profile</button>
            @endauth
        </div>

        <!-- Feed section -->
        <div class="feed-section">
            <div class="announcement">
                <h2>Stay safe. Find a job and connect.</h2>
                <button>See More</button>
                <p>Find latest Job posts | <a style="color: white;" href="#">Precautions</a> | <a style="color:white" href="#">FAQs</a></p>
            </div>
            <h3 style="font-size: 1.3rem; text-align:center; font-weight:500">Jobs Matching For Me?</h3>
            <div class="job-feeds">
                <ul>
                    @if($jobs_match)
                    @foreach($jobs_match as $match)
                    <li>
                        <div class="card">
                            <img src="{{ $match->cover_image }}" alt="Job Post" class="card-img">
                            <div class="card-title">
                                <h3>{{ $match->title }}</h3>
                            </div>
                            <div class="card-body">
                                {{ $match->description }}
                            </div>
                            <a onclick="seeMoreJobInfo({{ $match->id }})" style="text-decoration: underline; color:blue;" href="#">See More</a>
                        </div>
                    </li>
                    @endforeach
                    @endif
                   </ul>
                <button>LOAD MORE</button>
            </div>
        </div>

        <!-- Right section -->
        <div class="right-section">
                <h3 style="font-size: 1.2rem; font-weight:500; text-align:center; padding:5px;">Calender</h3>
                <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=UTC&bgcolor=%233F51B5&mode=MONTH&showTitle=0&showPrint=0&showTz=0&src=ZGltYWguYXJhcGhhdDNAZ21haWwuY29t&src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=Y2xhc3Nyb29tMTE1MzkzNDM2MTI2NTUzNjY3MDc2QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTA0NTU4MTg5Njk3MzkxNjM4NDE2QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=YW1wdjQ3dGN2cW52ZTQwZzNtbTJqb3NmYmg5ZXVjMzlAaW1wb3J0LmNhbGVuZGFyLmdvb2dsZS5jb20&src=ZW4uZ2gjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTE1MzI0Mjc5NTM5NDA2MDM1MzIzQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTExMTkxMTI1NjgyMDkxNTc3MDc5QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTAzODczMjU4NDI4NzA2NzI4ODQxQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&color=%23039BE5&color=%2333B679&color=%23A79B8E&color=%23007b83&color=%23EF6C00&color=%230B8043&color=%237627bb&color=%23202124&color=%23c26401" 
                    style="width:100%; height:40vh; margin:5px; padding:5px;">
                </iframe>
            <div class="following">
                <h3>Following</h3>
                <ul>
                    <li>David Geller</li>
                    <li>Sophia Miller</li>
                    <li>Liam Wilson</li>
                    <li>Maria Martinez</li>
                </ul>
                <h3>Previous Searches</h3>
                <ul>
                    <!-- previous searches list -->
                </ul>
            </div>
        </div>
    </div>
     <!-- Edit Profile Modal -->
     <div id="editProfileModal" class="modal">
        <div class="modal-content">
            <span onclick="profileEditClose()" class="profile-close-button">&times;</span>
            <h2>You're Editing Your Profile</h2>
            <form id="editProfileForm" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <x-input-label for="name" :value="__('User Name')" /><span style="color:red; font-weight:bold">*</span>
                    <input type="text" id="name" name="name" value="{{ Auth::guard('portal')->user()->name }}" required>
                </div>

                <div class="form-group">
                    <x-input-label for="email" :value="__('Email Address')" /><span style="color:red; font-weight:bold">*</span>
                    <input type="text" id="email" name="email" value="{{ Auth::guard('portal')->user()->email }}" required>
                </div>

                <div class="form-group">
                    <x-input-label for="phone" :value="__('Phone Contact')" /><span style="color:red; font-weight:bold">*</span>
                    <input type="text" id="phone" name="phone" value="{{ Auth::guard('portal')->user()->phone }}" required>
                </div>

                <div class="form-group">
                    <x-input-label for="required_experience" :value="__('Years of Experience')" /><span style="color:red; font-weight:bold">*</span>
                    <input type="number" id="required_experience" name="required_experience" value="{{ Auth::guard('portal')->user()->required_experience }}" value="{{ Auth::guard('portal')->user()->required_experience }}" required>
                </div>

                <!-- Location -->
                <div class="mt-4">
                    <x-input-label for="location" :value="__('Current Location Of Stay')" /><span style="color:red; font-weight:bold">*</span>
                    <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" value="{{ Auth::guard('portal')->user()->location }}" required />
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>

                <div class="form-group">
                    <x-input-label for="skills_set" :value="__('Skills Set')" /><span style="color:red; font-weight:bold">*</span>
                    <textarea rows="5" id="skills_set" name="skills_set" value="{{ Auth::guard('portal')->user()->skills_set }}" required>{{ Auth::guard('portal')->user()->skills_set }}</textarea>
                </div>

                <div class="form-group">
                <x-input-label for="biography" :value="__('Biography')" /><span style="color:red; font-weight:bold">*</span>
                    <textarea rows="5" id="biography" name="biography" value="{{ Auth::guard('portal')->user()->biography }}" required>{{ Auth::guard('portal')->user()->biography }}</textarea>
                </div>
                
                 <!-- Qualification -->
                <div class="mt-4">
                    <x-input-label for="qualification" :value="__('Qualification')" /><span style="color:red; font-weight:bold">*</span>
                    <x-select-input id="qualification" class="block mt-1 w-full" name="qualification" required>
                    <option class="text-center" value="{{ Auth::guard('portal')->user()->qualification }}">{{ Auth::guard('portal')->user()->qualification }}</option>
                    <option class="text-center" value="Diploma">Diploma</option>
                    <option class="text-center" value="Degree">Degree</option>
                    <option class="text-center" value="Masters">Masters</option>
                </x-select-input>
                    <x-input-error :messages="$errors->get('qualification')" class="mt-2" />
                </div>

                <!-- Industry of Interest -->
                <div class="mt-4">
                    <x-input-label for="industry" :value="__('Industry Of Interest')" /><span style="color:red; font-weight:bold">*</span>
                    <x-select-input id="industry" class="block mt-1 w-full" name="industry" required>
                        <option class="text-center" value="{{ Auth::guard('portal')->user()->industry }}">{{ Auth::guard('portal')->user()->industry }}</option>
                        <option class="text-center" value="Technology">Technology</option>
                        <option class="text-center" value="Manufacturing">Manufacturing</option>
                        <option class="text-center" value="Trade">Trade</option>
                        <option class="text-center" value="Trade">Finance</option>
                        <option class="text-center" value="Construction">Construction</option>
                        <option class="text-center" value="Agriculture">Agriculture</option>
                        <option class="text-center" value="Education and Training">Education and Training</option>
                        <option class="text-center" value="Media and Communications">Media and Communications</option>
                        <option class="text-center" value="Restaurant">Restaurant</option>
                        <option class="text-center" value="Hospitality">Hospitality</option>
                        <option class="text-center" value="Fashion">Fashion</option>
                        <option class="text-center" value="Transportation">Transportation</option>
                        <option class="text-center" value="Services">Services</option>
                        <option class="text-center" value="Healthcare">Healthcare</option>
                </x-select-input>
                    <x-input-error :messages="$errors->get('industry')" class="mt-2" />
                </div>
                    
                <!-- Job Style -->
                <div class="mt-4">
                    <x-input-label for="job_style" :value="__('Job Style')" /><span style="color:red; font-weight:bold">*</span>
                    <x-select-input id="job_style" class="block mt-1 w-full" name="job_style" required>
                        <option class="text-center" value="{{ Auth::guard('portal')->user()->job_style }}">{{ Auth::guard('portal')->user()->job_style }}</option>
                        <option class="text-center" value="Remote">Remote</option>
                        <option class="text-center" value="On Field">On Field</option>
                        <option class="text-center" value="Hybrid">Hybrid</option>
                </x-select-input>
                    <x-input-error :messages="$errors->get('job_style')" class="mt-2" />
                </div>

                <!-- <div class="form-group">
                    <label for="image">Profile Image</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div> -->
                <input onclick="editProfileSubmit(`{{ Auth::guard('portal')->user()->id }}`)" id="submit-profilebtn" type="submit" value="Update Profile">
            </form>
        </div>
    </div>
    <!-- Update Password Modal -->
    <div id="passwordSettingModal" class="modal">
        <div class="modal-content">
            <span class="password-close-button">&times;</span>
            <h2>You're Changing Your Password</h2>
            <form id="passwordSettingForm" enctype="multipart/form-data">
                @csrf
                @method('Patch')
                <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="password" id="old_password" name="old_password" placeholder="Old Password" required>
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password" placeholder="New Password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
                <!-- <div class="form-group">
                    <label for="image">Profile Image</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div> -->
                <input onclick="passwordChangeSubmit(`{{ Auth::guard('portal')->user()->id }}`)" id="submit-profilebtn" type="submit" value="Update Password">
            </form>
        </div>
    </div>

    <!-- Modal for viewing more of a job and applying -->
    <div class="modal fade" id="JobModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content" id="JobModalBody">
          </div>
        </div>
    </div>

    <script>
    // Function to open the buy Job modal & place an order
        function seeMoreJobInfo(jobId) {
            // Prevent default behavior
            event.preventDefault();

            // Retrieve Job data
            const Jobs = @json($jobs_match);
            const job = Jobs.find(j => j.id == jobId);

            // Check if Job data is available
            if (job) {
                const content = `
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">You're Viewing More Details On <span style="color:green; font-weight:500;">${job.title}</span></h5>
                        <button type="button" id="modal-btn-close" class="btn-close" style="color:red;" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">
                        <div style="width:100%" class="card">
                            <img style="width:100%; height:200px;" src="${job.cover_image}" alt="${job.title}" class="card-img">
                            <div class="card-body">
                                <span style="font-weight:bold;">Company:</span> ${job.name}
                            </div>
                            <div class="card-body">
                                <span style="font-weight:bold;">Job Title:</span> ${job.title}
                            </div>
                            <div class="card-body">
                               <span style="font-weight:bold;">Required Skills:</span> ${job.required_skills}
                            </div>
                            <div class="card-body">
                               <span style="font-weight:bold;">Location:</span> ${job.location}
                            </div>
                            <div class="card-body">
                               <span style="font-weight:bold;">Experience Required:</span> ${job.required_experience} year(s)
                            </div>
                            <div class="card-body">
                               <span style="font-weight:bold;">Job Style:</span> ${job.job_style}
                            </div>
                             <div class="card-body">
                               <span style="font-weight:bold;">Description:</span> ${job.description}
                            </div>
                            <div style="border-bottom:1px solid green;" class="card-body">
                               <span style="font-weight:bold; color:maroon;">Deadline:</span> ${job.deadline}
                            </div>
                            <div class="mt-4" style="display:flex; justify-content:space-between">
                            <a style="text-decoration: underline; color:blue;" href="mailto:${job.email}">Email Application</a>
                            <a style="text-decoration: underline; color:blue;" href="tel:${job.phone}">Give A Call</a>
                            </div>
                        </div>
                     </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="background-color:wheat; color:red;" data-bs-dismiss="modal">Close</button>
                </div>
                    `;
                    document.getElementById('JobModalBody').innerHTML = content;

                    // Display the modal using Bootstrap's JS API
                    const modal = new bootstrap.Modal(document.getElementById('JobModal'));
                    modal.show();
                } else {
                    document.getElementById('JobModalBody').innerHTML = '<p>No information available.</p>';
                    const modal = new bootstrap.Modal(document.getElementById('JobModal'));
                    modal.show();
                }
            }
    </script>
    <script src="{{asset ('/js/modal.js')}}"></script>
    </x-slot:content>
</x-layout>
