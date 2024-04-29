<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main Page - Twin Cities Exploration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('mainpagefinal.jpg'); /* Adjust the path if necessary */
            background-color: #333; /* Dark background for transparency */
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            color: #fff;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            /* Adding an overlay */
            position: relative;
        }
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7); /* Dark overlay to maintain text legibility */
            z-index: -1; /* Ensures the overlay is behind the content */
        }
        .text-container {
            background-image: url('mainpagebackground.jpg'); 
            background-color: rgba(0, 0, 0, 0.7); /* Dark semi-transparent overlay */
            background-size: cover;
            background-blend-mode: darken; /* Blends the image with the background color */
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 40px;
        }
        .text-container h1 {
            text-align: center; /* Centers the title */
            margin-bottom: 20px; /* Space after the title */
        }
        .lead-caption {
            font-size: 18px; /* Good readability size */
            margin-bottom: 20px;
            line-height: 1.6; /* Optimal line height for reading */
            text-align: justify; /* Optional: if you want justified text */
        }
        .image-container {
            position: relative;
            text-align: center;
            margin-bottom: 40px;
        }
        .image-container img {
            width: 100%;
            height: auto;
            border: 3px solid #fff;
            margin-bottom: 10px;
        }
        .click-me {
            display: block;
            background-color: #ff0000;
            color: #fff;
            text-align: center;
            padding: 10px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            margin-top: -30px;
            position: relative;
            z-index: 10;
        }
        .image-description {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            background: rgba(0, 0, 0, 0.7);
            padding: 10px;
            box-sizing: border-box;
        }
        .image-description p {
            margin: 0;
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
                            <li><a href="http://localhost/TwinCitiesUpdated17/rss_feed.php">RSS Feed</a></li>
                            <li><a href="http://localhost/TwinCitiesUpdated17/twincitiesfinal2.html">Update Details</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page content -->
    <div class="container" style="padding-top: 70px;"> 
        <div class="text-container">
            <h1>Welcome to the Twin Cities Exploration</h1>
        <p class="lead-caption">Welcome to the epitome of historical elegance and cultural richness! At Canterbury and Reims, we invite you on an unforgettable journey through time, where the echoes of centuries past intertwine with the vibrant spirit of the present. Step into a world where medieval marvels meet modern marvels, where ancient traditions blend seamlessly with contemporary innovations.</p>

        <p class="lead-caption">Nestled in the heart of Europe, Canterbury and Reims stand as guardians of heritage, offering a glimpse into the tapestry of human history. Each city, with its own unique charm and allure, beckons travelers to immerse themselves in its treasures, to walk the cobblestone streets that have borne witness to the unfolding drama of centuries gone by.</p>

        <p class="lead-caption">In Canterbury, the air is redolent with the scent of literary greatness, as the city proudly bears the legacy of Geoffrey Chaucer's immortal Canterbury Tales. Here, the majestic Canterbury Cathedral rises as a testament to faith and architectural brilliance, its soaring spires reaching towards the heavens. Lose yourself in the labyrinthine alleys of the Old Town, where every corner whispers secrets of a bygone era, or stroll along the tranquil banks of the River Stour, where the past and present converge in perfect harmony.</p>

        <p class="lead-caption">Meanwhile, in Reims, history comes alive amidst the awe-inspiring splendor of its UNESCO World Heritage sites. The grandeur of Reims Cathedral, where French kings were once crowned, leaves visitors spellbound with its exquisite Gothic architecture and timeless beauty. Wander through the charming streets of the city center, where quaint cafes and bustling markets offer a taste of authentic French culture. And of course, no visit to Reims would be complete without indulging in the region's world-renowned champagne, crafted with centuries of expertise and passion.</p>

        <p class="lead-caption">But beyond their rich historical legacies, Canterbury and Reims are also vibrant hubs of contemporary culture and innovation. From bustling arts scenes to thriving culinary landscapes, these cities offer a dynamic blend of tradition and modernity, inviting visitors to explore, discover, and be inspired. As you embark on your virtual journey through Canterbury and Reims via our website, we invite you to uncover the hidden gems, to delve into the stories that have shaped these remarkable destinations, and to experience the magic that awaits around every corner.</p>

        <p class="lead-caption">Whether you're planning your next adventure or simply seeking a moment of virtual escape, let Canterbury and Reims ignite your imagination and leave an indelible mark on your soul. Welcome to Canterbury and Reims – where history meets modernity, and every moment is an unforgettable adventure.</p>
    </div>

<!-- Navigation Link -->
<div style="text-align: center; margin-top: 10px;">
    <a href="index.php" class="click-me">Click here for information about Canterbury and Reims</a>
</div>

    
    <div id="flickr-images">
        <!-- Image 1 -->
        <div class="image-container">
            <div class="image-description">
                <p>Westgate Gardens</p>
                <p>The historic Westgate Gardens, a lush portal into the bygone era of Canterbury, are a serene retreat that runs alongside the gently flowing River Stour. Here, swans glide gracefully beneath the shadow of the ancient Westgate Towers, Britain's largest surviving medieval gateway, offering a picturesque backdrop that speaks to the city's storied past.</p>
            </div>
            <a href="details.php?id=15">
                <img src="https://live.staticflickr.com/65535/53582013718_b7fdf994d9_b.jpg" alt="Westgate Gardens">
                <span class="click-me">Click me!</span>
            </a>
        </div>

        <!-- Image 2 -->
        <div class="image-container">
            <div class="image-description">
                <p>The Beaney House of Art & Knowledge</p>
                <p>Standing proudly in the heart of Canterbury is The Beaney House of Art & Knowledge, an amalgamation of culture and history. This beautifully restored Tudor building serves not just as a repository of art but as a vibrant cultural hub, housing collections that tell tales of human creativity and the city's multifaceted heritage.</p>
            </div>
            <a href="details.php?id=16">
                <img src="https://live.staticflickr.com/65535/53582111524_07e73b2262_b.jpg" alt="The Beaney House of Art & Knowledge">
                <span class="click-me">Click me!</span>
            </a>
        </div>

        <!-- Image 3 -->
        <div class="image-container">
            <div class="image-description">
                <p>St. Martin's Church</p>
                <p>St. Martin's Church, enveloped in the quietude of its surroundings, bears the honor of being the oldest church in the English-speaking world still in use. Its austere Romanesque architecture speaks of its foundation by Queen Bertha of Kent, predating the Augustine mission to Canterbury. Its walls whisper the chronicles of early Christianity in England.</p>
            </div>
            <a href="details.php?id=13">
                <img src="https://live.staticflickr.com/65535/53581788156_9ca00c85e1_b.jpg" alt="St. Martin's Church">
                <span class="click-me">Click me!</span>
            </a>
        </div>

        <!-- Image 4 -->
        <div class="image-container">
            <div class="image-description">
                <p>Reims Cathedral</p>
                <p>The Reims Cathedral, a masterpiece of French Gothic art, stands as a testament to the spiritual and political heritage of Reims. With its spires reaching towards the heavens, this cathedral has been the coronation site for French kings, embedding itself in the fabric of French monarchical history.</p>
            </div>
            <a href="details.php?id=4">
                <img src="https://live.staticflickr.com/65535/53582232930_415353dc0f_z.jpg" alt="Reims Cathedral">
                <span class="click-me">Click me!</span>
            </a>
        </div>

        <!-- Image 5 -->
        <div class="image-container">
            <div class="image-description">
                <p>Place Royale</p>
                <p>Place Royale is a stately square in Reims that captures the grandeur of French urban design. Surrounded by classical architecture, the square's open space and symmetry offer a respite from the bustling city, inviting passersby to pause and reflect on the elegance of the urban landscape.</p>
            </div>
            <a href="details.php?id=19">
                <img src="https://live.staticflickr.com/65535/53582232955_e1688aee51_z.jpg" alt="Place Royale">
                <span class="click-me">Click me!</span>
            </a>
        </div>

        <!-- Image 6 -->
<div class="image-container">
    <div class="image-description">
        <p>Parc de Champagne</p>
        <p>Parc de Champagne, a verdant expanse in Reims, presents an inviting landscape of sprawling lawns dotted with ancient trees. As visitors meander through its tranquil paths, the park narrates a history intertwined with the luxurious world of Champagne production.</p>
    </div>
    <a href="details.php?id=20">
        <img src="https://live.staticflickr.com/65535/53581788176_c6c4f72a9d_z.jpg" alt="Parc de Champagne">
        <span class="click-me">Click me!</span>
    </a>
</div>

<!-- Image 7 -->
<div class="image-container">
    <div class="image-description">
        <p>Palais du Tau</p>
        <p>Adjacent to Reims Cathedral lies the Palais du Tau, once the palace of the archbishop and a UNESCO World Heritage Site. This grand edifice, with its rich tapestries and ornate chambers, serves as a witness to the regal coronations that once graced its halls.</p>
    </div>
    <a href="details.php?id=17">
        <img src="https://live.staticflickr.com/65535/53582232960_d6d9503648_z.jpg" alt="Palais du Tau">
        <span class="click-me">Click me!</span>
    </a>
</div>

<!-- Image 8 -->
<div class="image-container">
    <div class="image-description">
        <p>Maison Ruinart</p>
        <p>Nestled in the heart of Reims is Maison Ruinart, the oldest established Champagne house, renowned for its chalk cellars and exquisite vintages. Each bottle from Ruinart is a story of refinement, echoing the essence of Reims' contribution to the world of wine.</p>
    </div>
    <a href="details.php?id=3">
        <img src="https://live.staticflickr.com/65535/53582111544_0ca0d24bbf_z.jpg" alt="Maison Ruinart">
        <span class="click-me">Click me!</span>
    </a>
</div>

<!-- Image 9 -->
<div class="image-container">
    <div class="image-description">
        <p>Fort de la Pompelle</p>
        <p>The Fort de la Pompelle tells a tale of bravery and resilience. This fortification near Reims stood valiantly during the Great War, protecting the city from invaders and serving as a silent guardian of the region's historical landscape.</p>
    </div>
    <a href="details.php?id=18">
        <img src="https://live.staticflickr.com/65535/53581788221_b3fa3c460c_z.jpg" alt="Fort de la Pompelle">
        <span class="click-me">Click me!</span>
    </a>
</div>

<!-- Image 10 -->
<div class="image-container">
    <div class="image-description">
        <p>Canterbury Roman Museum</p>
        <p>Deep beneath the cobbled streets of Canterbury lies the Canterbury Roman Museum, a fascinating archaeological site. Preserving the remains of a Roman townhouse, the museum's artifacts and interactive displays transport you back two millennia, offering a window into the daily lives of Roman Britons.</p>
    </div>
    <a href="details.php?id=14">
        <img src="https://live.staticflickr.com/65535/53582111554_50687dab2e_z.jpg" alt="Canterbury Roman Museum">
        <span class="click-me">Click me!</span>
    </a>
</div>

<!-- Image 11 -->
<div class="image-container">
    <div class="image-description">
        <p>Canterbury Cathedral</p>
        <p>Canterbury Cathedral, a beacon of Christianity, rises majestically above the skyline. This Gothic cathedral, a UNESCO World Heritage Site, is not only an architectural wonder but also a pilgrimage destination, resonating with the tales of saints, archbishops, and the transformative history of the English church.</p>
    </div>
    <a href="details.php?id=1">
        <img src="https://live.staticflickr.com/65535/53580923197_74270454e2_z.jpg" alt="Canterbury Cathedral">
        <span class="click-me">Click me!</span>
    </a>
</div>

<!-- Image 12 -->
<div class="image-container">
    <div class="image-description">
        <p>Abbey of St Augustine</p>
        <p>The Abbey of St Augustine stands as a solemn reminder of the early Christian roots of Canterbury. Though in ruins, the abbey's presence is potent; it embodies the monastic life that flourished here, laying the foundation for Canterbury's ecclesiastical prominence.</p>
    </div>
    <a href="details.php?id=2">
        <img src="https://live.staticflickr.com/65535/53582013768_1fa2d918e2_z.jpg" alt="Abbey of St Augustine">
        <span class="click-me">Click me!</span>
    </a>
</div>
</div>

<script src="//embedr.flickr.com/assets/client-code.js" charset="utf-8"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>






