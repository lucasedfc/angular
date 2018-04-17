import {Component} from '@angular/core';
import {Coche} from './coche';

@Component({
    selector: 'coches',
    templateUrl: './coches.component.html'
})

export class CochesComponent {
    public coche: Coche;
    public coches:Array<Coche>;

    constructor() {
        this.coche = new Coche("","","");
        this.coches = [
            new Coche("Gol Trend","101","Gris"),
            new Coche("Golf","120","Azul"),
        ];
    }

    onSubmit(){
        //console.log(this.coche);
        this.coches.push(this.coche);
        this.coche = new Coche("","","");
    }
}