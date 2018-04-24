import {Component, Input, Output, EventEmitter} from '@angular/core';

@Component({
    selector: 'componente-hijo',
    template: `
    <p>Este es el {{title}}</p>
    <ul>
        <li>{{propiedad_uno}}</li>
        <li>{{propiedad_dos.web}}</li>
    </ul>

    <button (click)="enviar()">Enviar datos a Padre</button>
    `
})

export class HijoComponent {
    public title: string;
    @Input('texto1') public propiedad_uno;
    @Input('texto2') public propiedad_dos;

    @Output() desde_el_hijo = new EventEmitter();

    constructor() {
        this.title = 'Componente Hijo';
    }

    ngOnInit() {
        console.log(this.propiedad_uno);
        console.log(this.propiedad_dos);
    }

    enviar() {
        this.desde_el_hijo.emit({
            nombre: 'Lucas Emmanuel Heim',
            edad: 28,
            sexo: 'M'
        });
    }
}