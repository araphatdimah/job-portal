<x-layout>
@guest('employer')
     <x-slot:status>
      <x-unauthenticated>
            <a href="/employer-login" class="login-btn">Login</a>
        <!-- Profile dropdown -->
        <div class="relative ml-3">
          <div>
                <a href="/employer-register" class="create-account-btn" :active="request()->is('employer-register')">Create account</a> 
          </div>
        </div>
        </x-unauthenticated>
     </x-slot:status>
      @endguest

      @auth('employer')
     <x-slot:status>
      <x-authenticated-user>
        <div class="relative ml-3">
        <button style = "color:whitesmoke; background-color:#e6494e; border-radius:5px; padding:9px 9px 5px 9px;" id="editProfileButton">Edit Profile</button>
        </div>
        <div class="relative ml-3">
          <div>
            <button style="color:whitesmoke; background-color:#e6494e; border-radius:5px; padding:9px 9px 5px 9px;" href="#" id="passwordSettingButton">
                <i style="font-size: 1.3rem;" class="fas fa-cog"></i>
            </button> 
          </div>
        </div>
        <div class="relative ml-3">
        <form method="POST" action="/employer-logout">
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
        Welcome, <span> {{ Auth::guard('employer')->user()->name }}</span>
    </x-slot:heading>
    <x-slot:content>
    <div class="container">

        <!-- Profile section -->
        <div class="profile-section">
            <div class="profile-card">
                <img src="{{ Auth::guard('employer')->user()->company_profile }}" alt="{{ Auth::guard('employer')->user()->name }}" class="profile-img">
                <h2 style="font-size: 1.2rem; margin: 5px 0">{{ Auth::guard('employer')->user()->name }}</h2>
                <p>{{ Auth::guard('employer')->user()->location }}</p>
            </div>
            <div class="quick-links">
                <h3 style="font-weight: 500; font-size:1.1rem; color:darkblue; margin:13px 0;">Social Links</h3>
                <ul>
                    <li><a href="{{ Auth::guard('employer')->user()->facebook }}"><i style="font-size: 1.3rem; margin: 0 10%; padding:5px; color: blue" class="fab fa-facebook"></i></a></li>
                    <li><a href="{{ Auth::guard('employer')->user()->linkedin }}"><i style="font-size: 1.3rem; margin: 0 10%; padding:5px; color: darkblue" class="fab fa-linkedin"></i></a></li>
                    <li><a href="{{ Auth::guard('employer')->user()->twitter }}"><i style="font-size: 1.3rem; margin: 0 10%; padding:5px; color: black" class="fab fa-x"></i></a></li>
                    <li><a href="{{ Auth::guard('employer')->user()->tiktok }}"><i style="font-size: 1.3rem; margin: 0 10%; padding:5px; color: black" class="fab fa-tiktok"></i></a></li>
                </ul>
            </div>
            <div class="express-feeds">
                <h3 style="font-weight: 500; font-size:1.1rem; color:darkblue; margin:13px 0;">Bio & Profile</h3>
                <ul>
                    <li><a>{{ Auth::guard('employer')->user()->email }}</a></li>
                    <li><a>{{ Auth::guard('employer')->user()->phone }}</a></li>
                    <li><a>{{ Auth::guard('employer')->user()->industry }}</a></li>
                    <li><a>{{ Auth::guard('employer')->user()->location }}</a></li>
                    <li><a>{{ Auth::guard('employer')->user()->address }}</a></li>
                </ul>
            </div>
            <div class="facilities">
                <h3 style="font-weight: 500; font-size:1.1rem; color:darkblue; margin:13px 0;">Actively Recruiting</h3>
                <ul>
                    @if($actively_recruiting)
                    @foreach($actively_recruiting as $recruiting)
                    <li><a style="text-decoration:underline;" href="/job-more/{{ $recruiting->id }}">{{ $recruiting->title }}</a></li>
                    @endforeach
                    @endif
                </ul>
            </div>
            @auth('employer')
            <button class="mt-5" id="addJobButton">Add Job</button>
            @endauth
        </div>

        <!-- Feed section -->
        <div class="feed-section">
            <div class="announcement">
                <h2>Stay safe. Find a job and connect.</h2>
                <button>See More</button>
                <p>Find latest Job posts | <a style="color: white;" href="#">Precautions</a> | <a style="color:white" href="#">FAQs</a></p>
            </div>
            <h3 style="font-size: 1.3rem; text-align:center; font-weight:500">What's New?</h3>
            <div class="job-feeds">
                <ul>
                    @if($employer_job_match_seekers && $employer_job_match_seekers->count()>0)
                    @foreach($employer_job_match_seekers as $job_seeker)
                    <li>
                        <div class="card">
                            <img src="{{ $job_seeker->profile_picture }}" alt="{{ $job_seeker->name }}" class="card-img">
                            <div class="card-title">
                                <h3>{{ $job_seeker->name }}</h3>
                            </div>
                            <div class="card-body">
                                {{ $job_seeker->skills_set }}
                            </div>
                            <a onclick="seeMoreJobSeekerInfo({{ $job_seeker->id }})" style="text-decoration: underline; color:blue;" href="#">See More</a>
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
     <!-- Modal for Adding a Job -->
     <div id="newJobModal" class="modal">
        <div class="modal-content">
            <span class="new-job-close-button">&times;</span>
            <h2>You're Adding A Job Opportunity</h2>
            <form id="newJobForm" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <x-input-label for="title">Job Title</x-input-label><span style="color:red; font-weight:bold">*</span>
                    <input type="text" id="title" name="title" required>
                </div>
                
                <div class="form-group">
                    <label for="category">Category</label>
                    <x-select-input id="category" class="block mt-1 w-full" name="category">
                        <option class="text-center" selected disabled>--Select Field--</option>
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
                </div>
                
                <div class="form-group">
                    <x-input-label for="job_style">Job Style</x-input-label><span style="color:red; font-weight:bold">*</span>
                    <x-select-input id="job_style" class="block mt-1 w-full" name="job_style">
                        <option class="text-center" selected disabled>--Select Style--</option>
                        <option class="text-center" value="Remote">Remote</option>
                        <option class="text-center" value="On Field">On Field</option>
                        <option class="text-center" value="Hybrid">Hybrid</option>
                    </x-select-input>
                </div>
                <div class="form-group">
                    <x-input-label for="location">Location</x-input-label><span style="color:red; font-weight:bold">*</span>
                    <input type="text" id="location" name="location" required>
                </div>
                <div class="form-group">
                    <x-input-label for="salary">Salary/Pay</x-input-label><span style="color:red; font-weight:bold">*</span>
                    <input type="text" id="salary" name="salary" required/>
                </div>
                <div class="form-group">
                    <x-input-label for="required_experience">Minimum Years Of Service Required</x-input-label><span style="color:red; font-weight:bold">*</span>
                    <input class="block mt-1 w-full" type="text" id="required_experience" name="required_experience" required />
                </div>
                <div class="form-group">
                    <x-input-label for="required_skills">Skills Set Required</x-input-label><span style="color:red; font-weight:bold">*</span>
                    <textarea class="block mt-1 w-full" id="required_skills" name="required_skills" required></textarea>
                </div>
                <!-- Qualification -->
                <div class="mt-4">
                    <x-input-label for="qualification" :value="__('Qualification')" /><span style="color:red; font-weight:bold">*</span>
                    <x-select-input id="qualification" class="block mt-1 w-full" name="qualification" required>
                    <option class="text-center" selected disabled>--Select Qualification--</option>
                    <option class="text-center" value="Diploma">Diploma</option>
                    <option class="text-center" value="Degree">Degree</option>
                    <option class="text-center" value="Masters">Masters</option>
                </x-select-input>
                    <x-input-error :messages="$errors->get('qualification')" class="mt-2" />
                </div>
                <div class="form-group">
                    <x-input-label for="description">Brief Description</x-input-label><span style="color:red; font-weight:bold">*</span>
                    <textarea class="block mt-1 w-full" id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <x-input-label for="deadline">Deadline</x-input-label><span style="color:red; font-weight:bold">*</span>
                    <input class="block mt-1 w-full" type="date" id="date" name="deadline" required>
                </div>
                <div class="form-group">
                    <x-input-label for="cover_image">Cover Photo</x-input-label><span style="color:red; font-weight:bold">*</span>
                    <input class="block mt-1 w-full" type="file" id="image" name="cover_image" accept="image/*" required>
                </div>
                <input onclick="newJobSubmit()" id="submit-profilebtn" type="submit" value="Post Job">
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
                    <x-input-label for="old_password">Old Password</x-input-label>
                    <input type="password" id="old_password" name="old_password" placeholder="Old Password" required>
                </div>
                <div class="form-group">
                    <x-input-label for="password">New Password</x-input-label>
                    <input type="password" id="password" name="password" placeholder="New Password" required>
                </div>
                <div class="form-group">
                    <x-input-label for="password_confirmation">Confirm Password</x-input-label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
                <input onclick="passwordChangeSubmit(`{{ Auth::guard('employer')->user()->id }}`)" id="submit-profilebtn" type="submit" value="Update Password">
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
        function seeMoreJobSeekerInfo(seekerId) {
            // Prevent default behavior
            event.preventDefault();

            // Retrieve Job data
            const job_seekers = @json($employer_job_match_seekers);
            const job_seeker = job_seekers.find(j => j.id == seekerId);

            // Check if Job data is available
            if (job_seeker) {
                const content = `
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">You're Viewing More Details Of <span style="color:green; font-weight:500;">${job_seeker.name}</span></h5>
                        <button type="button" id="modal-btn-close" class="btn-close" style="color:red;" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">
                        <div style="width:100%" class="card">
                            <img style="width:100%; height:200px;" src="${job_seeker.profile_picture}" alt="${job_seeker.name}" class="card-img">
                            <div class="card-body">
                                <span style="font-weight:bold;">Recruit Name:</span> ${job_seeker.name}
                            </div>
                            <div class="card-body">
                               <span style="font-weight:bold;">Skills Set:</span> ${job_seeker.skills_set}
                            </div>
                            <div class="card-body">
                               <span style="font-weight:bold;">Location:</span> ${job_seeker.location}
                            </div>
                            <div class="card-body">
                               <span style="font-weight:bold;">Working Experience:</span> ${job_seeker.required_experience} year(s)
                            </div>
                            <div class="card-body">
                               <span style="font-weight:bold;">Job Style:</span> ${job_seeker.job_style}
                            </div>
                             <div class="card-body">
                               <span style="font-weight:bold;">Biography:</span> ${job_seeker.biography}
                            </div>
                            <div style="border-bottom:1px solid green;" class="card-body">
                               <span style="font-weight:bold; color:maroon;">Qualification:</span> ${job_seeker.qualification}
                            </div>
                            <div class="mt-4" style="display:flex; justify-content:space-between">
                            <a style="text-decoration: underline; color:blue;" href="mailto:${job_seeker.email}">Email Recruit</a>
                            <a style="text-decoration: underline; color:blue;" href="tel:${job_seeker.phone}">Give A Call</a>
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
    <script src="{{asset ('/js/employer.js')}}"></script>
    </x-slot:content>
</x-layout>
