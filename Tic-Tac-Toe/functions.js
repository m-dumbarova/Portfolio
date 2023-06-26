const app = Vue.createApp ({
    data() 
    {
        return {
            showBoard: false,
            showPlayers: false,
            gameDone: false,
            playerXname: '',
            playerXwins: 0,
            playerOname: '',
            playerOwins: 0,
            turn: 1,
            finished: false,
            whoIsPlaying: "X",
            board: [
                {index: 1, value: '', isUsed: false},
                {index: 2, value: '', isUsed: false},
                {index: 3, value: '', isUsed: false},
                {index: 4, value: '', isUsed: false},
                {index: 5, value: '', isUsed: false},
                {index: 6, value: '', isUsed: false},
                {index: 7, value: '', isUsed: false},
                {index: 8, value: '', isUsed: false},
                {index: 9, value: '', isUsed: false}
            ],
            Xchoices: [],
            Ochoices: [],
            winCombinations: [
                [1, 2, 3],
                [4, 5, 6],
                [7, 8, 9],
                [1, 4, 7],
                [2, 5, 8],
                [3, 6, 9],
                [1, 5, 9],
                [3, 5, 7]
            ]

        }
    },
    methods: {
        submit() {
            if (this.finished == true && this.showBoard == true) {    // When finished=true the button is "NEW GAME" and variables must be reset
                this.turn=1
                this.finished = false
                this.whoIsPlaying = "X"
                this.board = [
                                {index: 1, value: '', isUsed: false},
                                {index: 2, value: '', isUsed: false},
                                {index: 3, value: '', isUsed: false},
                                {index: 4, value: '', isUsed: false},
                                {index: 5, value: '', isUsed: false},
                                {index: 6, value: '', isUsed: false},
                                {index: 7, value: '', isUsed: false},
                                {index: 8, value: '', isUsed: false},
                                {index: 9, value: '', isUsed: false}]
                this.Xchoices = []
                this.Ochoices = []
                document.getElementById("startBtn").hidden = true
                document.getElementById("player").innerHTML=""
            }
            else {  // When finished=flase the button is "START"
                if(this.playerXname != '' && this.playerOname != '') {
                    document.getElementById("startBtn").hidden = true

                    this.inputPlayerXname = document.getElementById("inputPlayerXname")
                    this.inputPlayerOname = document.getElementById("inputPlayerOname")

                    this.showPlayers = true 
                    this.showBoard = true 
                    
                    document.getElementById("player1-on-start").innerHTML = this.playerXname + " plays X."
                    document.getElementById("inputPlayerXname").readOnly=true
                    document.getElementById("player2-on-start").innerHTML = this.playerOname + " plays O."
                    document.getElementById("inputPlayerOname").readOnly=true    
                    this.showPlayers = true         
                }
                else {
                    alert("Enter names for both players.")
                }

            }
        },
        changeValue(box) {
            if (box.isUsed == true || this.finished == true){
                return false
            }
            else {
                box.isUsed = true
            }

            if (this.turn % 2 === 0) {
                box.value = "O"
                //console.log( this.turn + " clicks have been done.")
            }
            else {
                box.value = "X"
                //console.log( this.turn + " clicks have been done.")
            }
            result = this.whoWins(box)
            this.turn++
            if (this.turn > 9 && result == false) {
                document.getElementById("player").innerHTML="No winner."
                document.getElementById("startBtn").hidden = false
                this.finished = true
            }
        },
        whoWins(box) {
            //console.log(this.board)
            console.log("The value in box " + box.index + " is " + box.value)

            console.log("playerXname is: ", this.playerXname)
            console.log("playerOname is: ", this.playerOname)


            if (box.value === "X") {
                this.Xchoices.push(box.index);
                console.log("Xchoices contains: " + this.Xchoices + ", ")
            }
            if (box.value === "O") {
                this.Ochoices.push(box.index);
                console.log("Ochoices contains: " + this.Ochoices + ", ")
            }

            
            for (i = 0; i < this.winCombinations.length; i++) {

                if(this.Xchoices.includes(this.winCombinations[i][0]) && this.Xchoices.includes(this.winCombinations[i][1]) && this.Xchoices.includes(this.winCombinations[i][2])) {
                    console.log("winCombinations is: " ,this.winCombinations[i])
                    console.log(this.playerXname, " wins!")
                    document.getElementById("player").innerHTML=this.playerXname + " wins!"
                    this.finished=true
                    this.playerXwins += 1
                    document.getElementById("startBtn").hidden = false
                    this.stataus()
                    return true
                } 
                if(this.Ochoices.includes(this.winCombinations[i][0]) && this.Ochoices.includes(this.winCombinations[i][1]) && this.Ochoices.includes(this.winCombinations[i][2])) {
                    console.log("winCombinations is: " ,this.winCombinations[i])
                    console.log(this.playerOname, " wins!")
                    document.getElementById("player").innerHTML=this.playerOname + " wins!"
                    this.finished=true
                    this.playerOwins += 1
                    document.getElementById("startBtn").hidden = false
                    this.stataus()
                    return true
                }
                
                //console.log("i in the for loop = " + i, this.winCombinations[i])           
            }         

            this.changePlayer()
            return false
           
        },
        changePlayer() {
            console.log("change player")
            if (this.whoIsPlaying == "X") {
                document.getElementById("player").innerHTML = this.playerOname + " is playing."
                this.whoIsPlaying = "O"
            }
            else {
                document.getElementById("player").innerHTML = this.playerXname + " is playing."
                this.whoIsPlaying = "X"
            }
        },
        stataus() {
            this.gameDone = true
            document.getElementById("player1").innerHTML = this.playerXname + " (Player X) won " + this.playerXwins + " times."
            document.getElementById("player2").innerHTML = this.playerOname + " (Player O) won " + this.playerOwins + " times."
        } 
    } 
})

app.mount('#game')