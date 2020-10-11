import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { Location } from '@angular/common';
import { HttpClient } from '@angular/common/http';


@Component({
  selector: 'app-single-currency',
  templateUrl: './single-currency.component.html',
  styleUrls: ['./single-currency.component.css']
})
export class SingleCurrencyComponent implements OnInit {

  loading: boolean = true;
  p: number = 1;
  currencies: any;
  currencyName = '';
  totalItems: number = 0;

  constructor( private route: ActivatedRoute, private _location: Location, private http: HttpClient ) {
    this.currencyName = this.route.snapshot.paramMap.get('name');
  }

  getSingleCurrency() {
    this.http.get('http://api.localhost/api/currency/single/'+this.currencyName).subscribe(data => {
      this.currencies = data;
      this.totalItems = this.currencies.length;
      this.loading = false;
    });
  }

  goBack() {
    this._location.back();
  }

  ngOnInit() {
    this.getSingleCurrency();
  }

}
