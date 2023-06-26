export class Die {
    face: number;
    state: dieState;

    constructor(face:number)
    {
        this.face = face;
        this.state = dieState.Fresh; 
    }

    toggleState(): void{
        if (this.state != null){
            switch(this.state){
                case dieState.Fresh:
                    this.state = dieState.Selected;
                    break;
                case dieState.Selected:
                    this.state = dieState.Fresh;
                    break;
                default:
                    throw "invalid State";
            }
        }
    }
}

export enum dieState { // enum is keyword. It refers to predefined values and the variable can not accept other values.
    Fresh = "FRESH",
    Selected = "SELECTED",
    Set = "SET"
}