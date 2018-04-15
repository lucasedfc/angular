import {Component} from '@angular/core';
//Modulos para leer parametros
import {Router, ActivatedRoute, Params} from '@angular/router';

@Component({
    selector: 'contacto',
    templateUrl: './contacto.component.html'
})

export class ContactoComponent {
    public titulo = 'Pagina de contacto';
    public parametro;

    constructor(
        private _route: ActivatedRoute,
        private _router: Router
    ){}
        
    ngOnInit(){
        this._route.params.forEach((params: Params) => {
            this.parametro = params['page'];
            console.log(params);
        })
    }

    redirigir(){
        this._router.navigate(['/contacto', 'lucasheim.com']);
    }
    redirigirDos(){
        this._router.navigate(['/', '']);
    }
}