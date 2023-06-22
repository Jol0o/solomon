<?php
// get the search value and api key for the api and the url
$inputValue = $_POST['search'];
$apiKey = '94feb605ac4747f085828ff72ff2af04';
$url = "https://newsapi.org/v2/top-headlines?q=$inputValue&language=en&apiKey=$apiKey";

//this will fetch the data from the url
$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_USERAGENT, 'news');

// here is the response 
$response = curl_exec($curl);
//check if the response is not null or falsy value
if ($response === false) {
    $error = curl_error($curl);
    // Handle the error appropriately
} else {
    // assigned the json in the data variable
    $data = json_decode($response, true);
    // get the data articles and assigned it with articles variable
    $articles = $data['articles'];
    // checking if articles variable is not empty
    if (!empty($articles)) {
        // then loop the articles to get its data
        foreach ($articles as $article) {
            $title = $article['title'];
            $description = $article['description'];
            $url = $article['url'];
            $urlToImage = $article['urlToImage'];
            $content = $article['content'];
            $date = $article['publishedAt'];
            $author = $article['author'];
            $img = ($urlToImage === null) ? 'https://images.pexels.com/photos/1577882/pexels-photo-1577882.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1' : $urlToImage;
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
    <link rel="stylesheet" href="style/search.css">
    <title>Search</title>
</head>

<body>

    <div class="navbar">
        <form method="POST">
            <input type="search" name="search" id="search">
            <button type="submit" name="submit">Search</button>
        </form>
    </div>

    <div class='container'>
        <div class='search-container'>
            <?php
            // loop the data to render it in the page
            foreach ($articles as $article) {
                $title = $article['title'];
                $description = $article['description'];
                $url = $article['url'];
                $urlToImage = $article['urlToImage'];
                $content = $article['content'];
                $author = $article['author'];
                $date = $article['publishedAt'];
                $img = ($urlToImage === null) ? 'https://images.pexels.com/photos/1577882/pexels-photo-1577882.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1' : $urlToImage;
                // Output the article within the right-card component
                echo "
            <a href=$url target='_blank' class='wraper'>  
            <img src=$img alt='news'/>
            <span>
                <h2>$title</h2>
                <h3>$description</h3>
                <p>by : $author</p>
            </span>
            </a>";
            }
            ?>
        </div>
        <div class='btn'>
            <a href="index.php">
                Back
            </a>
        </div>

    </div>
</body>

</html>