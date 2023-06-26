import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppComponent } from './app.component';
import { ContainerComponent } from './container/container.component';
import { RulesComponent } from './rules/rules.component';
import { SettingsComponent } from './settings/settings.component';
import { GameLogicComponent } from './game-logic/game-logic.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

@NgModule({
  declarations: [
    AppComponent,
    ContainerComponent,
    RulesComponent,
    SettingsComponent,
    GameLogicComponent,
  ],
  imports: [
    BrowserModule,
    BrowserAnimationsModule,

  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
