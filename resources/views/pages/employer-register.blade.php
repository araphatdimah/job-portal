<x-guest-layout>
    <form method="POST" action="/employer-register" enctype="multipart/form-data">
        @csrf

        <div>
            <h2 style="color:darkorange" class="text-center">EMPLOYER/COMPANY SIGN UP FORM</h2>
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Employer/Company Name')" /><span style="color:red; font-weight:bold">*</span>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" /><span style="color:red; font-weight:bold">*</span>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Contact-->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone Contact')" /><span style="color:red; font-weight:bold">*</span>
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Location-->
        <div class="mt-4">
            <x-input-label for="location" :value="__('Location')" /><span style="color:red; font-weight:bold">*</span>
            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>

        <!-- Address-->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" /><span style="color:red; font-weight:bold">*</span>
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

         <!-- Industry -->
         <div class="mt-4">
        <x-input-label for="industry" :value="__('Industry')" /><span style="color:red; font-weight:bold">*</span>
        <x-select-input id="industry" class="block mt-1 w-full" name="industry">
            <option class="text-center" selected disabled>--Select Industry--</option>
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

        <!-- Website Link-->
        <div class="mt-4">
            <x-input-label for="website_link" :value="__('Website Link')" />
            <x-text-input id="website_link" class="block mt-1 w-full" type="text" name="website_link" :value="old('website_link')" />
            <x-input-error :messages="$errors->get('website_link')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="description" :value="__('Brief Description (What Do You Do?)')" /><span style="color:red; font-weight:bold">*</span>
            <textarea style="border-radius:4px;" id="description" class="block mt-1 w-full" type="text" name="description" placeholder="Write a brief description of your company and what you do." :value="old('description')"></textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

         <!-- Buz Certificate-->
         <div class="mt-4">
            <x-input-label for="buz_cert" :value="__('Copy of Business Certificate')" /><span style="color:red; font-weight:bold">*</span>
            <x-text-input id="buz_cert" class="block mt-1 w-full" type="file" accept="application/pdf" name="buz_cert" />
            <x-input-error :messages="$errors->get('buz_cert')" class="mt-2" />
        </div>

        <!-- Company Logo-->
        <div class="mt-4">
            <x-input-label for="company_profile" :value="__('Company Profile Image')" />
            <x-text-input id="company_profile" class="block mt-1 w-full" type="file" name="company_profile" />
            <x-input-error :messages="$errors->get('company_profile')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" /><span style="color:red; font-weight:bold">*</span>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                         />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" /><span style="color:red; font-weight:bold">*</span>
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="/employer-login">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
