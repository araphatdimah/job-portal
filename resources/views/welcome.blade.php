<x-layout>
@guest
     <x-slot:status>
      <x-unauthenticated>
        <a href="/portal-login" class="login-btn">Sign in</a>

            <!-- Profile dropdown -->
        <div class="relative ml-3">
          <div>
            <a href="/portal-register" class="create-account-btn">Create account</a>
          </div>
        </div>
        </x-unauthenticated>
     </x-slot:status>
      @endguest

      @auth
     <x-slot:status>
      <x-authenticated-user>
     <form method="POST" action="/portal-logout">
        @csrf
        <x-button-form>Logout</x-button-form>
      </form>
        <div class="relative ml-3">
          <div>
                <x-links href="/profile" :active="request()->is('profile')">Profile</x-links> 
          </div>
        </div>
        </x-authenticated-user>
     </x-slot:status>
@endauth
<x-slot:heading><span style="color: darkblue;">Welcome To Job Portal</span></x-slot:heading>
  <x-slot:content> 
    <section class="hero">
        <div class="hero-content">
            <h1>Jump-Start Your <span style="color: #e74c3c;">Career</span></h1>
            <h2>The Home Of Your</h2> 
            <button class="span-dream">Dream Job</button>
            <p>Getting the job of your dreams has never been easier. If you need to, you can browse a job and apply.</p>
            <form class="search-form">
                <input type="text" placeholder="Job title, keywords, or company">
                <input type="text" placeholder="Location">
                <button type="submit">Search</button>
            </form>
        </div>
            <img src="images/job portal banner.jpeg" alt="job portal">
    </section>
    <div style="text-align: center; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif">
        <h2 style="font-size: large; font-weight:bold; padding:10px;">Browse Categories</h2>
        <p>Most popular categories of jobs</p>
    </div>
    <section class="categories">
        <a href="#" class="category">
            <img src="images/sales and marketing.jpeg" alt="Sale/Marketing">
            <h3>Sale/Marketing</h3>
            <p>(3456 jobs)</p>
        </a>
        <a href="#" class="category">
            <img src="images/finance.jpeg" alt="Finance">
            <h3>Finance</h3>
            <p>(4456 jobs)</p>
        </a>
        <a href="#" class="category">
            <img src="images/education-training.jpg" alt="Education/training">
            <h3>Education/training</h3>
            <p>(346 jobs)</p>
        </a>
        <a href="#" class="category">
            <img src="images/technologies.jpeg" alt="Technologies">
            <h3>Technologies</h3>
            <p>(346 jobs)</p>
        </a>
        <a href="#" class="category">
            <img src="images/healthcare.png" alt="Healthcare">
            <h3>Healthcare</h3>
            <p>(46 jobs)</p>
        </a>
        <a href="#" class="category">
            <img src="images/art-design.jpg" alt="Art/Design">
            <h3>Art/Design</h3>
            <p>(26 jobs)</p>
        </a>
        <a href="#" class="category">
            <img src="images/science.jpeg" alt="Science">
            <h3>Science</h3>
            <p>(14 jobs)</p>
        </a>
        <a href="#" class="category">
            <img src="images/services.jpeg" alt="Services">
            <h3>Services</h3>
            <p>(3443 jobs)</p>
        </a>
    </section>
</body>
</html>

  </x-slot:content>
</x-layout>