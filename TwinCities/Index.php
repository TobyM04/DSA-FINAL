<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Twin Cities Exploration</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
              background-color: #000; /* Fallback solid color */
              background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url('IndexBackground.png');
              background-size: cover;
              background-attachment: fixed;
              color: #fff;
            }        
        h1 {
            text-align: center;
            color: #fff; /* Changed to white */
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.6); /* Changed to darker background */
            margin-bottom: 20px;
        }
        .fixed-title-box {
    position: fixed; /* Stay in place on scroll */
    top: 60px; /* Below the main header; adjust as needed */
    z-index: 999; /* Ensure it's on top of other elements */
    background-color: rgba(51, 51, 51, 0.8); /* Semi-transparent dark background */
    color: #ffffff; /* White text color for contrast and legibility */
    padding: 12px 0; /* Top and bottom padding */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); /* Refined shadow for depth */
    overflow: hidden; /* Prevents text spillover */
    width: calc(50% - 50px); /* Adjust the width for each box, with a gap in the middle */
    font-size: 18px; /* Increased font size for better readability */
    font-weight: 500; /* Medium font weight for legibility */
    text-shadow: 1px 1px 2px black; /* Text shadow for better readability on varied backgrounds */
    border: 1px solid #444; /* Subtle border to define the edges of the title boxes */
}

#titleBoxCanterbury {
    left: 0; /* Align to the left */
    text-align: center; /* Center the text inside the box */
    border-right: 1px solid #444; /* Border to separate the two boxes */
}

#titleBoxReims {
    right: 0; /* Align to the right */
    text-align: center; /* Center the text inside the box */
    border-left: 1px solid #444; /* Border to separate the two boxes */
}

/* You may need to add some padding to the top of the body to ensure content does not hide behind the fixed titles */
        body {
            padding-top: 120px; /* Height of your fixed headers */
        }       
        .map-container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }
        #mapCanterbury, #mapReims {
            height: 400px;
            flex: 1;
            margin: 5px;
            border: 1px solid #444; /* Darker border */
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1); /* Lighter shadow */
        }
        #weatherContainer {
            display: flex;
            justify-content: space-between;
            margin: 20px;
        }
        .weatherSection {
            flex: 1;
            margin: 5px;
            padding: 20px;
            background-color: #222; /* Darker background */
            color: #fff; /* Added white text color */
            border: 1px solid #444; /* Darker border */
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1); /* Lighter shadow */
        }
        .comment-box {
            background-color: #222; /* Darker background */
            color: #fff; /* Added white text color */
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #444; /* Darker border */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1); /* Lighter shadow */
        }
        .comment-list {
            max-height: 400px;
            overflow-y: auto;
            margin-top: 20px;
        }
        .table-container {
            margin-top: 20px;
        }
        .table-responsive {
            background-color: #222; /* Darker background */
            color: #fff; /* Added white text color */
            border: 1px solid #444; /* Darker border */
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1); /* Lighter shadow */
            border-radius: 5px;
            overflow-x: auto;
        }
        .table {
            margin-bottom: 0;
        }
   
        .pointsOfInterestContainer {
            display: flex;
            margin: 20px;
        }
        .pointsOfInterestSection {
            margin: 5px;
            padding: 20px;
            background-color: #222; /* Darker background */
            color: #fff; /* Added white text color */
            border: 1px solid #444; /* Darker border */
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1); /* Lighter shadow */
        }
        #canterburyTable-searchInput::placeholder {
        color: #fff; 
        }
        #reimsTable-searchInput::placeholder {
        color: #fff; 
        }
        .comment-box input::placeholder,
        .comment-box textarea::placeholder {
        color: #fff; 
        }
        .home-button {
    position: fixed; 
    bottom: 20px; /* 20px from the bottom */
    left: 20px; /* 20px from the left */
    z-index: 1000; 
}
        
   
    </style>
</head>
<body>
    <!-- Navbar starts here -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <!-- Navbar Header -->
            <div class="navbar-header">
                <a class="navbar-brand" href="mainpage.php">Twin Cities Exploration</a>
            </div>
            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="mainpage.php">Home</a></li>
                    <li><a href="index.php">Twin Cities</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Canterbury <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="details.php?id=1">Canterbury Cathedral</a></li>
                            <li><a href="details.php?id=2">Abbey of St Augustine</a></li>
                            <li><a href="details.php?id=13">St. Martin's Church</a></li>
                            <li><a href="details.php?id=14">Canterbury Roman Museum</a></li>
                            <li><a href="details.php?id=15">Westgate Gardens</a></li>
                            <li><a href="details.php?id=16">The Beaney House of Art & Knowledge</a></li>
                            <!-- More Canterbury places of interest -->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Reims <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="details.php?id=3">Maison Ruinart</a></li>
                            <li><a href="details.php?id=4">Reims Cathedral</a></li>
                            <li><a href="details.php?id=17">Palais du Tau</a></li>
                            <li><a href="details.php?id=18">Fort de la Pompelle</a></li>
                            <li><a href="details.php?id=19">Place Royale</a></li>
                            <li><a href="details.php?id=20">Parc de Champagne</a></li>
                            <!-- More Reims places of interest -->
                        </ul>
                    </li>
                    <!-- RSS Feed Link -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            RSS Feed <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="http://localhost/TwinCitiesUpdated16/rss_feed.php">RSS Feed</a></li>
                            <li><a href="http://localhost/TwinCitiesUpdated16/twincitiesfinal2.html">Update Details</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <h1>Welcome to Canterbury and Reims Twin Cities Info!</h1>

    <div class="fixed-title-box" id="titleBoxCanterbury">Canterbury</div>
    <div class="fixed-title-box" id="titleBoxReims">Reims</div>

    

    <!-- Map Container -->
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-6">
                <div id="mapCanterbury" class="map-container">
                    <!-- Map initialization for Canterbury -->
                </div>
            </div>
            <div class="col-md-6">
                <div id="mapReims" class="map-container">
                    <!-- Map initialization for Reims -->
                </div>
            </div>
        </div>
    </div>

    <!-- Weather Container -->
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-6">
                <div id="canterburyWeather" class="weatherSection">
                    <!-- Weather information for Canterbury -->
                </div>
            </div>
            <div class="col-md-6">
                <div id="reimsWeather" class="weatherSection">
                    <!-- Weather information for Reims -->
                </div>
            </div>
        </div>
    </div>

    <!-- Points of Interest Section -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-6">
                <div id="canterburyPointsOfInterest" class="pointsOfInterestSection">
                    <h2>Canterbury's Points of Interest</h2>
                    <select style="background-color: #333; color: #fff;" id="canterburyTableSelect" onchange="fetchAndDisplayTable('canterbury', this.value)" class="form-select mb-3">
                        <option value="">Select Table</option>
                        <option value="city">City</option>
                        <option value="economy">Economy</option>
                        <option value="transportation">Transportation</option>
                        <option value="culturalevent">Cultural Events</option>
                    </select>
                    <input type="text" style="background-color: #333; color: #fff;::placeholder {color: #fff;}" id="canterburyTable-searchInput" class="form-control mb-3" placeholder="Search for names...">
                    <div id="canterburyTableContainer" class="table-responsive">
                        <!-- Dynamic table content is loaded here by the 'fetchAndDisplayTable' function -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div id="reimsPointsOfInterest" class="pointsOfInterestSection">
                    <h2>Reims' Points of Interest</h2>
                    <select style="background-color: #333; color: #fff;" id="reimsTableSelect" onchange="fetchAndDisplayTable('reims', this.value)" class="form-select mb-3">
                        <option value="">Select Table</option>
                        <option value="city">City</option>
                        <option value="economy">Economy</option>
                        <option value="transportation">Transportation</option>
                        <option value="culturalevent">Cultural Events</option>
                    </select>
                    <input type="text" style="background-color: #333; color: #fff;" id="reimsTable-searchInput" class="form-control mb-3" placeholder="Search for names...">
                    <div id="reimsTableContainer" class="table-responsive">
                        <!-- Dynamic table content is loaded here by the 'fetchAndDisplayTable' function -->
                    </div>
                </div>
            </div>
        </div>
    </div>


        
        <?php
        // Load the XML file
        $xml = simplexml_load_file('twincities.xml');
        $places = array();
        
        // Assumes that 'placeofinterest' is a child of the 'database' element
        foreach ($xml->database->table as $table) {
            if ($table['name'] == 'placeofinterest') {
                $place = array();
                foreach ($table as $row) {
                    if ($row['name'] == 'GeoLocation') {
                        list($lat, $lng) = explode(',', (string)$row);
                        $place['lat'] = trim($lat);
                        $place['lng'] = trim($lng);
                    } else {
                        $place[(string)$row['name']] = (string)$row;
                    }
                }
                $places[] = $place;
            }
        }
        ?>
        <script>
            var placeOfInterest = <?php echo json_encode($places); ?>;
            
        </script>
    </div>
    <div class="container mt-4">
    <!-- Canterbury Comments Section -->
    <div class="row">
        <div class="col-lg-6">
            <div class="comment-box" style="background-color: #333; color: #fff;" id="canterburyComments">
                <h2>Canterbury Comments</h2>
                <!-- Search bar for Canterbury comments -->
                <div class="search-container mb-3">
                    <input type="text" style="background-color: #333; color: #fff;" id="searchCommentsInputCanterbury" placeholder="Search Canterbury comments..." class="form-control mb-2">
                    <button style="background-color: #017bff; color: #fff;" onclick="searchComments(1)" class="btn btn-secondary" style="background-color: #555;">Search</button> <!-- Search for Canterbury with cityId 1 -->
                </div>
                <!-- Canterbury Filter Section -->
                <div class="sort-controls">
                    <label for="sortOrderCanterbury">Sort by:</label>
                    <select style="background-color: #333; color: #fff;" id="sortOrderCanterbury" class="sort-order">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                    </select>
                </div>
                <!-- Canterbury comment form -->
                <form id="canterburyCommentsForm" class="mb-3">
                    <input type="text" style="background-color: #333; color: #fff;" id="userNameCanterbury" placeholder="Name" class="form-control mb-2">
                    <textarea style="background-color: #333; color: #fff;" id="userCommentCanterbury" placeholder="Comment" class="form-control mb-2"></textarea>
                    <button style="background-color: #017bff; color: #fff;" type="button" class="btn btn-primary" onclick="submitComment(1)">Submit Comment</button>
                </form>
                <!-- Canterbury comments list -->
                <div class="comment-list" style="background-color: #333; color: #fff;" id="canterburyCommentsDisplay">
                    <h3>Recent Comments</h3>
                    <!-- Dynamic comments for Canterbury will be injected here -->
                </div>
            </div>
        </div>
        
        <!-- Reims Comments Section -->
        <div class="col-lg-6">
            <div class="comment-box" style="background-color: #333; color: #fff;" id="reimsComments">
                <h2>Reims Comments</h2>
                <!-- Search bar for Reims comments -->
                <div class="search-container mb-3">
                    <input type="text" style="background-color: #333; color: #fff;" id="searchCommentsInputReims" placeholder="Search Reims comments..." class="form-control mb-2">
                    <button style="background-color: #017bff; color: #fff;" onclick="searchComments(2)" class="btn btn-secondary" style="background-color: #555;">Search</button> <!-- Search for Reims with cityId 2 -->
                </div>
                <!-- Inside the Reims Comments Section -->
                <div class="sort-controls">
                    <label for="sortOrderReims">Sort by:</label>
                    <select style="background-color: #333; color: #fff;" id="sortOrderReims" class="sort-order">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                    </select>
                </div>
                <!-- Reims comment form -->
                <form id="reimsCommentsForm" class="mb-3">
                    <input type="text" style="background-color: #333; color: #fff;" id="userNameReims" placeholder="Name" class="form-control mb-2">
                    <textarea style="background-color: #333; color: #fff;" id="userCommentReims" placeholder="Comment" class="form-control mb-2"></textarea>
                    <button style="background-color: #017bff; color: #fff;" type="button" class="btn btn-primary" onclick="submitComment(2)">Submit Comment</button>
                </form>
                <!-- Reims comments list -->
                <div class="comment-list" style="background-color: #333; color: #fff;" id="reimsCommentsDisplay">
                    <h3>Recent Comments</h3>
                    <!-- Dynamic comments for Reims will be injected here -->
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="script.js"></script>
    <div class="container mt-4">
    <div class="comment-box" style="background-color: #333; color: #fff;" id="rssFeedSection">
        <h2>RSS Feed</h2>
        <p>Stay updated with the latest posts by subscribing to our RSS feed.</p>
        <a href="rss_feed.php">Subscribe to RSS Feed</a>
        <a href="twincitiesfinal2.html" class="btn btn-secondary" style="background-color: #555;">Twin Cities Update</a>
    </div>
    <a href="mainpage.php" class="btn btn-danger home-button">Home</a>
</body>
</html>





                                                
