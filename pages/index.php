<!-- <?php
echo '<h1>Index</h1>' ?> -->
<?php include('../layouts/nav.php'); ?>

<div class="home">
    <!-- Slider -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../images/slider1.jpg" class="d-block w-100" alt="slider1">
            </div>
            <div class="carousel-item">
                <img src="../images/slider2.jpg" class="d-block w-100" alt="slider2">
            </div>
            <div class="carousel-item">
                <img src="../images/slider3.jpeg" class="d-block w-100" alt="slider3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- End of Slider -->

    <!-- About US -->
     <div class="about">
        <div class="row">
            <div class="col-lg-6">
                <img src="../images/about.jpg" alt="about">
            </div>
            <div class="col-lg-6">
                <h2 class="text-center">About HealthLogs Hospital</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum aut nisi veritatis sequi similique dolorum aperiam quasi quas! Repellat nesciunt impedit in aperiam sed itaque atque exercitationem cupiditate ea. Quia.</p>
                <div class="sub-content row">
                    <div class="col-md-6">
                        <h5>Our Vision</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque a est earum molestiae impedit similique, eligendi nihil perspiciatis eius ipsam minima quibusdam repudiandae asperiores sit architecto illo voluptatum, esse optio!</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Our Mission</h5>
                        <ul>
                            <li>Hello World!</li>
                            <li>Hello World!</li>
                            <li>Hello World!</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
     </div>
    <!-- End of About Us -->

    <!-- Features -->
     <section>
        <div class="features">
            <h2>Features</h2>
            <div class="details row">
                <div class="infra col-6 row">
                    <div class="icon col-2">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="content col-10">
                        <h4>Great Infrastructure</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint maiores, ab sit neque numquam fugit aut praesentium nulla deserunt. Totam quas unde praesentium accusamus ullam assumenda quia similique est officia.</p>
                    </div>
                </div>
                <div class="medical col-6 row">
                    <div class="icon col-2">
                        <i class="fas fa-pills"></i>
                    </div>
                    <div class="content col-10">
                        <h4>Advanced Medical Facilities</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint maiores, ab sit neque numquam fugit aut praesentium nulla deserunt. Totam quas unde praesentium accusamus ullam assumenda quia similique est officia.</p>
                    </div>
                </div>
            </div>
            <div class="details row">
                <div class="social col-6 row">
                    <div class="icon col-2">
                    <i class="fas fa-hands-helping"></i>                    
                </div>
                    <div class="content col-10">
                        <h4>Social Services</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint maiores, ab sit neque numquam fugit aut praesentium nulla deserunt. Totam quas unde praesentium accusamus ullam assumenda quia similique est officia.</p>
                    </div>
                </div>
                <div class="excellent col-6 row">
                    <div class="icon col-2">
                        <i class="fa-solid fa-truck-medical"></i>
                    </div>
                    <div class="content col-10">
                        <h4>Excellent Ancillary Services</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint maiores, ab sit neque numquam fugit aut praesentium nulla deserunt. Totam quas unde praesentium accusamus ullam assumenda quia similique est officia.</p>
                    </div>
                </div>
            </div>
            <div class="details row">
                <div class="ambulance col-6 row">
                    <div class="icon col-2">
                        <i class="fa-solid fa-truck-medical"></i>
                    </div>
                    <div class="content col-10">
                        <h4>24/7 Ambulance Services</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint maiores, ab sit neque numquam fugit aut praesentium nulla deserunt. Totam quas unde praesentium accusamus ullam assumenda quia similique est officia.</p>
                    </div>
                </div>
                <div class="technology col-6 row">
                    <div class="icon col-2">
                        <i class="fas fa-robot"></i>                    
                    </div>
                    <div class="content col-10">
                        <h4>Cutting Edge Technology</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint maiores, ab sit neque numquam fugit aut praesentium nulla deserunt. Totam quas unde praesentium accusamus ullam assumenda quia similique est officia.</p>
                    </div>
                </div>
            </div>
        </div>
     </section>
    <!-- End of Features -->

    <!-- Working Hours -->
     <!-- <section class="working">
        <div class="container-fluid">
            <img src="../images/slider2.jpg" class="d-block w-100" alt="bg-img">
            <div class="top-left">
                <h1>Our Clinic <br> Working Hours <br> Schedule</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur perferendis, corrupti nostrum deleniti dolorum, culpa quos nihil est eos optio nisi quod beatae possimus error incidunt fugiat consequuntur architecto!</p>

                <div class="schedule row">
                    <div class="day col-6">
                        <i class="fa-solid fa-calendar-days"> <span> Monday</span></i>
                    </div>
                    <div class="time col-6">
                        <p><strong>8:00 AM - 8:00 PM</strong></p>
                    </div>
                </div>
                <div class="schedule row">
                    <div class="day col-6">
                        <i class="fa-solid fa-calendar-days"> <span> Tuesday</span></i>
                    </div>
                    <div class="time col-6">
                        <p><strong>8:00 AM - 8:00 PM</strong></p>
                    </div>
                </div>
                <div class="schedule row">
                    <div class="day col-6">
                        <i class="fa-solid fa-calendar-days"> <span> Wednesday</span></i>
                    </div>
                    <div class="time col-6">
                        <p><strong>8:00 AM - 8:00 PM</strong></p>
                    </div>
                </div>
                <div class="schedule row">
                    <div class="day col-6">
                        <i class="fa-solid fa-calendar-days"> <span> Thursday</span></i>
                    </div>
                    <div class="time col-6">
                        <p><strong>8:00 AM - 8:00 PM</strong></p>
                    </div>
                </div>
                <div class="schedule row">
                    <div class="day col-6">
                        <i class="fa-solid fa-calendar-days"> <span> Friday</span></i>
                    </div>
                    <div class="time col-6">
                        <p><strong>8:00 AM - 8:00 PM</strong></p>
                    </div>
                </div>
            </div>
        </div>
     </section> -->

     <section class="working">
    <div class="container-fluid">
        <img src="../images/slider2.jpg" class="d-block w-100" alt="bg-img">
        <div class="top-left">
            <h1>Our Clinic <br> Working Hours <br> Schedule</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur perferendis, corrupti nostrum deleniti dolorum, culpa quos nihil est eos optio nisi quod beatae possimus error incidunt fugiat consequuntur architecto!</p>

            <div class="schedule row">
                <div class="day col-12 col-md-6">
                    <i class="fa-solid fa-calendar-days"> <span> Monday</span></i>
                </div>
                <div class="time col-12 col-md-6">
                    <p><strong>8:00 AM - 8:00 PM</strong></p>
                </div>
            </div>
            <div class="schedule row">
                <div class="day col-12 col-md-6">
                    <i class="fa-solid fa-calendar-days"> <span> Tuesday</span></i>
                </div>
                <div class="time col-12 col-md-6">
                    <p><strong>8:00 AM - 8:00 PM</strong></p>
                </div>
            </div>
            <div class="schedule row">
                <div class="day col-12 col-md-6">
                    <i class="fa-solid fa-calendar-days"> <span> Wednesday</span></i>
                </div>
                <div class="time col-12 col-md-6">
                    <p><strong>8:00 AM - 8:00 PM</strong></p>
                </div>
            </div>
            <div class="schedule row">
                <div class="day col-12 col-md-6">
                    <i class="fa-solid fa-calendar-days"> <span> Thursday</span></i>
                </div>
                <div class="time col-12 col-md-6">
                    <p><strong>8:00 AM - 8:00 PM</strong></p>
                </div>
            </div>
            <div class="schedule row">
                <div class="day col-12 col-md-6">
                    <i class="fa-solid fa-calendar-days"> <span> Friday</span></i>
                </div>
                <div class="time col-12 col-md-6">
                    <p><strong>8:00 AM - 8:00 PM</strong></p>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- End of Working Hours -->
     
</div>