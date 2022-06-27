<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<style>
    .zoom {
        transition: transform .5s;
    }

    .zoom:hover {
        transform: scale(1.1);
        overflow: hidden;
    }

    .offcanvas,
    .offcanvas-lg,
    .offcanvas-md,
    .offcanvas-sm,
    .offcanvas-xl,
    .offcanvas-xxl {
        --bs-offcanvas-width: 600px;
        --bs-offcanvas-height: 30vh;
        --bs-offcanvas-padding-x: 1rem;
        --bs-offcanvas-padding-y: 1rem;
        --bs-offcanvas-color: ;
        --bs-offcanvas-bg: #fff;
        --bs-offcanvas-border-width: 1px;
        --bs-offcanvas-border-color: var(--bs-border-color-translucent);
        --bs-offcanvas-box-shadow: 0 0.125rem 0.25remrgba(0, 0, 0, 0.075);
    }
</style>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">All games</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Manage Library</a>
            </li>
        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
</nav>

<div class="container">
    <div class="row mb-3 py-5">
        <div class="col-md-12">
            <h1>Games</h1>
        </div>
    </div>
    <div class="row">
        <?php
        foreach ($games as $game) { ?>
            <div class="col-md-4 px-5">
                <div class="card mb-5 zoom">
                    <!-- <img src="/public/images/alejandro-acosta-AwAf9HhhysQ-unsplash.jpg" class="card-img-top" width="20%" height="20%"> -->
                    <img id="wiki_image" class="card-img-top" width="20%" height="20%">
                    <div class="card-body">
                        <h5 class="card-title" id="game_title"><?= $game->title ?></h5>
                        <p class="card-text" id="snippet"></p>
                        <button class="btn btn-primary w-100" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">View</button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel"><?= $game->title ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <img src="/public/images/alejandro-acosta-AwAf9HhhysQ-unsplash.jpg" width="70%" height="70%" class="zoom img-fluid mx-auto d-block py-5">
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        var url = "https://en.wikipedia.org/w/api.php";
        let game = "League of Legends";

        var params = {
            action: "query",
            list: "search",
            srsearch: game,
            format: "json"
        };

        url = url + "?origin=*";
        Object.keys(params).forEach(function(key) {
            url += "&" + key + "=" + params[key];
        });

        fetch(url)
            .then(function(response) {
                return response.json();
            })
            .then(function(response) {

                let snippet = response.query.search[0].snippet;
                snippet = snippet.split(".");
                document.getElementById("snippet").innerHTML = snippet[0] + ".";

                let wiki_image = response.query.search[0].pageid;
                console.log(wiki_image);
                let wiki_url = "https://en.wikipedia.org/w/api.php?action=query&prop=pageimages&format=json&piprop=original&pageids=" + wiki_image;

                $.ajax({
                    url: wiki_url,
                    type: "GET",
                    dataType: "jsonp",
                    success: function(data) {
                        let image = data.query.pages[wiki_image].original.source;
                        document.getElementById("wiki_image").src = image;
                    }
                });
            })
            .catch(function(error) {
                console.log(error);
            });

        document.getElementById("game_title").innerHTML = game;
    });
</script>