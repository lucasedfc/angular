import { Component } from '@angular/core';

/* METADATA A UNA CLASE */ 
@Component({
    selector: 'fruta',
    /*template: `
    <h2>{{nombre_componente}}</h2>
    <p>{{listado_frutas}}</p>
    `*/
    templateUrl: './fruta.component.html'
})

/*Permitir que la clase sea utilizada en otro componente */ 
export class FrutaComponent {
    public nombre_componente = 'Componente de fruta';
    public listado_frutas = 'Naranja, Pera, Manzana';
}