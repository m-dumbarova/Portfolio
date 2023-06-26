

///////////////////////////////////// ARRAY WITH ALL FOUND MOVIES ////////////////////////////////////////
let found_movies = [];


///////////////////////////////////// FETCH ALL PAGES ////////////////////////////////////////
function searchByTitle() 
{
    cleanFoundMovies();

    var inputMovieTitle = document.getElementById("movie_title").value;
    //console.log("search = ", inputMovieTitle);
    fetch("http://www.omdbapi.com/?apikey=30308e7b&s=" + inputMovieTitle)
        .then((response) => {
                                if(response.ok)
                                {
                                    return response.json();
                                }
                                else
                                {
                                    throw new Error("NETWORK RESPONSE ERROR");
                                }
                            }
                )     
        .then(data => {                    
                           // console.log("movie_info", data);
                            listAllPages(data);
                        }
                )
        .catch((error)=>{ console.log(error) });

    updateMovieInfo();
    
}	
	
	
function listAllPages(search_result) 
    {
		console.log("listAllPages= ", search_result["totalResults"]);
		
		var title = document.getElementById("movie_title").value;
		for (var page = 1; page <= parseInt(search_result["totalResults"])/10 + 1; page++ )
		{
			//console.log("searchPage= ", page);
			fetch("http://www.omdbapi.com/?apikey=30308e7b&s=" + title + "&page="+page)
			.then((response) => {
									if(response.ok)
									{
										return response.json();
									}
									else
									{
										throw new Error("NETWORK RESPONSE ERROR");
									}
								}
				  )     
			.then(data => {                    
							  //console.log("listAllPages", data);

							  displayMovies(data);

                              //console.log("listAllPages ", found_movies);
						  }
				 )
			.catch((error)=>{ console.log(error) });
		}
    }  



function displayMovies(movie_list) // Add all movies on the current page
    {
		//console.log("displayMovies= ", movie_list["Search"]);
		var  movie_count = document.getElementById("found_movies");
		movie_count.innerHTML = 0;
        var  movie_count_info = document.getElementById("found_movies_info");
		movie_count_info.innerHTML = movie_count.innerHTML + " results found";

		for (let id in movie_list["Search"])
		{
			let movie = movie_list["Search"][id];
			//console.log("movie = ", movie);

			fetch("http://www.omdbapi.com/?apikey=30308e7b&i=" + movie["imdbID"] )
			.then((response) => {
									if(response.ok)
									{
										return response.json();
									}
									else
									{
										throw new Error("NETWORK RESPONSE ERROR");
									}
								}
				  )     
			.then(data => {                    
							 // console.log("displayMovies", data);
							  displayMovieInfo(data);
                             // console.log("displayMovies ", found_movies);
						  }
				 )
			.catch((error)=>{ console.log(error) });
		}
    }  





function displayMovieInfo(movie_data)  // Result found counter update and fill in the array
{
	//console.log("movie_list= ", movie_data);
	var  movie_count = document.getElementById("found_movies");
	movie_count.innerHTML = parseInt(movie_count.textContent) + 1;

    var  movie_count_info = document.getElementById("found_movies_info");
    movie_count_info.innerHTML = movie_count.innerHTML + " results found";
    
   // console.log("movie_list ", found_movies.length);
    found_movies[found_movies.length] = movie_data;  

}

///////////////////////////////////// NEXT MOVIE ////////////////////////////////////////

function showNextMovie(){
    let id_found_movies = document.getElementById("id-found-movies");

    const max_movies = parseInt(document.getElementById("found_movies").innerHTML);
    let id_found_movies_value = parseInt(id_found_movies.innerHTML);

    if (id_found_movies_value < max_movies){
        id_found_movies_value += 1;
       // console.log("showNextMovie = ",id_found_movies_value);
        id_found_movies.innerHTML = id_found_movies_value;
    
        updateMovieInfo();
    }
    else{
        console.log("showNextMovie: Last movie reached");
    }
    
}

///////////////////////////////////// PREVIOUS MOVIE ////////////////////////////////////////

function showPreviousMovie(){
    let id_found_movies = document.getElementById("id-found-movies");
    let id_found_movies_value = parseInt(id_found_movies.innerHTML);

    if (id_found_movies_value > 1){
        id_found_movies_value -= 1;
       // console.log("showPreviousMovie = ",id_found_movies_value);
        id_found_movies.innerHTML = id_found_movies_value;

        updateMovieInfo();
    }
    else{
        console.log("showPreviousMovie: first movie reached");
    } 
}

///////////////////////////////////// DISPLAY MOVIES IN HTML ////////////////////////////////////////

function updateMovieInfo()
{
    let id_found_movies_value = parseInt(document.getElementById("id-found-movies").innerHTML);
    const  movie_to_show = found_movies[id_found_movies_value ]
   // console.log("updateMovieInfo = ",movie_to_show);

    const imdb_score = document.getElementById("imdb-score");
    imdb_score.innerHTML = movie_to_show["imdbRating"];

    const imdb_votes = document.getElementById("imdb-votes");
    imdb_votes.innerHTML = "<b>" + movie_to_show["imdbVotes"] + "</b> </br>votes on IMDB</p>";
    
    const movie_title_str = document.getElementById("movie-title-str");
    movie_title_str.innerHTML = movie_to_show["Title"];

    const released_on = document.getElementById("released-on");
    released_on.innerHTML = movie_to_show["Released"];

    const genre = document.getElementById("genre");
    genre.innerHTML = movie_to_show["Genre"];

    const duration = document.getElementById("duration");
    duration.innerHTML = movie_to_show["Runtime"];

    const awards = document.getElementById("awards");
    awards.innerHTML = movie_to_show["Awards"];

    const actors = document.getElementById("actors");
    actors.innerHTML = movie_to_show["Actors"];

    const plot = document.getElementById("plot");
    plot.innerHTML = movie_to_show["Plot"];

    const poster = document.getElementById("poster");
    if (movie_to_show["Poster"] ==  undefined || movie_to_show["Poster"] == "N/A"){
        poster.src = "";
    }
    else{
        poster.src = movie_to_show["Poster"];
        //console.log("updateMovieInfo: ",poster);
    } 
}

///////////////////////////////////// EMPTY ARRAY WITH FOUND MOVIES ////////////////////////////////////////

function cleanFoundMovies(){
    document.getElementById("id-found-movies").innerHTML = 0;
    found_movies = [];
    found_movies[0] = {"imdbRating":"N/A", "imdbVotes":"N/A", "Title":"N/A", "Released":"N/A", "Genre":"N/A","Runtime":"N/A", "Awards":"N/A", "Actors":"N/A", "Plot":"N/A"};
    //found_movies[0] = [];
}






























// this is outdated and not used any more 
	function displayMovieSearch(movie_list) 
    {
		console.log("displayData= ", movie_list["Search"]);
		var  titleDiv = document.getElementById("movies");
		titleDiv.innerHTML = "";

		var tbl = document.createElement("table");
		for (let id in movie_list["Search"])
		{
			let movie = movie_list["Search"][id];
			console.log("movie = ", movie);
			
			var row = document.createElement("tr");
			var cell_picture = document.createElement("td");
			const img = document.createElement("img");
			img.src = movie["Poster"];
			cell_picture.appendChild(img);
			row.appendChild(cell_picture);

			var cell_text = document.createElement("td");			
			const title = document.createElement("h2");
			title.innerHTML = movie["Title"];
			cell_text.appendChild(title);
	
			const year = document.createElement("h2");
			year.innerHTML = movie["Year"];
			cell_text.appendChild(year);

			const m_type = document.createElement("h2");
			m_type.innerHTML = movie["Type"];
			cell_text.appendChild(m_type);

			const imdb_id = document.createElement("h2");
			imdb_id.innerHTML = movie["imdbID"];
			cell_text.appendChild(imdb_id);
			
			row.appendChild(cell_text);
			tbl.appendChild(row);
		}		
		titleDiv.appendChild(tbl);
    }  


    

