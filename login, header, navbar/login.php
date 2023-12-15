<?php include('includes/header.php'); ?>

<style>
    body {margin: 0;overflow: hidden;}

    .blurry-background {position: fixed;top: 0;left: 0;width: 100%;height: 100%;
        background: url('https://scontent-hkg4-1.xx.fbcdn.net/v/t39.30808-6/383429669_151850617997713_1472864130012210706_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=dd5e9f&_nc_eui2=AeEaFQ0ljitU1E8Hxfmuq77A4q44fdL6c6nirjh90vpzqSTiiKzUL31KKkAvBoMrGSlSOAFPkbbUwv6C3Q6IO8d0&_nc_ohc=rxoRkJ180XwAX-yCoBR&_nc_ht=scontent-hkg4-1.xx&oh=00_AfAZz8wnlIr0tggeCHhiBxkxsXLpL3E45-L5BQEnZZt01g&oe=65802FC0') center/cover fixed;
        filter: blur(8px);z-index: -1;}

    h4 {font-family: 'League Spartan', sans-serif;color: black;font-weight: bold;}

    .card {position: relative;z-index: 1;text-align: center;border-radius: 20px; overflow: hidden; }

    .profile-image {width: 100px;height: 100px;border-radius: 50%;margin-bottom: 20px;}

    .btn-primary {background-color: #4682B4;border-color: #4682B4;color: white;}
</style>

<?php
if (isset($_SESSION['loggedIn'])) {
    ?>
    <script>window.location.href = 'index.php'; </script>
    <?php
}
?>

<div class="blurry-background"></div>

<div class="py-5">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">

                    <?php alertMessage(); ?>

                    <div class="p-5">
                        <img src="https://img.lovepik.com/free-png/20211207/lovepik-female-character-avatar-png-image_401393950_wh1200.png" alt="Profile Image" class="profile-image">
                        
                        <h4 class="text-dark mb-3">Sign in</h4>
                        
                        <form action="login-code.php" method="POST">

                            <div class="mb-3">
                                <label for="email">Enter Email ID</label>
                                <input type="email" name="email" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label for="password">Enter Password</label>
                                <input type="password" name="password" class="form-control" required />
                            </div>
                            <div class="my-3">
                                <button type="submit" name="loginBtn" class="btn btn-primary w-100 mt-2">
                                    Sign In
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
