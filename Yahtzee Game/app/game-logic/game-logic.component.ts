import { Component } from '@angular/core';
import { Die, dieState } from './die';
import { Table } from './table';

@Component({
  selector: 'app-game-logic',
  templateUrl: './game-logic.component.html',
  styleUrls: ['./game-logic.component.css']
})

export class GameLogicComponent {


  ////////////////////////////// Button Roll Dice /////////////////////////////////

  // Initial set of 5 dice -> GO
  public diceValues: Array<Die> = [new Die(0), new Die(0), new Die(0), new Die(0), new Die(0)];
  public nrRolls = 0;
  public player = 1;
  public endTurn = false;
  public PlayerCurrentTurn: Array<number> = [];
  public elemCount: Array<number> = [];
  public totalScore = 0;
  public winner_text: string = "";

 

  // Press Roll Dice button and changes the value of each die
  rollDice() {
    console.log("rollDice event");
    for (let i = 0; i < this.diceValues.length; i++) {
      if (this.diceValues[i].state != dieState.Selected)
        this.diceValues[i].face = Math.floor(Math.random() * 6) + 1;
      console.log(this.diceValues[i]);
    }
    this.nrRolls += 1;
    this.updateTable();
    if (this.nrRolls >= 3) {
      this.endTurn = true;
    }
    
    console.log(this.nrRolls);
  }

  updateTotal(){
      let sum = 0;
      for (let table of this.LowerTableValues){
          if (table.used == true){
              sum += table.predicted;
          }
      }
      for (let table of this.UpperTableValues){
          if (table.used == true){
              sum += table.predicted;
          }
      }
      this.totalScore = sum;
  }
  
  selectDie(die: Die) {
    console.log("selectDie", die);
    die.toggleState();
    //array push Player1CurrentTurn with the selected dice values
    this.PlayerCurrentTurn.push(die.face);
    console.log("PlayerCurrentTurn is array from these elements: ", this.PlayerCurrentTurn);
  }

  ////////////////////////////// Score card //////////////////////////

  private UpperTableValues_player1: Array<Table> = [new Table(0), new Table(1), new Table(2), new Table(3), new Table(4), new Table(5)];
  private LowerTableValues_player1: Array<Table> = [new Table(6), new Table(7), new Table(8), new Table(9), new Table(10), new Table(11), new Table(12)];
  private UpperTableValues_player2: Array<Table> = [new Table(0), new Table(1), new Table(2), new Table(3), new Table(4), new Table(5)];
  private LowerTableValues_player2: Array<Table> = [new Table(6), new Table(7), new Table(8), new Table(9), new Table(10), new Table(11), new Table(12)];
  
  public UpperTableValues = this.UpperTableValues_player1;
  public LowerTableValues = this.LowerTableValues_player1;

  public playerTurnScore: number = 0;

   
  ////////////////////////////// Change Player //////////////////////////

  changePlayer(): void {
    switch(this.player){
      case this.player = 1:
          this.player = 2;
          this.LowerTableValues=this.LowerTableValues_player2;
          this.UpperTableValues=this.UpperTableValues_player2;
          break;
      case this.player = 2:
        this.player = 1;
        this.LowerTableValues=this.LowerTableValues_player1;
        this.UpperTableValues=this.UpperTableValues_player1;
        break;
      default:
          throw "invalid player";
    }
    this.diceValues = [new Die(0), new Die(0), new Die(0), new Die(0), new Die(0)];
    this.PlayerCurrentTurn = [];
    this.updateTotal();
    this.updateTable();
    this.whoWins();
  }

  
  selectTable(table:Table){
      table.used = true;
      // show total score of the current player
      this.endTurn = false;
      this.changePlayer();
      this.nrRolls = 0;
  }
  
  updateTable(){
      ////////////////// UPPER SECTION //////////////////////////
      for(let i=0; i<this.UpperTableValues.length; i++) {
          if (this.UpperTableValues[i].used != true ) {
            switch(this.UpperTableValues[i].name) {
              case "Aces":{
                   let newValue = this.sumDiceValue(1);
                   this.UpperTableValues[i].predicted = newValue;
                   break;
              }
              case "Twos":{
                let newValue = this.sumDiceValue(2);
                this.UpperTableValues[i].predicted = newValue;
                break;
              }
              case "Threes":{
                let newValue = this.sumDiceValue(3);
                this.UpperTableValues[i].predicted = newValue;
                break;
              }
              case "Fours":{
                let newValue = this.sumDiceValue(4);
                this.UpperTableValues[i].predicted = newValue;
                break;
              }
              case "Fives":{
                let newValue = this.sumDiceValue(5);
                this.UpperTableValues[i].predicted = newValue;
                break;
              }
              case "Sixes":{
                let newValue = this.sumDiceValue(6);
                this.UpperTableValues[i].predicted = newValue;
                break;
              }
               default:{
                   console.log("unknown name" + this.UpperTableValues[i].name);
               }
            }        
          } 
        }

      for(let i=0; i<this.LowerTableValues.length; i++) {
          if (this.LowerTableValues[i].used != true ) {
            this.LowerTableValues[i].predicted = 0;
            switch(this.LowerTableValues[i].name) {
              case "3 of a kind":{
                for(let j=1; j<=6; j++) {
                    if (this.countValue(j) >= 3){
                        let sum = 0;
                        for (let die of this.diceValues){
                           sum += die.face;
                        }
                        this.LowerTableValues[i].predicted = sum;
                        break;
                    } 
                  }
                  break; 
              }
              case "4 of a kind":{
                for(let j=1; j<=6; j++) {
                   if (this.countValue(j) >= 4){
                        let sum =0;
                        for (let die of this.diceValues){
                           sum+= die.face;
                        }
                       this.LowerTableValues[i].predicted = sum;
                     break;
                   } 
                  }
                  break; 
              }
              /* case "Full House":{
                break;
              } */
              //////////////////////////////////////////////////////////////////////////
              case "Full House":{
                for(let j=1; j<=6; j++) {
                  for(let k=1; k<=6; k++) {
                    if (this.countValue(j) == 3 && this.countValue(k) == 2) {
                      this.LowerTableValues[i].predicted = this.LowerTableValues[i].value;
                      break;
                    }
                  }
                } 
                break;
              } 
              /////////////////////////////////////////////////////////////////////////
              case "S.Straight": {
                //Check for 1,2,3,4
                if(this.countValue(1)>=1 && this.countValue(2)>=1 && this.countValue(3)>=1 && this.countValue(4)>=1) {
                  this.LowerTableValues[i].predicted = this.LowerTableValues[i].value;
                  break;
                }
                //Check for 2,3,4,5
                if(this.countValue(2)>=1 && this.countValue(3)>=1 && this.countValue(4)>=1 && this.countValue(5)>=1) {
                  this.LowerTableValues[i].predicted = this.LowerTableValues[i].value;
                  break;
                }
                //Check for 3,4,5,6
                if(this.countValue(3)>=1 && this.countValue(4)>=1 && this.countValue(5)>=1 && this.countValue(6)>=1) {
                  this.LowerTableValues[i].predicted = this.LowerTableValues[i].value;
                  break;
                }
                break;
              }
              case "L.Straight":{
                //Check for 1,2,3,4,5
                if(this.countValue(1)>=1 && this.countValue(2)>=1 && this.countValue(3)>=1 && this.countValue(4)>=1 && this.countValue(5)>=1) {
                  this.LowerTableValues[i].predicted = this.LowerTableValues[i].value;
                  break;
                }
                //Check for 2,3,4,5,6
                if(this.countValue(2)>=1 && this.countValue(3)>=1 && this.countValue(4)>=1 && this.countValue(5)>=1 && this.countValue(6)>=1) {
                  this.LowerTableValues[i].predicted = this.LowerTableValues[i].value;
                  break;
                }
                break;
              }
              case "YAHTZEE":{
                if (this.diceValues[0].face != 0 && this.countValue(this.diceValues[0].face) == 5){
                       this.LowerTableValues[i].predicted = this.LowerTableValues[i].value;
                    }
                break;
              }
              case "Chance":{
                let sum =0;
                for (let die of this.diceValues){
                    sum+= die.face;
                }
                this.LowerTableValues[i].predicted = sum;
                break;
              }
               default:{
                   console.log("unknown name" + this.LowerTableValues[i].name);
               }
            }        
          }
      }
  }
  
  sumDiceValue(checkNumber:number){
      let sum =0;
      for(let i=0; i<this.diceValues.length; i++){
          if (this.diceValues[i].face == checkNumber) sum += this.diceValues[i].face;
      }
      return sum;
  }
  
  countValue (value:number){
      let count = 0;
      for (let die of this.diceValues){
          if (die.face == value){
              count +=1;
          }
      }
      return count;
  }

  whoWins() {
    let game_finished: boolean = true;
    let score_player1: number = 0;
    let score_player2: number = 0;

    if(game_finished){
      for (let category of this.LowerTableValues_player1) {
        if (category.used) {
          score_player1 = category.predicted;
        }
        else {
          game_finished = false;
          break;
        }
      }
    }
    if(game_finished){
      for (let category of this.UpperTableValues_player1) {
        if (category.used) {
          score_player1 = category.predicted;
        }
        else {
          game_finished = false;
          break;
        }
      }
    }

    if(game_finished){
      for (let category of this.LowerTableValues_player2) {
        if (category.used) {
          score_player2 = category.predicted;
        }
        else {
          game_finished = false;
          break;
        }
      }
    }
    if(game_finished){
      for (let category of this.UpperTableValues_player2) {
        if (category.used) {
          score_player2 = category.predicted;
        }
        else {
          game_finished = false;
          break;
        }
      }
    }
    
    if(game_finished) {
      if(score_player1 > score_player2) {
        console.log("Player 1 wins.");
        this.winner_text = "Player 1 wins!";
      }
      if(score_player1 < score_player2) {
        console.log("Player 2 wins.");
        this.winner_text = "Player 2 wins!";
      }
      if(score_player1 == score_player2) {
        console.log("Both players.");
        this.winner_text = "The result is equal. There is no winner!";
      }

    }
  }
  /////////////////////////////////////////////////////////

  /////////////////////////////////////////////////////////

} // end of "export class GameLogicComponent"

