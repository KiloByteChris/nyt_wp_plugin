// API Key: c64d0a52048b48ec8c6f20d3f4930160
var url = "https://api.nytimes.com/svc/topstories/v2/home.json";
// add the API key to the URL
url += '?' + jQuery.param({
  'api-key': "c64d0a52048b48ec8c6f20d3f4930160"
});
console.log("hello");
jQuery(document).ready(function(){
    // GET data from the API
    jQuery.ajax({
        url: url,
        method: 'GET',
    }).done(function(data) {
        var artSection = jQuery('.nytTopStoriesDiv');
        //Display the first 10 results
        console.log(data);
        for (i=0 ; i<10 ; i++) {
            // using moment.js, change the format of the date
            //var newDate = moment(data.results[i].created_date).format('YYYY MM DD');
            // Create the articles using the API data
            artSection.append('<article>' +
                '<img src='+ data.results[i].multimedia[0].url +' />' +
                '<h2><a href='+ data.results[i].url +'>'+ data.results[i].title +'</a></h2>' +
                '<h3 class="storySection">'+ data.results[i].section +'</h3>' +
                '<p class="abstract">'+ data.results[i].abstract +'</p>' +
                //'<h3 class="date">'+ newDate +'</h3>' +
                '<h3 class="byLine">'+ data.results[i].byline +'</h3>' +
                '</article');
        }
    }).fail(function(err) {
        throw err;
    });
}); // end document ready
