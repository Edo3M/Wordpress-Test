<?php get_header(); ?>

<div class="container-fluid text-center text-md-start front-page_hero" style="background-image:url(<?php echo get_theme_file_uri('images/hero-bg.jpg') ?>)">
    <div class="row h-100">
        <div class="col">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-md-6 offset-md-6 d-flex flex-column justify-content-center">
                        <h1>Lorem ipsum</h1>
                        <h2>Dolor, sit amet consectetur adipisicing elit.</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">

        <div class="col-md-8">
            <!-- Servicios -->
            <h2 class="text-center">Services</h2>
            <div class="home-services my-5">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-laptop mb-3"></i>
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-desktop mb-3"></i>
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-database mb-3"></i>
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-upload mb-3"></i>
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>

            <!-- Contacto -->
            <h2 class="text-center">Please get in touch with us</h2>
            <form>
                <div class="mb-3">
                    <label for="exampleInputName" class="form-label">Your name</label>
                    <input type="text" class="form-control" id="exampleInputName">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mx-auto d-block">Submit</button>
            </form>
        </div>

        <div class="col-md-4">
            <ul class="front-page_sidebar">
                <?php dynamic_sidebar('frontpage-sidebar'); ?>
            </ul>
        </div>
    </div>
</div>

<?php get_footer(); ?>