import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-currencies',
  templateUrl: './currencies.component.html',
  styleUrls: ['./currencies.component.css']
})
export class CurrenciesComponent implements OnInit {

  constructor( private http: HttpClient ) { }

  loading: boolean = true;
  p: number = 1;
  currencies: any;
  totalItems: number = 0;
  
  getLatestCurrencies() {
    this.http.get('http://api.localhost/api/currency/latest').subscribe(data => {
      this.currencies = data;
      this.totalItems = this.currencies.length;
      this.loading = false;
    });
  }

  ngOnInit() {
    this.getLatestCurrencies();
  }

}
