<?php
    $page_title = "Tickets";
    include "movies.php";

    
    $shows = array();
    foreach ($movies as $movie_id => $movie) {
        foreach ($movie["times"] as $time_id => $time) {
            $shows[$movie_id . "-" . $time_id] = $movie["title"] . " at " . $time;
        }
    }

    $show = "";
    $quantity = 1;
    $message = "";
    $total = 0;

    if (isset($_GET["show"]) && is_string($_GET["show"]) && isset($shows[$_GET["show"]])) {
        $show = $_GET["show"];
    }

    // Checks the show selected
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["show"]) && is_string($_POST["show"]) && isset($shows[$_POST["show"]])) {
            $show = $_POST["show"];
        } else {
            $message = "Please choose a showtime.";
        }

        if (isset($_POST["quantity"]) && is_string($_POST["quantity"]) &&
            is_numeric($_POST["quantity"]) && $_POST["quantity"] >= 1 && $_POST["quantity"] <= 8 &&
            $_POST["quantity"] == (int) $_POST["quantity"]) {
            $quantity = (int) $_POST["quantity"];
        } else {
            $message = "Please choose between 1 and 8 tickets.";
        }

        if ($message == "") {
            $total = $quantity * $ticket_price;
        }
    }

    include "header.php";
?>

<main class="section ticket-page">
    <p class="eyebrow">BOX OFFICE</p>
    <h1>Tickets</h1>
 <p>Pick a show and see your total. Tickets are $<?php echo $ticket_price; ?>.00 each.</p>

    <form action="tix.php" method="post">
        <label for="show">Movie and showtime</label>
        <select id="show" name="show" required>
            <option value="">Choose a showtime</option>
            <?php foreach ($shows as $show_id => $show_name) { ?>
                <option value="<?php echo $show_id; ?>" <?php if ($show == $show_id) echo "selected"; ?>>
                    <?php echo $show_name; ?>
                </option>
            <?php } ?>
        </select>

        <label for="quantity">Number of tickets</label>
        <input type="number" id="quantity" name="quantity" min="1" max="8"
               value="<?php echo $quantity; ?>" required>

     <button type="submit">Calculate total</button>
    </form>

    <?php if ($message != "") { ?>
        <p class="error" role="alert"><?php echo $message; ?></p>
    <?php } ?>

    <?php if ($total > 0) { ?>
        <section class="summary" aria-label="Ticket estimate">
          <h2>Ticket estimate</h2>
        <p><?php echo $shows[$show]; ?></p>
         <p>Tickets: <?php echo $quantity; ?></p>
        <p><strong>Total: $<?php echo $total; ?>.00</strong></p>
        </section>
    <?php } ?>
</main>

<?php include "footer.php"; ?>
