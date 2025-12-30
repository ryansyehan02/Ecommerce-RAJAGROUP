<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row py-5">
            <div class="col-4">

            </div>
            <div class="col-4 py-3">
                <form action="login_proses.php" method="post">
                    <div class="card py-3 bg-body rounded-4 shadow-lg">
                        <div class="card-header bg-body text-center">
                            <h4 class="h4">SIGN IN</h4>
                        </div>
                        <div class="card-body py-2 text-center">
                            <?php 
                                if(isset($_GET['pesan'])){
                            ?>
                                <label for="txtUsername" class="text-danger text-center">
                                    <?php echo $_GET['pesan']."!!"; ?>
                                </label>
                            <?php
                                }
                            ?>
                            <input type="text" name="txtUsername" id="txtUsername" class="form-control my-2" placeholder="Username..">
                            <input type="password" name="txtPassword" id="txtPassword" class="form-control my-2" placeholder="Password..">
                            
                        </div>
                        <div class="card-footer border-0 bg-body d-grid gap-2">
                            <input type="submit" value="SIGN IN" class="btn btn-primary">
                            <a href="" class="text-secondary text-end">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-4">

            </div>
        </div>
    </div>
</body>
</html>