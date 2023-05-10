<?php 
include("../includes/header.php");
include("../includes/navbar.php");
require_once("../config/database.php");
require_once("../classes/User.php");

if(isset($_SESSION['user_id']))
{
    header('Location: ../index.php');
    exit;
}
if($_POST && isset($_POST['login'])&& isset($_POST['email'])&& isset($_POST['password']))
{

    $user = new User($pdo);
    
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $result = $user->login($email,$password);
    if($result!== true)
    {
        $errors = $result;
    }

}



?>



<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
        <div class="card-body py-5 px-md-5">

            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5">Sign in now</h2>
                    <?php if (isset($errors)) : ?>
                    <div class=" alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                            <li><?= $error ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <?php endif ?><form method="post">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Email address</label>
                            <input name="email" type="email" id="form3Example3" class="form-control" />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example4">Password</label>
                            <input name="password" type="password" id="form3Example4" class="form-control" />
                        </div>



                        <!-- Submit button -->
                        <button name="login" type="submit" class="btn btn-primary btn-block mb-4">
                            Sign in
                        </button>

                        <!-- Register buttons -->
                        <div class="text-center">
                            <a href="register.php">or sign up</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section: Design Block -->
<?php 

include("../includes/footer.php");
?>