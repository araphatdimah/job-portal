<x-guest-layout>
    <form method="POST" action="/portal-register" enctype="multipart/form-data">
        @csrf

        <div>
            <h2 style="color:darkorange" class="text-center">SIGN UP FORM</h2>
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" /><span style="color:red; font-weight:bold">*</span>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus autocomplete="name" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" /><span style="color:red; font-weight:bold">*</span>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autocomplete="username" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <!-- Phone Contact-->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone Contact')" /><span style="color:red; font-weight:bold">*</span>
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
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

        <!-- Industry of Interest -->
        <div class="mt-4">
            <x-input-label for="industry" :value="__('Industry Of Interest')" /><span style="color:red; font-weight:bold">*</span>
            <x-select-input id="industry" class="block mt-1 w-full" name="industry" required>
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
            <x-input-error :messages="$errors->get('industry')" class="mt-2" />
        </div>
            
        <!-- Job Style -->
        <div class="mt-4">
            <x-input-label for="job_style" :value="__('Job Style')" /><span style="color:red; font-weight:bold">*</span>
            <x-select-input id="job_style" class="block mt-1 w-full" name="job_style" required>
                <option class="text-center" selected disabled>--Select Style--</option>
                <option class="text-center" value="Remote">Remote</option>
                <option class="text-center" value="On Field">On Field</option>
                <option class="text-center" value="Hybrid">Hybrid</option>
        </x-select-input>
            <x-input-error :messages="$errors->get('job_style')" class="mt-2" />
        </div>

        <!-- Skills Set-->
        <div class="mt-4">
            <x-input-label for="skills_set" :value="__('Skills Set')" /><span style="color:red; font-weight:bold">*</span>
            <textarea class="block mt-1 w-full" name="skills_set" id="skills_set" placeholder="Enter Both Soft & Technical Skills" required></textarea>
            <x-input-error :messages="$errors->get('skills_set')" class="mt-2" />
        </div>

        <!-- Biography-->
        <div class="mt-4">
            <x-input-label for="biography" :value="__('Brief Biography')" /><span style="color:red; font-weight:bold">*</span>
            <textarea class="block mt-1 w-full" name="biography" id="biography" placeholder="Write A Brief Biography Of Yourself" required></textarea>
            <x-input-error :messages="$errors->get('biography')" class="mt-2" />
        </div>

        <!-- Years of Experience-->
        <div class="mt-4">
            <x-input-label for="required_experience" :value="__('Years Of Working Experience')" /><span style="color:red; font-weight:bold">*</span>
            <x-text-input id="required_experience" class="block mt-1 w-full" type="number" name="required_experience" required />
            <x-input-error :messages="$errors->get('required_experience')" class="mt-2" />
        </div>

         <!-- Location -->
         <div class="mt-4">
            <x-input-label for="location" :value="__('Current Location Of Stay')" /><span style="color:red; font-weight:bold">*</span>
            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" required />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>

        <!-- Supporting Documents-->
        <div class="mt-4">
            <x-input-label for="documents" :value="__('Supporting Documents (Put All In PDF')" />
            <x-text-input id="documents" class="block mt-1 w-full" type="file" accept="application/pdf" name="documents" />
            <x-input-error :messages="$errors->get('documents')" class="mt-2" />
        </div>

        <!-- Profile Picture-->
        <div class="mt-4">
            <x-input-label for="profile_picture" :value="__('Profile Image')" />
            <x-text-input id="profile_picture" class="block mt-1 w-full" type="file" accept="image/*" name="profile_picture" />
            <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" /><span style="color:red; font-weight:bold">*</span>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                         required/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" /><span style="color:red; font-weight:bold">*</span>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="/portal-login">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
