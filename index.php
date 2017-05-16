<?php
    if (isset($_GET['group']) && ($_GET['group'] == 1 || $_GET['group'] == 2)) {
        $group = $_GET['group'];
    } else {
        die('Incorrect group');
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password meter</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

    <div class="container">

        <h2 class="title">Welcome</h2>

        <form method="get" action="/password.php" class="form">

            <div class="request">Please, fill the form below</div>

            <input type="hidden" name="group" value="<?php echo $group ?>" >

            <input type="text" placeholder="Full name" name="full_name" required/>

            <input type="email" placeholder="Email" name="email" required/>

            <input type="number" placeholder="Age" name="age" required/>

            <div class="radios">
                <div class="radio-item" style="margin-right: 10px;">
                    <input type="radio" name="gender" value="1" id="male" checked>
                    <label for="male">Male</label>
                </div>
                <div class="radio-item">
                    <input type="radio" name="gender" value="0  " id="female">
                    <label for="female">Female</label>
                </div>
            </div>

            <button type="submit">start</button>
        </form>

    </div>



    <script src="/scripts/jquery-3.2.1.min.js"></script>

</body>
</html>