<!DOCTYPE html>
<html lang="en">
<!-- IF CURRENT SESSION IS AN EMPLOYEE -->
<?php if($this->Identity->get('type') === "emp") : ?>
    <body>
    <div class="container-lg py-1 bg-light hero-header mb-5">
    <div class="container my-5 py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-3 text-white animated slideInLeft">Welcome,<br>Admin.</h1>
                <p class="text-white animated slideInLeft mb-4 pb-2"></p>
                <div class="button-container">
                    <a href="<?= $this->Url->build('/Users') ?>" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Add a new admin user</a>
                    <a href="<?= $this->Url->build('/Menus/admin-index') ?>" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Manage the menu</a>
                    <a href="<?= $this->Url->build('/Products') ?>" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Manage Food Items</a>
                    <a href="<?= $this->Url->build('/Images') ?>" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Manage Images</a>
                </div>
            </div>
            <div class="col-lg-5 text-right overflow-hidden">
            <img class="flex-sm-shrink-0 img-fluid roundd" src="<?= $websiteContent->home_image ?>" style="width: 200px; height: auto; object-fit: contain;" alt="">
            <!-- <?= $this->Html->image('meal.png', ["alt" => "Meal", "class" => "img-fluid"]) ?> -->
            </div>
        </div>
    </div>
</div>

<style>
    .button-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        gap: 10px; /* Adjust the gap as per your design */
    }   
    .button-container .btn {
        flex: 1;
        max-width: 200px; /* Adjust the maximum width as needed */
    }
</style>

    </body>

<!-- IF CURRENT IDENTITY IS NOT AN EMPLOYEE -->
<?php else : ?>
    <body>
    <div class="container-lg py-1 bg-light hero-header mb-5">
        <div class="container my-5 py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="display-3 text-white animated slideInLeft">Welcome to<br>Tasty Bites Kitchen</h1>
                    <p class="text-white animated slideInLeft mb-4 pb-2"></p>
                    <a href="<?= $this->Url->build('/Menus') ?>" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Check out the menu!</a>
                </div>
                <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                <img class="flex-sm-shrink-0 img-fluid roundd" src="<?= $websiteContent->home_image ?>" style="width: 200px; height: auto; object-fit: contain;" alt="">
                            <!-- <?= $this->Html->image('meal.png', ["alt" => "Meal", "class" => "img-fluid"]) ?> -->
            </div>
            </div>
        </div>
    </div>
    </body>
<?php endif; ?>


