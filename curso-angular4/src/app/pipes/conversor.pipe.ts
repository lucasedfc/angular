import {Pipe, PipeTransform} from '@angular/core';

@Pipe(
    {
        name: 'conversor'
    }
)
export class ConversorPipe implements PipeTransform {
    transform(value, por){
        let value_one = parseInt(value);
        let value_two = parseInt(por);
        let result = 'El resultado de la multiplicacion de ' + value_one + 'x' + value_two + ' es ' +(value_one*value_two)

        return result;
    }
}