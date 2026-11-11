<?php
    $page_title = "Now Playing";
    include "movies.php";
    include "header.php";
?>

<main>
    <section class="hero">
        <h1>Movie night at The View</h1>
        <p>Pick a film and a showtime for your next adventure to the cinema.</p>
        <a class="button" href="#showtimes">See showtimes</a>
    </section>

    <section class="section" id="showtimes">
        <p class="eyebrow">THE LINEUP</p>
        <h2>Now playing</h2>
        <p class="muted">Choose a showtime to check ticket prices.</p>

        <div class="movies">
            <?php
                // shows each movie and links its times to the ticket form
                foreach ($movies as $movie_id => $movie) {
            ?>
                <article class="movie">
                    <div class="poster <?php echo $movie_id; ?>">
                        <h3><?php echo $movie["title"]; ?></h3>
                    </div>
                    <div class="movie-info">
                        <p class="details"><?php echo $movie["details"]; ?></p>
                        <p><?php echo $movie["description"]; ?></p>
                        <div class="times">
                            <?php foreach ($movie["times"] as $time_id => $time) { ?>
                                <a href="tix.php?show=<?php echo $movie_id . "-" . $time_id; ?>"
                                   aria-label="<?php echo $movie["title"] . " at " . $time; ?>">
                                    <?php echo $time; ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </article>
            <?php } ?>
        </div>
    </section>
</main>

<?php include "footer.php"; ?>
