import {Component, Input} from '@angular/core';

@Component({
    selector: 'componente-hijo',
    template: `
    <p>Este es el {{title}}</p>
    <ul>
        <li>{{propiedad_uno}}</li>
        <li>{{propiedad_dos.web}}</li>
    </ul>
    `
})

export class HijoComponent {
    public title: string;
    @Input('texto1') public propiedad_uno;
    @Input('texto2') public propiedad_dos;

    constructor() {
        this.title = 'Componente Hijo';
    }

    ngOnInit() {
        console.log(this.propiedad_uno);
        console.log(this.propiedad_dos);
    }
}