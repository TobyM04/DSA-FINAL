// Initialize the Leaflet map for Canterbury with interactions disabled
var mapCanterbury = L.map('mapCanterbury', {
    dragging: false,
    touchZoom: false,
    scrollWheelZoom: false,
    doubleClickZoom: false,
    zoomControl: false
}).setView([51.275, 1.087], 16); // Added default view in case there are no markers
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors',
    maxZoom: 20
}).addTo(mapCanterbury);

// Initialize the Leaflet map for Reims with interactions disabled
var mapReims = L.map('mapReims', {
    dragging: false,
    touchZoom: false,
    scrollWheelZoom: false,
    doubleClickZoom: false,
    zoomControl: false
}).setView([49.2620, 4.0347], 16); // Added default view in case there are no markers
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors',
    maxZoom: 20
}).addTo(mapReims);

// Arrays to hold the coordinates for each city's markers
var canterburyMarkers = [];
var reimsMarkers = [];

// Existing code for handling places of interest...
console.log(placeOfInterest);
placeOfInterest.forEach(function(place) {
    var popupContent = `
        <b>${place['Name']}</b><br>
        ${place['Description']}<br>
        <img src="${place['Photos']}" alt="${place['Name']}" style="width:100px;"><br>
        <a href="details.php?id=${place['PlaceID']}">View Details</a>
    `;

    var marker = L.marker([place['lat'], place['lng']]).addTo(place['CityID'] === '1' ? mapCanterbury : mapReims);
    
    marker.bindPopup(popupContent);

    // Show popup on mouseover
    marker.on('mouseover', function(e) {
        this.openPopup();
    });

    // Click event to redirect to details.php
    marker.on('click', function(e) {
        window.location.href = `details.php?id=${place['PlaceID']}&image=${place['Photos']}`;
    });

    // Add marker coordinates to the appropriate array, excluding Fort de la Pompelle for Reims
    if (place['CityID'] === '1') {
        canterburyMarkers.push(marker.getLatLng());
    } else if (place['CityID'] === '2' && place['PlaceID'] !== '18') {
        reimsMarkers.push(marker.getLatLng());
    }
});

// Adjust maps to show all markers
if (canterburyMarkers.length > 0) {
    var canterburyBounds = L.latLngBounds(canterburyMarkers);
    mapCanterbury.fitBounds(canterburyBounds);
}
if (reimsMarkers.length > 0) {
    var reimsBounds = L.latLngBounds(reimsMarkers);
    mapReims.fitBounds(reimsBounds, {
        padding: [50, 50] // Add some padding to ensure all markers are easily visible
    });
}

var apiKey = '50e6ff3f01073976f4dd6631106efb68'; // Your actual API key
var cities = ['Canterbury', 'Reims'];

cities.forEach(function(city) {
    var currentWeatherUrl = `https://api.openweathermap.org/data/2.5/weather?appid=${apiKey}&q=${city}&units=metric`;
    var forecastUrl = `https://api.openweathermap.org/data/2.5/forecast?appid=${apiKey}&q=${city}&units=metric`;

    fetch(currentWeatherUrl)
        .then(response => response.json())
        .then(currentData => {
            var weatherSection = document.getElementById(city.toLowerCase() + 'Weather');
            if (weatherSection) {
                var iconCode = currentData.weather[0].icon;
                var iconUrl = `https://openweathermap.org/img/wn/${iconCode}.png`;

                weatherSection.innerHTML = `<h3>Current Weather in ${city}</h3>
                                             <img src="${iconUrl}" alt="Weather icon">
                                             <p>Temperature: ${currentData.main.temp}°C</p>
                                             <p>Weather: ${currentData.weather[0].main}</p>
                                             <p>Description: ${currentData.weather[0].description}</p>`;
            }
        })
        .catch(error => console.error('Error fetching current weather data for ' + city + ':', error));

    fetch(forecastUrl)
        .then(response => response.json())
        .then(forecastData => {
            var weatherSection = document.getElementById(city.toLowerCase() + 'Weather');
            if (weatherSection) {
                var forecastHTML = `<h3>Forecast for the next three days in ${city}</h3>`;
                var dayForecasts = {};

                // Group forecasts by day
                forecastData.list.forEach(forecast => {
                    var forecastDate = new Date(forecast.dt * 1000);
                    var day = forecastDate.toLocaleDateString();
                    if (!dayForecasts[day]) {
                        dayForecasts[day] = [];
                    }
                    dayForecasts[day].push(forecast);
                });

                // Get the first 4 forecasts of each day (which should be 6-hour apart)
                for (let day in dayForecasts) {
                    var dailyForecasts = dayForecasts[day].slice(0, 4);
                    forecastHTML += `<h4>${day}</h4>`;
                    dailyForecasts.forEach(forecast => {
                        var forecastDate = new Date(forecast.dt * 1000);
                        var iconCode = forecast.weather[0].icon;
                        var iconUrl = `https://openweathermap.org/img/wn/${iconCode}.png`;
                        forecastHTML += `<div>
                                             <span>${forecastDate.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' })}</span>:
                                             <img src="${iconUrl}" alt="Forecast weather icon">
                                             <span>${forecast.main.temp}°C</span>,
                                             <span>${forecast.weather[0].main}</span>,
                                             <span>${forecast.weather[0].description}</span>
                                         </div>`;
                    });
                }

                weatherSection.innerHTML += forecastHTML;
            }
        })
        .catch(error => console.error('Error fetching forecast data for ' + city + ':', error));
});



function fetchAndDisplayTable(city, tableType) {
    // Determine the cityId based on the city parameter
    var cityId = city === 'canterbury' ? 1 : 2;
    
    // Use the Fetch API to make a request to the new PHP file
    fetch(`fetchpointsofinterest.php?cityId=${cityId}`)
        .then(response => response.json())
        .then(aggregatedData => {
            // The container where the table will be displayed
            var containerId = cityId === 1 ? "canterburyTableContainer" : "reimsTableContainer";
            var container = document.getElementById(containerId);
            container.innerHTML = ''; // Clear existing content

            // Check if the tableType exists in the aggregatedData
            if (aggregatedData[tableType]) {
                // Add the 'table' and 'table-dark' Bootstrap classes to the table
                let tableHTML = `<h3>${tableType.charAt(0).toUpperCase() + tableType.slice(1)}</h3><table class="table table-dark">`;
                
                // Loop through data for the selected table type
                aggregatedData[tableType].forEach(function(entry, index) {
                    // Add header row
                    if (index === 0) {
                        tableHTML += "<tr>";
                        for (var key in entry) {
                            tableHTML += `<th>${key}</th>`;
                        }
                        tableHTML += "</tr>";
                    }
                    // Add data rows
                   
                    let rowClass = ''; 
                    tableHTML += `<tr class="${rowClass}">`;
                    for (var key in entry) {
                        tableHTML += `<td>${entry[key]}</td>`;
                    }
                    tableHTML += "</tr>";
                });
                tableHTML += "</table>";
                container.innerHTML = tableHTML; 
            } else {
                container.innerHTML = `<p>No data available for ${tableType}.</p>`; // Display a message if no data is available
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}


function determineRowClass(entry, index) {
    
    const classes = ['bg-primary', 'bg-success', 'bg-warning', 'bg-danger', 'bg-info'];
    return classes[index % classes.length]; // This would cycle through the color classes
}

$(document).ready(function() {
    $('#submitCommentButton').click(submitComment);
    var defaultCityId = 1; // Canterbury's ID
    loadComments(defaultCityId);
});

// Function to submit a comment
// Function to submit a comment
function submitComment(cityId) {
    var userNameInputId = cityId === 1 ? 'userNameCanterbury' : 'userNameReims';
    var userCommentInputId = cityId === 1 ? 'userCommentCanterbury' : 'userCommentReims';
    var userName = $('#' + userNameInputId).val();
    var userComment = $('#' + userCommentInputId).val();

  
    $.ajax({
        url: 'submit_comments.php',
        type: 'POST',
        data: {
            userName: userName,
            comment: userComment,
            cityId: cityId  // Pass the cityId to the server
        },
        success: function(response) {
            // Log and clear the input fields if successful
            console.log('Comment submitted successfully for city ' + cityId);
            $('#' + userNameInputId).val('');
            $('#' + userCommentInputId).val('');
            // Reload comments for the correct city
            loadComments(cityId);
        },
        error: function(xhr, status, error) {
            console.error('Error submitting comment for city ' + cityId + ':', error);
        }
    });
}

// Function to load comments for a city, updated to target different display areas
function loadComments(cityId) {
    var commentsDisplayId = cityId === 1 ? 'canterburyCommentsDisplay' : 'reimsCommentsDisplay';
    
    // Adjust the AJAX request URL and data accordingly
    $.ajax({
        url: 'fetch_comments.php',
        type: 'GET',
        data: { cityId: cityId },  // Fetch comments based on cityId
        dataType: 'json',
        success: function(comments) {
            var commentsHtml = '';
            // Create comment HTML blocks and append to the respective display area
            comments.forEach(function(comment) {
                commentsHtml += '<div class="comment"><strong>' + comment.username + ':</strong> ' + comment.comment + '</div>';
            });
            $('#' + commentsDisplayId).html(commentsHtml);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching comments for city ' + cityId + ':', error);
        }
    });
}

// New function to handle comment searching
function searchComments(cityId) {
    var searchInputId = cityId === 1 ? 'searchCommentsInputCanterbury' : 'searchCommentsInputReims';
    var searchTerm = $('#' + searchInputId).val(); // Get the search term

    if (searchTerm.trim() !== '') {
        $.ajax({
            url: 'search_comments.php',
            type: 'GET',
            data: {
                cityId: cityId,  // Pass the cityId to the server
                search: searchTerm  // Pass the search term to the server
            },
            dataType: 'json',
            success: function(comments) {
                var commentsDisplayId = cityId === 1 ? 'canterburyCommentsDisplay' : 'reimsCommentsDisplay';
                var commentsHtml = '<h3>Search Results</h3>';
                comments.forEach(function(comment) {
                    // Only add the comment to the HTML if the cityId matches
                    if (parseInt(comment.cityId) === cityId) {
                        commentsHtml += '<div class="comment"><strong>' + comment.username + ':</strong> ' + comment.commentText + '</div>';
                    }
                });
                $('#' + commentsDisplayId).html(commentsHtml);
            },
            error: function(xhr, status, error) {
                console.error('Error searching comments for city ' + cityId + ':', error);
            }
        });
    }
}

// New function: loadComments with sortOrder


function loadComments(cityId, sortOrder = 'newest') {
    var commentsDisplayId = cityId === 1 ? 'canterburyCommentsDisplay' : 'reimsCommentsDisplay';
    $.ajax({
        url: 'fetch_comments.php',
        type: 'GET',
        data: {
            cityId: cityId,
            sortOrder: sortOrder  // Pass the sort order to the server
        },
        dataType: 'json',
        success: function(comments) {
            var commentsHtml = '';
            comments.forEach(function(comment) {
                // Format the date
                var date = new Date(comment.posted_at);
                var formattedDate = date.toLocaleDateString('en-US', {
                    year: 'numeric', month: 'long', day: 'numeric',
                    hour: '2-digit', minute: '2-digit', second: '2-digit'
                });
                commentsHtml += '<div class="comment"><strong>' + comment.username + ':</strong> ' + 
                                comment.comment + ' <span class="comment-date">(' + formattedDate + ')</span></div>';
            });
            $('#' + commentsDisplayId).html(commentsHtml);
        },
        error: function(xhr, status, error) {
            console.error('Error loading comments for city ' + cityId + ':', error);
        }
    });
}

$(document).ready(function() {
    // Initialize comments for both cities
    loadComments(1); // Load comments for Canterbury
    loadComments(2); // Load comments for Reims

    // Event listeners for sort order change
    $('#sortOrderCanterbury').change(function() {
        loadComments(1, $(this).val());
    });

    $('#sortOrderReims').change(function() {
        loadComments(2, $(this).val());
    });

    // Event listeners for search on enter keypress
    $('#searchCommentsInputCanterbury').keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            searchComments(1); // Perform search for Canterbury
        }
    });

    $('#searchCommentsInputReims').keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            searchComments(2); // Perform search for Reims
        }
    });
});



