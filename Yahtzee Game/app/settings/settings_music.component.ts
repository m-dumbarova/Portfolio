 /*
import { Component, OnInit } from '@angular/core';
import {Howl, Howler} from 'howler';


@Component({
  selector: 'app-settings',
  templateUrl: './settings.component.html',
  styleUrls: ['./settings.component.css']
})
export class SettingsComponent implements OnInit {
  public showSettings = false;
  public musicSound = false;

  sound = new Howl({
      src: ['../../assets/music/powdown-110017.mp3'],
      html5: true,
      onend: function() {
        console.log('stop')
        this.stop()}
  });

  openModal() {
    console.log("OpenModal event");
    this.showSettings = true;
  }

  closeModal() {
    console.log("CloseModal event");
    this.showSettings = false;
  }

  ngOnInit() {
    // Play the sound.
    this.sound.play();

    // Change global volume.
    Howler.volume(0.5);
  }

  playMusic() {
    console.log("playMusic event");

    this.sound.play()
  }

  stopMusic() {
    console.log("stopMusic event");

    this.sound.stop()
  } 
}
*/