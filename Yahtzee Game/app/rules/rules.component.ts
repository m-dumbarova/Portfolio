import { Component } from '@angular/core';


@Component({
  selector: 'app-rules',
  templateUrl: './rules.component.html',
  styleUrls: ['./rules.component.css']
})
export class RulesComponent {

  public showRules = false;

  openModal() {
    console.log("OpenModal event");
    this.showRules = true;
  }

  closeModal() {
    console.log("CloseModal event");
    this.showRules = false;
  }
}
