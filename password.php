<?php
    $startTime = time();
    $group = $_GET['group'];
    $fullName = $_GET['full_name'];
    $email = $_GET['email'];
    $age = $_GET['age'];
    $gender = $_GET['gender'];
?>

<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <title>Password meter</title>

    <link rel="stylesheet" href="styles/style.css">
</head>

<body id="body">

    <div class="container" id="container">

        <div id="word0" class="word">The</div>
        <div id="word1" class="word">Quick</div>
        <div id="word2" class="word">Brown</div>
        <div id="word3" class="word">Fox</div>
        <div id="word4" class="word">Jumps</div>
        <div id="word5" class="word">Over</div>
        <div id="word6" class="word">The</div>
        <div id="word7" class="word">Lazy</div>
        <div id="word8" class="word">Dog</div>
        <div id="word9" class="word">The</div>
        <div id="word10" class="word">Quick</div>
        <div id="word11" class="word">Brown</div>
        <div id="word12" class="word">Brown</div>
        <div id="word13" class="word">Fox</div>
        <div id="word14" class="word">Jumps</div>
        <div id="word15" class="word">Over</div>
        <div id="word16" class="word">The</div>
        <div id="word17" class="word">Lazy</div>
        <div id="word18" class="word">Dog</div>
        <div id="word19" class="word">Dog</div>
        <div id="word20" class="word">The</div>

        <div style="padding-top: 100px">
            <form method="post" action="/store.php" class="form" id="form">

                <?php if ($group == 2) : ?>
                    <div class="request" style="color: darkred;">
                        Don't look at the words appearing in the background while creating the password
                    </div>
                <?php endif; ?>

                <input type="hidden" name="group" value="<?php echo $group ?>">
                <input type="hidden" name="start_time" value="<?php echo $startTime; ?>">
                <input type="hidden" name="full_name" value="<?php echo $fullName; ?>">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="age" value="<?php echo $age; ?>">
                <input type="hidden" name="gender" value="<?php echo $gender; ?>">
                <input type="text" placeholder="Please, create a password" name="password" minlength="8" required style="margin-bottom: 10px">
                <div class="message">
                    Password must consist of a minimum 8 characters
                </div>
                <button type="submit">submit</button>
            </form>
        </div>
    </div>






    <script src="/scripts/jquery-3.2.1.min.js"></script>

    <script>
        var body = $('#body');
        var container = $("#container");
        var form = $('#form');

        var maxSearchIterations = 20;
        var min_x = 0;
        var max_x = container.width() - 150;
        var min_y = 0;
        var max_y = container.height() - 50;
        var filled_areas = [];

        function calc_overlap(a1) {
            var overlap = 0;
            for (i = 0; i < filled_areas.length; i++) {

                var a2 = filled_areas[i];

                // no intersection cases
                if (a1.x + a1.width < a2.x) {
                    continue;
                }
                if (a2.x + a2.width < a1.x) {
                    continue;
                }
                if (a1.y + a1.height < a2.y) {
                    continue;
                }
                if (a2.y + a2.height < a1.y) {
                    continue;
                }

                // intersection exists : calculate it !
                var x1 = Math.max(a1.x, a2.x);
                var y1 = Math.max(a1.y, a2.y);
                var x2 = Math.min(a1.x + a1.width, a2.x + a2.width);
                var y2 = Math.min(a1.y + a1.height, a2.y + a2.height);

                var intersection = ((x1 - x2) * (y1 - y2));

                overlap += intersection;

                // console.log("( "+x1+" - "+x2+" ) * ( "+y1+" - "+y2+" ) = " + intersection);
            }

            // console.log("overlap = " + overlap + " on " + filled_areas.length + " filled areas ");
            return overlap;
        }

        function randomize() {
            filled_areas.splice(0, filled_areas.length);

            filled_areas.push({
                x: form.offset().left - container.offset().left,
                y: form.offset().top - container.offset().top,
                width: form.width() + 100,
                height: form.height() + 100
            });

            var index = 0;
            $('.word').each(function() {
                var rand_x = 0;
                var rand_y = 0;
                var i = 0;
                var smallest_overlap = 9007199254740992;
                var best_choice;
                var area;
                for (i = 0; i < maxSearchIterations; i++) {
                    rand_x = Math.round(min_x + ((max_x - min_x) * (Math.random() % 1)));
                    rand_y = Math.round(min_y + ((max_y - min_y) * (Math.random() % 1)));
                    area = {
                        x: rand_x,
                        y: rand_y,
                        width: $(this).width(),
                        height: $(this).height()
                    };
                    var overlap = calc_overlap(area);
                    if (overlap < smallest_overlap) {
                        smallest_overlap = overlap;
                        best_choice = area;
                    }
                    if (overlap === 0) {
                        break;
                    }
                }

                filled_areas.push(best_choice);

                $(this).css({
                    position: "absolute",
                    "z-index": index++
                });
                $(this).animate({
                    left: rand_x,
                    top: rand_y
                });

                // console.log("and the winner is : " + smallest_overlap);
            });
            return false;
        }

        randomize();

        setInterval(randomize, 4000);
    </script>

</body>
</html>