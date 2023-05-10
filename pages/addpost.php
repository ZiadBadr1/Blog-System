<?php
session_start();
include("../includes/header.php");
include("../includes/navbar.php");
require_once("../config/database.php");
require("../classes/Post.php");





$post = new Post($pdo);
if(isset($_POST['add']))
{
    if ($post->createPost($_POST['title'], $_POST['content'], $_SESSION['user_id'])) {
        header('Location: ../index.php');
        exit;
    } else {
        echo 'An error occurred while creating the post.';
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
                    <h2 class="fw-bold mb-5">Add Post</h2>
                    <form method="post">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Title</label>
                            <input name="title" type="text" id="form3Example3" class="form-control" required />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example4">Content</label>
                            <textarea name="content" type="password" id="form3Example4" class="form-control"
                                required></textarea>
                        </div>



                        <!-- Submit button -->
                        <button name="add" type="submit" class="btn btn-primary btn-block mb-4">
                            Add Post
                        </button>


                    </form>
                </div>
            </div>
        </div>
    </div>
</section>






?>