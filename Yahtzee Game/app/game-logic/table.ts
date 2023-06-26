export class Table {
    private values = [
        {name:"Aces", value:0},
        {name:"Twos", value:0},
        {name:"Threes", value:0},
        {name:"Fours", value:0},
        {name:"Fives", value:0},
        {name:"Sixes", value:0},
        {name:"3 of a kind", value:0},
        {name:"4 of a kind", value:0},
        {name:"Full House", value:25},
        {name:"S.Straight", value:30},
        {name:"L.Straight", value:40},
        {name:"YAHTZEE", value:50},
        {name:"Chance", value:0}

    ];

    public name: string;
    public value: number;
    public used: boolean ;
    public predicted:number

    constructor (nr:number){
        this.name = this.values[nr].name;
        this.value = this.values[nr].value;
        this.used = false;
        this.predicted = 0;
    }
}
