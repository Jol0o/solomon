<?php

// api url
$url = 'https://newsapi.org/v2/top-headlines?q=sports&language=en&apiKey=94feb605ac4747f085828ff72ff2af04';

// fetch the api
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_USERAGENT, 'Your-Application-Name');

// api response
$response = curl_exec($curl);
//checking if the data is false or null
if ($response === false) {
    $error = curl_error($curl);
    // Handle the error appropriately
} else {
    // this will decode the JSON string and convert it into PHP array or object
    $data = json_decode($response, true);
    //assigned the data.articles value with articles variable
    $articles = $data['articles'];
    //check if the articles is not empty
    if (!empty($articles)) {
        // then loop the data
        foreach ($articles as $article) {
            $title = $article['title'];
            $description = $article['description'];
            $url = $article['url'];
            $urlToImage = $article['urlToImage'];
            $content = $article['content'];
            $date = $article['publishedAt'];
            $author = $article['author'];
        }
    } else {
        echo "No articles found.";
    }
}
curl_close($curl);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/style.css">
    <script src="https://kit.fontawesome.com/7f58f482ae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>NewsLetter</title>
</head>

<body>

    <nav class='navbar'>
        <div class='logo'>Blackcofferr</div>
        <div class='btn'>
            <ul>
                <li>Home</li>
                <li>Trending</li>
                <li>Contact</li>
            </ul>
            <a href="login.php">
                <button class='login'>Login</button>
            </a>
        </div>
    </nav>
    <div class="header" data-aos="slide-down" data-aos-duration="3500">
        <div class='header-container'>
            <h1>News Updates</h1>
        </div>
    </div>
    <div class="news">
        <div class="container">
            <div class="trending" data-aos="flip-up" data-aos-duration="3100">
                <h1>Trending News</h1>
                <form action="search.php" method="POST">
                    <input type="text" name="search">
                    <button type='submit'>Search</button>
                </form>
            </div>
            <div class='trending-news'>
                <div class='news-card'>
                    <?php
                    $limit = 7;
                    $counter = 0;

                    foreach ($articles as $article) {
                        if ($counter > $limit) {
                            break;
                        }

                        $title = $article['title'];
                        $description = $article['description'];
                        $url = $article['url'];
                        $urlToImage = $article['urlToImage'];
                        $content = $article['content'];
                        $author = $article['author'];
                        $date = $article['publishedAt'];
                        $shortened_text = substr($title, 0, 100);
                        $img = ($urlToImage === null) ? 'https://images.pexels.com/photos/1577882/pexels-photo-1577882.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1' : $urlToImage;
                        // Output the article within the right-card component
                        echo "
            <a href=$url target='_blank' class='wraper' data-aos='slide-down' data-aos-duration='3500'>  
            <img src=$img alt='news'/>
            <span>
            <h3>Sport</h3>
                <h2>$shortened_text</h2>
                <p>$author</p>
            </span>
            </a>";
                        $counter++; // Increment the counter
                    }
                    ?>
                </div>
            </div>
            <div class="miss">
                <h1>
                    Don't <span>Miss</span>
                </h1>
                <div class="miss-card">
                    <?php
                    $url = 'https://newsapi.org/v2/everything?q=gaming&apiKey=94feb605ac4747f085828ff72ff2af04';

                    $curl = curl_init($url);

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_USERAGENT, 'Your-Application-Name');

                    $response = curl_exec($curl);

                    if ($response === false) {
                        $error = curl_error($curl);
                        // Handle the error appropriately
                    } else {
                        $data = json_decode($response, true);

                        $articles = $data['articles'];
                        $limit = 4; // Set the limit to 4 items
                        $counter = 0; // Initialize a counter
                        if (!empty($articles)) {
                            foreach ($articles as $article) {
                                if ($counter >= $limit) {
                                    break; // Break the loop if the limit is reached
                                }
                                $title = $article['title'];
                                $description = $article['description'];
                                $url = $article['url'];
                                $urlToImage = $article['urlToImage'];
                                $content = $article['content'];
                                $date = $article['publishedAt'];
                                $author = $article['author'];

                                echo "
                                <a href=$url target='_blank' class='info' data-aos='flip-up' data-aos-duration='3500'>
                                <img src=$urlToImage alt='img'/>
                                <div class='card-info'>
                                <h3>Sport</h3>
                                <h2>$title</h2>
                                <p>$author</p>
                                </div>
                                </a>
                                ";

                                $counter++; // Increment the counter after echoing an item
                            }
                        } else {
                            echo "No articles found.";
                        }
                    }
                    curl_close($curl);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class='foot' data-aos='slide-up' data-aos-duration='3200'>
            <div class="left">
                <h1>Blackcoffer</h1>
                <p>Lorem ipsum dolor sitonsecteturadipisicing elit sed do eiusmod temporincididunt Laoreet non
                    sagittis aliquam bibendum.</p>
                <ul>
                    <li><i class="fa-brands fa-youtube"></i></li>
                    <li><i class="fa-brands fa-facebook-f"></i></li>
                    <li><i class="fa-brands fa-twitter"></i></li>
                    <li><i class="fa-brands fa-linkedin"></i></li>
                    <li><i class="fa-brands fa-instagram"></i></li>
                </ul>
            </div>
            <div class="rigth">
                <ul>
                    <h1>Menu</h1>
                    <li>What we think</li>
                    <li>Our success stories</li>
                    <li>About us</li>
                    <li>Contact</li>
                    <li>How it work</li>
                </ul>
            </div>
        </div>
        <p>Copyright © Blackcoffer| Designed by JohnMark </p>
    </footer>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
        AOS.refresh();
    </script>
</body>

</html>