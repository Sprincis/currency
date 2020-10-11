import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { CurrenciesComponent } from './currencies/currencies.component';
import { SingleCurrencyComponent } from './single-currency/single-currency.component';

const routes: Routes = [
	{ path: '', redirectTo: '/currencies', pathMatch: 'full' },
	{ path: 'currencies', component: CurrenciesComponent },
	{ path: 'currency/:name', component: SingleCurrencyComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
