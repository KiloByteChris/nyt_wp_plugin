// API Key: c64d0a52048b48ec8c6f20d3f4930160
var url = "https://api.nytimes.com/svc/topstories/v2/home.json";
// add the API key to the URL
url += '?' + jQuery.param({
  'api-key': "c64d0a52048b48ec8c6f20d3f4930160"
});
jQuery(document).ready(function(){
    // GET data from the API
    jQuery.ajax({
        url: url,
        method: 'GET',
    }).done(function(data) {
        // select the div where the infomrtion will be displayed
        var artSection = jQuery('.nytTopStoriesDiv');
        console.log(data);
        /*
            Function takes the nyt data and builds a string to display the infromation
        */
        function displayNYTData(i, data) {
            var displayString = "<article>";
            // using moment.js, change the format of the date
            //var newDate = moment(data.results[i].created_date).format('YYYY MM DD');
            // Check for an image
            if(typeof data.results[i].multimedia[0] !== 'undefined') {
                displayString += "<img src="+ data.results[i].multimedia[0].url +" />";
            }else{
                displayString += "<img src='' />";
            }
            displayString += "<h2><a href="+ data.results[i].url +">"+data.results[i].title +" </a></h2>";
            displayString += "<h3 class='storySection'>"+ data.results[i].section +"</h3>";
            displayString += "<p class='abstract'>"+ data.results[i].abstract +"</p>";
            //displayString += "<h3 class='date'>"+ newDate +"</h3>";
            displayString += "<h3 class='byLine'>"+ data.results[i].byline +"</h3>";
            displayString += "</article>";
            artSection.append(displayString);
        }
        for (var i=0 ; i<10 ; i++) {
            displayNYTData(i, data);
        }
    }).fail(function(err) {
        throw err;
    });
}); // end document ready
