import { Component } from '@angular/core';


@Component({
  selector: 'app-settings',
  templateUrl: './settings.component.html',
  styleUrls: ['./settings.component.css']
})
export class SettingsComponent  {
  public showSettings = false;


  openModal() {
    console.log("OpenModal event");
    this.showSettings = true;
  }

  closeModal() {
    console.log("CloseModal event");
    this.showSettings = false;
  }

  playMusic() {

  }

  stopMusic() {
    
  }
}
