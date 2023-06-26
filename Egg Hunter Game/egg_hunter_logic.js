var board = [];
var rows = 4;
var columns = 8;

var hiddenDragonEggs = 7;
var dragonEggsLocation = [];  // array of strings, for examle "2-4" - row 2, cell 4

var eggsClicked = 0;  // Goal: to click all eggs except the dragon eggs
var markPotentialDragonEgg = false;

var gameOver = false;
//var board_div = document.createElement("div");
//document.getElementById("game-screen").append(board_div);


window.onload = function() {
    filmMaker();
}

function setDragonEggs() {

    // Hardcoded positions of the dragon eggs - for testing while developing (10 hidden dragon eggs)
/*     dragonEggsLocation.push("0-1");
    dragonEggsLocation.push("0-7");
    dragonEggsLocation.push("1-1");
    dragonEggsLocation.push("1-2");
    dragonEggsLocation.push("1-3");
    dragonEggsLocation.push("2-1");
    dragonEggsLocation.push("2-3");
    dragonEggsLocation.push("3-1");
    dragonEggsLocation.push("3-2");
    dragonEggsLocation.push("3-3"); */

    // Random generated positions of the dragon eggs
    let eggsLeft = hiddenDragonEggs;
    while (eggsLeft > 0) { 
        let r = Math.floor(Math.random() * rows);
        let c = Math.floor(Math.random() * columns);
        let id = r.toString() + "-" + c.toString();

        if (!dragonEggsLocation.includes(id)) {
            dragonEggsLocation.push(id);
            eggsLeft -= 1;
        }
    }
}


var welcome_screen = document.getElementById("welcome-screen");
var welcome = document.getElementById("welcome");
welcome_screen.style.display = "none";


var rules_screen = document.getElementById("rules-screen");
rules_screen.style.display = "none";
console.log(rules_screen);
//var rules = document.getElementById("rules");
//rules.style.display = "none";

var game_screen = document.getElementById("game-screen");
//var game_board = document.getElementById("game-board");
game_screen.style.display = "none";

var game_over_screen = document.getElementById("game-over-screen");
var game_over = document.getElementById("game-over");
var game_over_try_again = document.getElementById("game-over-try-again");
var try_again_button = document.getElementById("try-again-button");
//game_over.style.display = "none";
game_over_try_again.style.display = "none";
game_over_screen.style.display = "none";
try_again_button.style.display = "none";

var win_screen = document.getElementById("win-screen");
var win = document.getElementById("win");
win_screen.style.display = "none";
var play_again_button = document.getElementById("play-again-button");
var win_play_again = document.getElementById("win-play-again");
play_again_button.style.display = "none";
win_play_again.style.display = "none";


function filmMaker() {
    ///////////////// 1. Show welcome video (egghunter_1.mp4 as background, no loop)
    // call after the EventListener in 2.

    ///////////////// 2. Show game rules and button "Start" (egghunter_5.mp4 as looping background)

    // Add event listener to the first video's "ended" event
    welcome.addEventListener("ended", (event) => {
        // Call the function to show the second video container
        rules_screen.style.display = "block";
        welcome_screen.style.display = "none";
        // Play the second video
        //rules.play();
        
        // Get the button element
        var startButton = document.getElementById("start-game-button");
        // Add event listener to the button's "click" event
        startButton.addEventListener("click", startNewGame);
        }
    );

    game_over.addEventListener("ended", (event) => {
        game_over.style.display = "none";
        game_over_try_again.style.display = "block";
        try_again_button.style.display = "block";
        try_again_button.addEventListener("click", startNewGame);
        game_over_try_again.play();
        }
    );

    win.addEventListener("ended", (event) => {
        win.style.display = "none";
        win_play_again.style.display = "block";
        play_again_button.style.display = "block";
        play_again_button.addEventListener("click", startNewGame);
        win_play_again.play();
        }
    );

    welcome_screen.style.display = "block";
    //welcome.play();
    


    ////////////////// 3. Load game board and call startGame() (egghunter_2.mp4 as looping background)


    ///////////////// 4.1. Game over => Show game over video (egghunter_3.mp4), no loop
    /////////////////                => Show egghunter_5.mp4 video as looping background and show button "Try again"



    ////////////////// 4.2. Win => Show win video (egghunter_4.mp4), no loop
    //////////////////                => Show button "Play again"


    
    

}
function startNewGame() {
    board = [];
    //document.getElementById("game-screen").removeChild(board_div);  // adds an egg to the board, which will be displayed in the HTML
    //board_div = document.createElement("div");
    //document.getElementById("game-screen").append(board_div);  // adds an egg to the board, which will be displayed in the HTML
    document.getElementById("board").innerHTML = "";
    dragonEggsLocation = [];  // empty the array of strings, for examle "2-4" - row 2, cell 4
    eggsClicked = 0;  // Goal: to click all eggs except the dragon eggs
    markPotentialDragonEgg = false;
    gameOver = false;

    game_over.style.display = "block";
    win.style.display = "block";

    startGame();
}

function startGame() {
    welcome_screen.style.display = "none";
    rules_screen.style.display = "none";
    game_screen.style.display = "block";
    game_over_screen.style.display = "none";
    win_screen.style.display = "none";

    document.getElementById("number-dragon-eggs").innerText = "Be careful with all " + hiddenDragonEggs + " dragon eggs.";
    document.getElementById("potentional-dragon-mark-button").addEventListener("click", setFlag);
    // document.addEventListener("mousedown", eventMouseClicks);

    setDragonEggs();

    // Creating the board
    for (let r = 0; r < rows; r++) {
        let row = [];
        for (let c = 0; c < columns; c++) {
            //<div id="0-0"></div>
            let egg = document.createElement("div");  // creates set of opening and closing div tags   =>   <div></div>
            egg.id = r.toString() + "-" + c.toString();  // adds the id attribute to the div, displaying the egg   =>   <div id="0-2"></div>
            
            egg.addEventListener("click", clickEgg);  // clicking on an egg will call and execute the function clickEgg()

           
            document.getElementById("board").append(egg);  // adds an egg to the board, which will be displayed in the HTML
            //board_div.append(egg);
            row.push(egg);  // Add the element to the array row
        }
        board.push(row);  // display the board in the HTML
    }

    console.log(board);
}

function setFlag() {
    console.log("potentional-dragon-mark-button", markPotentialDragonEgg);
    let btn_text = document.getElementById("potentional-dragon-mark-button").innerText;
    console.log("potentional-dragon-mark-button", btn_text);
    if (markPotentialDragonEgg) {
        markPotentialDragonEgg = false;
        btn_text = btn_text.replace("CLICK MODE"," MARK MODE ");
    }
    else {
        markPotentialDragonEgg = true;
        btn_text = btn_text.replace("MARK MODE"," CLICK MODE ");
    }
    console.log("potentional-dragon-mark-button", btn_text);
    document.getElementById("potentional-dragon-mark-button").innerText = btn_text;
    let span1 = document.createElement("span");  // add span
    let span2 = document.createElement("span");  // add span
    let span3 = document.createElement("span");  // add span
    let span4 = document.createElement("span");  // add span
    document.getElementById("potentional-dragon-mark-button").append(span1); 
    document.getElementById("potentional-dragon-mark-button").append(span2); 
    document.getElementById("potentional-dragon-mark-button").append(span3); 
    document.getElementById("potentional-dragon-mark-button").append(span4); 
}

function clickEgg() {
    if (gameOver || this.classList.contains("egg-clicked")) {
        return;
    }

    let egg = this;
    if (markPotentialDragonEgg) {
        if (!egg.classList.contains("egg-marked")) {
            egg.classList.add("egg-marked");
            console.log("add class='egg-marked'");
        }
        else if (egg.classList.contains("egg-marked")) {
            console.log("remove class='egg-marked'");
            egg.classList.remove("egg-marked");
        }
        return;
    }

    if (dragonEggsLocation.includes(egg.id)) {
        /* alert("GAME OVER"); */
        gameOver = true;
        showAllDragonEggs();
        //document.getElementById("number-dragon-eggs").innerText = "You're in big trouble! You've destroyed the dragon's nest!";
        game_screen.style.display = "none";
        game_over.style.display = "block";

        game_over_try_again.style.display = "none";
        try_again_button.style.display = "none";
        game_over.play();
        game_over_screen.style.display = "block";

        return;
    }


    let coords = egg.id.split("-"); // "0-0" -> ["0", "0"]
    let r = parseInt(coords[0]);
    let c = parseInt(coords[1]);
    checkIfDragonEgg(r, c);

}

function showAllDragonEggs() {
    for (let r= 0; r < rows; r++) {
        for (let c = 0; c < columns; c++) {
            let egg = board[r][c];
            if (dragonEggsLocation.includes(egg.id)) {
                egg.style = "animation: pulsate 1.5s infinite; background-image: url('assets/images/dragon_egg.png')";
            }
        }
    }
}

function checkIfDragonEgg(r, c) {
    if (r < 0 || r >= rows || c < 0 || c >= columns) {
        return;
    }
    if (board[r][c].classList.contains("egg-clicked")) {
        return;
    }

    board[r][c].classList.add("egg-clicked");
    eggsClicked += 1;
    board[r][c].style = "background-image: url('assets/images/egg_0_glow.png')";
    console.log("Number of clicked eggs: ", eggsClicked);

    let dragonEggsFound = 0;

    //top 3
    dragonEggsFound += checkEgg(r-1, c-1);      //top left
    dragonEggsFound += checkEgg(r-1, c);        //top 
    dragonEggsFound += checkEgg(r-1, c+1);      //top right

    //left and right
    dragonEggsFound += checkEgg(r, c-1);        //left
    dragonEggsFound += checkEgg(r, c+1);        //right

    //bottom 3
    dragonEggsFound += checkEgg(r+1, c-1);      //bottom left
    dragonEggsFound += checkEgg(r+1, c);        //bottom 
    dragonEggsFound += checkEgg(r+1, c+1);      //bottom right

    if (dragonEggsFound > 0) {
        board[r][c].style = "background-image: url('assets/images/egg_" + dragonEggsFound.toString() + "_glow.png')";
        board[r][c].classList.add("egg-" + dragonEggsFound.toString());
    }
    else {
        //top 3
        checkIfDragonEgg(r-1, c-1);    //top left
        checkIfDragonEgg(r-1, c);      //top
        checkIfDragonEgg(r-1, c+1);    //top right

        //left and right
        checkIfDragonEgg(r, c-1);      //left
        checkIfDragonEgg(r, c+1);      //right

        //bottom 3
        checkIfDragonEgg(r+1, c-1);    //bottom left
        checkIfDragonEgg(r+1, c);      //bottom
        checkIfDragonEgg(r+1, c+1);    //bottom right
    }

    if (eggsClicked == rows * columns - hiddenDragonEggs) {
        //document.getElementById("number-dragon-eggs").innerText = "You left all dragon eggs intact. You win!";
        game_screen.style.display = "none";
        win.style.display = "block";
        win_play_again.style.display = "none";
        play_again_button.style.display = "none";
        win.play();
        win_screen.style.display = "block";
        gameOver = true;
    }

}


function checkEgg(r, c) {
    if (r < 0 || r >= rows || c < 0 || c >= columns) {
        return 0;
    }
    if (dragonEggsLocation.includes(r.toString() + "-" + c.toString())) {
        return 1;
    }
    return 0;
}