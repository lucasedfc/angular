import {Component} from '@angular/core';
import { templateJitUrl } from '@angular/compiler';

@Component({
    selector: 'error',
    templateUrl: '../views/error.html'
})

export class ErrorComponent {
    public titulo:string;

    constructor(){
        this.titulo = 'Error!! Pagina no Encontrada'
    }

    ngOnInit(){
        console.log("Se cargo el componente de error");
    }
}