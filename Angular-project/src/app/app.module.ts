import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LocationStrategy, PathLocationStrategy } from '@angular/common';
import { SingleCurrencyComponent } from './single-currency/single-currency.component';
import { CurrenciesComponent } from './currencies/currencies.component';
import { NgxPaginationModule } from 'ngx-pagination';
import { HttpClientModule } from '@angular/common/http';

@NgModule({
  declarations: [
    AppComponent,
    SingleCurrencyComponent,
    CurrenciesComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    NgxPaginationModule,
    HttpClientModule
  ],
  providers: [
  	{provide: LocationStrategy, useClass: PathLocationStrategy}
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
