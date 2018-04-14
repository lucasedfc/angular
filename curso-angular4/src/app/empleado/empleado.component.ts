import {Component} from '@angular/core';
import {Empleado} from './empleado';

@Component({
    selector: 'empleado',
    templateUrl: './empleado.component.html'
})

export class EmpleadoComponent {
    public title_empleado = 'Componente Empleados';
    public empleado:Empleado;
    public trabajadores:Array<Empleado>;
    public trabajador_externo:boolean;
    public color:string;
    public color_seleccionado:string;

    constructor(){
        this.empleado = new Empleado('Lucas Heim', 28, 'Desarrollador', true);
        this.trabajadores = [
            new Empleado('Juli Lopesh', 32, 'Cantante', false),
            new Empleado('Liniers', 43, 'Cocinero', true),
            new Empleado('Eber Ludueña', 46, 'Pintor', false),
            new Empleado('Juana La loca', 36, 'Administrativo', true)
        ];

        this.trabajador_externo = true;
        this.color = 'green';
        this.color_seleccionado = '#ccc';
    }

    ngOnInit(){
        
        console.log(this.empleado);
    }

    cambiarExterno(valor) {
        this.trabajador_externo = valor;
    }

    logColorSeleccionado(){
        console.log(this.color_seleccionado);
    }
}1