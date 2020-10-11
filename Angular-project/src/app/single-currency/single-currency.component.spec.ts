import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SingleCurrencyComponent } from './single-currency.component';

describe('SingleCurrencyComponent', () => {
  let component: SingleCurrencyComponent;
  let fixture: ComponentFixture<SingleCurrencyComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SingleCurrencyComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SingleCurrencyComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
