/*
Campos a validar
*/

let inputCredito = document.getElementById('credito'),
    credito = 0,
    inputIntereses = document.getElementById('intereses'),
    intereses = 0

/*
Botones
*/
let btnCalcular = document.getElementById('btn-calcular')

/*
Validaciones
*/
inputCredito.addEventListener('keyup', () => {
  credito = inputCredito.value
})

inputIntereses.addEventListener('keyup', () => {
  intereses = inputIntereses.value
})


btnCalcular.addEventListener('click', () => {
  if(credito == 0 && intereses == 0){
    alert('Los campos "credito" e "intereses" están vacíos')
  }else if(credito == 0){
    alert('El campo "credito" está vacío')
  }else if(intereses == 0){
    alert('El campo "intereses" está vacío')
  }

})
