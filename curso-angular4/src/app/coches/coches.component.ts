import {Component} from '@angular/core';
import {Coche} from './coche';
import {PeticionesService} from '../services/peticiones.service';

@Component({
    selector: 'coches',
    templateUrl: './coches.component.html',
    providers: [PeticionesService]
})

export class CochesComponent {
    public coche: Coche;
    public coches:Array<Coche>;
    public articulos;

    constructor(
        private _peticionesService:PeticionesService
    ) {

        this.coche = new Coche("","","");
        this.coches = [
            new Coche("Gol Trend","101","Gris"),
            new Coche("Golf","120","Azul"),
        ];
    }

    ngOnInit() {
        this._peticionesService.getArticulos().subscribe(
            result => {
                this.articulos = result;
                if(!this.articulos){
                    console.log("Error en el servidor");
                }
                console.log(result);
            },
            error => {
                var errMsg = <any>error;
                console.log(errMsg);
            }
        );
    }

    onSubmit(){
        //console.log(this.coche);
        this.coches.push(this.coche);
        this.coche = new Coche("","","");
    }
}